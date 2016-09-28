<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reservation extends CI_Controller
{

    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->_data['dept_id'] = 3;
    }

    public function check($ref = "")
    {

        check_login(2, $this->_data['dept_id']);

        $post = $this->input->post();

        $customer = $this->user_m->findCustomerByEmail($post['email']);

        $viewdata = array();

        $data = array('title' => 'Reservation :: Kathmandu Hotel', 'page' => 'reservation');

        $this->load->view('header', $data);

        if (!$customer) {
            $viewdata['error'] = "Customer does not exist";
        } else {
            $filter = new stdClass();
            $filter->checkin = $post['checkin_date'];
            $filter->checkout = $post['checkout_date'];
            $filter->room_type = $post['room_type'];
            $rooms = $this->reservation_m->getBookableRooms($filter);
            if (!$rooms) {
                $viewdata['error'] = "No available rooms";
            }
        }
        if (isset($viewdata['error'])) {
            $room_types = $this->room_m->get_room_types();
            $viewdata['room_types'] = $room_types;
            $this->load->view('reservation/add', $viewdata);
        } else {
            $viewdata['rooms'] = $rooms;
            $viewdata['email'] = $post['email'];
            $viewdata['checkin_date'] = $post['checkin_date'];
            $viewdata['checkout_date'] = $post['checkout_date'];
            $viewdata['room_type'] = $post['room_type'];
            $this->load->view('reservation/list', $viewdata);
        }

        $this->load->view('footer');

    }

    public function index()
    {
        check_login(2, $this->_data['dept_id']);

        $room_types = $this->room_m->get_room_types();
        $viewdata = array('room_types' => $room_types);
        $viewdata['reserved_rooms'] = $this->reservation_m->getAllBookedRooms();
        $data = array('title' => 'Reservation - Kathmandu Hotel', 'page' => 'reservation');
        $this->load->view('header', $data);
        $this->load->view('reservation/add', $viewdata);
        $this->load->view('footer');
    }

    public function make()
    {
        check_login(2, $this->_data['dept_id']);

        $post = $this->input->post();

        $customer = $this->user_m->findCustomerByEmail($post['email']);
        $viewdata = array();
        $data = array();
        $data['customer_id'] = $customer->id;
        $data['room_id'] = $post['room_id'];
        $data['checkin_date'] = $post['checkin_date'];
        $data['checkout_date'] = $post['checkout_date'];
        $data['employee_id'] = UID;

        $date = new DateTime();
        $date_s = $date->format('Y-m-d');
        if ($date_s > $data['checkin_date']) {
            $viewdata['error'] = "Checkin can't be before then today";
        } else {
            $this->reservation_m->add_reservation($data);
            $this->room_m->add_room_sale($data, $date_s);
            $viewdata['success'] = 'Reservation successfully made';
        }

        $room_types = $this->room_m->get_room_types();
        $viewdata['room_types'] = $room_types;

        $data = array('title' => 'Reservation - DB Hotel Management System', 'page' => 'reservation');
        $this->load->view('header', $data);
        $this->load->view('reservation/add', $viewdata);
        $this->load->view('footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */