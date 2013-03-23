<div class="page-header clear"><h1><?php echo $enquiry->name ?> <small class="pull-right"><?php echo format_date($enquiry->created) ?></small></h1></div>

<p class="pull-right">
	<a href="<?php echo site_url('enquiries/index') ?>" class="btn btn-mini"><i class="icon-arrow-left"></i> Back to Enquiry List</a>
	<a href="mailto:<?php echo $enquiry->email; ?>" class="btn btn-mini btn-primary"><i class="icon-envelope icon-white"></i> Reply</a>
	<?php $deletelnk = array('enquiries/delete', $enquiry->id); ?>
	<a href="<?php echo site_url($deletelnk) ?>" title="Delete enquiry" onclick="return confirm('Are you sure you want to delete this enquiry?')" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete</a>
</p>

<hr class="clear">

<blockquote><?php echo $enquiry->message; ?></blockquote>
