<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller 
{

	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I instantiate this class
	 */	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * I display the welcome page
	 */	
	function index()
	{
		$layout_data['content_body'] = $this->load->view('main/index', '', true);
		$this->load->view('layouts/index', $layout_data);
	}
}