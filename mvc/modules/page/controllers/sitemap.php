<?php

class Sitemap extends INSIGHT_HMVC_Controller {
	
	public function __construct() {

		parent::__construct();

		$this->load->model('page_model', 'page');
	}
	
	public function index() {
		$this->generate();
	}
	
	public function generate($format = null) {
		
		// Load all pages into a Recurisve Iterator.
		$iterator = new RecursiveArrayIterator($this->page->retrieve_nested());

		// Load an empty chunk if there are 0 rows.
		if($iterator->count() === 0) {
			//return $this->load->view('admin/page/chunks/' . $format . '.empty.chunk.php');
		}

		// Iterate over children.
		iterator_apply($iterator, array($this, '_render'), array($iterator, 0, $format));
	}
	
	private function _render($iterator, $limit = 0, $format = 'table-row', $args = array()) {
		
		echo '<ul>';
		
		while($iterator->valid()) {
			
			$page = $iterator->current();

			//$this->load->view('page/sitemap/chunks/' . $format . '.chunk.php', array_merge(array('page' => $page), $args));
			echo '<li>' . anchor($page->permalink(), $page->title());
			
			if($page->hasChildren()) {
				echo '<ul>';
				$this->_render(new RecursiveArrayIterator($page->getChildren()), $limit, $format, $args);
				echo '</ul>';
			}
			
			echo '</li>';
			
			$iterator->next();
		}
		
		echo '</ul>';
	}
}