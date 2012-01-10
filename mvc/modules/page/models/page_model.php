<?php

class Page_Model extends NestedSet_Model {
	
	private $current_slug;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function load($page_identifier, $page_column = 'page_slug', $allow_deleted = false) {
		
		//$this->output->enable_profiler(false);
		switch($page_column) {
			case 'page_id': {
				break;
			}
			case 'page_slug': {
				
				// Check for initial slash.
				if(strlen($page_identifier) === 0 || substr($page_identifier, 0, 1) !== '/') {
					$page_identifier = '/' . $page_identifier;
				}
				
				break;
			}
		}
		
		$this->db->select('*');
		$this->db->from('page p');
		$this->db->where('p.' . $page_column, $page_identifier);
		if(!$allow_deleted) {
			$this->db->where_not_in('p.page_status', array('deleted'));
		}
		
		$page_result = $this->db->get();
		if($page_result->num_rows() !== 1) {
			return false;
		}
		
		/*
		$page_data = $page_result->row_array();
		$this->current_slug = $page_data['page_slug'];
		
		if(class_exists('Tidy')) {
			$tidy = new Tidy;
			$page_data['page_content'] = $tidy->repairString($page_data['page_content'], array(
				'clean' 			=> true,
				'indent' 			=> true,
				'indent-spaces' 	=> 4,
				'drop-empty-paras' 	=> true,
				'show-body-only'	=> true
			), 'UTF8');
		}
		*/
		
		$page = $page_result->row(0, 'Page_Object');
		return $page;
	}

	public function get_slug() {
		return is_null($this->current_slug) ? false : $this->current_slug;
	}

	public function create() {
		
		$page_create = new DateTime;
		$page_insert = array(
			'page_author_id'	=> 1,
			'page_name'			=> $this->form_validation->value('page_name', '', false),
			'page_slug'			=> $this->form_validation->value('page_slug'),
			'page_content'		=> $this->form_validation->value('page_content', null, false),
			'page_status'		=> $this->form_validation->value('page_status'),
			'page_left'			=> 0,
			'page_right'		=> 0,
			'page_date_created'	=> $page_create->format('Y-m-d H:i:s')
		);
		
		$this->db->insert('page', $page_insert);
		
		// Flash Message
		$this->session->set_flashdata('admin/message', sprintf('Page entitled "%s" has been created', $this->form_validation->value('page_name')));
		
		// Return the insert ID.
		return $this->db->insert_id();
	}
	
	public function retrieve() {
		
		$pages = array();
		$this->db->select('p.*');
		$this->db->disable_escaping();
		$this->db->select('length(p.page_content) as page_length');
		$this->db->select('trim(concat(a.user_firstname, " ", a.user_lastname)) as page_author', false);
		$this->db->select('ifnull(p.page_date_updated, p.page_date_created) as page_date_changed');
		$this->db->from('page p');
		$this->db->join('user a', 'p.page_author_id = a.user_id', 'left');
		$this->db->order_by("field(p.page_status, 'published', 'draft', 'deleted')");
		$this->db->order_by('page_date_created', 'desc');
		$page_result = $this->db->get();
		foreach($page_result->result() as $page) {
			$pages[$page->page_id] = $page;
			$pages[$page->page_id]->page_date_changed = new DateTime($page->page_date_changed);
		}
		
		return $pages;
	}
	
	public function update($page_id) {
		
		$page_update = new DateTime;
		$page_change = array(
			'page_author_id'	=> 1,
			'page_name'			=> $this->form_validation->value('page_name', '', false),
			'page_slug'			=> $this->form_validation->value('page_slug'),
			'page_content'		=> $this->form_validation->value('page_content', null, false),
			'page_status'		=> $this->form_validation->value('page_status'),
			'page_left'			=> 0,
			'page_right'		=> 0,
			'page_date_updated'	=> $page_update->format('Y-m-d H:i:s')
		);
		
		$this->db->update('page', $page_change, array('page_id' => $page_id));
		
		// Flash Message
		$this->session->set_flashdata('admin/message', sprintf('Page entitled "%s" has been updated', $this->form_validation->value('page_name')));
		
		// Return the insert ID.
		return $this->db->affected_rows() === 1;
	}
	
	public function delete($page_id) {
		
		// Check that the page exists.
		if(!$page = $this->load($page_id, 'page_id')) {
			return false;
		}
		
		// Mark the page as deleted
		$this->session->set_flashdata('admin/message', sprintf('Page entitled "%s" has been deleted', $page['page_name']));
		$this->db->update('page', array('page_status' => 'deleted'), array('page_id' => $page_id));
		
		return $this->db->affected_rows() === 1;
	}
	
	public function purge() {
		
		// Remove all 'deleted' pages permanently
		$this->db->delete('page', array('page_status' => 'deleted'));
		$deleted_pages = $this->db->affected_rows();

		$this->session->set_flashdata('admin/message', sprintf('%d page%s have been purged.', $deleted_pages, $deleted_pages == 1 ? '' : 's'));		
		return $deleted_pages;
	}
	
	public function sitemap() {
		
		$sitemap_data = array();
		foreach($this->retrieve() as $page) {
			
			if(!in_array($page->page_status, array('published')))
				continue;
			
			$sitemap_data[$page->page_slug] = $page->page_name;
		}
		
		return $sitemap_data;
	}
}


class NestedSet_Model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	
	public function retrieve_nested() {
		
		$this->db->select('pn.page_id');
		$this->db->select('pn.page_name');
		$this->db->select('pp.page_id as page_parent_id');
		$this->db->select('count(pp.page_id) - 1 as page_depth');
		$this->db->select('group_concat(pp.page_id order by pp.page_left) as page_breadcrumb');
		$this->db->from('page pn');
		$this->db->from('page pp');
		$this->db->where('pn.page_left between pp.page_left and pp.page_right');
		$this->db->group_by('pn.page_id');
		$this->db->order_by('pn.page_left');
		$page_result = $this->db->get();
		
		return $this->build_nested($page_result->result());
		/*
		SELECT node.name 
		FROM nested_category AS node,
		nested_category AS parent
		WHERE node.lft BETWEEN parent.lft AND parent.rgt AND parent.name = 'ELECTRONICS' ORDER BY node.lft;
		*/
	}
	
	
	
	
	private function build_nested($data, &$built = array()) {
		
		foreach($data as $row) {
			var_dump($row);
			// Add to the built array.
			$built[$row->page_id] = $row;
		}
		
		return $built;
	}
}

class Page_Object {
	
	public function content($cleaned = true) {
		
		if(!$cleaned) {
			return $this->page_content;
		}
		
		if(!extension_loaded('Tidy')) {
			throw new INSIGHT_Exception('This feature is not available without the tidy library.');
		}
		
		$tidy = new Tidy;
		return $tidy->repairString($this->page_content, array(
			'clean' 			=> true,
			'indent' 			=> true,
			'indent-spaces' 	=> 4,
			'drop-empty-paras' 	=> true,
			'show-body-only'	=> true
		));
	}
}