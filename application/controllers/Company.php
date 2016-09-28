<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller
{

    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('configuration_m', 'cm');
        $fillables['information'] = [
            'name' => '',
            'slogan' => '',
            'established' => '',
            'address' => '',
            'city' => '',
            'country' => '',
            'contact_one' => '',
            'contact_two' => '',
            'service_email' => '',
            'contact_email' => '',
            'website' => '',
            'website_title' => '',
        ];
        $fillables['about'] = [
            'about_us' => '',
            'about_us_short' => '',
        ];
        $fillables['legal'] = [
            'privacy_policy' => '',
            'terms_condition' => '',
        ];
        $fillables['social'] = [
            'facebook' => '',
            'twitter' => '',
            'google' => '',
        ];
        
        $this->_data['dept_id'] = 1;

        $this->_data['fillables'] = $fillables;

        $this->_checkFillables();
    }


    private function _checkFillables()
    {
        foreach ($this->_data['fillables'] as $type => $data) {
            foreach ($data as $key => $value) {
                $this->_data['fillables'][$type][$key] = $this->cm->parseConfigByTypeAndKey($type, $key);
            }
        }
    }


    public function index()
    {
        check_login(2,$this->_data['dept_id']);
        $data = array('title' => 'Information - DB Hotel Management System', 'page' => 'company');
        $this->load->view('header', $data);
        $this->load->view('company/view', $this->_data);
        $this->load->view('footer');

    }

    public function edit()
    {
        check_login(2,$this->_data['dept_id']);

        if (isset($_POST['save'])) {
            foreach ($this->_data['fillables'] as $type => $data) {
                foreach ($data as $key => $value) {
                    $this->_data['fillables'][$type][$key] = $this->cm->parseConfigByTypeAndKey($type, $key, $_POST[$type][$key], true);
                }
            }
            redirect('company');
        }
        $data = array('title' => 'Edit Information - DB Hotel Management System', 'page' => 'company');
        $this->load->view('header', $data);
        $this->load->view('company/edit', $this->_data);
        $this->load->view('footer');
    }


}
