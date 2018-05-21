<?php

	$this->load->view('admin/includes/header', array('title' => $title));
	$this->load->view('admin/includes/sidebar');
	$this->load->view('admin/includes/navbar');
	$this->load->view($content);
	$this->load->view('admin/includes/footer');
?>
