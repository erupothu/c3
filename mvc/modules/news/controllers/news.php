<?php

class News extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->load->model('news_model', 'news');
	}
	
	/**
	 * index
	 *
	 * @return void
	 * @author jon
	 */
	public function index() {
		
		// Archive.
		//$this->load->view('archive.view.php', array(
		//	'articles' => $this->news->retrieve()
		//));
		echo Modules::run('page/output', 'inner', array(
			'articles' => $this->news->retrieve()
		));
		
		
		// Does this page exist?
		//if(!$page = $this->page->load($this->uri->uri_string())) {
		//	show_404();
		//}
		
		// Protected page?
		// @TODO
		
		
		//$template = 'home';
		
		// Dispatch page data to the required template.
		//$this->load->view('templates/' . $template . '.template.view.php', array(
		//	'page' 		=> $page
		//));
	}
	
	
	/**
	 * archive
	 *
	 * @param string $year 
	 * @param string $month 
	 * @param string $day 
	 * @return void
	 * @author jon
	 */
	public function archive($year = null, $month = null, $day = null) {

		echo 'Year: ' . $year . '<br />';
		echo 'Month: ' . $month . '<br />';
		echo 'Day: ' . $day . '<br />';
		
		$articles = $this->news->archive($year, $month, $day);
		
		var_dump($articles);

		// Run it through the news template.
	}

	
	/**
	 * view
	 *
	 * @access 	public
	 * @todo 	Relies on 'page' module. Add in way of registering a 'not found' func.
	 * @param 	string $news_slug 
	 * @return 	void
	 * @author 	jon
	 */
	public function view($news_slug) {
		
		// Does this news article exist?
		if(!$article = $this->news->retrieve_by_slug($news_slug)) {
			return $this->output->set_output(Modules::run('page/_404'));
		}
		
		// Run it through a news template if it exists.
		$output = Modules::run('page/output', 'inner', array(
			'article' => $article
		));
		
		if(!is_null($output)) {
			return $this->output->set_output($output);
		}
		
		// Fall back to the page template.
		die('fail');
	}
}