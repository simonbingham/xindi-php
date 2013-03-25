<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller
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
		
		$this->load->model('Page_class');
	}

	/**
	 * I delete a page
	 * @access public
	 * @param integer $id
	 * @return void
	 */
	function delete($id)
	{
		$id = intval($id);
		if(! $id)
		{
			$message = array('type'=>'error', 'text'=>'Sorry, the page could not be found.');
			$this->session->set_flashdata($message);
			redirect('pages/index/','refresh');
		}
		$this->Page_class->delete_page($id);
		$message = array('type'=>'success', 'text'=>'The page has been deleted.');
		$this->session->set_flashdata($message);
		redirect('pages/index/','refresh');
	}	

	/**
	 * I display a list of pages
	 * @access public
	 * @return void
	 */	
	function index()
	{
		$data['pages'] = $this->Page_class->get_pages()->result();
		$layout_data['content_body'] = $this->load->view('pages/index', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}

	/**
	 * I display a page form
	 * @access public
	 * @param integer $id (optional)
	 * @param integer $ancestor_id (optional)
	 * @return void
	 */
	function maintain($id=0, $ancestor_id=0)
	{
		$id = intval($id);
		$ancestor_id = intval($ancestor_id);
		// existing page
		if($id) 
		{	
			$page = $this->Page_class->get_page_by_id($id)->row();
			if(is_null($page)) 
			{
				$message = array('type'=>'error', 'text'=>'Sorry, the page could not be found.');
				$this->session->set_flashdata($message);
				redirect('pages/index/','refresh');
			}
			$data['id'] = $id;
			$data = array_merge((array)$data, (array)$page);
			$data['context'] = 'update';
		} 
		// new page
		else
		{
			$page = $this->Page_class->new_page();
			$page['ancestorid'] = $ancestor_id;
			$data = $page;
			$data['context'] = 'create';
		}
		$layout_data['content_body'] = $this->load->view('pages/maintain', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}

	/**
	 * I save a page
	 * @access public
	 * @return void
	 */	
	function save() 
	{
		$context = $this->input->post('context');
		$validation_rules = $this->get_validation_rules();
		$this->form_validation->set_rules($validation_rules);
		// validation failure
		if ($this->form_validation->run() === FALSE) 
		{
			$data = parent::populate($this->input->post(), array('id', 'title', 'content', 'metagenerated', 'metatitle', 'metadescription', 'metakeywords', 'context'), array('metagenerated'=>FALSE));
			// flash data can only be used with redirects so we can't use it here
			$data['message'] = array('type'=>'error', 'text'=>'Please amend the highlighted fields.');
			$layout_data['content_body'] = $this->load->view('pages/maintain', $data, true);
			$this->load->view('layouts/index', $layout_data);
		}
		// validation success
		else 
		{
			$id = intval($this->input->post('id'));
			if($id)
			{
				$page = parent::populate($this->input->post(), array('title', 'content', 'metagenerated', 'metatitle', 'metadescription', 'metakeywords'), array('metagenerated'=>FALSE));
				$id = $this->Page_class->save_page($page, $id);
			}
			else
			{
				$page = parent::populate($this->input->post(), array('title', 'content', 'metagenerated', 'metatitle', 'metadescription', 'metakeywords'), array('metagenerated'=>FALSE));
				$ancestorid = $this->input->post('ancestorid');
				$id = $this->Page_class->save_page($page, $id, $ancestorid);				
			}
			$message = array('type'=>'success', 'text'=>'The page has been saved.');
			$this->session->set_flashdata($message);
			if($this->input->post('submit') === 'Save & continue')
			{
				redirect('pages/maintain/'.$id, 'refresh');
			}
			else
			{
				redirect('pages/index/', 'refresh');
			}
		}
	}
		
	// ------------------------ PRIVATE METHODS ------------------------ //
	
	/**
	 * I return the validation rules
	 * @access private
	 * @return array
	 */
	private function get_validation_rules() 
	{
		$rules = array(
			array(
				'field' => 'title',
				'label' => 'title',
				'rules' => 'trim|required|max_length[150]|xss_clean'
			),
			array(
				'field' => 'content',
				'label' => 'content',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'metatitle',
				'label' => 'metatitle',
				'rules' => 'trim|max_length[69]|xss_clean'
			),
			array(
				'field' => 'metadescription',
				'label' => 'metadescription',
				'rules' => 'trim|max_length[169]|xss_clean'
			),
			array(
				'field' => 'metakeywords',
				'label' => 'metakeywords',
				'rules' => 'trim|max_length[169]|xss_clean'
			)
		);
		return $rules;
	}

}