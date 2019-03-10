<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Require the bundled autoload file - the path may need to change
// based on where you downloaded and unzipped the SDK
require_once(APPPATH.'libraries/Twilio/autoload.php');
// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

class Monitor extends CI_Controller {
    public $monitored = 'blank';
    public $monitoredId = null;
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

        $this->load->database();
        $this->load->model(array('monitor_model','httpLogs_model','user_model','contact_model','notify_model'));
        $this->load->helper('security');
        $this->lang->load('theme', $this->session->userdata('user_profile_lang'));
        $this->lang->load('monitor', $this->session->userdata('user_profile_lang'));

        $this->data = null;
        //$this->data['contacts'] = $this->contact_model->findContactByUserId($this->session->userdata('user_profile_id'));
    }

    public function index()
    {
        $this->layout->set_titre($this->lang->line('monitors'));
        //$this->data['monitors'] = $this->monitor_model->getUserMonitors($this->session->userdata('user_profile_id'));
        $this->data['monitors'] = $this->monitor_model->getUserMonitorsStatus($this->session->userdata('user_profile_id'));
        $this->layout->view('monitors.php', $this->data);
    }

    public function viewMonitor($monitorId)
    {
        $this->data['monitor']=$this->monitor_model->getMonitorById($monitorId);
        $this->layout->set_titre('Monitor statistics');

        $this->data['uptime']=$this->httpLogs_model->overallUptime($monitorId);

        $this->data['avgLoad']=$this->httpLogs_model->overallAverageLoadtime($monitorId);
        $this->data['avgLoadDay']=$this->httpLogs_model->lastDayAverageLoadtime($monitorId);
        $this->data['avgLoadWeek']=$this->httpLogs_model->lastWeekAverageLoadtime($monitorId);
        $this->data['avgLoadNow']=$this->httpLogs_model->nowAverageLoadtime($monitorId);
        $this->data['lastLoad']=$this->httpLogs_model->getLastLoadTime($monitorId);
        $this->data['overallMaxLoadTime']=$this->httpLogs_model->getOverallLoadTime($monitorId, 'max');
        $this->data['overallMinLoadTime']=$this->httpLogs_model->getOverallLoadTime($monitorId, 'min');
        $this->data['monitorEvents']=$this->monitor_model->getMonitorEvents($monitorId);
        $i=0;
        $z=0;
        $datedujour = new DateTime();
        $hundredDaysPeriod = new DateInterval('P100D'); //period of 100 days
        $datemoins100 = new DateTime();
        $datemoins100 = $datemoins100->sub($hundredDaysPeriod);

        foreach ($this->data['monitorEvents'] as $event){
            if($event['statusLabel'] == 'down'){
                if($event['duration']==null){
                    $dateEvent = new DateTime($event['dateTime']);
                    $interval = $datedujour->diff($dateEvent)->days;
                    $this->data['monitorEventsDown'][$z]['percentStart'] = null;
                    $this->data['monitorEventsDown'][$z]['duration'] = null;
                    $this->data['monitorEventsDown'][$z]['dateTime'] = $event['dateTime'];
                    $this->data['monitorEventsDown'][$z]['follow'] = null;
                    $this->data['monitorEventsDown'][$z]['percent'] = $interval+1;
                    $this->data['monitorEventsDown'][$z]['interval'] = null;
                    $this->data['monitorEventsDown'][$z]['percentFinish'] = null;
                }else{
                    $date1 = new DateTime($event['dateTime']);
                    $date2 = new DateTime($event['dateTime']);
                    $date2->add(new DateInterval('PT'.$event['duration'].'S'));
                    if($date1->format('d')==$date2->format('d')){
                        $this->data['monitorEventsDown'][$z]['percentStart'] = null;
                        $this->data['monitorEventsDown'][$z]['duration'] = $event['duration'];
                        $this->data['monitorEventsDown'][$z]['dateTime'] = $event['dateTime'];
                        $this->data['monitorEventsDown'][$z]['follow'] = null;
                        $this->data['monitorEventsDown'][$z]['percent'] = 1;
                        $this->data['monitorEventsDown'][$z]['interval'] = null;
                        $this->data['monitorEventsDown'][$z]['percentFinish'] = null;
                    }else{
                        $this->data['monitorEventsDown'][$z]['percentStart'] = null;
                        $this->data['monitorEventsDown'][$z]['duration'] = $event['duration'];
                        $this->data['monitorEventsDown'][$z]['dateTime'] = $event['dateTime'];
                        $this->data['monitorEventsDown'][$z]['follow'] = null;
                        $this->data['monitorEventsDown'][$z]['percent'] = ceil($event['duration']/86400);
                        $this->data['monitorEventsDown'][$z]['interval'] = null;
                        $this->data['monitorEventsDown'][$z]['percentFinish'] = null;
                    }
                }                
                if($this->data['monitorEventsDown'][$z]['percent']==0){
                    $this->data['monitorEventsDown'][$z]['percent']=1;
                }
                $z++;
            }
            $days = 0;
            $minutes = 0;
            $hours = 0;

            if($event['duration'] >= 86400){
                $days = floor($event['duration'] / ( 24 * 60 * 60 ));
                $event['duration'] -= ( $days * ( 24 * 60 * 60 ) );
            }

            if($event['duration'] >= 3600){
                $hours = floor($event['duration'] / ( 60 * 60 ));
                $event['duration'] -= ( $hours * ( 60 * 60 ) );
            }

            $minutes = round($event['duration'] / 60);
            $event['duration'] -= ( $minutes * 60 );

            if($minutes==0 && $hours==0 && $days==0) {
                $date = new DateTime($event['dateTime']);
                $now = new DateTime();
                $this->data['monitorEvents'][$i]['duration'] = $date->diff($now)->days."d ".$date->diff($now)->format("%hh %im");
            }else{
                $this->data['monitorEvents'][$i]['duration'] = $days.'d '.$hours.'h '.$minutes.'m';
            }
            $i++;
        }

        if(isset($this->data['monitorEventsDown'])){
            $countDownEvents = count($this->data['monitorEventsDown']);
            $y = 1;
            foreach($this->data['monitorEventsDown'] as $eventDown){
                $datetime1 = new DateTime($eventDown['dateTime']);
                if($y == 1){
                    $interval = $datetime1->diff($datemoins100)->days;
                    $this->data['monitorEventsDown'][$y-1]['percentStart'] = $interval;
                }

                if($y == $countDownEvents && $this->data['monitorEventsDown'][$y-1]['duration']!=null){
                    $interval = $datetime1->diff($datedujour)->days;
                    $this->data['monitorEventsDown'][$y-1]['percentFinish'] = $interval;
                }

                if($countDownEvents > 1 && $y != $countDownEvents){
                    $datetime2 = new DateTime($this->data['monitorEventsDown'][$y]['dateTime']);
                    $interval = $datetime2->diff($datetime1)->days;
                    $day1 = $datetime1->format('d') ;
                    $day2 = $datetime2->format('d') ;
                    if($interval==1 && $day1-$day2<=1){
                        $this->data['monitorEventsDown'][$y-1]['follow'] = true;
                    }else{
                        $this->data['monitorEventsDown'][$y-1]['interval'] = $interval-1;
                    }
                }
                $y++;
            }
        }
        $this->data['lastDownTime'] = $this->monitor_model->getMonitorLastDownTime($monitorId);




        $contacts = $this->notify_model->getContactId($monitorId);
        $addresses = array();
        foreach($contacts as $contact){
            $result=$this->contact_model->findContactById($contact->contactId);
            $addresses[]=$result[0];
        }
        $this->data['addresses']=$addresses;

        $this->layout->view('view_monitor.php', $this->data);
    }

    public function addMonitor()
    {
        $this->load->helper(array('form', 'url'));
        $this->layout->set_titre('New monitor');
        $this->data['userDetails'] = $this->user_model->findUserById($this->session->userdata('user_profile_id'));
        $this->data['contacts'] = $this->contact_model->findContactByUserId($this->session->userdata('user_profile_id'));
        $this->layout->view('add_monitor.php', $this->data);
    }

    public function insertMonitor()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'monitor name', 'required|min_length[5]|max_length[30]',
                                          array(
                                              'required'      => 'You have not provided the %s.',
                                              'min_length'     => 'The %s should be 5 caracters min.',
                                              'max_lenght'      => 'The %s should be 30 caracters max.'
                                          ));
        $this->form_validation->set_rules('adress', 'monitor adress', 'required|min_length[5]|max_length[50]',
                                          array(
                                              'required'      => 'You have not provided the %s.',
                                              'min_length'     => 'The %s should be 5 caracters min.',
                                              'max_lenght'      => 'The %s should be 30 caracters max.'
                                          ));
        if ($this->form_validation->run() == TRUE)
        {
            $this->data['name'] = xss_clean($_POST['name']);
            $this->data['adress'] = xss_clean($_POST['adress']);
            $this->data['checkInterval'] = xss_clean($_POST['checkInterval']);
            $this->data['type'] = 1;
            $this->supervise = null;
            $this->supervise['monitorId']=$this->monitor_model->insertMonitor($this->data);
            $this->supervise['userId']=$this->session->userdata('user_profile_id');
            $this->monitor_model->insertSupervise($this->supervise);
            if(isset($_POST['contact']) && !empty($_POST['contact'])){
                foreach($_POST['contact'] as $notification){
                    $this->notify['contactId']=intval($notification);
                    $this->notify['monitorId']=$this->supervise['monitorId'];
                    $this->notify_model->insertNotify($this->notify);
                }
            }
            redirect('Monitor');
            echo $this->supervise['monitorId'];
        }else{
            $this->data['userDetails'] = $this->user_model->findUserById($this->session->userdata('user_profile_id'));
            $this->layout->view('add_monitor.php', $this->data);
        }
    }

    public function editMonitor($monitorId){
        $this->load->helper(array('form', 'url'));
        $this->data['monitor']=$this->monitor_model->getMonitorById($monitorId);
        $this->data['contacts'] = $this->contact_model->findContactByUserId($this->session->userdata('user_profile_id'));
        $notifications = $this->notify_model->getContactId($monitorId);
        $arrayNotifications = array();
        foreach($notifications as $notification){
            $arrayNotifications[]=$notification->contactId;
        }
        $this->data['notifications'] = $arrayNotifications;
        $this->layout->set_titre('Edit monitor');
        $this->layout->view('edit_monitor.php', $this->data);
    }

    public function updateMonitor($monitorId){
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'monitor name', 'required|min_length[5]|max_length[30]',
                                          array(
                                              'required'      => 'You have not provided the %s.',
                                              'min_length'     => 'The %s should be 5 caracters min.',
                                              'max_lenght'      => 'The %s should be 30 caracters max.'
                                          ));
        $this->form_validation->set_rules('adress', 'monitor adress', 'required|min_length[5]|max_length[50]',
                                          array(
                                              'required'      => 'You have not provided the %s.',
                                              'min_length'     => 'The %s should be 5 caracters min.',
                                              'max_lenght'      => 'The %s should be 30 caracters max.'
                                          ));
        $this->data['monitor']=$this->monitor_model->getMonitorById($monitorId);
        if ($this->form_validation->run() == TRUE)
        {
            $this->data['editMonitor'][0]['id'] = $monitorId;
            $this->data['editMonitor'][0]['name'] = xss_clean($_POST['name']);
            $this->data['editMonitor'][0]['adress'] = xss_clean($_POST['adress']);
            $this->data['editMonitor'][0]['type'] = 1;
            $this->monitor_model->updateMonitor($this->data['editMonitor']);
            $this->notify_model->deleteNotify($monitorId);
            if(!empty($_POST['contact'])){
                foreach($_POST['contact'] as $notification){
                    $this->notify['contactId']=intval($notification);
                    $this->notify['monitorId']=$monitorId;
                    $this->notify_model->insertNotify($this->notify);
                }
            }
            redirect('Monitor');
        }else{
            $this->editMonitor($monitorId);
        }

    }
    public function deleteMonitor(){
        $this->monitor_model->deleteMonitor($_POST['monitorId']);
        header('Content-Type: application/x-json; charset=utf-8');
        $result= 'success';
        echo json_encode($result);
    }

    public function rcurl($offset, $limit, $checkInterval){
        include APPPATH . 'third_party/Rollingcurl.php';
        include APPPATH . 'third_party/RollingCurlGroup.php';
        include APPPATH . 'third_party/TestCurlRequest.php';
        include APPPATH . 'third_party/TestCurlGroup.php';
        $this->load->helper('rollingcurl');
        $this->data['monitors'] = $this->monitor_model->getMonitorsWithInterval($offset, $limit,$checkInterval);
        $s = microtime(true);
        rcurl_domains($this->data['monitors']);
        print "<br />".date("d-m-Y")." ".date("H:i")." - ".round(microtime(true) - $s, 4)." seconds";
    }

    public function insertLogs($data, $request){
        if($data["http_code"]!=0){
            $toinsert = array();
            $toinsert['statusCode'] = $data["http_code"];
            $parseurl = parse_url($request->url);
            parse_str($parseurl['query'], $query);
            $toinsert['url'] = $parseurl['path'];
            $toinsert['loadTime'] = $data["total_time"];
            $toinsert['monitorId'] = $query['monitorid'];

            $this->data['addresses'] = null;
            $contacts = $this->notify_model->getContactId($toinsert['monitorId']);
            if(!empty($contacts)){
                foreach($contacts as $contact){
                    $result=$this->contact_model->findContactById($contact->contactId);
                    $addresses[]=$result[0];
                }
                $this->data['addresses']=$addresses;
            }
            
            $this->data['lastLogs'] = $this->httpLogs_model->getLastLog($toinsert['monitorId']);
            $this->data['logs'] = $this->httpLogs_model->insertHttpLogs($toinsert);
            $this->data['downCodes'] = $this->httpLogs_model->getDownCodes();
            $userId = $this->monitor_model->getUserByMonitor($this->data['logs']->monitorId);
            $userInfos = $this->user_model->findUserById($userId[0]['userId']);
                
            if(strtotime($userInfos[0]->premiumEndDate) < strtotime('now')){
                echo "Passage dans le IF<br>";
                $this->data['editIntervalMonitor'][0]['id'] = $this->data['logs']->monitorId;
                $this->data['editIntervalMonitor'][0]['checkInterval'] = 5;
                $this->monitor_model->updateMonitor($this->data['editIntervalMonitor']);  
            }
            
            echo $this->data['lastLogs']->code."vs".$toinsert['statusCode'];
            
            $string_down = json_encode($this->data['downCodes']);

            if($this->data['lastLogs']->code != $toinsert['statusCode']){                
                $userDetails = $this->user_model->findUserById($userId[0]['userId']);
                $mail = $userDetails[0]->email; // Déclaration de l'adresse de destination.
                if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
                {
                    $passage_ligne = "\r\n";
                }
                else
                {
                    $passage_ligne = "\n";
                }
                if(strpos($string_down,'"'.(string)$data["http_code"].'"') != false){
                    echo "Passage dans le if";

                    //=====Déclaration des messages au format texte et au format HTML.
                    $message_txt = "Alert monitor : ".$toinsert['url'];
                    $message_html = file_get_contents(base_url()."Email/emailDown/".$this->data['logs']->monitorId.'/'.$userDetails[0]->lang);
                    //=====Définition du sujet.
                    $sujet = "AutoMonitor - Down alert";
                    if($userDetails[0]->smsCount > 0){
                        // Your Account SID and Auth Token from twilio.com/console
                        try{
                            $sid = 'AC7e948c1f01708174f8cbc90f2c836c17';
                            $token = '2f94eaea249902701f221b74c9ee80ca';
                            $client = new Client($sid, $token);
                            $clientPhone = '+'.$userDetails[0]->countryCode.ltrim($userDetails[0]->phoneNumber, '0');
                            // Use the client to do fun stuff like send text messages!
                            echo "envoi SMS à : ".$clientPhone;
                            $client->messages->create(
                                // the number you'd like to send the message to
                                //'+33627740107',
                                $clientPhone,
                                array(
                                    // A Twilio phone number you purchased at twilio.com/console
                                    'from' => '+33757919287',
                                    // the body of the text message you'd like to send
                                    'body' => "Alerte ! ".$toinsert['url']." subit actuellement une défaillance et est injoignable (erreur ".$data['http_code']."). Connectez-vous sur AutoMonitor.io pour plus d'informations."
                                )
                            );
                            $this->user_model->addSmsToUser($userDetails[0]->id,'-1');
                            //$contacts = $this->notify_model->getContactId($this->data['logs']->monitorId);
                            //$addresses = $this->contact_model->getAddresses($contact);

                        }catch (Exception $e){
                        }

                        if($this->data['addresses']!=null){
                            foreach($this->data['addresses'] as $address){
                                if($address['type']=='sms' && $userDetails[0]->smsCount > 0){
                                    try{
                                        $sid = 'AC7e948c1f01708174f8cbc90f2c836c17';
                                        $token = '2f94eaea249902701f221b74c9ee80ca';
                                        $client = new Client($sid, $token);
                                        $clientPhone = '+'.$userDetails[0]->countryCode.ltrim($address['address'], '0');
                                        // Use the client to do fun stuff like send text messages!
                                        $client->messages->create(
                                            // the number you'd like to send the message to
                                            //'+33627740107',
                                            $clientPhone,
                                            array(
                                                // A Twilio phone number you purchased at twilio.com/console
                                                'from' => '+33757919287',
                                                // the body of the text message you'd like to send
                                                'body' => "Alerte ! ".$toinsert['url']." subit actuellement une défaillance et est injoignable (erreur ".$data['http_code']."). Connectez-vous sur AutoMonitor.io pour plus d'informations."
                                            )
                                        );
                                        $this->user_model->addSmsToUser($userDetails[0]->id,'-1');
                                        //$contacts = $this->notify_model->getContactId($this->data['logs']->monitorId);
                                        //$addresses = $this->contact_model->getAddresses($contact);

                                    }catch (Exception $e){
                                    }
                                }
                            }
                        }
                    }
                }else{
                    $this->data['editMonitor'][0]['id'] = $this->data['logs']->monitorId;
                    $this->data['editMonitor'][0]['status'] = 'up';
                    $this->monitor_model->updateMonitor($this->data['editMonitor']);
                    //=====Déclaration des messages au format texte et au format HTML.
                    $message_txt = "Alert monitor : ".$toinsert['url'];
                    $message_html = file_get_contents(base_url()."Email/emailUp/".$this->data['logs']->monitorId.'/'.$userDetails[0]->lang);
                    //=====Définition du sujet.
                    $sujet = "AutoMonitor - Up alert";
                    //=========
                }
                //==========
                //=====Création de la boundary
                $boundary = "-----=".md5(rand());
                //==========



                //=====Création du header de l'e-mail.
                $header = "From: \"AutoMonitor\"<feedback@cooptr.com>".$passage_ligne;
                $header.= "Reply-to: \"AutoMonitor\" <feedback@cooptr.com>".$passage_ligne;
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
                if(strpos($string_down,'"'.(string)$data["http_code"].'"') == false && strpos($string_down,'"'.(string)$this->data['lastLogs']->code.'"') == false){
                    exit();  
                }

                mail($mail,$sujet,$message,$header);
                
                if($this->data['addresses']!=null){
                    foreach($this->data['addresses'] as $address){
                        if($address['type']=='mail'){
                            mail($address['address'],$sujet,$message,$header);
                        }
                    }
                }
            }
        }
    }

    public function monitoredId($data){
        $this->monitoredId = $data;
    }

    public function refreshDate()
    {
        $this->monitor_model->refreshDate();
    }
    public function alertMail(){
        $this->load->library('email');

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'xaviergougat@gmail.com', // change it to yours
            'smtp_pass' => 'fp5315!Chromie', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $message = 'Kikoo';
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('xaviergougat@gmail.com'); // change it to yours
        $this->email->to('xaviergougat@gmail.com');// change it to yours
        $this->email->subject('Alert notification');
        $this->email->message($message);
        if($this->email->send())
        {
            echo 'Email sent.';
        }
        else
        {
            show_error($this->email->print_debugger());
        }
    }
}
