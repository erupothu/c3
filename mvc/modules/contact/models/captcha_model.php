<?php

class CAPTCHA_Model extends CI_Model {
	
	// Time until CAPTCHA images are disposed of.
	protected $garbage_time = 1800;
	protected $garbage_prob = 50;
	
	protected $session_key = 'captcha';
	protected $data_folder = 'uploads/captcha';
	
	protected $configuration = array(
		'fonts'					=> array('arialbd.ttf', 'verabd.ttf', 'verdanab.ttf'),
		'font_path'				=> 'mvc/modules/contact/fonts',
		'font_size'				=> 14,
		'width'					=> 120,
		'height'				=> 30,
		'length'				=> 6,
		'interference'			=> 5,
		'characters'			=> 'ABCDEFGHJKLMNPQRSTUVWXYZ2345689',
		'characters_colours'	=> array('#41ad49', '#991a2e', '#c7ae97', '#42145d', '#333333', '#fabc04', '#4a4e57'),
		'interference_colors'	=> array('#cccccc', '#dddddd', '#eeeeee', '#666666', '#888888', '#aaaaaa', '#000000')
	);
	
	
	/**
	 * __construct
	 */
	public function __construct($configuration = array()) {
		
		parent::__construct();
		
		// Allow merge to overwrite values.
		$this->configuration = array_merge($this->configuration, $configuration);
		
		// Check permissions
		$this->check_permissions();
		
		// Run Garbage collection.
		$this->gc();
	}
	
	
	/**
	 * generate
	 * 
	 * Create a new CAPTCHA image and store some
	 * data about it within the currently active
	 * Session.
	 *
	 * @return void
	 */
	public function generate() {
		
		$code	 = '';
		$captcha = imagecreatetruecolor($this->configuration['width'], $this->configuration['height']);
		imagefilledrectangle($captcha, 0, 0, $this->configuration['width'] - 1, $this->configuration['height'] - 1, $this->hex2rgb('#ffffff'));
		
		// Draw interference lines
		for($line = 0; $line < $this->configuration['interference']; $line++) {
			imageline($captcha,
				rand(0, $this->configuration['width'] - 1),
				rand(0, $this->configuration['height'] - 1),
				rand(0, $this->configuration['width'] - 1),
				rand(0, $this->configuration['height'] - 1),
				$this->hex2rgb($this->configuration['interference_colors'][array_rand($this->configuration['interference_colors'])])
			);
		}
		
		// Draw text
		for($char = 0; $char < $this->configuration['length']; $char++) {
			
			// Get random angle, colour, character and font.
			$character_angle = ($char + 1) == $this->configuration['length'] ? rand(-10, 10) : rand(-30, 30);
			$character_color = $this->hex2rgb($this->configuration['characters_colours'][array_rand($this->configuration['characters_colours'])]);
			$character_value = substr($this->configuration['characters'], rand(0, strlen($this->configuration['characters']) - 1), 1);
			$character_font	 = sprintf('%s/%s', $this->configuration['font_path'], $this->configuration['fonts'][array_rand($this->configuration['fonts'])]);
			
			// Decide upon position of character.
			$y = ($this->configuration['height'] / 2) + ($this->configuration['font_size'] / 2);
			$x = (intval(($this->configuration['width'] / $this->configuration['length']) * $char) + ($this->configuration['font_size'] / 2));
			
			// Add character to image.
			imagettftext($captcha, $this->configuration['font_size'], $character_angle, $x, $y, $character_color, $character_font, $character_value);
			$code .= $character_value;
		}
		
		// Store image
		$file_unique = array_sum(array_map('floatval', explode(' ', microtime()))) * 10000;
		imagepng($captcha, $captcha_url = sprintf('uploads/captcha/%s.png', $file_unique));
		imagedestroy($captcha);
		
		// Store code
		$this->session->set($this->session_key, array(
			'path'	=> $captcha_url,
			'code'	=> $code
		));
		
		return $captcha_url;
	}
	
	
	public function retrieve() {
		return $this->session->get($this->session_key . '/path');
	}
	
	
	/**
	 * validate_captcha
	 *
	 * @param string $value 
	 * @return void
	 */
	public function validate_captcha($value) {
		
		if(0 !== strcasecmp($value, $this->session->get($this->session_key . '/code'))) {
			$this->form_validation->set_message('module_callback', 'Incorrect CAPTCHA: Try again');
			return false;
		}
		
		return true;
	}
	
	
	/**
	 * hex2rgb
	 * 
	 * Convert hex colours (e.g. #ffcc00) into their
	 * RGB counterparts.
	 *
	 * @param string $hex 
	 * @return string
	 */
	private function hex2rgb($hex) {
		return preg_match('/^#?([\dA-F]{6})$/i', $hex, $rgb) ? hexdec($rgb[1]) : false;
	}
	
	
	protected function check_permissions() {
		
		if(!is_dir($this->data_folder)) {
			if(!mkdir($this->data_folder)) {
				throw new INSIGHT_Exception('Cannot create "' . $this->data_folder . '" for CAPTCHA use.');
			}
		}
		
		if(!is_writable($this->data_folder)) {
			throw new INSIGHT_Exception('Cannot write to "' . $this->data_folder . '" for CAPTCHA use.');
		}
		
		return true;
	}
	
	
	/**
	 * gc
	 * 
	 * Garbage collection for old CAPTCHA images.  Runs
	 * after a specified number of seconds (TTL). 
	 *
	 * @param int|null $ttl
	 * @return void
	 * @author Jon
	 */
	protected function gc($ttl = null) {
		
		// Randomise if we should run the GC method at all.
		if(mt_rand(0, 100) < (100 - $this->garbage_prob)) {
			return false;
		}
		
		// Filter images out and unlink them.
		foreach(new ImageAgeFilter(new DirectoryIterator($this->data_folder), is_null($ttl) ? $this->garbage_time : $ttl) as $file) {
			unlink($file->getPathname());
		}
		
		return true;
	}
}

class ImageAgeFilter extends FilterIterator {
	
	// Timings.
	protected $gc_now;
	protected $gc_time = 3600;
	
	public function __construct(DirectoryIterator $iterator, $ttl = 3600) {
		
		parent::__construct($iterator);
		$this->gc_now = array_sum(array_map('floatval', explode(' ', microtime(true))));
		$this->gc_time = $ttl;
	}
	
	/**
	 * accept
	 *
	 * Filter files based upon their age using
	 * getCTime.  Age is set via property @see gc_time.
	 * 
	 * @access public
	 * @return boolean
	 */
	public function accept() {
		
		$file = $this->getInnerIterator()->current();
		
		// Ignore Directories.
		if($file->isDot() || $file->isDir()) {
			return false;
		}
		
		// Is this Image 'new' enough to escape the filter?
		if(round($this->gc_now - $file->getCTime()) < $this->gc_time) {
			return false;
		}
		
		return true;
	}
}