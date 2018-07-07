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
        $this->load->model('admin_m');
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

    public function profile(){
        if($this->POST('simpan')){
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required|alpha_spaces', array(
                    'trim'      => 'Nama tidak boleh kosong',
                    'required'  => 'Nama tidak boleh kosong',
                    'alpha_spaces'     => 'Nama hanya boleh karakter'
                ));
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array(
                    'trim'      => 'Email tidak boleh kosong',
                    'required'  => 'Email tidak boleh kosong',
                    'valid_email' => 'Email tidak valid'
                ));
            $this->form_validation->set_rules('alamat', 'alamat', 'trim|required', array(
                    'trim'      => 'Alamat tidak boleh kosong',
                    'required'  => 'Alamat tidak boleh kosong'
                ));

            if ($this->form_validation->run() == FALSE){
                $this->flashmsg(validation_errors(), 'danger');
                redirect('admin/profile');
                exit;
            }

            $file_name = $_FILES['foto']['name'];
            $exe = substr($file_name, -4);
            $exe2= substr($file_name, -5);

            if($exe == ".jpg" || $exe == ".JPG" || $exe == ".png"  || $exe == ".PNG" || $exe2 == ".jpeg" || $exe2 == ".JPEG"  || $exe == NULL){
                $data_profile = [
                'nama'  => $this->POST('nama'),
                'email'  => $this->POST('email'),
                'alamat'  => $this->POST('alamat')
                ];

                $nipus = $this->POST('nipus');

                $this->admin_m->update($nipus, $data_profile);
                
                if(!empty($_FILES) && $_FILES['foto']['error'] == 0) {
                    $this->upload($nipus, 'admin', 'foto');
                }

                $this->flashmsg('Data berhasil disimpan!');
                redirect('admin/profile');
                exit;
            }
            else{
                $this->flashmsg('Pilih file jpg/jpeg/png/JPG/JPEG/PNG !','danger');
                redirect('admin/profile');
                exit;
            }

            
        }

        $this->data['title']        = 'Profile'.$this->title;
        $this->data['content']      = 'admin/profile';
        $this->data['data']         = $this->admin_m->get_row(['NIPUS' => $this->data['username']]);
        $this->template($this->data);
    }

    public function data_mahasiswa(){

        if($this->POST('delete') && $this->POST('id')){

            $this->user_m->delete($this->POST('id'));
            unlink('assets/File_TugasAkhir/'.$this->POST('id').'.pdf');
            unlink('assets/foto/mahasiswa/'.$this->POST('id').'.jpg');
            unlink('assets/foto/mahasiswa/'.$this->POST('id').'.png');
            unlink('assets/foto/mahasiswa/'.$this->POST('id').'.jpeg');
            $this->mahasiswa_m->delete($this->POST('id'));
            $this->tugas_akhir_m->delete($this->POST('id'));
            $this->flashmsg('<i class="fa fa-check"></i> Data mahasiswa berhasil dihapus');
            exit;
        }

        if($this->POST('username') && $this->POST('get')){
            $this->data['data_mahasiswa'] = $this->user_m->get_row(['username' => $this->POST('username')]);
            $this->data['mahasiswa'] = $this->mahasiswa_m->get_row(['NIM' => $this->POST('username')]);

            $data_mhs = [
                'nim'  => $this->data['data_mahasiswa']->username,
                'nama' => $this->data['mahasiswa']->nama
            ];
            echo json_encode($data_mhs);
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
                    'exact_length'  => 'Username harus tepat 14 karakter', 
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

            $id = $this->POST('username');
            $cekId = $this->user_m->getDatabyNim($id);
            $cekId2 = $this->mahasiswa_m->getDatabyNim($id);
            $cekId3 = $this->admin_m->getDatabyNim($id);
            $cekId4 = $this->dosen_m->getDatabyNim($id);

            if(count($cekId) == 0 && count($cekId2) == 0 && count($cekId3) == 0 && count($cekId4) == 0 ){
                $data_mahasiswa = [
                    'username'  => $this->POST('username'),
                    'password'  => md5($this->POST('password1'))
                ];
                $this->user_m->insert($data_mahasiswa);

                $data_mas = [
                    'NIM'   => $this->POST('username'),
                    'nama'  => $this->POST('nama')
                ];
                $this->mahasiswa_m->insert($data_mas);
                $this->tugas_akhir_m->insert(['NIM' => $this->POST('username')]);

                $this->flashmsg('Data berhasil disimpan!');
                redirect('admin/data-mahasiswa');
                exit;
            }
            else{
                $this->flashmsg('Username yang digunakan telah ada!', 'danger');
                redirect('admin/data-mahasiswa');
                exit;
            }
            
        }
    }

    public function edit_mahasiswa(){

        if($this->POST('edit')){
            $username = $this->POST('username_lama');

            $this->form_validation->set_rules('nama', 'Nama', 'trim|alpha_spaces', array(
                    'trim'             => 'Nama tidak boleh kosong!',
                    'alpha_spaces'     => 'Nama hanya boleh alfabet!'
                ));

            if ($this->form_validation->run() == FALSE)
            {
                $this->flashmsg(validation_errors(), 'danger');
                redirect('admin/data-mahasiswa/');
                exit;
            }

            if(empty($this->POST('password1')) or empty($this->POST('password2'))) {
                $data_mahasiswa = [
                    'nama'      => htmlentities($this->POST('edit_nama'))
                ];
                $this->mahasiswa_m->update($username, $data_mahasiswa);
            }
            else {
                $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'matches[password1]', array(
                    'matches'       => 'Password dan konfirmasi password harus sama'
                ));

                if ($this->form_validation->run() == FALSE)
                {
                    $this->flashmsg(validation_errors(), 'danger');
                    redirect('admin/data-mahasiswa/');
                    exit;
                }

                $data_user = [
                    'password'  => md5($this->POST('password1'))
                ];
                $this->user_m->update($username, $data_user);

                $data_mahasiswa = [
                    'nama'      => htmlentities($this->POST('edit_nama'))
                ];
                $this->mahasiswa_m->update($username, $data_mahasiswa);
            }

            $this->flashmsg('Data berhasil diedit!');
            redirect('admin/data-mahasiswa');
            exit;
        }
    }

    public function data_dosen()
    {

        if($this->POST('delete') && $this->POST('id')){

            $this->user_m->delete($this->POST('id'));
            $this->dosen_m->delete($this->POST('id'));
            $this->flashmsg('<i class="fa fa-check"></i> Data dosen berhasil dihapus');
            exit;
        }

        if($this->POST('username') && $this->POST('get')){
            $this->data['data_dosen'] = $this->user_m->get_row(['username' => $this->POST('username')]);
            $this->data['dosen'] = $this->dosen_m->get_row(['NIP' => $this->POST('username')]);

            $data_dos = [
                'nip'  => $this->data['data_dosen']->username,
                'nama' => $this->data['dosen']->nama
            ];

            echo json_encode($data_dos);
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
                    'exact_length'  => 'Username harus tepat 18 karakter',  
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

            $id = $this->POST('username');
            $cekId = $this->user_m->getDatabyNim($id);
            $cekId2 = $this->mahasiswa_m->getDatabyNim($id);
            $cekId3 = $this->admin_m->getDatabyNim($id);
            $cekId4 = $this->dosen_m->getDatabyNim($id);

            if(count($cekId) == 0 && count($cekId2) == 0 && count($cekId3) == 0 && count($cekId4) == 0){
                $data_dosen = [
                    'username'  => $this->POST('username'),
                    'password'  => md5($this->POST('password1'))
                ];
                $this->user_m->insert($data_dosen);

                $data_dos = [
                    'NIP'   => $this->POST('username'),
                    'nama'  => $this->POST('nama')
                ];
                $this->dosen_m->insert($data_dos);

                $this->flashmsg('Data berhasil disimpan!');
                redirect('admin/data-dosen');
                exit;           
            }
            else{
                $this->flashmsg('Username yang digunakan telah ada!','danger');
                redirect('admin/data-dosen');
                exit;
            }
        }
    }

    public function edit_dosen(){

        if($this->POST('edit')){
            
            $username = $this->POST('username_lama');

            $this->form_validation->set_rules('nama', 'Nama', 'trim|alpha_spaces', array(
                    'trim'             => 'Nama tidak boleh kosongaa!',
                    'alpha_spaces'     => 'Nama hanya boleh alfabet!'
                ));

            if ($this->form_validation->run() == FALSE)
            {
                $this->flashmsg(validation_errors(), 'danger');
                redirect('admin/data-dosen/');
                exit;
            }

            if(empty($this->POST('password1')) or empty($this->POST('password2'))) {
                $data_dosen = [
                    'nama'      => htmlentities($this->POST('edit_nama'))
                ];
                $this->dosen_m->update($username, $data_dosen);
            }
            else {
                $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'matches[password1]', array(
                    'matches'       => 'Password dan konfirmasi password harus sama'
                ));

                if ($this->form_validation->run() == FALSE)
                {
                    $this->flashmsg(validation_errors(), 'danger');
                    redirect('admin/data-dosen/');
                    exit;
                }

                $data_user = [
                    'password'  => md5($this->POST('password1'))
                ];
                $this->user_m->update($username, $data_user);

                $data_dosen = [
                    'nama'      => $this->POST('edit_nama')
                ];
                $this->dosen_m->update($username, $data_dosen);
            }            

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

        if($this->POST('delete') && $this->POST('id')){
            $edit_data = [
                'judulTA'           => NULL,
                'konsentrasi'       => NULL,
                'abstrak'           => NULL,
                'status'            => NULL,
                'tahun_pembuatan'   => NULL,
                'dosen_pembimbing1' => NULL,
                'dosen_pembimbing2' => NULL

            ];
            $this->tugas_akhir_m->update($this->POST('id'), $edit_data);
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
            $this->flashmsg('<i class="fa fa-close"></i> NIM tidak dicantumkan!', 'danger');
            redirect('admin/data-dokumen');
            exit;
        }
        else{
            $cek_data = $this->tugas_akhir_m->get_row(['NIM' => $nim]);

            if(count($cek_data) <= 0){
                $this->flashmsg('<i class="fa fa-close"></i> Data dengan NIM tersebut tidak ada!', 'danger');
                redirect('admin/data-dokumen');
                exit;
            }
        }

        $this->data['title']    = 'Detail Dokumen'.$this->title;
        $this->data['dokumen']  = $this->tugas_akhir_m->get_row(['NIM' => $nim]);
        $this->data['dp1']      = $this->dosen_m->getNamaDosen1($this->data['dokumen']->dosen_pembimbing1);
        $this->data['dp2']      = $this->dosen_m->getNamaDosen2($this->data['dokumen']->dosen_pembimbing2);
        $this->data['content']  = 'admin/detail_dokumen';
        $this->template($this->data);
    }

    public function download(){
        $nim = $this->uri->segment(3);

        if(!isset($nim)){
            $this->flashmsg('<i class="fa fa-close"></i> NIM tidak dicantumkan!', 'danger');
            redirect('admin/data-dokumen');
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
