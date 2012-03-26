<?php

class Admin extends INSIGHT_Admin_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('image_model', 'image');
		$this->load->model('gallery_model', 'gallery');
	}
	
	
	public function index() {
		
		$this->load->view('admin/gallery/index.view.php', array(
			'galleries'	=> $this->gallery->retrieve()
		));
		
		$this->load->library('upload');
		$this->upload->unique_filename('abbey.jpg', '/var/www/vhosts/highclare/www/uploads/');
	}
	
	
	public function index_gallery() {
		
	} // ??
	
	public function create_gallery() {
		
		if($this->form_validation->run('admin-image-gallery-form')) {
			
			$gallery_id = $this->gallery->create();
			
			// Link Resources.
			if(false !== $this->input->post('resource_link')) {
				$resource_call = sprintf('%s/resource/link', $this->input->post('resource_link', true));
				Modules::run($resource_call, 'gallery', $gallery_id, preg_split('/,/', $this->input->post('resource_data', true), -1, PREG_SPLIT_NO_EMPTY));
			}
			
			return redirect('admin/image');
		}
		
		$this->load->view('admin/gallery/create.view.php');
	}
	
	
	public function update_gallery($gallery_id) {
		
		if($this->form_validation->run('admin-image-gallery-form')) {
			
			// Update Gallery
			$this->gallery->update($gallery_id);
			
			// Link Resources.
			if(false !== $this->input->post('resource_link')) {
				$resource_call = sprintf('%s/resource/link', $this->input->post('resource_link', true));
				Modules::run($resource_call, 'gallery', $gallery_id, preg_split('/,/', $this->input->post('resource_data', true), -1, PREG_SPLIT_NO_EMPTY));
			}
			
			return redirect('admin/image');
		}
		
		$this->load->view('admin/gallery/update.view.php', array(
			'gallery'	=> $this->gallery->retrieve_by_id($gallery_id)
		));
	}
	
	public function delete_gallery($gallery_id) {
		
		if(!$this->gallery->delete($gallery_id)) {
			show_error('Could not delete Image Gallery.');
		}
		
		return redirect('admin/image');
	}
	
	
	
	/**
	 * upload
	 *
	 * @access public
	 * @param string $filename 
	 * @param string $upload_key 
	 */
	public function upload($filename = null, $upload_key = null) {
		
		$this->load->library('upload', $upload_config = array(
			'upload_path'	=> 'uploads',
			'allowed_types'	=> 'jpg',
			'overwrite'		=> false
		));
		
		$upload_data = array();
		if(false !== ($status = $this->upload->handle($filename))) {
			
			// Grab the raw upload.
			$upload_data = $this->upload->data();
			
			$max_width 		= 1024;
			$max_height 	= 684;
			$thumb_width 	= 300;
			
			//$thumb_height 	= '';
			
			$thumbnail_arg = "-thumbnail '" . $thumb_width . ">' -gravity center";
			$all_arguments = sprintf('-resize %dx%d\>', $max_width, $max_height);
			$command_magic = sprintf('mogrify %s %s', $all_arguments, $upload_data['full_path']);
			
			$output = null;
			exec($command_magic, $output);
			
			$image_details = getimagesize($upload_data['full_path']);
			$image_size_kb = round(filesize($upload_data['full_path']) / 1024, 2);
			
			// insert.
			// @TODO move to model
			$upload_date = new DateTime;
			$upload_load = array(
				'image_name'			=> $upload_data['file_name'],
				'image_path'			=> sprintf('/%s/%s', $upload_config['upload_path'], $upload_data['file_name']),
				'image_alt'				=> ucwords(urldecode(pathinfo($upload_data['orig_name'], PATHINFO_FILENAME))),
				'image_width'			=> $image_details[0],
				'image_height'			=> $image_details[1],
				'image_size'			=> $image_size_kb,
				'image_type'			=> 'ORIGINAL',
				'image_date_created'	=> $upload_date->format('Y-m-d H:i:s')
			);
			
			$this->db->insert('image', $upload_load);
			$image_id = $this->db->insert_id();
		}
		
		$return = array(
			'success'	=> $status,
			'error'		=> $this->upload->get_errors(),
			'data'		=> $upload_load,
			'raw'		=> $upload_data,
			'db_id'		=> $image_id
		);
		
		echo json_encode($return);
	}
	
	public function retrieve() {
		
	}
	
	public function update() {
		
	}
	
	public function delete($image_id, $resource_type = null, $resource_id = null, $ajax_call = false) {
		
		// Delete any image resource links.
		if(!is_null($resource_type) && !is_null($resource_id)) {
			$this->db->from('image_link');
			$this->db->where('link_image_id', $image_id);
			$this->db->where('link_resource_id', $resource_id);
			$this->db->where('link_resource_type', $resource_type);
			$this->db->delete();
		}
		
		// Only delete this image if there are no links to it remaining.
		$this->db->select('count(il.link_resource_id) as count');
		$this->db->from('image_link il');
		$this->db->where('il.link_image_id', $image_id);
		$resource_result = $this->db->get();
		$resource_unlink = $resource_result->row('count') == 0;
		
		if($resource_unlink) {
			$this->image->delete($image_id, true);
		}
		
		if($ajax_call) {
			echo json_encode(array(
				'success'	=> true
			));
		}
	}
	
	
	public function crop($image_id) {
		
		if($this->form_validation->run('admin-image-crop')) {
			
			// Get image
			// @TODO Model
			$this->db->select('*');
			$this->db->from('image i');
			$this->db->where('i.image_id', $image_id);
			$image_result = $this->db->get();
			$image = $image_result->row_array();
			
			// Check for Crop.
			$crop_argument = '';
			if(is_numeric($this->form_validation->value('w')) && is_numeric($this->form_validation->value('h'))) {
				
				$crop_argument = sprintf(' -crop %1$dx%2$d+%3$d+%4$d\!',
					$this->form_validation->value('w'),
					$this->form_validation->value('h'),
					$this->form_validation->value('x'),
					$this->form_validation->value('y')
				);
			}
			
			$thumb_width = 300;
			
			
			$thumbnailname = substr_replace($image['image_name'], '.thumbnail', strrpos($image['image_name'], '.'), 0);
			$path_raw_part = 'uploads/' . $thumbnailname;
			$path_sys_safe = FCPATH . $path_raw_part;
			$path_web_safe = '/' . $path_raw_part;
			$thumbnail_arg = "-thumbnail '" . $thumb_width . "x>' -gravity center";
			$all_arguments = '-auto-orient' . $crop_argument . ' +repage ' . $thumbnail_arg . ' -strip';
			$command_magic = sprintf('convert %s %s %s', FCPATH . substr($image['image_path'], 1), $all_arguments, $path_sys_safe);
			
			$output = null;
			exec($command_magic, $output);
			
			// Save the image.
			$image_size = getimagesize($path_sys_safe);
			$image_file = round(filesize($path_sys_safe) / 1024, 2);
			$image_date = new DateTime;
			$this->db->insert('image', array(
				'image_name'			=> $thumbnailname,
				'image_parent_id'		=> $image_id,
				'image_path'			=> $path_web_safe,
				'image_alt'				=> null,
				'image_width'			=> $image_size[0],
				'image_height'			=> $image_size[1],
				'image_size'			=> $image_file,
				'image_type'			=> 'THUMBNAIL',
				'image_date_created'	=> $image_date->format('Y-m-d H:i:s')
			));
			
			$child_id = $this->db->insert_id();
			
			echo json_encode(
				array(
					'success'	=> true,
					'crop_path'	=> $path_raw_part,
					'command'	=> $command_magic,
					'output'	=> $output,
					'parent_id'	=> $image_id,
					'child_id'	=> $child_id,
					'coords'	=> array(
						'w'			=> $this->form_validation->value('w'),
						'h'			=> $this->form_validation->value('h'),
						'x'			=> $this->form_validation->value('x'),
						'y'			=> $this->form_validation->value('y')
					)
				)
			);
		}
	}
}