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

		
		$query = $this->db->get('col_site');
		return $query->result();
	}
	public function save_site($site_name=false,$site_path=false)
	{
		if ($site_name && $site_path) {
			$data = array(
				'site_name'=>$site_name,
				'site_path'=>$site_path,
				'date_created'=>date('Y-m-d')
			);
			return $this->db->insert('col_site',$data);
		}
	}









}