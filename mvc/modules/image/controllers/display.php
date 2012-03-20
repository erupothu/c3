<?php

class Display extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('image_model', 'image');
	}
	
	public function upload() {
		$this->load->view('display/upload.view.php');
	}
	
	
	public function modal($image_id) {
		
		if(!$image = $this->image->retrieve_by_id($image_id)) {
			show_error('Unable to load image.');
		}
		
		// Display the modal
		$this->load->view('display/modal.view.php', array(
			'image'	=> $image
		));
	}
	
	public function frame($image_id) {
		
		if(!$image = $this->image->retrieve_by_id($image_id)) {
			show_error('Unable to load image.');
		}
		
		$this->load->view('display/frame.view.php', array(
			'image'	=> $image
		));
	}
}