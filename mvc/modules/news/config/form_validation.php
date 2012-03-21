<?php

$config = array(
	
	'admin-news-form' => array(
		
		array(
			'field'	=> 'news_title',
			'label'	=> 'Title',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'news_slug',
			'label'	=> 'Permalink',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'news_data_full',
			'label'	=> 'Content',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'news_date_published',
			'label'	=> 'Publish Date',
			'rules'	=> 'required|valid_date[Y-m-d]'
		),
		array(
			'field'	=> 'news_date_published_h',
			'label'	=> 'Publish Date (Hour)',
			'rules'	=> 'numeric'
		),
		array(
			'field'	=> 'news_date_published_i',
			'label'	=> 'Publish Date (Minute)',
			'rules'	=> 'numeric'
		),

	)
);