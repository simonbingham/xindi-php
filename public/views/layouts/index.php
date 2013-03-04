<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<base href="<?php echo base_url(); ?>">

		<title>Xindi PHP</title>

		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="assets/css/core.css" rel="stylesheet">

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-57-precomposed.png">
	</head>
	
	<body>
		<div id="container" class="container">
			<div class="row">
				<div></div>
				
				<div id="content" class="span12" role="main">
					<h1>Welcome to Xindi PHP</h1>
					
					<?php echo $content_body; ?>
				</div>
			</div>
		</div>
	</body>
</html>