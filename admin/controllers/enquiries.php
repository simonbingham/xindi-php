<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiries extends MY_Controller
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
		
		// if the user is not logged in redirect them to the login form
		if(! $this->session->userdata('is_logged_in'))
		{
			$message = array('type'=>'error', 'text'=>'Sorry, you must be logged in to maintain your site.');
			$this->session->set_flashdata($message);
			redirect('security/index/','refresh');
		}		
	}

	/**
	 * I delete an enquiry
	 * @access public
	 * @param integer $id
	 * @return void
	 */
	function delete($id)
	{
		$id = intval($id);
		if(! $id)
		{
			$message = array('type'=>'error', 'text'=>'Sorry, the enquiry could not be found.');
			$this->session->set_flashdata($message);
			redirect('enquiries/index/','refresh');
		}
		$this->Enquiry_class->delete_enquiry($id);
		$message = array('type'=>'success', 'text'=>'The enquiry has been deleted.');
		$this->session->set_flashdata($message);
		redirect('enquiries/index/','refresh');
	}	

	/**
	 * I display an enquiry
	 * @access public
	 * @param integer $id (optional)
	 * @return void
	 */
	function enquiry($id=0)
	{
		$id = intval($id);
		if(! $id)
		{
			$message = array('type'=>'error', 'text'=>'Sorry, the enquiry could not be found.');
			$this->session->set_flashdata($message);
			redirect('enquiries/index/','refresh');
		}
		$this->Enquiry_class->mark_read($id);
		$data['enquiry'] = $this->Enquiry_class->get_enquiry_by_id($id)->row();
		$layout_data['content_body'] = $this->load->view('enquiries/enquiry', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}
		
	/**
	 * I display a list of enquiries
	 * @access public
	 * @return void
	 */	
	function index()
	{
		$data['unread_count'] = $this->Enquiry_class->get_unread_count();
		$data['enquiries'] = $this->Enquiry_class->get_enquiries()->result();
		$layout_data['content_body'] = $this->load->view('enquiries/index', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}

	/**
	 * I mark enquiries as read
	 * @access public
	 * @return void
	 */
	function mark_read()
	{
		$id = $this->input->post('id');
		$affectedrows = $this->Enquiry_class->mark_read($id);
		if($affectedrows == 1)
		{
			$message = array('type'=>'success', 'text'=>'The enquiry has been marked as read.');
		}
		else if($affectedrows > 1)
		{
			$message = array('type'=>'success', 'text'=>'The enquiries have been marked as read.');
		}
		else
		{
			$message = array('type'=>'error', 'text'=>'Please select at least one <em>unread</em> enquiry.');
		}
		$this->session->set_flashdata($message);
		redirect('enquiries/index/','refresh');
	}
	
}