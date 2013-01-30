<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller 
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
	 * I display a list of pages
	 */	
	function index()
	{
		$layout_data['content_body'] = $this->load->view('pages/index', '', true);
		$this->load->view('layouts/index', $layout_data);
	}
}