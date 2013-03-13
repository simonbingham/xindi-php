<?php
class Article_class extends MY_Model 
{
	
	private $tbl = 'articles';

	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I initiate this class
	 */	
	function __construct() 
	{
		parent::__construct();
	}

	/**
	 * I delete an article matching an id
	 *
	 * @access   public
	 * @param    integer   article id
	 * @return   void
	 */
	function delete_article($id) 
	{
		parent::delete($this->tbl, $id);
	}	

	/**
	 * I return an article matching an id
	 *
	 * @access   public   article id
	 * @return   array    article
	 */
	function get_article_by_id($id)
	{
		return parent::get_by_id($this->tbl, $id);
	}
	
	/**
	 * I return an article matching a slug
	 *
	 * @access   public   article slug
	 * @return   array    article
	 */
	function get_article_by_slug($slug)
	{
		return parent::get_by_slug($this->tbl, $slug);
	}
		
	/**
	 * I return an array of articles
	 *
	 * @access   public
	 * @return   array   articles
	 */
	function get_articles() 
	{
		return parent::get($this->tbl, 'published', 'desc');
	}
	
	/**
	 * I return a new article
	 *
	 * @access   public
	 * @return   array   article
	 */
	function new_article() 
	{
		$article = array(
			'id' => '',
			'title' => '',
			'content' => '',
			'metagenerated' => FALSE,
			'metatitle' => '',
			'metadescription' => '',
			'metakeywords' => '',
			'author' => '',
			'published' => ''
		);
		return $article;
	}
	
	/**
	 * I save a article and return the id
	 *
	 * @access   public
	 * @param    array     article
	 * @param    integer   article id (optional)
	 * @return   integer   article id
	 */
	function save_article($article, $id=0) 
	{
		$article['published'] = parent::string_to_timestamp($article['published']);
		// new article so generate slug
		if(! $id) 
		{
			$article['slug'] = parent::generate_slug($this->tbl, $article['title']);
		}
		// generate meta tags
		if($article['metagenerated'])
		{
			$article['metatitle'] = parent::generate_page_title($article['title']);
			$article['metadescription'] = parent::generate_meta_description($article['content']);
			$article['metakeywords'] = parent::generate_meta_keywords($article['content']);
		}
		return parent::save($this->tbl, $article, $id);
	}
	
}