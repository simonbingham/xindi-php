<?php
class Page_class extends MY_Model 
{
	
	private $tbl = 'pages';

	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I initiate this class
	 */	
	function __construct() 
	{
		parent::__construct();
	}

	/**
	 * I delete a page matching an id
	 *
	 * @access   public
	 * @param    integer   page id
	 * @return   void
	 */
	function delete_page($id) 
	{
		$this->db->trans_start();
			$page = $this->get_page_by_id($id)->row();
			parent::delete($this->tbl, $page->id);
			$sql = 'UPDATE ' . $this->tbl . ' SET leftvalue = leftvalue - 2 where leftvalue > ' . $this->db->escape($page->leftvalue) . ';';
			$this->db->query($sql);
			$sql = 'UPDATE ' . $this->tbl . ' SET rightvalue = rightvalue - 2 where rightvalue > ' . $this->db->escape($page->leftvalue) . ';';
			$this->db->query($sql);
		$this->db->trans_complete();
	}

	/**
	 * I return the site navigation
	 *
	 * @return   string   navigation
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
			if($currLevel == 0)
			{
				$currLevel = 1;
			}
			if($currLevel > $prevLevel) 
			{
				if($apply_classes)
				{
					if(! intval($page->depth))
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
				while($tmp > $currLevel) 
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
		while($tmp > 0) 
		{
			$result .= '</li></ul>';
			$tmp -= 1;
		}
		return $result;
	}	
	
	/**
	 * I return an page matching an id
	 *
	 * @access   public   page id
	 * @return   array    page
	 */
	function get_page_by_id($id)
	{
		return parent::get_by_id($this->tbl, $id);
	}
	
	/**
	 * I return a page matching a slug
	 *
	 * @access   public
	 * @param    slug    page slug
	 * @return   array   page
	 */
	function get_page_by_slug($slug) 
	{
		$this->db->where('slug', $slug);
		return $this->db->get($this->tbl);
	}	

	/**
	 * I return a page path
	 *
	 * @access   public
	 * @param    array   page
	 * @return   array   pages
	 */
	function get_path($page){
		$this->db->where('leftvalue <', $page->leftvalue);
		$this->db->where('rightvalue >', $page->rightvalue);
		return $this->db->get($this->tbl);
	}	
	
	/**
	 * I return an array of pages
	 *
	 * @access   public
	 * @return   array   pages
	 */
	function get_pages() 
	{
		return parent::get($this->tbl, 'leftvalue', 'asc');
	}
	
	/**
	 * I return a new page
	 *
	 * @access   public
	 * @return   array   page
	 */
	function new_page() 
	{
		$page = array(
			'id' => '',
			'slug' => '',
			'leftvalue' => '',
			'rightvalue' => '',
			'ancestorid' => '',
			'depth' => '',
			'title' => '',
			'content' => '',
			'metagenerated' => FALSE,
			'metatitle' => '',
			'metadescription' => '',
			'metakeywords' => ''
		);
		return $page;
	}
	
	/**
	 * I save a page and return the id
	 *
	 * @access   public
	 * @param    array     page
	 * @param    integer   page id (optional)
	 * @return   integer   ancestor id (optional)
	 */
	function save_page($page, $id=0, $ancestorid=0) 
	{
		$this->db->trans_start();
			// generate meta tags
			if($page['metagenerated'])
			{
				$page['metatitle'] = parent::generate_page_title($page['title']);
				$page['metadescription'] = parent::generate_meta_description($page['content']);
				$page['metakeywords'] = parent::generate_meta_keywords($page['content']);
			}
			// new page
			if(! $id) 
			{
				$ancestorpage = $this->get_page_by_id($ancestorid)->row();
				$page['ancestorid'] = $ancestorpage->id;
				$page['depth'] = $ancestorpage->depth + 1;
				$page['slug'] = parent::generate_slug($this->tbl, $page['title'], $ancestorpage->slug);
				$page['leftvalue'] = $ancestorpage->rightvalue;
				$page['rightvalue'] = $ancestorpage->rightvalue + 1;
				$sql = 'UPDATE ' . $this->tbl . ' SET leftvalue = leftvalue + 2 where leftvalue > ' . $this->db->escape($ancestorpage->rightvalue - 1) . ';';
				$this->db->query($sql);
				$sql = 'UPDATE ' . $this->tbl . ' SET rightvalue = rightvalue + 2 where rightvalue > ' . $this->db->escape($ancestorpage->rightvalue - 1) . ';';
				$this->db->query($sql);
			}
			$page = parent::save($this->tbl, $page, $id);
		$this->db->trans_complete();
		return $page;
	}
	
}