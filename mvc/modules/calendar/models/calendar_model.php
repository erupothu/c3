<?php

class Calendar_Model extends CI_Model {
	
	public function __construct() {	
		parent::__construct();
		self::install();
	}
	
	public function create() {
		
		$calendar_date = new DateTime;
		$calendar_data = array(
			'calendar_name'			=> $this->form_validation->value('calendar_name'),
			'calendar_date_created'	=> $calendar_date->format(DATE_MYSQL)
		);
		
		$this->db->insert('calendar', $calendar_data);
		
		return $this->db->insert_id();
	}
	
	public function retrieve() {
		
		$this->db->select('*');
		$this->db->from('calendar');
		$this->db->order_by('calendar.calendar_id');
		$calendar_result = $this->db->get();
		
		return $calendar_result->result('Calendar_Object');
	}
	
	public function update(){}
	public function delete(){}
	
	public function retrieve_by_id($calendar_id) {
		
		$this->db->select('*');
		$this->db->from('calendar');
		$this->db->join('calendar_event', 'calendar_event.event_calendar_id = calendar.calendar_id');
		$this->db->order_by('calendar_event.event_date asc');
		$calendar_result = $this->db->get();
		
		$events = $calendar_result->result('Calendar_Event_Object');
		
		$calendar = $calendar_result->row(0, 'Calendar_Object');
		$calendar->events($events);
		
		return $calendar;
	}
	
	
	static public function install() {
		
	}
}

class Calendar_Object implements IteratorAggregate, Countable {
	
	private $p = 0;
	private $events;
	
	public function __construct() {
		$this->p = 0;
		$this->events = array(new Calendar_Event_Object, new Calendar_Event_Object);
	}
	
	public function id() {
		return $this->calendar_id;
	}
	
	public function name() {
		return $this->calendar_name;
	}
	
	public function events($set_events = null) {
		
		if(!is_null($set_events)) {
			$this->events = $set_events;
		}
		
		return $this->events;
	}
	
	public function count() {
		return count($this->events);
	}
	
	public function getIterator() {
		return new ArrayIterator($this->events);
	}

	public function created($format = DATE_MYSQL) {
		$dt = DateTime::createFromFormat(DATE_MYSQL, $this->calendar_date_created);
		return false !== $format ? $dt->format($format) : $dt;
	}
}

class Calendar_Event_Object {
	
	public function id() {
		return $this->event_id;
	}
	
	public function name() {
		return $this->event_name;
	}
	
	public function date($format = 'M jS') {
		$date = DateTime::createFromFormat('Y-m-d', $this->event_date);
		return false !== $format ? $date->format($format) : $date;
	}
}