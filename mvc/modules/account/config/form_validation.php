<?php

$config = array(
	
	'account-form' => array(
		
		array(
			'field'	=> 'account_email',
			'label'	=> 'Email Address',
			'rules'	=> 'required|valid_email|unique_email'
		),
		array(
			'field'	=> 'account_password',
			'label'	=> 'Password',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'account_password_confirm',
			'label'	=> 'Confirm Password',
			'rules'	=> 'required|matches[account_password]'
		),
		
		array(
			'field'	=> 'account_name',
			'label'	=> 'Name',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'account_organisation',
			'label'	=> 'Organisation',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'account_unit',
			'label'	=> 'Unit',
			'rules'	=> ''
		),
		array(
			'field'	=> 'account_country',
			'label'	=> 'Country',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'account_telephone',
			'label'	=> '',
			'rules'	=> ''
		),

/*
		
		array(
			'field'	=> 'account_',
			'label'	=> '',
			'rules'	=> ''
		),
		array(
			'field'	=> 'account_',
			'label'	=> '',
			'rules'	=> ''
		),
		array(
			'field'	=> 'account_',
			'label'	=> '',
			'rules'	=> ''
		),
		array(
			'field'	=> 'account_',
			'label'	=> '',
			'rules'	=> ''
		),
		array(
			'field'	=> 'account_',
			'label'	=> '',
			'rules'	=> ''
		),
		
		array(
			'field'	=> 'account_',
			'label'	=> '',
			'rules'	=> ''
		)
	*/		
	)

);