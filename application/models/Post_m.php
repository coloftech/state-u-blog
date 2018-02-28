<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Post_m extends CI_Model
{

	public function get_site_post($site_id=false,$limit=false,$start=false)
	{
		if ($site_id) {
			$post = $this->db->dbprefix('post');
			$this->db->select('post.*,YEAR('.$post.'.date_posted) as post_year,DATE_FORMAT('.$post.'.date_posted,"%b") as post_month,DAY('.$post.'.date_posted) as post_day,site.site_path,site.site_name')
			->from('post')
			->join('site','site.site_id = post.site_id','LEFT')
			->where('post.site_id',$site_id)
			->order_by('post.date_posted desc');
			if($limit && $start){
			$this->db->limit($start,$limit);
			}elseif($limit){
			$this->db->limit($limit);
			}
			$query = $this->db->get();

		return $query->result();
		}else{


			$post = $this->db->dbprefix('post');
			$this->db->select('post.*,YEAR('.$post.'.date_posted) as post_year,DATE_FORMAT('.$post.'.date_posted,"%b") as post_month,DAY('.$post.'.date_posted) as post_day,site.site_path')
			->from('post')
			->join('site','site.site_id = post.site_id','LEFT')			
			->order_by('post.date_posted desc');
			if($limit && $start){
			$this->db->limit($limit,$start);
			}elseif($limit){
			$this->db->limit($limit);
			}
			$query = $this->db->get();

		return $query->result();

		}
		
	}

	public function posted_by($id=0)
	{
		$query = $this->db->get_where('users',array('user_id'=>$id));
		if($result = $query->result()){
			return $result[0]->user_name;
		}else{
			return null;
		}
	}

	public function get_categories($post_id = false)
	{
		if($post_id){

		$query = $this->db->select('category.*')
				->from('category')
				->join('post_category','post_category.cat_id = category.cat_id','Left')
				->where('post_category.post_id',$post_id)
				->get();
		return $query->result();
	}else{

		$this->db->select('*');
		$query = $this->db->get('category');
		return $query->result();
	}
			
	}
	public function get_postBySlug($slug='',$site_id=0)
	{
		if(is_string($slug) && $site_id > 0){
			$query = $this->db->get_where('post',array('slug'=>$slug,'site_id'=>$site_id));

			if($result = $query->result()){
				return $result;
			}
				return false;
		}
			return false;
		
	}
	public function get_postById($post_id=0,$site_id=0)
	{
		if($post_id > 0){
			//$query = $this->db->get_where('post',array('post_id'=>$post_id));

			$this->db->select('post.*,site.site_path,site.site_name')
			->from('post')
			->join('site','site.site_id = post.site_id','LEFT')
			->where(array('post_id'=>$post_id));
			$query = $this->db->get();
			if($result = $query->result()){
				return $result;
			}
				return false;
		}
			return false;
		
	}

	public function get_tagsById($post_id=0,$site_id=0)
	{
		if($post_id > 0){
			//$this->db->select('keyword');
			$query = $this->db->get_where('post_tag',array('post_id'=>$post_id));
			if($result = $query->result()){
				return $result;
			}
				return false;
		}
			return false;
		
	}

	public function get_featuredImg($post_id=0)
	{
		if ($post_id > 0) {
			$this->db->select('link');
			$query = $this->db->get_where('post_file',array('post_id'=>$post_id,'gallery_id'=>0));
			if($result = $query->result()){
				return $result[0]->link;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function get_gallImg($post_id=0)
	{
		if ($post_id > 0) {
			$this->db->select('link,u_key');
			$query = $this->db->get_where('post_file',array('gallery_id'=>$post_id));
			if($result = $query->result()){
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function recent_post($site_id=false,$limit=10)
	{
		if($site_id){
			$query = $this->db->select('post.post_title,post.slug,site.site_path')
					->from('post')
					->join('site','site.site_id = post.site_id','LEFT')
					->where('site_id',$site_id)
					->order_by('post.date_posted desc')
					->limit($limit)
					->get();
			return $query->result();
		}else{

			$query = $this->db->select('post.post_title,post.slug,site.site_path')
					->from('post')
					->join('site','site.site_id = post.site_id','LEFT')
					->order_by('post.date_posted desc')
					->limit($limit)
					->get();
			return $query->result();
		}
	}
	public function save_post_info($info,$desc=false)
	{
		if (is_array($info)) {
			# code...
			$this->db->insert('post',$info);
			$id = $this->db->insert_id();
			
			return $id;

		}
		return false;

	}

	public function save_category($info=false)
	{
		if($info){
			$this->db->insert('post_category',$info);
		}
	}
	public function add_category($info=false)
	{
		if($info){
			if($this->db->where($info)->get('category')->result()){
				return true;
			}
			$this->db->insert('category',$info);
			return $this->db->insert_id();
		}return false;
	}
	public function save_file($post_id=0,$u_key=0)
	{
		if($post_id > 0){
			$this->db->set('post_id',$post_id);
			$this->db->where('u_key',$u_key);
			$this->db->update('post_file');
		}
	}

	public function save_gall($post_id=0,$u_key='')
	{
		if($post_id > 0){
			$this->db->set('gallery_id',$post_id);
			$this->db->where('u_key',$u_key);
			$this->db->update('post_file');
		}
	}
	public function save_tag($tags=false,$id)
	{
		# code...
		if ($tags) {
			# code...
			$this->db->insert('post_tag',array('keyword'=>$tags,'post_id'=>$id));
			return;
		}
	}


	public function remove_tags($id)
	{
		# code...
		if (is_numeric($id)) {
			# code...
			$this->db->where('post_id',$id);	
			$this->db->delete('post_tag');
			return;
		}
	}


	public function title($title = false){

		if($title){
			
		$result = $this->db->select('*')->from('post')->where('post_title',$title)->get()->result();
		return count($result);
		}else{
			return 0;
		}

	}
	public function titleId($title = false){

		if($title){
			
			$q = $this->db->select('post_id')
				->from('post')
				->where('post_title',$title)
				->get();
				if($result = $q->result()){

				return $result;
				}
				else{
					return false;
				}
		}
		return false;

	}


	public function allow_user($post_id=false,$status = false)
	{
		# code...
		if ($post_id) {
			# code...
			if($status < 1){

			$this->db->set('status',1);
			$this->db->WHERE('page_id',$post_id);
			return $this->db->update('post');
			}else{

			$this->db->set('status',0);
			$this->db->WHERE('page_id',$post_id);
			return $this->db->update('post');
			}
		}
	}

	public function save_file_array($data)
	{
		if (is_array($data)) {
			return $this->db->insert_batch('post_file',$data);
		}
	
		
	}

	public function free_space($time=0)
	{
		$q = $this->db->get_where('post_file',array('post_id'=>0,'gallery_id'=>0));
		if($result = $q->result()){
			foreach ($result as $key) {
				/* remove not use in post or gallery image */
				if((int)$key->u_key + 1200 < $time){
					if(!unlink($key->link)){

					}
					$this->db->where('id',$key->id);	
					$this->db->delete('post_file');

				}
			}

		}
	}
	public function remove_post($post_id=0)
	{
		$q = $this->db->get_where('post_file',array('post_id'=>$post_id,'gallery_id'=>0));
		if($result = $q->result()){
			foreach ($result as $key) {
					unlink($key->link);
					$this->db->where('id',$key->id);	
					$this->db->delete('post_file');
			}

		}
		$this->db->where('post_id',$post_id);
		$this->db->delete(array('post_tag','post_category'));
		$this->db->where('post_id',$post_id);
		return $this->db->delete(array('post'));


	}
	public function remove_gall($u_key=0)
	{
		$q = $this->db->get_where('post_file',array('u_key'=>$u_key));
		if($result = $q->result()){

			foreach ($result as $key) {

					if(unlink($key->link)){

					}
					$this->db->where('id',$key->id);	
					$this->db->delete('post_file');

			}

			return true;
		}
			return false;

	}




	public function update_post_info($info,$post_id=0)
	{
		if (is_array($info) && $post_id > 0) {
			# code...
			

			return $this->db->where('post_id',$post_id)
							->update('post',$info);

		}
		return false;

	}

	public function update_tag($tags=false,$id)
	{
		# code...
		if ($tags) {
			# code...
			$this->db->delete('post_tag',array('post_id'=>$id));
			$this->db->insert('post_tag',array('keyword'=>$tags,'post_id'=>$id));
			return;
		}
	}

	public function update_file($post_id=0,$u_key=0)
	{
		if($post_id > 0){


				$q = $this->db->get_where('post_file',array('post_id'=>$post_id,'gallery_id'=>0));
				if($result = $q->result()){
					foreach ($result as $key) {
						/* remove not use in post or gallery image */
							unlink($key->link);
							$this->db->where('id',$key->id);	
							$this->db->delete('post_file');

						
					}

				}

			$q2 = $this->db->set('post_id',$post_id);
			$this->db->where('u_key',$u_key);
			return $this->db->update('post_file');
		}
	}

	public function update_category($post_id = 0, $info=false)
	{
		if($info && $post_id > 0){

			$this->db->set($info);
			$this->db->where('post_id',$post_id);
			return $this->db->update('post_category');
		}
	}


}