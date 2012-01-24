<?php

class Account extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('account_model', 'account');
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
			
			// Set temporary new PW.
			// Email hash to the user.
			
			// On clicking the recovery, set temporary PW = new PW.
			// Log the user in.
			
			$pass = Auth::generate_password();
			$encrypted = Auth::encrypt($pass);
			echo $this->form_validation->value('account_email') . '<br />';
			echo $pass . '<br />';
			echo $encrypted . '<br />';
			echo strlen($encrypted) . ' bytes<br />';
			
			echo strtolower(site_url(array(__class__, __function__, $encrypted)));
			die();
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
}