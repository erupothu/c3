<?php

class INSIGHT_Email extends CI_Email {
	
	protected $CI;
	protected $template_data;
	
	public function __construct($config = array()) {
		
		parent::__construct($config);		
		$this->CI = &get_instance();
		
		$this->useragent = 'C3';
	}
	
	public function template($template_name, $template_data = array()) {
		//array_combine(array_map(function($element) { return '%' . $element . '%'; }, array_keys($template_data)), array_values($template_data))
		$this->message($this->CI->load->view('email/' . $template_name, $template_data, true));
		//var_dump($this->template_data);
	}	
}

