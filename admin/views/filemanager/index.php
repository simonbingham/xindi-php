<h1>File Manager</h1>

<?php 
$userdata = $this->session->all_userdata();
$message = isset($message) ? $message : '';
echo render_message($userdata, $message);
?>

<?php // if a sub directory is being viewed display a link to the parent directory ?>
<?php if($paths['display'] != '/') { ?>
	<div class="btn-group pull-right" data-toggle="buttons-checkbox">
		<?php $parent_link = array('filemanager', 'index', 'path', urlencode(str_replace($paths['default']. '/', $file_path_delimiter, $paths['parent']))); ?>
		<p><a href="<?php echo site_url($parent_link); ?>" class="btn"><i class="icon-arrow-up"></i> Move Up Level</a></p>
	</div>
<?php } ?>

<p>Location: <?php echo $paths['display']; ?></p>

<?php if(count($map)) { ?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th>File</th>
				<th>Date</th>
				<th>Size</th>
				<th class="center">Delete</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ($map as $file) { ?>
				<?php // $file['server_path'] and $file['relative_path'] also available ?>
				<tr>
					<?php if(strrpos($file['name'], '.')) { ?>
						<td><a href=""><?php echo $file['name']; ?></a></td>
						<td><?php echo date("j M Y, G:i:s", $file['date']); ?></td>
						<td><?php echo number_format($file['size']/1000); ?> KB</td>
						<td class="center"><a href="" title="Delete" onclick="return confirm('Are you sure you want to delete this file?')"><i class="icon-trash"></i></a></td>
					<?php } else { ?>
						<?php 
						$encoded_directory = preg_replace('"/"', $file_path_delimiter, str_replace($paths['default'], '', $paths['current']) . '/' . $file['name']);
						$sub_directory = array('filemanager', 'index', 'path', urlencode($encoded_directory)); 
						?>
						<td><a href="<?php echo site_url($sub_directory); ?>"><?php echo $file['name']; ?></a></td>
						<td><?php echo date("j M Y, G:i:s", $file['date']); ?></td>
						<td></td>
						<td class="center"><a href="" title="Delete" onclick="return confirm('Are you sure you want to delete this file?')"><i class="icon-trash"></i></a></td>
					<?php } ?>
				</tr>
			<?php }	?>
		</tbody>
	</table>

	<!--
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th>File</th>
				<th class="center">Delete</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ($map as $directory => $file) { ?>
				<?php if (!is_array($file)) { ?>
					<tr>
						<td><a href=""><?php echo $file; ?></a></td>
						<td class="center"><a href="" title="Delete" onclick="return confirm('Are you sure you want to delete this file?')"><i class="icon-trash"></i></a></td>
					</tr>
				<?php } else { ?>
					<?php 
					$pattern = '"/"';
					$encoded_directory = preg_replace($pattern, $file_path_delimiter, str_replace($paths['default'], '', $paths['current']) . '/' . $directory);
					$sub_directory = array('filemanager', 'index', 'path', urlencode($encoded_directory)); 
					?>
					<tr>
						<td><a href="<?php echo site_url($sub_directory); ?>"><?php echo $directory; ?></a></td>
						<td class="center"><a href="" title="Delete" onclick="return confirm('Are you sure you want to delete this directory?')"><i class="icon-trash"></i></a></td>
					</tr>
				<?php } ?>
			<?php }	?>
		</tbody>
	</table>
	-->
<?php } else { ?>
	<p>There are no files at this time.</p>
<?php } ?>