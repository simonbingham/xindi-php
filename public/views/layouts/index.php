<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<?php if(isset($meta_description) && strlen($meta_description)) { ?><meta name="description" content="<?php echo $meta_description; ?>"><?php } ?>
		<?php if(isset($meta_keywords) && strlen($meta_keywords)) { ?><meta name="keywords" content="<?php echo $meta_keywords; ?>"><?php } ?>
		<?php if(isset($meta_author) && strlen($meta_author)) { ?><meta name="author" content="<?php echo $meta_author; ?>"><?php } ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<base href="<?php echo base_url(); ?>">

		<?php if(isset($meta_title) && strlen($meta_title)) { ?><title><?php echo $meta_title; ?></title><?php } ?>

		<link href="public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="public/assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="public/assets/css/core.css" rel="stylesheet">
		
		<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo site_url('news/feed') ?>">

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-57-precomposed.png">
	</head>
	
	<body>
		<div class="navbar navbar-fixed-top" role="banner">
			<div class="navbar-inner">
				<div class="container">
					<a class="brand" href="<?php echo site_url(); ?>" title="Return to home page"><img src="public/assets/img/global/xindi-logo.png" alt="Xindi logo" /></a>

				    <form action="<?php echo site_url('search') ?>" method="post" class="navbar-search pull-right" id="search" role="search">
				    	<input type="text" name="search_term" id="search_term" class="search-query" placeholder="Search">
				    </form>							
				</div>
			</div>
		</div>	
	
		<div id="container" class="container">
			<div class="row">
				<nav class="span12" id="primary-navigation" role="navigation">
					<?php echo $this->navigation; ?>
				</nav>
			</div>
			
			<div id="content" class="row" role="main">
				<div class="span12">
					<?php echo $content_body; ?>
				</div>
			</div>
			
			<footer id="footer" class="row" role="contentinfo">
				<div class="span12"><a href="<?php echo site_url('map'); ?>">Site Map</a></div>
			</footer>			
		</div>
		
		<script src="public/assets/js/bootstrap-dropdown.js"></script>
		<script src="public/assets/js/core.js"></script>
	</body>
</html>