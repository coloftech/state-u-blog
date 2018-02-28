<?php 

/**
* 
*/
class admin_m extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function hosted_sites()
	{
		# code...

		
		//$query = $this->db->get('col_site');
		//return $query->result();
		return $this->permission->hosted_sites();
	}
	public function save_site($site_name=false,$site_path=false,$site_category=0)
	{
		if ($site_name && $site_path) {
			$data = array(
				'site_name'=>$site_name,
				'site_path'=>$site_path,
				'date_created'=>date('Y-m-d'),
				'site_category'=>$site_category
			);
			return $this->db->insert('col_site',$data);
		}
	}









}