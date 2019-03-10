<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor extends CI_Controller {

    /**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);

        if(is_logged_in())  // if you add in constructor no need write each function in above controller. 
        {
            redirect('Dashboard');
        }
        $this->load->database();
        $this->load->model(array('user_model'));
        $this->load->helper(array('form', 'url', 'security'));
        $this->data['lang'] = "english";
        if($this->session->userdata('user_profile_lang')==null){
            $serv = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
            if($serv != false)
            {                  
                $temp = explode(",",$serv);            
                $temp = strtolower(substr($temp[0],0,2));            
                if($temp == "fr") $this->data['lang']="french";
            } 
        }else{
            $this->data['lang'] = $this->session->userdata('user_profile_lang');
        }
        $this->lang->load('visitor', $this->data['lang']);

    }

    public function login()
    {
        $this->layout->set_titre($this->lang->line("login_title"));
        $this->layout->visitor('login.php');
    }

    public function signup()
    {
        $this->layout->set_titre($this->lang->line("register_title"));
        $this->layout->visitor('register.php');
    }

    public function password()
    {
        $this->layout->visitor('password.php');
    }

    public function register()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 
                                          'trim|min_length[3]|required',
                                          array(
                                              'required'      => 'L\'%s est obligatoire.',
                                              'min_length'     => 'L\'%s doit être composé d\'au moins 5 caractères.' 
                                          ));

        $this->form_validation->set_rules('email', 'email', 
                                          'trim|min_length[5]|valid_email|required|is_unique[user.email]',
                                          array(
                                              'required'      => 'L\'%s est obligatoire.',
                                              'min_length'     => 'L\'%s doit être composé d\'au moins 5 caractères.',
                                              'valid_email'   => 'L\'%s n\'est pas valide.',
                                              'is_unique' => 'L\'%s est déjà utilisé.'
                                          ));
        $this->form_validation->set_rules('password', 'mot de passe', 
                                          'trim|min_length[5]|required',
                                          array(
                                              'required'      => 'Le %s est obligatoire.',
                                              'min_length'     => 'Le %s doit être composé d\'au moins 5 caractères.'
                                          ));

        if ($this->form_validation->run() == FALSE){
            $this->signup();
        }else{
            $user['name'] = xss_clean($_POST['name']);
            $user['email'] = xss_clean($_POST['email']);
            $user['emailHash'] = password_hash(xss_clean($_POST['email']), PASSWORD_DEFAULT);
            $user['password'] = password_hash(xss_clean($_POST['password']), PASSWORD_DEFAULT);
            $user['lang'] = $this->data['lang'];
            $user['id'] = $this->user_model->insertUser($user);
            $this->session->set_flashdata('messageOK', $this->lang->line('registration_completed').' '.$user['name']);
            $this->session->set_userdata('user_profile_id', $user['id']);
            $this->session->set_userdata('user_profile_name', $user['name']);
            $this->session->set_userdata('user_profile_email', $user['email']);
            $this->session->set_userdata('user_profile_lang', $user['lang']);
            $this->session->set_userdata('user_profile_premium', 0);
            redirect('Dashboard');
        }
    }

    public function signin()
    {
        $data = $this->user_model->findUserByEmail(xss_clean($_POST['email']));

        if($data!= null && password_verify(xss_clean($_POST['password']), $data[0]->password))
        {
            $this->session->set_userdata('user_profile_id', $data[0]->id);
            $this->session->set_userdata('user_profile_name', $data[0]->name);
            $this->session->set_userdata('user_profile_email', $data[0]->email);
            $this->session->set_userdata('user_profile_premium', $data[0]->premium);
            $this->session->set_userdata('user_profile_lang', $data[0]->lang);

            if(isset($_POST['remember_me']) && $_POST['remember_me']=='OK'){
                delete_cookie('remember_me'); 
                $cookie = array(
                    'name' => 'remember_me',
                    'value' => $data[0]->emailHash,
                    'expire' => '1209600',
                );
                set_cookie($cookie); 
            }

            redirect('Dashboard');
        }else{
            $this->session->set_flashdata('messageKO', 'The email address or password you entered is incorrect.<br>Please try again.');
            redirect('Visitor/Login');
        }
    }

    public function cookieSignin($id)
    {
        $data = $this->user_model->findUserById(xss_clean($id));

        if($data!= null)
        {
            $this->session->set_userdata('user_profile_id', $data[0]->id);
            $this->session->set_userdata('user_profile_name', $data[0]->name);
            $this->session->set_userdata('user_profile_email', $data[0]->email);
            $this->session->set_userdata('user_profile_premium', $data[0]->premium);
            $this->session->set_userdata('user_profile_lang', $data[0]->lang);

            redirect('Dashboard');
        }else{
            $this->login();
        }
    }

    public function updateVerificationCode($verificationCode, $email)
    {
        $user = new stdClass();
        $user->email = $email;
        $user->verificationCode = $verificationCode; 
        $userToUpdate = array($user);
        $this->user_model->updateUserEmail($userToUpdate);
    }

    public function updateCredentials()
    {
        $verificationCode = substr(str_shuffle(str_repeat($x='123456789ABCDEFGHJKMNPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);

        $mail = xss_clean($_POST['email']); // Déclaration de l'adresse de destination.
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
        {
            $passage_ligne = "\r\n";
        }
        else
        {
            $passage_ligne = "\n";
        }
        //=====Déclaration des messages au format texte et au format HTML.
        $message_txt = "Verification code : ".$verificationCode;
        $message_html = file_get_contents(base_url()."Email/emailVerification/".$verificationCode);
        //==========
        //=====Création de la boundary
        $boundary = "-----=".md5(rand());
        //==========

        //=====Définition du sujet.
        $sujet = "AutoMonitor Account Verification";
        //=========

        //=====Création du header de l'e-mail.
        $header = "From: \"Xavier GOUGAT\"<xaviergougat@gmail.com>".$passage_ligne;
        $header.= "Reply-to: \"Xavier GOUGAT\" <xaviergougat@gmail.com>".$passage_ligne;
        $header.= "MIME-Version: 1.0".$passage_ligne;
        $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
        //==========

        //=====Création du message.
        $message = $passage_ligne."--".$boundary.$passage_ligne;
        //=====Ajout du message au format texte.
        $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_txt.$passage_ligne;
        //==========
        $message.= $passage_ligne."--".$boundary.$passage_ligne;
        //=====Ajout du message au format HTML
        $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_html.$passage_ligne;
        //==========
        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
        //==========

        //=====Envoi de l'e-mail.
        mail($mail,$sujet,$message,$header);
        //==========
        $this->updateVerificationCode($verificationCode, $mail);
        $this->verificationCode($mail);

    }

    public function verificationCode($email)
    {
        $this->layout->set_titre('Verification Code');
        $this->data['emailCrypted'] = preg_replace('/(?:^|.@).\K|.\.[^@]*$(*SKIP)(*F)|.(?=.*?\.)/', '*', $email);
        $this->data['email'] = $email;
        $this->layout->visitor('verificationCodeVisitor.php', $this->data);
    }

    public function confirmVerificationCode()
    {
        $verificationCode = xss_clean(strtoupper($_POST['verificationCode']));
        $this->data['email'] = xss_clean($_POST['email']);
        $this->data['userDetails'] = $this->user_model->findUserByEmail($this->data['email']);

        if($verificationCode == $this->data['userDetails'][0]->verificationCode){
            $this->layout->visitor('visitorChange.php', $this->data);
        }else{
            $this->verificationCode($this->data['email']);
        }
    }

    public function updatePassword()
    {
        $user = new stdClass();
        $user->email = xss_clean($_POST['email']);
        $user->password = password_hash(xss_clean($_POST['password']), PASSWORD_DEFAULT); 
        $userToUpdate = array($user);
        $this->user_model->updateUserEmail($userToUpdate);
        $this->session->set_flashdata('messageOK', 'Your password has been updated.');
        redirect('Settings');

    }
}
