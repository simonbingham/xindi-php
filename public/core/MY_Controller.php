<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
	
	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I initiate this class
	 */	
	function __construct() 
	{
		parent::__construct();
		$this->load->add_package_path('common/');
		$this->load->helper(array('custom','url'));
		$this->load->database();
		$this->load->model('Page_class');
		$this->navigation = $this->Page_class->get_navigation(TRUE);
		
		// append debug information to page
		$enable_profiler = $this->config->item('enable_profiler');
		$this->output->enable_profiler($enable_profiler);
		
	}
	
}