<?php

class Address_Model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	
	public function create($user_id) {
		
		$address_date = new DateTime;
		$address_item = array(
			'address_user_id'		=> $user_id,
			'address_label'			=> $this->form_validation->value('address_label', null),
			'address_name'			=> $this->form_validation->value('address_name'),
			'address_line1'			=> $this->form_validation->value('address_line1'),
			'address_line2'			=> $this->form_validation->value('address_line2', null),
			'address_city'			=> $this->form_validation->value('address_city'),
			'address_state'			=> $this->form_validation->value('address_state'),
			'address_postcode'		=> $this->form_validation->value('address_postcode'),
			'address_country'		=> $this->form_validation->value('address_country'),
			'address_date_created'	=> $address_date->format('Y-m-d H:i:s')
		);
		
		$this->db->insert('address', $address_item);
		return $this->db->insert_id();
	}
	
	public function create_from_object(Address_Object $address, $user_id) {
		
		$address_date = new DateTime;
		$address_item = array(
			'address_user_id'		=> $user_id,
			'address_label'			=> $address->label(),
			'address_name'			=> $address->name(),
			'address_line1'			=> $address->line1(),
			'address_line2'			=> $address->line2(),
			'address_city'			=> $address->city(),
			'address_state'			=> $address->state(),
			'address_postcode'		=> $address->postcode(),
			'address_country'		=> $address->country(true),
			'address_date_created'	=> $address_date->format('Y-m-d H:i:s')
		);
		
		$this->db->insert('address', $address_item);
		return $this->db->insert_id();
	}
	
	public function retrieve($user_id = null) {
		
		$this->db->disable_escaping();
		$this->db->select('*');
		$this->db->from('address a');
		$this->db->where('a.address_user_id', $user_id);
		$this->db->order_by('IFNULL(a.address_date_updated, a.address_date_created) desc');
		$address_result = $this->db->get();
		
		return $address_result->result('Address_Object');
	}
	
	public function update() {
		
	}
	
	public function delete($address_id) {
		
		$this->db->where('address_id', $address_id);
		$delete_result = $this->db->delete('address');
		
		return $this->db->affected_rows() === 1;
	}
	
	public function retrieve_by_id($address_id) {

		$this->db->select('*');
		$this->db->from('address a');
		$this->db->where('a.address_id', $address_id);
		$address_result = $this->db->get();
		
		return $address_result->row(0, 'Address_Object');
	}
	
}

class Address_Object {
	
	static public function create($data, $key = 'address') {
		
		if(is_object($data)) {
			$data = get_object_vars($data);
		}
		
		$address = new self;
		foreach(array('name', 'line1', 'line2', 'city', 'state', 'postcode', 'country', 'phone', 'address1', 'address2') as $field) {
			
			$element = $key . '_' . $field;
			
			// Some tables may have special names.
			if(in_array($field, array('address1', 'address2')) && array_key_exists($element, $data)) {
				$remapped = 'address_line' . substr($field, -1);
			}
			else {
				$remapped = 'address_' . $field;	
			}

			$address->$remapped = isset($data[$element]) ? $data[$element] : null;
		}
		
		if(count(get_object_vars($address)) == 0)
			die('bad data');
		
		return $address;		
	}
	
	public function id() {
		return (int)$this->address_id;
	}
	
	public function label() {
		return $this->address_label;
	}
	
	public function name() {
		return $this->address_name;
	}

	public function line1() {
		return $this->address_line1;
	}
	
	public function line2() {
		return $this->address_line2;
	}
	
	public function city() {
		return $this->address_city;
	}
	
	public function state() {
		return $this->address_state;
	}
	
	public function postcode() {
		return $this->address_postcode;
	}
	
	public function country($iso_code = true) {

		CI::$APP->load->config('countries', true);
		$configuration = CI::$APP->config->item('countries');

		if(!$iso_code && isset($configuration['alpha-' . strlen($this->address_country)]['countries'][$this->address_country]))
			return $configuration['alpha-' . strlen($this->address_country)]['countries'][$this->address_country];
		
		return $this->address_country;
	}
	
	// @TODO
	public function phone() {
		return '';
	}
	
	public function __toString() {

		$parts = array(sprintf('<span class="address_name">%s</span>', $this->name()), $this->line1(), $this->line2(), $this->city(), $this->state(), $this->postcode(), $this->country(false));
		$address = implode('<br />', array_filter($parts, function($part) { return !empty($part); }));

		return $address;
	}
}