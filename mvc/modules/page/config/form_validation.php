<?php

$config = array(

	'admin-page-form' => array(
		
		array(
			'field'	=> 'page_id',
			'label'	=> 'ID',
			'rules'	=> ''
		),
		array(
			'field'	=> 'page_name',
			'label'	=> 'Name',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'page_parent_id',
			'label'	=> 'Parent',
			'rules'	=> 'cannot_match[page_id]'
		),
		array(
			'field'	=> 'page_slug',
			'label'	=> 'URL Slug',
			'rules'	=> 'required|valid_slug|module_callback[validate_unique_permalink]'
		),
		array(
			'field'	=> 'page_content',
			'label'	=> 'Content',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'page_status',
			'label'	=> 'Status',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'page_image_id[]',
			'label'	=> 'Page Images',
			'rules'	=> ''
		)
	)

);