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
	
	public function retrieve_by_id($category_id) {
		
		$this->db->select('c.*');
		$this->db->from('product_category c');
		$this->db->where('c.category_id', $category_id);
		$this->db->order_by('category_left');
		$category_result = $this->db->get();
		
		$category = $category_result->row(0, 'Category_Object');
		$category->products = $this->product->retrieve_by_category_id($category->id());
		
		return $category;
	}

	public function retrieve_by_slug($category_slug, $retrieve_products = false) {
		
		$this->db->select('c.*');
		$this->db->from('product_category c');
		$this->db->where('c.category_slug', $category_slug);
		$this->db->order_by('category_left');
		$category_result = $this->db->get();
		
		if(!$category = $category_result->row(0, 'Category_Object')) {
			return false;
		}
		
		if($retrieve_products) {
			$category->products = $this->product->retrieve_by_category_id($category->id());
		}
		
		return $category;
	}
	
	/**
	 * retrieve_nested
	 * 
	 * @TODO make this part of NestedSet... abstract.
	 */
	public function retrieve_nested($element_root = 0, $element_limit = null) {

		$this->db->select('cn.category_id');
		$this->db->select('cn.category_name');
		$this->db->select('cn.category_slug');

		// debug:
		$this->db->select('cn.category_left, cn.category_right');

		$this->db->select('cn.category_date_created');
		$this->db->select('group_concat(cp.category_slug order by cp.category_id separator "/") as category_slug_path', false);

		$this->db->from('product_category cp');
		$this->db->from('product_category cn');

		$this->db->where('(cn.category_left between cp.category_left and cp.category_right)');

		$this->db->group_by('cn.category_id');
		$this->db->order_by('cn.category_left');

		// If we need to obtain a sub-tree, we need to join
		// an additional items table plus the sub-tree to cross-reference
		if($element_root != 0 && is_numeric($element_root)) {

			// TEMP:
			$this->db->select('nullif(ct.category_id, cn.category_id) as category_parent_id', false);

			$this->db->from('product_category cs');
			$this->db->from(sprintf('(
				select
					cn.category_id,
					(count(cp.category_id) - 1) as category_depth
				from
					product_category as cn,
					product_category as cp
				where
					cn.category_left between cp.category_left and cp.category_right
						and cn.category_id = %d
					group by cn.category_id
					order by cn.category_left
			) as ct', $element_root));

			$this->db->where('(cn.category_left between cs.category_left and cs.category_right)');
			$this->db->where('(cs.category_id = ct.category_id)');
			$this->db->select('(count(cp.category_id) - (ct.category_depth + 1)) as category_depth');

			// Limit the depth of the sub-tree?
			if(!is_null($element_limit)) {
				$this->db->having('category_depth <=' . $element_limit);
			}
		}
		else {
			$this->db->select('count(cp.category_id) - 1 as category_depth');
		}

		$category_result = $this->db->get();
	    $category_objects = $category_result->result('Nested_Category_Object');
		$tree_objects = $this->build_tree($category_objects);

		// Built a tree out of 'Nested_category_Object's
		// If we have specified a root, stop it being wracped in an array by build_tree.
		return $element_root == 0 ? $tree_objects : current($tree_objects);
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

class Nested_Category_Object extends Category_Object implements RecursiveIterator, Countable {
	
	
	public function depth() {
		return (int)$this->category_depth;
	}
	
	
	/* Countable */
	public function count() {
		
	}
	
	
	/* Iterator */
	public function current() {
		
	}
	
	public function next() {
		
	}
	
	public function key() {
		
	}
	
	public function valid() {
		
	}
	
	public function rewind() {
		
	}
	
	
	/* RecursiveIterator */
	public function hasChildren() {
		
	}
	
	public function getChildren() {
		
	}
}