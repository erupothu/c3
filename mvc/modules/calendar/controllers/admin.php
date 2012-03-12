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
	
	
	public function retrieve($format = 'table-row', $args = array()) {
		
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
			show_error('Could not delete page.');
			
		return redirect('admin/calendar');
	}
}