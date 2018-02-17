<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Post_m extends CI_Model
{

	public function get_site_post($site_id='')
	{
		$post = $this->db->dbprefix('post');
		$query = $this->db->select('post.*,YEAR('.$post.'.date_posted) as post_year,DATE_FORMAT('.$post.'.date_posted,"%b") as post_month,DAY('.$post.'.date_posted) as post_day,site.site_path')
			->from('post')
			->join('site','site.site_id = post.site_id','LEFT')
			->where('post.site_id',$site_id)
			->get();

		return $query->result();
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
	public function get_postBySlug($slug='')
	{
		$query = $this->db->get_where('post',array('slug'=>$slug));
		if($result = $query->result()){
			return $result;
		}else{
			return false;
		}
	}
}