<?php

require_once 'Gateway.php';

class Gateway_Sagepay extends INSIGHT_Gateway {
	
	const SAGEPAY_VPS_PROTOCOL = '2.23';
	
	protected $raw = array();
	
	protected $sage_partner;				// sage partnership id	
	protected $sage_vendor_name;			// sage vendor name
	protected $sage_encryption_string;	// sage encryption string

	protected $sage_valid_tokens = array(
		'Status',
		'StatusDetail',
		'VendorTxCode',
		'VPSTxId',
		'TxAuthNo',
		'Amount',
		'AVSCV2', 
		'AddressResult', 
		'PostCodeResult', 
		'CV2Result', 
		'GiftAid', 
		'3DSecureStatus', 
		'CAVV',
		'AddressStatus',
		'CardType',
		'Last4Digits',
		'PayerStatus'
	);
	
	
	protected $sage_endpoints = array(
		'LIVE'		=> 'https://live.sagepay.com/gateway/service/vspform-register.vsp',
		'TEST'		=> 'https://test.sagepay.com/gateway/service/vspform-register.vsp',
		'SIMULATOR'	=> 'https://test.sagepay.com/simulator/vspformgateway.asp'
	);
	
	
	public function __construct() {
		
		parent::__construct();
		
		// temp stuff.
		$this->sage_vendor_name 		= 'technical9';
		$this->sage_encryption_string 	= 'g9hVBEtzkPa2wHp0';
		
		// temp data array.
		$this->test_data = array(
			'VendorTxCode'			=> '',
			'Amount'				=> '199.99',
			'Currency'				=> 'GBP',
			'Description'			=> 'Anubis Ltd',
			'SuccessURL'			=> site_url(array(CI::$APP->router->fetch_module(), 'process')),
			'FailureURL'			=> site_url(array(CI::$APP->router->fetch_module(), 'process')),
			'CustomerName'			=> 'John Doe',
			'CustomerEMail'			=> 'jon@creativeinsight.co.uk',
			'VendorEMail'			=> 'jon@creativeinsight.co.uk',
			'SendEMail'				=> 1,
			'eMailMessage'			=> 'This is a message that is put into the emails sent',
			
			'BillingSurname'		=> 'Doe',
			'BillingFirstnames'		=> 'John',
			'BillingAddress1'		=> '31 Coleshill Street',
			'BillingAddress2'		=> 'Sutton Coldfield',
			'BillingCity'			=> 'Birmingham',
			'BillingPostCode'		=> 'B72 1SD',
			'BillingState'			=> null,
			'BillingCountry'		=> 'GB',
			'BillingPhone'			=> '01213212828',
			
			'DeliverySurname'		=> 'Doe',
			'DeliveryFirstnames'	=> 'John',
			'DeliveryAddress1'		=> '31 Coleshill Street',
			'DeliveryAddress2'		=> 'Sutton Coldfield',
			'DeliveryCity'			=> 'Birmingham',
			'DeliveryPostCode'		=> 'B72 1SD',
			'DeliveryState'			=> null,
			'DeliveryCountry'		=> 'GB',
			'DeliveryPhone'			=> '01213212828',
			
			'Basket'				=> '4:Pioneer NSDV99 DVD-Surround Sound System:1:424.68:74.32:499.00:499.00:Donnie Darko Directors Cut:3:11.91:2.08:13.99:41.97:Finding Nemo:2:11.05:1.94:12.99:25.98:Delivery:---:---:---:---:4.9',
			'AllowGiftAid'			=> 0,
			'ApplyAVSCV2'			=> 0,
			'Apply3DSecure'			=> 0,
//			'BillingAgreement'		=> 0	// ONLY SET ON PAYPAL.
		);
		
		
		
		$this->raw = array(
			'Currency'			   	=> 'GBP',
			'Description'		   	=> 'Anubis Associates Ltd',
			'SuccessURL'		   	=> site_url(array('gateway', 'process')),
			'FailureURL'		   	=> site_url(array('gateway', 'process')),
			'VendorEMail'		   	=> 'jon@creativeinsight.co.uk',
			'SendEMail'			   	=> 1,
			'eMailMessage'		   	=> 'This is a message that is put into the emails sent',
			'AllowGiftAid'		   	=> 0,
			'ApplyAVSCV2'		   	=> 0,
			'Apply3DSecure'		   	=> 0,
//			'BillingAgreement'	   	=> 0	// ONLY SET ON PAYPAL.
		);
		
		//var_dump(CI::$APP->insight->config('user/gateway'));
		
		
		
		
		// temp
		$this->db = &CI::$APP->db;
	}
	
