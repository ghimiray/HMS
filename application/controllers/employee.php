<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller {


	private $_data = array();

	public function __construct()
	{
		parent::__construct();
		$this->_data['dept_id'] = 2;
	}

	public function add()
	{
		check_login(2,$this->_data['dept_id']);


		if($this->input->post("username") && $this->input->post("password") && $this->input->post("email"))
		{
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$firstname = $this->input->post("firstname");
			$lastname = $this->input->post("lastname");
			$telephone = $this->input->post("telephone");
			$email = $this->input->post("email");
			$department_id = $this->input->post("department_id");
			$type = $this->input->post("type");
			$salary = $this->input->post("salary");
			$hiring_date = $this->input->post("hiring_date");

			$employee_id = $this->employee_m->addEmployee($username, $password, $firstname, $lastname, $telephone, $email, $department_id, $type, $salary, $hiring_date);

			if($employee_id){
				$additional_data = [
					'first_name'=>$firstname,
					'last_name'=>$lastname,
					'phone'=>$telephone,
					'employee'=>$this->db->insert_id(),
					'department_id' =>$department_id,
					'group_id' =>2
				];
				$group_ids = [2];//[$department_id];
				
				$this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);
				
			}

			redirect("/employee");
		}

		$data = array('title' => 'Add Employee - DB Hotel Management System', 'page' => 'employee');
		$this->load->view('header', $data);
		$departments = $this->employee_m->getDepartments();
		$viewdata = array('departments' => $departments);
		$this->load->view('employee/add',$viewdata);
		$this->load->view('footer');
	}

	function delete($employee_id)
	{
		check_login(2,$this->_data['dept_id']);

		$this->employee_m->deleteEmployee($employee_id);
		$this->db->delete('users',array('employee',$employee_id));
		redirect("/employee");
	}

	public function edit($employee_id)
	{
		check_login(2,$this->_data['dept_id']);

		if($this->input->post("username") && $this->input->post("password") && $this->input->post("email"))
		{
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$firstname = $this->input->post("firstname");
			$lastname = $this->input->post("lastname");
			$telephone = $this->input->post("telephone");
			$email = $this->input->post("email");
			$department_id = $this->input->post("department_id");
			$type = $this->input->post("type");
			$salary = $this->input->post("salary");
			$hiring_date = $this->input->post("hiring_date");
			
			$this->employee_m->editEmployee($employee_id, $username, $password, $firstname, $lastname, $telephone, $email, $department_id, $type, $salary, $hiring_date);
			redirect("/employee");
		}
		
		$data = array('title' => 'Edit Employee - DB Hotel Management System', 'page' => 'employee');
		$this->load->view('header', $data);

		$departments = $this->employee_m->getDepartments();
		$employee = $this->employee_m->getEmployee($employee_id);
		
		$viewdata = array('departments' => $departments, 'employee'  => $employee[0]);
		$this->load->view('employee/edit',$viewdata);

		$this->load->view('footer');
	}

	public function index()
	{
		check_login(2,$this->_data['dept_id']);

		$employees = $this->employee_m->get_employees();

		$viewdata = array('employees' => $employees);

		$data = array('title' => 'Employees - DB Hotel Management System', 'page' => 'employee');
		$this->load->view('header', $data);
		$this->load->view('employee/list',$viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */