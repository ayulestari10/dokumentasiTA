<?php 

class Dosen_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();

		$this->data['table_name'] 	= 'dosen';
		$this->data['primary_key']	= 'NIP';
	}

	public function get_data_mahasiswa($username)
	{
		$query = $this->db->query('SELECT mahasiswa.nim, mahasiswa.nama, tugas_akhir.judulTA, tugas_akhir.tahun_pembuatan 
			FROM mahasiswa  INNER JOIN tugas_akhir ON tugas_akhir.NIM = mahasiswa.nim 
							INNER JOIN dosen ON tugas_akhir.dosen_pembimbing1 = dosen.nip 
							WHERE tugas_akhir.dosen_pembimbing1 = "'.$username.'" 
							UNION 
							SELECT mahasiswa.nim, mahasiswa.nama, tugas_akhir.judulTA, tugas_akhir.tahun_pembuatan 
							FROM mahasiswa  INNER JOIN tugas_akhir ON tugas_akhir.NIM = mahasiswa.nim 
							INNER JOIN dosen ON tugas_akhir.dosen_pembimbing2 = dosen.nip 
							WHERE tugas_akhir.dosen_pembimbing2 = "'.$username.'"
							');

		return $query->result();
	}

	public function get_nip($nip)
	{
		$this->db->where('NIP',$nip);
		$query = $this->db->get('tugas_akhir');
		return $query->row();
	}

	public function detail_ta($nim)
	{
		$query = $this->db->query('SELECT tugas_akhir.nim, mahasiswa.nama, mahasiswa.jurusan, mahasiswa.email, tugas_akhir.judulTA, tugas_akhir.konsentrasi, tugas_akhir.tahun_pembuatan, tugas_akhir.dosen_pembimbing1, tugas_akhir.dosen_pembimbing2, tugas_akhir.abstrak 
			FROM mahasiswa INNER JOIN tugas_akhir on mahasiswa.nim = tugas_akhir.nim 
						   INNER JOIN dosen ON tugas_akhir.dosen_pembimbing1 = dosen.nip 
						   WHERE tugas_akhir.nim = "'.$nim.'" ');

		return $query->row();
	}

	public function getAll(){
		$query = $this->db->get($this->data['table_name']);
		return $query->result();
	}

	public function getNamaDosen1($nip){
		$query = $this->db->query('SELECT dosen.nama FROM dosen INNER JOIN
					tugas_akhir ON dosen.nip = tugas_akhir.dosen_pembimbing1
   					WHERE dosen.nip = "'.$nip.'"
   				');
   		return $query->row();
	}

	public function getNamaDosen2($nip){
		$query = $this->db->query('SELECT dosen.nama FROM dosen INNER JOIN
					tugas_akhir ON dosen.nip = tugas_akhir.dosen_pembimbing2
   					WHERE dosen.nip = "'.$nip.'"
   				');
   		return $query->row();
	}

	public function getData(){
		$query = $this->db->query('Select username, password From user Inner Join dosen on dosen.NIP = user.username; ');
		return $query->result();
	}

	public function getDatabyNim($nim){
		$this->db->where($this->data['primary_key'], $nim);
		$query = $this->db->get($this->data['table_name']);
		return $query->row();
	}

	public function getDosen1(){
		$query = $this->db->query('select distinct dosen.nama, dosen.NIP from dosen inner join tugas_akhir on dosen.NIP = tugas_akhir.dosen_pembimbing1 where dosen.NIP != tugas_akhir.dosen_pembimbing2;');
		return $query->result();
	}

	public function getDosen2(){
		$query = $this->db->query('select distinct dosen.nama, dosen.NIP from dosen inner join tugas_akhir on dosen.NIP = tugas_akhir.dosen_pembimbing2 where dosen.NIP != tugas_akhir.dosen_pembimbing1;');
		return $query->result();
	}

	public function getDosen2_byDosen1($nip){
		$query = $this->db->query('select NIP, nama, email, alamat from dosen where NIP != "'.$nip.'"');
		return $query->result();
	}
}