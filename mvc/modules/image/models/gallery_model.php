<?php

class Gallery_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->model('image/image_model', 'image');
	}
	
	
	public function create() {
		
		$gallery_create = new DateTime;
		$gallery_insert = array(
			'gallery_name'			=> $this->form_validation->value('gallery_name'),
			'gallery_slug'			=> $this->form_validation->value('gallery_slug'),
			'gallery_date_created'	=> $gallery_create->format(DATE_MYSQL_DATETIME)
		);
		
		$this->db->insert('image_gallery', $gallery_insert);
		
		// Flash Message
		$this->session->set_flashdata('admin/message', sprintf('Image Gallery entitled "%s" has been created', $this->form_validation->value('gallery_name')));
		
		// Return the insert ID.
		return $this->db->insert_id();
	}
	
	public function retrieve() {
		
		$galleries = array();
		$this->db->select('g.*');
		$this->db->select('i.*');
		$this->db->select('il.*');
		$this->db->select('count(i.image_id) as image_count');
		//$this->db->select('(select count(im.link_image_id) from image_link im where im.link_resource_type = "gallery" and im.link_resource_id = g.gallery_id) as image_count');
		$this->db->from('image_gallery g');
		$this->db->disable_escaping();
		$this->db->join(array('image_link il', 'image i'), 'il.link_resource_type = "gallery" and il.link_resource_id = g.gallery_id and i.image_parent_id = il.link_image_id', 'left');
		$this->db->order_by('g.gallery_id asc');
		$this->db->group_by('g.gallery_id');
		
		$gallery_result = $this->db->get();
		
		$galleries = $gallery_result->result('Gallery_Object');
		$images = $gallery_result->result('Image_Object');
		foreach($galleries as &$gallery) {
			$gallery->attach($images, $gallery->link_resource_id);
		}
		
		return $galleries;
	}
	
	public function update($gallery_id) {
		
		$gallery_update = array(
			'gallery_name'			=> $this->form_validation->value('gallery_name'),
			'gallery_slug'			=> $this->form_validation->value('gallery_slug')
		);
		
		$this->db->update('image_gallery', $gallery_update, array('gallery_id' => $gallery_id));
		
		// Flash Message
		$this->session->set_flashdata('admin/message', sprintf('Image Gallery entitled "%s" has been updated', $this->form_validation->value('gallery_name')));
		
		// Returns true if a record has successfully been modified.
		return $this->db->affected_rows() === 1;
	}
	
	
	public function retrieve_by_id($gallery_id) {
		
		$this->db->select('g.*');
		$this->db->select('i.*');
		$this->db->select('il.link_position');
		$this->db->select('t.image_id as image_thumbnail_id');
		$this->db->select('t.image_path as image_thumbnail_path');
		$this->db->from('image_gallery g');
		$this->db->disable_escaping();
		$this->db->join(array('image_link il', 'image t', 'image i'), 'il.link_resource_type = "gallery" and il.link_resource_id = g.gallery_id and il.link_image_id = i.image_id and t.image_parent_id = i.image_id', 'left');
		$this->db->where('g.gallery_id', $gallery_id);
		$this->db->order_by('g.gallery_id asc');
		$this->db->group_by('g.gallery_id');
		$gallery_result = $this->db->get();
		
		// Create Gallery & Attach Images
		$gallery = $gallery_result->row(0, 'Gallery_Object');
		return $gallery->attach($gallery_result->result('Image_Object'));
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
	
	
	
	// @TODO 'generic' this.
	public function ajax_slug($json) {
		
		$iter = 0;
		$name = str_replace(array('&'), array('and'), $json['incoming']['gallery_name']);
		$slug = url_title($name, 'dash', true);
		
		while(false === $this->validate_unique_permalink($slug, null, isset($json['incoming']['gallery_id']) ? array($json['incoming']['gallery_id']) : array())) {
			
			$slug = url_title($name . ($iter === 0 ? '' : '-' . $iter), 'dash', true);
			$iter++;
		}
		
		$json = array_merge($json, array('status' => true, 'result' => array(
			'slug'	=> $slug,
			'iter'	=> $iter
		)));
		
		return $json;
	}
	
	public function validate_unique_permalink($slug, $reference_field = 'gallery_id', $ignore = array()) {
		
		if(!is_null($reference_field) && $this->form_validation->value($reference_field)) {
			$ignore[] = $this->form_validation->value($reference_field);
		}
		
		$this->db->select('ig.gallery_id');
		$this->db->from('image_gallery ig');
		$this->db->where('ig.gallery_slug', $slug);
		if(is_array($ignore) && count($ignore) > 0) {
			$this->db->where_not_in('ig.gallery_id', $ignore);
		}
		
		$gallery_result = $this->db->get();
		if($gallery_result->num_rows() === 0)
			return true;
		
		$this->form_validation->set_message('module_callback', sprintf('The %%s must be unique. "%s" has been taken!', $slug));
		return false;
	}
}

class Gallery_Object implements IteratorAggregate, Countable {
	
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
	
	public function permalink($complete = false) {
		return $complete ? site_url(array('gallery', $this->slug())) : $this->slug();
	}
	
	public function attach($images, $id = null) {
		$this->images = array_filter($images, function($image) { return is_a($image, 'Image_Object') && !is_null($image->id()); });
		return $this;
	}
	
	public function count() {
		
		// Allow the count to be overridden.
		if(isset($this->image_count) && is_numeric($this->image_count)) {
			return $this->image_count;
		}
		
		return count($this->images());
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