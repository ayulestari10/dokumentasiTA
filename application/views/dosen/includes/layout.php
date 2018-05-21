<?php

	$this->load->view('dosen/includes/header', array('title' => $title));
	$this->load->view('dosen/includes/sidebar');
	$this->load->view('dosen/includes/navbar');
	$this->load->view($content);
	$this->load->view('dosen/includes/footer');
?>
