<?php

//require_once 'INSIGHT_Format.php';

class INSIGHT_Form_Validation extends CI_Form_Validation {
	
	// CI
	public $CI;
	
	// Error HTML
	public $_error_start 	= '<ul class="validation-errors">';
	public $_error_finish 	= '</ul>';
	public $_error_prefix 	= '<li>';
	public $_error_suffix 	= '</li>';
	
	// Arrays for storing positions in validation arrays. [!]
	public $_error_points	= array();
	public $_field_points	= array();
	
	// Formatter.
	private $formatter;

	
	/**
	 * __construct
	 *
	 * @param array $rules 
	 */
	public function __construct($rules = array()) {
		parent::__construct($rules);
		//$this->formatter = new INSIGHT_Format;
	}
	
	
	public function set_value($field = '', $default = '') {
		
		if(!isset($this->_field_data[$field]) || (is_null($this->_field_data[$field]['postdata']) || ($this->_field_data[$field]['is_array'] && empty($this->_field_data[$field]['postdata'])))) {
			return $default;
		}
		
		return $this->_field_data[$field]['postdata'];
	}
	
	
	public function all_values() {
		
		$fields = array();
		foreach($this->_field_data as $field_name => $field_data) {
			$fields[$field_name] = $field_data['postdata'];
		}
		
		return $fields;
	}
	
	
	public function value($field, $default = '', $auto_encode = true) {
		
		$set_value = $this->set_value($field, $default);
		
		if(is_array($set_value)) {
		
			$return_values = $auto_encode ? array_map('htmlspecialchars', $set_value) : $set_value;
			
			if(!isset($this->_field_points[$field])) {
				$this->_field_points[$field] = 0;
			}

			// Get the applicable item, and then index.
			$selected_index = array_slice($return_values, $this->_field_points[$field], 1);
			$this->_field_points[$field]++;			
			
			// Use current() since it will return an array with 1 item.
			return current($selected_index);
		}
		
		if(is_null($set_value) || $auto_encode === false)
			return $set_value;
		
		return htmlspecialchars($set_value);
	}
	
	
	/**
	 * checked
	 * 
	 * @return string
	 */
	public function checked($field, $value = 'on', $default = false) {
		
		if(!isset($this->_field_data[$field]))
			return $default ? ' checked="checked"' : null;
			
		if($this->_field_data[$field]['postdata'] == $value)
			return ' checked="checked"';
		
		return null;
	}
	
	
	/**
	 * selected
	 * 
	 * @return string|null
	 */
	public function selected($field, $value, $default = false) {
		
		if(!isset($this->_field_data[$field])) {
			return $default == $value ? ' selected="selected"' : null;
		}
		
		if($this->_field_data[$field]['postdata'] == $value)
			return ' selected="selected"';
			
		return null;
	}
	
	
	public function earmark($field_name, $space_required = true) {
		
		if(!$this->has_error($field_name))
			return;
		
		echo ($space_required ? ' ' : '') . 'row-error';
	}
	
	/**
	 * errors
	 * 
	 * 
	 *
	 * @return string
	 * @author Jon E <jon@creativeinsight.co.uk>
	 **/
	public function errors() {
		
		if(count($this->_error_array) === 0)
			return false;
		
		$error_array = array($this->_error_start);
		foreach($this->_error_array as $error_string) {
			
			if(!is_string($error_string))
				continue;
			
			$error_array[] = sprintf('%s%s%s', $this->_error_prefix, trim($error_string), $this->_error_suffix);
		}
		$error_array[] = $this->_error_finish;		
		
		return implode("\n", $error_array);
	}
	

	public function add_error($message, $field = null, $highlight_only = false) {
		
		if(is_array($field)) {
			$highlight_flag = false;
			foreach($field as $field_element) {
				$this->add_error($message, $field_element, $highlight_flag);
				$highlight_flag = $highlight_only;
			}
			return;
		}
		
		$message = $highlight_only ? true : trim($message);
		
		if(!is_null($field)) {
			$this->{$field . '_error'} = $message;
			$this->_error_array[$field] = $message;
			return;
		}
		
		$this->_error_array[] = $message;
		return;
	}

