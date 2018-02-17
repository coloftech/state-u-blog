<?php 

/**
* 
*/
class Auto_m extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function init($value='')
	{
		# code...
	}
	public function recent_post($value='')
	{
		$this->load->model('post_m');
		$html = '';
		if($recents = $this->post_m->recent_post()){

			foreach ($recents as $key) {
				# code...
				$html.= "<li><i class='fa fa-angle-right'></i> <a href='".site_url("c=site&f=read&p=$key->site_path&i=$key->slug")."' >$key->post_title</a></li>";
			}
		}
		return $html;
	}

	public function free_space()
	{
		$this->load->model('post_m');
		$html = '';
		if($recents = $this->post_m->free_space(time())){

		}

	}
}