<?php

class Auth {
	
	protected $db;
	protected $session;
	protected $configuration;
	
	public function __construct() {
		
		$ci = &get_instance();
		$ci->load->library('Session');
		
		$this->db = &$ci->db;
		$this->session = &$ci->session;
		
		// temp?
		$this->ping();
	}
	
	public function login($email_address, $password, $additional_clauses = array()) {
		
		//var_dump(get_class());
		
		$this->db->select('*');
		$this->db->from('user u');
		$this->db->where('u.user_email', $email_address);
		$this->db->where('u.user_password', self::encrypt($password));
		$this->db->limit(1);
		
		// Process additional clauses.
		foreach($additional_clauses as $clause_field => $clause_value) {
			$this->db->where($clause_field, $clause_value);
		}
		
		$user_result = $this->db->get();
		if($user_result->num_rows() !== 1) {
			return false;
		}
		
		$user = $user_result->row_array();
		
		$this->session->set('user/hash', sprintf('%d:%s', $user['user_id'], $user['user_password']));
		$this->session->set('user/time', time());
		$this->session->set('user/ping', time());
		$this->session->set('user/data', $user);
		
		return true;
	}
	
	public function logout() {
		return $this->session->destroy();
	}
	
	public function ping($update = true) {
		
		if(!$this->is_logged_in())
			return false;
			
		$hash_parts = explode(':', $this->session->get('user/hash'));
		$this->db->select('*');
		$this->db->from('user u');
		$this->db->where('u.user_id', $hash_parts[0]);
		$this->db->where('u.user_password', $hash_parts[1]);
		$user_result = $this->db->get();
		if($user_result->num_rows() !== 1) {
			return $this->logout();
		}
		
		$this->session->set('user/ping', time());
		$this->session->set('user/data', $user_result->row_array());
		
		// Set last seen time.
		if($update) {
			$ping_time = new DateTime;
			$this->db->update('user', array('user_date_lastseen' => $ping_time->format('Y-m-d H:i:s')), array('user_id' => $hash_parts[0]));
		}
		
		return true;
	}
	
	public function is_logged_in() {
		return false !== $this->session->get('user/hash');
	}
	
	static public function encrypt($source_string) {
		
		$security_settings = get_instance()->insight->config('security');
		
		// Do we have this algorithm?
		if(!in_array($security_settings['algorithm'], hash_algos())) {
			throw new Exception('I cannot find the algorithm: "' . $security_settings['algorithm'] . '". Try: ' . implode(', ', hash_algos()));
		}
		
		return hash($security_settings['algorithm'], $security_settings['salt_one'] . $source_string . $security_settings['salt_two'], false);
	}
	
	static public function generate_password($length = 8, $ords = null) {
		
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
		
		return $pass;
	}
	
	static public function generate_distinct_ords() {		

		return array_merge(
			array(74, 75, 77, 78, 80, 107, 109, 110),
			range(50, 57), 
			range(65, 72), 
			range(82, 90), 
			range(97, 104), 
			range(112, 122)
		);
	}
	
	public function can() { return true; }
	public function cannot() { return false; }
}