<?php

require_once APPPATH . 'libraries/User_Guest.php';
require_once APPPATH . 'libraries/User_Administrator.php';
require_once APPPATH . 'modules/account/libraries/User_Authenticated.php';

class Auth {
	
	private $db;
	
	public function __construct($return = false) {
		
		CI::$APP->load->library('Session');
		$this->db = &get_instance()->db;
	}
	
	/**
	 * login
	 *
	 * @param string $username 
	 * @param string $password 
	 * @param string $clauses 
	 * @return void
	 * 
	 * return Guest by default.
	 * 
	 * 
	 * 
	 * 
	 */
	public function login($unique_identifier, $password, $auth_class = null, $additional_clauses = array()) {
		
		$this->db->select('*');
		$this->db->from('user u');
		$this->db->where('u.user_email', $unique_identifier);
		$this->db->where('u.user_password', self::encrypt($password));
		$this->db->limit(1);

		// Process additional clauses.
		foreach($additional_clauses as $clause_field => $clause_value) {
			$this->db->where($clause_field, $clause_value);
		}
		
		$user_result = $this->db->get();
		if($user_result->num_rows() !== 1) {
			return new User_Guest;
		}
		
		if(is_null($auth_class)) {
			$auth_class = 'User_Authenticated';
		}
		
		$user = $user_result->row(0, $auth_class);
		$user->init();
		$this->pulse();
		
		return $user;
	}
	
	public function logout($auth_class = null) {

		if(is_null($auth_class)) {
			return CI::$APP->session->destroy();
		}
		
		if(!CI::$APP->session->get('auth/' . $auth_class::$key)) {
			return false;
		}
		
		return CI::$APP->session->set('auth/' . $auth_class::$key, null);
	}
	
	public function pulse() {
		
		if(!CI::$APP->session->get('auth/user')) {
			$user = new User_Guest;
			get_instance()->user = &$user;
		}
		
		// Drop out if there are no authenticated sessions.
		if(!$data = CI::$APP->session->get('auth')) {
			return false;
		}
		
		foreach($data as $_key => $sub_data) {
			
			$user_class = $sub_data['file'];
			$auth_key = $user_class::$key;
			
			list($user_id, $user_password) = explode(':', $sub_data['hash']);
		
			$this->db->select('*');
			$this->db->from('user u');
			$this->db->where('u.user_id', $user_id);
			$this->db->where('u.user_password', $user_password);
			$user_result = $this->db->get();
			if($user_result->num_rows() !== 1) {
				CI::$APP->session->set('auth/' . $auth_key, null);
				continue;
			}

			CI::$APP->session->set('auth/' . $auth_key . '/ping', time());
			get_instance()->{$auth_key} = &$user_result->row(0, $user_class);
		}
	}
	
	static public function encrypt($string) {
		
		$security_settings = get_instance()->insight->config('security');
		
		// Do we have this algorithm?
		if(!in_array($security_settings['algorithm'], hash_algos())) {
			throw new Exception('I cannot find the algorithm: "' . $security_settings['algorithm'] . '". Try: ' . implode(', ', hash_algos()));
		}
		
		return hash($security_settings['algorithm'], $security_settings['salt_one'] . $string . $security_settings['salt_two'], false);
	}

	static public function generate_password($length = 8, $ords = null, $encrypt = false) {

		$pass = '';
		$ords = is_null($ords) ? array_merge($let = range(97, 122), $num = range(48, 57)) : $ords;
		for($r = 0; $r < $length; $r++) {

			// Force it to start with a letter if there
			// are no forced ords via $ords.
			if($r == 0 && isset($let)) {
				$pass .= chr($let[array_rand($let)]);
				continue;
			}

			$pass .= chr($ords[array_rand($ords)]);
		}

		if(!$encrypt)
			return $pass;
		
		return self::encrypt($pass);
	}
	
	static public function generate_pw($length = 8) {
		die('playing!  dont use this.');
		$list = explode(PHP_EOL, `cat /usr/share/dict/words | awk 'length == 8'`);
		$word = $list[array_rand($list, 1)];
		var_dump(strtolower(substr($word, 0, 1) . strtr(substr($word, 1), 'aeo', '430')));
	}

	static protected function generate_distinct_ords() {		

		return array_merge(
			array(74, 75, 77, 78, 80, 107, 109, 110),
			range(50, 57), 
			range(65, 72), 
			range(82, 90), 
			range(97, 104), 
			range(112, 122)
		);
	}
}

abstract class User {
	
	static public $key;
	abstract public function authenticated();

	public function init() {
		
		if(isset($this->pulse_skip) && $this->pulse_skip)
			return;
		
		$class = get_class($this);
		
		$key = 'auth/' . $class::$key;
		
		if(!CI::$APP->session->get($key)) {
			
			CI::$APP->session->set($key, array(
				'time' => time(),
				'hash' => sprintf('%d:%s', $this->user_id, $this->user_password),
				'file' => $class
			));
		}
		
		// Set the pulse time.
		CI::$APP->session->set($key . '/ping', time());
	}
	
	public function logout() {
		return CI::$APP->auth->logout(get_class($this));
	}
	
	public function id() {
		return (int)$this->user_id;
	}
	
	public function name() {
		return sprintf('%s %s', $this->user_firstname, $this->user_lastname);
	}
	
	public function email() {
		return $this->user_email;
	}
	
	public function can($permission = null) {
		return true;
	}
	
	public function cannot($permission = null) {
		return !$this->can($permission);
	}
}