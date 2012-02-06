<?php

class Product_Model extends CI_Model {

	public function __construct() {
		
		parent::__construct();
		
		if($this->router->fetch_module() == 'product') {
			$this->load->model('category_model', 'category');
		}
	}
	
	
	public function test($product_ids, $mapped_object = 'Product_Object') {
		
		if(!is_array($product_ids)) {
			return $this->__function__(array($product_ids));
		}
		
		$this->db->select('*');
		$this->db->from('product p');
		$this->db->join('product_category c', 'p.product_category_id = c.category_id', 'left');
		$this->db->where_in('p.product_id', $product_ids);
		$product_result = $this->db->get();
		
		return $product_result->result($mapped_object);
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

	
	public function retrieve() {
		
		$this->db->select('*');
		$this->db->from('product p');
		$this->db->join('product_category c', 'p.product_category_id = c.category_id', 'left');
		$product_result = $this->db->get();
		
		return $product_result->result('Product_Object');
	}

	public function update($product_id) {

		$product_update = new DateTime;
		$product_change = array(
			'product_category_id'	=> $this->form_validation->value('product_category_id'),
			'product_code'			=> $this->form_validation->value('product_code'),
			'product_name'			=> $this->form_validation->value('product_name', '', false),
//			'product_slug'			=> '',
			'product_description'	=> $this->form_validation->value('product_description', null, false),
			'product_specification'	=> $this->form_validation->value('product_specification', null, false),
			'product_price'			=> $this->form_validation->value('product_price'),
//			'product_enabled'		=> 1,
			'product_date_updated'	=> $product_update->format('Y-m-d H:i:s')
		);

		$this->db->update('product', $product_change, array('product_id' => $product_id));

		// Flash Message
		$this->session->set_flashdata('admin/message', sprintf('Product entitled "%s" has been updated', $this->form_validation->value('product_name')));

		// True on update, else false.
		return $this->db->affected_rows() === 1;
	}
	
	public function delete() {
		
	}
	
	public function retrieve_by_id($product_id) {
		
		$this->db->select('*');
		$this->db->from('product p');
		$this->db->join('product_category c', 'p.product_category_id = c.category_id', 'left');
		$this->db->where('p.product_id', $product_id);
		$product_result = $this->db->get();
		
		return $product_result->row(0, 'Product_Object');
	}
	
	public function retrieve_by_slug($product_slug) {
		
		$this->db->select('*');
		$this->db->from('product p');
		$this->db->join('product_category c', 'p.product_category_id = c.category_id', 'left');
		$this->db->where('p.product_slug', $product_slug);
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

interface Cart_Object_Interface {
	
	public function id();
	public function hash();
	public function name();
	public function image();
	public function description();
	public function code();
	public function price();
	public function tax();
	public function permalink();
	public function quantity();
}

class Cart_Item_Object {
	
	public function quantity() {
		return max(0, CI::$APP->session->get(sprintf('cart/items/%s/quantity', $this->hash())));
	}
	
	public function tax() {
		return sprintf('%0.2f', $this->price(false) * 0.2);
	}
	
	public function total() {
		return $this->quantity() * ($this->price() + $this->tax());
	}
}

class Product_Object extends Cart_Item_Object {
	
	public function id() {
		return (int)$this->product_id;
	}
	
	public function hash() {
		return md5('product' . $this->id());
	}
	
	public function category_id() {
		return (int)$this->product_category_id;
	}
	
	public function category() {
		return $this->category_name;
	}
	
	public function image() {
		return '';
	}
	
	public function name() {
		return $this->product_name;
	}
	
	public function code() {
		return $this->product_code;
	}
	
	public function permalink() {
		return site_url(array('product', 'view', $this->product_slug));
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
	
	public function price($include_tax = false) {
		
		if(!$include_tax) {
			return $this->product_price;
		}
		
		return $this->tax() + $this->product_price;
	}
	
	public function created($format = 'd/m/Y H:i') {
		$dt = DateTime::createFromFormat('Y-m-d H:i:s', $this->product_date_created);
		return false !== $format ? $dt->format($format) : $dt;
	}
	
	public function updated($format = 'd/m/Y H:i') {
		
		if(is_null($this->product_date_updated))
			return $this->created($format);
		
		$dt = DateTime::createFromFormat('Y-m-d H:i:s', $this->product_date_updated);
		return false !== $format ? $dt->format($format) : $dt;
	}
}