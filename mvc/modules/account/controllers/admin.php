<?php

class Admin extends INSIGHT_Admin_Controller {
	
	public function __construct() {

		parent::__construct();
		$this->load->model('account_model', 'account');
	}
	
	public function index() {

		$this->load->view('admin/account/index.view.php', array(
			'accounts' => $this->account->retrieve()
		));
	}
	
	public function update($account_id) {
		
		$this->load->view('admin/account/update.view.php', array(
			'account' => $this->account->retrieve_by_id($account_id)
		));
	}
	
	public function export() {
		$this->load->helper('download');
		force_download(sprintf('%s-accounts.csv', strtolower($this->insight->config('display/title'))), $this->account->retrieve_as_csv());
	}
}