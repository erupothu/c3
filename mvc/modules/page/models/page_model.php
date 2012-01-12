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
	
	//public function retrieve_by_id($page_id) {
	//	return $this->load($page_id, 'page_id', true);
	//}

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
	
	/*
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
	*/
	
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
	

	public function delete($page_id) {
		
		// Get the core item & delete it.
		$page = $this->retrieve_by_id($page_id);
		$this->db->where('page_left between ' . $page->tree_left() . ' and ' . $page->tree_right());
		$this->db->delete('page');
		
		// Store the deleted items for flash message.
		$deleted_items = $this->db->affected_rows();
		
		// Right
		$this->db->set('page_right', 'page_right - ' . $page->tree_width(), false);
		$this->db->where('page_right > ' . $page->tree_right());
		$this->db->update('page');
		
		// Left
		$this->db->set('page_left', 'page_left - ' . $page->tree_width(), false);
		$this->db->where('page_left > ' . $page->tree_right());
		$this->db->update('page');

		// Write the flash message.
		$this->session->set_flashdata('admin/message', sprintf('Deleted %d pages', $deleted_items));
		
		return $deleted_items === 0 ? false : $deleted_items;
	}
	
	
	
	public function retrieve_by_id($item_id) {

		$this->db->select('*');
		$this->db->select('
		ifnull((
			select pp.page_id
				from page pp
					where pp.page_left < pn.page_left AND pp.page_right > pn.page_right
				order by
					pp.page_right asc
				limit 1
		), 0) as page_parent_id', false);
		$this->db->from('page pn');
		$this->db->where('pn.page_id', $item_id);

		$page_result = $this->db->get();
		
		if($page_result->num_rows() !== 1) {
			return false;
		}
		
		return $page_result->row(0, 'Page_Object');
	}
	
	
	public function retrieve_nested() {
		
		$this->db->select('pn.page_id');
		$this->db->select('pn.page_name');
		$this->db->select('pn.page_slug');
		$this->db->select('pn.page_date_created');
		$this->db->select('pn.page_date_updated');
		$this->db->select('count(pp.page_id) - 1 as page_depth');
		//$this->db->select('pp.page_id as page_parent_id');

		$this->db->from('page pp');
		$this->db->from('page pn');
		
		$this->db->where('(pn.page_left between pp.page_left and pp.page_right)');
		$this->db->group_by('pn.page_id');
		$this->db->order_by('pn.page_left');
		$page_result = $this->db->get();

        $page_objects = $page_result->result('Nested_Page_Object');
		
		// Built a tree out of Page Objects
		return $this->build_tree($page_objects);
	}
	
	
	private function build_tree($data) {
		
		$depths = array();
		$pointer = array();
		$_depth = 0;
		
		$tree = &$pointer;
		
		foreach($data as $_key => $page) {
			
			if($page->depth() < $_depth && $page->depth() !== 0) {
				$tree = &$depths[$page->depth()-1]->children;
			}
			elseif($page->depth() > $_depth) {
				$tree = &$depths[$_depth]->children;
			}
			elseif($page->depth() == 0) {
				$tree = &$pointer;
			}
			
			$tree[$page->id()] 	= $page;
			$_depth 			= $page->depth();
			$depths[$_depth] 	= &$tree[$page->id()];
		}

		return $pointer;
	}
}

class Page_Object {
	
	const LINK_FRONT = 0x001;
	const LINK_PREVIEW = 0x002;
	const LINK_ADMIN_UPDATE = 0x004;
	const LINK_ADMIN_DELETE = 0x008;
	
	public $page_id;
	public $page_name;
	public $page_parent_id;
	public $page_depth;
	
	public function id() {
		return (int)$this->page_id;
	}
	
	public function depth() {
		return (int)$this->page_depth;
	}
	
	public function title() {
		return $this->page_name;
	}
	
	public function parent() {
		//return $this->page_parent_id == $this->page_id ? null : (int)$this->page_parent_id;
		return (int)$this->page_parent_id;
	}
	
	
	// Tree methods.
	public function tree_left() {
		return (int)$this->page_left;
	}
	
	public function tree_right() {
		return (int)$this->page_right;
	}
	
	public function tree_width() {
		return ($this->tree_right() - $this->tree_left()) + 1;
	}
	
	
	public function created($format = 'd/m/Y H:i') {
		$dt = DateTime::createFromFormat('Y-m-d H:i:s', $this->page_date_created);
		return false !== $format ? $dt->format($format) : $dt;
	}
	
	public function updated($format = 'd/m/Y H:i') {
		
		if(is_null($this->page_date_updated))
			return $this->created($format);
		
		$dt = DateTime::createFromFormat('Y-m-d H:i:s', $this->page_date_updated);
		return false !== $format ? $dt->format($format) : $dt;
	}
	
	public function link($type = self::LINK_FRONT) {
		
		switch($type) {
			case self::LINK_ADMIN_UPDATE: {
				$link = site_url('admin/page/update/' . $this->id());
				break;
			}
			case self::LINK_ADMIN_DELETE: {
				$link = site_url('admin/page/delete/' . $this->id());
				break;
			}
			case self::LINK_FRONT:
			default: {
				$link = site_url($this->page_slug);
			}
		}
		
		return $link;
	}
	
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

class Nested_Page_Object extends Page_Object implements Iterator, Countable {
	
	public $children = array();
	
	private $pointers = array();
	private $position = 0;

	public function addChild(Nested_Page_Object $page) {
		$this->children[$page->id()] = $page;
		$this->pointers[] = $page->id();
	}
	
	public function addChildren($children) {
		foreach($children as $child) {
			$this->addChild($child);
		}
	}
	

	
	
	// Iterator methods.
	public function hasChildren() {
		return count($this->children) > 0;
	}
	
	public function getChildren() {
		return $this->children;
	}

	public function next() {
		$this->position++;
	}
	
	public function current() {
		return $this->children[$this->pointers[$this->position]];
	}
	
	public function rewind() {
		$this->position = 0;
	}
	
	public function key() {
		return $this->position;
	}
	
	public function valid() {
		return isset($this->pointers[$this->position]);
	}
	
	
	// Countable methods
	public function count() {
		return count($this->children);
	}
}