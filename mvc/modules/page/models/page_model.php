<?php

class Page_Model extends NestedSet_Model {
	
	private $page_slugs_preslashed = true;
	
	public function __construct() {
		
		parent::__construct();
		self::install();
	}
	
	
	public function load($page_slug) {
		
		if($this->page_slugs_preslashed && (strlen($page_slug) === 0 || substr($page_slug, 0, 1) !== '/')) {
			$page_slug = '/' . $page_slug;
		}
		
		$this->db->select('pn.*');
		
		// @TODO
		// only if we are nesting...
		$this->db->select('
		ifnull((
			select pp.page_id
				from page pp
					where pp.page_left < pn.page_left AND pp.page_right > pn.page_right
				order by
					pp.page_right asc
				limit 1
		), 0) as page_parent_id', false);
		
		$this->db->select('group_concat(pp.page_slug order by pp.page_left separator "") as page_slug_path', false);
		$this->db->select('count(pp.page_id) - 1 as page_depth');
		$this->db->from('page pn');
		$this->db->from('page pp');
		$this->db->where('pn.page_left between pp.page_left and pp.page_right');
		$this->db->having('page_slug_path', $page_slug);
		$this->db->order_by('pn.page_left');
		$this->db->group_by('pn.page_id');
		$page_result = $this->db->get();
		if($page_result->num_rows() !== 1) {
			return false;
		}
		
		return $page_result->row(0, 'Page_Object');
	}


	public function create() {
		
		$parent_id = $this->form_validation->value('page_parent_id');
		
		// Find the right-weight of the parent node.  If this is the root, then do 
		// not drop the weight by one (to find the node's left, or last child's right).
		$tree_mark = $this->tree_node_right($parent_id) + ($parent_id == 0 ? 0 : -1);
		
		// Shift everything right to make room.
		// First shift all rights.
		$this->db->set('page_right', 'page_right + 2', false);
		$this->db->where('page_right > ' . $tree_mark);
		$this->db->update('page');

		// Next, shift all lefts.
		$this->db->set('page_left', 'page_left + 2', false);
		$this->db->where('page_left > ' . $tree_mark);
		$this->db->update('page');
		
		// Now insert the new page.
		$page_create = new DateTime;
		$page_insert = array(
			'page_author_id'	=> $this->administrator->id(),
			'page_name'			=> $this->form_validation->value('page_name', '', false),
			'page_slug'			=> $this->form_validation->value('page_slug'),
			'page_content'		=> $this->form_validation->value('page_content', null, false),
			'page_status'		=> $this->form_validation->value('page_status'),
			'page_left'			=> $tree_mark + 1,
			'page_right'		=> $tree_mark + 2,
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
	
	
	public function update($page_id, $mode = self::AT_TAIL) {
		
		$page = $this->retrieve_by_id($page_id);
		
		// Ensure that we are not trying to set this as a child of one of its
		// sub-pages, i.e. parent_id between this page's left/right.
		// @TODO
		
		$new_parent_id = $this->form_validation->value('page_parent_id');
		
		// Do we need to update the tree?
		if($page->parent() != $new_parent_id) {
			
			if($mode !== self::AT_TAIL) {
				die('Not yet implemented');
			}
			
			// 1. Shrink up the space where this used to belong.
			
			
			
			// Get a list of IDs in the subtree.
			// These will be excluded from further modification later.
			$subtree_page_ids = $this->retrieve_nested_ids($page->id());
			
			// Right
			$this->db->set('page_right', 'page_right - ' . $page->tree_width(), false);
			$this->db->where('page_right > ' . $page->tree_right());
			$this->db->update('page');

			// Left
			$this->db->set('page_left', 'page_left - ' . $page->tree_width(), false);
			$this->db->where('page_left > ' . $page->tree_right());
			$this->db->update('page');
			
			
			// 2. Open a space for the sub-tree.
			
			// Get the parent's right, and work out the 'difference' between here and there.
			$tree_mark 	= $this->tree_node_right($new_parent_id) + ($new_parent_id == 0 ? 0 : -1);
			
			// Right
			$this->db->set('page_right', 'page_right + ' . $page->tree_width(), false);
			$this->db->where('page_right > ' . $tree_mark);
			$this->db->where_not_in('page_id', $subtree_page_ids);
			$this->db->update('page');
			
			// Left
			$this->db->set('page_left', 'page_left + ' . $page->tree_width(), false);
			$this->db->where('page_left > ' . $tree_mark);
			$this->db->where_not_in('page_id', $subtree_page_ids);
			$this->db->update('page');
			
			
			// 3. Update the old sub-tree
			$difference = ($tree_mark - $page->tree_left()) + 1;
			
			$this->db->set('page_left', 'page_left + ' . $difference, false);
			$this->db->set('page_right', 'page_right + ' . $difference, false);
			$this->db->where_in('page_id', $subtree_page_ids);
			$this->db->update('page');			
		}
		
		
		//22-27.
		//new left should be 49.
		//49

		
		// 4. Update page!
		$page_update = new DateTime;
		$page_change = array(
			'page_name'			=> $this->form_validation->value('page_name', '', false),
			'page_slug'			=> $this->form_validation->value('page_slug'),
			'page_content'		=> $this->form_validation->value('page_content', null, false),
			'page_status'		=> $this->form_validation->value('page_status'),
			'page_date_updated'	=> $page_update->format('Y-m-d H:i:s')
		);
		
		$this->db->update('page', $page_change, array('page_id' => $page_id));
		
		// Flash Message
		$this->session->set_flashdata('admin/message', sprintf('Page entitled "%s" has been updated', $this->form_validation->value('page_name')));
		
		// Return the insert ID.
		return $this->db->affected_rows() === 1;
	}
	
	
	
	public function search($search_term) {
		
		$this->db->select('pn.*');

		$this->db->select('
		ifnull((
			select pp.page_id
				from page pp
					where pp.page_left < pn.page_left AND pp.page_right > pn.page_right
				order by
					pp.page_right asc
				limit 1
		), 0) as page_parent_id', false);
		
		$this->db->select('group_concat(pp.page_slug order by pp.page_left separator "") as page_slug_path', false);
		$this->db->select('count(pp.page_id) - 1 as page_depth');
		$this->db->from('page pn');
		$this->db->from('page pp');
		$this->db->where('pn.page_left between pp.page_left and pp.page_right');
		$this->db->where(sprintf('match(pn.page_name, pn.page_content) AGAINST (\'%s\' IN BOOLEAN MODE)', $search_term));
		$this->db->order_by('pn.page_left');
		$this->db->group_by('pn.page_id');
		$news_result = $this->db->get();
		
		return $news_result->result('Page_Object');
	}
	
	
	
	
	public function retrieve_nested_ids($node_id) {
		
		$this->db->select('group_concat(pn.page_id) as node_ids');
		$this->db->from('page pn');
		$this->db->from('page pp');		
		$this->db->where('pp.page_id', $node_id);		
		$this->db->where('pn.page_left between pp.page_left and pp.page_right');
		$subtree_result = $this->db->get();
		
		return explode(',', $subtree_result->row('node_ids'));
	}
	
	
	public function ajax_slug($json) {
		
		$iter = 0;
		$name = str_replace(array('&'), array('and'), $json['incoming']['page_name']);
		$slug = url_title($name, 'dash', true);
		
		if($this->page_slugs_preslashed) {
			$slug = '/' . $slug;
		}
		
		while(false === $this->validate_unique_permalink($slug, $json['incoming']['page_parent_id'], isset($json['incoming']['page_id']) ? $json['incoming']['page_id'] : null)) {
			
			$slug = url_title($name . ($iter === 0 ? '' : '-' . $iter), 'dash', true);
			if($this->page_slugs_preslashed) {
				$slug = '/' . $slug;
			}
			
			$iter++;
		}
		
		$json = array_merge($json, array('status' => true, 'result' => array(
			'slug'	=> $slug,
			'iter'	=> $iter
		)));
		
		return $json;
	}
	
	
	
	/*
	public function delete($page_id) {
		
		// Are we nesting this function?
		if(is_callable($callback = array($this, 'parent::delete'))) {
			return call_user_func_array($callback, func_get_args());
		}
		
		if(!$page = $this->load($page_id, 'page_id')) {
			return false;
		}
		
		// Mark the page as deleted
		$this->session->set_flashdata('admin/message', sprintf('Page entitled "%s" has been deleted', $page['page_name']));
		$this->db->update('page', array('page_status' => 'deleted'), array('page_id' => $page_id));
		
		return $this->db->affected_rows() === 1;
	}
	*/
	
	/*
	public function purge() {
		
		// Remove all 'deleted' pages permanently
		$this->db->delete('page', array('page_status' => 'deleted'));
		$deleted_pages = $this->db->affected_rows();

		$this->session->set_flashdata('admin/message', sprintf('%d page%s have been purged.', $deleted_pages, $deleted_pages == 1 ? '' : 's'));		
		return $deleted_pages;
	}
	*/
	
	
	public function sitemap() {
		
		$sitemap_data = array();
		foreach($this->retrieve() as $page) {
			
			if(!in_array($page->page_status, array('published')))
				continue;
			
			$sitemap_data[$page->page_slug] = $page->page_name;
		}
		
		return $sitemap_data;
	}
	
	
	
	/**
	 * validate_unique_permalink
	 *
	 * Validation function intended to stop string paths being 
	 * non-unique.  Unique strings are useful for things such as
	 * URLs built from a tree and for hashing.
	 * 
	 * @param string $page_slug 
	 * @param mixed $reference_field 
	 * @param mixed $ignore
	 * @return boolean
	 */
	public function validate_unique_permalink($page_slug, $reference_field = 'page_parent_id', $ignore = null) {
		
		// Are we calling this wishing to rely on form_validation?
		// This is generally true as this function is used as a callback.
		$via_form_validation = !is_numeric($reference_field);
		
		$this->db->select('pn.page_id');
		$this->db->select('pn.page_name');
		$this->db->select('count(pp.page_id) - 1 as page_depth');
		$this->db->from('page pn');
		$this->db->from('page pp');
		$this->db->where('pn.page_left between pp.page_left and pp.page_right');
		$this->db->order_by('pn.page_left');
		$this->db->group_by('pn.page_id');
		
		// If we are at the root...
		if(($via_form_validation && ($this->form_validation->value($reference_field) == 0) || $reference_field === 0)) {
			$this->db->having('page_depth', 0);
			$this->db->where('pn.page_slug', $page_slug);
		}
		// If we are not at the root (i.e. a child)...
		else {
			
			$this->db->select('
				ifnull((
					select px.page_id
						from page px
							where px.page_left < pn.page_left AND px.page_right > pn.page_right
						order by
							px.page_right asc
						limit 1
				), 0) as page_parent_id
			', false);
			
			$this->db->where('pn.page_slug', $page_slug);
			$this->db->having('page_parent_id', $via_form_validation ? $this->form_validation->value($reference_field) : $reference_field);
		}
		
		// If there is a page id value present in the POST array
		// allow this to be 'ignored' from the query.  This will
		// stop self-comparisons on an ->update() request.
		if($via_form_validation && false !== $this->form_validation->value('page_id')) {
			$this->db->where('pn.page_id !=', $via_form_validation ? $this->form_validation->value('page_id') : $ignore);
		}
		
		$page_result = $this->db->get();
		if($page_result->num_rows() == 0) {
			return true;
		}
		
		// Set validation message because we have found a collision.
		if($via_form_validation) {
			$this->form_validation->set_message('module_callback', sprintf('The %%s must have a unique permalink. This is taken by page "%s".', $page_result->row(0, 'Page_Object')->title()));
		}
		
		return false;
	}
	
	
	/**
	 * validate_valid_nesting
	 * 
	 * Validation function intended to stop nodes being nested within
	 * children of themselves.
	 *
	 * @param int $node_id 
	 * @param string $reference_field 
	 * @return boolean
	 */
	public function validate_valid_nesting($node_id, $reference_field = 'page_parent_id') {
		
		// Ignore this node if it is newly created.
		if(!is_numeric($node_id) || $node_id == 0) {
			return true;
		}
		
		// @TODO
		// Ignore this page if, for whatever reason, there is no 'parent id' field.
		// Interestingly, the reference field wasn't in ->form_validation->value(), so
		// I had to use ->post with XSS clean instead.  Investigate this...
		if(false === ($parent_id = $this->input->post($reference_field, true))) {
			return true;
		}
		
		// Is the new parent ID within the list of its children?  If so, we'd
		// make an infinite loop, so throw this out as invalid.
		if(in_array($parent_id, $this->retrieve_nested_ids($node_id))) {
			$this->form_validation->set_message('module_callback', 'The Parent Page cannot be one of this Page\'s children.');
			$this->form_validation->add_error(null, $reference_field, true);
			return false;
		}
		
		return true;
	}
	
	
	
	
	
	
	
	static public function install($force = false) {
		
		get_instance()->load->dbforge();
		$dbforge =& get_instance()->dbforge;
		
		$columns = array(
			'page_id' => array(
				'type' 				=> 'mediumint',
				'constraint'		=> 8,
				'unsigned'			=> true,
				'auto_increment'	=> true,
				'null'				=> false
			),
			'page_author_id' => array(
				'type' 				=> 'mediumint',
				'constraint'		=> 8,
				'unsigned'			=> true,
				'null'				=> false
			),
			'page_name' => array(
				'type' 				=> 'varchar',
				'constraint'		=> 128,
				'null'				=> false
			),
			'page_slug' => array(
				'type' 				=> 'varchar',
				'constraint'		=> 128,
				'null'				=> false
			),
			'page_content' => array(
				'type' 				=> 'text',
				'null'				=> true
			),
			'page_status' => array(
				'type' 				=> 'enum',
				'constraint'		=> "'" . implode("', '", array('draft', 'published', 'deleted')) . "'",
				'null'				=> false
			),
			'page_left' => array(
				'type' 				=> 'mediumint',
				'constraint'		=> 8,
				'unsigned'			=> true,
				'null'				=> false
			),
			'page_right' => array(
				'type' 				=> 'mediumint',
				'constraint'		=> 8,
				'unsigned'			=> true,
				'null'				=> false
			),
			'page_date_created' => array(
				'type' 				=> 'datetime',
				'null'				=> false
			),
			'page_date_updated' => array(
				'type' 				=> 'datetime',
				'null'				=> true
			)
		);
		
		$dbforge->add_field($columns);
		$dbforge->add_key('page_slug');
		$dbforge->add_key('page_id', true);
		
		$dbforge->create_table('page', !$force);
	}
}


class NestedSet_Model extends CI_Model {
	
	const AT_HEAD 	= 0x01;	// Stick at the head
	const AT_TAIL 	= 0x02;	// Stick at the tail
	
	public function __construct() {
		parent::__construct();
	}

	
	public function path($page_id) {
		
		$this->db->select('pp.page_id');
		$this->db->select('pp.page_name');
		$this->db->select('pp.page_slug');
		$this->db->from('page pn');
		$this->db->from('page pp');
		$this->db->where('pn.page_left between pp.page_left and pp.page_right');
		$this->db->where('pn.page_id', $page_id);
		$this->db->order_by('pn.page_left');
		$page_result = $this->db->get();
		
		
		$page_coslug = '';
		$breadcrumbs = array('/' => 'Home');
		foreach($page_result->result() as $page) {
			$page_coslug .= $page->page_slug;
			$breadcrumbs[$page_coslug] = $page->page_name;
		}
		
		return $breadcrumbs;
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
		$this->session->set_flashdata('admin/message', sprintf('Deleted %d page%s', $deleted_items, $deleted_items == 1 ? '' : 's'));
		
		return $deleted_items === 0 ? false : $deleted_items;
	}


	public function retrieve_by_id($item_id) {

		$this->db->select('pn.*');
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
		$this->db->from('page pp');
		$this->db->where('pn.page_id', $item_id);
		$this->db->select('group_concat(pp.page_slug order by pp.page_left separator "") as page_slug_path', false);
		$this->db->where('pn.page_left between pp.page_left and pp.page_right');
		$this->db->order_by('pn.page_left');
		$this->db->group_by('pn.page_id');
		$page_result = $this->db->get();
		
		if($page_result->num_rows() !== 1) {
			return false;
		}

		return $page_result->row(0, 'Page_Object');
	}
	
	
	
	/**
	 * retrieve_nested
	 * 
	 * Obtain a nested iterable tree of objects from
	 * the database.  Optionally, supply an ID for which
	 * record you would like the root to be (to get a subtree).
	 *
	 * @param 	string $element_root	
	 * @return 	void
	 */
	public function retrieve_nested($element_root = 0, $element_limit = null) {
		
		$this->db->select('pn.page_id');
		$this->db->select('pn.page_name');
		$this->db->select('pn.page_slug');
		$this->db->select('pn.page_status');
		
		// debug:
		$this->db->select('pn.page_left, pn.page_right');
		
		$this->db->select('pn.page_date_created');
		$this->db->select('pn.page_date_updated');
		$this->db->select('group_concat(pp.page_slug order by pp.page_left separator "") as page_slug_path', false);
		
		$this->db->select('group_concat(NULLIF(pp.page_id, pn.page_id) order by pp.page_left) as page_id_path', false);
		
		$this->db->from('page pp');
		$this->db->from('page pn');
		
		$this->db->where('(pn.page_left between pp.page_left and pp.page_right)');
		
		$this->db->group_by('pn.page_id');
		$this->db->order_by('pn.page_left');
		
		// If we need to obtain a sub-tree, we need to join
		// an additional items table plus the sub-tree to cross-reference
		if($element_root != 0 && is_numeric($element_root)) {
		
			// TEMP:
			$this->db->select('nullif(pt.page_id, pn.page_id) as page_parent_id', false);
			
			$this->db->from('page ps');
			$this->db->from(sprintf('(
				select
					pn.page_id,
					(count(pp.page_id) - 1) as page_depth
				from
					page as pn,
					page as pp
				where
					pn.page_left between pp.page_left and pp.page_right
						and pn.page_id = %d
					group by pn.page_id
					order by pn.page_left
			) as pt', $element_root));
			
			$this->db->where('(pn.page_left between ps.page_left and ps.page_right)');
			$this->db->where('(ps.page_id = pt.page_id)');
			$this->db->select('(count(pp.page_id) - (pt.page_depth + 1)) as page_depth');
			
			// Limit the depth of the sub-tree?
			if(!is_null($element_limit)) {
				$this->db->having('page_depth <=' . $element_limit);
			}
		}
		else {
			$this->db->select('count(pp.page_id) - 1 as page_depth');
			// group concat screws this up royally.
			//$this->db->select('pp.page_id as page_parent_id', false);
			$this->db->select('(
				select 
					pt.page_id
				from
					page as pt
				where
					pt.page_left < pn.page_left AND pt.page_right > pn.page_right
				order by
					pt.page_right - pn.page_right asc
				limit 1
			) as page_parent_id');
		}
		
		$page_result = $this->db->get();
		$page_objects = $page_result->result('Nested_Page_Object');
		$tree_objects = $this->build_tree($page_objects);
		
		// Built a tree out of 'Nested_Page_Object's
		// If we have specified a root, stop it being wrapped in an array by build_tree.
		return $element_root == 0 ? $tree_objects : current($tree_objects);
	}
	
	protected function build_tree($data) {
		
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
	
	
	
	
	
	protected function tree_node_left($node_id = 0) {
		return $this->tree_meta('page_left', $node_id);
	}
	
	protected function tree_node_right($node_id = 0) {
		return $this->tree_meta('page_right', $node_id);
	}
	
	private function tree_meta($direction, $node_id = 0) {
		
		$node_select = $node_id == 0 ? 'max(' . $direction . ')' : $direction;
		
		$this->db->select($node_select . ' as node_meta');
		$this->db->from('page');
		
		if($node_id > 0) {
			$this->db->where('page.page_id', $node_id);
		}
		
		$node_result = $this->db->get();
		return $node_result->num_rows() == 0 ? 0 : (int)$node_result->row('node_meta');
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
	
	public function slug($permalink = false) {
		return $permalink ? $this->permalink() : $this->page_slug;
	}
	
	public function permalink($complete = false) {
		return isset($this->page_slug_path) ? ($complete ? site_url($this->page_slug_path) : $this->page_slug_path) : false;
	}
	
	public function title() {
		return $this->page_name;
	}
	
	public function status($formatted = false) {
		
		if(!$formatted) {
			return $this->page_status;
		}
		
		return ucfirst($this->page_status);
	}
	
	public function parent() {
		return (int)$this->page_parent_id;
	}
	
	public function active($uri = null) {
		return CI::$APP->uri->uri_string() === (!is_null($uri) ? $uri : $this->permalink());
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
	
	public function hasChildren() {
		return ($this->tree_right() - $this->tree_left()) > 1;
	}
	
	
	public function created($format = 'd/m/Y H:i') {
		$dt = DateTime::createFromFormat(DATE_MYSQL, $this->page_date_created);
		return false !== $format ? $dt->format($format) : $dt;
	}
	
	public function updated($format = 'd/m/Y H:i') {
		
		if(is_null($this->page_date_updated))
			return $this->created($format);
		
		$dt = DateTime::createFromFormat(DATE_MYSQL, $this->page_date_updated);
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
			'clean' 			   			=> false,		// Setting this to true causes style="width: 100px;" in tables to be removed. hmm.
			'css-prefix'		   			=> 'insight',
			'indent' 			   			=> true,
			'indent-spaces' 	   			=> 4,
			'drop-empty-paras' 	   			=> true,
			'drop-font-tags'	   			=> true,
			'drop-proprietary-attributes'	=> true,
			'show-body-only'				=> true,
			'merge-divs'					=> true,
			'preserve-entities'				=> true,
			'input-encoding'				=> 'utf8',
			'char-encoding'					=> 'utf8',
			'output-encoding'				=> 'utf8',
			'new-blocklevel-tags'			=> 'widget'
		));
	}
}

class Nested_Page_Object extends Page_Object implements RecursiveIterator, Countable {
	
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
	
	public function left() {
		return (int)$this->page_left;
	}
	
	public function right() {
		return (int)$this->page_right;
	}
	
	
	
	
	
	
	// Iterator methods.
	public function hasChildren() {
		return count($this->children) > 0;
	}
	
	public function getChildren() {
		return new ArrayIterator($this->children);
	}
	
	public function id_recursive() {
		
		if(is_null($this->page_id_path))
			return '';
		
		return json_encode(array_map('intval', explode(',', $this->page_id_path)));
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