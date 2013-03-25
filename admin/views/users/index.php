<h1>Users</h1>
  
<p><a href="<?php echo site_url('users/maintain') ?>" class="btn btn-primary">Add User <i class="icon-chevron-right icon-white"></i></a></p>

<?php 
$userdata = $this->session->all_userdata();
$message = isset($message) ? $message : '';
echo render_message($userdata, $message);
?>

<?php if(count($users)) { ?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Last Updated</th>
				<th class="center">Delete</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($users as $user) { ?>
				<tr>
					<td>
						<?php $editlnk = array('users/maintain', $user->id); ?>
						<a href="<?php echo site_url($editlnk) ?>"><?php echo $user->name ?></a>
					</td>
					<td><?php echo $user->email ?></td>
					<td><?php echo $user->updated ?></td>
					<td class="center">
						<?php 
						if ($this->session->userdata('id') != $user->id) 
						{
						?>
							<?php $deletelnk = array('users/delete', $user->id); ?>
							<a href="<?php echo site_url($deletelnk) ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this user?')"><i class="icon-trash"></i></a>
						<?php 
						}
						?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	
	<p><span class="label label-info">Note</span> You are not permitted to delete your own user account.</p>
<?php } else { ?>
	<p>There are no users at this time.</p>
<?php } ?>