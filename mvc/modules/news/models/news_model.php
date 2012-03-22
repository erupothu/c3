<?php

class News_Model extends CI_Model {
	
	private $defaults = array(
		'news_categories_enabled' => 'DISABLED'	// DISABLED, SINGLE, MULTIPLE
	);
	
	private $settings;
	
	public function __construct() {
		
		parent::__construct();
		
		$this->settings = array_merge($this->defaults, $this->insight->config('user/news'));
		
		// Run Installer.
		//News_Model::install();
	}
	
	public function create() {
		
		$news_create = new DateTime;
		$news_insert = array(			
			'news_author_id'		=> $this->administrator->id(),
			'news_title'			=> $this->form_validation->value('news_title', '', false),
			'news_slug'				=> $this->form_validation->value('news_slug'),
			'news_data_excerpt'		=> $this->form_validation->value('news_data_excerpt', null, false),
			'news_data_full'		=> $this->form_validation->value('news_data_full', null, false),
			'news_date_created'		=> $news_create->format('Y-m-d H:i:s'),
			'news_date_published'	=> $news_create->format('Y-m-d H:i:s')
		);
		
		$this->db->insert('news', $news_insert);
		
		// Flash Message
		$this->session->set_flashdata('admin/message', sprintf('News article entitled "%s" has been created', $this->form_validation->value('news_title')));
		
		// Get the PK.
		$news_id = $this->db->insert_id();
		
		// Attach Categories.
		$news_categories = array_filter($this->form_validation->value('news_category_id[]', null, false, false), function($element) { return !empty($element); });
		$this->attach_categories($news_id, $news_categories);
		
		// Return the insert ID.
		return $news_id;
	}
	
	
	public function retrieve($where = array()) {
		
		$this->db->select('n.*');
		$this->db->select('u.user_firstname as news_author_firstname');
		$this->db->select('u.user_lastname as news_author_lastname');
		$this->db->select('LENGTH(n.news_data_full) as news_length');
		$this->db->from('news n');
		$this->db->join('user u', 'u.user_id = n.news_author_id');
		$this->db->where('NOW() >= n.news_date_published');
		$this->db->order_by('n.news_date_published desc');
		
		foreach($where as $where_field => $where_value) {
			$this->db->where($where_field, $where_value);
		}
		
		// If we are using categories...
		if($this->settings['news_categories_enabled'] !== 'DISABLED') {
			
			// THIS WILL WORK ONLY FOR 'SINGLE'.
			// MULTIPLE IS GOING TO REQUIRE A REWRITE (NO TIME ATM).
			// sorry :3
			$this->db->select('nc.*');
			$this->db->select('nl.link_news_id');
			$this->db->join(array('news_link nl', 'news_category nc'), 'nl.link_news_id = n.news_id and nl.link_category_id = nc.category_id', 'left');
			$this->db->group_by('n.news_id');
			
			$news_result = $this->db->get();
			$linked_categories = array();
			$category_objects = $news_result->result('News_Category_Object');
			foreach($category_objects as $category_object) {
				$linked_categories[$category_object->link_news_id] = $category_object;
			}

		}
		
		
		if(!isset($news_result)) {
			$news_result = $this->db->get();
			//var_dump($news_result->result());
		}
		
		$news_objects = $news_result->result('News_Object');
		
		
		// If we are using categories...
		if($this->settings['news_categories_enabled'] !== 'DISABLED') {
			
			foreach($news_objects as $i => $news_object) {
				if(!isset($linked_categories[$news_object->id()]))
					continue;
				$news_objects[$i]->attach($linked_categories[$news_object->id()]);
			}
		}
		
		
		return $news_objects;
	}
	
	
	public function update($news_id) {
		
		// Attach Categories.
		$news_categories = array_filter($this->form_validation->value('news_category_id[]', null, false, false), function($element) { return !empty($element); });
		$this->attach_categories($news_id, $news_categories);
		
		$news_update = new DateTime;
		$news_change = array(
			'news_title'			=> $this->form_validation->value('news_title', '', false),
			'news_slug'				=> $this->form_validation->value('news_slug'),
			'news_data_excerpt'		=> $this->form_validation->value('news_data_excerpt', null, false),
			'news_data_full'		=> $this->form_validation->value('news_data_full', null, false),
			'news_date_updated'		=> $news_update->format(DATE_MYSQL_DATETIME),
			'news_date_published'	=> DateTime::createFromFormat('Y-m-d H:i:s', sprintf('%s %02d:%02d:00', $this->form_validation->value('news_date_published'), $this->form_validation->value('news_date_published_h', date('H')), $this->form_validation->value('news_date_published_i', date('i'))))->format(DATE_MYSQL_DATETIME)
		);
		
		$this->db->update('news', $news_change, array('news_id' => $news_id));
		
		// Flash Message
		$this->session->set_flashdata('admin/message', sprintf('News article "%s" has been updated', $this->form_validation->value('news_title')));
		
		return $this->db->affected_rows() === 1;
	}
	
