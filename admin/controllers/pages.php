<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller
{

	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I instantiate this class
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('Page_class');
	}

	/**
	 * I delete a page
	 *
	 * @param   integer   page id
	 */
	function delete($id=0)
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
	 */	
	function index()
	{
		$data['pages'] = $this->Page_class->get_pages()->result();
		$layout_data['content_body'] = $this->load->view('pages/index', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}

	/**
	 * I display a page form
	 *
	 * @param   integer   page id (optional)
	 * @param   integer   ancestor id (optional)
	 */
	function maintain($id=0, $ancestorid=0)
	{
		$id = intval($id);
		$ancestorid = intval($ancestorid);
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
			$page['ancestorid'] = $ancestorid;
			$data = $page;
			$data['context'] = 'create';
		}
		$layout_data['content_body'] = $this->load->view('pages/maintain', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}

	/**
	 * I save a page
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
	 *
	 * @access   private
	 * @return   array   validation rules
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