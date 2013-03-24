<ul class="breadcrumb">
	<li><a href="<?php echo site_url(); ?>">Home</a> <span class="divider">/</span></li>
	<li>Search Results</li>
</ul>

<h1>Search Results</h1>

<?php 
$result_count = $search_results->num_rows();
$search_term = html_escape($search_term);
if ($result_count == 1)
{
	echo'1 page was found matching the search term &quot;' . $search_term . '&quot;.';
}
else if ($result_count > 1)
{
	echo $result_count . ' pages were found matching the search term &quot;' . $search_term . '&quot;.';
} 
else
{
	echo 'No pages were found matching the search term &quot;' . $search_term . '&quot;.';	
}
?>

<?php 
foreach ($search_results->result() as $row)
{
?>
	<?php 
	// the result is a page
	if($row->type == 'page')
	{
	?>
		<h2><a href="<?php echo site_url($row->slug); ?>"><?php echo $row->title; ?></a></h2>
	<?php 
	}
	// the result is an article
	else
	{
	?>
		<h2><a href="<?php echo site_url('news/' . $row->slug); ?>"><?php echo $row->title; ?></a></h2>
	<?php 
	}
	?>
	
	<?php echo word_limiter(strip_tags($row->content),50); ?>
<?php
}
?>