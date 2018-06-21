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

	public function getDatabyNim($nim){
		$this->db->where($this->data['primary_key'], $nim);
		$query = $this->db->get($this->data['table_name']);
		return $query->row();
	}

   	public function insertByNim($data, $nim){
   		$this->db->where($this->data['primary_key'],$nim);
		$query = $this->db->insert($this->data['table_name'], $data);
		return $query;
	}

	public function insert($data){
		$query = $this->db->insert($this->data['table_name'], $data);
	}

   	public function update($nim, $data){
   		$this->db->where($this->data['primary_key'], $nim);
   		$query = $this->db->update($this->data['table_name'], $data);
   		return $query;
   	}

   	public function getDosen($nip){
		$this->db->where('nip', $nip);
		$query = $this->db->get('dosen');
		return $query;
	}
}