<?php
class Search extends MY_Controller {

	/**
	 * I instantiate this class
	 * @access public
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->helper('text');
		$this->load->model('Search_class');
	}	
	
	/**
	 * I display the search results page
	 * @access public
	 * @return void
	 */
	public function index()
	{
		$data = $this->input->post();
		$search_term = $data['search_term'];
		$search_result_exclusions = $this->config->item('search_result_exclusions');
		$data['search_results'] = $this->Search_class->get_search_results($search_term, $search_result_exclusions);
		$data['meta_title'] = '';
		$data['meta_description'] = '';
		$data['meta_keywords'] = '';		
		$layout_data['content_body'] = $this->load->view('search/index', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}
	
}