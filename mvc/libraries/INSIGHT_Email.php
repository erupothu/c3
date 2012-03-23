<?php

class INSIGHT_Email extends CI_Email {
	
	protected $CI;
	protected $template_data;
	
	public function __construct($config = array()) {
		
		parent::__construct($config);
		$this->CI = &get_instance();
		
		$this->useragent = 'C3';
	}
	
	public function from($from, $name = '') {
		
		/*
		if(!in_array(ENVIRONMENT, array('development', 'testing')) && !preg_match('/' . preg_quote($this->CI->input->server('HTTP_HOST'), '/') . '$/i', $from, $m)) {
			die('Check your email from hostname. ' . $from . ' and ' . $this->CI->input->server('HTTP_HOST') . ' do not match');
		}
		*/
		
		parent::from($from, $name);
	}
	
	public function template($template_name, $template_data = array()) {
		$this->message($this->CI->load->view('email/' . $template_name, $template_data, true));
	}	
}

