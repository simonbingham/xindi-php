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

<div class="btn-group pull-right" data-toggle="buttons-checkbox">
	<a href="<?php echo site_url('articles/index') ?>" class="btn"><i class="icon-arrow-left"></i> Back to Articles</a>
	<?php 
	if ($id) 
	{
	?>	
		<?php $deletelnk = array('articles/delete', $id); ?>
		<a href="<?php echo site_url($deletelnk) ?>" onclick="return confirm('Are you sure you want to delete this article?')" class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a>
	<?php 
	}
	?>
</div>

<form method="post" action="<?php echo site_url('articles/save') ?>" id="article-form" class="clear">
	<fieldset>
		<legend>Article Details</legend>	

		<div class="control-group">
			<label class="control-label" for="title">Title *</label>
			<div class="controls">
				<input class="input-xlarge" type="text" name="title" id="title" value="<?php echo set_value('title', $title); ?>" maxlength="150" placeholder="Title">
				<?php echo form_error('title'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="author">Author</label>
			<div class="controls">
				<input class="input-xlarge" type="text" name="author" id="author" value="<?php echo set_value('author', $author); ?>" maxlength="100" placeholder="Author">
				<?php echo form_error('author'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="published">Published *</label>
			<div class="controls">
				<input class="input-xlarge datepicker" type="text" name="published" id="published" value="<?php echo format_date(set_value('published', $published), 'd/m/Y'); ?>" maxlength="10" placeholder="Published">
				<?php echo form_error('published'); ?>
				<noscript><p class="help-block">Enter in 'dd/mm/yyyy' format.</p></noscript>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="article-content">Content *</label>
			<div class="controls">
				<textarea class="input-xlarge tinymce" name="content" id="article-content"><?php echo set_value('content', $content); ?></textarea>
				<?php echo form_error('content'); ?>
			</div>
		</div>		
	</fieldset>
	
	<fieldset>
		<legend>Meta Tags</legend>		

		<div class="control-group">
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" name="meta_generated" id="meta_generated" value="TRUE" <?php if($meta_generated){ echo 'checked="checked"'; }?>>
					Generate automatically
					<?php echo form_error('meta_generated'); ?>
				</label>
			</div>
		</div>		

		<div id="meta_tags" <?php if($meta_generated) { echo 'style="display:none;"'; } ?>>
			<div class="control-group">
				<label class="control-label" for="meta_title">Title</label>
				<div class="controls">
					<input class="input-xlarge" type="text" name="meta_title" id="meta_title" value="<?php echo set_value('meta_title', $meta_title); ?>" maxlength="69" placeholder="Title">
					<?php echo form_error('meta_title'); ?>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="meta_description">Description</label>
				<div class="controls">
					<input class="input-xlarge" type="text" name="meta_description" id="meta_description" value="<?php echo set_value('meta_description', $meta_description); ?>" maxlength="169" placeholder="Description">
					<?php echo form_error('meta_description'); ?>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="meta_keywords">Keywords</label>
				<div class="controls">
					<input class="input-xlarge" type="text" name="meta_keywords" id="meta_keywords" value="<?php echo set_value('meta_keywords', $meta_keywords); ?>" maxlength="169" placeholder="Keywords">
					<?php echo form_error('meta_keywords'); ?>
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

<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>window.jQuery.ui || document.write('<script src="assets/js/jquery-ui.min.js"><\/script>')</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>
<script>$.fn.validate || document.write('<script src="assets/js/jquery.validate.min.js"><\/script>')</script>
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
			, meta_title:{maxlength:69}
			, meta_description:{maxlength:169}
			, meta_keywords:{maxlength:169}
		},
		messages:{
			title:{required:"The title field is required", maxlength:"The title field must not exceed 150 characters"}
			, author:{maxlength:"The title field must not exceed 100 characters"}
			, published:{required:"The published field is required", maxlength:"The title field must not exceed 10 characters"}
			, content:{required:"The content field is required"}
			, meta_title:{maxlength:"The meta title field must not exceed 69 characters"}
			, meta_description:{maxlength:"The meta description field must not exceed 169 characters"}
			, meta_keywords:{maxlength:"The meta keywords field must not exceed 169 characters"}
		}
	});
});
</script>