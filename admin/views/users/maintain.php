<?php 
if(! $id) 
{
	echo "<h1>Add User</h1>";
} else {
	echo "<h1>Edit User</h1>";
}

$userdata = $this->session->all_userdata();
$message = isset($message) ? $message : '';
echo render_message($userdata, $message);
?>

<p class="pull-right">
	<a href="<?php echo site_url('users/index') ?>" class="btn btn-mini"><i class="icon-arrow-left"></i> Back to User List</a>
	<?php $deletelnk = array('users/delete', $id); ?>
	<a href="<?php echo site_url($deletelnk) ?>" title="Delete user" onclick="return confirm('Are you sure you want to delete this user?')" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete</a>
</p>

<form method="post" action="<?php echo site_url('users/save') ?>" id="user-form" class="clear">
	<fieldset>
		<legend>User Details</legend>	

		<div class="control-group">
			<label class="control-label" for="name">Name *</label>
			<div class="controls">
				<input class="input-xlarge" type="text" name="name" id="name" value="<?php echo set_value('name', $name); ?>" maxlength="50">
				<?php echo form_error('name'); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="email">Email Address *</label>
			<div class="controls">
				<input class="input-xlarge" type="text" name="email" id="email" value="<?php echo set_value('email', $email); ?>" maxlength="50">
				<?php echo form_error('email'); ?>
			</div>
		</div>						

		<div class="control-group">
			<label class="control-label" for="password">Password <?php echo !$id ? '*' : ''; ?></label>
			<div class="controls">
				<input class="input-xlarge" type="password" name="password" id="password" value="" maxlength="50">
				<?php echo form_error('password'); ?>
			</div>
		</div>			
	</fieldset>
	
	<div class="form-actions">
		<input type="submit" name="submit" value="Save &amp; continue" class="btn btn-primary">
		<input type="submit" name="submit" id="submit" value="Save &amp; exit" class="btn btn-primary">
		<a href="<?php echo site_url('users/index') ?>" class="btn cancel">Cancel</a>
	</div>
	
	<input type="hidden" name="id" id="id" value="<?php echo set_value('id', $id); ?>">
	<input type="hidden" name="context" id="context" value="<?php echo $context; ?>">
</form>

<script src="assets/js/jquery.validate.js"></script>
<script>
jQuery(function($) {
	// form validation (http://docs.jquery.com/Plugins/Validation)
	$("#user-form").validate({
		rules:{
			name:{required:true, maxlength:50}
			, email:{required:true, email:true, maxlength:100}
			, password:{<?php echo $context === 'create' ? 'required:true, minlength:8' : ''; ?>}
		},
		messages:{
			name:{required:"The name field is required"}
			, email:{required:"The email address field is required", email:"Enter a valid email address"}
			, password:{required:"The password field is required", minlength:"Your password must be at least 8 characters long"}
		}
	});
});
</script>