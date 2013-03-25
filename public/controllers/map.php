<?php
class Map extends MY_Controller {

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
	 * I display the site map page
	 * @access public
	 * @return void
	 */
	public function index()
	{
		$map = $this->Page_class->get_navigation();
		if(! empty($map))
		{
			$data['content'] = $map;
			$layout_data['content_body'] = $this->load->view('map/index', $data, true);
			$this->load->view('layouts/index', $layout_data);
		}
		else
		{
			show_404();
		}		
	}
	
}