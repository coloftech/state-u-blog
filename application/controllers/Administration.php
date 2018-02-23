<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends CI_Controller {



	public $uid;
	public $username;
	function __construct()
	{
		parent::__construct();
		$this->init();
	}
	public function init($value='')
	{
			 if (!$this->permission->is_loggedIn()){
		 	redirect();
		 }
		 $this->uid = $this->session->userdata['id'];
		 $this->username = $this->session->userdata['username'];

		$this->load->model('admin_m');


		$this->auto_m->free_space();
	}
	public function index($value='')
	{
		$data['site_title'] = 'Administration';
		$this->template->load('admin','admin/index',$data);
	}
	public function sites($value='')
	{
		$site_ids = $this->permission->list_user_sites($this->uid);
		$site_id = $site_ids[0]->site_id;

		$data['users'] = $this->permission->list_user();

		$data['hosted_site'] = $this->admin_m->hosted_sites();
		$data['site_title'] = 'Hosted Site';
		$this->template->load('admin','admin/hostedSites',$data);
	}
	public function add_site($value='')
	{
		if ($this->input->post()) {
			$input =(object) $this->input->post();

			$is_added = $this->admin_m->save_site($input->site_name,$input->site_path);
		}
		redirect('c=administration&f=sites');
	}

	public function add_site_user($user_id=0,$site_id=0)
	{
		$this->permission->allow_user($user_id,$site_id);

	}
}