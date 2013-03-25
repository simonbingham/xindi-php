<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller 
{

	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I instantiate this class
	 * @access public
	 * @return void
	 */	
	function __construct()
	{
		parent::__construct();
		parent::redirect_to_login_form_if_not_logged_in();	
	}

	/**
	 * I display the dashboard
	 * @access public
	 * @return void
	 */	
	function index()
	{
		$layout_data['content_body'] = $this->load->view('main/index', '', true);
		$this->load->view('layouts/index', $layout_data);
	}
}