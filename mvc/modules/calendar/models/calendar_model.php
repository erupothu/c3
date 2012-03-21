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
		
		$this->db->select('c.*');
		$this->db->select('count(ce.event_id) as event_count');
		$this->db->from('calendar c');
		$this->db->join('calendar_event ce', 'ce.event_calendar_id = c.calendar_id', 'left');
		$this->db->order_by('c.calendar_id');
		$this->db->group_by('c.calendar_id');
		$calendar_result = $this->db->get();
		
		return $calendar_result->result('Calendar_Object');
	}
	
	public function update($calendar_id) {
		
		$calendar_date = new DateTime;
		$calendar_data = array(
			'calendar_name'			=> $this->form_validation->value('calendar_name'),
			'calendar_date_updated'	=> $calendar_date->format(DATE_MYSQL)
		);
		
		$this->db->update('calendar', $calendar_data, array('calendar_id' => $calendar_id));
	}
	
	public function delete($calendar_id) {
		
		// Delete the actual calendar.
		$this->db->where('calendar_id', $calendar_id);
		$this->db->delete('calendar');
		if(($deleted_items = $this->db->affected_rows()) === 0) {
			return false;
		}
		
		// Delete the calendar's events.
		$this->db->where('event_calendar_id', $calendar_id);
		$this->db->delete('calendar_event');
				
		// Write the flash message.
		$this->session->set_flashdata('admin/message', 'Calendar & associated Events deleted');
		return $deleted_items;
	}
	
	public function retrieve_by_id($calendar_id) {
		
		$this->db->select('*');
		$this->db->from('calendar');
		$this->db->join('calendar_event', 'calendar_event.event_calendar_id = calendar.calendar_id', 'left');
		$this->db->where('calendar.calendar_id', $calendar_id);
		$this->db->order_by('calendar_event.event_date asc');
		$calendar_result = $this->db->get();
		
		if($calendar_result->num_rows() === 0) {
			return false;
		}
		
		// Strip out NULL events (caused by the LEFT join)
		$events = array_filter($calendar_result->result('Calendar_Event_Object'), function($event) { return !is_null($event->id()); });
		$calendar = $calendar_result->row(0, 'Calendar_Object');
		
		// Join events
		$calendar->events($events);
		
		return $calendar;
	}
	
	
	public function retrieve_event_by_id($event_id) {

		$this->db->select('*');
		$this->db->from('calendar_event');
		$this->db->where('event_id', $event_id);
		
		$event_result = $this->db->get();
		
		return $event_result->row(0, 'Calendar_Event_Object');
	}
	
	public function create_event($calendar_id) {
		
		$event_create = new DateTime;
		$event_insert = array(
			'event_calendar_id'		=> $calendar_id,
			'event_name'			=> $this->form_validation->value('event_name'),
			'event_date'			=> DateTime::createFromFormat('Y-m-d', $this->form_validation->value('event_date'))->format(DATE_MYSQL_DATE),
			'event_description'		=> $this->form_validation->value('event_description', null, false),
			'event_date_created'	=> $event_create->format('Y-m-d H:i:s')
		);
		
		$this->db->insert('calendar_event', $event_insert);
		
		// Flash Message
		$this->session->set_flashdata('admin/message', sprintf('Calendar event entitled "%s" has been created', $this->form_validation->value('event_name')));
		
		// Return the insert ID.
		return $this->db->insert_id();
	}
	
	public function update_event($event_id) {

		$event_update = new DateTime;
		$event_change = array(
			'event_name'			=> $this->form_validation->value('event_name'),
			'event_date'			=> DateTime::createFromFormat('Y-m-d', $this->form_validation->value('event_date'))->format(DATE_MYSQL_DATE),
			'event_description'		=> $this->form_validation->value('event_description'),
			'event_date_updated'	=> $event_update->format('Y-m-d H:i:s')
		);
		
		$this->db->update('calendar_event', $event_change, array('event_id' => $event_id));
		
		// Flash Message
		$this->session->set_flashdata('admin/message', sprintf('Calendar event entitled "%s" has been updated', $this->form_validation->value('event_name')));
		
		return $this->db->affected_rows() === 1;
	}
	
	public function delete_event($event_id) {
		
		// Delete the specified event.
		$this->db->where('event_id', $event_id);
		$this->db->delete('calendar_event');
		
		if(($deleted_items = $this->db->affected_rows()) === 0) {
			return false;
		}
		
		// Write the flash message.
		$this->session->set_flashdata('admin/message', sprintf('Deleted %d event%s', $deleted_items, $deleted_items == 1 ? '' : 's'));
		return $deleted_items;
	}
	
	
	static public function install() {
		
	}
}

class Calendar_Object implements IteratorAggregate, Countable {
	
	private $events = array();
	
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
		
		// Allow the count to be overridden (for more efficient SQL queries)
		if(isset($this->event_count) && count($this->events) === 0)
			return $this->event_count;
		
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
	
	public function description() {
		return $this->event_description;
	}
	
	public function date($format = 'M jS') {
		$date = DateTime::createFromFormat('Y-m-d', $this->event_date);
		return false !== $format ? $date->format($format) : $date;
	}
	
	public function calendar_id() {
		return $this->event_calendar_id;
	}
	
	public function is_past($datetime = null) {
		$pivot = new DateTime(is_null($datetime) ? $datetime : null);
		return $pivot > $this->date(false);
	}
	
	public function is_future($datetime = null) {
		$pivot = new DateTime(is_null($datetime) ? $datetime : null);
		return $pivot < $this->date(false);
	}
	
	public function is_today() {
		$pivot = new DateTime;
		return $pivot == $this->date(false);
	}
	
	public function classes() {
		
		$classes = array();
		if($this->is_past()) {
			$classes[] = 'event-past';
		}
		
		if($this->is_future()) {
			$classes[] = 'event-future';
		}
		
		if($this->is_today()) {
			$classes[] = 'event-today';
		}
		
		return count($classes) > 0 ? implode(' ', $classes) : '';
	}
}