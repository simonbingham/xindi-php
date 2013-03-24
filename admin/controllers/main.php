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
		
		// if the user is not logged in redirect them to the login form
		if(! $this->session->userdata('is_logged_in'))
		{
			$message = array('type'=>'error', 'text'=>'Sorry, you must be logged in to maintain your site.');
			$this->session->set_flashdata($message);
			redirect('articles/index/','refresh');
		}		
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