<ul class="breadcrumb">
	<li><a href="<?php echo site_url(); ?>">Home</a> <span class="divider">/</span></li>
	<li>News</li>
</ul>

<h1>News</h1>

<?php if(count($articles)) { ?>
	<?php foreach($articles as $article) { ?>
		<div class="well">
			<h2>
				<a href="<?php echo site_url(uri_string() . '/' . $article->slug); ?>"><?php echo $article->title; ?></a>
	
				<small class="pull-right">
					<?php echo format_date($article->published, 'l jS F Y'); ?>
				</small>
			</h2>
	
			<?php 
			$summary = strip_tags($article->content);
			$summary = word_limiter($summary, 100);
			echo $summary; 
			?>	
		</div>
	<?php } ?>
<?php } else { ?>
	<p>There are currently no news stories.</p>
<?php } ?>