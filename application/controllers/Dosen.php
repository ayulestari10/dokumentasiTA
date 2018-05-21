<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends MY_Controller
{
    private $data = [];

    public function __construct()
    {
      parent::__construct();    
        // $this->data['username']     = $this->session->userdata('username');
        // $this->data['id_hak_akses'] = $this->session->userdata('id_hak_akses');
        
        // if (!isset($this->data['username'], $this->data['id_hak_akses']) or $this->data['id_hak_akses'] != 1)
        // {
        //     $this->session->sess_destroy();
        //     redirect('login/dosen');
        //     exit;
        // }

    }

    public function index()
    {
        $this->data['title']  = 'Dashboard Dosen'.$this->title;
        $this->data['content']  = 'dosen/dashboard';
        $this->template($this->data, 'dosen');
    }

    public function data_mahasiswa()
    {
        $this->data['title']  = 'Data Mahasiswa'.$this->title;
        $this->data['content']  = 'dosen/data_mahasiswa';
        $this->template($this->data, 'dosen');
    }

    public function detail_dokumen()
    {
        $this->data['title']  = 'Detail Dokumen'.$this->title;
        $this->data['content']  = 'dosen/detail_dokumen';
        $this->template($this->data, 'dosen');
    }

    public function ubah_password()
    {
        $this->data['title']  = 'Ubah Password'.$this->title;
        $this->data['content']  = 'dosen/ubah_password';
        $this->template($this->data, 'dosen');
    }
}

?>
