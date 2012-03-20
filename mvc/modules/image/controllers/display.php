<?php

class Display extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('image_model', 'image');
	}
	
	public function upload() {
		
		
		$parameters = array(
			
		);
		
		$this->load->view('display/upload.view.php', $parameters);
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
}