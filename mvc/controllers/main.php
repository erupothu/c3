<?php

class Main extends INSIGHT_Controller {
	
	public function __construct() {
	
		parent::__construct();
		
		$this->load->model('page_model', 'page');
	}
	
	public function index() {
		
		$page_slug = '/' . implode('/', $this->uri->segment_array());
		if(!$page = $this->page->load($page_slug)) {
			show_404();
		}
		
		// Temp get images.
		$images = array();
		$this->db->select('i.*, ic.image_path as image_thumbnail_path');
		$this->db->from('page_image pi');
		$this->db->join('image i', 'i.image_id = pi.link_image_id', 'inner');
		$this->db->join('image ic', 'ic.image_parent_id = i.image_id', 'left');
		$this->db->where('pi.link_page_id', $page['page_id']);
		$this->db->order_by('pi.link_position asc');
		$this->db->order_by('i.image_date_created asc');
		$image_result = $this->db->get();
		foreach($image_result->result_array() as $image_item) {
			$images[$image_item['image_id']] = $image_item;
		}
		
		
		$this->load->view('index.view.php', array(
			'page' 		=> $page,
			'images'	=> $images
		));
	}
}