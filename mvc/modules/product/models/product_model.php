<?php

class Product_Model extends CI_Model {

	public function __construct() {
		
		parent::__construct();
		
		$this->load->model('category_model', 'category');
	}
	
	public function create() {
		
		$product_create = new DateTime;
		$product_insert = array(
			'product_user_id'		=> $this->administrator->id(),
			'product_category_id'	=> $this->form_validation->value('product_category_id'),
			'product_code'			=> $this->form_validation->value('product_code'),
			'product_name'			=> $this->form_validation->value('product_name', '', false),
			'product_slug'			=> '',
			'product_description'	=> $this->form_validation->value('product_description', null, false),
			'product_specification'	=> $this->form_validation->value('product_specification', null, false),
			'product_price'			=> $this->form_validation->value('product_price'),
			'product_enabled'		=> 1,
			'product_date_created'	=> $product_create->format('Y-m-d H:i:s'),
			'product_date_updated'	=> null
		);
		
		$this->db->insert('product', $product_insert);

		// Flash Message
		$this->session->set_flashdata('admin/message', sprintf('Product entitled "%s" has been created', $this->form_validation->value('product_name')));
		
		// Return the insert ID.
		return $this->db->insert_id();
	}
	
	public function update() {
		
	}
	
	public function retrieve() {
		
		$this->db->select('*');
		$this->db->from('product p');
		$this->db->join('product_category c', 'p.product_category_id = c.category_id', 'left');
		$product_result = $this->db->get();
		
		return $product_result->result('Product_Object');
	}
	
	public function delete() {
		
	}
	
	public function retrieve_by_slug($slug) {
		
		$this->db->select('*');
		$this->db->from('product p');
		$this->db->join('product_category c', 'p.product_category_id = c.category_id', 'left');
		$this->db->where('p.product_slug', $slug);
		$product_result = $this->db->get();
		
		return $product_result->row(0, 'Product_Object');
	}
	
	public function retrieve_by_category_id($category_id) {
		
		$this->db->select('*');
		$this->db->from('product p');
		$this->db->join('product_category c', 'p.product_category_id = c.category_id', 'left');
		$this->db->where('c.category_id', $category_id);
		$this->db->order_by('p.product_name');
		$product_result = $this->db->get();
		
		return $product_result->result('Product_Object');
	}

}

class Product_Object {
	
	public function id() {
		return $this->product_id;
	}
	
	public function category() {
		return $this->category_name;
	}
	
	public function name() {
		return $this->product_name;
	}
	
	public function code() {
		return $this->product_code;
	}
	
	public function permalink() {
		return site_url(array('product', $this->product_slug));
	}

	public function excerpt($length = 160, $cleaned = true) {
		
		$content = $this->description();
		$content = strip_tags($content);
		
		preg_match(sprintf('/\A(.{%1$u,%2$u}(?!\w)|.{0,%2$u})/s', 0, $length), $content, $matches);
		$excerpt = $matches[1] . (strlen($content) > $length ? '&hellip;' : '');
		
		return $excerpt;
	}
	
	public function description() {
		return $this->product_description;
	}
	
	public function specification() {
		return $this->product_specification;
	}
	
	public function price() {
		return $this->product_price;
	}
	
	public function created() {
		
	}
}