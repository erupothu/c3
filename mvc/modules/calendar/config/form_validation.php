<?php

$config = array(

	'admin-calendar-form' => array(
		
		array(
			'field'	=> 'calendar_name',
			'label'	=> 'Name',
			'rules'	=> 'required'
		)
	),
	
	'admin-calendar-event-form' => array(

		array(
			'field'	=> 'event_name',
			'label'	=> 'Name',
			'rules'	=> 'required'
		),
		array(
			'field'	=> 'event_date',
			'label'	=> 'Date',
			'rules'	=> 'required|valid_date[Y-m-d]'
		),
		array(
			'field'	=> 'event_description',
			'label'	=> 'Description',
			'rules'	=> ''
		)
	)
);