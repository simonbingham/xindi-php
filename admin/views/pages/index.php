<h1>Pages</h1>

<?php 
$userdata = $this->session->all_userdata();
$message = isset($message) ? $message : '';
echo render_message($userdata, $message);
?>

<?php if(count($pages)) { ?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th>Title</th>
				<th>Last Updated</th>
				<th class="center">&nbsp;</th>
				<th class="center">&nbsp;</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($pages as $page) { ?>
				<tr>
					<td style="padding-left:<?php echo $page->depth * 15 + 5; ?>px">
						<?php $updatelnk = array('pages/maintain', $page->id); ?>
						<a href="<?php echo site_url($updatelnk) ?>"><?php echo $page->title ?> </a>
					</td>
					<td><?php echo format_date($page->updated) ?></td>
					<td class="center">
						<?php // limit page depth to two tiers ?>
						<?php if($page->depth < 2) { ?>
							<?php $createlnk = array('pages','maintain','ancestorid',$page->id); ?>
							<a href="<?php echo site_url($createlnk) ?>"><i class="icon-plus"></i></a>
						<?php } ?>
					</td>
					<td class="center">
						<?php // the home page and pages with children cannot be deleted ?>
						<?php if($page->depth <> 0 && $page->rightvalue - $page->leftvalue == 1) { ?>
							<?php $deletelnk = array('pages/delete', $page->id); ?>
							<a href="<?php echo site_url($deletelnk) ?>" onclick="return confirm('Are you sure want to delete this page?')"><i class="icon-remove"></i></a>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
<?php } else { ?>
	<p>There are no pages at this time.</p>
<?php } ?>