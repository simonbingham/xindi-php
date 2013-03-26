<?php
class Page_class extends MY_Model 
{
	
	private $tbl = 'pages';

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
	 * I delete a page matching an id
	 * @access public
	 * @param integer $id
	 * @return void
	 */
	function delete_page($id) 
	{
		$this->db->trans_start();
			$page = $this->get_page_by_id($id)->row();
			parent::delete($this->tbl, $page->id);
			$sql = 'UPDATE ' . $this->tbl . ' SET left_value = left_value - 2 where left_value > ' . $this->db->escape($page->left_value) . ';';
			$this->db->query($sql);
			$sql = 'UPDATE ' . $this->tbl . ' SET right_value = right_value - 2 where right_value > ' . $this->db->escape($page->left_value) . ';';
			$this->db->query($sql);
		$this->db->trans_complete();
	}

	/**
	 * I return the site navigation
	 * @access public
	 * @param boolean $apply_classes (optional)
	 * @return string
	 */
	function get_navigation($apply_classes=FALSE)
	{
		$class = '';
		$currLevel = -1;
		$pages = $this->get_pages()->result();
		$prevLevel = -1;
		$result = '';
		foreach($pages as $page) 
		{
			$link = '<a href="' . site_url($page->slug) . '">' . $page->title . '</a>';
			$currLevel = intval($page->depth);
			if ($currLevel == 0)
			{
				$currLevel = 1;
			}
			if ($currLevel > $prevLevel) 
			{
				if ($apply_classes)
				{
					if (! intval($page->depth))
					{
						$class = ' nav nav-pills';
					} 
					else 
					{
						$class = ' dropdown-menu';
					}
				}
				$result .= '<ul class="' . $class . '"><li>' . $link;
			} 
			else if ($currLevel < $prevLevel) 
			{
				$tmp = $prevLevel;
				while ($tmp > $currLevel) 
				{
					$result .= '</li></ul>';
					$tmp -= 1;
				}
				$result .= '</li><li>' . $link;
			} 
			else 
			{
				$result .= '</li><li>' . $link;
			}
			$prevLevel = $currLevel;
		}
		$tmp = $currLevel;
		while ($tmp > 0) 
		{
			$result .= '</li></ul>';
			$tmp -= 1;
		}
		return $result;
	}	
	
	/**
	 * I return an page matching an id
	 * @access public
	 * @param integer $id
	 * @return array
	 */
	function get_page_by_id($id)
	{
		return parent::get_by_id($this->tbl, $id);
	}
	
	/**
	 * I return a page matching a slug
	 * @access public
	 * @param string $slug
	 * @return array
	 */
	function get_page_by_slug($slug) 
	{
		return parent::get_by_slug($this->tbl, $slug);
	}	

	/**
	 * I return a page path
	 * @access public
	 * @param array $page
	 * @return array
	 */
	function get_path($page){
		$this->db->where('left_value <', $page->left_value);
		$this->db->where('right_value >', $page->right_value);
		return $this->db->get($this->tbl);
	}
	
	/**
	 * I return an array of pages
	 * @access public
	 * @return array
	 */
	function get_pages() 
	{
		return parent::get($this->tbl, 'left_value', 'asc');
	}
	
	/**
	 * I return a new page
	 * @access public
	 * @return array
	 */
	function new_page() 
	{
		$page = array(
			'id' => '',
			'slug' => '',
			'left_value' => '',
			'right_value' => '',
			'ancestor_id' => '',
			'depth' => '',
			'title' => '',
			'content' => '',
			'meta_generated' => FALSE,
			'meta_title' => '',
			'meta_description' => '',
			'meta_keywords' => ''
		);
		return $page;
	}
	
	/**
	 * I save a page and return the id
	 * @access public
	 * @param array $page
	 * @param integer $id (optional)
	 * @return integer $ancestor_id (optional)
	 */
	function save_page($page, $id=0, $ancestor_id=0) 
	{
		$this->db->trans_start();
			// generate meta tags
			if ($page['meta_generated'])
			{
				$page['meta_title'] = parent::generate_page_title($page['title']);
				$page['meta_description'] = parent::generate_meta_description($page['content']);
				$page['meta_keywords'] = parent::generate_meta_keywords($page['content']);
			}
			// new page
			if (! $id) 
			{
				$ancestor_page = $this->get_page_by_id($ancestor_id)->row();
				$page['ancestor_id'] = $ancestor_page->id;
				$page['depth'] = $ancestor_page->depth + 1;
				$page['slug'] = parent::generate_slug($this->tbl, $page['title'], $ancestor_page->slug);
				$page['left_value'] = $ancestor_page->right_value;
				$page['right_value'] = $ancestor_page->right_value + 1;
				$sql = 'UPDATE ' . $this->tbl . ' SET left_value = left_value + 2 where left_value > ' . $this->db->escape($ancestor_page->right_value - 1) . ';';
				$this->db->query($sql);
				$sql = 'UPDATE ' . $this->tbl . ' SET right_value = right_value + 2 where right_value > ' . $this->db->escape($ancestor_page->right_value - 1) . ';';
				$this->db->query($sql);
			}
			$page = parent::save($this->tbl, $page, $id);
		$this->db->trans_complete();
		return $page;
	}
	
}