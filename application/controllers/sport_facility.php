<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sport_facility extends CI_Controller {

	private $_data = array();

	public function __construct()
	{
		parent::__construct();
		$this->_data['dept_id'] = 7;
	}

	public function add()
	{
		check_login(2,$this->_data['dept_id']);


		if($this->input->post("sportfacilityOpenTime"))
		{
			$sportfacilityOpenTime = $this->input->post("sportfacilityOpenTime");
			$sportfacilityCloseTime = $this->input->post("sportfacilityCloseTime");
			$sportfacilityDetails = $this->input->post("sportfacilityDetails");
			
			$this->sport_facility_m->addSportfacility($sportfacilityOpenTime, $sportfacilityCloseTime, $sportfacilityDetails);
			redirect("/sport_facility");
		}

		$data = array('title' => 'Add Sport Facility - DB Hotel Management System', 'page' => 'sport_facility');
		$this->load->view('header', $data);
		$this->load->view('sport_facility/add');
		$this->load->view('footer');
	}

	function delete($sportfacility_id)
	{
		check_login(2,$this->_data['dept_id']);

		$this->sport_facility_m->deleteSportfacility($sportfacility_id);
		redirect("/sport_facility");
	}

	public function edit($sportfacility_id)
	{
		check_login(2,$this->_data['dept_id']);

		if($this->input->post("sportfacilityOpenTime"))
		{
			$sportfacility_open_time = $this->input->post("sportfacilityOpenTime");
			$sportfacility_close_time = $this->input->post("sportfacilityCloseTime");
			$sportfacility_details = $this->input->post("sportfacilityDetails");
			
			$this->sport_facility_m->editSportfacility($sportfacility_id, $sportfacility_open_time, $sportfacility_close_time, $sportfacility_details);
			redirect("/sport_facility");
		}
		$data = array('title' => 'Edit Sport Facility - DB Hotel Management System', 'page' => 'sport_facility');
		$this->load->view('header', $data);
		$sportFacility = $this->sport_facility_m->get_sportfacility($sportfacility_id);
		$viewdata = array('sport_facility'  => $sportFacility[0]);
		$this->load->view('sport_facility/edit',$viewdata);

		$this->load->view('footer'); 
	}

	public function index()
	{
		check_login(2,$this->_data['dept_id']);

		$sportFacilities = $this->sport_facility_m->get_sportFacilities();
		$customers = $this->customer_m->get_active_customers();

		$viewdata = array('sportFacilities' => $sportFacilities, 'customers' => $customers);

		$data = array('title' => 'Sport Facility - DB Hotel Management System', 'page' => 'sport_facility');
		$this->load->view('header', $data);
		$this->load->view('sport_facility/list',$viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */