<?php

class News_Model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function create() {
		
		var_dump($this->session->get());
		exit;
		
		$news_create = new DateTime;
		$news_insert = array(			
			'news_author_id'		=> 1,
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
		
		// Return the insert ID.
		return $this->db->insert_id();
	}
	
	public function retrieve() {
		
		$this->db->select('*');
		$this->db->from('news');
		$this->db->where('NOW() >= news.news_date_published');
		$this->db->order_by('news.news_date_published desc');
		$news_result = $this->db->get();
		
		return $news_result->result('News_Object');
	}
	
	public function update($news_id) {
		
		$news_update = new DateTime;
		$news_change = array(
			'news_author_id'		=> 1,
			'news_title'			=> $this->form_validation->value('news_title', '', false),
			'news_date_updated'		=> $news_update->format('Y-m-d H:i:s'),
		);
		
		$this->db->update('news', $news_change, array('news_id' => $news_id));
		
		// Flash Message
		$this->session->set_flashdata('admin/message', sprintf('News article "%s" has been updated', $this->form_validation->value('news_title')));
		
		// Return the insert ID.
		return $this->db->affected_rows() === 1;
	}
	
	public function delete($news_id) {
		
		// Check that the article exists.
		if(!$news = $this->retrieve_by_id($news_id)) {
			return false;
		}
		
		// Mark the page as deleted
		$this->session->set_flashdata('admin/message', sprintf('News article "%s" has been deleted', $news->title()));
		$this->db->delete('news', array('news_id' => $news_id));
		
		unset($news);
		
		return $this->db->affected_rows() === 1;
	}
	
	public function archive($year, $month = null, $day = null) {
		
		$this->db->select('*');
		$this->db->from('news');
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
		
		$this->db->select('*');
		$this->db->from('news');
		$this->db->where('news.news_id', $news_id);
		$news_result = $this->db->get();
		
		if($news_result->num_rows() === 0) {
			return false;
		}
		
		return $news_result->row(0, 'News_Object');
	}
	
	public function retrieve_by_slug($news_slug) {
		
		$this->db->select('*');
		$this->db->from('news');
		$this->db->where('news.news_slug', $news_slug);
		$news_result = $this->db->get();
		
		if($news_result->num_rows() === 0) {
			return false;
		}
		
		return $news_result->row(0, 'News_Object');
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
		return htmlentities($this->news_title);
	}
	
	public function size() {
		return strlen($this->news_data_full);
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
			'show-body-only'	=> true
		));
	}
}