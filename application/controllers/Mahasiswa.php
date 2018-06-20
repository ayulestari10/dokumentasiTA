<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller
{
    private $data = [];

    public function __construct()
    {
        parent::__construct();    
        $this->data['username']     = $this->session->userdata('username');
        $this->data['role']         = $this->session->userdata('role');
        
        if (!isset($this->data['username'], $this->data['role']) or $this->data['role'] != "mahasiswa")
        {
            $this->session->sess_destroy();
            $this->flashmsg('Anda harus login dulu!','warning');
            redirect('login');
            exit;
        }

    }

    public function index()
    {
        $this->data['title']  = 'Dashboard Mahasiswa'.$this->title;
        $this->data['content']  = 'mahasiswa/dashboard';
        $this->template($this->data, 'mahasiswa');
    }

    public function data_dokumen()
    {
        $this->data['title']  = 'Data Dokumen'.$this->title;
        $this->data['content']  = 'mahasiswa/data_dokumen';
        $this->template($this->data, 'mahasiswa');
    }


    public function unggah_dokumen()
    {
        $this->data['title']  = 'Mengunggah Dokumen'.$this->title;
        $this->data['content']  = 'mahasiswa/mengunggah_dokumen';
        $this->template($this->data, 'mahasiswa');
    }

    public function edit_dokumen()
    {
        $this->data['title']  = 'Edit Dokumen'.$this->title;
        $this->data['content']  = 'mahasiswa/edit_dokumen';
        $this->template($this->data, 'mahasiswa');
    }

    public function ubah_password()
    {
        $this->data['title']  = 'Ubah Password'.$this->title;
        $this->data['content']  = 'mahasiswa/ubah_password';
        $this->template($this->data, 'mahasiswa');
    }
}

?>
