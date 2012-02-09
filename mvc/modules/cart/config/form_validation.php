<?php

$config = array(
	
	'cart-add' => array(

		array(
			'field'	=> 'product_id',
			'label'	=> 'Product',
			'rules'	=> 'required|numeric'
		),
		array(
			'field'	=> 'product_module',
			'label'	=> 'Module',
			'rules'	=> ''
		),
		array(
			'field'	=> 'product_quantity',
			'label'	=> 'Quantity',
			'rules'	=> 'required|numeric'
		)
	),
	
	'cart-checkout' => array(
		
		array(
			'field'	=> 'checkout_name',
			'label'	=> 'Name',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'checkout_email',
			'label'	=> 'Email',
			'rules'	=> 'required|valid_email'
		)
		
	)
	
);