<?php
class Pages extends MY_Controller {

	/**
	 * I instantiate this class
	 */
	function __construct()
	{
		parent::__construct();
	}	
	
	/**
	 * I display a page
	 *
	 * @access   public
	 * @param    string   slug of page being viewed
	 */
	public function view($slug = '')
	{
		$page = $this->Page_class->get_page_by_slug($slug)->row();
		if(! empty($page))
		{
			$data['breadcrumbs'] = $this->Page_class->get_path($page);
			$data['title'] = $page->title;
			$data['content'] = $page->content;
			$layout_data['content_body'] = $this->load->view('pages/index', $data, true);
			$this->load->view('layouts/index', $layout_data);
		}
		else
		{
			show_404();
		}		
	}
	
}