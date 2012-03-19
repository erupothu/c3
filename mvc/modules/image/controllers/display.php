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
		
		$parameters = array(
			
		);
		
		// @TODO Model
		$this->db->select('*');
		$this->db->from('image i');
		$this->db->where('i.image_id', $image_id);
		$image_result = $this->db->get();
		
		$this->load->view('display/modal.view.php', array(
			'image'	=> $image_result->row(0, 'Image_Object')
		));
	}
}