<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller 
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
			redirect('security/index/','refresh');
		}		
		
		$this->load->model('User_class');
	}

	/**
	 * I delete a user
	 *
	 * @param   integer   user id
	 */
	function delete($id=0)
	{
		$id = intval($id);
		if(! $id)
		{
			$message = array('type'=>'error', 'text'=>'Sorry, the user could not be found.');
			$this->session->set_flashdata($message);			
			redirect('users/index/','refresh');
		}
		$this->User_class->delete_user($id);
		$message = array('type'=>'success', 'text'=>'The user has been deleted.');
		$this->session->set_flashdata($message);
		redirect('users/index/','refresh');
	}	

	/**
	 * I display a list of users
	 */	
	function index() 
	{
		$data['users'] = $this->User_class->get_users()->result();
		$layout_data['content_body'] = $this->load->view('users/index', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}

	/**
	 * I display a user form
	 *
	 * @param   integer   user id (optional)
	 */
	function maintain($id=0) 
	{
		$id = intval($id);
		// existing user
		if($id) 
		{	
			$user = $this->User_class->get_user_by_id($id)->row();
			if(is_null($user)) 
			{
				$message = array('type'=>'error', 'text'=>'Sorry, the user could not be found.');
				$this->session->set_flashdata($message);
				redirect('users/index/','refresh');
			}
			$data['id'] = $id;
			$data = array_merge((array)$data, (array)$user);
			$data['context'] = 'update';
		// new user
		} 
		else 
		{
			$data = $this->User_class->new_user();
			$data['context'] = 'create';
		}
		$layout_data['content_body'] = $this->load->view('users/maintain', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}

	/**
	 * I save a user
	 */	
	function save() 
	{
		$context = $this->input->post('context');
		$validate_password = FALSE;
		// if user is being created, or updated and a password is specified, validate the password
		if($context === 'create' || ($context === 'update' && strlen(trim($this->input->post('password')))))
		{
			$validate_password = TRUE;
		}
		$validation_rules = $this->get_validation_rules($validate_password);
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run() === FALSE) 
		{
			$data = parent::populate($this->input->post(), array('id', 'name', 'email', 'password', 'context'));
			// flash data can only be used with redirects so we can't use it here
			$data['message'] = array('type'=>'error', 'text'=>'Please amend the highlighted fields.');
			$layout_data['content_body'] = $this->load->view('users/maintain', $data, true);
			$this->load->view('layouts/index', $layout_data);
		}
		else
		{
			$id = intval($this->input->post('id'));
			$user = parent::populate($this->input->post(), array('id', 'name', 'email', 'password'));
			$id = $this->User_class->save_user($user, $id);
			$message = array('type'=>'success', 'text'=>'The user has been saved.');
			$this->session->set_flashdata($message);
			if($this->input->post('submit') === 'Save & continue')
			{
				redirect('users/maintain/'.$id, 'refresh');
			}
			else
			{
				redirect('users/index/', 'refresh');
			}			
		}
	}
	
	// ------------------------ PRIVATE METHODS ------------------------ //
	
	/**
	 * I return the validation rules
	 *
	 * @access   private
	 * @param    boolean   true if password needs to be validated		
	 * @return   array     validation rules
	 */
	private function get_validation_rules($validate_password) 
	{
		$rules = array(
			array(
				'field' => 'name',
				'label' => 'name',
				'rules' => 'trim|required|max_length[50]|xss_clean'
			),
			// TODO: check email address is unique
			array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'trim|required|max_length[100]|valid_email|xss_clean'
			)
		);
		if($validate_password) 
		{
			array_push(
				$rules,
				array(
					'field' => 'password',
					'label' => 'password',
					'rules' => 'trim|required|min_length[8]|md5|xss_clean'
				)
			);
		}
		return $rules;
	}

}