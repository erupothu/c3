<?php

class Cart_Object {
	
	private $key = 'cart';
	private $hook;
	
	public function __construct() {
		
		$this->hook = &CI::$APP->session;
		$data = $this->hook->get($this->key);
	}
	
	static public function init() {
		$CI = &CI::$APP;
		$cart = new self;
		$cart->hook = &$CI->session;
		return ($CI->cart = &$cart);
	}
	
	public function contents() {
		
		if(!$contents = $this->hook->get($this->key . '/items'))
			return array();
			
		return $contents;
	}
	
	public function add($item_module, $item_id, $item_quantity) {
		
		$contents = $this->contents();
		$itemhash = md5($item_module . $item_id);
		
		if(isset($contents[$itemhash])) {
			
			$contents[$itemhash]['quantity'] += $item_quantity;
		}
		else {
			
			$contents[$itemhash] = array(
				'id'		=> $item_id,
				'module'	=> $item_module,
				'quantity'	=> $item_quantity
			);
		}
		
		// Resave contents
		$x = $this->hook->set($this->key . '/items', $contents);
		var_dump($x);
		return true;
	}
	
	public function remove($item_hash) {
		
		$contents = $this->contents();
		if(!isset($contents[$item_hash])) {
			return false;
		}
		
		$this->hook->set($this->key . '/items/' . $item_hash);
		return true;	
	}
	
	public function size($unique_items = false) {
		
		if($unique_items) {
			return count($this->contents());
		}
		
		$size = 0;
		foreach($this->contents() as $item) {
			$size += $item['quantity'];
		}
		
		return $size;
	}
	
	public function total() {
		return sprintf('%0.2f', 0);
	}
	
	public function reset() {
		return $this->hook->set($this->key, null);
	}
}

class Cart extends INSIGHT_HMVC_Controller {
	
	public function __construct() {

		parent::__construct();
		
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->cart = Cart_Object::init();
	}
	
	public function index() {

		$this->load->view('templates/cart.view.php');
	}
	
	public function add() {

		if($this->form_validation->run('cart-add') && $this->cart->add($this->form_validation->value('product_module'), $this->form_validation->value('product_id'), $this->form_validation->value('product_quantity'))) {
			$this->session->set_flashdata('core/message', 'Item added.');
		}

		redirect('cart');
	}
	
	public function update() {
		$this->session->set_flashdata('core/message', 'Cart has been updated.');
		redirect('cart');
	}
	
	public function remove($item_hash) {
		
		if(false !== $this->cart->remove($item_hash)) {
			$this->session->set_flashdata('core/message', 'Item removed.');
		}
		
		redirect('cart');
	}
	
	public function _empty() {
		
		if(false !== $this->cart->reset()) {
			$this->session->set_flashdata('core/message', 'Your cart has been emptied');
		}
		
		redirect('cart');
	}
	
	public function meta($key) {
		
		switch($key) {
			
			case 'size': {
				return sprintf('%d item%s', $this->cart->size(), $this->cart->size() == 1 ? '' : 's');
				break;
			}
		}

	}
	
	public function checkout() {
		$this->load->view('templates/checkout.view.php');
	}
}