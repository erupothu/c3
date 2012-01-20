<?php

class User_Administrator extends User {
	
	static public $key = 'administrator';
	protected $pulse_skip = false;
	
	public function authenticated() {
		return true;
	}

	static public function login($user_email, $user_hash) {
		return CI::$APP->auth->login($user_email, $user_hash, __CLASS__, array('u.user_administrator' => 1));
	}
}