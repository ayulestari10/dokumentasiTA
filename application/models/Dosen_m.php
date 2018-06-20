<?php 

class Dosen_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'dosen';
		$this->data['primary_key']	= 'NIP';
	}

	public function getData(){
		$query = $this->db->query('Select username, password From user Inner Join dosen on dosen.NIP = user.username; ');
		return $query->result();
	}
}