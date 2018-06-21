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
        
        if (!isset($this->data['username'], $this->data['role']) or $this->data['role'] != "dosen")
        {
            $this->session->sess_destroy();
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

    public function data_mahasiswa($username)
    {
        $username = $this->session->userdata['username'];

        $this->data['title']  = 'Data Mahasiswa'.$this->title;
        $this->data['content']  = 'dosen/data_mahasiswa';
        $this->template($this->data, 'dosen');

        $data = array(
                    'title' => 'Data Mahasiswa'.$this->title,
                    'content' => 'dosen/data_mahasiswa',
                    'data_mhs' => $this->Dosen_m->get_data_mahasiswa($username)
                );

        $this->load->view('dosen/includes/layout',$data);

    }

    public function detail_dokumen()
    {
        $this->data['title']  = 'Detail Dokumen'.$this->title;
        $this->data['content']  = 'dosen/detail_dokumen';
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
}

?>
