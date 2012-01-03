<?php

class LazyLoader {

	public function __construct() {
	}
	
	public function init() {
		spl_autoload_register(array($this, 'custom_controllers'));
	}
	
	public function custom_controllers($class) {
		if(!class_exists($class) && strpos($class, 'Controller') !== false) {
			include_once sprintf('%score/%s.php', APPPATH, $class);
		}
	}
}