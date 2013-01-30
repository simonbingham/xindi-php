<?php
class Pages extends MY_Controller {

	/**
	 * I display a page
	 *
	 * @access	public
	 * @param	string		slug of page being viewed
	 */
	public function view($page = 'index')
	{	
		if (! file_exists(APPPATH.$page.'.php'))
		{
			show_404();
		}
		$data['title'] = 'Xindi PHP';
		$layout_data['content_body'] = $this->load->view('pages/index', $data, true);
		$this->load->view('layouts/index', $layout_data);		
	}
	
}