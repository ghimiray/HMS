<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transport extends CI_Controller {


    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->_data['dept_id'] = 8;
        $this->_data['page'] = 'transport';
    }
    public function index(){
        check_login(2, $this->_data['dept_id']);

        $this->_data['vehicles'] = $this->transport_m->getTransportDetail();
        $this->_data['title'] = 'Transport - Kathmandu Hotel';

        $this->load->view('header', $this->_data);
        $this->load->view('transport/list');
        $this->load->view('footer');
    }
    public function add(){
        if($this->input->post('create')){
            $data['type'] = $this->input->post('type');
            $data['number'] = $this->input->post('number');
            $data['color'] = $this->input->post('color');
            $data['seats'] = $this->input->post('seats');
            $data['price'] = $this->input->post('price');
            $this->transport_m->addVehicle($data);
            redirect(base_url('transport'));
        } else {
            $this->load->view('header', $this->_data);
            $this->load->view('transport/add');
            $this->load->view('footer');
        }
    }

    public function edit(){
        $edit_id = $this->uri->segment(3,0);
        if(!$edit_id) redirect('transport');
        if($this->input->post('save')){
            $data['type'] = $this->input->post('type');
            $data['number'] = $this->input->post('number');
            $data['color'] = $this->input->post('color');
            $data['seats'] = $this->input->post('seats');
            $data['price'] = $this->input->post('price');
            $this->transport_m->editVehicle($edit_id,$data);
            redirect(base_url('transport'));
        } else {
            $this->_data['vehicle'] = $this->transport_m->getVehicle($edit_id);
            $this->load->view('header', $this->_data);
            $this->load->view('transport/edit');
            $this->load->view('footer');
        }
    }
    public function delete(){
        $delete_id = $this->uri->segment(3,0);
        if(!$delete_id) redirect('transport');
        $this->transport_m->deleteVehicle($delete_id);
        redirect(base_url('transport'));
    }

}

