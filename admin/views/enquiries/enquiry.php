<div class="page-header clear"><h1><?php echo $enquiry->name ?> <small class="pull-right"><?php echo format_date($enquiry->created) ?></small></h1></div>

<?php // TODO: implement delete link ?>

<p><a href="mailto:<?php echo $enquiry->email; ?>" class="btn btn-primary"><i class="icon-envelope icon-white"></i> Reply</a></p>

<hr>

<blockquote><?php echo $enquiry->message; ?></blockquote>
