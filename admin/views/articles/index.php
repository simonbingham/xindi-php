<h1>News</h1>

<p><a href="<?php echo site_url('articles/maintain') ?>" class="btn btn-primary">Add Article <i class="icon-chevron-right icon-white"></i></a></p>

<?php 
$userdata = $this->session->all_userdata();
$message = isset($message) ? $message : '';
echo render_message($userdata, $message);
?>

<?php if(count($articles)) { ?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th>Title</th>
				<th>Published</th>
				<th>Last Updated</th>
				<th class="center">Edit</th>
				<th class="center">Delete</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($articles as $article) { ?>
				<tr>
					<td><?php echo $article->title ?></td>
					<td><?php echo format_date($article->published, 'd/m/Y') ?></td>
					<td><?php echo format_date($article->updated) ?></td>
					<td class="center">
						<?php $editlnk = array('articles/maintain', $article->id); ?>
						<a href="<?php echo site_url($editlnk) ?>" title="Edit"><i class="icon-pencil"></i></a>
					</td>					
					<td class="center">
						<?php $deletelnk = array('articles/delete', $article->id); ?>
						<a href="<?php echo site_url($deletelnk) ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this article?')"><i class="icon-trash"></i></a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
<?php } else { ?>
	<p>There are no articles at this time.</p>
<?php } ?>