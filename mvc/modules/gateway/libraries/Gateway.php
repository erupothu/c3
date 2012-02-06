<?php

abstract class INSIGHT_Gateway {
	
	protected $configuration;
	
	public function __construct() {
		$this->configuration = CI::$APP->insight->config('user/gateway');
	}
}

class Gateway_Exception extends Exception {
	
}