<?php

$config = array(
	
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
	
	
	'admin-image-gallery-form' => array(
		
		array(
			'field'	=> 'gallery_id',
			'label'	=> 'ID',
			'rules'	=> ''
		),
		array(
			'field'	=> 'gallery_name',
			'label'	=> 'Name',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'gallery_slug',
			'label'	=> 'Permalink',
			'rules'	=> 'required|module_callback[gallery->validate_unique_permalink]'
		)

	),
	
	'admin-image-resource' => array(
		
		// Hook Resource
		array(
			'field'	=> 'resource_link',
			'label'	=> 'Resource Link',
			'rules'	=> ''
		),
		array(
			'field'	=> 'resource_data',
			'label'	=> 'Resource Data',
			'rules'	=> ''
		),
	)
);