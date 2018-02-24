<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

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
		 $this->load->model('post_m');
		$this->load->model('admin_m');
		$this->load->model('site_m');
	}
	public function index($value='')
	{
		# code...
	}
	public function create($value='')
	{	
		$sites = '';

		/*if($my_sites = $this->session->userdata['sites']){
			$my_sites = json_decode($my_sites);
			$i=0;
			foreach ($my_sites as $key) {
				//$sites[] = $key->site_id;
				$site_name = $this->site_m->getSiteName(false,$key->site_id);
				//sites[] = $site_name[0]->site_name;

				$site_path = $this->site_m->getSiteName(false,$key->site_id);
				$sites[] = (object)array('site_id'=>$key->site_id,'site_name'=>$site_name[0]->site_name,'site_path'=>$site_path[0]->site_path);

				$i++;
			}
		}*/

		//$this->permission->allow_user($this->uid,3);

		$data['categories'] = $this->post_m->get_categories();

		//if($this->permission->is_admin()){

		//$data['hosted_site'] = $this->admin_m->hosted_sites();

		//}else{

		$data['hosted_site'] = $this->permission->list_user_sites($this->uid);
		//var_dump($data['hosted_site']);
		//}


		$data['site_title'] = 'Create new post';
		$this->template->load('admin','post/create_p',$data);
	}

	public function edit($value='')
	{

		$post_id = $this->input->get('id');
		if($info = $this->post_m->get_postById($post_id)){
			$data['p_title'] = $info[0]->post_title;
			$data['p_slug'] = $info[0]->slug;
			$data['p_site_path'] = $info[0]->site_path;
			$data['p_content'] = $info[0]->post_content;

			$data['category'] =  $this->post_m->get_categories($post_id);
			$data['site_id'] = $info[0]->site_id;
			$time = strtotime($info[0]->date_posted);
			$data['m'] = date('m',$time);
			$data['d'] = date('d',$time);
			$data['Y'] = date('Y',$time);
			$tag = '';
			if($tags =  $this->post_m->get_tagsById($post_id)){
				foreach ($tags as $key) {
					$tag[] = $key->keyword;
				}
			}

			$data['tags'] = is_array($tag) ? implode(',', $tag) : $tag;
			$img = $this->post_m->get_featuredImg($post_id);
			//var_dump($img);
			$data['img_link'] = $img;
		}


		$data['categories'] = $this->post_m->get_categories();
		//$data['hosted_site'] = $this->admin_m->hosted_sites();

		$data['hosted_site'] = $this->permission->list_user_sites($this->uid);

		$data['site_title'] = 'Edit post';
		$this->template->load('admin','post/edit_p',$data);
	}

	public function list_all($value='')
	{

		$limit = 10;
		$start = $this->input->get('row') ? $this->input->get('row') : 0;
		$total_rows = count($this->post_m->get_site_post());

		$data['listall'] = $this->post_m->get_site_post(false,$limit,$start);
		$data['pagination'] = $this->auto_m->listpaging($total_rows,$limit,$start);

		$data['site_title'] = 'List all post';
		$this->template->load('admin','post/listall',$data);
	}

	public function save_post($value='')
	{
		if($this->input->post()){
			$input = (object)$this->input->post();
			
			$slug = $this->slug->create($input->title);
			$keywords = explode(',', $input->title.','.$input->keyword);


			if(!isset($input->group)){

				echo json_encode(array('stats'=>false,'msg'=>'Site is required or call the administrator.'));
				exit();
			}
			$exist = $this->post_m->title($input->title);
			if($exist > 0){
				echo json_encode(array('stats'=>false,'msg'=>'Title already used.'));
				exit();
			}

			$date_posted = $input->years.'-'.$input->months.'-'.$input->days.' '.date('h:m:s');

			//var_dump($date_posted);
			//exit();

			$info = array(
				'post_title' => $input->title,
				'slug'=>$slug,
				'post_content'=>$input->desc,
				'user_id'=>$this->uid,
				'site_id'=>$input->group,
				'date_posted'=>$date_posted
			 );
			if ($post_id= $this->post_m->save_post_info($info)) {
				
				if (is_array($keywords)) {
					foreach ($keywords as $key) {

					$save_tag = $this->post_m->save_tag($key,$post_id);
						}
					}else{

					$save_tag = $this->post_m->save_tag($keywords,$post_id);
					}
					if(!empty($input->featuredimg_url)){

					$save_file = $this->post_m->save_file($post_id,$input->featuredimg_url);
					}
					if($save_category = $this->post_m->save_category(array('post_id'=>$post_id,'cat_id'=>$input->category))){

					}
					echo json_encode(array('stats'=>true,'msg'=>$input->title.' is successfully posted.'));
			}else{

					echo json_encode(array('stats'=>false,'msg'=>'Post unsuccessfull.'));
			}

		}
		
	}


	public function update_post($value='')
	{
		if($this->input->post()){
			$input = (object)$this->input->post();

			if($is_title_id = $this->post_m->titleId($input->title)){
				if($input->post_id != $is_title_id[0]->post_id){

				echo json_encode(array('stats' =>false ,'msg'=>'Title already used.' ));
				exit();
				}}

			$slug = $this->slug->create($input->title);
			$keywords = explode(',', $input->title.','.$input->keyword);

			$date_posted = $input->years.'-'.$input->months.'-'.$input->days.' '.date('h:m:s');
			$info = array(
				'post_title' => $input->title,
				'slug'=>$slug,
				'post_content'=>$input->desc,
				'user_id'=>$this->uid,
				'site_id'=>$input->group,
				'date_posted'=>$date_posted
			 );
			if ($this->post_m->update_post_info($info,$input->post_id)) {
				$update_tag = '';$update_file = '';

				if (is_array($keywords)) {
					foreach ($keywords as $key) {

					$update_tag = $this->post_m->update_tag($key,$input->post_id);
						}
					}else{

					$update_tag = $this->post_m->update_tag($keywords,$input->post_id);
					}

					if(!empty($input->featuredimg_url)){

					$update_file = $this->post_m->update_file($input->post_id,$input->featuredimg_url);
					}


					if($input->old_cat_id != $input->category){
						$update_category = $this->post_m->update_category($input->post_id,array('cat_id'=>$input->category));

						
					}
					
				echo json_encode(array('stats' =>true ,'msg'=>'Post updated successfully. '.$update_tag . $update_file ));
			}
			
			}else{

				echo json_encode(array('stats' =>false ,'msg'=>'No input.' ));
				exit();
			}


		
	}
	public function remove_post()
	{
		if($this->input->post()){
			$input = (object)$this->input->post();
			if($this->post_m->remove_post($input->post_id)){
				echo json_encode(array('stats'=>true));
				exit();
			}
				echo json_encode(array('stats'=>true));
				exit();
		}

	}

	public function save_file()
	{
		# code...
		if($this->input->post()){

			$input = (object)$this->input->post();
			$file = $input->btnInput;

			$count = count($_FILES[$file]['name']);
			$i=0;
			
			if($upload = $this->upload('feature',$file,$i)){
				$uploaded = $this->post_m->save_file_array(array_filter(array(($upload))));
				$link = base_url('public/uploads/image/');
			echo json_encode(array('stats'=>true,'link'=>$link.$upload['newfilename'],'u_key'=>$upload['u_key']));
		}else{

		}

		}
	}

	public function add_gallery(){

		$input = (object)$this->input->post();
		$file = $input->btnInput;
			$upload = false;

			$count = count($_FILES[$file]['name']);

			$j=0;
			for ($i = 0; $i < $count; $i++) {

			if($upload[$i] = $this->upload('gallery',$file,$i)){
			    	$j++;
			//var_dump($upload);
			    }

			}

			if ($upload) {

				if($uploaded = $this->post_m->save_file_array(array_filter($upload))){
					//var_dump($upload);
					$ukey='';
					foreach ($upload as $key) {
						$ukey[]=$key['u_key'];
					}
					if (is_array($ukey)) {
						$ukey = implode(',', $ukey);
					}
					echo json_encode(array('stats'=>true,'msg'=>$j.' of '.$count.' file uploaded.','u_key'=>$ukey));
					exit();
				}else{
					echo json_encode(array('stats'=>false,'msg'=>$uploaded));
					exit();
				}

			}else{

					echo json_encode(array('stats'=>false,'msg'=>'Upload unsuccessful! No file selected/Invalid file.'));
			}
	}
	

	public function upload($title=false,$file,$i)
	{
		
		# code...
            	$tmp_file = $_FILES[$file]['tmp_name'][$i];
            	//var_dump($_FILES[$file]['tmp_name'][$i]);
            	$mimetype = mime_content_type($tmp_file);
              	$date =  date('y-m-d-h-m-s');
              		switch ($mimetype) {
	 				case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
	 					# code...
	 					$type='word';
	 					break;
	 				case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
	 					# code...
	 					$type='spreadsheet';
	 					break;
	 				case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
	 					# code...
	 					$type='powerpoint';
	 					break;
	 				case 'application/pdf':
	 					# code...
	 					$type='pdf';
	 					break;	 			
	 				case 'image/png':
	 					# code...
	 					$type='image';
	 					break;
	 				case 'image/jpeg':
	 					# code...
	 					$type='image';
	 					break;
	 				case 'image/jpg':
	 					# code...
	 					$type='image';
	 					break;
	 				case 'image/gif':
	 					# code...
	 					$type='image';
	 					break;
	 				case 'image/tiff':
	 					# code...
	 					$type='photoshop';
	 					break;
	 				case 'image/vnd.adobe.photoshop':
	 					$type = 'photoshop';
	 					break;	
	 				case 'video/mp4':
	 					# code...
	 					$type='video';
	 					break;
	 				case 'application/octet-stream':
	 					# code...
	 					$type='video';
	 					break;
	 				case 'application/x-dosexec':
	 					# code...
	 					$type='exefile';
	 					break;

	 				case 'text/html':
	 					# code...
	 					$type='block';
	 					break;	
	 				case 'text/x-php':
	 					# code...
	 					$type='block';
	 					break;	 						
	 				case 'text/plain':
	 					# code...
	 					$type='block';
	 					break;	

	 				case 'application/x-rar':
	 					# code...
	 					$type='zipped';
	 					break;	 						
	 				case 'application/zip':
	 					# code...
	 					$type='zipped';
	 					break;	
	 				default:
	 					$type = 'others';
	 					break;
	 				}
	 				if($type === 'block' || $type === 'exefile'){
	 					return false;
	 				}
	 				if($type === 'word' || $type === 'powerpoint' || $type === 'spreadsheet'  || $type === 'pdf'){
	 					$ftype = 'docs';
	 				}else{
	 						$ftype = $type;
	 				}

	 				$upload_path ='public/uploads/image/';//UPLOADPATH;//base_url('public/');
	 				if($type = 'image'){
	 					
				           // $dirname = $this->username;
	 					/*
							$target_dir = $upload_path . 'uploads/';

							if (!file_exists($target_dir)) {
				               	mkdir($target_dir,0777);
							} 
							$target_dir = $target_dir . 'image/';

							if (!file_exists($target_dir)) {
				               	mkdir($target_dir,0777);
							} 
							$target_dir = $target_dir . date('Y'). '/';

							if (!file_exists($target_dir)) {
				              	mkdir($target_dir,0777);
							} 
							*/

	 					//$upload_path = $target_dir;
	 				}else{



			            $dirname = $this->username;

						$target_dir = UPLOADPATH . $dirname . "/";
						if (!file_exists($target_dir)) {
			               	mkdir(UPLOADPATH.$dirname,0777);
						} 
			            $dirname2 = $this->username.'/'.$type;
						$target_dir2 = UPLOADPATH . $dirname2 . "/";

						if (!file_exists($target_dir2)) {
			               	mkdir(UPLOADPATH.$dirname2,0777);
						} 
	 					$upload_path = $target_dir2;
	 				}
	 				
                
                $filename = basename($_FILES[$file]["name"][$i]);
                $targetfile = $upload_path . basename($_FILES[$file]["name"][$i]);

                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $oldname = pathinfo($filename, PATHINFO_FILENAME);

                $oldname = $this->slug->create($oldname);
                if($title){

                $title = $this->slug->create($title);
                $newfile = $upload_path.$title.'-'.$oldname.'-'.$date.'.'.$ext;
                $newfilename = $title.'-'.$oldname.'-'.$date.'.'.$ext;
	            }else{

	                $newfile = $upload_path.$oldname.'-'.$date.'.'.$ext;
	                $newfilename = $oldname.'-'.$date.'.'.$ext;
	            }


        		if(move_uploaded_file($tmp_file, $newfile)){

                    $data = array('link'=>$newfile,'mtype'=>$mimetype,'newfilename'=>$newfilename,'type'=>$type,'u_key'=>time());
                    
                    return $data;
                }else{

                    return false;
                }
            
	}
	    function check_mimetype($filename)
    {
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }	
        $mimetype = false;
        if(function_exists('mime_content_type')) {
            $mimetype = mime_content_type($filename); 

            $allowed = array('image/jpeg','image/pjpeg','image/png','image/x-png','audio/mp3','video/*','application/msword', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint','application/pdf');
            if (in_array($mimetype, $allowed)) {

                return true;
            }else{
                return false;
            }
        }
       return true;
    }






















}