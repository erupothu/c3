<?php

class Resource extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('image_model', 'image');
	}
	
	
	public function hook($resource_type, $resource_id = null, $resource_template = null) {
		
		$resources = array();
		$templates = is_null($resource_template) ? 'hook' : $resource_template;
		
		// Are there any items?
		if(!is_null($resource_id)) {
			
			$this->db->select('i.*');
			$this->db->select('il.link_position');
			$this->db->select('t.image_id as image_thumbnail_id');
			$this->db->select('t.image_path as image_thumbnail_path');
			$this->db->from('image i');
			$this->db->join('image_link il', 'il.link_image_id = i.image_id');
			$this->db->join('image t', 't.image_parent_id = i.image_id', 'left');
			$this->db->where('il.link_resource_type', $resource_type);
			$this->db->where('il.link_resource_id', $resource_id);
			$this->db->order_by('il.link_position asc');
			$resource_result = $this->db->get();
			$resources = $resource_result->result('Image_Object');
		}
		
		$this->load->view('display/' . $templates . '.view.php', array(
			'images' => $resources
		));
	}
	
	
	public function link($resource_type, $resource_id, $image_ids = array()) {
		
		// If there are no IDs, there is nothing to link.
		if(empty($image_ids)) {
			return;
		}
		
		// Clear any existing links on this resource.
		$this->db->where('link_resource_type', $resource_type);
		$this->db->where('link_resource_id', $resource_id);
		$this->db->where_in('link_image_id', $image_ids);
		$this->db->delete('image_link');
		
		// Tie new links
		$increment = false;
		foreach($image_ids as $index => $image_id) {
			
			// If this is a zero-based, increment it.
			if($index == 0) {
				$increment = true;
			}
			
			$this->db->insert('image_link', array(
				'link_image_id'			=> $image_id,
				'link_resource_id'		=> $resource_id,
				'link_resource_type'	=> $resource_type,
				'link_position'			=> $index + ($increment ? 1 : 0)
			));
		}
	}
	
	
	public function order() {
		
		$order = $this->input->post('order');
		$field = $this->input->post('fields');
		//foreach($order as $image_position => $image_id) {
		//	$this->db->update('image', array('image_position' => $image_position));
		//}
		
		echo json_encode(
			array(
				'success'	=> true,
				'data'		=> array('order' => $order, 'field' => $field['resource_id'])
			)
		);
	}
}