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
        $this->load->model('mahasiswa_m');
        $this->load->model('dosen_m');
        $this->load->model('tugas_akhir_m');

         // load form_validation library
        $this->load->library('form_validation');
    }

    public function index(){

        $this->data['title']        = 'Dashboard Admin'.$this->title;
        $this->data['content']      = 'admin/dashboard';
        $this->data['mahasiswa']    = $this->mahasiswa_m->get();
        $this->data['dosen']        = $this->dosen_m->get();
        $this->data['tugas_akhir']  = $this->tugas_akhir_m->get();
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
            echo json_encode($this->data['data_mahasiswa']);
            exit;
        }

        $this->data['title']        = 'Data Mahasiswa'.$this->title;
        $this->data['content']      = 'admin/data_mahasiswa';
        $this->data['mahasiswa']    = $this->mahasiswa_m->getData();
        $this->template($this->data);
    }

    public function tambah_mahasiswa(){

        if($this->POST('simpan')){

            $this->form_validation->set_rules('username', 'Username', 'required|min_length[14]|max_length[18]|numeric', array(
                    'required'      => 'Username tidak boleh kosong', 
                    'min_length'    => 'Username harus lebih dari 14 karakter', 
                    'max_length'    => 'Username harus maksimum 18 karakter', 
                    'numeric'       => 'Username harus angka'
                ));
            $this->form_validation->set_rules('password1', 'Password', 'required', array(
                    'required'      => 'Password tidak boleh kosong'));
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password1]', array(
                    'required'      => 'Konfirmasi password tidak boleh kosong',
                    'matches'       => 'Password dan konfirmasi password harus sama'
                ));

            if ($this->form_validation->run() == FALSE)
            {
                $this->flashmsg(validation_errors(), 'danger');
                redirect('admin/data-mahasiswa');
                exit;
            }

            $data_mahasiswa = [
                'username'  => $this->POST('username'),
                'password'  => md5($this->POST('password1'))
            ];
            $this->user_m->insert($data_mahasiswa);

            $nim = ['nim'   => $this->POST('username')];
            $this->mahasiswa_m->insert($nim);
            $this->tugas_akhir_m->insert($nim);

            $this->flashmsg('Data berhasil disimpan!');
            redirect('admin/data-mahasiswa');
            exit;
        }
    }

    public function edit_mahasiswa(){

        if($this->POST('edit')){
            
            $this->form_validation->set_rules('password1', 'Password', 'required', array(
                    'required'      => 'Password tidak boleh kosong'));
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password1]', array(
                    'required'      => 'Konfirmasi password tidak boleh kosong',
                    'matches'       => 'Password dan konfirmasi password harus sama'
                ));

            if ($this->form_validation->run() == FALSE)
            {
                $this->flashmsg(validation_errors(), 'danger');
                redirect('admin/data-mahasiswa');
                exit;
            }

            $username = $this->POST('username_lama');

            $data_mahasiswa = [
                'password'  => md5($this->POST('password1'))
            ];
            $this->user_m->update($username, $data_mahasiswa);

            $this->flashmsg('Data berhasil diedit!');
            redirect('admin/data-mahasiswa');
            exit;
        }
    }

    public function data_dosen()
    {

        if($this->POST('delete') && $this->POST('username')){

            $this->user_m->delete($this->POST('username'));
            $this->flashmsg('<i class="fa fa-check"></i> Data dosen berhasil dihapus');
            exit;
        }

        if($this->POST('username') && $this->POST('get')){
            $this->data['data_dosen'] = $this->user_m->get_row(['username' => $this->POST('username')]);
            echo json_encode($this->data['data_dosen']);
            exit;
        }

        $this->data['title']        = 'Data Dosen'.$this->title;
        $this->data['content']      = 'admin/data_dosen';
        $this->data['dosen']        = $this->dosen_m->getData();
        $this->template($this->data);
    }

    public function tambah_dosen(){

        if($this->POST('simpan')){

            $this->form_validation->set_rules('username', 'Username', 'required|min_length[14]|max_length[18]|numeric', array(
                    'required'      => 'Username tidak boleh kosong', 
                    'min_length'    => 'Username harus lebih dari 14 karakter', 
                    'max_length'    => 'Username harus maksimum 18 karakter', 
                    'numeric'       => 'Username harus angka'
                ));
            $this->form_validation->set_rules('password1', 'Password', 'required', array(
                    'required'      => 'Password tidak boleh kosong'));
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password1]', array(
                    'required'      => 'Konfirmasi password tidak boleh kosong',
                    'matches'       => 'Password dan konfirmasi password harus sama'
                ));

            if ($this->form_validation->run() == FALSE)
            {
                $this->flashmsg(validation_errors(), 'danger');
                redirect('admin/data-dosen');
                exit;
            }

            $data_dosen = [
                'username'  => $this->POST('username'),
                'password'  => md5($this->POST('password1'))
            ];
            $this->user_m->insert($data_dosen);

            $nip = ['nip'   => $this->POST('username')];
            $this->dosen_m->insert($nip);

            $this->flashmsg('Data berhasil disimpan!');
            redirect('admin/data-dosen');
            exit;
        }
    }

    public function edit_dosen(){

        if($this->POST('edit')){
            
            $this->form_validation->set_rules('password1', 'Password', 'required', array(
                    'required'      => 'Password tidak boleh kosong'));
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password1]', array(
                    'required'      => 'Konfirmasi password tidak boleh kosong',
                    'matches'       => 'Password dan konfirmasi password harus sama'
                ));

            if ($this->form_validation->run() == FALSE)
            {
                $this->flashmsg(validation_errors(), 'danger');
                redirect('admin/data-mahasiswa');
                exit;
            }

            $username = $this->POST('username_lama');

            $data_dosen = [
                'password'  => md5($this->POST('password1'))
            ];
            $this->user_m->update($username, $data_dosen);

            $this->flashmsg('Data berhasil diedit!');
            redirect('admin/data-dosen');
            exit;
        }
    }

    public function data_dokumen(){
        if($this->POST('status') && $this->POST('NIM')){
            $dokumen = $this->tugas_akhir_m->get_row(['nim' => $this->POST('NIM')]);

            if (isset($dokumen)){
                $nim = $this->POST('NIM');

                if ($dokumen->status == 'Terverifikasi'){
                    $this->tugas_akhir_m->update($nim, ['status' => 'Belum Terverifikasi']);
                    echo "<button class='btn btn-danger' onclick=\"changeStatus('".$nim."')\"><i class='fa fa-close'></i> Belum Terverifikasi</button>";
                }
                else {
                    $this->tugas_akhir_m->update($nim, ['status' => 'Terverifikasi']);
                    echo "<button class='btn btn-success' onclick=\"changeStatus('".$nim."')\"><i class='fa fa-check'></i> Terverifikasi</button>";   
                }
            }
            exit;
        }

        if($this->POST('delete') && $this->POST('NIM')){
            $edit_data = [
                'judulTA'           => NULL,
                'konsentrasi'       => NULL,
                'abstrak'           => NULL,
                'status'            => NULL,
                'tahun_pembuatan'   => NULL,
                'dosen_pembimbing1' => NULL,
                'dosen_pembimbing2' => NULL

            ];
            $this->tugas_akhir_m->update($this->POST('NIM'), $edit_data);
            $this->flashmsg('<i class="fa fa-check"></i> Data tugas akhir berhasil dihapus');
            exit;
        }

        $this->data['title']    = 'Data Dokumen'.$this->title;
        $this->data['dokumen']  = $this->tugas_akhir_m->get();
        $this->data['content']  = 'admin/data_dokumen';
        $this->template($this->data);
    }

    public function detail_dokumen() {
        $nim = $this->uri->segment(3);

        if(!isset($nim)){
            $this->flashmsg('<i class="fa fa-close"></i> NIM tidak dicantumkan', 'danger');
            redirect('admin/data-dokumen');
            exit;
        }

        $this->data['title']    = 'Detail Dokumen'.$this->title;
        $this->data['content']  = 'admin/detail_dokumen';
        $this->data['dokumen']  = $this->tugas_akhir_m->get_row(['NIM' => $nim]);
        $this->template($this->data);
    }

    public function download(){
        $nim = $this->uri->segment(3);

        if (!isset($this->data['username'], $this->data['role']))
        {
            $this->session->sess_destroy();
            $this->flashmsg('Anda harus login dulu!','warning');
            redirect('login');
            exit;
        }
        else{

            if (file_exists('assets/File_TugasAkhir/'.$nim.'.pdf')) {
            $this->load->helper('download');
            force_download('assets/File_TugasAkhir/'.$nim.'.pdf',NULL);
            redirect('mahasiswa/data-dokumen');
            }else{
                $this->flashmsg('File tidak ada !','danger');
                redirect('mahasiswa/data-dokumen');
            }
        }
        
    }
}

?>
