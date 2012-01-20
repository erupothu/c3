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
			if(false !== User_Administrator::login($this->form_validation->value('admin_username'), $this->form_validation->value('admin_password'))) {
				$this->session->set_flashdata('admin/message', sprintf('Welcome back, %s!', $this->administrator->name()));
				return redirect('admin');
			}
			
			$this->form_validation->add_error(null, 'admin_username', true);
			$this->form_validation->add_error('Your login/password combination is incorrect. Please check your details and try again.', 'admin_password');
		}
		
		$this->load->view('admin/gateway/login.view.php');
	}
	
	public function logout() {
		
		if(is_object($this->administrator) && $this->administrator->authenticated()) {
			$this->administrator->logout();
		}
		
		return redirect();
	}
}