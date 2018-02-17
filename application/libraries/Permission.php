<?php 

/**
* 
*/
class Permission
{
	public $ci;
	public $prefix;
	public $salt = '_salt-';
	public function __construct()
	{
		# code...
	        $this->ci =& get_instance();
	        $this->ci->load->database();
			$this->ci->load->library('session');
	        $this->ci->load->helper('cookie');
	        $this->ci->load->helper('url');

	}
	public function login($user=false, $pass=false)
	{

		if ($user && $pass) {
			$pass = md5($this->salt.$pass);
			$query =  $this->ci->db->get_where('users',array('user_name'=>$user,'user_pass'=>$pass));
			if($result = $query->result()){
				$this->ci->session->userdata['id'] = $result[0]->user_id;
				$this->ci->session->userdata['username'] = $result[0]->user_name;
				$this->ci->session->userdata['is_logged_in'] = true;
				return true;
			}
		}
		return false;
	}
	public function logout($value='')
	{
				session_destroy();
				$this->ci->session->userdata['id'] = 0;
				$this->ci->session->userdata['username'] = '';
				$this->ci->session->userdata['is_logged_in'] = false;
	}
	public function is_admin($value='')
	{
		# code...
	}
	public function is_loggedIn()
	{
		if(isset($this->ci->session->userdata['is_logged_in']) == true){
			return true;
		}else{
			return false;
		}
	}
}