	public function raw() {
		return $this->raw;
	}
	
	
	public function get_endpoint() {
		
		if(!isset($this->configuration['gateway_sagepay_endpoint']) || !isset($this->sage_endpoints[$this->configuration['gateway_sagepay_endpoint']])) {
			throw new Gateway_Exception('Invalid endpoint. Must be one of the following: ' . implode(', ', array_keys($this->sage_endpoints)));
		}
			
		return $this->sage_endpoints[$this->configuration['gateway_sagepay_endpoint']];
	}
	
	
	protected function set_address($key, $address) {
		
		if($address instanceof Address_Object) {
			
			// Address Objects do not separate the name into two 
			// segments, so we need to split this here to achieve it.
			list($address_firstnames, $address_lastname) = preg_split('/\s+/', $address->name(), 2, PREG_SPLIT_NO_EMPTY);
			
			$chunk = array(
				$key . 'Surname'	=> $address_lastname,
				$key . 'Firstnames'	=> $address_firstnames,
				$key . 'Address1'	=> $address->line1(),
				$key . 'Address2'	=> $address->line2(),
				$key . 'City'		=> $address->city(),
				$key . 'PostCode'	=> $address->postcode(),
				$key . 'State'		=> null,
				$key . 'Country'	=> $address->country(),
				$key . 'Phone'		=> $address->phone()
			);
		}
		else {
			
			$chunk = array(
				$key . 'Surname'	=> $address['address_lastname'],
				$key . 'Firstnames'	=> $address['address_firstname'],
				$key . 'Address1'	=> $address['address_line1'],
				$key . 'Address2'	=> $address['address_line2'],
				$key . 'City'		=> $address['address_city'],
				$key . 'PostCode'	=> $address['address_postcode'],
				$key . 'State'		=> null,
				$key . 'Country'	=> $address['address_country'],
				$key . 'Phone'		=> $address['address_phone']
			);
		}
		
		// Merge.
		$this->raw = array_merge($this->raw, $chunk);
		
		return $chunk;
	}
	
	public function set_delivery($address) {
		return $this->set_address('Delivery', $address);
	}
	
	public function set_billing($address) {
		return $this->set_address('Billing', $address);
	}
	
