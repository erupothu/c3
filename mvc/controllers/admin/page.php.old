<?php

class Page extends INSIGHT_Admin_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('page_model', 'page');
	}
	
	public function index() {
		
		$this->load->view('admin/page/index.view.php', array(
			'pages' => $this->page->retrieve()
		));
	}
	
	public function create() {
		
		if($this->form_validation->run('admin-page-form')) {
			$page_id = $this->page->create();
			
			$image_position = 1;
			foreach(is_array($this->input->post('page_image_id', true)) ? $this->input->post('page_image_id', true) : array() as $image_id) {
				
				$this->db->insert('page_image', array(
					'link_page_id'	=> $page_id,
					'link_image_id'	=> $image_id,
					'link_position'	=> $image_position++
				));
			}
			
			return redirect('admin/page');
		}
		
		$this->load->view('admin/page/create.view.php', array(
			'image'	=> array()
		));
	}
	
	public function update($page_id) {
		
		if($this->form_validation->run('admin-page-form')) {
			
			$this->page->update($page_id);
			
			$image_position = 1;
			$this->db->from('page_image')->where('link_page_id', $page_id)->delete();
			foreach(is_array($this->input->post('page_image_id', true)) ? $this->input->post('page_image_id', true) : array() as $image_id) {
				
				$this->db->insert('page_image', array(
					'link_page_id'	=> $page_id,
					'link_image_id'	=> $image_id,
					'link_position'	=> $image_position++
				));
			}
			
			return redirect('admin/page');
		}
		
		$images = array();
		$this->db->select('*');
		$this->db->from('page_image pi');
		$this->db->join('image i', 'i.image_id = pi.link_image_id', 'inner');
		$this->db->where('pi.link_page_id', $page_id);
		$this->db->order_by('pi.link_position asc');
		$image_result = $this->db->get();
		foreach($image_result->result_array() as $image_row) {
			$images[$image_row['image_id']] = $image_row;
		}
	
		$this->load->view('admin/page/update.view.php', array(
			'page' 	=> $this->page->load($page_id, 'page_id', true),
			'image'	=> $images
		));
	}
	
	public function delete($page_id) {
		
		if(!$this->page->delete($page_id))
			show_error('Could not delete page.');
			
		return redirect('admin/page');
	}
}