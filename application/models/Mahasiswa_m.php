<?php 

class Mahasiswa_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'mahasiswa';
		$this->data['primary_key']	= 'NIM';
	}

	public function getData(){
		$query = $this->db->query('Select username, password From user Inner Join mahasiswa on mahasiswa.NIM = user.username; ');
		return $query->result();
	}
}