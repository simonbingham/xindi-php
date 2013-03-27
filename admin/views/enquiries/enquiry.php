<div class="page-header clear"><h1><?php echo $enquiry->name ?> <small class="pull-right"><?php echo format_date($enquiry->created) ?></small></h1></div>

<div class="btn-group pull-right append-bottom" data-toggle="buttons-checkbox">
	<a href="<?php echo site_url('enquiries/index') ?>" class="btn"><i class="icon-arrow-left"></i> Back to Enquiries</a>
	<a href="mailto:<?php echo $enquiry->email; ?>" class="btn btn-primary"><i class="icon-envelope icon-white"></i> Reply</a>
	<?php $deletelnk = array('enquiries/delete', $enquiry->id); ?>
	<a href="<?php echo site_url($deletelnk) ?>" data-id="<?php echo $enquiry->id; ?>" onclick="return confirm('Are you sure you want to delete this enquiry?')" class="btn btn-danger delete-confirm"><i class="icon-trash icon-white"></i> Delete</a>
</div>

<hr class="clear">

<blockquote><?php echo $enquiry->message; ?></blockquote>