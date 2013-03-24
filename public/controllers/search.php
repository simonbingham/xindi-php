<?php
class Search extends MY_Controller {

	/**
	 * I instantiate this class
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->helper('text');
		$this->load->model('Search_class');
	}	
	
	/**
	 * I display the search results page
	 *
	 * @access   public
	 */
	public function index()
	{
		$data = $this->input->post();
		$search_term = $data['search_term'];
		$search_result_exclusions = $this->config->item('search_result_exclusions');
		$data['search_results'] = $this->Search_class->get_search_results($search_term, $search_result_exclusions);
		$layout_data['content_body'] = $this->load->view('search/index', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}
	
}