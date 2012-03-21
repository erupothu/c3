<?php

class Admin extends INSIGHT_Admin_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('news_model', 'news');
	}
	
	public function index() {
		
		$this->load->view('admin/news/index.view.php', array(
			'articles' => $this->news->retrieve()
		));
	}
	
	public function create() {
		
		if($this->form_validation->run('admin-news-form')) {
			$news_id = $this->news->create();
			return redirect('admin/news');
		}
		
		$this->load->view('admin/news/create.view.php', array(
		//	'news' => new News_Object
		));
	}
	
	public function update($news_id) {
		
		if($this->form_validation->run('admin-news-form')) {
			$this->news->update($news_id);
			return redirect('admin/news');
		}

		$this->load->view('admin/news/update.view.php', array(
			'news' => $this->news->retrieve_by_id($news_id)
		));
	}
	
	public function delete($news_id) {

		if(!$this->news->delete($news_id)) {
			show_error('Could not delete News Article.');
		}

		return redirect('admin/news');
	}
	
	public function settings() {
		echo 'settings for News';
	}
}