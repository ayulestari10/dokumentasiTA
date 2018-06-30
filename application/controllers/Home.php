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
        $this->data['dokumenTA']  = $this->tugas_akhir_m->get_ta();
        $this->data['title']  = 'Home'.$this->title;
        $this->data['content']  = 'home/home';
        $this->template($this->data, 'home');
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
            redirect('home');
            }else{
                $this->flashmsg('File tidak ada !','danger');
                redirect('home');
            }
        }
        
    }
     
    public function search()
    {

        $keyword = $this->input->post('keyword');

        if (isset($keyword)) {
            if(strlen($keyword) > 0){
                $this->data['dokumenTA'] = $this->tugas_akhir_m->search($keyword);
                
                if(count($this->data['dokumenTA']) <= 0 ){
                    $this->flashmsg('Dokumen tidak ada!', 'warning', 'message2');
                    redirect('home/search');
                    exit;               
                }
                else{
                    $result = [];
                    foreach($this->data['dokumenTA'] as $row){
                        $status = $row->status;
                        
                        if($status == "Terverifikasi"){
                            $result[] = $row;
                        }
                    }

                    $this->data['dokumenTA'] = $result;

                    if(count($this->data['dokumenTA']) <= 0){
                        $this->flashmsg('Dokumen tidak ada!', 'warning', 'message2');
                        redirect('home/search');
                        exit;
                    }

                    $this->flashmsg('Dokumen ditemukan!','success', 'message2');
                }
            }
            else {
                $this->flashmsg('Kata kunci tidak boleh kosong!', 'danger', 'message2');
                redirect('home/search');
                exit;
            }
        }

        $this->data['title']  = 'Home'.$this->title;
        $this->data['content']  = 'home/home';
        $this->template($this->data, 'Home');

    }

    public function konsentrasi(){
        $konsentrasi = $this->uri->segment(3);

        if (isset($konsentrasi)) {

            if($konsentrasi == "Semua"){
                $this->flashmsg('Dokumen ditemukan!','success', 'message2');
                redirect('home');
                exit;
            }
            else{
                $konsentrasi = str_replace('_', ' ', $konsentrasi);
                $this->data['dokumenTA'] = $this->tugas_akhir_m->konsentrasi($konsentrasi);
                
                if(count($this->data['dokumenTA']) <= 0 ){
                    $this->flashmsg('Dokumen tidak ada!','warning', 'message2');
                    redirect('home/search');
                    exit;
                }
                else{
                    $this->flashmsg('Dokumen ditemukan!','success', 'message2');
                }
            }

            
        }
        else{
            $this->flashmsg('Konsentrasi tidak dicantumkan!','danger', 'message2');
            redirect('home/search');
            exit;
        }

        $this->data['title']  = 'Home'.$this->title;
        $this->data['content']  = 'home/home';
        $this->template($this->data, 'Home'); 
    }

    public function tahun_pembuatan(){
        if($this->POST('cari')){
            $this->data['response']['result'] = [];
            $tahun = $this->POST('tahun');

            $dokumen = $this->tugas_akhir_m->tahun_pembuatan($tahun);

            if(count($dokumen) > 0){
                foreach($dokumen as $row){
                    $this->data['result'] [] = [
                        'NIM'   => $row->NIM,
                        'judulTA' => $row->judulTA,
                        'nama'  => $row->nama,
                        'konsentrasi' => $row->konsentrasi,
                        'tahun_pembuatan' => $row->tahun_pembuatan,
                        'abstrak' => $row->abstrak
                    ];
                }

                $this->data['response'] = [
                    'result' => $this->data['result']
                ];
            }

            echo json_encode($this->data['response']);
            exit;
        }
        $this->data['title']  = 'Home'.$this->title;
        $this->data['content']  = 'home/home';
        $this->template($this->data, 'Home'); 
    }

    public function tampil_pdf()
    {
        $getNim = $this->uri->segment(3);

        if (!isset($this->data['username'], $this->data['role']))
        {
            $this->session->sess_destroy();
            $this->flashmsg('Anda harus login dulu!','warning');
            redirect('login');
            exit;
        }
        else if (file_exists('assets/File_TugasAkhir/'.$getNim.'.pdf'))
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
        else
        {
              $this->flashmsg('File tidak ada !','danger');
              redirect('home');  
        }

    }
    
}

?>

