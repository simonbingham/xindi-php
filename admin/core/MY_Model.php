<?php
class MY_Model extends CI_Model 
{
	
	public $tbl_articles = 'articles';
	public $tbl_pages = 'pages';
	
	// ------------------------ PUBLIC METHODS ------------------------ //
	
	/**
	 * I initiate this class
	 * @access public
	 * @return void
	 */	
	function __construct() 
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('file');
	}

	// ------------------------ PROTECTED METHODS ------------------------ //
	
	/**
	 * I clear the cache
	 *
	 * @access protected
	 * @return boolean
	 */	
	protected function clear_cache()
	{
		return delete_files('../cache/', TRUE);
	}		
	
	/**
	 * I delete a record matching an id
	 * @access protected
	 * @param string $tbl
	 * @param integer $id
	 * @return void
	 */
	protected function delete($tbl, $id) 
	{
		$id = intval($id);
		$this->db->where('id', $id);
		$this->db->delete($tbl);
		$this->clear_cache();
		$this->generate_sitemap_xml();
	}
	
	/**
	 * I generate a meta description
	 * @access protected
	 * @param string $str
	 * @return string
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
	 * @access protected
	 * @param string $str
	 * @return string
	 */
	protected function generate_meta_keywords($str)
	{
		return 
			// return first 169 characters
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
	 * @access protected
	 * @param string $str
	 * @return string
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
	 * @access protected
	 * @param string $tbl
	 * @param string $title
	 * @param string $ancestor_slug
	 * @return string
	 */
	protected function generate_slug($tbl, $title, $ancestor_slug='')
	{
		$title = strtolower(trim($title));
		$ancestor_slug = trim($ancestor_slug);
		$slug = '';
		if (strlen($ancestor_slug)) 
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
	 * @access protected
	 * @param string $tbl
	 * @param string $sort_col
	 * @param string $sort_dir
	 * @return array
	 */
	protected function get($tbl, $sort_col, $sort_dir) 
	{
		$this->db->order_by($sort_col,$sort_dir);
		return $this->db->get($tbl);
	}
	
	/**
	 * I return a record matching an id
	 * @access protected
	 * @param string $tbl
	 * @param integer $id
	 * @return array
	 */
	protected function get_by_id($tbl, $id) 
	{
		$id = intval($id);
		$this->db->where('id', $id);
		return $this->db->get($tbl);
	}
	
	/**
	 * I save a record and return the id
	 * @access protected
	 * @param string $tbl
	 * @param array $data
	 * @param integer $id (optional)
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
			$id = $this->db->insert_id();			
		}
		// existing record 
		else 
		{
			$this->db->where('id', $id);
			$this->db->update($tbl, $data);
		}
		$this->clear_cache();
		$this->generate_sitemap_xml();
		return $id;
	}

	/**
	 * I convert a string to a MySQL timestamp
	 * @access protected
	 * @param string $date the date in 'dd/mm/yyyy' format
	 * @return date
	 */
	protected function string_to_timestamp($date) 
	{
		$date = str_replace('/', '-', $date);
		return date("Y-m-d H:i:s", strtotime($date));
	}
	
	// ------------------------ PRIVATE METHODS ------------------------ //

	/**
	 * I generate a sitemap xml file
	 * @access private
	 * @return void
	 */	
	private function generate_sitemap_xml()
	{
		$results = $this->db->query('
			SELECT CONCAT(\'news/\', slug) AS slug, title, DATE_FORMAT(published, \'%Y-%m-%dT%H:%i:%s+00:00\') AS last_updated
			FROM ' . $this->tbl_articles . '
			UNION
			SELECT slug, title, DATE_FORMAT(updated, \'%Y-%m-%dT%H:%i:%s+00:00\') AS last_updated
			FROM ' . $this->tbl_pages . '
			ORDER BY last_updated DESC;			
		');
		$output = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		$output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";
		foreach($results->result() as $result) 
		{
			$output .= '<url>' . "\n";
			$output .= '<loc>' . str_replace('admin/', '', site_url($result->slug)) . '</loc>' . "\n";
			$output .= '<lastmod>' . $result->last_updated . '</lastmod>' . "\n";
			$output .= '<changefreq>weekly</changefreq>' . "\n";
			$output .= '</url>' . "\n";
		}
		$output .= '</urlset>' . "\n";
		$file_path = str_replace('admin', 'sitemap.xml', realpath('.'));
		write_file($file_path, trim($output));
	}	
	
	/**
	 * I return true if a slug is unique
	 * @access private
	 * @param string $tbl
	 * @param string $slug
	 * @return boolean
	 */
	private function is_slug_unique($tbl, $slug)
	{
		$query = $this->db->get_where($tbl, array('slug' => $slug));
		return $query->num_rows() === 0;
	}
	
	/**
	 * I return a string with multiple spaces replaced with single spaces
	 *
	 * @access private
	 * @param string $str
	 * @return
	 */	
	private function replace_multiple_spaces_with_single_space($str)
	{
		return preg_replace('/\s{2,}/', ' ', $str);
	}
	
}