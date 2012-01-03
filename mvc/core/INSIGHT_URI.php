<?php

class INSIGHT_URI extends CI_URI {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function uri_string() {
		return substr($this->uri_string, 0, 1) !== '/' && strlen($this->uri_string) > 1 ? '/' . $this->uri_string : '';
	}
	
	public function skin($path = null, $folder = null) {

		$skin_path = DIRECTORY_SEPARATOR . (is_null($folder) ? get_instance()->load->skin() : 'skins/' . $folder);
		if(is_null($path))
			return $skin_path;
		
		return $skin_path . (substr($path, 0, 1) == '/' ? $path : '/' . $path);
	}
}