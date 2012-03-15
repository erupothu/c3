<?php

class Search extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->library('form_validation');
	}
	
	public function index() {
		
		
		if(!$this->form_validation->run('search-form')) {
			die('no search');
		}

		$search = $this->form_validation->value('search');		
		
		// @todo Observer Pattern here?
		// @todo Modules should have 'capabilities', such as Administerable, Searchable, Installable, etc etc.
		// then we can use an Iterator to loop over $this->insight->modules(Module::SEARCHABLE) to skip modules 
		// that do not need to be searched, for instance 'SEO'.
		$modules = array('page', 'news');
		
		
		$search_results = array();
		// At the moment, each models ->search() function is bitty, relies on
		// the frankly awful MySQL FULLTEXT search in BOOLEAN MODE (because of
		// the 50% limitation), and is generally very basic.
		// @todo Enhance this search.  Since I want it to be loosely coupled, I
		// will continue with it in it's current state.
		foreach($modules as $module) {
			
			$module_model = sprintf('%1$s/%1$s_model', $module);
			$model_object = $this->load->model($module_model);
			
			$search_results = array_merge($search_results, $model_object->search($search));
		}
		
		echo '<ol>';
		foreach($search_results as $search_result) {
			echo '<li>' . get_class($search_result) . ' ' . anchor($search_result->permalink(true), $search_result->title()) . '</li>';
		}
		echo '</ol>';
	}
}