<?php
// TODO: duplicate of MY_Model in admin directory - need to remove
class MY_Model extends CI_Model 
{
	
	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I initiate this class
	 */	
	function __construct() 
	{
		parent::__construct();
	}

	// ------------------------ PROTECTED METHODS ------------------------ //
	
	/**
	 * I delete a record matching an id
	 *
	 * @access   protected
	 * @param    string    table name
	 * @param    integer   record id
	 * @return   void
	 */
	protected function delete($tbl, $id) 
	{
		$this->db->where('id', $id);
		$this->db->delete($tbl);
	}
	
	/**
	 * I generate a meta description
	 *
	 * @access   protected
	 * @param    string   string to be converted
	 * @return   string   meta description
	 */
	protected function generate_meta_description($str)
	{
		return 
			// return first 200 spaces
			substr(
				// replace multiple spaces with a single space
				$this->replace_multiple_spaces_with_single_space(
					// remove HTML tags
					strip_tags($str)
				), 0 , 169 
			);
	}
	
	/**
	 * I generate meta keywords
	 *
	 * @access   protected
	 * @param    string   string to be converted
	 * @return   string   meta keywords
	 */
	protected function generate_meta_keywords($str)
	{
		return 
			// return first 200 characters
			substr(
				// remove duplicate words
				implode(',', array_unique(explode(',',
					// remove special characters
					preg_replace('/[^a-zA-Z0-9\,\']/','',
						// replace spaces with commas
						str_replace(' ',',',
							// remove commas
							str_replace(',','',
								// replace multiple spaces with a single space
								$this->replace_multiple_spaces_with_single_space(
									// remove HTML tags
									strip_tags($str)
								)
							)
						)
					)
				)))
			, 0 , 169 );
	}
	
	/**
	 * I generate a page title
	 *
	 * @access   protected
	 * @param    string   string to be converted
	 * @return   string   page title
	 */
	protected function generate_page_title($str)
	{
		return
			// return first 100 spaces
			substr(
				// replace multiple spaces with a single space
				$this->replace_multiple_spaces_with_single_space(
					// remove HTML tags
					strip_tags($str)
				), 0 , 69
			);
	}	
	
	/**
	 * I generate a slug for the record
	 *
	 * @access   protected
	 * @param    string   table name
	 * @param    string   page title
	 * @param    string   ancestor slug
	 * @return   string   generated slug
	 */
	protected function generate_slug($tbl, $title, $ancestor_slug='')
	{
		$title = strtolower(trim($title));
		$ancestor_slug = trim($ancestor_slug);
		$slug = '';
		if(strlen($ancestor_slug)) 
		{
			$slug .= $ancestor_slug . '/';
		}
		$slug .= preg_replace("/[^a-zA-Z0-9.]/", "-", $title);
		// ensure slug is unique
		while ($this->is_slug_unique($tbl, $slug) === false)
		{
			$slug .= "-";
		}
		return $slug;
	}	
		
	/**
	 * I return an array of records
	 *
	 * @access   protected
	 * @param    string   table name
	 * @param    string   name of column to sort by
	 * @param    string   sort direction (asc or desc)
	 * @return   array    records
	 */
	protected function get($tbl, $sortcol, $sortdir) 
	{
		$this->db->order_by($sortcol,$sortdir);
		return $this->db->get($tbl);
	}
	
	/**
	 * I return a record matching an id
	 *
	 * @access   protected
	 * @param    string    table name
	 * @param    integer   record id
	 * @return   array     record
	 */
	protected function get_by_id($tbl, $id) 
	{
		$this->db->where('id', $id);
		return $this->db->get($tbl);
	}
	
	/**
	 * I save a record and return the id
	 *
	 * @access   protected
	 * @param    string    table name
	 * @param    array     record to save 
	 * @param    integer   record id (optional)
	 * @return   integer   record id
	 */
	protected function save($tbl, $data, $id=0) 
	{
		$current_date = date("Y-m-d H:i:s");
		$data['updated'] = $current_date;
		// new record 
		if(! $id) 
		{
			$data['created'] = $current_date;
			$this->db->insert($tbl, $data);
			return $this->db->insert_id();			
		}
		// existing record 
		else 
		{
			$this->db->where('id', $id);
			$this->db->update($tbl, $data);
			return $id;
		}
	}

	/**
	 * I convert a string (in 'dd/mm/yyyy' format) to MySQL timestamp
	 *
	 * @access   protected
	 * @param    string   date (in 'dd/mm/yyyy' format)
	 * @return   date     date as timestamp
	 */
	protected function string_to_timestamp($date) 
	{
		$date = str_replace('/', '-', $date);
		return date("Y-m-d H:i:s", strtotime($date));
	}
	
	// ------------------------ PRIVATE METHODS ------------------------ //
	
	/**
	 * I return true if a slug is unique
	 *
	 * @access   private
	 * @param    string    table name
	 * @param    string    slug
	 * @return   boolean   true if slug is unique
	 */
	private function is_slug_unique($tbl, $slug)
	{
		$query = $this->db->get_where($tbl, array('slug' => $slug));
		return $query->num_rows() === 0;
	}
	
	/**
	 * I return a string with multiple spaces replaced with single spaces
	 *
	 * @access   private
	 * @param    string   string that may contain multiple spaces
	 * @return   string   string with multiple spaces removed
	 */	
	private function replace_multiple_spaces_with_single_space($str)
	{
		return preg_replace('/\s{2,}/', ' ', $str);
	}
	
}