<?php

class Image_Model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
}

class Image_Object {
	
	public function id() {
		return $this->image_id;
	}
	
	public function type() {
		return $this->image_type;
	}
	
	public function name() {
		return $this->image_name;
	}
	
	public function size() {
		return $this->image_size;
	}
	
	public function path() {
		return $this->image_path;
	}
	
	public function alt() {
		return $this->image_alt;
	}
	
	public function has_thumbnail() {
		return is_numeric($this->image_thumbnail_id);
	}
	
	public function is_thumbnail() {
		return !is_null($this->image_parent_id) && $this->type() == 'THUMBNAIL';
	}
	
	public function html() {
		//$this->image_thumbnail_path; //$this->image_path;
		
		if($this->has_thumbnail()) {
			$image = sprintf('<img src="%s" alt="%s">', $this->image_thumbnail_path, $this->alt());
			$image = sprintf('<a href="%2$s" class="image-lightbox" title="%3$s">%1$s</a>', $image, $this->image_path, $this->alt());
		}
		else {
			$image = sprintf('<img src="%s" alt="%s">', $this->path(), $this->alt());
		}
		
		return $image;
	}
}