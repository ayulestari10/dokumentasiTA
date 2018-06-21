<?php 

class Tugas_akhir_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'tugas_akhir';
		$this->data['primary_key']	= 'NIM';
	}

	public function getAll(){
		$query = $this->db->get($this->data['table_name']);
		return $query->result();
	}

	public function getDatabyNim($nim){
		$this->db->where($this->data['primary_key'], $nim);
		$query = $this->db->get($this->data['table_name']);
		return $query->row();
	}

	public function insertAll($data, $nim){
		$this->db->where($this->data['primary_key'],$nim);
		$query = $this->db->insert($this->data['table_name'], $data);
		return $query;
	}

	public function update($nim, $data){
   		$this->db->where($this->data['primary_key'], $nim);
   		$query = $this->db->update($this->data['table_name'], $data);
   		return $query;
   	}

   	public function get_ta()
	{
		$query = $this->db->query('SELECT tugas_akhir.judulTA, mahasiswa.nama, mahasiswa.jurusan, tugas_akhir.konsentrasi, tugas_akhir.tahun_pembuatan, mahasiswa.email, tugas_akhir.abstrak FROM mahasiswa INNER JOIN tugas_akhir ON mahasiswa.NIM = tugas_akhir.NIM');

		return $query->result();
	}

	public function get_data($nim)
	{
		$this->db->where('NIM',$nim);
		$query = $this->db->get('tugas_akhir');
		return $query->result();
	}
}