<?php

$config = array(

	'contact-send-form' => array(
		
		array(
			'field'	=> 'contact_name',
			'label'	=> 'Name',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'contact_company',
			'label'	=> 'Company',
			'rules'	=> ''
		),
		array(
			'field'	=> 'contact_email',
			'label'	=> 'Email Address',
			'rules'	=> 'required|valid_email'
		),
		array(
			'field'	=> 'contact_telephone',
			'label'	=> 'Telephone',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'contact_enquiry_type',
			'label'	=> 'Enquiry Type',
			'rules'	=> ''
		),
		array(
			'field'	=> 'contact_enquiry',
			'label'	=> 'Enquiry',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'contact_marketing',
			'label'	=> 'Marketing',
			'rules'	=> ''
		),
		
		array(
			'field'	=> 'contact_captcha',
			'label'	=> 'Anti-Spam',
			'rules'	=> 'required|module_callback[captcha->validate_captcha]'
		),
	)
);