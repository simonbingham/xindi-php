<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<base href="<?php echo base_url(); ?>">

		<title>Xindi Site Manager</title>

		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="assets/css/dark-hive/jquery-ui-1.9.2.custom.css" rel="stylesheet">
		<link href="assets/css/core.css" rel="stylesheet">

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		
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
								<li><a href="<?php echo site_url('enquiries/index') ?>">Enquiries<?php if ($this->unread_enquiry_count) { ?><span class="badge badge-info"><abbr title="Unread enquiries"><?php echo $this->unread_enquiry_count; ?></abbr></span><?php } ?></a></li>
								<li><a href="<?php echo site_url('users/index') ?>">Users</a></li>
								<li><a href="<?php echo site_url('security/dologout') ?>">Logout</a></li>
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
		<script src="assets/js/tiny_mce/jquery.tinymce.js"></script>
		<script src="assets/js/core.js"></script>
		<script>
		jQuery(function($) {
			$('textarea.tinymce').tinymce({
				// Location of TinyMCE script
				script_url : '<?php echo base_url(); ?>assets/js/tiny_mce/tiny_mce.js',

				// General options
				theme : "advanced",
				plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
				height : "400px",
				width : "100%",
				
				// Theme options

				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,preview",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr,|,fullscreen",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,
				
				// Example content CSS (should be your site CSS)
				content_css : "<?php echo base_url(); ?>assets/css/editor.css",

				<?php // TODO: populate TinyMCE dropdown lists ?>
				// Drop lists for link/image/media/template dialogs
				/*
				template_external_list_url : "lists/template_list.js",
				external_link_list_url : "lists/link_list.js",
				external_image_list_url : "lists/image_list.js",
				media_external_list_url : "lists/media_list.js",
				*/

				// Replace values for the template plugin
				template_replace_values : {
					username : "<?php echo $this->session->userdata('name'); ?>",
					staffid : "<?php echo $this->session->userdata('id'); ?>"
				}
			});
		});
		</script>
	</body>		
</html>