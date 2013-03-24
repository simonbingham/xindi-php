<?php // TODO: implement breadcrumbs ?>

<h1>
	<?php echo $article->title; ?>
	<small class="pull-right"><?php echo format_date($article->published, 'l jS F Y'); ?></small>
</h1>

<?php echo $article->content;?>

<?php if(strlen($article->author)) { ?>
	<hr>

	<p>Written by <?php echo $article->author; ?></p>
<?php } ?>