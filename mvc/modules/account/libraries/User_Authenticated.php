<?php

class User_Authenticated extends User {
	
	static public $key = 'user';
	protected $pulse_skip = false;
	
	public function authenticated() {
		return true;
	}

	static public function login($user_email, $user_hash) {
		
		if(!($user = CI::$APP->auth->login($user_email, $user_hash, __CLASS__)) instanceof self)
			return false;
		
		return $user;
	}
}