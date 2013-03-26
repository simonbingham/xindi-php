<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends MY_Controller
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
		parent::redirect_to_login_form_if_not_logged_in();
		$this->load->model('Article_class');
	}

	/**
	 * I delete an article
	 * @access public
	 * @param integer $id
	 * @return void
	 */
	function delete($id)
	{
		$id = intval($id);
		if (! $id)
		{
			$message = array('type'=>'error', 'text'=>'Sorry, the article could not be found.');
			$this->session->set_flashdata($message);
			redirect('articles/index/','refresh');
		}
		$this->Article_class->delete_article($id);
		$message = array('type'=>'success', 'text'=>'The article has been deleted.');
		$this->session->set_flashdata($message);
		redirect('articles/index/','refresh');
	}	

	/**
	 * I display a list of articles
	 * @access public
	 * @return void
	 */	
	function index()
	{
		$data['articles'] = $this->Article_class->get_articles()->result();
		$layout_data['content_body'] = $this->load->view('articles/index', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}

	/**
	 * I display an article form
	 * @access public
	 * @param integer $id (optional)
	 * @return void
	 */
	function maintain($id=0)
	{
		$id = intval($id);
		// existing article
		if ($id) 
		{	
			$article = $this->Article_class->get_article_by_id($id)->row();
			if (is_null($article)) 
			{
				$message = array('type'=>'error', 'text'=>'Sorry, the article could not be found.');
				$this->session->set_flashdata($message);
				redirect('articles/index/','refresh');
			}
			$data['id'] = $id;
			$data = array_merge((array)$data, (array)$article);
			$data['context'] = 'update';
		} 
		// new article
		else
		{
			$data = $this->Article_class->new_article();
			$data['context'] = 'create';
		}
		$layout_data['content_body'] = $this->load->view('articles/maintain', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}

	/**
	 * I save an article
	 * @access public
	 * @return void
	 */	
	function save() 
	{
		$context = $this->input->post('context');
		$validation_rules = $this->get_validation_rules($context);
		$this->form_validation->set_rules($validation_rules);
		// validation failure
		if ($this->form_validation->run() === FALSE) 
		{
			$data = parent::populate($this->input->post(), array('id', 'title', 'content', 'meta_generated', 'meta_title', 'meta_description', 'meta_keywords', 'author', 'published', 'context'), array('meta_generated'=>FALSE));
			// flash data can only be used with redirects so we can't use it here
			$data['message'] = array('type'=>'error', 'text'=>'Please amend the highlighted fields.');
			$layout_data['content_body'] = $this->load->view('articles/maintain', $data, true);
			$this->load->view('layouts/index', $layout_data);
		}
		// validation success
		else 
		{
			$id = intval($this->input->post('id'));
			$article = parent::populate($this->input->post(), array('title', 'content', 'meta_generated', 'meta_title', 'meta_description', 'meta_keywords', 'author', 'published'), array('meta_generated'=>FALSE));
			$id = $this->Article_class->save_article($article, $id);
			$message = array('type'=>'success', 'text'=>'The article has been saved.');
			$this->session->set_flashdata($message);
			if ($this->input->post('submit') === 'Save & continue')
			{
				redirect('articles/maintain/'.$id, 'refresh');
			}
			else
			{
				redirect('articles/index/', 'refresh');
			}
		}
	}
	
	/**
	 * I validate a date
	 * @access public
	 * @param string $str the date in 'dd/mm/yyyy' format
	 * @return boolean
	 */
	function valid_date($str) 
	{
		$str = str_replace('/', '-', trim($str));
		$time = strtotime($str);
		if (date('d-m-Y', $time) === $str) 
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('valid_date', 'Enter a valid date in "dd/mm/yyyy" format.');
			return false;
		}
	}	
	
	// ------------------------ PRIVATE METHODS ------------------------ //
	
	/**
	 * I return the validation rules
	 * @access private
	 * @param string $context the context ('create' or 'update')
	 * @return array
	 */
	private function get_validation_rules($context='create') 
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
			),
			array(
				'field' => 'author',
				'label' => 'author',
				'rules' => 'trim|max_length[100]|xss_clean'
			),
			array(
				'field' => 'published',
				'label' => 'published',
				'rules' => 'trim|required|callback_valid_date|xss_clean'
			)
		);
		return $rules;
	}

}