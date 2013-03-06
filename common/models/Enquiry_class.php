<?php
class Enquiry_class extends MY_Model 
{
	
	private $tbl = 'enquiries';

	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I initiate this class
	 */	
	function __construct() 
	{
		parent::__construct();
	}

	/**
	 * I delete an enquiry matching an id
	 *
	 * @access   public
	 * @param    integer   enquiry id
	 * @return   void
	 */
	function delete_enquiry($id) 
	{
		parent::delete($this->tbl, $id);
	}	

	/**
	 * I return an enquiry matching an id
	 *
	 * @access   public
	 * @return   array   enquiry
	 */
	function get_enquiry_by_id($id)
	{
		return parent::get_by_id($this->tbl, $id);
	}
		
	/**
	 * I return an array of enquiries
	 *
	 * @access   public
	 * @return   array   enquiries
	 */
	function get_enquiries() 
	{
		return parent::get($this->tbl, 'created', 'desc');
	}
	
	/**
	 * I return a count of unread enquiries
	 *
	 * @return   integer   unread enquiry count
	 */	
	function get_unread_count()
	{
		$qry = $this->db->get_where($this->tbl, array('read'=>FALSE));
		return $qry->num_rows(); 
	}
	
	/**
	 * I mark enquiries as read
	 *
	 * @access   public
	 * @param    array     array of enquiry ids
	 * @return   integer   count of affected rows
	 */
	function mark_read($id) 
	{
		$data = array('read' => TRUE);
		$this->db->where_in('id', $id);
		$this->db->update($this->tbl, $data);
		return $this->db->affected_rows();
	}
	
}