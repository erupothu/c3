<?php

class INSIGHT_Session extends CI_Session {
	
	protected $session_ttl = 360;
	
	/**
	* __construct
	*/
	public function __construct($configuration = array()) {
		$this->_sess_run();
	}
	
	/**
	* get
	*/
	public function get($path = null, $remove = false) {

		if(is_null($path))
			return $_SESSION;
		
		$pointer = &$_SESSION;
		foreach($explode = explode('/', $path) as $e => $segment) {
			
			if(!isset($pointer[$segment]))
				return false;
			
			if($e == count($explode) - 1 && $remove) {
				$find_data = $pointer[$segment];
				unset($pointer[$segment]);
				return $find_data;
			}
			
			$pointer = &$pointer[$segment];
		}
		
		return $pointer;
	}
	
	/**
	* @name afasfsa
	* @author Jon
	*/
	public function set($path, $value) {

		$pointer = &$_SESSION;
		foreach($explode = explode('/', $path) as $segment) {
			
			if($segment !== end($explode)) {
				
				if(!isset($pointer[$segment])) {
					$pointer[$segment] = array();
				}

				$pointer =& $pointer[$segment];
				continue;
			}
			
			// Set the end-point to the new value.
			$pointer[$segment] = $value;
		}
		
		return true;		
	}
	
	public function set_flashdata($path, $value) {
		$this->set('flash/' . $path, $value);
	}
	
	public function flashdata($path, $remove_on_read = true) {
		return $this->get('flash/' . $path, $remove_on_read);
	}
	
	
	public function destroy() {

		unset($_SESSION);
		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time() - 86400, '/');
		}
		
		session_destroy();
	}
	
	public function regenerate_id() {
		
		$old_session_id = session_id();
		$old_session_data = $this->get();
		
		session_regenerate_id();
		$new_session_id = session_id();
		
		session_id($old_session_id);
		session_destroy();
		
		session_id($new_session_id);
		session_start();
		
		$_SESSION = $old_session_data;
		$this->set('core/regenerated', $regenerated_time = time());
		unset($old_session_data);

		$this->_session_id_expired();
		//session_write_close();
	}
	
	protected function _sess_run() {
		
		//session_set_cookie_params(7200, '/', );
		session_start();
		if($this->_session_id_expired()) {
			$this->regenerate_id();
		}
		
		$this->_flashdata_sweep();
		$this->_flashdata_mark();
	}
	
	private function _session_id_expired() {
		
		if(!$regenerated_time = $this->get('core/regenerated')) {
			$this->set('core/regenerated', $regenerated_time = time());
		}
		
		// Work out a session ID expiry point.
		$expiry_time = time() - $this->session_ttl;
		
		// Check for expiry.
		return $regenerated_time <= $expiry_time;
	}
	
	public function debug() {
		
		var_dump($_SESSION);
		
	}
}