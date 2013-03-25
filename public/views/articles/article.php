<ul class="breadcrumb">
	<li><a href="<?php echo site_url(); ?>">Home</a> <span class="divider">/</span></li>
	<li><a href="<?php echo site_url('news'); ?>">News</a> <span class="divider">/</span></li>
	<li><?php echo $article->title; ?></li>
</ul>

<h1>
	<?php echo $article->title; ?>
	<small class="pull-right"><?php echo format_date($article->published, 'l jS F Y'); ?></small>
</h1>

<?php echo $article->content;?>

<?php if(strlen($article->author)) { ?>
	<hr>

	<p>Written by <?php echo $article->author; ?></p>
<?php } ?>