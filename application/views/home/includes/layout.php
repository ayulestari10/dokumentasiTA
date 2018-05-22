<?php

	$this->load->view('home/includes/header', array('title' => $title));
	// $this->load->view('home/includes/sidebar');
	$this->load->view('home/includes/navbar');
	$this->load->view($content);
	$this->load->view('home/includes/footer');
?>
