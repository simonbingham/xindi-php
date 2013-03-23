<h1>Contact</h1>

<?php 
$userdata = $this->session->all_userdata();
$message = isset($message) ? $message : '';
echo render_message($userdata, $message);
?>

<form method="post" action="<?php echo site_url('enquiries/send') ?>" id="enquiry-form">
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="name">Name *</label>
			<div class="controls">
				<input class="input-xlarge" type="text" name="name" id="name" value="<?php echo set_value('name', $name); ?>" maxlength="150">
				<?php echo form_error('name'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="email">Email Address *</label>
			<div class="controls">
				<input class="input-xlarge" type="text" name="email" id="email" value="<?php echo set_value('email', $email); ?>" maxlength="150">
				<?php echo form_error('email'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="message">Message *</label>
			<div class="controls">
				<textarea class="input-xlarge" name="message" id="message"><?php echo set_value('message', $message); ?></textarea>
				<?php echo form_error('message'); ?>
			</div>
		</div>		
	</fieldset>
	
	<div class="form-actions">
		<input type="submit" name="submit" id="submit" value="Send Message" class="btn btn-primary">
	</div>
</form>

<script src="public/assets/js/jquery.validate.js"></script>
<script>
jQuery(function($) {
	// form validation (http://docs.jquery.com/Plugins/Validation)
	$("#enquiry-form").validate({
		rules:{
			name:{required:true, maxlength:150}
			, email:{required:true, email:true, maxlength:100}
			, message:{required:true}
		},
		messages:{
			name:{required:"Enter your name", maxlength:"Your name must not exceed 150 characters"}
			, email:{required:"Enter your email address", email:"Enter a valid email address", maxlength:"Your email address must not exceed 150 characters"}
			, message:{required:"Enter your message"}
		}
	});
});
</script>