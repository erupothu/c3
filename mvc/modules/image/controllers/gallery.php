<?php

class Gallery extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('gallery_model', 'gallery');
	}
	
	public function index() {
		
		// List all galleries.
		$this->load->view('gallery/index.view.php', array(
			'galleries'	=> $this->gallery->retrieve()
		));
	}
	
	public function display($gallery_slug) {
		
		// Check to see if this gallery exists.
		if(!$gallery = $this->gallery->retrieve_by_slug($gallery_slug)) {
			return $this->output->set_output(Modules::run('page/_404'));
		}
		
		$this->load->view('gallery/gallery.view.php', array(
			'gallery' => $gallery
		));
	}
}