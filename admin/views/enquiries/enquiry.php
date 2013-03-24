<div class="page-header clear"><h1><?php echo $enquiry->name ?> <small class="pull-right"><?php echo format_date($enquiry->created) ?></small></h1></div>

<div class="btn-group pull-right append-bottom" data-toggle="buttons-checkbox">
	<a href="<?php echo site_url('enquiries/index') ?>" class="btn btn-mini"><i class="icon-arrow-left"></i> Back to Enquiry List</a>
	<a href="mailto:<?php echo $enquiry->email; ?>" class="btn btn-mini"><i class="icon-envelope"></i> Reply</a>
	<?php $deletelnk = array('enquiries/delete', $enquiry->id); ?>
	<a href="<?php echo site_url($deletelnk) ?>" data-id="<?php echo $enquiry->id; ?>" onclick="return confirm('Are you sure you want to delete this enquiry?')" class="btn btn-mini delete-confirm"><i class="icon-trash"></i> Delete</a>
</div>

<hr class="clear">

<blockquote><?php echo $enquiry->message; ?></blockquote>