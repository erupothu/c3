<?php

class Search extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->library('form_validation');
	}
	
	public function index() {
		
		if(!$this->form_validation->run('search-form')) {
			return $this->output->set_output(Modules::run('page/_404'));
		}
		
		$search = $this->form_validation->value('search');		
		redirect('search/q/' . urlencode($search));
	}
	
	public function q($query) {
		
		// Filter the query.
		$search = $this->security->xss_clean(urldecode($query));
		
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
		// CONSIDER:
		// - SQL Unions
		// - Sphinx
		// - Redis/Lucine.
		foreach($modules as $module) {
			
			$module_model = sprintf('%1$s/%1$s_model', $module);
			$model_object = $this->load->model($module_model);
			
			$search_results = array_merge($search_results, $model_object->search($search));
		}
		
		// @TODO
		// Need a method of sorting these results somehow...
		
		// Display results
		$this->load->view('templates/results.view.php', array(
			'results'		=> new ArrayIterator($search_results),
			'search_term'	=> $search
		));
	}
}