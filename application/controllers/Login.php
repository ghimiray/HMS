<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{


    public function check_login()
    {
        if (UID) USER_GROUP < 3 ? redirect("dashboard/") : redirect('my-account');
    }

    public function index()
    {
        $this->check_login();
        $viewdata = array();

        if ($this->input->post("username") && $this->input->post("password")) {
            $username = $this->input->post("username");
            $password = $this->input->post("password");
            $remember = $this->input->post("remember");
            if ($this->ion_auth->login($username, $password, $remember)) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('login/success', 'refresh');
            } else {
                $viewdata["error"] = true;
            }
        }
        $data = array('title' => 'Login - DB Hotel Management System', 'page' => 'login');
        $this->load->view('login', $viewdata);
    }


    public function success()
    {

        if (defined('UID') and UID) {
            if (USER_GROUP < 3) {
                redirect(base_url(getURL()), 'refresh');
            } else {
                if ($this->session->userdata('redirect') == 'reservation') {
                    if ($this->session->userdata('reservation')) {
                        redirect('rooms-and-reservations/checkout', 'refresh');

                    }
                } elseif ($this->session->userdata('redirect') == 'restaurant') {
                    if ($this->session->userdata('restaurant')) {
                        redirect('restaurant-and-menu/book', 'refresh');
                    }
                }
                redirect('my-account', 'refresh');
            }
        }
        redirect('login');
    }

    public
    function logout()
    {
        $this->ion_auth->logout();
        redirect("/");
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */