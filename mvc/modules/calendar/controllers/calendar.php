<?php

class Calendar extends INSIGHT_HMVC_Controller {
	
	private $iterator_defaults = array(
		'format' 	=> 'default',
		'limit'		=> false
	);
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('calendar_model', 'calendar');
		//$this->load->library('calendar');
	}
	
	public function index() {
		echo 'Calendar';
	}
	
	
	
	
	
	
	
	
	/**
	 * retrieve
	 *
	 * @param array $arguments 
	 * @return void
	 */
	public function retrieve($arguments = array()) {
		
		// Build Arguments.
		$arguments = array_merge($this->iterator_defaults, $arguments);

		// Attempt to load this calendar
		$calendar = $this->calendar->retrieve_by_id($arguments['id']);
		
		if(false === $calendar || $calendar->getIterator()->count() === 0) {
			return $this->load->view('chunks/calendar/' . $arguments['format'] . '.empty.chunk.php');
		}
		
		// Iterate over children.
		iterator_apply($calendar->getIterator(), array($this, '_render'), array($calendar->getIterator(), $arguments));
	}
	
	/**
	 * _render
	 *
	 * @param Iterator $iterator 
	 * @param array $arguments 
	 * @return void
	 */
	private function _render(Iterator $iterator, $arguments = array()) {
		
		$iterator_position = 0;
		while($iterator->valid()) {
			
			$item = $iterator->current();
			$this->load->view('chunks/calendar/' . $arguments['format'] . '.chunk.php', array_merge(array('event' => $item), $arguments));
			
			if(false !== $arguments['limit'] && ++$iterator_position >= $arguments['limit']) {
				break;
			}
			
			$iterator->next();
		}
	}
}