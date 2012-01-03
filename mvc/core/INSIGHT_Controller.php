<?php

class INSIGHT_Controller extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		// Set the skin.
		$this->load->skin(get_instance()->insight->config('display/skin'));
	}
	
}