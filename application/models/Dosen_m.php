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
}
