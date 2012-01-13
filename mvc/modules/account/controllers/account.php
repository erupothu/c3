<?php

class Account extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
	}
	
	public function index() {
		echo 'account::index';
	}

	public function register() {
		echo 'account::register';
	}

	public function log_in() {
		echo 'account::log_in';
	}
	
	public function log_out() {
		echo 'account::log_out';
		
		redirect();
	}
}