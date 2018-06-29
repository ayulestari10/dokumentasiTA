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

        $this->load->model('dosen_m');
        $this->load->model('Mahasiswa_m');
        $this->load->model('tugas_akhir_m');
        $this->load->model('user_m');
    }

    public function index()
    {
        $this->data['title']  = 'Dashboard Mahasiswa'.$this->title;
        $this->data['content']  = 'mahasiswa/dashboard';
        $this->template($this->data, 'mahasiswa');
    }

    public function profile(){
        if($this->POST('simpan')){
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required|alpha_spaces', array(
                    'trim'      => 'Nama tidak boleh kosong!',
                    'required'  => 'Nama tidak boleh kosong!',
                    'alpha_spaces'     => 'Nama hanya boleh karakter!'
                ));
            $this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required|alpha_spaces', array(
                    'trim'      => 'Jurusan tidak boleh kosong!',
                    'required'  => 'Jurusan tidak boleh kosong!',
                    'alpha_spaces'     => 'Jurusan hanya boleh karakter!'
                ));
            $this->form_validation->set_rules('angkatan', 'Angkatan', 'required|numeric', array(
                    'required'      => 'Username tidak boleh kosong!',  
                    'numeric'       => 'Username harus angka!'
                ));
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array(
                    'trim'      => 'Email tidak boleh kosong!',
                    'required'  => 'Email tidak boleh kosong!',
                    'valid_email' => 'Email tidak valid!'
                ));
            $this->form_validation->set_rules('alamat', 'alamat', 'trim|required', array(
                    'trim'      => 'Alamat tidak boleh kosong!',
                    'required'  => 'Alamat tidak boleh kosong!'
                ));

            if ($this->form_validation->run() == FALSE){
                $this->flashmsg(validation_errors(), 'danger');
                redirect('mahasiswa/profile');
                exit;
            }

            $file_name = $_FILES['foto']['name'];
            $exe = substr($file_name, -4);
            $exe2= substr($file_name, -5);

            if($exe == ".jpg" || $exe == ".png" || $exe2 == ".jpeg" || $exe == NULL){
                    $data_profile = [
                    'nama'  => $this->POST('nama'),
                    'jurusan' => $this->POST('jurusan'),
                    'angkatan' => $this->POST('angkatan'),
                    'email'  => $this->POST('email'),
                    'alamat'  => $this->POST('alamat')
                ];

                $cekNimInd = $this->Mahasiswa_m->getDatabyNim($this->data['username']);

                if(count($cekNimInd) > 0){
                    $this->Mahasiswa_m->update($this->data['username'], $data_profile);

                    if(!empty($_FILES) && $_FILES['foto']['error'] == 0) {
                        $this->upload($this->data['username'], 'mahasiswa', 'foto');
                    }

                    $this->flashmsg('Data berhasil disimpan!');
                    redirect('mahasiswa/profile');
                    exit;
                }
                else{
                    $this->Mahasiswa_m->insert($this->data['username']);
                    $this->Mahasiswa_m->update($this->data['username'], $data_profile);

                    if(!empty($_FILES) && $_FILES['foto']['error'] == 0) {
                        $this->upload($this->data['username'], 'mahasiswa', 'foto');
                    }

                    $this->flashmsg('Data berhasil disimpan!');
                    redirect('mahasiswa/profile');
                    exit;
                }
            }
            else{
                $this->flashmsg('Pilih file jpg/jpeg/png!', 'danger');
                redirect('mahasiswa/profile');
                exit;
            }
            
        }

        $this->data['title']        = 'Profile'.$this->title;
        $this->data['content']      = 'mahasiswa/profile';
        $this->data['individu']     = $this->Mahasiswa_m->getDatabyNim($this->data['username']); 
        $this->template($this->data, 'mahasiswa');
    }

    public function data_dokumen()
    {
        $this->data['title']  = 'Data Dokumen'.$this->title;
        $this->data['content']  = 'mahasiswa/data_dokumen';
        $this->data['ta'] = $this->tugas_akhir_m->getDatabyNim($this->data['username']);
        $this->data['individu'] = $this->Mahasiswa_m->getDatabyNim($this->data['username']);
        $this->data['dp1'] = $this->dosen_m->getNamaDosen1($this->data['ta']->dosen_pembimbing1);
        $this->data['dp2'] = $this->dosen_m->getNamaDosen2($this->data['ta']->dosen_pembimbing2);

        if($this->POST('id') && $this->POST('delete')){
            $nim = $this->data['username'];
            $dataTA = array(
                            'judulTA' => NULL,
                            'konsentrasi' => NULL,
                            'tahun_pembuatan' => NULL,
                            'dosen_pembimbing1' => NULL,
                            'dosen_pembimbing2' => NULL,
                            'abstrak' => NULL,
                            'status' => NULL
                        );
            $this->load->helper('file');
            unlink('assets/File_TugasAkhir/'.$nim.'.pdf');
            $this->tugas_akhir_m->update($nim, $dataTA);
            $this->flashmsg('Data berhasil dihapus!', 'success');
            exit;
        }

        $this->template($this->data, 'mahasiswa');
    }

    public function unggah_dokumen()
    {
        $this->data['title']  = 'Mengunggah Dokumen'.$this->title;
        $this->data['content']  = 'mahasiswa/mengunggah_dokumen';
        $this->data['ta'] = $this->tugas_akhir_m->getDatabyNim($this->data['username']);
        $this->data['dosen'] = $this->dosen_m->getAll();

        if ($this->POST('simpan'))
        {
            $this->form_validation->set_rules('judul', 'Judul', 'trim|required', array(
                    'trim'      => 'Judul tidak boleh kosong!',
                    'required'  => 'Judul tidak boleh kosong!'
                ));

            $this->form_validation->set_rules('konsentrasi', 'Konsentrasi', 'trim|required', array(
                    'trim'      => 'Konsentrasi tidak boleh kosong!',
                    'required'  => 'Konsentrasi tidak boleh kosong!'
                ));

            $this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|numeric', array(
                    'trim'      => 'Tahun tidak boleh kosong!',
                    'required'  => 'Tahun tidak boleh kosong!',
                    'numeric'   => 'Tahun harus angka'
                ));

            $this->form_validation->set_rules('dosen_pembimbing1', 'Dosen Pembimbing 1', 'trim|required', array(
                    'trim'      => 'Dosen pembimbing 1 tidak boleh kosong!',
                    'required'  => 'Dosen pembimbing 1 tidak boleh kosong!'
                ));

            $this->form_validation->set_rules('dosen_pembimbing2', 'Dosen Pembimbing 2', 'trim|required', array(
                    'trim'      => 'Dosen pembimbing 2 tidak boleh kosong!',
                    'required'  => 'Dosen pembimbing 2 tidak boleh kosong!'
                ));

            $this->form_validation->set_rules('abstrak', 'Abstrak', 'trim|required', array(
                    'trim'      => 'Abstrak tidak boleh kosong!',
                    'required'  => 'Abstrak tidak boleh kosong!'
                ));


                if ($this->form_validation->run() == FALSE){
                    $this->flashmsg(validation_errors(), 'danger');
                    redirect('Mahasiswa/unggah-dokumen');
                    exit;
                }

                $file_name = $_FILES['upload']['name'];
                $exe = substr($file_name, -4);

                if($exe != ".pdf"){
                    $this->flashmsg('Pilih file pdf!', 'danger');
                    redirect('mahasiswa/unggah-dokumen');
                    exit;
                }

                $nim        = $this->data['username'];
                $judul      = $this->POST('judul');
                $konsentrasi= $this->POST('konsentrasi');
                $tahun      = $this->POST('tahun');
                $dp1        = $this->POST('dosen_pembimbing1');
                $dp2        = $this->POST('dosen_pembimbing2');
                $file       = $this->POST('upload');
                $abstrak    = $this->POST('abstrak');
                $status     = "Belum Terverifikasi";

                $dataTA = array(
                                'judulTA' => $judul,
                                'konsentrasi' => $konsentrasi,
                                'tahun_pembuatan' => $tahun,
                                'dosen_pembimbing1' => $dp1,
                                'dosen_pembimbing2' => $dp2,
                                'abstrak' => $abstrak,
                                'status' => $status
                            );
                
                $cekNIM_TA = $this->tugas_akhir_m->getDatabyNim($nim);

                if(count($cekNIM_TA) > 0){
                    $this->tugas_akhir_m->update($nim, $dataTA);
                    $this->uploadPDF($nim, 'upload');

                    $this->flashmsg('Data tugas akhir berhasil disimpan! Silahkan cek Dokumen Tugas Akhir!', 'success');
                    redirect('mahasiswa/unggah-dokumen');
                    exit;
                }
                else{
                    $dataNim=array('nim' => $nim);
                    $this->tugas_akhir_m->insert($dataNim);
                    $this->tugas_akhir_m->update($nim, $dataTA);
                    $this->uploadPDF($nim, 'upload');

                    $this->flashmsg('Data tugas akhir berhasil disimpan! Silahkan cek Dokumen Tugas Akhir!');
                    redirect('mahasiswa/unggah-dokumen');
                    exit;
                }
        }
        $this->template($this->data, 'mahasiswa');
    }

    public function download_file($getNim){
        $username = $this->data['username'];

        if (file_exists('assets/File_TugasAkhir/'.$getNim.'.pdf')) {
            $this->load->helper('download');
            force_download('assets/File_TugasAkhir/'.$getNim.'.pdf',NULL);
            redirect('mahasiswa/data_dokumen');
        }else{
            $this->flashmsg('File tidak ada!','danger');
            redirect('mahasiswa/data_dokumen');
        }
        
    }

    public function ubah_password()
    {
        $this->data['title']  = 'Ubah Password'.$this->title;
        $this->data['content']  = 'mahasiswa/ubah_password';

        if($this->POST('simpan')){
            
            $this->form_validation->set_rules('password1', 'Password', 'trim|required', array(
                    'required'      => 'Password tidak boleh kosong!'));

            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'trim|required|matches[password1]', array(
                    'required'      => 'Konfirmasi password tidak boleh kosong!',
                    'matches'       => 'Password dan konfirmasi password harus sama!'
                ));

            if ($this->form_validation->run() == FALSE)
            {
                $this->flashmsg(validation_errors(), 'danger');
                redirect('Mahasiswa/ubah-password');
                exit;
            }
            
            $data_mahasiswa = [
                'password'  => md5($this->POST('password1'))
            ];
            $username = $this->session->userdata('username');
            $this->user_m->update($username,$data_mahasiswa);

            $this->flashmsg('Password berhasil diubah!');
            redirect('Mahasiswa/ubah-password');
            exit;
        }

        $this->template($this->data, 'mahasiswa');
    }
}
