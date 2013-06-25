<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<base href="<?php echo base_url(); ?>">

		<title>Xindi Site Manager</title>

		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="assets/css/dark-hive/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">
		<link href="assets/css/core.css" rel="stylesheet">

		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="assets/js/jquery-1.9.1.js"><\/script>')</script>
		
		<link rel="shortcut icon" href="assets/ico/favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144x144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114x114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72x72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/ico/apple-touch-icon-57x57-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-precomposed.png">			
		<link rel="apple-touch-icon" href="assets/ico/apple-touch-icon.png">		
	</head>
	
	<body>
		<?php if(ENVIRONMENT == 'development') { ?>
			<span class="dev-mode label label-warning">Development Mode</span>
		<?php } ?>	
	
		<div class="navbar navbar-fixed-top" role="banner">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					
					<a class="brand" href="<?php echo site_url() ?>" title="Return to home page"><img src="assets/img/xindi-logo.png" alt="Xindi logo" /></a>
					
					<?php 
					if($this->session->userdata('is_logged_in')) 
					{
					?>
						<div class="nav-collapse">
							<ul class="nav pull-right" role="navigation">
								<li><a href="<?php echo site_url('main/index') ?>">Dashboard</a></li>
								<li><a href="<?php echo site_url('pages/index') ?>">Pages</a></li>
								<li><a href="<?php echo site_url('articles/index') ?>">News</a></li>
								<li><a href="<?php echo site_url('filemanager/index') ?>">File Manager</a></li>
								<li><a href="<?php echo site_url('enquiries/index') ?>">Enquiries<?php if ($this->unread_enquiry_count) { ?><span class="badge badge-info"><abbr title="Unread enquiries"><?php echo $this->unread_enquiry_count; ?></abbr></span><?php } ?></a></li>
								<li><a href="<?php echo site_url('users/index') ?>">Users</a></li>
								<li><a href="<?php echo site_url('security/do_logout') ?>">Logout</a></li>
							</ul>
						</div>
					<?php 
					}
					?>
				</div>
			</div>
		</div>		
	
		<div id="container" class="container">
			<div class="row">
				<div id="content" class="span12" role="main">
					<h2 class="pull-right"><small class="pull-right"><?php echo $this->session->userdata('name'); ?></small></h2>

					<?php echo $content_body; ?>
		
					<div class="clearfix append-bottom"></div>
				</div>
			</div>
		</div>
	
		<div id="footer" role="contentinfo">
			<div class="container">
				<div class="row">
					<div class="span12">
						<p>
							<a href="http://www.getxindi.com/">Version <?php echo $this->config->item('version'); ?></a>
							<a href="" id="top-of-page" class="pull-right">Back to top <i class="icon-chevron-up"></i></a>
						</p>
					</div>
				</div>
			</div>
		</div>
		
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/js/core.js"></script>
		<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
		<script>
		// TinyMCE configuration options - http://www.tinymce.com/wiki.php/Configuration
		tinymce.init({
			body_id:'content',
			browser_spellcheck:true,
			content_css:'<?php echo str_replace('/admin/', '/public/', base_url()); ?>assets/css/editor.css',
			//file_browser_callback: function(field_name, url, type, win) { 
			//	win.document.getElementById(field_name).value = 'my browser value'; 
			//},
			height:600,
			menubar:false,
			plugins:['lists link image preview anchor code fullscreen media table paste'],
			selector:'textarea',
			toolbar:'undo redo | cut copy paste | styleselect | bold italic | table | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | code'
		});		
		</script>
	</body>		
</html>