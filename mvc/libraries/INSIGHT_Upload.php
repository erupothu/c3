<?php

class INSIGHT_Upload extends CI_Upload {
	
	public function __construct($props = array()) {
		parent::__construct($props);
	}
	
	public function handle($file = null) {
		
		$function = !is_null($file) ? 'do_ajax' : 'do_upload';
		return $this->$function('qqfile', $file);
	}
	
	public function do_ajax($input_name, $file_name) {
		
		if(!$file_size = isset($_SERVER['CONTENT_LENGTH']) ? $_SERVER['CONTENT_LENGTH'] : false) {
			throw new Exception('Getting content length is not supported.');
		}
		
		if(!$this->validate_upload_path()) {
			return false;
		}
		
		// Set the uploaded data as class variables
		$this->orig_name	= $file_name;
		$this->file_name 	= preg_replace("/\s+/", "_", strtolower($this->_prep_filename($file_name)));
		$this->file_ext	 	= $this->get_extension($this->file_name);
		$this->file_path	= $this->upload_path . $this->file_name;
		$this->full_path 	= $this->upload_path . $this->file_name;
		$this->file_temp	= $this->full_path;
		$this->client_name 	= $this->file_name;
		
		
		$input = fopen('php://input', 'r');
		$temp = tmpfile();
		$size = stream_copy_to_stream($input, $temp);
		fclose($input);
		
		if($size != $file_size) {
			return false;
		}
		
		$this->file_size = round($file_size / 1024, 2);
		
		// Do not overwrite!
		if(false == $this->overwrite && file_exists($this->full_path)) {
			$this->file_name = $this->unique_filename($this->file_name, $this->upload_path);
			$this->full_path = $this->upload_path . $this->file_name;
		}
		
		if(!$target = fopen($this->full_path, 'w')) {
			$this->set_error('upload_unable_to_write_file');
			return false;
		}
		
		fseek($temp, 0, SEEK_SET);
		stream_copy_to_stream($temp, $target);
		fclose($target);
		
		$this->file_type = $this->mime($this->full_path);
		if(!$this->is_allowed_filetype()) {
			$this->set_error('upload_invalid_filetype');
			unlink($this->full_path);
			return false;
		}
		
		/*
		 * Set the finalized image dimensions
		 * This sets the image width/height (assuming the
		 * file was an image).  We use this information
		 * in the "data" function.
		 */
		$this->set_image_properties($this->full_path);
		
		return true;
	}
	
	public function mime($file_name) {
		
		if(class_exists('finfo')) {
			$file_info = new finfo(FILEINFO_MIME_TYPE);
			$file_type = $file_info->file($file_name);
		}
		else {
			$file_type = trim(exec('file --mime -b ' . $file_name));
		}
		
		return $file_type;
	}
	
	
	/**
	 * unique_filename
	 *
	 * @param string $file_name 
	 * @param string $file_path 
	 * @param string $starting_numeric 
	 * @return string
	 */
	public function unique_filename($file_name, $file_path, $starting_numeric = 2) {
		
		if(!file_exists($file_path . $file_name)) {
			return $file_path;
		}
		
		$extension = $this->get_extension($file_name);
		preg_match('/(.*?)-?(\d+)?' . preg_quote($extension, '/') . '/i', $file_name, $match);
		$numeric = isset($match[2]) ? $numeric : $starting_numeric;
		
		// Loop until we find a filename that has not already been used...
		while(file_exists($file_path . ($file_name = $match[1] . '-' . $numeric . $extension))) {
			$numeric++;
		}
		
		return $file_name;
	}
	
	public function get_errors() {
		return count($this->error_msg) == 0 ? false : $this->error_msg;
	}
}