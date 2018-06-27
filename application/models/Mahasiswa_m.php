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

	public function getMhsTA($nim){
		$query = $this->db->query('SELECT tugas_akhir.nim,tugas_akhir.status, mahasiswa.nama, mahasiswa.jurusan, mahasiswa.email, tugas_akhir.judulTA, tugas_akhir.konsentrasi, tugas_akhir.tahun_pembuatan, tugas_akhir.dosen_pembimbing1, tugas_akhir.dosen_pembimbing2, tugas_akhir.abstrak 
			FROM tugas_akhir INNER JOIN mahasiswa on mahasiswa.nim = tugas_akhir.nim 
						   WHERE tugas_akhir.nim = "'. $nim .'"; ');
		return $query->row();
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
}