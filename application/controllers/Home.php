<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    private $data = [];

    public function __construct()
    {
      parent::__construct(); 
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

    public function download($nim)
    {
        if(!empty($nim))
    {
            
            $this->load->helper('download');

            $fileInfo = $this->tugas_akhir_m->get_data($nim);

            $uploads_folder = 'assets/File_TugasAkhir';
            $file = '';
            foreach ($fileInfo as $key => $value) 
            {
                $value->url_pdf = base_url().$uploads_folder.'/'. $value->nim.'.pdf';
                $file = $uploads_folder.'/'. $value->nim.'pdf';
            }

            force_download($file, NULL);
        }
    }
}

?>
