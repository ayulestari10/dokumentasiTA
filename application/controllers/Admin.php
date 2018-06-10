<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
    private $data = [];

    public function __construct()
    {
      parent::__construct();    
        $this->data['username']     = $this->session->userdata('username');
        $this->data['role']         = $this->session->userdata('role');
        
        if (!isset($this->data['username'], $this->data['role']) or $this->data['role'] != "admin")
        {
            $this->session->sess_destroy();
            redirect('login');
            exit;
        }

        $this->load->model('user_m');
        $this->load->model('mahasiswa');
        $this->load->model('dosen');
        $this->load->model('tugas_akhir');
    }

    public function index(){

        $this->data['title']        = 'Dashboard Admin'.$this->title;
        $this->data['content']      = 'admin/dashboard';
        $this->data['mahasiswa']    = $this->mahasiswa->get();
        $this->data['dosen']        = $this->dosen->get();
        $this->data['tugas_akhir']  = $this->tugas_akhir->get();
        $this->template($this->data);
    }

    public function data_mahasiswa(){

        if($this->POST('delete') && $this->POST('username')){

            $this->user_m->delete($this->POST('username'));
            $this->flashmsg('<i class="fa fa-check"></i> Data mahasiswa berhasil dihapus');
            exit;
        }

        if($this->POST('username') && $this->POST('get')){
            $this->data['data_mahasiswa'] = $this->user_m->get_row(['username' => $this->POST('username')]);
            // $this->dump($this->data['data_mahasiswa']);exit;
            echo json_encode($this->data['data_mahasiswa']);
            exit;
        }

        $this->data['title']        = 'Data Mahasiswa'.$this->title;
        $this->data['content']      = 'admin/data_mahasiswa';
        $this->data['mahasiswa']    = $this->mahasiswa->getData();
        $this->template($this->data);
    }

    public function tambah_mahasiswa(){

        if($this->POST('simpan')){
            $data_mahasiswa = [
                'username'  => $this->POST('username'),
                'password'  => md5($this->POST('password'))
            ];
            $this->user_m->insert($data_mahasiswa);

            $nim = ['nim'   => $this->POST('username')];
            $this->mahasiswa->insert($nim);

            $this->flashmsg('Data berhasil disimpan!');
            redirect('admin/data-mahasiswa');
            exit;
        }
    }

    public function edit_mahasiswa(){
        if($this->POST('username') && $this->POST('get')){
            $this->data['data_mahasiswa'] = $this->user_m->get_row(['username' => $this->POST('username')]);
            // $this->dump($this->data['data_mahasiswa']);exit;
            echo json_encode($this->data['data_mahasiswa']);
            exit;
        }

        if($this->POST('edit')){
            exit;
        }
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
