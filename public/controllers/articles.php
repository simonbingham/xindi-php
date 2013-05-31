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
		$this->load->helper('text');
		$this->load->model('Article_class');
	}

	/**
	 * I display a list of articles
	 * @access public
	 * @return void
	 */	
	function index()
	{
		$data['articles'] = $this->Article_class->get_articles()->result();
		$data['meta_title'] = '';
		$data['meta_description'] = '';
		$data['meta_keywords'] = '';		
		$layout_data['content_body'] = $this->load->view('articles/index', $data, true);
		$this->load->view('layouts/index', $layout_data);
	}

	/**
	 * I display an article
	 * @access public
	 * @param string $slug
	 * @return void
	 */
	function article($slug)
	{
		$article = $this->Article_class->get_article_by_slug($slug)->row();
		if (! empty($article)) 
		{	
			$data['article'] = $article;
			$data['meta_title'] = $article->meta_title;
			$data['meta_description'] = $article->meta_description;
			$data['meta_keywords'] = $article->meta_keywords;
			$data['meta_author'] = $article->author;
			$layout_data['content_body'] = $this->load->view('articles/article', $data, true);
			$this->load->view('layouts/index', $layout_data);			
		} 
		else
		{
			show_404();
		}
	}

}