<h1>Enquiries</h1>

<?php require_once ('views/helpers/messages.php'); ?>

<?php if(count($enquiries)) { ?>
	<form action="<?php echo site_url('enquiries/mark_read') ?>" method="post" id="enquiry-list">
		<table class="table table-striped table-bordered table-condensed">
			<thead>
				<tr>
					<?php if($unread_count) { ?>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					<?php } ?>
					<th>Name</th>
					<th>Received</th>
					<th class="center">View</th>
					<th class="center">Delete</th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach($enquiries as $enquiry) { ?>
					<tr>
						<?php if($unread_count) { ?>
							<td><input type="checkbox" name="id[]" value="<?php echo $enquiry->id ?>"></td>
							<td>
								<?php if(! $enquiry->read) { ?>
										<span class="label label-info">new</span>
								<?php } ?>
							</td>
						<?php } ?>
						<td><?php echo $enquiry->name ?></td>
						<td><?php echo format_date($enquiry->created) ?></td>
						<td class="center">
							<?php $enquirylnk = array('enquiries/enquiry', $enquiry->id); ?>
							<a href="<?php echo site_url($enquirylnk) ?>" title="View enquiry"><i class="icon-eye-open"></i></a>
						</td>
						<?php // TODO: implement delete functionality using checkboxes ?>
						<td class="center">
							<?php $deletelnk = array('enquiries/delete', $enquiry->id); ?>
							<a href="<?php echo site_url($deletelnk) ?>" title="Delete enquiry" onclick="return confirm('Are you sure want to delete this article?')"><i class="icon-remove"></i></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		
		<?php if($unread_count) { ?>
			<input type="submit" name="submit" value="Mark As Read" class="btn btn-primary" disabled="disabled">
		<?php } ?>
	</form>
	
	<script>
	jQuery(function($) {
		$('#enquiry-list .btn').attr('disabled','disabled');
		$('input:checkbox').click(function() {
			var buttonschecked = $('input:checkbox:checked');
			if (buttonschecked.length) {
				$('#enquiry-list .btn').removeAttr('disabled');
			} else {
				$('#enquiry-list .btn').attr('disabled', 'disabled');
			}
		});
	});
	</script>	
	
<?php } else { ?>
	<p>There are no enquiries at this time.</p>
<?php } ?>