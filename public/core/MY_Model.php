<?php
class MY_Model extends CI_Model 
{
	
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

	// ------------------------ PROTECTED METHODS ------------------------ //
	
	/**
	 * I return an array of records
	 * @access protected
	 * @param string $tbl
	 * @param string $sort_col
	 * @param string $sort_dir
	 * @param integer $limit (optional)
	 * @return array
	 */
	protected function get($tbl, $sort_col, $sort_dir, $limit=NULL)
	{
		$this->db->order_by($sort_col, $sort_dir);
		return $this->db->get($tbl, $limit);
	}	
	
	/**
	 * I return a record matching a slug
	 * @access protected
	 * @param string $tbl
	 * @param string $slug
	 * @return array
	 */
	protected function get_by_slug($tbl, $slug)
	{	
		$this->db->where('slug', $slug);
		return $this->db->get($tbl);	
	}
	
	/**
	 * I save a record and return the id
	 * @access protected
	 * @param string $tbl
	 * @param array $data 
	 * @param integer $id
	 * @return integer
	 */
	protected function save($tbl, $data, $id=0) 
	{
		$id = intval($id);
		$current_date = date("Y-m-d H:i:s");
		$data['updated'] = $current_date;
		// new record 
		if (! $id) 
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
	 * I convert a string to MySQL timestamp
	 * @access protected
	 * @param string $date the date in 'dd/mm/yyyy' format
	 * @return date
	 */
	protected function string_to_timestamp($date) 
	{
		$date = str_replace('/', '-', $date);
		return date("Y-m-d H:i:s", strtotime($date));
	}
	
}