	public function set_cart() {
		
		$cart = Cart_Object::init();
		
		$items = array();
		foreach($cart->contents(true) as $item) {
			$items[] = sprintf('%s:%s:%s:%s:%s:%0.2f', $item->name(), $item->quantity(), $item->price(), $item->tax(), $item->price(true), $item->total());
		}
		
		$chunk = array(
			'Amount'	=> $cart->total(),
			'Currency'	=> 'GBP',
			'Basket'	=> sprintf('%d:%s', count($items), implode(':', $items))
		);
		
		// Merge.
		$this->raw = array_merge($this->raw, $chunk);
	}
	
	
	public function dispatch() {
		
		// Register a transaction code.
		// @TODO:  Move this to a model.
		//$this->db->select('IFNULL(MAX(t.transaction_id) + 1, 1) as transaction_number', false);
		//$this->db->from('transaction t');
		//$transaction_result = $this->db->get();
		
		// @TODO
		// Make this configurable (the key, etc.)
		// can't use ->LOAD!!! we're not in a CI class.
		CI::$APP->load->model('Gateway/transaction_model', 'transaction');
		$this->transaction = &CI::$APP->transaction;
		
		if(!isset($this->configuration['gateway_sagepay_vendor']) || !isset($this->configuration['gateway_encryption_key'])) {
			throw new Gateway_Exception(__CLASS__ . ' requires a valid Vendor and Encryption String to be present.');
		}
		

		$transaction_cart	= Cart_Object::init();
		
		// Gateway configuration fallbacks
		$transaction_type	= isset($this->configuration['gateway_sagepay_transaction_type']) && in_array(strtoupper($this->configuration['gateway_sagepay_transaction_type']), array('PAYMENT', 'DEFERRED', 'AUTHENTICATE')) ? strtoupper($this->configuration['gateway_sagepay_transaction_type']) : 'PAYMENT';
		$transaction_stub 	= isset($this->configuration['gateway_order_stub']) ? $this->configuration['gateway_order_stub'] : strtoupper(substr($host = parse_url(site_url(), PHP_URL_HOST), 0, strpos($host, '.')));		
		$transaction_format	= isset($this->configuration['gateway_order_format']) ? $this->configuration['gateway_order_format'] : '%-.3s-%06d';
		$transaction_code	= sprintf($transaction_format, $transaction_stub, $this->transaction->unique());
		$transaction_vendor	= $this->configuration['gateway_sagepay_vendor'];

		
		
		$order_time = new DateTime;
		$order = array(
			'order_user_id'				=> CI::$APP->user->id(),
			'order_delivery_name'		=> trim(sprintf('%s %s', $this->raw['DeliveryFirstnames'], $this->raw['DeliverySurname'])),
			'order_delivery_address1'	=> $this->raw['DeliveryAddress1'],
			'order_delivery_address2'	=> $this->raw['DeliveryAddress2'],
			'order_delivery_city'		=> $this->raw['DeliveryCity'],
			'order_delivery_state'		=> $this->raw['DeliveryState'],
			'order_delivery_postcode'	=> $this->raw['DeliveryPostCode'],
			'order_delivery_country'	=> $this->raw['DeliveryCountry'],
			'order_net'					=> $transaction_cart->total(false),
			'order_tax'					=> $transaction_cart->tax(),
			'order_total'				=> $transaction_cart->total(),
			'order_status'				=> 'processing',
			'order_date_created'		=> $order_time->format('Y-m-d H:i:s')
		);
		
		$order_id = CI::$APP->db->insert('order', $order);
		
		
		// Earmark transaction.
		$transaction_id = $this->transaction->create($order_id, $transaction_code);
		
		// Append TxCode.
		$this->raw['VendorTxCode'] = $transaction_code;
		
		
		// Output form.
		$output = Modules::run('gateway/output', 'chunks/sagepay.form.chunk.php', array(
			'transaction_endpoint'	=> $this->get_endpoint(),
			'transaction_payload'	=> $this->build(),
			'transaction_type'		=> $transaction_type,
			'transaction_vendor'	=> $transaction_vendor,
			'auto_submit'			=> true
		));
		
		return CI::$APP->output->set_output($output);
	}
	
	
	
	
	
	public function test() {
		
		// TEMP GET CART ITEMS.
		$this->cart = Cart_Object::init();
		
		$lines = array();
		foreach($this->cart->contents(true) as $item) {
			$lines[] = sprintf('%s:%s:%s:%s:%s:%0.2f', $item->name(), $item->quantity(), $item->price(), $item->tax(), $item->price(true), $item->total());
		}
		
		$this->test_data['Basket'] = sprintf('%d:%s', count($lines), implode(':', $lines));
		$this->test_data['Amount'] = $this->cart->total();
		
		
		// Register a transaction code.
		$this->db->select('IFNULL(MAX(t.transaction_id) + 1, 1) as transaction_number', false);
		$this->db->from('transaction t');
		$transaction_result = $this->db->get();
		
		$transaction_code = sprintf('%-.3s-%06d', 'zANUBIS', $transaction_result->row('transaction_number'));
		$this->test_data['VendorTxCode'] = $transaction_code;

		//delivery_address1	delivery_address2	delivery_town	delivery_county	delivery_postcode
		
		
		// This is going to be a pending transaction now.
		$order_time = new DateTime;
		$this->db->insert('order', array(
			'order_transaction_id'	=> $transaction->transaction_id,
			'order_user_id'			=> $transaction->transaction_user_id,
			'order_net'				=> 0.00,
			'order_tax'				=> 0.00,
			'order_total'			=> $transaction->transaction_amount,
			'order_status'			=> 'processing',
			'order_date_created'	=> $order_time->format('Y-m-d H:i:s')
		));
		
		
		
		// Earmark the transaction.
		$transaction = array(
			'transaction_order_id'	=> $order_id,
			'transaction_code'		=> $transaction_code,
			'transaction_user_id'	=> CI::$APP->user->id(),
			'transaction_status'	=> 'pending',
			'transaction_details'	=> 'Awaiting communication from SagePay'
		);
		
		$this->db->insert('transaction', $transaction);
		$transaction_id = $this->db->insert_id();
		
		
		
		
		// BUILD.
		
		$array = array();
		foreach($this->test_data as $k => $v) {
			
			if(is_null($v))
				continue;
			
			$array[] = $k . '=' . $v;
		}
		
		$plain = implode('&', $array);
		
		// Encrypt.
		$crypt = $this->encrypt($plain);
		
		
		
		
		$order_id = $this->db->insert_id();
		
		?>
		
		<form action="<?php echo $this->get_endpoint(); ?>" method="post" id="gateway" name="gateway"> 
			<input type="hidden" name="navigate" value="">
			<input type="hidden" name="VPSProtocol" value="2.23">
			<input type="hidden" name="TxType" value="PAYMENT">
			<input type="hidden" name="Vendor" value="<?php echo $this->sage_vendor_name; ?>">
			<input type="hidden" name="Crypt" value="<?php echo $crypt; ?>">
			<label for="gateway_submit">Click this button if your browser fails to redirect you</label>
			<input type="submit" id="gateway_submit" name="gateway_submit" value="Proceed">
		</form>
		
		<script>
		document.getElementById('gateway').submit();
		</script>
		
		<?php
	}
	
	

	
	
