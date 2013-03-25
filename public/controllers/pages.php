<?php
class Pages extends MY_Controller {

	/**
	 * I instantiate this class
	 * @access public
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
	}	
	
	/**
	 * I display a page
	 * @access public
	 * @param string the first part of the url (optional)
	 * @param string the second part of the url (optional)
	 * @return void
	 */
	public function view($url_part_1='', $url_part_2='')
	{
		$slug = $url_part_1;
		if (strlen($url_part_2)) {
			$slug .= '/' . $url_part_2;
		}
		$page = $this->Page_class->get_page_by_slug($slug)->row();
		if (! empty($page))
		{
			$data['breadcrumbs'] = $this->Page_class->get_path($page);
			$data['title'] = $page->title;
			$data['content'] = $page->content;
			$data['meta_title'] = $page->metatitle;
			$data['meta_description'] = $page->metadescription;
			$data['meta_keywords'] = $page->metakeywords;			
			$layout_data['content_body'] = $this->load->view('pages/index', $data, true);
			$this->load->view('layouts/index', $layout_data);
		}
		else
		{
			show_404();
		}		
	}
	
}