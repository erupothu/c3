<?php

class User_Guest extends User {
	
	protected $pulse_skip = true;
	
	public function authenticated() {
		return false;
	}
}