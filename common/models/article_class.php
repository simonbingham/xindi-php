<?php
class Article_class extends MY_Model 
{
	
	private $tbl = 'articles';

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
	 * I delete an article matching an id
	 * @access public
	 * @param integer $id
	 * @return void
	 */
	function delete_article($id) 
	{
		$id = intval($id);
		parent::delete($this->tbl, $id);
	}
	
	/**
	 * I generate an article RSS feed
	 * @access public
	 * @param string $feed_title
	 * @param string $feed_link
	 * @param string $feed_description
	 * @return string
	 */	
	function generate_feed($feed_title, $feed_link, $feed_description)
	{
		$articles = $this->get_articles(10)->result();
		$output = '<?xml version="1.0" encoding="ISO-8859-1" ?>' . "\n";
		$output .= '<rss version="2.0">' . "\n";
		$output .= '<channel>' . "\n";
		$output .= '<title>' . $feed_title . '</title>' . "\n";
		$output .= '<link>' . $feed_link . '</link>' . "\n";
		$output .= '<description>' . $feed_description . '</description>' . "\n";
		foreach($articles as $article) 
		{
			$output .= '<item>' . "\n";
			$output .= '<title>' . $article->title . '</title>' . "\n";
			$output .= '<link>' . site_url('news/' . $article->slug) . '</link>' . "\n";
			$output .= '<description>' . html_entity_decode(word_limiter(strip_tags($article->content),50)) . '</description>' . "\n";
			$output .= '<pubdate>' . date('D, d M Y H:i:s O', strtotime($article->published)) . '</pubdate>' . "\n";
			$output .= '</item>' . "\n";
		}
		$output .= '</channel>' . "\n";
		$output .= '</rss>';
		return $output;
	}
		
	/**
	 * I return an article matching an id
	 * @access public
	 * @param integer $id
	 * @return array
	 */
	function get_article_by_id($id)
	{
		$id = intval($id);
		return parent::get_by_id($this->tbl, $id);
	}
	
	/**
	 * I return an article matching a slug
	 * @access public
	 * @param string $slug
	 * @return array
	 */
	function get_article_by_slug($slug)
	{
		return parent::get_by_slug($this->tbl, $slug);
	}
		
	/**
	 * I return an array of articles
	 * @access public
	 * @param integer $limit (optional)
	 * @return array
	 */
	function get_articles($limit=NULL) 
	{
		return parent::get($this->tbl, 'published', 'desc', $limit);
	}
	
	/**
	 * I return a new article
	 * @access public
	 * @return array
	 */
	function new_article() 
	{
		$article = array(
			'id' => '',
			'title' => '',
			'content' => '',
			'meta_generated' => FALSE,
			'meta_title' => '',
			'meta_description' => '',
			'meta_keywords' => '',
			'author' => '',
			'published' => ''
		);
		return $article;
	}
	
	/**
	 * I save a article and return the id
	 * @access public
	 * @param array $article
	 * @param integer $id (optional)
	 * @return integer
	 */
	function save_article($article, $id=0) 
	{
		$id = intval($id);
		$article['meta_generated'] = ($article['meta_generated'] === 'TRUE'); // ensure meta_generated is a boolean
		$article['published'] = parent::string_to_timestamp($article['published']);
		// new article so generate slug
		if (! $id) 
		{
			$article['slug'] = parent::generate_slug($this->tbl, $article['title']);
		}
		// generate meta tags
		if ($article['meta_generated'])
		{
			$article['meta_title'] = parent::generate_page_title($article['title']);
			$article['meta_description'] = parent::generate_meta_description($article['content']);
			$article['meta_keywords'] = parent::generate_meta_keywords($article['content']);
		}
		return parent::save($this->tbl, $article, $id);
	}
	
}