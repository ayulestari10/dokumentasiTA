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
        $this->data['data_mhs'] =  $this->Dosen_m->get_data_mahasiswa($this->data['username']);
        $this->template($this->data, 'dosen');
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
                redirect('dosen/profile');
                exit;
            }

            $data_profile = [
                'nama'  => $this->POST('nama'),
                'email'  => $this->POST('email'),
                'alamat'  => $this->POST('alamat')
            ];

            $nip = $this->POST('nip');

            $this->Dosen_m->update($nip, $data_profile);
            
            if(!empty($_FILES) && $_FILES['foto']['error'] == 0) {
                $this->upload($nip, 'dosen', 'foto');
            }

            $this->flashmsg('Data berhasil disimpan!');
            redirect('dosen/profile');
            exit;
        }

        $this->data['title']        = 'Profile'.$this->title;
        $this->data['content']      = 'dosen/profile';
        $this->data['data']         = $this->Dosen_m->get_row(['NIP' => $this->data['username']]);
        $this->template($this->data, 'dosen');
    }

    public function data_mahasiswa()
    {
        $username = $this->session->userdata('username');

        $this->data['title']    = 'Data Mahasiswa'.$this->title;
        $this->data['data_mhs'] =  $this->Dosen_m->get_data_mahasiswa($username);
        // $this->dump($this->data['data_mhs']);exit;
        $this->data['content']  = 'dosen/data_mahasiswa';
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
            $this->form_validation->set_rules('password1', 'Password', 'required', array(
                    'required'      => 'Password tidak boleh kosong'));
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password1]', array(
                    'required'      => 'Konfirmasi password tidak boleh kosong',
                    'matches'       => 'Password dan konfirmasi password harus sama'
                ));

            if ($this->form_validation->run() == FALSE)
            {
                $this->flashmsg(validation_errors(), 'danger');
                redirect('dosen/ubah-password');
                exit;
            }

            $data_dosen = [
                'password'  => md5($this->POST('password1'))
            ];
            $this->user_m->update($username,$data_dosen);

            $this->flashmsg('Password berhasil diubah!');
            redirect('dosen/ubah-password');
            exit;

        }
        //$this->dump($username);exit;
        $this->data['title']    = 'Ubah Password'.$this->title;
        $this->data['nip']      = $this->session->userdata('username');
        $this->data['content']  = 'dosen/ubah_password';
        $this->template($this->data, 'dosen');
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
