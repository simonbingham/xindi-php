<?php
class User_class extends MY_Model 
{
	
	private $tbl = 'users';

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
	 * I deletes a user matching an id
	 * @access public
	 * @param integer $id
	 * @return void
	 */
	function delete_user($id) 
	{
		parent::delete($this->tbl, $id);
	}	

	/**
	 * I generate a password
	 * @access public
	 * @return string
	 */	
	function generate_password() {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		return substr(str_shuffle($chars), 0, 8);
	}	
	
	/**
	 * I return a user matching an email address and password
	 * @access public
	 * @param string $email
	 * @param string $password
	 * @return array
	 */
	function get_user_by_credentials($email, $password)
	{
		return $this->db->get_where($this->tbl, array('email'=>$email, 'password'=>$password), 1);
	}	
	
	/**
	 * I return a user matching an email address
	 * @access public
	 * @param string $email
	 * @return array
	 */
	function get_user_by_email($email)
	{
		return $this->db->get_where($this->tbl, array('email'=>$email), 1);
	}	
	
	/**
	 * I return a user matching an id
	 * @access public
	 * @param integer $id
	 * @return array
	 */
	function get_user_by_id($id) 
	{
		return parent::get_by_id($this->tbl, $id);
	}
		
	/**
	 * I return an array of users
	 * @access public
	 * @return array
	 */
	function get_users() 
	{
		return parent::get($this->tbl, 'name', 'asc');
	}
	
	/**
	 * I return a new user
	 * @access public
	 * @return array
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
	 * @access public
	 * @param array $user
	 * @param integer $id (optional)
	 * @return integer
	 */
	function save_user($user, $id=0) 
	{
		return parent::save($this->tbl, $user, $id);
	}
	
}