<?php
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
	 * I return an array of records
	 *
	 * @access   protected
	 * @param    string   table name
	 * @param    string   name of column to sort by
	 * @param    string   sort direction (asc or desc)
	 * @return   array    records
	 * @todo     lack of support for multiple inheritance in PHP 4 means this method is duplicated in the admin application (not nice!)
	 */
	protected function get($tbl, $sortcol, $sortdir)
	{
		$this->db->order_by($sortcol,$sortdir);
		return $this->db->get($tbl);
	}	
	
	/**
	 * I return a record matching a slug
	 *
	 * @access   protected
	 * @param    string    table name
	 * @param    string    record slug
	 * @return   array     record
	 */
	protected function get_by_slug($tbl, $slug)
	{	
		$this->db->where('slug', $slug);
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
	 * @todo     lack of support for multiple inheritance in PHP 4 means this method is duplicated in the admin application (not nice!)
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
	 * @todo     lack of support for multiple inheritance in PHP 4 means this method is duplicated in the admin application (not nice!)
	 */
	protected function string_to_timestamp($date) 
	{
		$date = str_replace('/', '-', $date);
		return date("Y-m-d H:i:s", strtotime($date));
	}
	
}