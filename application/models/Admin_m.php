<?php 

class Admin_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'admin';
		$this->data['primary_key']	= 'NIPUS';
	}
	public function getDatabyNim($nim){
		$this->db->where($this->data['primary_key'], $nim);
		$query = $this->db->get($this->data['table_name']);
		return $query->row();
	}
}