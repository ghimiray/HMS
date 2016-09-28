<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room_type extends CI_Controller {

	private $_data = array();

	public function __construct()
	{
		parent::__construct();
		$this->_data['dept_id'] = 4;
	}


	public function add()
	{
		check_login(2,$this->_data['dept_id']);

		$viewdata = array();

		if($this->input->post("type") && $this->input->post("price") /*&& $this->input->post("quantity")*/)
		{

			$type = $this->input->post("type");
			$price = $this->input->post("price");
			$details = $this->input->post("details");
			$quantity = $this->input->post("quantity");

			if(count($this->room_m->getRoomType($type))==0) {
				$this->room_m->addRoomType($type, $price, $details, $quantity);
				redirect("/room-type");
			}
			else {
				$viewdata['error'] = "Room type alread exists";
			}
		}

		$data = array('title' => 'Add Room Type - DB Hotel Management System', 'page' => 'room_type');
		$this->load->view('header', $data);
		$this->load->view('room-type/add', $viewdata);
		$this->load->view('footer');
	}

	function delete($room_type)
	{
		check_login(2,$this->_data['dept_id']);

		$this->room_m->deleteRoomType($room_type);
		redirect("/room-type");
	}

	public function edit($room_type)
	{
		check_login(2,$this->_data['dept_id']);

		if($this->input->post("type") && $this->input->post("price") /*&& $this->input->post("quantity")*/)
		{

			$type = $this->input->post("type");
			$price = $this->input->post("price");
			$details = $this->input->post("details");
			$quantity = $this->input->post("quantity");

			$this->room_m->editRoomType($type, $price, $details, $quantity);
			redirect("/room-type");
		}
		
		$data = array('title' => 'Edit Room Type - DB Hotel Management System', 'page' => 'room_type');
		$this->load->view('header', $data);

		$room_type = $this->room_m->getRoomType($room_type);
		
		$viewdata = array('room_type'  => $room_type[0]);
		$this->load->view('room-type/edit',$viewdata);

		$this->load->view('footer');
	}

	public function index()
	{
		check_login(2,$this->_data['dept_id']);

		$room_types = $this->room_m->get_room_types();

		$viewdata = array('room_types' => $room_types);

		$data = array('title' => 'Rooms - DB Hotel Management System', 'page' => 'room_type');
		$this->load->view('header', $data);
		$this->load->view('room-type/list',$viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */