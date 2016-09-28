<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class postControllerHook{

	function check_login()
	{
		$CI =& get_instance();
		define('UID', $CI->session->userdata('user_id'));
		define('USERNAME', $CI->session->userdata('username'));
		define('FULLNAME', $CI->session->userdata('fullname'));
		define('DEPARTMENT_NAME', $CI->session->userdata('department_name'));
		define('DEPARTMENT_ID', $CI->session->userdata('department_id'));
		define('USER_GROUP', $CI->session->userdata('group_id'));
		define("SHOW_GUIDE", false);
	}
}

?>