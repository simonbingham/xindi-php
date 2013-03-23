<?php 
if($context === 'create')
{
	echo '<h1>Add Article</h1>';
}
else
{
	echo '<h1>Edit Article</h1>';
}
 
$userdata = $this->session->all_userdata();
$message = isset($message) ? $message : '';
echo render_message($userdata, $message);
?>

<form method="post" action="<?php echo site_url('articles/save') ?>" id="article-form">
	<fieldset>
		<legend>Article Details</legend>	

		<div class="control-group">
			<label class="control-label" for="title">Title *</label>
			<div class="controls">
				<input class="input-xlarge" type="text" name="title" id="title" value="<?php echo set_value('title', $title); ?>" maxlength="150">
				<?php echo form_error('title'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="author">Author</label>
			<div class="controls">
				<input class="input-xlarge" type="text" name="author" id="author" value="<?php echo set_value('author', $author); ?>" maxlength="100">
				<?php echo form_error('author'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="published">Published *</label>
			<div class="controls">
				<input class="input-xlarge datepicker" type="text" name="published" id="published" value="<?php echo format_date(set_value('published', $published)); ?>" maxlength="10">
				<?php echo form_error('published'); ?>
				<noscript><p class="help-block">Enter in 'dd/mm/yyyy' format.</p></noscript>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="content">Content *</label>
			<div class="controls">
				<textarea class="input-xlarge tinymce" name="content" id="article-content"><?php echo set_value('content', $content); ?></textarea>
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
					<input class="input-xlarge" type="text" name="metatitle" id="metatitle" value="<?php echo set_value('metatitle', $metatitle); ?>" maxlength="69">
					<?php echo form_error('metatitle'); ?>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="metadescription">Description</label>
				<div class="controls">
					<input class="input-xlarge" type="text" name="metadescription" id="metadescription" value="<?php echo set_value('metadescription', $metadescription); ?>" maxlength="169">
					<?php echo form_error('metadescription'); ?>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="metakeywords">Keywords</label>
				<div class="controls">
					<input class="input-xlarge" type="text" name="metakeywords" id="metakeywords" value="<?php echo set_value('metakeywords', $metakeywords); ?>" maxlength="169">
					<?php echo form_error('metakeywords'); ?>
				</div>
			</div>
		</div>
	</fieldset>	
	
	<div class="form-actions">
		<input type="submit" name="submit" value="Save &amp; continue" class="btn btn-primary">
		<input type="submit" name="submit" id="submit" value="Save &amp; exit" class="btn btn-primary">
		<a href="<?php echo site_url('articles/index') ?>" class="btn cancel">Cancel</a>
	</div>
	
	<input type="hidden" name="id" id="id" value="<?php echo set_value('id', $id); ?>">
	<input type="hidden" name="context" id="context" value="<?php echo $context; ?>">
</form>

<script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="assets/js/jquery.validate.js"></script>
<script>
jQuery(function($) {
	$(".datepicker").datepicker({ dateFormat:"dd/mm/yy" });
	
	// form validation (http://docs.jquery.com/Plugins/Validation)
	$("#article-form").validate({
		rules:{
			title:{required:true, maxlength:150}
			, author:{maxlength:100}
			, published:{required:true, maxlength:12}
			, content:{required:true}
			, metatitle:{maxlength:69}
			, metadescription:{maxlength:169}
			, metakeywords:{maxlength:169}
		},
		messages:{
			title:{required:"The title field is required", maxlength:"The title field must not exceed 150 characters"}
			, author:{maxlength:"The title field must not exceed 100 characters"}
			, published:{required:"The published field is required", maxlength:"The title field must not exceed 10 characters"}
			, content:{required:"The content field is required"}
			, metatitle:{maxlength:"The meta title field must not exceed 69 characters"}
			, metadescription:{maxlength:"The meta description field must not exceed 169 characters"}
			, metakeywords:{maxlength:"The meta keywords field must not exceed 169 characters"}
		}
	});
});
</script>