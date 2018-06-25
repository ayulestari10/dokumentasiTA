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

        if (!isset($this->data['username'], $this->data['role']) or $this->data['role'] != "dosen" or $this->data['role'] != "admin" or $this->data['role'] != "mahasiswa")
        {
            $_SESSION['user_logged'] = FALSE;
        }

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

    public function download($getNim){
        if (!isset($this->data['username'], $this->data['role']))
        {
            $this->session->sess_destroy();
            $this->flashmsg('Anda harus login dulu!','warning');
            redirect('login');
            exit;
        }
        else{

            if (file_exists('assets/File_TugasAkhir/'.$getNim.'.pdf')) {
            $this->load->helper('download');
            force_download('assets/File_TugasAkhir/'.$getNim.'.pdf',NULL);
            redirect('mahasiswa/data-dokumen');
            }else{
                $this->flashmsg('File tidak ada !','danger');
                redirect('mahasiswa/data-dokumen');
            }
        }
        
    }
     
    public function search(){

        $keyword = $this->input->post('keyword');

        $this->data['title']  = 'Home'.$this->title;
        $this->data['content']  = 'home/home';
        $this->data['dokumenTA'] = $this->tugas_akhir_m->search($keyword);
        
        $this->template($this->data, 'Home');
    }

    public function konsentrasi(){
        $konsentrasi = $this->uri->segment(3);

        if (isset($konsentrasi)) {

            if($konsentrasi == "Semua"){
                redirect('home');
                exit;
            }

            $konsentrasi = str_replace('_', ' ', $konsentrasi);
            $this->data['dokumenTA'] = $this->tugas_akhir_m->konsentrasi($konsentrasi);
            
            if(count($this->data['dokumenTA']) <= 0 ){
                $this->flashmsg('Dokumen tidak ada!','warning');
            }
        }
        else{
            $this->flashmsg('Konsentrasi tidak dicantumkan!','danger');
            redirect('home');
            exit;
        }

        $this->data['title']  = 'Home'.$this->title;
        $this->data['content']  = 'home/home';
        $this->template($this->data, 'Home'); 
    }

    public function tahun_pembuatan(){
        $tahun = $this->uri->segment(3);

        if (isset($tahun)) {
            $this->data['dokumenTA'] = $this->tugas_akhir_m->tahun_pembuatan($tahun);
            
            if(count($this->data['dokumenTA']) <= 0 ){
                $this->flashmsg('Dokumen tidak ada!','warning');
            }
        }
        else{
            $this->flashmsg('Tahun tidak dicantumkan!','danger');
            redirect('home');
            exit;
        }

        $this->data['title']  = 'Home'.$this->title;
        $this->data['content']  = 'home/home';
        $this->template($this->data, 'Home'); 
    }

    public function tampil_pdf($getNim)
    {

    if (!isset($this->data['username'], $this->data['role']))
    {
        $this->session->sess_destroy();
        $this->flashmsg('Anda harus login dulu!','warning');
        redirect('login');
        exit;
    }
    else
    {
       if (isset($getNim) && !empty($getNim)) 
       { 

          $fileInfo = $this->tugas_akhir_m->get_data($getNim);

          $uploads_folder = 'assets/File_TugasAkhir/';
          $file_name = $getNim.'.pdf';
          $file = '';
          foreach ($fileInfo as $key => $value) 
          {
              $value->url_pdf = base_url().$uploads_folder. $getNim .'pdf'; 
              $file = $uploads_folder.$file_name; 

          }        
                  $data['file'] = $file;
                  $data['nim'] = $getNim;
                

                  $this->load->view('tampil',$data);
        } 
    }
       
}
    
}

?>

