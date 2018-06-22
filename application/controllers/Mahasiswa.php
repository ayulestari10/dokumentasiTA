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

    // public function __toString(){
    //     return $this->nama;sss
    // }

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
            $dataInd = array(
                            'nama'  => NULL,
                            'jurusan' => NULL,
                            'email' => NULL,
                            'angkatan' => NULL,
                            'alamat'    => NULL
                        );
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
            $this->Mahasiswa_m->update($nim, $dataInd);
            $this->tugas_akhir_m->update($nim, $dataTA);
            $this->flashmsg('Data berhasil dihapus', 'success');
            redirect('Mahasiswa\data_dokumen');
            exit;
        }

        $this->template($this->data, 'mahasiswa');
    }

    public function unggah_dokumen()
    {
        $this->data['title']  = 'Mengunggah Dokumen'.$this->title;
        $this->data['content']  = 'mahasiswa/mengunggah_dokumen';
        $this->data['ta'] = $this->tugas_akhir_m->getDatabyNim($this->data['username']);
        $this->data['individu'] = $this->Mahasiswa_m->getDatabyNim($this->data['username']);
        $this->data['dosen'] = $this->dosen_m->getAll();

        if ($this->POST('simpan'))
        {
                $nim        = $this->data['username'];
                $nama       = $this->POST('nama');
                $jurusan    = $this->POST('jurusan');
                $email      = $this->POST('email');
                $angkatan   = $this->POST('angkatan');
                $alamat     = $this->POST('alamat');
                $judul      = $this->POST('judul');
                $konsentrasi= $this->POST('konsentrasi');
                $tahun      = $this->POST('tahun');
                $dp1        = $this->POST('dosen_pembimbing1');
                $dp2        = $this->POST('dosen_pembimbing2');
                $file       = $this->POST('upload_file');
                $abstrak    = $this->POST('abstrak');

                $dataInd = array(
                            'nama'  => $nama,
                            'jurusan' => $jurusan,
                            'email' => $email,
                            'angkatan' => $angkatan,
                            'alamat'    => $alamat
                        );

                $dataTA = array(
                            'judulTA' => $judul,
                            'konsentrasi' => $konsentrasi,
                            'tahun_pembuatan' => $tahun,
                            'dosen_pembimbing1' => $dp1,
                            'dosen_pembimbing2' => $dp2,
                            'abstrak' => $abstrak
                        );

                $cekNIM_TA = $this->tugas_akhir_m->getDatabyNim($nim);
                $cekNIM_Individu = $this->Mahasiswa_m->getDatabyNim($nim);

                if(count($cekNIM_Individu) > 0 && count($cekNIM_TA) > 0){
                    $this->Mahasiswa_m->update($nim, $dataInd);
                    $this->tugas_akhir_m->update($nim, $dataTA);
                    $this->uploadPDF($nim, 'upload_file');

                    $this->flashmsg('Data tugas akhir berhasil disimpan!');
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
            redirect('mahasiswa\data_dokumen');
        }else{
            $this->flashmsg('File tidak ada !','danger');
            redirect('mahasiswa/data_dokumen');
        }
        
    }

    public function ubah_password()
    {
        $this->data['title']  = 'Ubah Password'.$this->title;
        $this->data['content']  = 'mahasiswa/ubah_password';

        if($this->POST('simpan')){
            
            $this->form_validation->set_rules('password1', 'Password', 'required', array(
                    'required'      => 'Password tidak boleh kosong'));
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password1]', array(
                    'required'      => 'Konfirmasi password tidak boleh kosong',
                    'matches'       => 'Password dan konfirmasi password harus sama'
                ));

            if ($this->form_validation->run() == FALSE)
            {
                $this->flashmsg(validation_errors(), 'danger');
                redirect('mahasiswa/ubah-password');
                exit;
            }

            $data_mahasiswa = [
                'password'  => md5($this->POST('password1'))
            ];
            $this->user_m->update($username,$data_mahasiswa);

            $this->flashmsg('Data berhasil diedit!');
            redirect('mahasiswa/ubah-password');
            exit;
        }

        $this->template($this->data, 'mahasiswa');
    }
}
