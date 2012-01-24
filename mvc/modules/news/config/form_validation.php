<?php

$config = array(
	
	'admin-news-form' => array(
		
		array(
			'field'	=> 'news_title',
			'label'	=> 'Title',
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
		)
		
	)
);