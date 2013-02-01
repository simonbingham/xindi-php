<h1>Pages</h1>

<p><a href="<?php echo site_url('pages/maintain') ?>" class="btn btn-primary">Add Page <i class="icon-chevron-right icon-white"></i></a></p>

<?php require_once ('views/helpers/messages.php'); ?>

<?php if(count($pages)) { ?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th>Title</th>
				<th>Last Updated</th>
				<th class="center">&nbsp;</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($pages as $page) { ?>
				<tr>
					<td>
						<?php $editlnk = array('pages/maintain', $page->id); ?>
						<a href="<?php echo site_url($editlnk) ?>"><?php echo $page->title ?></a>
					</td>
					<td><?php echo format_date($page->updated) ?></td>
					<td class="center">
						<?php $deletelnk = array('pages/delete', $page->id); ?>
						<a href="<?php echo site_url($deletelnk) ?>" onclick="return confirm('Are you sure want to delete this page?')"><i class="icon-remove"></i></a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
<?php } else { ?>
	<p>There are no pages at this time.</p>
<?php } ?>