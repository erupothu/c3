<?php

class INSIGHT_Loader extends CI_Loader {
	
	const INSIGHT_SKIN_FOLDER = 'skins';
	
	private $_ci_skin = false;
	private $_ci_skin_path = '';
	
	public function __construct() {
		parent::__construct();
	}
	
	public function skin($skin = null, $folder = null) {
		
		if(is_null($skin))
			return $this->_ci_skin_path;
		
		// Set the current skin.
		$this->_ci_skin = $skin;
		$this->_ci_skin_path = self::INSIGHT_SKIN_FOLDER . DIRECTORY_SEPARATOR . $this->_ci_skin;
		
		// Set the path to the skin folder.
		$this->_ci_view_paths[$this->_ci_skin_path . DIRECTORY_SEPARATOR . (is_null($folder) ? 'views' : $folder) . DIRECTORY_SEPARATOR] = true;
	}
	
	/**
	 * Database Loader
	 *
	 * @access	public
	 * @param	string		the DB credentials
	 * @param	bool		whether to return the DB object
	 * @param	bool		whether to enable active record (this allows us to override the config setting)
	 * @return 	object
	 */
	public function database($params = '', $return = false, $active_record = null) {
		
		// Do we even need to load the database class?
		if(class_exists('CI_DB') && $return == false && is_null($active_record))
			return false;
		
		require_once(BASEPATH . 'database/DB' . EXT);
		
		// Load the DB class
		$db = &DB($params, $active_record);
		
		$my_driver = config_item('subclass_prefix') . 'DB_' . $db->dbdriver . '_driver';
		$my_driver_file = APPPATH . 'core/' . $my_driver . EXT;
		
		if(file_exists($my_driver_file)) {
		    require_once $my_driver_file;
		    $db = new $my_driver(get_object_vars($db));
		}
		
		if($return === true) {
		    return $db;
		}
		
		// Grab the super object
		$CI =& get_instance();
		
		// Initialize the db variable.  Needed to prevent
		// reference errors with some configurations
		$CI->db = '';
		$CI->db = $db;
	}
	
	public function get_loaded_models() {
		return $this->_ci_models;
	}
	
	public function get_loaded_libraries() {
		return $this->_ci_classes;
	}
}