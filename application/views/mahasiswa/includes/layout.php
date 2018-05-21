<?php

	$this->load->view('mahasiswa/includes/header', array('title' => $title));
	$this->load->view('mahasiswa/includes/sidebar');
	$this->load->view('mahasiswa/includes/navbar');
	$this->load->view($content);
	$this->load->view('mahasiswa/includes/footer');
?>
