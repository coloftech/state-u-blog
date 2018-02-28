<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->init();

	}
	public function init()
	{
		$this->load->model('site_m');
		$this->load->model('user_m');
		$this->load->model('post_m');
		$this->load->model('pages_m');
	}
	public function index()
	{
		$data['is_index'] = true;
		$limit = 5;
		$start = $this->input->get('row') ? $this->input->get('row') : 0;
		$total_rows = count($this->post_m->get_site_post());

		$data['posts'] = $this->post_m->get_site_post(false,$limit,$start);
		$data['pagination'] = $this->paging($total_rows,$limit,$start);



		$data['site_title'] = 'Bohol Island State University - Bilar Campus';
		$this->template->load(false,'site/index',$data);
	}


	public function paging($total=0,$limit=0,$start=0)
	{
		
						$config['base_url'] = site_url();
			            $config['total_rows']=$total;
			            $config['per_page'] = $limit;			            
				        $choice = $config["total_rows"]/$config["per_page"];
				        $config["num_links"] = floor($choice);             
             
			            $this->pagination->initialize($config);
			                 
			            /*$data['links'] =*/ 
			            return $this->pagination->create_links();
	}

	public function subpaging($total=0,$limit=0,$start=0,$page='')
	{
		
						$config['base_url'] = site_url("c=site&f=view&p=$page");
			            $config['total_rows']=$total;
			            $config['per_page'] = $limit;			            
				        $choice = $config["total_rows"]/$config["per_page"];
				        $config["num_links"] = floor($choice);             
             
			            $this->pagination->initialize($config);
			                 
			            /*$data['links'] =*/ 
			            return $this->pagination->create_links();
	}
	public function view($page='')
	{


		$page = $this->input->get('p') ? $this->input->get('p') : 'bilar';

		$site = $this->site_m->getSiteName($page);
		$siteName = isset($site[0]->site_name) ? $site[0]->site_name : 'Bilar Campus' ;
		$siteId = isset($site[0]->site_id) ? $site[0]->site_id : 1 ;



		$info = $this->input->get('i') ? $this->input->get('i') : 'post';

		if($info == 'post'){

				$limit = 5;
				$start = $this->input->get('row') ? $this->input->get('row') : 0;
				$total_rows = count($this->post_m->get_site_post($siteId));

				$data['pagination'] = $this->subpaging($total_rows,$limit,$start,$page);

					$data['posts'] = $this->post_m->get_site_post($siteId,$limit,$start);







		}elseif($info == 'about')
		{
			if($sitesetting = $this->site_m->getSettings($info,$siteId)){

			$data['about'] = $sitesetting[0]->setting_value;
			}
		
		}else{

			if($sitesetting = $this->site_m->getSettings($info,$siteId)){

			$data['about'] = $sitesetting[0]->page_content;

			$info_v = 'site/settingInfo';
			$siteName = urldecode($info);
			}

		}



		$data['site_title'] = $siteName;
		$data['list_pages'] = $this->pages_m->list_pages($siteId,3);
		$data['sidebar_pages'] = $this->pages_m->list_pages($siteId);

		if(empty($info_v)){

		$info_v = $this->info($page,$info);
		}

		$this->template->load(false,$info_v,$data);
	}
	public function info($page=false,$info=false)
	{
		switch ($info) {
			case 'about':
				
				return 'site/about';

				break;
			
			case 'contact':
				
				return 'site/contact';

				break;
			
			case 'read':
				
				return 'site/read';

				break;
			case 'post':
				

				return 'site/indexSite';

				break;

			default:

				return 'site/indexSite';
				break;
		}
	}



	public function read($url=false)
	{	
		$info = '';

		$page = $this->input->get('p') ? $this->input->get('p') : 'bilar';

		if($this->input->get()){
			if($this->input->get('i')){
				$info = $this->input->get('i');
				if(!empty($info)){

					if($site_id =  $this->site_m->getSiteId($page)){

						$info = $this->post_m->get_postBySlug($info,$site_id);
						$data['sidebar_pages'] = $this->pages_m->list_pages($site_id);

					}
				}
			}
			else{
				return false;
			}
		}
		if(is_array($info)){
			$data['site_title'] = $info[0]->post_title;
			$data['post'] = $info;
		}else{
			$data['site_title'] = 'Read post';
		}
		$data['site_path'] = $page;

		$data['link'] = site_url('c=site&f=read&p='.$page.'&i='.$info[0]->slug);
		$data['meta_title'] = $info[0]->post_title;
		$data['description'] = $this->auto_m->limit_300($info[0]->post_content);
		$data['featured_image'] = $this->post_m->get_featuredImg($info[0]->post_id);
		$this->template->load(false,'site/read',$data);

	}

	public function login($value='')
	{
		if($this->permission->is_loggedIn()){

		$page = $this->input->get('p') ? $this->input->get('p') : 'Bilar';

			redirect('c=site&f=view&p='.$page);
		}

		$data['site_title'] = 'Login';
		$this->template->load(false,'site/login',$data);

	}
	public function check_login($value='')
	{
		if ($this->input->post()) {
			$user = $this->input->post('user_name');
			$pass = $this->input->post('user_pass');

			if($is_found = $this->permission->login($user,$pass)){

				echo json_encode(array('stats'=>true,'msg'=>'Login successful.'));
			}else{
				$this->session->userdata['is_logged_in'] = false;
				echo json_encode(array('stats'=>false,'msg'=>'Login unsuccessful.'));

			}



		}
	}
	public function logout($value='')
	{
		$this->permission->logout();
		redirect();
	}
}
