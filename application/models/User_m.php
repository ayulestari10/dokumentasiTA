<?php 

class User_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'user';
		$this->data['primary_key']	= 'username';
	}

	public function login($data)
	{
		$result = $this->get_row(['username' => $data['username'], 'password' => $data['password']]);
		if (!isset($result))
			return $result;
		$this->session->set_userdata([
			'username'		=> $result->username
		]);
		return $result;
	}
	public function getDatabyNim($nim){
		$this->db->where($this->data['primary_key'], $nim);
		$query = $this->db->get($this->data['table_name']);
		return $query->row();
	}
}