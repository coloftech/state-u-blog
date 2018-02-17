<?php 

/**
* 
*/
class Site_m extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function get_content($id=false)
	{
		# code...
		if(is_numeric($id)){

			$sql = sprintf("SELECT content FROM col_static_page WHERE id= %d",$id);
			$query = $this->db->query($sql);
			if($result =  $query->result()){
				return $result[0]->content;
			}else{
				return false;
			}

		}
	}

	public function insert($id=false,$content=false)
	{
		# code...
		

		$sql = sprintf("UPDATE col_static_page SET content = '%s' WHERE id = %d",$content,$id);
		return $this->db->query($sql);

	}

	public function getSiteName($path='')
	{
		$query = $this->db->select('*')
			->from('site')
			->where('site_path',$path)
			->get();
		return $query->result();


	}
	public function getSettings($info=false,$siteId = 1)
	{
		if ($info && is_string($info)) {

			$query = $this->db->select('setting_value')
				->from('site_setting')
				->where(array('setting_name'=>$info,'site_id'=>$siteId))
				->get();
			return $query->result();
			}
		return false;


	}
}