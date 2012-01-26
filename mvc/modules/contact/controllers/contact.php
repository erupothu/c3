<?php

class Contact extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		// Init Libraries
		$this->load->library('email');
		$this->load->library('form_validation');
	}
	
	public function form() {
		
		if($this->form_validation->run('contact-send-form')) {
			
			// @TODO:
			// Move to a library, perhaps.
			// Maybe the model is okay for this.
			$this->email->set_mailtype('html');
			$this->email->template('contact.email.php', $this->form_validation->all_values());
			$this->email->from('no-reply@anubisltd.com', 'Anubis');
			$this->email->to('jon@creativeinsight.co.uk');
			$this->email->reply_to($this->form_validation->value('contact_email'));
			$this->email->subject('Contact Form Submission');
			$this->email->send();
			
			// We should forward them to a success page.
			die('Email sent.  @TODO: ' . anchor('/', 'Forward to a success page.'));
		}
		
		$this->load->view('form.view.php');
	}
}