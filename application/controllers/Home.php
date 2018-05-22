<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    private $data = [];

    public function __construct()
    {
      parent::__construct(); 
    }

    public function index()
    {
        $this->data['title']    = 'Home'.$this->title;
        $this->data['content']  = 'home/home';
        $this->template($this->data, 'home');
    }


}

?>
