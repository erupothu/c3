<?php

class Gallery_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->model('image/image_model', 'image');
	}
	
	public function retrieve() {
		
		$this->db->select('g.*');
		$this->db->select('i.*');
		$this->db->select('il.*');
		$this->db->from('image_gallery g');
		$this->db->disable_escaping();
		$this->db->join(array('image_link il', 'image i'), 'il.link_resource_type = "gallery" and il.link_resource_id = g.gallery_id and i.image_parent_id = il.link_image_id', 'left');
		$this->db->order_by('g.gallery_id asc');
		$gallery_result = $this->db->get();
		
		$gallaries = $gallery_result->result('Gallery_Object');
		foreach($gallaries as &$gallery) {
			$gallery->attach($gallery_result->result('Image_Object'), $gallery->link_resource_id);
		}
		//array_map(mixed callback, array input1, array input2, [...])
		
		return $gallaries;
	}
	
	public function retrieve_by_id($gallery_id) {
		
		$this->db->select('g.*');
		$this->db->from('image_gallery g');
		$this->db->where('g.gallery_id', $gallery_id);
		
	}
	
	public function retrieve_by_slug($gallery_slug) {
		
		$this->db->select('g.*');
		$this->db->select('i.*');
		$this->db->select('il.link_position');
		$this->db->select('t.image_id as image_thumbnail_id');
		$this->db->select('t.image_path as image_thumbnail_path');
		$this->db->from('image_gallery g');
		$this->db->disable_escaping();
		//$this->db->join(array('image_link il', 'image i'), 'il.link_resource_type = "gallery" and il.link_resource_id = g.gallery_id and i.image_id = il.link_image_id', 'left');
		$this->db->join(array('image_link il', 'image t', 'image i'), 'il.link_resource_id = g.gallery_id and il.link_image_id = i.image_id and t.image_parent_id = i.image_id', 'left');
		
		
		$this->db->where('il.link_resource_type', 'gallery');
		$this->db->where('g.gallery_slug', $gallery_slug);
		
		$this->db->order_by('g.gallery_id asc');
		$gallery_result = $this->db->get();
		
		/*
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
		
		*/
		
		
		
		
		// Create Gallery & Attach Images
		$gallery = $gallery_result->row(0, 'Gallery_Object');
		return $gallery->attach($gallery_result->result('Image_Object'));
	}
}

class Gallery_Object implements IteratorAggregate {
	
	private $images = array();
	
	public function id() {
		return $this->gallery_id;
	}
	
	public function name() {
		return $this->gallery_name;
	}
	
	public function slug() {
		return $this->gallery_slug;
	}
	
	public function permalink() {
		return site_url(array('gallery', $this->slug()));
	}
	
	public function attach($images, $id = null) {
		$this->images = array_filter($images, function($image) { return is_a($image, 'Image_Object'); });
		return $this;
	}
	
	public function images() {
		return $this->images;
	}
	
	public function temp() {
		$first = $this->getIterator()->current();
		return !is_null($first) ? $first->html() : 'No Image';
	}
	
	public function getIterator() {
		return new ArrayIterator($this->images);
	}
}