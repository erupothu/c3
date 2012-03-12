<?php

class Calendar extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('calendar_model', 'calendar');
		//$this->load->library('calendar');
	}
	
	public function index() {
		
	}
	
	
	
	
	
	
	
	
	
	public function retrieve($format = '', $args = array()) {
		
		// Load all events into an Iterator.
		$event_iterator = $this->calendar->retrieve_by_id(1)->getIterator();
		
		// Load an empty chunk if there are 0 rows.
		
		
		// Iterate over children.
		iterator_apply($event_iterator, array($this, '_render'), array($event_iterator));
	}
	
	
	private function _render($iterator, $limit = 0, $format = '', $args = array()) {
		
		if($iterator->count() === 0) {
			return $this->load->view('chunks/calendar/' . $format . '.empty.chunk.php');
		}
		
		$iterator_position = 0;
		while($iterator->valid()) {
			
			$item = $iterator->current();
			
			$this->load->view('chunks/calendar/event-row.chunk.php', array_merge(array('event' => $item), $args));
			
			$iterator->next();
		}
	}
}