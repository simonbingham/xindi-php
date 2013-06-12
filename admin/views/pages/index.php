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
				<th class="center">View</th>
				<th class="center"><abbr title="Add a page below this page in the site hierarchy">Add</abbr></th>
				<th class="center">Sort</th>
				<th class="center">Edit</th>
				<th class="center">Delete</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($pages as $page) { ?>
				<tr>
					<td style="padding-left:<?php echo $page->depth * 15 + 5; ?>px"><?php echo $page->title ?></td>
					<td><?php echo format_date($page->updated) ?></td>
					<td class="center"><a href="<?php echo str_replace('/admin/', '/', site_url($page->slug)); ?>" title="View page [opens in new tab]" target="_blank"><i class="icon-eye-open"></i></a></td>					
					<td class="center">
						<?php // restrict page depth to three levels ?>
						<?php if($page->depth < 2) { ?>
							<?php $createlnk = array('pages','maintain','ancestor_id',$page->id); ?>
							<a href="<?php echo site_url($createlnk) ?>" title="Add page"><i class="icon-plus"></i></a>
						<?php } ?>
					</td>
					<td class="center">
						<?php if($page->right_value - $page->left_value > 1) { ?>
							<?php $sortlnk = array('pages/sort', $page->id); ?>
							<a href="<?php echo site_url($sortlnk) ?>" title="Sort"><i class="icon-retweet"></i></a>
						<?php } ?>
					</td>						
					<td class="center">
						<?php $updatelnk = array('pages/maintain', $page->id); ?>
						<a href="<?php echo site_url($updatelnk) ?>" title="Edit"><i class="icon-pencil"></i></a>
					</td>					
					<td class="center">
						<?php // the home page and pages with associated child pages cannot be deleted ?>
						<?php if($page->depth <> 0 && $page->right_value - $page->left_value == 1) { ?>
							<?php $deletelnk = array('pages/delete', $page->id); ?>
							<a href="<?php echo site_url($deletelnk) ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this page?')"><i class="icon-trash"></i></a>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	
	<p><span class="label label-info">Note</span> A maximum of three levels of pages can be added.</p>
	<p><span class="label label-info">Note</span> The home page and pages with associated child pages cannot be deleted.</p>
<?php } else { ?>
	<p>There are no pages at this time.</p>
<?php } ?>