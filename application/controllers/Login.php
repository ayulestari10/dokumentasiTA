<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
	private $data = [];

  	public function __construct() {

	    parent::__construct();	
	    $username 		= $this->session->userdata('username');
	    $role	 		= $this->session->userdata('role');

	    if(isset($role)){
	    	$this->load->model($role);
	    	
	    	if($role == "mahasiswa"){
	    		$cek_data = $this->$role->get(['NIM' => $username]);
	    	}
	    	elseif($role == "dosen"){
	    		$cek_data = $this->$role->get(['NIP' => $username]);
	    	}
	    	else{
	    		$cek_data = $this->$role->get(['NIPUS' => $username]);
	    	}
	    	
	    	if (count($cek_data) != 0){
				if($role == "mahasiswa"){
					redirect('Mahasiswa');
					exit;
				}
				elseif($role == "dosen"){
					redirect('Dosen');
					exit;
				}
				elseif($role == "admin"){
					redirect('Admin');
					exit;
				}
				else{
					redirect('login');
					exit;
				}
			}
	    } 
  	}

	public function index() {

  		if ($this->POST('login-submit')) {
			$this->load->model('user_m');
			if (!$this->user_m->required_input(['username','password'])){
				$this->flashmsg('Data harus lengkap','warning');
				redirect('login');
				exit;
			}
			
			$this->data = [
    			'username'	=> $this->POST('username'),
    			'password'	=> md5($this->POST('password'))
			];

			$role = $this->POST('role');
			$this->session->set_userdata('role', $role);
			
			$result = $this->user_m->login($this->data);
			if (!isset($result)) {
				$this->flashmsg('Username atau password salah','danger');
			}
			redirect('login');
			exit;
		}

		$this->data['title'] = 'LOGIN'.$this->title;
		$this->load->view('login',$this->data);
	}

}
