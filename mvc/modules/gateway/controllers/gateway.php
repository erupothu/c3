<?php

class Gateway extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->library('Gateway_Sagepay', array(), 'gateway');
	}
	
	public function index() {
		$this->load->module('cart');
		$this->gateway->test();
	}
	
	
	/**
	 * success
	 *
	 * @return void
	 */
	public function success() {
		
		$crypt = $this->input->get('crypt');
		$data = $this->gateway->tokenize($crypt, true);
		
		echo '<pre>';
		print_r($data);
		
		echo sha1($crypt);
		echo '</pre>';
	
	}
	
	
	/**
	 * failure
	 *
	 * @return void
	 */
	public function failure() {
		
		$crypt = $this->input->get('crypt');
		$data = $this->gateway->tokenize($crypt, true);
		
		var_dump($data);
	}
}