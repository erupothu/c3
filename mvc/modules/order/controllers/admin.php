<?php

class Admin extends INSIGHT_Admin_Controller {
	
	public function __construct() {

		parent::__construct();
		$this->load->model('order_model', 'order');
	}
	
	public function index() {
		
		$this->load->view('admin/order/index.view.php', array(
			'orders' => $this->order->retrieve()
		));
	}
	
	public function update($order_id) {
		
		$this->load->view('admin/order/update.view.php', array(
			'order' => $this->order->retrieve_by_id($order_id)
		));
	}
}