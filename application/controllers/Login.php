<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
	private $data = [];

  	public function __construct() {

	    parent::__construct();	
	    $username 		= $this->session->userdata('username');
	    $role	 		= $this->session->userdata('role');

	    if(isset($username, $role)){
	    	if($role == "mahasiswa"){
	    		redirect('mahasiswa');
	    		exit;
	    	}
	    	elseif($role == "dosen"){
	    		redirect('dosen');
	    		exit;
	    	}
	    	else{
	    		redirect('admin');
	    		exit;
	    	}
	    }

	     // load form_validation library
        $this->load->library('form_validation');

  	}

	public function index() {

  		if ($this->POST('login-submit')) {
  			$this->form_validation->set_rules('username', 'Username', 'required|min_length[14]|max_length[18]|alpha_numeric');
  			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == FALSE)
	        {
	        	// echo validation_errors(); exit;
	        	$this->flashmsg(validation_errors(), 'danger');
	            redirect('login');
	            exit;
	        }
	        else
	        {
	            // load success template...
	            echo "It's all Good!";exit;
	        }


			$this->load->model('user_m');
			if (!$this->user_m->required_input(['username','password'])){
				$this->flashmsg('Data harus lengkap!','warning');
				redirect('login');
				exit;
			}
			
			$this->data = [
    			'username'	=> $this->POST('username'),
    			'password'	=> md5($this->POST('password'))
			];

			$role = $this->POST('role');
			
			$result = $this->user_m->login($this->data);
			if (!isset($result)) {
				$this->flashmsg('Username atau password salah','danger');
			}

			if(isset($role)){
		    	$this->load->model($role);
		    	
		    	if($role == "mahasiswa"){
		    		$cek_data = $this->$role->get(['NIM' => $this->POST('username')]);
		    	}
		    	elseif($role == "dosen"){
		    		$cek_data = $this->$role->get(['NIP' => $this->POST('username')]);
		    	}
		    	else{
		    		$cek_data = $this->$role->get(['NIPUS' => $this->POST('username')]);
		    	}
		    	
		    	if(count($cek_data) != 0){
					$this->session->set_userdata('role', $role);
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
						$this->flashmsg('Akun tidak terdaftar!','danger');
						redirect('login');
						exit;
					}
				}
				else{
					$this->flashmsg('Akun tidak terdaftar!','danger');
					redirect('login');
					exit;
				}
			}
		}

		$this->data['title'] = 'Login'.$this->title;
		$this->load->view('login',$this->data);
	}

}
