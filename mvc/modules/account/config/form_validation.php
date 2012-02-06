<?php

$config = array(
	
	'account-register-form' => array(
		
		array(
			'field'	=> 'account_email',
			'label'	=> 'Email Address',
			'rules'	=> 'required|valid_email|module_callback[validate_unique_email]'
		),
		array(
			'field'	=> 'account_password',
			'label'	=> 'Password',
			'rules'	=> 'required|valid_password_strength'
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
			'label'	=> 'Telephone',
			'rules'	=> ''
		),
		
		array(
			'field'	=> 'account_marketing',
			'label'	=> 'Marketing Flag',
			'rules'	=> ''
		)
	
	),
	
	'account-login-form' => array(
		
		array(
			'field'	=> 'account_email',
			'label'	=> 'Email Address',
			'rules'	=> 'required|valid_email'
		),
		array(
			'field'	=> 'account_password',
			'label'	=> 'Password',
			'rules'	=> 'required'
		),
	),
	
	'account-recover-form' => array(
		
		array(
			'field'	=> 'account_email',
			'label'	=> 'Email Address',
			'rules'	=> 'required|valid_email|module_callback[validate_account_recoverable]'
		)
	),
	
	'account-address-form' => array(
		
		array(
			'field'	=> 'address_label',
			'label'	=> 'Label',
			'rules'	=> ''
		),
		array(
			'field'	=> 'address_line1',
			'label'	=> 'Line 1',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'address_line2',
			'label'	=> 'Line 2',
			'rules'	=> ''
		),
		array(
			'field'	=> 'address_city',
			'label'	=> 'City',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'address_state',
			'label'	=> 'State',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'address_postcode',
			'label'	=> 'Postcode',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'address_country',
			'label'	=> 'Country',
			'rules'	=> 'required'
		)
		
	)

);