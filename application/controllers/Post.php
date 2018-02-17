<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

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
	}
	public function index($value='')
	{
		# code...
	}
	public function create($value='')
	{

		$data['site_title'] = 'Create new post';
		$this->template->load('admin','post/create_p',$data);
	}

	public function save_post($value='')
	{
		
	}
}