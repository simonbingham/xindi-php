<h1>Forgotten Password</h1>

<?php 
$userdata = $this->session->all_userdata();
$message = isset($message) ? $message : '';
echo render_message($userdata, $message);
?>

<form method="post" action="<?php echo site_url('security/doforgottenpassword') ?>" id="forgotten-password-form" class="clear">
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="email">Email Address *</label>
			<div class="controls">
				<input class="input-xlarge" type="text" name="email" id="email" value="" maxlength="50" placeholder="Email Address">
			</div>
		</div>						
	</fieldset>
	
	<div class="form-actions">
		<input type="submit" name="submit" id="submit" value="Send Password" class="btn btn-primary">
	</div>
</form>

<script src="assets/js/jquery.validate.js"></script>
<script>
jQuery(function($) {
	// form validation (http://docs.jquery.com/Plugins/Validation)
	$("#forgotten-password-form").validate({
		rules:{
			email:{required:true, email:true, maxlength:100}
		},
		messages:{
			email:{required:"Enter your email address", email:"Enter a valid email address"}
		}
	});
});
</script>