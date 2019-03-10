<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check extends CI_Controller {

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

        $this->load->database();
        $this->load->model(array('monitor_model'));

        $this->data = null;
    }

    public function checkMonitor($monitorId){
        $url = $this->monitor_model->getMonitorById($monitorId);
        $url = $url[0]['monitorAdress'];
        $infos = $this->check_http($url,'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
        header('Content-Type: application/json');
        echo $infos;
    }

    private function check_http($url, $userAgent){
        /*POST fields we'll be sending.*/
        /*$postFields = array();*/

        /*Initiate cURL*/
        $ch = curl_init();

        /*Setup some of our options.   */     
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
        /*curl_setopt($ch, CURLOPT_POST, true);*/
        /*curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));*/
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_USERAGENT, $userAgent);

        /*Execute the cURL request. */       
        $result = curl_exec($ch);

        /*Get the resulting HTTP status code from the cURL handle.*/
        $info = curl_getinfo($ch);

        /*Close cURL handle*/
        curl_close($ch);

        /*Dump HTTP status code out onto the screen*/
        return json_encode($info);
    }
}
