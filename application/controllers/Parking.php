<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parking extends CI_Controller {
    
    private $_data = array();
    public function  __construct()
    {
        parent::__construct();
        $this->_data['dept_id'] = 10;
    }

    public function index(){
        check_login(2,$this->_data['dept_id']);

        $parking = $this->parking_m->getParkingDetail();

        $viewdata = array('parking' => $parking);

        $data = array('title' => 'Parking - Kathmandu Hotel', 'page' => 'parking');
        $this->load->view('header', $data);
        $this->load->view('parking/list',$viewdata);
        $this->load->view('footer');

    }


}

