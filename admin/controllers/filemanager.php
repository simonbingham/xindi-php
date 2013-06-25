<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Filemanager extends MY_Controller 
{
	private $file_path_delimiter = '~';
	
	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I instantiate this class
	 * @access public
	 * @return void
	 */	
	function __construct()
	{
		parent::__construct();
		parent::redirect_to_login_form($this->session);
	}

	/**
	 * I display the file manager
	 * @access public
	 * @return void
	 */	
	function index()
	{
		$this->load->helper('file');
		$paths['default'] = '../_uploads'; // relative path to uploads directory from index.php file
		$paths['current'] = $paths['default'];

		// check whether sub directory is selected
		if ($this->uri->segment(4) !== false)
		{
			$paths['current'] = $this->decode_path($paths['default'], $this->uri->segment(4));
		}
		
		// get directories and files in current directory
		$data['map'] = get_dir_file_info($paths['current'], $top_level_only = TRUE);

		// get parent directory path
		$paths['parent'] = $this->get_parent_path($paths['default'], $paths['current']);

		// set path that is displayed on screen
		$paths['display'] = $this->get_display_path($paths['default'], $paths['current']);
		
		$data['paths'] = $paths;
		$data['file_path_delimiter'] = $this->file_path_delimiter;
		$layout_data['content_body'] = $this->load->view('filemanager/index', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}
	
	// ------------------------ PRIVATE METHODS ------------------------ //

	/**
	 * I decode an encoded url segment
	 * @access private
	 * @param string $default_path
	 * @param string $segment
	 * @return string
	 */		
	private function decode_path($default_path, $segment) 
	{
		$path = urldecode($segment);
		return $default_path . preg_replace('/' . $this->file_path_delimiter . '/', '/', $path);		
	}
	
	/**
	 * I return a tidied path that can be displayed to the user
	 * @access private
	 * @param string $default_path
	 * @param string $current_path
	 * @return string
	 */		
	private function get_display_path($default_path, $current_path)
	{
		$display_path = str_replace($default_path, '', $current_path);
		return $display_path === '' ? '/' : $display_path;		
	}
	
	/**
	 * I return the parent path of a given directory
	 * @access private
	 * @param string $default_path
	 * @param string $current_path
	 * @return string
	 */	
	private function get_parent_path($default_path, $current_path)
	{
		$array = explode('/', $current_path);
		array_pop($array);
		$parent_path = implode('/', $array);
		return $parent_path === $default_path ? '' : $parent_path;
	}
}