<?php
class Page_class extends MY_Model 
{
	
	private $tbl = 'pages';

	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I initiate this class
	 */	
	function __construct() 
	{
		parent::__construct();
	}

	/**
	 * I delete a page matching an id
	 *
	 * @access	public
	 * @param	integer		page id
	 * @return	void
	 */
	function delete_page($id) 
	{
		parent::delete($this->tbl, $id);
	}	

	/**
	 * I return an page matching an id
	 *
	 * @access	public		page id
	 * @return	array		page
	 */
	function get_page_by_id($id)
	{
		return parent::get_by_id($this->tbl, $id);
	}
	
	/**
	 * I return a page matching a slug
	 *
	 * @access	protected
	 * @param	string		table name
	 * @param	slug		page slug
	 * @return	array		page
	 */
	protected function get_by_slug($tbl, $slug) 
	{
		$this->db->where('slug', $slug);
		return $this->db->get($tbl);
	}	
		
	/**
	 * I return an array of pages
	 *
	 * @access	public
	 * @return	array		pages
	 */
	function get_pages() 
	{
		return parent::get($this->tbl, 'leftvalue');
	}
	
	/**
	 * I return a new page
	 *
	 * @access	public
	 * @return	array		page
	 */
	function new_page() 
	{
		$page = array(
			'id' => '',
			'slug' => '',
			'leftvalue' => '',
			'rightvalue' => '',
			'ancestorid' => '',
			'depth' => '',
			'title' => '',
			'content' => '',
			'metagenerated' => FALSE,
			'metatitle' => '',
			'metadescription' => '',
			'metakeywords' => ''
		);
		return $page;
	}
	
	/**
	 * I save a page and return the id
	 *
	 * @access	public
	 * @param	array		page
	 * @param 	integer		page id (optional)
	 * @return	integer		page id
	 */
	function save_page($page, $id=0) 
	{
		// new page so generate slug
		if(! $id) 
		{
			$page['slug'] = parent::generate_slug($this->tbl, $page['title']);
			// TODO: update left and right values of other pages
		}
		// generate meta tags
		if($page['metagenerated'])
		{
			$page['metatitle'] = parent::generate_page_title($page['title']);
			$page['metadescription'] = parent::generate_meta_description($page['content']);
			$page['metakeywords'] = parent::generate_meta_keywords($page['content']);
		}
		return parent::save($this->tbl, $page, $id);
	}
	
}