	public function delete($news_id) {
		
		// Check that the article exists.
		if(!$news = $this->retrieve_by_id($news_id)) {
			return false;
		}
		
		$this->session->set_flashdata('admin/message', sprintf('News article "%s" has been deleted', $news->title()));
		
		// Remove any news category links.
		$this->remove_categories($news_id);
		
		// Remove the actual news item.
		$this->db->where('news_id', $news_id);
		$this->db->delete('news');
		
		unset($news);
		
		return $this->db->affected_rows() === 1;
	}
	
	
	public function search($search_term) {
		
		$this->db->select('*');
		$this->db->from('news');
		$this->db->where(sprintf('match(news_title, news_data_full) AGAINST (\'%s\' IN BOOLEAN MODE)', $search_term));
		$news_result = $this->db->get();
		
		return $news_result->result('News_Object');
	}
	
	
	public function archive($year, $month = null, $day = null) {
		
		$this->db->select('news.*');
		$this->db->select('user.user_firstname as news_author_firstname');
		$this->db->select('user.user_lastname as news_author_lastname');
		$this->db->from('news');
		$this->db->join('user', 'user.user_id = news.news_author_id');
		$this->db->where('YEAR(news.news_date_published)', $year);
		$this->db->order_by('news.news_date_published desc');
		
		if(!is_null($month)) {
			
			if($month <= 0 || $month > 12) {
				throw new INSIGHT_Exception('Invalid month.');
			}
			
			$this->db->where('MONTH(news.news_date_published)', $month);
		}
		
		if(!is_null($month) && !is_null($day)) {
			
			if(!checkdate($month, $day, $year)) {
				throw new INSIGHT_Exception('Date does not exist.');
			}
			
			$this->db->where('DAY(news.news_date_published)', $day);
		}
		
		$news_result = $this->db->get();		
		return $news_result->result('News_Object');
	}

	public function retrieve_by_id($news_id) {
		
		$this->db->select('n.*');
		$this->db->select('u.user_firstname as news_author_firstname');
		$this->db->select('u.user_lastname as news_author_lastname');
		$this->db->from('news n');
		$this->db->join('user u', 'u.user_id = n.news_author_id');
		$this->db->where('n.news_id', $news_id);
		
		if($this->settings['news_categories_enabled'] !== 'DISABLED') {
			
			// THIS WILL WORK ONLY FOR 'SINGLE'.
			// MULTIPLE IS GOING TO REQUIRE A REWRITE (NO TIME ATM).
			// sorry :3
			$this->db->select('nc.*');
			$this->db->select('nl.link_news_id');
			$this->db->join(array('news_link nl', 'news_category nc'), 'nl.link_news_id = n.news_id and nl.link_category_id = nc.category_id', 'left');
			
		}
		
		$news_result = $this->db->get();
		
		if($news_result->num_rows() === 0) {
			return false;
		}
		
		$news = $news_result->row(0, 'News_Object');
		if($this->settings['news_categories_enabled'] !== 'DISABLED') {
			$news->attach($news_result->result('News_Category_Object'));
		}
		
		return $news;
	}
	
	public function retrieve_by_slug($news_slug) {
		
		$this->db->select('news.*');
		$this->db->select('user.user_firstname as news_author_firstname');
		$this->db->select('user.user_lastname as news_author_lastname');
		$this->db->from('news');
		$this->db->join('user', 'user.user_id = news.news_author_id');
		$this->db->where('news.news_slug', $news_slug);
		$news_result = $this->db->get();
		
		if($news_result->num_rows() === 0) {
			return false;
		}
		
		return $news_result->row(0, 'News_Object');
	}
	
	
	/* Categories */
	/* Should this have it's own model? */
	public function retrieve_categories() {
		
		$this->db->select('c.*');
		$this->db->from('news_category c');
		$this->db->order_by('c.category_id');
		$category_result = $this->db->get();
		
		return $category_result->result('News_Category_Object');
	}
	
	public function create_category() {}
	public function update_category() {}
	public function delete_category() {}
	
	public function attach_categories($news_id, $categories = array()) {
		
		// Remove existing links.
		$this->remove_categories($news_id);
		
		foreach($categories as $category_id) {
			
			$this->db->insert('news_link', array(
				'link_news_id'		=> $news_id,
				'link_category_id'	=> $category_id
			));
		}
		
		return count($categories);
	}
	
