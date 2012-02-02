<?php

require_once 'Gateway.php';

class Gateway_Sagepay extends INSIGHT_Gateway {

	private $sage_partner;				// sage partnership id	
	private $sage_vendor_name;			// sage vendor name
	private $sage_encryption_string;	// sage encryption string

	private $sage_valid_tokens = array(
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
	
	
	private $sage_endpoints = array(
		'LIVE'		=> 'https://live.sagepay.com/gateway/service/vspform-register.vsp',
		'TEST'		=> 'https://test.sagepay.com/gateway/service/vspform-register.vsp',
		'SIMULATOR'	=> 'https://test.sagepay.com/simulator/vspformgateway.asp'
	);
	
	
	public function __construct() {
		
		// temp stuff.
		$this->sage_vendor_name 		= 'technical9';
		$this->sage_encryption_string 	= 'g9hVBEtzkPa2wHp0';
		
		// temp data array.
		$this->test_data = array(
			'VendorTxCode'			=> 'X-anubis-test-' . time(),
			'Amount'				=> '199.99',
			'Currency'				=> 'GBP',
			'Description'			=> 'Anubis Ltd',
			'SuccessURL'			=> site_url(array(CI::$APP->router->fetch_module(), 'success')),
			'FailureURL'			=> site_url(array(CI::$APP->router->fetch_module(), 'failure')),
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
			'BillingCountry'		=> 'GB',
			'BillingState'			=> null,
			'BillingPhone'			=> '01213212828',
			
			'DeliverySurname'		=> 'Doe',
			'DeliveryFirstnames'	=> 'John',
			'DeliveryAddress1'		=> '31 Coleshill Street',
			'DeliveryAddress2'		=> 'Sutton Coldfield',
			'DeliveryCity'			=> 'Birmingham',
			'DeliveryPostCode'		=> 'B72 1SD',
			'DeliveryCountry'		=> 'GB',
			'DeliveryState'			=> null,
			'DeliveryPhone'			=> '01213212828',
			
			'Basket'				=> '4:Pioneer NSDV99 DVD-Surround Sound System:1:424.68:74.32:499.00:499.00:Donnie Darko Directors Cut:3:11.91:2.08:13.99:41.97:Finding Nemo:2:11.05:1.94:12.99:25.98:Delivery:---:---:---:---:4.9',
			'AllowGiftAid'			=> 0,
			'ApplyAVSCV2'			=> 0,
			'Apply3DSecure'			=> 0,
//			'BillingAgreement'		=> 0	// ONLY SET ON PAYPAL.
		);
	}

	public function test() {
		
		// TEMP GET CART ITEMS.
		$this->cart = Cart_Object::init();
		
		$lines = array();
		foreach($this->cart->contents(true) as $item) {
			$lines[] = sprintf('%s:%d:%s:%s:%s:%0.2f', $item->name(), $item->quantity(), $item->price(), '0.00', $item->price(), $item->total());
		}
		
		$this->test_data['Basket'] = sprintf('%d:%s', count($lines), implode(':', $lines));
		
		$array = array();
		foreach($this->test_data as $k => $v) {
			
			if(is_null($v))
				continue;
			
			$array[] = $k . '=' . $v;
		}
		
		$plain = implode('&', $array);
		
		// enc.
		$enc = $this->encrypt($plain);
		
		//echo $plain . '<br />';
		//echo $enc . '<br /><br />';
		
		$dec = $this->decrypt($enc);
		
		//echo $dec;
		
		?>
		
		<form action="https://test.sagepay.com/simulator/vspformgateway.asp" method="post" id="gateway" name="gateway"> 
			<input type="hidden" name="navigate" value="">
			<input type="hidden" name="VPSProtocol" value="2.23">
			<input type="hidden" name="TxType" value="PAYMENT">
			<input type="hidden" name="Vendor" value="<? echo $this->sage_vendor_name ?>">
			<input type="hidden" name="Crypt" value="<? echo $enc ?>">
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