	public function has_error($field) {

		if(is_array($field)) {

			$field_result = false;
			foreach($field as $field_name) {
				$field_result |= $this->has_error($field_name);
			}
			
			return $field_result;
		}
		
		return isset($this->_error_array[$field]) && !empty($this->_error_array[$field]);	
	}

	/**
	 * has_errors
	 * 
	 * Check to see if the Form_Validation class has found
	 * errors after the ->run method has been invoked.
	 *
	 * @return bool
	 * @author Jon E <jon@creativeinsight.co.uk>
	 **/
	public function has_errors() {
		return count($this->_error_array) > 0;
	}
	


	public function valid_slug($string, $table_info = '') {
		
		if(0 == preg_match('/^([a-z0-9\/][a-z0-9_\-\/]*)?$/', $string)) {
			$this->set_message(__function__, 'Please ensure you enter a valid slug (a-z, 0-9, forward slash, underscore and dashes are allowed)');
			return false;
		}
		
		return true;
	}
	
	
	public function valid_url($string) {
		
		if(0 == preg_match('/^(?#Protocol)(?:(?:ht|f)tp(?:s?)\:\/\/|~\/|\/)?(?#Username:Password)(?:\w+:\w+@)?(?#Subdomains)(?:(?:[-\w]+\.)+(?#TopLevel Domains)(?:com|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum|travel|[a-z]{2}))(?#Port)(?::[\d]{1,5})?(?#Directories)(?:(?:(?:\/(?:[-\w~!$+|.,=]|%[a-f\d]{2})+)+|\/)+|\?|#)?(?#Query)(?:(?:\?(?:[-\w~!$+|.,*:]|%[a-f\d{2}])+=?(?:[-\w~!$+|.,*:=]|%[a-f\d]{2})*)(?:&(?:[-\w~!$+|.,*:]|%[a-f\d{2}])+=?(?:[-\w~!$+|.,*:=]|%[a-f\d]{2})*)*)*(?#Anchor)(?:#(?:[-\w~!$+|.,*:=]|%[a-f\d]{2})*)?$/', $string)) {
			$this->set_message(__function__, 'The %s field must contain a valid URL');
			return false;
		}
		
		return true;
	}
	
	public function valid_date(&$string, $expected_format = 'Y-m-d') {
		
		$date = DateTime::createFromFormat($expected_format, $string);
		$errs = DateTime::getLastErrors();
		
		// DateTime will often 'repair' bad dates.
		$string = $date->format($expected_format);
		
		if($errs['warning_count'] + $errs['error_count'] > 0) {
			$this->set_message(__function__, '%s must be a valid date (' . $expected_format . ')');
			return false;			
		}
		
		return true;
	}
	
	
	public function cannot_match($string, $opposing_field) {

		if($string == $this->value($opposing_field, null, false)) {
			//$this->set_message(__function__, 'The %s field must not match the %s field');
			$this->set_message(__function__, $this->CI->lang->line(__function__));
			
			// Highlight both fields for clarity.
			$this->add_error(null, $opposing_field, true);
			
			return false;
		}
		
		return true;
	}
	

	public function get_rules($group = null) {
		
		if(is_null($group))
			return $this->_config_rules;
			
		return !isset($this->_config_rules[$group]) ? false : $this->_config_rules[$group];
	}
	
	public function checkbox_bit(&$checkbox_value, $checkbox_field) {
		return is_null($checkbox_value) ? 0 : 1;
	}

	public function required_checkbox($checkbox_value, $checkbox_field) {

		if(false === $checkbox_value || is_null($checkbox_value)) {
			$this->set_message(__function__, 'You must tick the "%s" checkbox in order to continue.');
			return false;
		}
		
		return true;
	}

