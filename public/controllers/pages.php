<?php
class Pages extends MY_Controller {

	/**
	 * I instantiate this class
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Page_class');
	}	
	
	/**
	 * I display a page
	 *
	 * @access	public
	 * @param	string		slug of page being viewed
	 */
	public function view($page = 'index')
	{
		$data['pages'] = $this->Page_class->get_pages()->result();
		/*
		if (! file_exists(APPPATH.$page.'.php'))
		{
			show_404();
		}
		*/
		$data['title'] = 'Xindi PHP';
		$layout_data['content_body'] = $this->load->view('pages/index', $data, true);
		$this->load->view('layouts/index', $layout_data);		
	}
	
}