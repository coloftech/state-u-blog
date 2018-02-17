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
	}
	public function index($value='')
	{
		# code...
	}
	public function create($value='')
	{

		$data['categories'] = $this->post_m->get_categories();
		$data['hosted_site'] = $this->admin_m->hosted_sites();

		$data['site_title'] = 'Create new post';
		$this->template->load('admin','post/create_p',$data);
	}

	public function save_post($value='')
	{
		if($this->input->post()){
			$input = (object)$this->input->post();
			
			$slug = $this->slug->create($input->title);
			$keywords = explode(',', $input->title.','.$input->keyword);

			//var_dump($keywords);


			$exist = $this->post_m->title($input->title);
			if($exist > 0){
				echo json_encode(array('stats'=>false,'msg'=>'Title already used.'));
				exit();
			}

			$info = array(
				'post_title' => $input->title,
				'slug'=>$slug,
				'post_content'=>$input->desc,
				'user_id'=>$this->uid,
				'site_id'=>$input->group
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
					echo json_encode(array('stats'=>true,'msg'=>$input->title.' is successfully posted.'));
			}else{

					echo json_encode(array('stats'=>false,'msg'=>'Post unsuccessfull.'));
			}

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
			echo json_encode(array('stats'=>true,'link'=>$upload['link'],'u_key'=>$upload['u_key']));
		}else{

		}

		}
	}
	

	public function upload($title=false,$file,$i)
	{
		
		# code...
            	$tmp_file = $_FILES[$file]['tmp_name'][$i];
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
	 				if($file != $ftype){
	 					//echo $ftype;
	 					return false;
	 				}

	 				$upload_path = 'public/';
	 				if($type = 'image'){
	 					
				            $dirname = $this->username;

							$target_dir = $upload_path . 'uploads/';

							if (!file_exists($target_dir)) {
				               	mkdir($target_dir,0777);
							} 
							$target_dir = $target_dir . 'images/';

							if (!file_exists($target_dir)) {
				               	mkdir($target_dir,0777);
							} 
							$target_dir = $target_dir . date('Y'). '/';

							if (!file_exists($target_dir)) {
				               	mkdir($target_dir,0777);
							} 

	 					$upload_path = $target_dir;
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