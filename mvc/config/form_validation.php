<?php

$config = array(

	'admin-login' => array(
		
		array(
			'field'	=> 'admin_username',
			'label'	=> 'Username',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'admin_password',
			'label'	=> 'Password',
			'rules'	=> 'required'
		)
	),
	
	'admin-image-crop' => array(
		
		array(
			'field'	=> 'x',
			'label'	=> 'X Coordinate',
			'rules'	=> ''
		),
		array(
			'field'	=> 'y',
			'label'	=> 'Y Coordinate',
			'rules'	=> ''
		),
		array(
			'field'	=> 'w',
			'label'	=> 'Width',
			'rules'	=> ''
		),
		array(
			'field'	=> 'h',
			'label'	=> 'Height',
			'rules'	=> ''
		)
	),
	
	'admin-settings' => array(
	
		array(
			'field'	=> 'seo_block_robots',
			'label'	=> 'Block Robots',
			'rules'	=> 'checkbox_bit'
		)
	)

);