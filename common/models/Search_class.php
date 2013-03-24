<?php
class Search_class extends MY_Model 
{
	
	private $tbl_pages = 'pages';
	private $tbl_articles = 'articles';

	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I initiate this class
	 */	
	function __construct() 
	{
		parent::__construct();
	}

	/**
	 * I return records matching a search term
	 *
	 * @access   public
	 * @param    string   search term
	 * @param    array    slugs of pages to exclude from search results
	 * @return   array	  search results
	 * @todo     improve by looping through words in search term to find matching results and by applying weighting to the results
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