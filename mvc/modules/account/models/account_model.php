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
		
		$this->db->select('*');
		$this->db->from('user u');
		$this->db->order_by('u.user_id asc');
		$user_result = $this->db->get();
		
		return $user_result->result('Account_Object');
	}
	
	public function update() {
		
	}
	
	public function delete() {
		
	}
	
	public function retrieve_by_id($account_id) {
		
		$this->db->select('*');
		$this->db->from('user u');
		$this->db->where('u.user_id', $account_id);
		$user_result = $this->db->get();
		
		return $user_result->row(0, 'Account_Object');
	}
	
	public function retrieve_by_email($account_email) {
		
	}


	public function retrieve_as_csv() {

		$this->db->select('user_firstname as "First Name"');
		$this->db->select('user_lastname as "Last Name"');		
		$this->db->select('user_email as "Email Address"');
		$this->db->select('user_company as "Company Name"');
		$this->db->select('user_telephone as "Telephone"');
		$this->db->select('IF(user_marketing = 1, "Yes", "No") as "Opt-In Marketing"', false);
		$this->db->select('DATE_FORMAT(user_date_created, "%d/%m/%Y %H:%i") as "Date Registered"', false);
		$this->db->select('DATE_FORMAT(user_date_lastseen, "%d/%m/%Y %H:%i") as "Date Last Seen"', false);
		$this->db->from('user');
		$this->db->order_by('user_date_created desc');
		$account_result = $this->db->get();
		
		$this->load->dbutil();
		return $this->dbutil->csv_from_result($account_result);
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
	
	public function id() {
		return (int)$this->user_id;
	}
	
	public function email() {
		return $this->user_email;
	}
	
	public function name() {
		return trim(sprintf('%s %s', $this->user_firstname, $this->user_lastname));
	}
	
	public function marketing() {
		return $this->user_marketing == 1;
	}
	
	public function company() {
		return $this->user_company;
	}
	
	public function created($format = 'd/m/Y H:i') {
		$dt = DateTime::createFromFormat('Y-m-d H:i:s', $this->user_date_created);
		return false !== $format ? $dt->format($format) : $dt;
	}
	
	public function seen($format = 'd/m/Y H:i') {
		
		if(is_null($this->user_date_lastseen))
			return 'Never seen.';
		
		$dt = DateTime::createFromFormat('Y-m-d H:i:s', $this->user_date_lastseen);
		return false !== $format ? $dt->format($format) : $dt;
	}
}