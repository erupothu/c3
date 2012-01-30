<?php

$config = array(

	'admin-product-form' => array(
		
		array(
			'field'	=> 'product_id',
			'label'	=> 'ID',
			'rules'	=> ''
		),
		array(
			'field'	=> 'product_name',
			'label'	=> 'Name',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'product_slug',
			'label'	=> 'URL Slug',
			'rules'	=> ''
		),
		array(
			'field'	=> 'product_code',
			'label'	=> 'Code',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'product_category_id',
			'label'	=> 'Category',
			'rules'	=> 'required|is_natural_no_zero'
		),
		array(
			'field'	=> 'product_description',
			'label'	=> 'Description',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'product_specification',
			'label'	=> 'Specification',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'product_price',
			'label'	=> 'Price',
			'rules'	=> 'required|numeric|format_sprintf[%0.2f]'
		),
		array(
			'field'	=> 'product_image_id[]',
			'label'	=> 'Images',
			'rules'	=> ''
		)
	)

);