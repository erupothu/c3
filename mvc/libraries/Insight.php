<?php

class Insight {
	
	private $ci;
	private $configuration;
	
	public function __construct($insight_configuration = array()) {

		// Set Exception Handler
		set_exception_handler(array($this, 'error'));
		
		// Alter INI.
		ini_set('xdebug.var_display_max_depth', 4);
		ini_set('xdebug.var_display_max_children', 256);
		
		$this->ci = &get_instance();
		
		$this->configuration = $insight_configuration;
		
		// Load models, configurations, libraries.
		$this->ci->load->model('settings_model', 'settings');
		$this->ci->load->config('insight', true);
		$this->ci->load->library('Auth');

		// Load db configuration (i.e. user editable) and put into config.
		// be nice to memcache this query (since it rarely changes).
		$this->configuration = array_merge($this->configuration, array(
			'user' => $this->ci->settings->get()
		));
		
		// Check Uploads directory.
		if(file_exists('uploads') && is_writable('uploads')) {
		}
	}
	
	public function config($keystring = null, $encode = false) {

        if(is_null($keystring))
            return $this->configuration;

        $position =& $this->configuration;
        foreach(explode('/', trim($keystring)) as $key) {

            if(!isset($position[$key]))
                return false;

            $position =& $position[$key];
        }

        return $encode ? htmlentities($position, ENT_COMPAT, 'UTF-8') : $position;
	}
	
	
	public function modules() {
		
		$modules = array();
		
		foreach(Modules::$locations as $location => $_) {
			foreach(new DirectoryIterator($location) as $module_folder) {
				
				if($module_folder->isDot() || !$module_folder->isDir())
					continue;

				// Is this an administrable module?  Does it have an admin controller?
				if(file_exists($module_folder->getPathname() . DIRECTORY_SEPARATOR . 'controllers/admin' . EXT)) {
					$modules[$module_folder->getBasename()] = ucfirst($module_folder->getBasename());
				}
			}
		}

		return $modules;
	}
	
	static public function error($exception) {
		
		// clear the output buffer.
		
		// load up acceptable 'skin' to display error.
		
		// log exception correctly.
		
		// output (temporary).
		echo '<h4>Error:</h4>';
		die($exception->getMessage());
	}
	
	// TODO:
	// Think of a cool way of doing this...
	// lol?
	// @TODO
	public function hook($hook_name, $indent = 0) {
		
		echo "<!-- Hook: " . $hook_name . " -->\n";
		switch($hook_name) {
			
			case 'header': {
				
				if($this->config('user/seo_block_robots') == 1) {
					echo str_repeat("\t", $indent) . '<meta name="robots" content="noindex, nofollow">' . "\n";
				}
				
				break;
			}
			case 'footer': {
				break;
			}
		}
		echo str_repeat("\t", $indent) . "<!-- End of Hook -->\n";
	}
}

class INSIGHT_Exception extends Exception {
	
}