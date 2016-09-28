<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller
{
    private $_data;

    public function __construct()
    {
        parent::__construct();
        $this->_data['site_title'] = "Hotel Management System";
        $this->load->model('frontend_m', 'fm');
        $this->load->model('configuration_m', 'cm');
        $this->_data['company'] = $this->cm->getAllConfigData();
        $this->_data['services'] = ['restaurant', 'room', 'transport'];
    }

    public function index()
    {
        $this->_renderUI('index', 'slider');
    }

    public function booking()
    {
        $booking_service = $this->uri->segment(2);
        if ($booking_service and in_array($booking_service, $this->_data['services'])) {
            $this->_renderUI('book_' . $booking_service);
        } else $this->_renderUI('booking');
    }

    public function about()
    {
        $this->_renderUI('about');
    }

    public function reservation()
    {
        $this->_data['check'] = false;
        $this->_data['rooms'] = $this->room_m->getRoomsWithTypes();
        $this->_renderUI('reservation');
    }

    public function checkReservation()
    {
        $this->_data['check'] = true;
        $filter = new stdClass();
        $filter->checkin = $this->input->get('checkin');
        $filter->checkout = $this->input->get('checkout');
        $filter->room_type = $this->input->get('room_type');
        $this->session->set_userdata('redirect', 'reservation');
        $this->session->set_userdata('reservation', false);
        if(((int) str_replace("-","",$filter->checkout) - (int) str_replace("-","",$filter->checkin))<0){
            $this->session->set_flashdata('message', 'Checkout Date Cannot be before Checkin.');
            redirect(base_url('rooms-and-reservations'));
        }
        if(((int) str_replace("-","",$filter->checkin) - (int) date('Ymd'))<0){
            $this->session->set_flashdata('message', 'Your checkin date cannot be before today.');
            redirect(base_url('rooms-and-reservations'));
        }



        $this->_data['bookable_rooms'] = $this->reservation_m->getBookableRooms($filter);

        $this->_data['filter'] = (array)$filter;

        $this->_data['rooms'] = $this->room_m->getRoomsWithTypes();
        $this->_renderUI('reservation');
    }


    public function makeReservation()
    {

        $reserved_rooms = array();
        if ($this->input->post('room')) {
            $rooms = array_keys($this->input->post('room'));
            $checkin = $this->input->post('checkin');
            $checkout = $this->input->post('checkout');
            $grand_total = 0;


            foreach ($rooms as $room) {

                $cid = new DateTime($checkin[$room]);
                $cod = new DateTime($checkout[$room]);
                
                


                $diff = $cid->diff($cod);
                $no_of_days = $diff->d;
                $room_detail = $this->reservation_m->getRoomDetail($room);

                $filter = new stdClass();
                $filter->room_type = $room_detail->room_type;
                $filter->checkin = $checkin[$room];
                $filter->checkout = $checkout[$room];
                $bookable_rooms = $this->reservation_m->getBookableRooms($filter);
                $br = array();
                foreach ($bookable_rooms as $b) {
                    $br[] = $b->room_id;
                }
                if (!in_array($room, $br)) {
                    $this->session->set_flashdata('message', 'One or more rooms you selected are not available. Please try again.');
                    redirect(base_url('rooms-and-reservations/check'));
                    break;
                }
                if(((int) str_replace("-","",$checkout[$room]) - (int) str_replace("-","",$checkin[$room]))<0){
                    $this->session->set_flashdata('message', 'Checkout Date Cannot be before Checkin.');
                    redirect(base_url('rooms-and-reservations/check'));
                    break;
                }
                if(((int) str_replace("-","",$checkin[$room]) - (int) date('Ymd'))<0){
                    $this->session->set_flashdata('message', 'Your checkin date cannot be before today.');
                    redirect(base_url('rooms-and-reservations/check'));
                    break;
                }


                $total_price = $no_of_days * $room_detail->room_price;
                $grand_total += $total_price;
                $reserved_rooms[$room] = [
                    'checkin' => $checkin[$room],
                    'checkout' => $checkout[$room],
                    'room_type' => $room_detail->room_type,
                    'room_price' => $room_detail->room_price,
                    'no_of_days' => $no_of_days,
                    'total_price' => $total_price
                ];
            }
            $reserved_rooms['grand_total'] = $grand_total;
            $this->session->set_userdata('reservation', $reserved_rooms);


        } elseif ($this->session->userdata('reservation')) {
            $reserved_rooms = $this->session->userdata('reservation');
        }

        if (empty($reserved_rooms)) {
            $this->session->set_flashdata('message', 'Please select the rooms');
            redirect(base_url('rooms-and-reservations/check'));
        }
        if (!UID) {
            $this->session->set_flashdata('message', 'To complete your reservation, Please login or <a href="' . base_url('register') . '">Create New Account</a>');
            $this->session->set_userdata['reservation'] = $reserved_rooms;
            redirect(base_url('login'));
        }

        $this->_data['reserved_rooms'] = $reserved_rooms;

        $this->_renderUI('make_reservation');

    }

    public function checkoutReservation()
    {
        $reserved_rooms = array();

        if ($this->session->userdata('reservation')) {

            $reserved_rooms = $this->session->userdata('reservation');
        }

        if ($this->session->flashdata('payment') == 'success') {

            $this->session->unset_userdata('reservation');

        }

        if (empty($reserved_rooms)) {

            $this->session->set_flashdata('message', 'Please select the rooms');

            redirect(base_url('rooms-and-reservations/check'));
        }

        if (!UID) {

            $this->session->set_flashdata('message', 'To complete your reservation, Please login or <a href="' . base_url('register') . '">Create New Account</a>');

            $this->session->set_userdata['reservation'] = $reserved_rooms;

            redirect(base_url('login'));
        }


    }

    public function transportation()
    {
        $this->_data['check'] = false;
        $this->_data['transports'] = $this->transport_m->getTransportDetail();
        $this->_data['types'] = $this->transport_m->getTransportTypes();

        $this->_renderUI('transportation');

    }

    public function checkTransportation()
    {

        $this->_data['check'] = true;
        $filter = array();
        $filter['type'] = $this->input->get('type');
        $filter['start'] = $this->input->get('start');
        $filter['end'] = $this->input->get('end');
        if(((int) str_replace("-","",$filter['start']) - (int) date('Ymd'))<0){
            $this->session->set_flashdata('message', 'Your checkin date cannot be before today.');
            redirect(base_url('transportation-service'));
        }

        $this->_data['transports'] = $this->transport_m->getTransportDetail();
        $this->_data['types'] = $this->transport_m->getTransportTypes();
        $this->_data['bookable_vehicles'] = $this->transport_m->getBookableVehicles($filter);
        $this->_data['filter'] = $filter;
        $this->_renderUI('transportation');

    }

    public function CheckoutTransportation()
    {
        $booking = array();
        if ($this->input->post('checkout')) {
            $this->session->set_flashdata('message', 'Please select Vehicles');
            $this->session->set_userdata('redirect', 'transport');

            $vehicles = $this->input->post('vehicle');
            $start = $this->input->post('start');
            $end = $this->input->post('end');

            foreach ($vehicles as $id => $stat) {
                $booking[$id]['detail'] = $this->transport_m->getVehicle($id);
                $booking[$id]['start'] = $start[$id];
                $booking[$id]['end'] = $end[$id];
                if(((int) str_replace("-","",$booking[$id]['start']) - (int) date('Ymd'))<0){
                    $this->session->set_flashdata('message', 'Your checkin date cannot be before today.');
                    redirect(base_url('transportation-service'));
                }

            }

            $this->session->set_userdata('transports', $booking);
        }
        if ($this->session->userdata('transports')) {
            $booking = $this->session->userdata('transports');
        }

        if (!($booking)) {
            $this->session->set_flashdata('message', 'Please select Vehicles');
            redirect('transportation-service');
        }

        if (!UID) {
            $this->session->set_flashdata('message', 'Please Login to continue or <a href="' . base_url('register') . '">Create</a> new account.');
            redirect('login');
        }


        if ($this->input->post('confirm_book')) {
            $pkp = $this->input->post('pickup');
            $dst = $this->input->post('destination');

            foreach ($booking as $id => $book) {
                $data = array();
                $data['user_id'] = UID;
                $data['transport_id'] = $id;
                $data['pickup'] = $pkp[$id];
                $data['dropping'] = $dst[$id];
                $data['start_date'] = $book['start'];
                $data['end_date'] = $book['end'];
                $data['cost_per_day'] = $book['detail']->price;


                $this->transport_m->bookTransport($data);
            }
            
            $this->session->unset_userdata('transports');
            $this->session->set_userdata('transports',array());
            $this->session->set_flashdata('success', 'true');
            $this->session->set_flashdata('message', '<i class="icon-info-sign"></i> Your Booking Was Successful');
            redirect('transportation-service');

        }

        $this->_data['transports'] = $booking;

        $this->_data['types'] = $this->transport_m->getTransportTypes();

        $this->_renderUI('transportation_checkout');
    }

    public function parking()
    {
        $this->_renderUI('parking');
    }

    public function services()
    {
        $this->_renderUI('services');
    }

    public function contact()
    {
        $this->_renderUI('contact');
    }

    public function restaurant()
    {
        $this->_data['check'] = false;
        $this->_data['restaurants'] = $this->menu_m->getRestaurants();
        foreach ($this->_data['restaurants'] as $id => $r) {
            $this->_data['restaurants'][$id]->menu = $this->menu_m->getCategoriesAndMenus($r->restaurant_name);
        }
        $this->_renderUI('restaurant');
    }

    function checkRestaurant()
    {
        $this->_data['check'] = true;
        $filter = new stdClass();
        $filter->restaurant = $this->input->get('restaurant');
        $filter->date = $this->input->get('date');
        $filter->hh = $this->input->get('hour');
        $filter->mm = $this->input->get('minute');
        $this->session->set_userdata('redirect', 'restaurant');
        $this->session->set_userdata('restaurant', false);
        $this->_data['bookable_tables'] = $this->restaurant_m->findBookableTables($filter);
        $this->_data['filter'] = $filter;
        $this->_data['restaurants'] = $this->menu_m->getRestaurants();
        foreach ($this->_data['restaurants'] as $id => $r) {
            $this->_data['restaurants'][$id]->menu = $this->menu_m->getCategoriesAndMenus($r->restaurant_name);
        }
        $this->_renderUI('restaurant');
    }

    function bookRestaurant()
    {
        $booking_rooms = array();
        if ($this->input->post('book')) {
            $booking_rooms['date'] = $this->input->post('date');
            $booking_rooms['name'] = $this->input->post('restaurant');
            foreach ($this->input->post('table') as $table => $stat) {
                $booking_rooms['tables'][] = $table;
            }

            $this->session->set_userdata('restaurant', $booking_rooms);

        } elseif ($this->session->userdata('restaurant')) {

            $booking_rooms = $this->session->userdata('restaurant');

        }

        if (!isset($booking_rooms['tables']) or empty($booking_rooms['tables'])) {
            $this->session->set_flashdata('message', 'Please select the restaurant and tables');
            redirect(base_url('restaurant-and-menu'));
        }
        if (!UID) {
            $this->session->set_flashdata('message', 'To complete your table reservation, Please login or <a href="' . base_url('register') . '">Create New Account</a>');
            $this->session->set_userdata['restaurant'] = $booking_rooms;
            redirect(base_url('login'));
        }
        $this->_data['restaurant'] = $booking_rooms;
        $this->_renderUI('book_restaurant');
    }

    function confirmBookingRestaurant()
    {
        if ($this->session->flashdata('r_b_c')) {
            $this->_renderUI('book_restaurant');
        } else {
            if ($this->input->post('confirm_book')) {
                $this->_data['step'] = 'confirm';
                $data = $this->session->userdata('restaurant');
                if (!isset($data['tables']) or empty($data['tables'])) {
                    $this->session->set_flashdata('message', 'Please select the restaurant and tables');
                    redirect(base_url('restaurant-and-menu'));
                }
                foreach ($data['tables'] as $table) {
                    $this->_data['confirm'] = $this->restaurant_m->add_service($data['name'], UID, $data['date'], $table, 0);
                    $this->session->set_flashdata('r_b_c', true);
                    redirect(base_url('restaurant-and-menu/book/confirm'));
                }
                $this->_renderUI('book_restaurant');
            } else {
                $this->session->set_flashdata('message', 'Please select the restaurant and tables');
                redirect(base_url('restaurant-and-menu'));
            }
        }

    }

    public function hall()
    {
        $this->_renderUI('hall');
    }

    public function gym()
    {
        $this->_renderUI('gym');
    }

    public function laundry()
    {
        $this->_renderUI('laundry');
    }


    public function register()
    {
        if (UID) redirect('my-account');
        $this->_data['countries'] = $this->fm->getCountriesList();
        if (isset($_POST['register'])) {
            $params = array();
            if ($_POST['password'] == $_POST['password_re']) {
                $params['fname'] = $_POST['fname'];
                $params['lname'] = $_POST['lname'];
                $params['email'] = $_POST['email'];
                $params['contact'] = $_POST['contact'];
                $params['address'] = $_POST['address'];
                $params['country'] = $_POST['country'];
                $params['password'] = md5($_POST['password']);
                $params['password_raw'] = $_POST['password'];
                $params['is_activated'] = 1;
                $params['is_suspended'] = 0;

                $additional_data = [
                    'first_name' => $_POST['fname'],
                    'last_name' => $_POST['lname'],
                    'phone' => $_POST['contact'],
                    'address' => $_POST['address'],
                    'country' => $_POST['country'],
                    'password_raw' => $_POST['password'],
                    'employee' => 0,
                    'department_id' => 0,
                    'group_id' => 3
                ];
                $group_ids = [3];
                $user_id = $this->ion_auth->register($_POST['fname'], $_POST['password'], $_POST['email'], $additional_data, $group_ids);
                if ($user_id) {
                    if ($this->ion_auth->login($params['email'], $params['password_raw'], true)) {
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect('login/success', 'refresh');
                    } else {
                        $this->_data['_postdata'] = $_POST;
                    }
                } else {
                    $this->_data['_postdata'] = $_POST;
                }
            } else {
                $this->_data['_postdata'] = $_POST;
            }
        }

        $this->_renderUI('register');
    }

    public function dashboard()
    {
        if (!UID or !USER_GROUP) {
            redirect(base_url('login'));
            return false;
        } elseif (UID and USER_GROUP <= 2) {
            return $this->show_404();
        }
        $page = $this->uri->segment(2);
        $this->_data['d_page'] = $page;
        $valid_pages = array();
        $valid_pages[] = 'reservation';
        $valid_pages[] = 'transport';
        $valid_pages[] = 'restaurant';
        if($page){
            if(in_array($page,$valid_pages)){
                $this->_data['data'] = $this->fm->getUserReservationData(UID,$page);
                $this->_renderUI('d_'.$page);
            } elseif($page=='profile') {
                $this->_data['data'] = $this->user_m->getUserProfile(UID);
                $this->_renderUI('d_'.$page);
            } else {
                redirect('my-account');
            }
        } else {
            $this->_data['transport'] = $this->fm->getUserReservationData(UID,'transport');
            $this->_data['reservation'] = $this->fm->getUserReservationData(UID,'reservation');
            $this->_data['restaurant'] = $this->fm->getUserReservationData(UID,'restaurant');
            $this->_renderUI('dashboard');
        }
        
    }

    public function show_404()
    {
        $this->output->set_status_header('404');
        return $this->_renderUI('404');
    }

    function paymentSuccess()
    {
        $reservation_id = array();
        if ($this->input->post('auth')) {
            $reservation = $this->session->userdata('reservation');
            foreach ($reservation as $room => $res) {
                $r_data = [
                    'customer_id' => UID,
                    'room_id' => $room,
                    'checkin_date' => $res['checkin'],
                    'checkout_date' => $res['checkout'],
                    'employee_id' => 0,
                    'reservation_date' => date('Y-m-d H:i:s'),
                    'reservation_price' => $res['total_price'],

                ];
                $reservation_id[] = $this->reservation_m->add_reservation($r_data);
            }
            $p_data = [
                'user_id' => UID,
                'reservation_id' => implode(',', $reservation_id),
                'payer_name' => $this->input->post('first_name') . " " . $this->input->post('last_name'),
                'payer_email' => $this->input->post('payer_email'),
                'amount' => $this->input->post('payment_gross'),
                'currency' => $this->input->post('mc_currency'),
            ];
            if ($this->reservation_m->makePayment($p_data)) {
                $this->session->set_flashdata('payment', 'success');
                redirect(base_url('rooms-and-reservations/checkout'));
            } else {
                $this->session->set_flashdata('payment', 'fail');
                redirect(base_url('rooms-and-reservations/checkout'));
            }
        } else {
            $this->session->set_flashdata('message', 'Please select the rooms');

            redirect(base_url('rooms-and-reservations/check'));
        }
    }

    function paymentCancel()
    {

    }

    function paymentIPN()
    {
        $h = fopen('log.txt', 'a+');
        $data = $this->input->post();
        if (!$data) $data = [date('H:i:s'), 'Not Found'];
        $var = var_export($data, true);

        fwrite($h, $var . "\r\n");

        fclose($h);
    }

    private function _renderUI($page, $layout = false)
    {
        if (!$page) {
            redirect('/');
            return false;
        }

        $this->load->view('layouts/header', $this->_data);
        if ($layout) $this->load->view('layouts/' . $layout, $this->_data);
        $this->load->view('pages/' . $page, $this->_data);
        $this->load->view('layouts/footer', $this->_data);
        return true;
    }

}