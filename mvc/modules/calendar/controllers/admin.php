<?php

class Admin extends INSIGHT_Admin_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->load->model('calendar_model', 'calendar');
		//$this->load->library('calendar');
	}
	
	public function index() {
		
		$this->load->view('admin/calendar/index.view.php', array(
			'calendars' => $this->calendar->retrieve()
		));
	}

	public function create() {
		
		if($this->form_validation->run('admin-calendar-form')) {
			$calendar_id = $this->calendar->create();
			return redirect('admin/calendar');
		}
		
		$this->load->view('admin/calendar/create.view.php', array());
	}

	public function update($calendar_id) {
		
		if($this->form_validation->run('admin-calendar-form')) {
			$this->calendar->update($calendar_id);
			return redirect('admin/calendar');
		}

		$this->load->view('admin/calendar/update.view.php', array(
			'calendar' => $this->calendar->retrieve_by_id($calendar_id)
		));
	}
	
	public function delete($calendar_id) {
		
		if(!$this->calendar->delete($calendar_id))
			show_error('Could not delete calendar.');
		
		return redirect('admin/calendar');
	}
	
	
	public function events($calendar_id) {

		if(!$calendar = $this->calendar->retrieve_by_id($calendar_id)) {
			show_error('Calendar does not exist');
		}
		
		$this->load->view('admin/calendar/events/index.view.php', array(
			'calendar' => $this->calendar->retrieve_by_id($calendar_id)
		));
	}
	
	public function create_event($calendar_id) {

		if($this->form_validation->run('admin-calendar-event-form')) {
			$this->calendar->create_event($calendar_id);
			return redirect('admin/calendar/events/' . $calendar_id);
		}
		
		$calendar = $this->calendar->retrieve_by_id($calendar_id);
		$this->load->view('admin/calendar/events/create.view.php', array(
			'calendar'	=> $calendar
		));
	}
	
	public function update_event($event_id) {
		
		if(!$event = $this->calendar->retrieve_event_by_id($event_id)) {
			show_error('Event does not exist');
		}
		
		if($this->form_validation->run('admin-calendar-event-form')) {
			$this->calendar->update_event($event_id);
			return redirect('admin/calendar/events/' . $event->calendar_id());
		}
		
		$this->load->view('admin/calendar/events/update.view.php', array(
			'event'	=> $event
		));
	}
	
	public function delete_event($event_id) {
		
		if(!$event = $this->calendar->retrieve_event_by_id($event_id)) {
			show_error('Event does not exist');
		}
		
		if(!$this->calendar->delete_event($event_id)) {
			show_error('Event could not be deleted');
		}
		
		return redirect('admin/calendar/events/' . $event->calendar_id());
	}
}