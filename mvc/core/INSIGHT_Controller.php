<?php

class INSIGHT_Controller extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
}

class INSIGHT_HMVC_Controller extends MX_Controller {
	
	public function __construct() {
		
		
		
		parent::__construct();
		//var_dump(get_instance()->insight->config('display/skin'));
		
		CI::$APP->load->skin(get_instance()->insight->config('display/skin'), 'views' . DIRECTORY_SEPARATOR . CI::$APP->router->fetch_module());
		// Set the skin.
		// $this->load->skin(get_instance()->insight->config('display/skin'));
	}
}

class INSIGHT_Admin_Controller extends INSIGHT_HMVC_Controller {
	
	protected $required_auth = true;
	protected $required_perm = null;
	
	public function __construct($required_auth = true, $required_perm = null) {
		
		parent::__construct();
		
		// Force the 'core' skin.
		CI::$APP->load->skin('core');
		
		$this->required_auth = $required_auth;
		$this->required_perm = $required_perm;
		
		$this->load->library('form_validation');
		
		if($this->required_auth && !$this->auth->is_logged_in()) {
			return redirect('admin/login');
		}
	}
}