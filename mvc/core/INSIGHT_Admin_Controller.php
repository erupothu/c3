<?php

class INSIGHT_Admin_Controller extends INSIGHT_Controller {
	
	protected $required_auth = true;
	protected $required_perm = null;
	
	public function __construct($required_auth = true, $required_perm = null) {
		
		parent::__construct();
		
		$this->required_auth = $required_auth;
		$this->required_perm = $required_perm;
		
		$this->load->skin('core');
		$this->load->library('form_validation');
		
		if($this->required_auth && !$this->auth->is_logged_in()) {
			return redirect('admin/gateway/login');
		}
		
		// Lazy Load Model
		//$possible_model = APPPATH . 'models' . DIRECTORY_SEPARATOR . strtolower(get_class($this) . '_model.php');
		//if(file_exists($possible_model)) {
		//	$this->load->model()
		//}
	}
}