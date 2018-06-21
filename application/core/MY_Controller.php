<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
  	public $title = ' | Dokumentasi TA';
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	public function template($data, $template = 'admin')
	{
	    if ($template == 'admin') {
	      return $this->load->view('admin/includes/layout', $data);
	    }
	    elseif($template == 'mahasiswa') {
	      return $this->load->view('mahasiswa/includes/layout', $data);
	    }
	    elseif($template == 'dosen') {
	      return $this->load->view('dosen/includes/layout', $data);
	    }
	    else {
	      return $this->load->view('home/includes/layout', $data);
	    }
	}

	public function POST($name)
	{
		return $this->input->post($name);
	}

	public function flashmsg($msg, $type = 'success',$name='msg')
	{
		return $this->session->set_flashdata($name, '<div class="alert alert-'.$type.' alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>');
	}

	public function upload($id, $directory, $tag_name = 'userfile')
	{
		if ($_FILES[$tag_name])
		{
			$upload_path = realpath(APPPATH . '../assets/' . $directory . '/');
			@unlink($upload_path . '/' . $id . '.jpg');
			$config = [
				'file_name' 		=> $id . '.jpg',
				'allowed_types'		=> 'jpg|png|bmp|jpeg',
				'upload_path'		=> $upload_path
			];
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload($tag_name);
		}
		return FALSE;
	}

	public function upload_any_type($id,$directory, $tag_name = 'userfile')
	{
		if ($_FILES[$tag_name])
		{
			// ini_set('upload_max_filesize', '300M');
			$upload_path = realpath(APPPATH . '../assets/' . $directory . '/');
			@unlink($upload_path . '/' . $id);
			$config = [
				'file_name'			=> $id,
				'allowed_types'		=> 'doc|docx|xls|xlsx|ppt|pptx|pdf|txt',
				'upload_path'		=> $upload_path
			];
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload($tag_name);
		}
		return FALSE;
	}

	public function uploadPDF($id, $tag_name = 'userfile')
	{
		if ($_FILES[$tag_name])
		{
			$upload_path = realpath(APPPATH . '../assets/File_TugasAkhir/');
			@unlink($upload_path . '/' . $id . '.pdf');
			$config = [
				'file_name'			=> $id . '.pdf',
				'allowed_types'		=> 'pdf',
				'upload_path'		=> $upload_path
			];
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload($tag_name);
		}
		return FALSE;
	}

	public function dump($var)
	{
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
}
