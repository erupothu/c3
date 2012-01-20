<?php

class INSIGHT_Controller extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
}

class INSIGHT_HMVC_Controller extends MX_Controller {
	
	public function __construct() {
		
		parent::__construct();

		// Set the skin.
		CI::$APP->load->skin(get_instance()->insight->config('display/skin'), 'views' . DIRECTORY_SEPARATOR . CI::$APP->router->fetch_module());
	}
}

class INSIGHT_Admin_Controller extends INSIGHT_HMVC_Controller {
	
	protected $required_auth = true;
	protected $required_perm = null;
	private $user_identifier = 'administrator';
	
	public function __construct($required_auth = true, $required_perm = null) {
		
		parent::__construct();
		
		// Force the 'core' skin.
		CI::$APP->load->skin('core');
		
		$this->required_auth = $required_auth;
		$this->required_perm = $required_perm;
		
		$this->load->library('form_validation');
		
		if($this->required_auth && (!is_object($this->{$this->user_identifier}) || !$this->{$this->user_identifier}->authenticated() || $this->{$this->user_identifier}->cannot('ADMINISTRATION_VIEW'))) {
			return redirect('admin/login');
		}
	}
}