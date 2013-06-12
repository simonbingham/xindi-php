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
		parent::redirect_to_login_form($this->session);
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
		if (! $id)
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
		if ($id) 
		{	
			$page = $this->Page_class->get_page_by_id($id)->row();
			if (is_null($page)) 
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
			$page['ancestor_id'] = $ancestor_id;
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
			$data = parent::populate($this->input->post(), array('id', 'title', 'content', 'meta_generated', 'meta_title', 'meta_description', 'meta_keywords', 'context'), array('ancestor_id'=>0, 'depth'=>0, 'left_value'=>0, 'right_value'=>0, 'meta_generated'=>FALSE));
			// flash data can only be used with redirects so we can't use it here
			$data['message'] = array('type'=>'error', 'text'=>'Please amend the highlighted fields.');
			$data['context'] = $context;
			$layout_data['content_body'] = $this->load->view('pages/maintain', $data, true);
			$this->load->view('layouts/index', $layout_data);
		}
		// validation success
		else 
		{
			$id = intval($this->input->post('id'));
			if ($id)
			{
				$page = parent::populate($this->input->post(), array('title', 'content', 'meta_generated', 'meta_title', 'meta_description', 'meta_keywords'), array('meta_generated'=>FALSE));
				$id = $this->Page_class->save_page($page, $id);
			}
			else
			{
				$page = parent::populate($this->input->post(), array('title', 'content', 'meta_generated', 'meta_title', 'meta_description', 'meta_keywords'), array('meta_generated'=>FALSE));
				$ancestor_id = $this->input->post('ancestor_id');
				$id = $this->Page_class->save_page($page, $id, $ancestor_id);				
			}
			$message = array('type'=>'success', 'text'=>'The page has been saved.');
			$this->session->set_flashdata($message);
			if ($this->input->post('submit') === 'Save & continue')
			{
				redirect('pages/maintain/'.$id, 'refresh');
			}
			else
			{
				redirect('pages/index/', 'refresh');
			}
		}
	}
	
	/**
	 * I display a list of pages that can be sorted
	 * @access public
	 * @param integer $id ancestor id
	 * @return void
	 */	
	function sort($id)
	{
		$data['pages'] = $this->Page_class->get_children($id)->result();
		$layout_data['content_body'] = $this->load->view('pages/sort', $data, true);
		$this->load->view('layouts/index', $layout_data);
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
				'field' => 'meta_title',
				'label' => 'meta_title',
				'rules' => 'trim|max_length[69]|xss_clean'
			),
			array(
				'field' => 'meta_description',
				'label' => 'meta_description',
				'rules' => 'trim|max_length[169]|xss_clean'
			),
			array(
				'field' => 'meta_keywords',
				'label' => 'meta_keywords',
				'rules' => 'trim|max_length[169]|xss_clean'
			)
		);
		return $rules;
	}

}