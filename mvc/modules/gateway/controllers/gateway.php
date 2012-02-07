<?php

class Gateway extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		// Load Gateway.
		$gateway_class = sprintf('%2$sGateway_%1$s', ucfirst(CI::$APP->insight->config('user/gateway/gateway_class')), $this->router->fetch_module() == 'gateway' ? '' : 'gateway/');
		$this->load->library($gateway_class, CI::$APP->insight->config('user/gateway'), 'gateway');
	}
	
	public function index() {
		$this->load->module('cart');
		$this->gateway->test();
	}
	
	
	
	public function process() {

		$crypt	= $this->input->get('crypt');
		$hash	= sha1($crypt);
		$data	= $this->gateway->tokenize($crypt, true);
		
		// find the transaction
		$this->db->select('*');
		$this->db->from('transaction t');
		$this->db->where('t.transaction_code', $data['VendorTxCode']);
		$transaction_result = $this->db->get();
		if($transaction_result->num_rows() !== 1) {
			die('Could not find transaction');
		}
		
		$transaction = $transaction_result->row();
		if($transaction->transaction_status !== 'pending') {
			
			var_dump($transaction);
			var_dump($data);
			
			die('Transaction has been set as: ' . $transaction->transaction_status . '!  Cannot proceed');
		}
		
		/*
		OK – Transaction completed successfully with authorisation. 

		NOTAUTHED – The Sage Pay system could not authorise the 
		transaction because the details provided by the Customer 
		were incorrect, or insufficient funds were available. 

		MALFORMED – Input message was missing fields or badly 
		formatted – normally will only occur during development and 
		vendor integration.  

		INVALID – Transaction was not registered because although 
		the POST format was valid, some information supplied was 
		invalid. e.g. incorrect vendor name or currency. 

		ABORT – The Transaction could not be completed because 
		the user clicked the CANCEL button on the payment pages, or 
		went inactive for 15 minutes or longer. 

		REJECTED – The Sage Pay System rejected the transaction 
		because of the fraud screening rules you have set on your 
		account. 

		AUTHENTICATED – The 3D-Secure checks were performed 
		successfully and the card details secured at Sage Pay. 

		REGISTERED – 3D-Secure checks failed or were not 
		performed, but the card details are still secured at Sage Pay. 

		ERROR – A problem occurred at Sage Pay which prevented 
		transaction completion. 
		In the case of NOTAUTHED, the Transaction has 
		completed through the Sage Pay System, but it has not 
		been authorised by the bank. 

		A status of REJECTED means the bank may have 
		authorised the transaction but your own rule bases for 
		AVS/CV2 or 3D-Secure caused the transaction to be 
		rejected. 

		In the cases of ABORT, MALFORMED, INVALID and 
		ERROR (see below) the Transaction has not completed 
		through Sage Pay and can be retried. 

		AUTHENTICATED and REGISTERED statuses are only 
		returned if the TxType is AUTHENTICATE. 

		Please notify Sage Pay if a Status report of ERROR is seen, 
		together with your VendorTxCode and the StatusDetail 
		text.
		*/
		
		
		
		// Move to transaction model.
		$this->db->update('transaction', array(
			'transaction_status' 			=> $data['Status'] == 'OK' ? 'success' : 'failure',
			'transaction_amount'			=> $data['Amount'],
			'transaction_match_cv2'			=> $data['CV2Result'],
			'transaction_match_address'		=> $data['AddressResult'],
			'transaction_match_postcode'	=> $data['PostCodeResult'],
			'transaction_3dsecure_status'	=> $data['3DSecureStatus'],
			'transaction_3dsecure_cavv'		=> isset($data['CAVV']) ? $data['CAVV'] : null,
			'transaction_card_type'			=> $data['CardType'],
			'transaction_card_ending'		=> $data['Last4Digits'],
			'transaction_gateway_status'	=> $data['Status'],
			'transaction_gateway_details'	=> $data['StatusDetail']
		), array('transaction_id' => $transaction->transaction_id));
		
		
		// Forward.
		redirect('cart');
	}
	
	
	/**
	 * output
	 *
	 * @param string $view 
	 * @param string $data 
	 * @return void
	 */
	public function output($view, $data = array()) {
		$this->load->view($view, $data);
	}
}