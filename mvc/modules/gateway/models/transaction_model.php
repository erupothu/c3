<?php

class Transaction_Model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function create($order_id, $code = null) {
		
		// Earmark the transaction.
		$transaction = array(
			'transaction_order_id'	=> $order_id,
			'transaction_code'		=> $code,
			'transaction_user_id'	=> CI::$APP->user->id(),
			'transaction_status'	=> 'pending'
		);
		
		$this->db->insert('transaction', $transaction);
		return $this->db->insert_id();
	}
	
	public function retrieve() {}
	public function update() {}
	public function delete() {}
	
	public function unique() {
		
		$this->db->select('IFNULL(MAX(t.transaction_id) + 1, 1) as transaction_number', false);
		$this->db->from('transaction t');
		$transaction_result = $this->db->get();
		
		return $transaction_result->row('transaction_number');
	}
}