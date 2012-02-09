<?php

class Address extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->load->config('countries', true);
		
		$this->load->model('address_model', 'address');
		$this->load->library('form_validation');
	}
	
	public function index() {

		if(!$this->user->authenticated()) {
			return redirect('account/log-in');
		}
				
		$this->load->view('address/index.view.php', array(
			'addresses'	=> $this->address->retrieve($this->user->id())
		));
	}
	
	public function add() {

		if(!$this->user->authenticated()) {
			return redirect('account/log-in');
		}
		
		if($this->form_validation->run('account-address-form')) {
			$this->address->create($this->user->id());
		}
		
		$this->load->view('address/form.view.php');
	}
	
	public function render($key = '', $title = 'Address') {
		$this->load->view('chunks/address/address.form.chunk.php', array('key' => empty($key) ? '' : $key . '_', 'title' => $title));
	}
}