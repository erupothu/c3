<?php

class Insight {
	
	private $ci;
	private $configuration;
	
	public function __construct($insight_configuration = array()) {

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