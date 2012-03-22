<?php

class News extends INSIGHT_HMVC_Controller {
	
	private $iterator_defaults = array(
		'format' 	=> 'default',
		'limit'		=> false
	);
	
	public function __construct() {
		
		parent::__construct();
		
		$this->load->model('news_model', 'news');
	}
	
	/**
	 * index
	 *
	 * @return void
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
	
	
	public function retrieve($arguments = array()) {
		
		// Build Arguments.
		$arguments = array_merge($this->iterator_defaults, $arguments);
		
		// Load all news into an Iterator.
		$iterator = new ArrayIterator($this->news->retrieve());
		
		// Load an empty chunk if there are 0 rows.
		
		
		// Iterate over children.
		iterator_apply($iterator, array($this, '_render'), array($iterator, $arguments));
	}
	
	
	private function _render($iterator, $arguments = array()) {
		
		if($iterator->count() === 0) {
			return $this->load->view('chunks/news/' . $arguments['format'] . '.empty.chunk.php');
		}
		
		$iterator_position = 0;
		while($iterator->valid()) {
			
			$item = $iterator->current();
			$this->load->view('chunks/news/' . $arguments['format'] . '.chunk.php', array_merge(array('article' => $item), $arguments));
			
			$iterator->next();
			if(false !== $arguments['limit'] && ++$iterator_position >= $arguments['limit']) {
				break;
			}
		}
	}
	
	
	/**
	 * archive
	 *
	 * @param string $year 
	 * @param string $month 
	 * @param string $day 
	 * @return void
	 */
	public function archive($year = null, $month = null, $day = null) {

		echo 'Year: ' . $year . '<br />';
		echo 'Month: ' . $month . '<br />';
		echo 'Day: ' . $day . '<br />';
		
		$articles = $this->news->archive($year, $month, $day);
		
		//var_dump($articles);
		
		// Run it through the news template.
	}
	
	
	/**
	 * category
	 *
	 * @return void
	 * @author Jon
	 */
	public function category($category_slug, $arguments = array()) {
		
		// Build Arguments.
		$arguments = array_merge($this->iterator_defaults, $arguments);
		$iterator = new ArrayIterator($this->news->retrieve(array('category_slug' => $category_slug)));
		
		// Iterate over children.
		//iterator_apply($iterator, array($this, '_render'), array($iterator, $arguments));
		
		
		$this->load->view('templates/news-archive.template.view.php', array(
			'articles'	=> $iterator
		));
	}
	
	
	/**
	 * view
	 *
	 * @access 	public
	 * @todo 	Relies on 'page' module. Add in way of registering a 'not found' func.
	 * @param 	string $news_slug 
	 * @return 	void
	 */
	public function view($news_slug) {
		
		// Does this news article exist?  404 if not.
		if(!$article = $this->news->retrieve_by_slug($news_slug)) {
			return $this->output->set_output(Modules::run('page/_404'));
		}
		
		// Run it through a news template if it exists.
		//$output = Modules::run('page/output', 'inner', array(
		//	'article' => $article
		//));
		
		//if(!is_null($output)) {
		//	return $this->output->set_output($output);
		//}
		
		$this->load->view('templates/news-article.template.view.php', array(
			'article' => $article
		));
		
		// Fall back to the page template.
		//die('fail');
	}
}