	public function _execute($row, $rules, $postdata = null, $cycles = 0) {

		// @author jon
		// STUPID hack. Required to bypass line 484 of form_validation.php, a dumb
		// function that will bottom out unless we have a 'required' rule.  irritating.
		if(false !== stripos(is_array($rules) ? implode('|', $rules) : $rules, 'checkbox')) {
			$postdata = $row['postdata'] = true;
		}

		return parent::_execute($row, $rules, $postdata, $cycles);
	}
	
	
	public function module_callback($data, $args) {

		if(count($args = explode(',', $args)) < 1) {
			return true;
		}
		
		$model_name	= $this->CI->router->fetch_module();
		$function 	= array_shift($args);
		array_unshift($args, $data);
		
		// Gain access to the model.
		// This required the model to be in the format:
		// module_name/models/module_name_model.php
		// Yes, this is a little restrictive but keeps the form_validation rules neater.
		$this->CI->load->model(sprintf('%1$s/%1$s_model', $model_name), $model_name);
		
		if(!method_exists($this->CI->$model_name, $function)) {
			$this->set_message(__function__, 'Cannot validate %s (' . get_class($this->CI->$model_name) . '::' . $function . ' does not exist).');
			return false;
		}
		
		return call_user_func_array(array($this->CI->$model_name, $function), $args);
	}
	

	public function valid_password_strength($password_string) {
		
		if(!preg_match('/.*^(?=.{6,})(?=.*[a-z])(?=.*[0-9]).*$/', $password_string)) {
			$this->set_message(__function__, 'Please make a password that is 6 or more characters long and contains at least 1 number.');
			return false;
		}

		return true;
    }


	/**
	 * valid_captcha
	 *
	 * @param string $captcha_string 
	 * @return void
	 */
	public function valid_captcha($captcha_string) {
		
		// Ignore this if the CAPTCHAs are enabled
		if(false === $this->CI->insight->config('security/captcha_enabled'))
			return true;
		
		if(!class_exists('Session'))
			$this->CI->load->library('Session');
		
		$this->set_message(__function__, 'The %s has expired.  Please complete the form a little quicker!');
		if(!$captcha_origin = $this->CI->session->get('contact/captcha_time'))
			return false;
		
		// Check to see if the CAPTCHA has expired.
		$captcha_expiry = $this->CI->insight->config('security/captcha_expiry');
		$captcha_pause = floor(time() - $captcha_origin);
		if($captcha_pause > $captcha_expiry)
			return false;
		
		// Check for a string match!
		$this->set_message(__function__, 'The text in the %s field is incorrect. Please check that it matches the picture.');
		if(0 === strcasecmp($this->CI->session->get('contact/captcha_word'), $captcha_string))
			return true;
			
		return false;
	}
	
	public function unique($string, $table_data) {
		
		if(($comma_count = substr_count($table_data, ',')) < 1) {
			trigger_error('unique() expects two parameters within the validation array. ' . ($comma_count + 1) . ' given.', E_USER_NOTICE);
		}

		// Find the number of occurrences of this string within the table.
		list($database_table, $database_field) = explode(',', $table_data);
		$db = &get_instance()->db;
		$occurrences = $db->select('count(*) as occurrences')->from($database_table)->where($database_field, $string)->get()->row('occurrences');
		
		// Did we find this value?
		if($occurrences > 0) {
			$this->set_message(__function__, 'This %s has already been used. Please enter a different one.');
			return false;
		}
		
		return true;
	}
	
	public function exists($string, $table_data) {
	
		list($database_table, $database_field) = explode(',', $table_data);
		$occurrences = $this->db_count_occurrences($database_table, $database_field, $string);
		
		// Did we find this value?
		if($occurrences == 0) {
			$this->set_message(__function__, 'The %s you have specified cannot be found. Please check and try again.');
			return false;
		}
		
		return true;
	}
	
	public function format_sprintf(&$string, $format) {		
		return $string = sprintf($format, $string);
	}
	
	/*
	public function format(&$string, $method) {
		
		$possible_params = explode(',', $method);
		$object_method = array_shift($possible_params);
		if(!method_exists($this->formatter, $object_method)) {
			return $string;
		}
		
		// Add the string to the head.
		array_unshift($possible_params, $string);
		
		$string = call_user_func_array(array($this->formatter, $object_method), $possible_params);
		return $string;				
	}
	*/
	
	private function db_count_occurrences($database_table, $database_field, $database_string) {
		
		$database_occurrences = &get_instance()->db
			->select('count(*) as occurrences')
			->from($database_table)
			->where($database_field, $database_string)
			->get()
			->row('occurrences');
			
		return $database_occurrences;
	}
}