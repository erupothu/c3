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
			get_instance()->{$auth_key} = &$user_result->row(0, $user_class);//array('test');
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

}

abstract class User {
	
	static public $key;
	abstract public function authenticated();

	public function init() {
		
		if(isset($this->pulse_skip) && $this->pulse_skip)
			return;
		
		$class = get_class($this);
		
		$key = 'auth/' . $class::$key;//substr(strtolower(get_class($this)), 5);
		
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
	
	public function name() {
		return sprintf('%s %s', $this->user_firstname, $this->user_lastname);
	}
	
	
	public function can($permission = null) {
		return true;
	}
	
	public function cannot($permission = null) {
		return !$this->can($permission);
	}
}