<?php

class Order_Model extends CI_Model {
	
	public function __construct() {

		parent::__construct();
		$this->load->model('purchase_model', 'purchase');
	}
	
	public function create() {
		
	}
	
	public function retrieve($with_items = false) {
		
		$this->db->select('o.*');
		$this->db->select('u.*');
		$this->db->select('t.*');
		$this->db->from('order o');
		$this->db->join('user u', 'o.order_user_id = u.user_id', 'left');
		$this->db->join('transaction t', 'o.order_id = t.transaction_order_id and t.transaction_status = "success"', 'inner');
		$this->db->order_by('o.order_date_created desc');
		$this->db->group_by('o.order_id');
		$order_result = $this->db->get();
		
		$order = $order_result->result('Order_Object');
		
		//if(!$with_items) {
			return $order;
		//}
		
		// Append Items.
		//$this->load->item('product/product_model', 'product');
		//$this->product->satan();
	}
	
	
	
	public function update() {
		
	}
	
	public function delete() {}


	public function retrieve_by_id($order_id, $with_items = true) {
		
		$this->db->select('o.*');
		$this->db->select('u.*');
		$this->db->select('t.*');
		$this->db->from('order o');
		$this->db->join('user u', 'o.order_user_id = u.user_id', 'left');
		$this->db->join('transaction t', 'o.order_id = t.transaction_order_id and t.transaction_status = "success"', 'inner');
		$this->db->where('o.order_id', $order_id);
		$order_result = $this->db->get();
		
		$order = $order_result->row(0, 'Order_Object');
		
		if(!$with_items) {
			return $order;
		}
		
		//$this->load->model('product/product_model', 'product');
		//$items = $this->product->test(array(1,2,3,4,5,6,7,8,9,10));
		
		// Append Items.
		$order->set_items($this->purchase->retrieve_by_order_id($order->id()));
		
		return $order;
	}
}

// temp
require_once APPPATH . 'modules/account/models/address_model.php';

class Order_Object implements Countable {
	
	private $order_items = array();
	
	public function id() {
		return $this->order_id;
	}
	
	public function code() {
		/* Should this be here, or in a sub-object? */
		return $this->transaction_code;
	}
	
	public function customer_type() {
		return $this->order_user_id == 0 ? 'Guest' : 'Registered';
	}
	
	public function customer_name() {
		return isset($this->user_firstname) ? trim(sprintf('%s %s', $this->user_firstname, $this->user_lastname)) : $this->order_delivery_name;		
	}
	
	public function net() {
		return $this->order_net;
	}
	
	public function tax() {
		return $this->order_tax;
	}
	
	public function total() {
		return $this->order_total;
	}
	
	public function status($format = false) {
		return $format ? '<span class="status-' . $this->order_status . '">' . ucfirst($this->order_status) . '</span>' : $this->order_status;
	}
	
	public function date() {

		$date = DateTime::createFromFormat(DATE_MYSQL, $this->order_date_created);
		return $date->format('d/m/Y');
	}
	
	public function items() {
		return $this->order_items;
	}
	
	public function set_items($items) {
		$this->order_items = $items;
	}
	
	public function delivery_address() {
		
		if(!isset($this->order_delivery_address)) {
			return Address_Object::create($this, 'order_delivery');
		}
	}
	
	
	public function count() {
		
		$count = 0;
		foreach($this->order_items as $item) {
			$count += $item->quantity();
		}
		
		return $count;
	}
}