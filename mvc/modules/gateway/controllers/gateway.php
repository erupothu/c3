<?php

class Gateway extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->library('Gateway_Sagepay', array(), 'gateway');
	}
	
	public function index() {
		echo $this->gateway->test();
	}
	
	public function success() {
		
		$crypt = $this->input->get('crypt');
		$data = $this->gateway->tokenize($crypt, true);
		
		var_dump($data);
		
	}
	
	public function failure() {
		
		$crypt = $this->input->get('crypt');
		$data = $this->gateway->tokenize($crypt, true);
		
		var_dump($data);
	}
	
}