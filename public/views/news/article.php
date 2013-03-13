<?php // TODO: implement breadcrumbs ?>

<h1><?php echo $article->title; ?></h1>

<?php echo $article->content;?>

<p>
	Published: <?php echo format_date($article->published, 'l jS F Y'); ?>
	<?php if(strlen($article->author)) { ?>
		<br>Author: <?php echo $article->author; ?>
	<?php } ?>
</p>