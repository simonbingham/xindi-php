<h1>Enquiries</h1>

<?php 
$userdata = $this->session->all_userdata();
$message = isset($message) ? $message : '';
echo render_message($userdata, $message);
?>

<?php if(count($enquiries)) { ?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Received</th>
				<th class="center">View</th>
				<th class="center">Delete</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($enquiries as $enquiry) { ?>
				<tr <?php if(! $enquiry->is_read) { ?>style="font-weight:bold;"<?php } ?>>
					<td><?php echo $enquiry->name ?></td>
					<td><a href="mailto:<?php echo $enquiry->email; ?>"><?php echo $enquiry->email ?></a></td>
					<td><?php echo format_date($enquiry->created) ?></td>
					<td class="center">
						<?php $enquirylnk = array('enquiries/enquiry', $enquiry->id); ?>
						<a href="<?php echo site_url($enquirylnk) ?>" title="View"><i class="icon-eye-open"></i></a>
					</td>
					<td class="center">
						<?php $deletelnk = array('enquiries/delete', $enquiry->id); ?>
						<a href="<?php echo site_url($deletelnk) ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this enquiry?')"><i class="icon-trash"></i></a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	
	<p><span class="label label-info">Note</span> Unread enquiries are highlighted in bold.</p>
<?php } else { ?>
	<p>There are no enquiries at this time.</p>
<?php } ?>