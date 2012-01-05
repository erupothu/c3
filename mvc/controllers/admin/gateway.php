<?php

class Gateway extends INSIGHT_Admin_Controller {
	
	public function __construct() {
		
		parent::__construct(false);
		$this->load->library('form_validation');
	}
	
	public function index() {
		
	}
	
	public function login() {
		
		if($this->form_validation->run('admin-login')) {
			
			// Try and log in.
			if(false !== $this->auth->login($this->form_validation->value('admin_username'), $this->form_validation->value('admin_password'), array('u.user_administrator' => 1))) {
				$this->session->set_flashdata('admin/message', sprintf('Welcome back, %s!', $this->session->get('user/data/user_firstname')));
				return redirect('admin');
			}
			
			$this->form_validation->add_error(null, 'admin_username', true);
			$this->form_validation->add_error('Your login/password combination is incorrect. Please check your details and try again.', 'admin_password');
		}
		
		$this->load->view('admin/gateway/login.view.php');
	}
	
	public function logout() {
		
		$this->auth->logout();
		return redirect('');
	}
}