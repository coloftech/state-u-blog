<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends CI_Controller {



	function __construct()
	{
		parent::__construct();
		$this->init();
	}
	public function init()
	{

		 if (!$this->permission->is_loggedIn()){
		 	redirect();
		 }
		$this->load->model('admin_m');
	}
	public function index($value='')
	{
		$data['site_title'] = 'Administration';
		$this->template->load('admin','admin/index',$data);
	}
	public function sites($value='')
	{
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
}