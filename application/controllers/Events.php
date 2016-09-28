<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {
    private $_data = array();
    public function  __construct()
    {
        parent::__construct();
        $this->_data['dept_id'] = 10;
    }

    public function index(){
        check_login(2,$this->_data['dept_id']);

        $events = $this->events_m->getEventsDetail();

        $viewdata = array('events' => $events);

        $data = array('title' => 'Events Hall - Kathmandu Hotel', 'page' => 'events');
        $this->load->view('header', $data);
        $this->load->view('events/list',$viewdata);
        $this->load->view('footer');

    }


}

