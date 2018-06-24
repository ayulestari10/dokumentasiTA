<?php

	$this->load->view('login/includes/header', array('title' => $title));
	$this->load->view('login/includes/navbar');
	$this->load->view($content);
	//$this->load->view('login/includes/footer');
?>
