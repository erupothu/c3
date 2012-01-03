<?php

class Settings_Model extends CI_Model {
	
	private $settings = null;
	
	public function __construct() {
		
		parent::__construct();
		$this->get();
	}
	
	public function get($force = false) {
		
		if($force || is_null($this->settings)) {
			$this->load();
		}
		
		return $this->settings;
	}
	
	
	public function load() {
		
		$this->db->select('*');
		$this->db->from('setting');
		$this->db->order_by('setting_key asc');
		$setting_result = $this->db->get();
		foreach($setting_result->result_array() as $setting) {
			$this->settings[$setting['setting_key']] = $setting['setting_value'];
		}
		
		return $this->settings;
	}
	
	public function save() {
		
		$this->get();
		foreach($this->form_validation->all_values() as $setting_key => $setting_value) {
			$this->save_setting($setting_key, $setting_value);
		}
		
		// Flash Message
		$this->session->set_flashdata('admin/message', 'Settings have been updated');
		
		return $this->db->affected_rows() > 0;
	}
	
	private function save_setting($setting_key, $setting_value) {
		
		if(isset($this->settings[$setting_key])) {
			$operator = 'where';
			$function = 'update';
		}
		else {
			$operator = 'set';
			$function = 'insert';
		}

		$this->db->set('setting_value', $setting_value);		
		$this->db->$operator('setting_key', $setting_key);
		$this->db->$function('setting');
		
		return $this->db->affected_rows();
	}
}