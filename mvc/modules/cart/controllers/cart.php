<?php

require_once APPPATH . 'modules/product/models/product_model.php';

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
	
	public function raw_contents() {
		
		if(!$contents = $this->hook->get($this->key . '/items'))
			return array();
		
		return $contents;
	}
	
	public function contents($extra = false) {
		
		$data 	= array();
		$module = array();
		foreach($this->raw_contents() as $key => $item) {
			
			if(!isset($module[$item['module']]))
				$module[$item['module']] = array();
			
			$module[$item['module']][$key] = $item['id'];
		}
		
		
		foreach($module as $module_name => $module_items) {
			
			$module_list = array_values($module_items);
			
			if(count($module_list) == 0)
				continue;
			
			sort($module_list);
			
			// Temporarily load the model.
			$module_model = sprintf('%1$s/%1$s_model', $module_name);
			CI::$APP->load->model($module_model, $cart_model = __CLASS__ . $module_name);

			// Append items.
			$data = array_merge($data, CI::$APP->$cart_model->test($module_list));
			
			// Cleanup.
			//unset(CI::$APP->$cart_model);
		}
		
		if($extra) {
			// example delivery?
			$data[] = new Temp_Delivery_Ob;
		}
		
		return $data;
	}
	
	public function add($item_module, $item_id, $item_quantity) {
		
		$contents = $this->raw_contents();
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
		
		$contents = $this->raw_contents();
		if(!isset($contents[$item_hash])) {
			return false;
		}
		
		$this->hook->set($this->key . '/items/' . $item_hash);
		return true;	
	}
	
	public function size($unique_items = false) {
		
		if($unique_items) {
			return count($this->raw_contents());
		}
		
		$size = 0;
		foreach($this->raw_contents() as $item) {
			$size += $item['quantity'];
		}
		
		return $size;
	}
	
	public function tax() {
		
		$tax = 0.0;
		foreach($this->contents() as $item) {
			$tax += ($item->tax() * $item->quantity());
		}
		
		return sprintf('%0.2f', $tax);
	}
	
	public function total($include_tax = true) {
		
		$total = 0;
		foreach($this->contents() as $item) {
			$total += $item->total($include_tax);
		}
		
		return sprintf('%0.2f', $total);
	}
	
	public function reset() {
		return $this->hook->set($this->key, null);
	}
}

class Temp_Delivery_Ob {
	
	public function id() {
		return 1;
	}
	
	public function hash() {
		return md5('delivery' . $this->id());
	}
	
	public function name() {
		return 'Mainland Delivery (UK)';
	}
	
	public function description() {
		return '';
	}
	
	public function permalink() {
		return false;
	}
	
	final public function quantity() {
		return '';
	}
	
	public function price() {
		return '';
	}
	
	public function tax() {
		return '';
	}
	
	public function total() {
		return 6.99;
	}
}


class Cart extends INSIGHT_HMVC_Controller {
	
	public function __construct() {

		parent::__construct();
		
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->cart = Cart_Object::init();
		
		$this->load->config('countries', true);
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
			case 'content': {
				return $this->cart->raw_contents();
			}
		}

	}
	
	public function checkout() {
		
		if($this->cart->size() == 0) {
			$this->session->set_flashdata('core/message', 'Your cart is currently empty.');
			return redirect('cart');
		}
		
		// Load Gateway.
		$gateway_class = sprintf('%2$sGateway_%1$s', ucfirst(CI::$APP->insight->config('user/gateway/gateway_class')), $this->router->fetch_module() == 'gateway' ? '' : 'gateway/');
		$this->load->library($gateway_class, CI::$APP->insight->config('user/gateway'), 'gateway');
		
		//var_dump($this->user);
		//var_dump($this->input->post());

		$delivery_address_id = $this->input->post('delivery_address_id');
		$billing_address_id	= $this->input->post('billing_address_id');
		
		$this->load->model('account/address_model', 'address');
		
		if(false !== $delivery_address_id) {
			
			// Addresses
			$billing_address = $this->address->retrieve_by_id($billing_address_id);
			$delivery_address = $this->address->retrieve_by_id($delivery_address_id);
						
			// gateway set delivery address
			$this->gateway->set_delivery($delivery_address);
			
			// gateway set billing address
			$this->gateway->set_billing($billing_address);
			
			// gateway set basket & amount
			$this->gateway->set_cart();
			
			// gateway process?
			return $this->gateway->dispatch();
		}
		
		$this->load->view('templates/checkout.view.php', array(
			'addresses'	=> $this->address->retrieve($this->user->id())
		));
	}
}