<?php
class User_class extends MY_Model 
{
	
	private $tbl = 'users';

	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I initiate this class
	 */	
	function __construct() 
	{
		parent::__construct();
	}

	/**
	 * I deletes a user matching an id
	 *
	 * @access   public
	 * @param    integer   user id
	 * @return   void
	 */
	function delete_user($id) 
	{
		parent::delete($this->tbl, $id);
	}	

	/**
	 * I return a user matching a username and password
	 *
	 * @access   public
	 * @param    string   email address
	 * @param    string   password
	 * @return   array    user
	 */
	function get_user_by_credentials($email, $password)
	{
		return $this->db->get_where($this->tbl, array('email'=>$email, 'password'=>$password), 1);
	}	
	
	/**
	 * I return a user matching an id
	 *
	 * @access   public
	 * @param    integer   user id
	 * @return   array     user
	 */
	function get_user_by_id($id) 
	{
		return parent::get_by_id($this->tbl, $id);
	}
		
	/**
	 * I return an array of users
	 *
	 * @access   public
	 * @return   array   users
	 */
	function get_users() 
	{
		return parent::get($this->tbl, 'name', 'asc');
	}
	
	/**
	 * I return a new user
	 *
	 * @access   public
	 * @return   array   user
	 */
	function new_user() 
	{
		$user = array(
			'id' => '',
			'name' => '',
			'email' => '',
			'password' => ''
		);
		return $user;
	}
	
	/**
	 * I save a user and return the id
	 *
	 * @access   public
	 * @param    array     user
	 * @param    integer   user id (optional)
	 * @return   integer
	 */
	function save_user($user, $id=0) 
	{
		return parent::save($this->tbl, $user, $id);
	}
	
}