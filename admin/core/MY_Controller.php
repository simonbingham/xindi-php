<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	
	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I initiate this class
	 * @access public
	 * @return void
	 */	
	function __construct() 
	{
		parent::__construct();
		$this->load->add_package_path('../common/');
		$this->load->database();
		$this->load->helper(array('custom', 'url'));
		$this->load->library(array('session','form_validation'));
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		
		// load enquiry count on every page request
		$this->load->model('Enquiry_class');
		$this->unread_enquiry_count = $this->Enquiry_class->get_unread_count();		
		
		// append debug information to page
		$enable_profiler = $this->config->item('enable_profiler');
		$this->output->enable_profiler($enable_profiler);
	}
	
	// ------------------------ PROTECTED METHODS ------------------------ //
	
	/**
	 * I populate an array with required fields for a record
	 * @access protected
	 * @param array $form_data
	 * @param array $required_fields
	 * @param array $field_defaults (optional)
	 * @return array
	 */
	protected function populate($form_data, $required_fields, $field_defaults=array())
	{
		$result = array();
		// populate result array with required fields
		foreach ($form_data as $key => $value)
		{
			if(in_array($key, $required_fields))
			{
				$result[$key] = $value;
			}
		}
		// populate result array with default values for missing fields
		foreach ($field_defaults as $key => $value)
		{
			if (! array_key_exists($key, $result))
			{
				$result[$key] = $value;
			}
		}
		return $result;
	}
	
	/**
	 * I redirect the user to the login form if they are not logged in
	 * @access protected
	 * @param object $session
	 * @return void
	 */	
	protected function redirect_to_login_form($session)
	{	
		$session = (array)$session; // convert session object to an array
		$user_data = $session['userdata'];
		
		// user is not logged in
		if (!isset($user_data['is_logged_in']))
		{
			$message = array('type'=>'error', 'text'=>'Sorry, you must be logged in to access the requested resource.');
			$this->session->set_flashdata($message);
			redirect('security/index/','refresh');
		}
	}

}