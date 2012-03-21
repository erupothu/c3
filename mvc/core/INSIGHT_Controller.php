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
		$this->load->add_viewpaths('skins/core/views/');
	}
}

class INSIGHT_Admin_Controller extends INSIGHT_HMVC_Controller {
	
	protected $required_auth = true;
	protected $required_perm = null;
	static private $user_identifier = 'administrator';
	
	public function __construct($required_auth = true, $required_perm = null) {
		
		parent::__construct();
		
		// Force the 'core' skin.
		CI::$APP->load->skin('core');
		
		// Stop admin requests from outside of /admin
		if(0 !== strcasecmp('admin', $this->uri->segment(1))) {
			//die('bad request');
		}
		
		$this->required_auth = $required_auth;
		$this->required_perm = $required_perm;
		
		// Is this a multipart data query?
		$this->multipartdata = (false !== $this->input->server('CONTENT_TYPE') && substr($this->input->server('CONTENT_TYPE'), 0, 19) == 'multipart/form-data');
		
		// Load common libraries (all admin modules use form_validation).
		$this->load->library('form_validation');
		
		// Is this user authorised as an administrator?
		if(false === $this->multipartdata && $this->required_auth && (!isset($this->{self::$user_identifier}) || !is_object($this->{self::$user_identifier}) || !$this->{self::$user_identifier}->authenticated() || $this->{self::$user_identifier}->cannot('ADMINISTRATION_VIEW'))) {
			return redirect('admin/login');
		}
	}
	
	
	/**
	 * ajax
	 * 
	 * Ajax endpoint.
	 *
	 * @return string JSON
	 */
	public function ajax($function) {
		
		// Find module & function.
		$module = $this->router->fetch_module();
		$module_function = 'ajax_' . $function;
		
		$post = $this->input->post(null, true);
		$json = array(
			'module'	=> $module,
			'function'	=> $module_function,
			'incoming'	=> $post,
			'status'	=> false,
			'callable'	=> (is_callable(array($this->$module, $module_function)))
		);
		
		if($json['callable']) {
			$json = call_user_func(array($this->$module, $module_function), $json);
		}
		
		return $this->output->set_output(json_encode($json));
	}
}