<?php
class Search_class extends MY_Model 
{
	
	private $tbl_pages = 'pages';
	private $tbl_articles = 'articles';

	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I initiate this class
	 * @access public
	 * @return void
	 */	
	function __construct() 
	{
		parent::__construct();
	}

	/**
	 * I return records matching a search term
	 * @access public
	 * @param string $search_term
	 * @param array $search_result_exclusions the slugs of pages to exclude from search results
	 * @return array
	 */
	function get_search_results($search_term, $search_result_exclusions) 
	{
		$search_term = $this->db->escape_str($search_term);
		return $this->db->query('
			SELECT id, slug, title, content, \'page\' AS type
			FROM ' . $this->tbl_pages . '
			WHERE 1 = 1
			AND FIND_IN_SET(slug, \'' . implode(',',$search_result_exclusions) . '\') = 0
			AND (
				title LIKE \'%' . $search_term . '%\'
				OR content LIKE \'%' . $search_term . '%\'
			)	
			UNION
			SELECT id, slug, title, content, \'article\' AS type
			FROM ' . $this->tbl_articles . '
			WHERE title LIKE \'%' . $search_term . '%\'
				OR content LIKE \'%' . $search_term . '%\'

			ORDER BY title
		');
	}
	
}