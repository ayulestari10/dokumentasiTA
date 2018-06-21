<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    private $data = [];

    public function __construct()
    {
      parent::__construct(); 
      $this->data['username']     = $this->session->userdata('username');
        $this->data['role']         = $this->session->userdata('role');

        $this->load->model('user_m');
        $this->load->model('mahasiswa_m');
        $this->load->model('Dosen_m');
        $this->load->model('tugas_akhir_m');
    }

    public function index()
    {

        $data = array(
            'title' => 'Home'.$this->title,
            'content' => 'home/home',
            'dokumenTA' => $this->tugas_akhir_m->get_ta()
        );

        $this->load->view('home/includes/layout',$data);
    }

    public function download($getNim)
    {
        if (!isset($this->data['username'], $this->data['role']) or $this->data['role'] != "dosen" or $this->data['role'] != "admin" or $this->data['role'] != "mahasiswa")
        {
            $this->session->sess_destroy();
            redirect('login');
            exit;
        }
        
        $this->load->helper('download');
        force_download('assets/File_TugasAkhir/0'.$getNim.'.pdf',NULL);
        redirect('mahasiswa\data_dokumen');
    }
}

?>
