<?php

class Order_Model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function create() {}
	
	public function retrieve() {
		
		$this->db->select('o.*');
		$this->db->select('u.*');
		$this->db->select('t.*');
		$this->db->from('order o');
		$this->db->join('user u', 'o.order_user_id = u.user_id', 'left');
		$this->db->join('transaction t', 'o.order_id = t.transaction_order_id and t.transaction_status = "success"', 'inner');
		$this->db->order_by('o.order_date_created desc');
		$this->db->group_by('o.order_id');
		$order_result = $this->db->get();
		
		return $order_result->result('Order_Object');
	}
	
	
	
	public function update() {
		
	}
	
	public function delete() {}


	public function retrieve_by_id($order_id) {
		
		$this->db->select('o.*');
		$this->db->select('u.*');
		$this->db->select('t.*');
		$this->db->from('order o');
		$this->db->join('user u', 'o.order_user_id = u.user_id', 'left');
		$this->db->join('transaction t', 'o.order_id = t.transaction_order_id and t.transaction_status = "success"', 'inner');
		$this->db->where('o.order_id', $order_id);
		$order_result = $this->db->get();
		
		return $order_result->row(0, 'Order_Object');
		
	}
}

// temp
require_once APPPATH . 'modules/account/models/address_model.php';

class Order_Object {
	
	public function id() {
		return $this->order_id;
	}
	
	public function code() {
		/* Should this be here, or in a sub-object? */
		return $this->transaction_code;
	}
	
	public function name() {
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
	
	
	public function delivery_address() {
		
		if(!isset($this->order_delivery_address)) {
			return Address_Object::create($this, 'order_delivery');
		}
		
	}
	
}