	/**
	 * tokenize
	 *
	 * @param string $input 
	 * @param string $decrypt 
	 * @return array
	 */
	public function tokenize($input, $decrypt = false) {
		
		if($decrypt) {
			$input = $this->decrypt($input);
		}
		
		$tokens = array();
		$result = array();
		
		foreach($this->sage_valid_tokens as $n => $token) {
			if(false !== ($start = strpos($input, $token))) {
				$result[$n] = array('start' => $start, 'token' => $token);
			}
		}
		
		usort($result, function($a, $b) {
			
			if($a['start'] == $b['start']) {
				 return 0;
			}
			
			return $a['start'] > $b['start'] ? 1 : -1;
		});
		
		
		foreach($result as $n => $token) {
			
			$position = $token['start'] + strlen($token['token']) + 1;
			
			if($token == end($result)) {
				$tokens[$token['token']] = substr($input, $position);
			}
			else {
				$length = $result[$n+1]['start'] - $token['start'] - strlen($token['token']) - 2;
				$tokens[$token['token']] = substr($input, $position, $length);
			}
		}
		
		return $tokens;
	}
	

	/**
	 * build
	 *
	 * @param string $data 
	 * @param string $crypt 
	 * @return void
	 * @author Jon
	 */
	protected function build($data = null, $crypt = false) {
		
		$array = array();
		foreach(is_null($data) ? $this->raw : $data as $k => $v) {
			
			if(is_null($v)) {
				continue;
			}
			
			$array[] = $k . '=' . $v;
		}
		
		$built = implode('&', $array);
		if(false !== $crypt) {
			return $built;
		}
		
		// Encrypt.
		return $this->encrypt($built);
	}
	
	
	/**
	 * encrypt
	 *
	 * @param string $input 
	 * @return string
	 */
	protected function encrypt($input) {
		$encrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->sage_encryption_string, $this->pkcs5_pad($input), MCRYPT_MODE_CBC, $this->sage_encryption_string);
		return '@' . strtoupper(bin2hex($encrypt));
	}
	
	
	/**
	 * decrypt
	 *
	 * @param string $input 
	 * @return string
	 */
	protected function decrypt($input) {
		
		// Remove prefix
		if(substr($input, 0, 1) == '@') {
			$input = substr($input, 1);
		}
		
		$packed = pack('H*', $input);
		return $this->pkcs5_trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->sage_encryption_string, $packed, MCRYPT_MODE_CBC, $this->sage_encryption_string));
	}
	
	
	/**
	 * pkcs5_pad
	 *
	 * @return string
	 */
	protected function pkcs5_pad($input, $blocksize = 16) {
		
		$padchr = '';
		$length = max(0, $blocksize - (strlen($input) % $blocksize));
		for($i = 0; $i < $length; $i++) {
			$padchr .= chr($length);
		}
		
		return $input . $padchr;
	}
	
	
	/**
	 * pkcs5_trim
	 *
	 * @return string
	 */
	protected function pkcs5_trim($input) {
				
		$padchr = ord($input[strlen($input) - 1]);
		return substr($input, 0, -$padchr);
	}
}