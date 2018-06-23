<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends MY_Controller
{
    private $data = [];

    public function __construct()
    {
      parent::__construct(); 
        $this->data['username']     = $this->session->userdata('username');
        $this->data['role']         = $this->session->userdata('role');
        
        if (!isset($this->data['username'], $this->data['role']) or $this->data['role'] != "dosen" )
        {
            $this->session->sess_destroy();
            $this->flashmsg('Anda harus login dulu!','warning');
            redirect('login');
            exit;
        }

        $this->load->model('user_m');
        $this->load->model('mahasiswa_m');
        $this->load->model('Dosen_m');
        $this->load->model('tugas_akhir_m');

    }

    public function index()
    {
        $this->data['title']  = 'Dashboard Dosen'.$this->title;
        $this->data['content']  = 'dosen/dashboard';
        $this->template($this->data, 'dosen');
    }

    public function data_mahasiswa()
    {
        $username = $this->session->userdata['username'];

        $this->data['title']  = 'Data Mahasiswa'.$this->title;
        $this->data['content']  = 'dosen/data_mahasiswa';
        $this->data['data_mhs'] =  $this->Dosen_m->get_data_mahasiswa($username);
        $this->template($this->data, 'dosen');
    }

    public function detail_dokumen($nim)
    {   
        
        $this->data['title']  = 'Detail Dokumen'.$this->title;
        $this->data['content']  = 'dosen/detail_dokumen';
        $this->data['detail']  = $this->Dosen_m->detail_ta($nim);
        $this->data['dp1'] = $this->Dosen_m->getNamaDosen1($this->data['detail']->dosen_pembimbing1);
        $this->data['dp2'] = $this->Dosen_m->getNamaDosen2($this->data['detail']->dosen_pembimbing2);
        //$this->dump($this->data['detail']);
        $this->template($this->data, 'dosen');
    }

    public function tampil_pdf($nim)
    {
        $fileInfo = $fileInfo = $this->tugas_akhir_m->get_data($nim);

          $uploads_folder = 'uploads';
          $file = '';
          foreach ($fileInfo as $key => $value) 
          {
              $value->url_pdf = base_url().$uploads_folder.'/'. $value->judulTA; 
              $file = $uploads_folder.'/'. $value->judulTA; 

          }

          $data['file'] = $file;
          $data['id'] = $id_file;
        

          $this->tampil($data);
    }

    public function ubah_password()
    {
        $username = $this->session->userdata['username'];

        if($this->POST('simpan')){
            if($this->POST('password1') != $this->POST('password2')){
                $this->flashmsg('Password dan konfirmasi password tidak sama!', 'warning');
                redirect('dosen/ubah-password');
                exit;
            }

            $data_mahasiswa = [
                'password'  => md5($this->POST('password1'))
            ];
            $this->user_m->update($username,$data_mahasiswa);

            $this->flashmsg('Password berhasil diubah!');
            redirect('dosen/ubah-password');
            exit;

        }else{
            $this->data['title']  = 'Ubah Password'.$this->title;
            $this->data['content']  = 'dosen/ubah_password';
            $this->template($this->data, 'dosen');
        }
    }

    public function download($getNim){
        
        if (file_exists('assets/File_TugasAkhir/'.$getNim.'.pdf')) {
            $this->load->helper('download');
            force_download('assets/File_TugasAkhir/'.$getNim.'.pdf',NULL);
            redirect('mahasiswa\data_dokumen');
        }else{
            $this->flashmsg('File tidak ada !','danger');
            redirect('mahasiswa/data_dokumen');
        }
        
    }

}

?>
