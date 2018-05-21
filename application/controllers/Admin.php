<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
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
        //     redirect('login/admin');
        //     exit;
        // }

    }

    public function index()
    {
        $this->data['title']  = 'Dashboard Admin'.$this->title;
        $this->data['content']  = 'admin/dashboard';
        $this->template($this->data);
    }

    public function data_mahasiswa()
    {
        $this->data['title']  = 'Data Mahasiswa'.$this->title;
        $this->data['content']  = 'admin/data_mahasiswa';
        $this->template($this->data);
    }

    public function data_dosen()
    {
        $this->data['title']  = 'Data Dosen'.$this->title;
        $this->data['content']  = 'admin/data_dosen';
        $this->template($this->data);
    }

    public function data_dokumen()
    {
        $this->data['title']  = 'Data Dokumen'.$this->title;
        $this->data['content']  = 'admin/data_dokumen';
        $this->template($this->data);
    }

    public function detail_dokumen()
    {
        $this->data['title']  = 'Detail Dokumen'.$this->title;
        $this->data['content']  = 'admin/detail_dokumen';
        $this->template($this->data);
    }
}

?>
