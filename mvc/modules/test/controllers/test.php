<?php

class Test extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		echo 'Test Controller';
	}
	
	public function second() {
		echo 'Second Method';
	}
}