<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Restaurant extends CI_Controller {

	private $_data = array();

	public function __construct()
	{
		parent::__construct();
		$this->_data['dept_id'] = 6;
	}
	public function add()
	{
		check_login(2,$this->_data['dept_id']);


		if($this->input->post("restaurantName"))
		{
			$restaurantName = $this->input->post("restaurantName");
			$restaurantOpenTime = $this->input->post("restaurantOpenTime");
			$restaurantCloseTime = $this->input->post("restaurantCloseTime");
			$restaurantDetails = $this->input->post("restaurantDetails");
			$tableCount = $this->input->post("tableCount");
			
			$this->restaurant_m->addRestaurant($restaurantName, $restaurantOpenTime, $restaurantCloseTime, $restaurantDetails, $tableCount);
			redirect("/restaurant");
		}

		$data = array('title' => 'Add Restaurant - DB Hotel Management System', 'page' => 'restaurant');
		$this->load->view('header', $data);
		$this->load->view('restaurant/add');
		$this->load->view('footer');
	}

	function delete($restaurant_name)
	{		
		check_login(2,$this->_data['dept_id']);

		$restaurant_name = urldecode($restaurant_name);
		$this->restaurant_m->deleteRestaurant($restaurant_name);
		redirect("/restaurant");
	}

	public function edit($restaurant_name)
	{
		check_login(2,$this->_data['dept_id']);

		$restaurant_name = urldecode($restaurant_name);
		if($this->input->post("restaurantName"))
		{
			$restaurant_name = $this->input->post("restaurantName");
			$restaurant_open_time = $this->input->post("restaurantOpenTime");
			$restaurant_close_time = $this->input->post("restaurantCloseTime");
			$restaurant_details = $this->input->post("restaurantDetails");
			$table_count = $this->input->post("tableCount");
			
			$this->restaurant_m->editRestaurant($restaurant_name, $restaurant_open_time, $restaurant_close_time, $restaurant_details, $table_count);
			redirect("/restaurant");
		}
		$data = array('title' => 'Edit Restaurant - DB Hotel Management System', 'page' => 'restaurant');
		$this->load->view('header', $data);
		$restaurant = $this->restaurant_m->getRestaurant($restaurant_name);
		$viewdata = array('restaurant'  => $restaurant[0]);
		$this->load->view('restaurant/edit',$viewdata);

		$this->load->view('footer'); 
	}

	public function index()
	{
		check_login(2,$this->_data['dept_id']);

		$restaurants = $this->restaurant_m->get_restaurants();
		$customers = $this->customer_m->get_active_customers();

		$viewdata = array('restaurants' => $restaurants, 'customers' => $customers);

		$data = array('title' => 'Restaurants - DB Hotel Management System', 'page' => 'restaurant');
		$this->load->view('header', $data);
		$this->load->view('restaurant/list',$viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */