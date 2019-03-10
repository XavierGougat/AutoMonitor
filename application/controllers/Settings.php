<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

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
        $this->output->enable_profiler(TRUE);

        if(!is_logged_in())  // if you add in constructor no need write each function in above controller. 
        {
            redirect('Visitor/Login');
        }
        $this->load->database();
        $this->load->helper(array('url','security','form'));
        $this->load->model(array('user_model','country_model', 'contact_model'));
        $this->lang->load('theme', $this->session->userdata('user_profile_lang'));
        $this->lang->load('theme', $this->session->userdata('user_profile_lang'));
        $this->lang->load('settings', $this->session->userdata('user_profile_lang'));
        $this->data = null;
    }

    public function index()
    {
        $this->layout->set_titre($this->lang->line('settings'));

        $this->data['subscriptions'] = null;
        $this->data['userDetails'] = $this->user_model->findUserById($this->session->userdata('user_profile_id'));
        $this->data['countryCodes'] = $this->country_model->getCountryCodes();
        $this->data['contacts'] = $this->contact_model->findContactByUserId($this->session->userdata('user_profile_id'));

        require_once(APPPATH.'libraries/stripe/init.php');

        if($this->data['userDetails'][0]->stripeCustomerId != null)
        {
            $stripe = array(
                "secret_key"      => "sk_test_Ze8mATJOumf3yxkTE3FiC14D",
                "publishable_key" => "pk_test_fs8tzZ7R0LPh5mvNOgdlk0Zu"
            );

            \Stripe\Stripe::setApiKey($stripe['secret_key']);

            $subscriptions = \Stripe\Subscription::all(array('customer'=>$this->data['userDetails'][0]->stripeCustomerId));
            $this->data['subscriptions'] = $subscriptions->__toArray(true);
        }

        $this->layout->view('settings.php', $this->data);
    }

    public function update()
    {
        $user = new stdClass();
        $user->id = $this->session->userdata('user_profile_id');
        $user->name = xss_clean($_POST['name']); 
        $user->countryCode = xss_clean($_POST['countryCode']); 
        $user->phoneNumber = xss_clean($_POST['phoneNumber']); 
        $userToUpdate = array($user);
        $this->user_model->updateUser($userToUpdate);
        $this->session->set_flashdata('messageOK', 'Your profile has been updated.');
        redirect('Settings');

    }

    public function updatePassword()
    {
        $user = new stdClass();
        $user->id = $this->session->userdata('user_profile_id');
        $user->password = password_hash(xss_clean($_POST['password']), PASSWORD_DEFAULT); 
        $userToUpdate = array($user);
        $this->user_model->updateUser($userToUpdate);
        $this->session->set_flashdata('messageOK', 'Your password has been updated.');
        redirect('Settings');

    }

    public function updateEmail()
    {
        $user = new stdClass();
        $user->id = $this->session->userdata('user_profile_id');
        $user->email = xss_clean($_POST['email']); 
        $userToUpdate = array($user);
        $this->user_model->updateUser($userToUpdate);
        $this->session->set_flashdata('messageOK', 'Your email has been updated.');
        redirect('Settings');

    }


    public function updateVerificationCode($verificationCode)
    {
        $user = new stdClass();
        $user->id = $this->session->userdata('user_profile_id');
        $user->verificationCode = $verificationCode; 
        $userToUpdate = array($user);
        $this->user_model->updateUser($userToUpdate);
    }

    public function updateCredentials($change)
    {
        $verificationCode = substr(str_shuffle(str_repeat($x='123456789ABCDEFGHJKMNPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);

        $mail = $this->session->userdata('user_profile_email'); // Déclaration de l'adresse de destination.
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
        $this->updateVerificationCode($verificationCode);
        redirect('Settings/verificationCode/'.$change);

    }

    public function verificationCode($change)
    {
        $this->layout->set_titre('Verification Code');
        $email = $this->session->userdata('user_profile_email');
        $this->data['email'] = preg_replace('/(?:^|.@).\K|.\.[^@]*$(*SKIP)(*F)|.(?=.*?\.)/', '*', $email);
        $this->data['change'] = $change;
        $this->layout->view('verificationCode.php', $this->data);
    }

    public function confirmVerificationCode($change)
    {
        $verificationCode = xss_clean(strtoupper($_POST['verificationCode']));
        $this->data['userDetails'] = $this->user_model->findUserById($this->session->userdata('user_profile_id'));

        if($verificationCode == $this->data['userDetails'][0]->verificationCode){
            $this->layout->view($change.'Change.php', $this->data);
        }else{
            $this->verificationCode($change);
        }
    }

    public function cardUpdate()
    {
        $this->layout->set_titre('Mettez à jour votre carte de paiement.');
        $this->layout->view('card_update.php');
    }

    public function newCard()
    {

        require_once(APPPATH.'libraries/stripe/init.php');
        \Stripe\Stripe::setApiKey("sk_test_Ze8mATJOumf3yxkTE3FiC14D");

        $this->data['userDetails'] = $this->user_model->findUserById($this->session->userdata('user_profile_id'));

        if (isset($_POST['stripeToken'])){
            try {
                $cu = \Stripe\Customer::retrieve($this->data['userDetails'][0]->stripeCustomerId); // stored in your application
                $cu->source = $_POST['stripeToken']; // obtained with Checkout
                $cu->save();

                $cu = \Stripe\Customer::retrieve($this->data['userDetails'][0]->stripeCustomerId);

                $userPay = new stdClass();
                $userPay->id = $this->session->userdata('user_profile_id');
                $userPay->cardLast4 = $cu->sources->data[0]->last4;
                $userPay->cardBrand = $cu->sources->data[0]->brand;

                if($userPay->cardBrand=="American Express"){$userPay->cardBrand = "amex";}
                if($userPay->cardBrand=="Diners Club"){$userPay->cardBrand = "diners-club";}

                $userCard = array($userPay);
                $this->user_model->updateUser($userCard);

                $this->session->set_flashdata('messageOK', 'Your card has been updated.');
                redirect('Settings');
            }
            catch(\Stripe\Error\Card $e) {

                // Use the variable $error to save any errors
                // To be displayed to the customer later in the page
                $body = $e->getJsonBody();
                $err  = $body['error'];
                $error = $err['message'];
                echo $error;
            }
        }
    }
    
    function match_phone($str){
        $userDetails = $this->user_model->findUserById($this->session->userdata('user_profile_id'));
        if($str==$userDetails[0]->phoneNumber){
            return false;
        }else{
            return true;
        }
        
    }
    
    function match_mail($str){
        $userDetails = $this->user_model->findUserById($this->session->userdata('user_profile_id'));
        if($str==$userDetails[0]->email){
            return false;
        }else{
            return true;
        }
        
    }

    public function addContact()
    {
        $userDetails = $this->user_model->findUserById($this->session->userdata('user_profile_id'));
        $this->load->library('form_validation');
        $this->data['address'] = xss_clean($_POST['address']);
        $this->data['type'] = xss_clean($_POST['type']);
        $this->data['userId']=$this->session->userdata('user_profile_id');
        if($this->data['type']=="mail"){
            $this->form_validation->set_rules('address', 'address',            'trim|min_length[5]|valid_email|required|callback_match_mail',
                                              array(
                                                  'required'      => 'L\'%s est obligatoire.',
                                                  'min_length'     => 'L\'%s doit être composé d\'au moins 5 caractères.',
                                                  'valid_email'   => 'L\'%s n\'est pas valide.',
                                                  'match_mail' => 'Vous recevez déjà les notifications sur ce mail.'
                                              ));
        }else{
            $this->form_validation->set_rules('address', 'address',            'trim|numeric|min_length[9]|required|callback_match_phone',
                                              array(
                                                  'required'      => 'L\'%s est obligatoire.',
                                                  'numeric'       => 'L\'%s doit être composé de chiffres uniquement.',
                                                  'min_length'     => 'L\'%s doit être composé d\'au moins 9 caractères.',
                                                  'match_phone' => 'Vous recevez déjà les notifications sur ce numéro.'
                                              ));
        }

        if (($this->form_validation->run() == TRUE))
        {
            $this->contact_model->insertContact($this->data);
            $this->session->set_flashdata('messageOK', 'Contact '.$this->data['address'].' succesfuly added.');
            redirect("Settings");
        }else{
            $this->index();
        }
    }
    
    public function deleteContact(){
        $this->contact_model->deleteContact($_POST['contactId']);
        header('Content-Type: application/x-json; charset=utf-8');
        $result= 'success';
        echo json_encode($result);
    }
}
