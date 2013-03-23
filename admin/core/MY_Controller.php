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
		$this->load->add_package_path('../common/');
		$this->load->helper(array('custom', 'url'));
		$this->load->library(array('session','form_validation'));
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		
		// append debug information to page
		$enable_profiler = $this->config->item('enable_profiler');
		$this->output->enable_profiler($enable_profiler);
	}
	
	// ------------------------ PROTECTED METHODS ------------------------ //
	
	/**
	 * I populate an array with required fields for a record
	 *
	 * @access   protected
	 * @param    array   form data
	 * @param    array   required fields
	 * @param    array   default values (optional)
	 * @return   array   populated array
	 * @todo     lack of support for multiple inheritance in PHP 4 means this method is duplicated in the public application (not nice!)
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
			if(! array_key_exists($key, $result))
			{
				$result[$key] = $value;
			}
		}
		return $result;
	}

}