<?php 

/**
* 
*/
class Pages_m extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();

	}

	public function list_pages($value='')
	{
		return $this->db->get('pages')->result();
	}

	public function getParentPages($parent_id=0,$site_id = 0)
	{
		if($site_id != 0){

		return $this->db->get_where('pages',array('parent_id'=>0,'site_id'=>$site_id))->result();

		}else{

		return $this->db->get_where('pages',array('parent_id'=>0))->result();
		}

	}

	public function getPage($title=false,$site_id = 0)
	{
		if($title){

		return $this->db->get_where('pages',array('site_id'=>$site_id,'page_title'=>$title))->result();

		}
		return false;

	}

	public function save_page($data=false)
	{
		return $this->db->insert('pages',$data);
	}

	public function save_parent($data=false)
	{
		if($this->db->get_where('pages',$data)->result()){
			return true;
		}else{

		return $this->db->insert('pages',$data);
		}
	}
	public function update_page($page_id=0,$data='')
	{
		$this->db->where('page_id',$page_id);
		return $this->db->update('pages',$data);
	}
	public function is_pageTitle($title='')
	{
		return $this->db->get_where('pages',array('page_title'=>$title))->result();
	}















}