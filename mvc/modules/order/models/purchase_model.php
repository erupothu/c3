<?php

class Purchase_Model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function create() {
		
	}
	
	public function retrieve() {
		
	}
	
	public function update() {
		
	}
	
	public function delete($purchase_id) {
		
		$this->db->from('order_purchase');
		$this->db->where('purchase_id', $purchase_id);
		$this->db->delete();
		
		return $this->db->affected_rows() === 1;
	}
	
	
	public function retrieve_by_order_id($order_id) {
		
		$this->db->select('*');
		$this->db->from('order_purchase op');
		$this->db->join('product p', 'p.product_id = op.purchase_module_id and op.purchase_module = "product"');
		$this->db->where('op.purchase_order_id', $order_id);
		$purchase_result = $this->db->get();
		
		return $purchase_result->result('Purchase_Object');
	}
}

class Purchase_Object {
	
	public function id() {
		return $this->purchase_id;
	}
	
	public function name() {
		return $this->purchase_name;
	}
	
	public function code() {
		return $this->product_code;
	}
	
	public function image() {
		return 'lol.jpg';
	}
	
	public function quantity() {
		return (int)$this->purchase_quantity;
	}
	
	public function price() {
		return $this->purchase_price;
	}
	
	public function tax() {
		return $this->purchase_tax;
	}
	
	public function total() {
		return $this->purchase_total;
	}
}