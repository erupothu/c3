<?php

class Account_Model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	
	public function create() {
		
		// Split name.
		$user_lastname 	= null;
		$user_firstname = $this->form_validation->value('account_name');
		
		if(false !== strpos($user_firstname, ' ')) {
			list($user_firstname, $user_lastname) = preg_split('/\s+/', $user_firstname, 2, PREG_SPLIT_NO_EMPTY);
		}

		
		// Create New User
		$account_create = new DateTime;
		$account_insert = array(
			'user_email'			=> $this->form_validation->value('account_email'),
			'user_password'			=> Auth::encrypt($this->form_validation->value('account_password')),
			'user_firstname'		=> $user_firstname,
			'user_lastname'			=> $user_lastname,
			'user_company'			=> $this->form_validation->value('account_organisation'),
			'user_telephone'		=> $this->form_validation->value('account_telephone', null),
			'user_marketing'		=> $this->form_validation->value('account_marketing', 1),
			'user_administrator'	=> 0,
			'user_date_created'		=> $account_create->format('Y-m-d H:i:s'),
			'user_date_lastseen'	=> null
		);
		
		$this->db->insert('user', $account_insert);
		$user_id = $this->db->insert_id();
		
		// Flash Message?
		//$this->session->set_flashdata('admin/message', sprintf('News article entitled "%s" has been created', $this->form_validation->value('news_title')));
		
		// Dispatch Email.
		$this->email->set_mailtype('html');
		$this->email->template('registration.email.php', array_merge($account_insert, array('user_password_plaintext' => $this->form_validation->value('account_password'))));
		$this->email->from('no-reply@anubisltd.com', 'Anubis');
		$this->email->to($this->form_validation->value('account_email'));
		$this->email->subject('Registration complete');
		$this->email->send();
		
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
	
	public function validate_account_recoverable($email) {
		
		$this->db->select('count(user.user_id) as user_count');
		$this->db->select('if(ISNULL(user.user_recovery), 1, 0) as user_recoverable', false);
		$this->db->from('user');
		$this->db->where('user.user_email', $email);
		$account_result = $this->db->get();
		
		if((int)$account_result->row('user_count') === 0) {
			$this->form_validation->set_message('module_callback', 'There is no account with that %s in the system.');
			return false;
		}
		
		/*
		if((int)$account_result->row('user_recoverable') === 0) {
			$this->form_validation->set_message('module_callback', 'TODO');
			return false;
		}
		*/
		
		return true;
	}
	
	public function format_clean_name($name_string = '') {
		return preg_replace_callback('/(^|\'|\s|\-)[a-z]/', function($part) { return strtoupper($part[0]); }, $name_string);
	}
}

class Account_Object {
	
}