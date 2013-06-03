<?php
class Enquiry_class extends MY_Model 
{
	
	private $tbl = 'enquiries';

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
	 * I delete an enquiry matching an id
	 * @access public
	 * @param integer $id
	 * @return void
	 */
	function delete_enquiry($id) 
	{
		parent::delete($this->tbl, $id);
	}	

	/**
	 * I return an enquiry matching an id
	 * @access public
	 * @param integer $id
	 * @return array
	 */
	function get_enquiry_by_id($id)
	{
		return parent::get_by_id($this->tbl, $id);
	}
		
	/**
	 * I return an array of enquiries
	 * @access public
	 * @return array
	 */
	function get_enquiries() 
	{
		return parent::get($this->tbl, 'created', 'desc');
	}
	
	/**
	 * I return a count of unread enquiries
	 * @access public
	 * @return integer
	 */	
	function get_unread_count()
	{
		$qry = $this->db->get_where($this->tbl, array('is_read'=>FALSE));
		return $qry->num_rows(); 
 	}
	
	/**
	 * I mark an enquiry as read
	 * @access public
	 * @param integer $id
	 * @return integer
	 */
	function mark_read($id) 
	{
		$data = array('is_read' => TRUE);
		$this->db->where('id', $id);
		$this->db->update($this->tbl, $data);
		return $this->db->affected_rows();
	}
	
	/**
	 * I return a new enquiry
	 * @access public
	 * @return array
	 */
	function new_enquiry()
	{
		$enquiry = array(
			'name' => '',
			'email' => '',
			'message' => ''
		);
		return $enquiry;
	}

	/**
	 * I save an enquiry
	 * @access public
	 * @param array $enquiry
	 * @return void
	 */
	function save_enquiry($enquiry)
	{
		$enquiry['is_read'] = FALSE;
		parent::save($this->tbl, $enquiry);
	}	
	
}