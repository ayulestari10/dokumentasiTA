<?php 

class Dosen extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'dosen';
		$this->data['primary_key']	= 'NIP';
	}
}