<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HttpLogs extends CI_Controller {
    public $monitored = 'blank';
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

        $this->load->database();
        $this->load->model(array('httpLogs_model'));
        $this->data = null;
    }

    public function index()
    {
        $this->layout->set_titre('Monitors Overview');
        $this->data['monitors'] = $this->monitor_model->getUserMonitors(1);
        $this->layout->view('monitors.php', $this->data);
    }
    
    
}
