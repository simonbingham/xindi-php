<?php 
if($context === 'create')
{
	echo '<h1>Add Page</h1>';
}
else
{
	echo '<h1>Edit Page</h1>';
}

$userdata = $this->session->all_userdata();
$message = isset($message) ? $message : '';
echo render_message($userdata, $message);
?>

<div class="btn-group pull-right" data-toggle="buttons-checkbox">
	<a href="<?php echo site_url('pages/index') ?>" class="btn btn-mini"><i class="icon-arrow-left"></i> Back to Pages</a>
	<?php // the home page and pages with children cannot be deleted ?>
	<?php if($depth <> 0 && $rightvalue - $leftvalue == 1) { ?>
		<?php $deletelnk = array('pages/delete', $id); ?>
		<a href="<?php echo site_url($deletelnk) ?>" onclick="return confirm('Are you sure you want to delete this page?')" class="btn btn-mini"><i class="icon-trash"></i> Delete</a>
	<?php } ?>
</div>

<form method="post" action="<?php echo site_url('pages/save') ?>" id="page-form" class="clear">
	<fieldset>
		<legend>Page Details</legend>	

		<div class="control-group">
			<label class="control-label" for="title">Title *</label>
			<div class="controls">
				<input class="input-xlarge" type="text" name="title" id="title" value="<?php echo set_value('title', $title); ?>" maxlength="150" placeholder="Title">
				<?php echo form_error('title'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="page-content">Content *</label>
			<div class="controls">
				<textarea class="input-xlarge tinymce" name="content" id="page-content"><?php echo set_value('content', $content); ?></textarea>
				<?php echo form_error('content'); ?>
			</div>
		</div>		
	</fieldset>
	
	<fieldset>
		<legend>Meta Tags</legend>		

		<div class="control-group">
			<label>&nbsp;</label>
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" name="metagenerated" id="metagenerated" value="TRUE" <?php if($metagenerated){ echo 'checked="checked"'; }?>>
					Generate automatically
					<?php echo form_error('metagenerated'); ?>
				</label>
			</div>
		</div>		

		<div class="metatags">
			<div class="control-group">
				<label class="control-label" for="metatitle">Title</label>
				<div class="controls">
					<input class="input-xlarge" type="text" name="metatitle" id="metatitle" value="<?php echo set_value('metatitle', $metatitle); ?>" maxlength="69" placeholder="Title">
					<?php echo form_error('metatitle'); ?>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="metadescription">Description</label>
				<div class="controls">
					<input class="input-xlarge" type="text" name="metadescription" id="metadescription" value="<?php echo set_value('metadescription', $metadescription); ?>" maxlength="169" placeholder="Description">
					<?php echo form_error('metadescription'); ?>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="metakeywords">Keywords</label>
				<div class="controls">
					<input class="input-xlarge" type="text" name="metakeywords" id="metakeywords" value="<?php echo set_value('metakeywords', $metakeywords); ?>" maxlength="169" placeholder="Keywords">
					<?php echo form_error('metakeywords'); ?>
				</div>
			</div>
		</div>
	</fieldset>	
	
	<div class="form-actions">
		<input type="submit" name="submit" value="Save &amp; continue" class="btn btn-primary">
		<input type="submit" name="submit" id="submit" value="Save &amp; exit" class="btn btn-primary">
		<a href="<?php echo site_url('pages/index') ?>" class="btn cancel">Cancel</a>
	</div>
	
	<input type="hidden" name="id" id="id" value="<?php echo set_value('id', $id); ?>">
	<input type="hidden" name="ancestorid" id="ancestorid" value="<?php echo set_value('ancestorid', $ancestorid); ?>">
	<input type="hidden" name="context" id="context" value="<?php echo $context; ?>">
</form>

<script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="assets/js/jquery.validate.js"></script>
<script>
jQuery(function($) {
	$(".datepicker").datepicker({ dateFormat:"dd/mm/yy" });
	
	// form validation (http://docs.jquery.com/Plugins/Validation)
	$("#page-form").validate({
		rules:{
			title:{required:true, maxlength:150}
			, content:{required:true}
			, metatitle:{maxlength:69}
			, metadescription:{maxlength:169}
			, metakeywords:{maxlength:169}
		},
		messages:{
			title:{required:"The title field is required", maxlength:"The title field must not exceed 150 characters"}
			, content:{required:"The content field is required"}
			, metatitle:{maxlength:"The meta title field must not exceed 69 characters"}
			, metadescription:{maxlength:"The meta description field must not exceed 169 characters"}
			, metakeywords:{maxlength:"The meta keywords field must not exceed 169 characters"}
		}
	});
});
</script>