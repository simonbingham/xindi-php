<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends MY_Controller 
{

	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I instantiate this class
	 */
	function __construct() 
	{
		parent::__construct();
		$this->load->helper('security');
		$this->load->model('User_class');
	}

	/**
	 * I display a login form
	 */	
	function index() 
	{
		if ($this->session->userdata('is_logged_in'))
		{
			redirect('main/index/');
		}
		$layout_data['content_body'] = $this->load->view('security/index', array(), true);
		$this->load->view('layouts/index', $layout_data);
	}

	/**
	 * I process a user login
	 */	
	function dologin()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$password = do_hash($password, 'md5');
		$user = $this->User_class->get_user_by_credentials($email, $password)->row();
		if(empty($user))
		{
			$message = array('type'=>'error', 'text'=>'Sorry, no user accounts were found matching the email address and password you entered.');
			$this->session->set_flashdata($message);
			redirect('security/index/','refresh');			
		}
		else
		{
			$array_items = array('is_logged_in'=>TRUE, 'id'=>$user->id, 'name'=>$user->name, 'email'=>$user->email);
			$this->session->set_userdata($array_items);
			$message = array('type'=>'success', 'text'=>'Welcome ' . $user->name . '. You have been logged in.');
			$this->session->set_flashdata($message);
			redirect('main/index/','refresh');			
		}
	}

	/**
	 * I process a user logout
	 */
	function dologout()
	{
		$array_items = array('is_logged_in'=>'', 'name'=>'', 'email'=>'');
		$this->session->unset_userdata($array_items);
		$message = array('type'=>'success', 'text'=>'You have been logged out.');
		$this->session->set_flashdata($message);
		redirect('security/index/','refresh');
	}	

}