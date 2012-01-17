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
		
		//echo Modules::run('page/output', 'inner', array(
		//	'articles' => $this->news->retrieve()
		//));

		// Dispatch page data to the required template.
		$this->load->view('templates/news-archive.template.view.php', array(
			'articles'	=> $this->news->retrieve()
		));
	}
	
	
	public function retrieve($format = '', $args = array()) {
		
		// Load all news into an Iterator.
		$news_iterator = new ArrayIterator($this->news->retrieve());
		
		// Load an empty chunk if there are 0 rows.
		
		
		// Iterate over children.
		iterator_apply($news_iterator, array($this, '_render'), array($news_iterator, 0, $format, $args));
	}
	
	
	private function _render($iterator, $limit = 0, $format = '', $args = array()) {

		if($iterator->count() === 0) {
			return $this->load->view('chunks/news/' . $format . '.empty.chunk.php');
		}
		
		while($iterator->valid()) {
			
			$item = $iterator->current();
			$this->load->view('chunks/news/' . $format . '.chunk.php', array_merge(array('article' => $item), $args));

			$iterator->next();
		}
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