<?php

class User_Guest extends User {
	
	protected $user_id = 0;
	protected $user_firstname = 'Guest';
	
	protected $pulse_skip = true;
	
	public function authenticated() {
		return false;
	}
}