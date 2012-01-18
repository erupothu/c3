<?php

class Account_Model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	
	public function create() {
		
		echo Auth::encrypt($this->form_validation->value('account_password')) . '<br />';
		var_dump($this->form_validation->all_values());
		die();
		
		$account_data = array(
			'user_email'			=> null,
			'user_password'			=> null,
			'user_title'			=> null,
			'user_firstname'		=> null,
			'user_lastname'			=> null,
			'user_company'			=> null,
			'user_telephone'		=> null,
			'user_marketing'		=> null,
			'user_administrator'	=> null,
			'user_date_created'		=> null,
			'user_date_lastseen'	=> null
		);
		
		$this->db->insert('user', $account_data);
		
		return $this->db->insert_id();
	}
	
	public function retrieve() {
		
	}
	
	public function update() {
		
	}
	
	public function delete() {
		
	}
	
	
	public function validate_unique_email($email) {
		
		$this->db->select('count(user.user_id) as user_count');
		$this->db->from('user');
		$this->db->where('user.user_email', $email);
		$account_result = $this->db->get();
		
		if((int)$account_result->row('user_count') !== 0) {
			$this->form_validation->set_message('module_callback', 'Your %s has been registered before. ' . anchor('account/recovery', 'Have you lost your password?'));
			return false;
		}
		
		return true;
	}
}

class Account_Object {
	
}