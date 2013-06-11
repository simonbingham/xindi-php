<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends MY_Controller 
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
		$this->load->helper('security');
		$this->load->model('User_class');
	}

	/**
	 * I display a login form
	 * @access public
	 * @return void
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
	 * @access public
	 * @return void
	 */	
	function do_login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$password = do_hash($password, 'md5');
		$user = $this->User_class->get_user_by_credentials($email, $password)->row();
		if (empty($user))
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
	 * @access public
	 */
	function do_logout()
	{
		$this->session->sess_destroy();
		// flash data can only be used with redirects so we can't use it here
		$data['message'] = array('type'=>'success', 'text'=>'You have been logged out.');
		$layout_data['content_body'] = $this->load->view('security/index', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}
	
	/**
	 * I display a forgotten password form
	 * @access public
	 * @return void
	 */	
	function forgotten_password() 
	{
		$layout_data['content_body'] = $this->load->view('security/forgottenpassword', array(), true);
		$this->load->view('layouts/index', $layout_data);
	}
	
	/**
	 * I process a forgotten password form
	 * @access public
	 * @return void
	 */	
	function do_forgotten_password()
	{
		$email = $this->input->post('email');
		$user = $this->User_class->get_user_by_email($email)->result_array();
		if (empty($user))
		{
			$message = array('type'=>'error', 'text'=>'Sorry, no user accounts were found matching &quot;' . $email . '&quot;.');
			$this->session->set_flashdata($message);
			redirect('security/forgotten_password/','refresh');			
		}
		else
		{
			// generate new password and save to database
			$user = $user[0];
			$password_not_hashed = $this->User_class->generate_password();
			$password_hashed = do_hash($password_not_hashed, 'md5');
			$user['password'] = $password_hashed;
			$id = $user['id'];
			$this->User_class->save_user($user, $id);
			
			// email new password to user
			$this->load->library('email');
			$this->email->from($this->config->item('forgotten_password_from_email'), $this->config->item('forgotten_password_from_name'));
			$this->email->to($this->config->item($user['email']));
			$this->email->subject($this->config->item('forgotten_password_subject'));
			$this->email->message($this->load->view('security/email', array('password'=>$password_not_hashed), true));
			$this->email->send();
			/*
			echo $this->email->print_debugger();
			die();
			*/
			
			// display confirmation message
			$message = array('type'=>'success', 'text'=>'A new password has been sent to ' . $user['email'] . '.');
			$this->session->set_flashdata($message);
			redirect('security/index/','refresh');
		}
	}	

}