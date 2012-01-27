<?php

// Temp Hack.
include_once APPPATH . 'modules/page/models/page_model.php';

class Category_Model extends NestedSet_Model {

	public function __construct() {		
		parent::__construct();
	}
	
	
	public function retrieve() {
		
		$this->db->select('*');
		$this->db->from('product_category');
		$this->db->order_by('category_left');
		$category_result = $this->db->get();
		
		return $category_result->result('Category_Object');
	}

	public function retrieve_by_slug($category_slug, $retrieve_products = false) {
		
		$this->db->select('c.*');
		$this->db->from('product_category c');
		$this->db->where('c.category_slug', $category_slug);
		$this->db->order_by('category_left');
		$category_result = $this->db->get();
		
		$category = $category_result->row(0, 'Category_Object');
		
		$category->products = $this->product->retrieve_by_category_id($category->id());
		
		
		return $category;
	}
}

class Category_Object {
	
 	public $products = array();
	
	public function id() {
		return $this->category_id;
	}
	
	public function name() {
		return $this->category_name;
	}
	
	public function products() {
		return $this->products;
	}
	
	public function permalink() {
		return $this->product_slug;
	}
}

/*
class Nested_Category_Object extends Category_Object implements RecursiveIterator, Countable {
}*/