<?php

class Admin extends INSIGHT_Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('page_model', 'page');
		$this->lang->load('module_validation');
	}
	
	
	public function index() {
		$this->load->view('admin/page/index.view.php');
	}
	
	
	public function retrieve($format = 'table-row', $args = array()) {
		
		// Load all pages into a Recurisve Iterator.
		$page_iterator = new RecursiveArrayIterator($this->page->retrieve_nested());
		
		//var_dump($this->page->retrieve_nested());
		
		// Load an empty chunk if there are 0 rows.
		if($page_iterator->count() === 0) {
			return $this->load->view('admin/page/chunks/' . $format . '.empty.chunk.php');
		}
		
		// Iterate over children.
		iterator_apply($page_iterator, array($this, '_render'), array($page_iterator, 0, $format, $args));
	}
	
	
	public function create() {
		
		if($this->form_validation->run('admin-page-form')) {
			
			// Create Page.
			$page_id = $this->page->create();
			
			// Link Resources.
			$resource_call = sprintf('%s/resource/link', $this->form_validation->value('resource_link'));
			Modules::run($resource_call, 'page', $page_id, explode(',', $this->form_validation->value('resource_data')));
			
			// Return.
			return redirect('admin/page');
		}
		
		$this->load->view('admin/page/create.view.php', array());
	}
	
	
	public function update($page_id) {
		
		if($this->form_validation->run('admin-page-form')) {
			
			// Update Page.
			$this->page->update($page_id);
			
			// Link Resources.
			$resource_call = sprintf('%s/resource/link', $this->form_validation->value('resource_link'));
			Modules::run($resource_call, 'page', $page_id, explode(',', $this->form_validation->value('resource_data')));
			
			// Return.
			return redirect('admin/page');
		}
		
		$this->load->view('admin/page/update.view.php', array(
			'page' 	=> $this->page->retrieve_by_id($page_id)
		));
	}
	
	
	public function delete($page_id) {
		
		if(!$this->page->delete($page_id))
			show_error('Could not delete page.');
			
		return redirect('admin/page');
	}
	
	
	public function settings() {
		echo 'settings for page';
	}
	
	/**
	 * ajax
	 * 
	 * Ajax endpoint.
	 *
	 * @return string JSON
	 */
	public function ajax($function) {
		
		$func = 'ajax_' . $function;
		$post = $this->input->post(null, true);
		$json = array(
			'function'	=> $function,
			'incoming'	=> $post,
			'status'	=> false
		);
		
		if(is_callable(array($this->page, $func))) {
			$json = call_user_func(array($this->page, $func), $json);
		}
		
		return $this->output->set_output(json_encode($json));
	}
	
	
	
	private function _render($page_iterator, $limit = 0, $format = 'table-row', $args = array()) {
		
		while($page_iterator->valid()) {
			
			$page = $page_iterator->current();

			$this->load->view('admin/page/chunks/' . $format . '.chunk.php', array_merge(array('page' => $page), $args));
			
			if($page->hasChildren()) {
				$this->_render(new RecursiveArrayIterator($page->getChildren()), $limit, $format, $args);
			}
			
			$page_iterator->next();
		}
	}
	
	
	
	
	
	public function temp() {
		
		$api = 'test_anubis_' . $this->administrator->id();
		
		$postText = '';
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$postText = trim(file_get_contents('php://input'));
		}
		
		$postText .= '&key=' . $api;

		$url = isset($_GET['url']) ? $_GET['url'] : '/checkDocument';


		$data = $this->AtD_http_post($postText, "service.afterthedeadline.com", $url);

		header('Content-Type: text/xml');
		echo $data[1];
	}
	
	private function AtD_http_post($request, $host, $path, $port = 80) 
	{
	   $http_request  = "POST $path HTTP/1.0\r\n";
	   $http_request .= "Host: $host\r\n";
	   $http_request .= "Content-Type: application/x-www-form-urlencoded\r\n";
	   $http_request .= "Content-Length: " . strlen($request) . "\r\n";
	   $http_request .= "User-Agent: AtD/0.1\r\n";
	   $http_request .= "\r\n";
	   $http_request .= $request;            

	   $response = '';                 
	   if( false != ( $fs = @fsockopen($host, $port, $errno, $errstr, 10) ) ) 
	   {                 
	      fwrite($fs, $http_request);

	      while ( !feof($fs) )
	      {
	          $response .= fgets($fs);
	      }
	      fclose($fs);
	      $response = explode("\r\n\r\n", $response, 2);
	   }
	   return $response;
	}
}