<?php

class Contact extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		// Init Libraries
		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->model('captcha_model', 'captcha');
	}
	
	public function form() {
		
		$template_file = 'default';
		
		if($successful_validation = $this->form_validation->run('contact-send-form')) {
			
			// @TODO:
			// Move to a library, perhaps.
			// Maybe the model is okay for this.
			//$this->email->set_mailtype('html');
			//$this->email->set_mailtype('text');
			$this->email->template('default.email.php', $this->form_validation->all_values());
			$this->email->from('no-reply@highclareschool.co.uk', 'Highclare School');
			$this->email->to('jon@creativeinsight.co.uk');
			$this->email->reply_to($this->form_validation->value('contact_email'));
			$this->email->subject('Contact Form Submission');
			$this->email->send();
			
			// We should forward them to a success page.
			// Overwrite the template with the 'success' template.
			// @TODO perhaps redirect, to stop double-submissions?
			$template_file = 'success';
		}
		
		// Get CAPTCHA.
		// It will only regenerate if:
		// 1. They are coming to the page 'fresh', i.e. there is no POST.
		// 2. They POSTed to the page, but the captcha field was incorrect.
		// 3. There was no CAPTCHA data in the session at all.
		$captcha = $this->captcha->retrieve();
		if(!$captcha || false === $this->input->post() || (false === $successful_validation && $this->form_validation->has_error('contact_captcha'))) {
			$captcha = $this->captcha->generate();
		}
		
		$this->load->view('templates/' . $template_file . '.view.php', array(
			'captcha' => $captcha
		));
	}
}