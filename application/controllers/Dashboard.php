<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

        if(!is_logged_in())  // if you add in constructor no need write each function in above controller. 
        {
            redirect('Visitor/Login');
        }
        $this->load->database();
        $this->load->model(array('monitor_model', 'httpLogs_model', 'user_model'));
        $this->load->helper(array('url'));

        $this->lang->load('dashboard', $this->session->userdata('user_profile_lang'));
        $this->lang->load('theme', $this->session->userdata('user_profile_lang'));


        $this->data = null;
        $this->data['userId'] = $this->session->userdata('user_profile_id');  
    }

    public function index()
    {
        $this->layout->set_titre($this->lang->line('dashboard'));
        $this->data['monitors'] = $this->monitor_model->getUserMonitors($this->data['userId']);
        $this->data['monitorsUp'] = $this->monitor_model->getUserMonitorsUpStatus($this->data['userId']);
        $this->data['monitorsDown'] = $this->monitor_model->getUserMonitorsDownStatus($this->data['userId']);
        $this->data['lastDownTime'] = $this->monitor_model->getUserMonitorsLastDownTime($this->data['userId']);
        $this->data['monitorEvents']=$this->monitor_model->getUserMonitorsEvents($this->data['userId']);
        $i=0;
        foreach ($this->data['monitorEvents'] as $event){
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
                $this->data['monitorEvents'][$i]['duration'] = $date->diff($now)->format("%dd %hh %im");
            }else{
                $this->data['monitorEvents'][$i]['duration'] = $days.'d '.$hours.'h '.$minutes.'m';
            }
            $i++;
        }
        $time = date("Y-m-d H:i:s");
        $overallDuration = $this->httpLogs_model->getOverallDuration($this->data['userId']);
        $overallUpDuration = $this->httpLogs_model->getOverallUpDuration($this->data['userId']);
        $dayDuration = $this->httpLogs_model->getDayDuration($this->data['userId']);
        $dayUpDuration = $this->httpLogs_model->getDayUpDuration($this->data['userId']);
        $weekDuration = $this->httpLogs_model->getWeekDuration($this->data['userId']);
        $weekUpDuration = $this->httpLogs_model->getWeekUpDuration($this->data['userId']);
        $monthDuration = $this->httpLogs_model->getMonthDuration($this->data['userId']);
        $monthUpDuration = $this->httpLogs_model->getMonthUpDuration($this->data['userId']);
        $this->data['overallUptimeUser']= 0;
        $this->data['dayUptimeUser']= 0;
        $this->data['weekUptimeUser']= 0;
        $this->data['monthUptimeUser']= 0;
        if($overallUpDuration['Duration'] != null && $overallUpDuration['Duration']>0){
            $this->data['overallUptimeUser']=100/((float)$overallDuration['Duration']/(float)$overallUpDuration['Duration']);
        }

        if($monthUpDuration['Duration'] != null && $overallUpDuration['Duration']>0){
            $this->data['monthUptimeUser']=100/((float)$monthDuration['Duration']/(float)$monthUpDuration['Duration']);
        }
        if($weekUpDuration['Duration'] != null && $overallUpDuration['Duration']>0){
            $this->data['weekUptimeUser']=100/((float)$weekDuration['Duration']/(float)$weekUpDuration['Duration']);
        }
        if($dayUpDuration['Duration'] != null && $overallUpDuration['Duration']>0){
            $this->data['dayUptimeUser']=100/((float)$dayDuration['Duration']/(float)$dayUpDuration['Duration']);
        }

        $this->layout->view('index.php', $this->data);
    }

    public function pricing()
    {
        $this->layout->set_titre('Pricing');
        $this->layout->view('pricing.php');
    }

    public function english(){
        $this->session->set_userdata('user_profile_lang',"english");
        $user = new stdClass();
        $user->id = $this->session->userdata('user_profile_id');
        $user->lang = $this->session->userdata('user_profile_lang');
        $userLang = array($user);
        $this->user_model->updateUser($userLang);
        redirect('Dashboard');
    }

    public function french(){
        $this->session->set_userdata('user_profile_lang',"french");
        $user = new stdClass();
        $user->id = $this->session->userdata('user_profile_id');
        $user->lang = $this->session->userdata('user_profile_lang');
        $userLang = array($user);
        $this->user_model->updateUser($userLang);
        redirect('Dashboard');
    }
}
