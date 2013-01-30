<h1>Users</h1>
  
<p><a href="<?php echo site_url('users/maintain') ?>" class="btn btn-primary">Add User <i class="icon-chevron-right icon-white"></i></a></p>

<?php require_once ('views/helpers/messages.php'); ?>

<?php if(count($users)) { ?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Last Updated</th>
				<th class="center">&nbsp;</th>
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
						<?php $deletelnk = array('users/delete', $user->id); ?>
						<a href="<?php echo site_url($deletelnk) ?>" onclick="return confirm('Are you sure want to delete this user?')"><i class="icon-remove"></i></a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
<?php } else { ?>
	<p>There are no users at this time.</p>
<?php } ?>