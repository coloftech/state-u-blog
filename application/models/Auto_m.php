<?php 

/**
* 
*/
class Auto_m extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->init();
	}
	public function init($value='')
	{
		# code...
		$this->load->library('minify');
		$this->load->library('session');
		$this->load->library('pagination');

                    // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        //$config['use_page_numbers'] = TRUE;
        $config['display_pages'] = FALSE;
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '<< PREV';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'NEXT >>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['query_string_segment'] = 'row';
			
            $this->pagination->initialize($config);
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

	public function getSites()
	{
		$this->load->model('admin_m');
		$html = '';
		if($hosted_sites = $this->admin_m->hosted_sites()){

			foreach ($hosted_sites as $key) {
				# code...
				$html.= "<li><a href='".site_url("c=site&f=view&p=$key->site_path")."' >$key->site_name</a></li>";
			}
		}else{
			$html.= "<li><a href='".site_url()."' >Home</a></li>";
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

    public function limitext($string='')
    {
        # code...
                // strip tags to avoid breaking any html
        $string = strip_tags($string);

        if (strlen($string) >200) {

            // truncate string
            $stringCut = substr($string, 0, 200);

            // make sure it ends in a word so assassinate doesn't become ass...
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
        }
        return $string;
    }
    public function limit_300($string='')
    {
        # code...
                // strip tags to avoid breaking any html
        $string = strip_tags($string);

        if (strlen($string) >300) {

            // truncate string
            $stringCut = substr($string, 0, 300);

            // make sure it ends in a word so assassinate doesn't become ass...
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
        }
        return $string;
    }
    public function limit_title($string='')
    {
        # code...
                // strip tags to avoid breaking any html
        $string = strip_tags($string);

        if (strlen($string) >75) {

            // truncate string
            $stringCut = substr($string, 0, 75);

            // make sure it ends in a word so assassinate doesn't become ass...
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
        }
        return $string;
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

    public function listpaging($total=0,$limit=0,$start=0,$page='')
    {
        
                        $config['base_url'] = site_url("c=post&f=list_all");
                        $config['total_rows']=$total;
                        $config['per_page'] = $limit;                       
                        $choice = $config["total_rows"]/$config["per_page"];
                        $config["num_links"] = floor($choice);             
             
                        $this->pagination->initialize($config);
                             
                        /*$data['links'] =*/ 
                        return $this->pagination->create_links();
    }

    public function siteSetting(){
        $page = ($this->input->get('p')) ? $this->input->get('p') : 'bilar';
        $menu  = '';
        if($site_id  = $this->site_m->getSiteId($page)){
            if($menus = $this->site_m->getsiteSettings($site_id,0)){
                foreach ($menus as $key) {
                    $menu .= "<li><a href=''>".ucfirst($key->setting_name)."</a></li>";
                }
            }

        }
        //var_dump($menus);
        return $menu;
    }
    public function menu_top($value='')
    {
        
        $this->load->model('listmenu');
        $menus = $this->listmenu->get_menu_html();
        return $menus;
    }
}