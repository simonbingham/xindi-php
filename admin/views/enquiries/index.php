<h1>Enquiries</h1>

<?php 
$userdata = $this->session->all_userdata();
$message = isset($message) ? $message : '';
echo render_message($userdata, $message);
?>

<?php if(count($enquiries)) { ?>
	<form action="<?php echo site_url('enquiries/mark_read') ?>" method="post" id="enquiry-list">
		<table class="table table-striped table-bordered table-condensed">
			<thead>
				<tr>
					<?php if($unread_count) { ?>
						<th class="center"><input type="checkbox" name="toggle_all"></th>
						<th>&nbsp;</th>
					<?php } ?>
					<th>Name</th>
					<th>Email</th>
					<th>Received</th>
					<th class="center">View</th>
					<th class="center">Delete</th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach($enquiries as $enquiry) { ?>
					<tr>
						<?php if($unread_count) { ?>
							<td class="center"><input type="checkbox" name="id[]" value="<?php echo $enquiry->id ?>"></td>
							<td>
								<?php if(! $enquiry->isread) { ?>
										<span class="label label-info">new</span>
								<?php } ?>
							</td>
						<?php } ?>
						<td><?php echo $enquiry->name ?></td>
						<td><a href="mailto:<?php echo $enquiry->email; ?>"><?php echo $enquiry->email ?></a></td>
						<td><?php echo format_date($enquiry->created) ?></td>
						<td class="center">
							<?php $enquirylnk = array('enquiries/enquiry', $enquiry->id); ?>
							<a href="<?php echo site_url($enquirylnk) ?>" title="View"><i class="icon-eye-open"></i></a>
						</td>
						<?php // TODO: implement delete functionality using checkboxes ?>
						<td class="center">
							<?php $deletelnk = array('enquiries/delete', $enquiry->id); ?>
							<a href="<?php echo site_url($deletelnk) ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this enquiry?')"><i class="icon-trash"></i></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		
		<?php if($unread_count) { ?>
			<input type="submit" name="submit" value="Mark As Read" class="btn btn-primary">
		<?php } ?>
	</form>
	
	<script>
	jQuery(function($) {
		$(':checkbox[name=toggle_all]').click(function () {
			$(':checkbox[name=id[]]').prop('checked', this.checked);
		});		
	});
	</script>	
	
<?php } else { ?>
	<p>There are no enquiries at this time.</p>
<?php } ?>