	public function remove_categories($news_id, $categories = array()) {
		
		if(!empty($categories)) {
			$this->db->where_in('link_category_id', $categories);
		}
		
		$this->db->where('link_news_id', $news_id);
		$this->db->delete('news_link');
		
		return $this->db->affected_rows();
	}
	
	
	
	
	static public function install() {
		
		get_instance()->load->dbforge();
		$dbforge =& get_instance()->dbforge;

		$columns = array(
			'news_id' => array(
				'type' 				=> 'mediumint',
				'constraint'		=> 8,
				'unsigned'			=> true,
				'auto_increment'	=> true,
				'null'				=> false
			),
			'news_author_id' => array(
				'type' 				=> 'smallint',
				'constraint'		=> 5,
				'unsigned'			=> true,
				'null'				=> false
			),
			'news_title' => array(
				'type' 				=> 'varchar',
				'constraint'		=> 256,
				'null'				=> false
			),
			'news_slug' => array(
				'type' 				=> 'varchar',
				'constraint'		=> 256,
				'null'				=> true
			),
			'news_data_excerpt' => array(
				'type' 				=> 'text',
				'null'				=> true
			),
			'news_data_full' => array(
				'type' 				=> 'text',
				'null'				=> false
			),
			'news_date_created' => array(
				'type' 				=> 'datetime',
				'null'				=> false
			),
			'news_date_updated' => array(
				'type' 				=> 'datetime',
				'null'				=> true
			),
			'news_date_published' => array(
				'type' 				=> 'datetime',
				'null'				=> false
			),
		);
	
		$dbforge->add_field($columns);
		$dbforge->add_key('news_author_id');
		$dbforge->add_key('news_id', true);
		$dbforge->create_table('news_test');
	}
	
	
	public function ajax_slug($json) {
		
		$iter = 0;
		$name = str_replace(array('&'), array('and'), $json['incoming']['news_title']);
		$slug = url_title($name, 'dash', true);
		
		while(false === $this->validate_unique_permalink($slug, isset($json['incoming']['news_id']) ? array($json['incoming']['news_id']) : null)) {
			
			$slug = url_title($name . ($iter === 0 ? '' : '-' . $iter), 'dash', true);
			$iter++;
		}
		
		$json = array_merge($json, array('status' => true, 'result' => array(
			'slug'	=> $slug,
			'iter'	=> $iter
		)));
		
		return $json;
	}
	
	public function validate_unique_permalink($slug, $ignore = array()) {
		
		$this->db->select('news.news_id');
		$this->db->from('news');
		$this->db->where('news.news_slug', $slug);
		if(count($ignore) > 0) {
			$this->db->where_not_in('news.news_id', $ignore);
		}
		
		$news_result = $this->db->get();
		return $news_result->num_rows() === 0;
	}
}

class News_Object {
	
	public function get($key) {
		
		if(!isset($this->$key))
			return '';
			
		return $this->$key;
	}
	
	public function id() {
		return (int)$this->news_id;
	}
	
	public function title() {
		return $this->news_title;
	}
	
	public function size() {
		return strlen($this->news_data_full);
	}
	
	public function author() {
		return sprintf('%s %s', $this->news_author_firstname, $this->news_author_lastname);
	}

	public function permalink($complete = false) {
		$permalink = array('news', $this->news_slug);
		return $complete ? site_url($permalink) : $this->news_slug;
	}
	
	public function active() {
		return CI::$APP->uri->uri_string() === $this->permalink();
	}
	
	
	/**
	 * published
	 *
	 * @todo 	Allow formats to be configured globally.
	 * @param 	string $format 
	 * @return 	void
	 * @author 	jon
	 */
	public function published($format = 'd/m/Y H:i') {
		$dt = DateTime::createFromFormat('Y-m-d H:i:s', $this->news_date_published);
		return false !== $format ? $dt->format($format) : $dt;
	}
	
	
	public function excerpt($length = 65, $cleaned = true) {
		
		$content = $this->content($cleaned);
		$content = strip_tags($content);
		
		preg_match(sprintf('/\A(.{%1$u,%2$u}(?!\w)|.{0,%2$u})/s', 0, $length), $content, $matches);
		$excerpt = $matches[1] . (strlen($content) > $length ? '&hellip;' : '');
		
		return $excerpt;
	}
	
	
	public function content($cleaned = true) {
		
		if(!$cleaned) {
			return $this->news_data_full;
		}
		
		if(!extension_loaded('Tidy')) {
			throw new INSIGHT_Exception('This feature is not available without the tidy library.');
		}
		
		$tidy = new Tidy;
		return $tidy->repairString($this->news_data_full, array(
			'clean' 			=> true,
			'indent' 			=> true,
			'indent-spaces' 	=> 4,
			'drop-empty-paras' 	=> true,
			'show-body-only'	=> true,
			'preserve-entities'	=> true,
			'input-encoding'	=> 'utf8',
			'char-encoding'		=> 'utf8',
			'output-encoding'	=> 'utf8'
		));
	}
	
	
	public function attach($categories = array()) {
		
		if(!is_array($categories))
			return $this->attach(array($categories));
		
		$this->categories = array_merge(!isset($this->categories) ? array() : $this->categories, $categories);
	}
	
	public function categories() {
		return new ArrayIterator(!isset($this->categories) ? array() : $this->categories);
	}
}

class News_Category_Object {
	
	public function id() {
		return $this->category_id;
	}
	
	public function title() {
		return $this->category_name;
	}
	
	public function permalink($complete = false) {
		return !$complete ? $this->category_slug : site_url(array('news/category/' . $this->category_slug));
	}
	
	public function created() {}
	public function updated() {}
}