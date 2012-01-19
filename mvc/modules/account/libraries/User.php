<?php

class User extends Auth {
	
	/*
	public function __construct() {
		parent::__construct();
	}
	*/
	
	/*
	public function login($a, $b) {
		echo $a . '<br />';
		echo $b . '<br />';
		
		return false;
	}
	*/
}

class User_Ob {
	public $l;
	public function __construct($l) {
		$this->l = $l;
	}
}