<?php

class Account extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('account_model', 'account');
		
		$this->load->config('countries');
	}
	
	public function index() {
		
		if(!$this->user->authenticated()) {
			return redirect('account/log-in');
		}
		
		$this->load->view('dashboard.view.php');
	}

	public function register() {

		if($this->form_validation->run('account-register-form')) {
			$account_id = $this->account->create();
			redirect('account');
		}

		$this->load->view('register/form.view.php', array());
	}

	public function recover($hash = null) {
		
		if(!is_null($hash)) {
			die($hash);
		}
		
		if($this->form_validation->run('account-recover-form')) {
			
			die('Send out hash here');
			
			/*
			
			// Generate & Encrypt a password.
			$plainpass = Auth::generate_password();
			$encrypted = Auth::encrypt($plainpass);
			
			// Get User ID.
			$this->db->select('user.user_id');
			$this->db->from('user');
			$this->db->where('user.user_email', $this->form_validation->value('account_email'));
			$user_result = $this->db->get();
			$user_id = $user_result->row('user_id');
			
			// Update user table with the recover password.
			$this->db->update('user', array('user_recovery'	=> $encrypted), array('user_id' => $user_id));
			
			// Generate an email.
			// Dispatch Email.
			$this->email->set_mailtype('html');
			$this->email->template('recover.email.php', array_merge($account_insert, array('user_password_plaintext' => $this->form_validation->value('account_password'))));
			$this->email->from('no-reply@anubisltd.com', 'Anubis');
			$this->email->to($this->form_validation->value('account_email'));
			$this->email->subject('Registration complete');
			$this->email->send();
			strtolower(site_url(array(__class__, __function__, $encrypted)))
			
			*/
		}
		
		$this->load->view('common/recover.view.php');
	}
	
	public function log_in() {

		if($this->form_validation->run('account-login-form')) {
			
			if(false !== User_Authenticated::login($this->form_validation->value('account_email'), $this->form_validation->value('account_password'))) {
				$this->session->set_flashdata('core/message', sprintf('Welcome back, %s!', $this->user->name()));
				return redirect('account');
			}

			$this->form_validation->add_error(null, 'account_email', true);
			$this->form_validation->add_error($this->lang->line('account_login_fail'), 'account_password');
		}
		
		$this->load->view('common/login.view.php');
	}
	
	public function log_out() {
		
		if($this->user->authenticated()) {
			$this->user->logout();
		}
		
		redirect();
	}
	
	
	public function credit_application() {
		$this->load->view('credit-application.view.php');
	}
}