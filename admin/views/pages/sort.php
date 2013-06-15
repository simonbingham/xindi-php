<h1>Sort Pages</h1>

<div class="btn-group pull-right" data-toggle="buttons-checkbox"><a href="<?php echo site_url('pages/index') ?>" class="btn"><i class="icon-arrow-left"></i> Back to Pages</a></div>

<p class="clear">Move a page by clicking and dragging it to the desired position.</p>

<?php 
$userdata = $this->session->all_userdata();
$message = isset($message) ? $message : '';
echo render_message($userdata, $message);
?>

<ul id="sortable" class="ui-sortable">
	<?php foreach($pages as $page) { ?>
		<li data-id="<?php echo $page->id ?>"><i class="icon-retweet"></i> <?php echo $page->title ?></li>
	<?php } ?>
</ul>

<button id="savesort" class="btn btn-primary">Save &amp; exit</button>

<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>window.jQuery.ui || document.write('<script src="assets/js/jquery-ui.min.js"><\/script>')</script>
<script>
jQuery(function ($){
	var originalOrder = [];
	<?php foreach($pages as $page) { ?>
	originalOrder.push({left_value: <?php echo $page->left_value ?>, right_value: <?php echo $page->right_value ?>});
	<?php } ?>
		
	$( "#sortable" ).sortable({
		placeholder: "ui-state-highlight"
	}).disableSelection();
		
	$('#savesort').bind('click', function (e){
		// figure out new positions...
		var newOrder = [];
		$('#sortable > li').each(function (i,el){
			newOrder.push( {id: parseInt(el.getAttribute('data-id')), left_value: originalOrder[i].left_value, right_value: originalOrder[i].right_value } );	
		});
		
		// send to server
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url('pages/save_sort') ?>',
			data: { payload: JSON.stringify(newOrder) }
		})
		.done(function (data, textStatus) {
			if (data) {
				window.location.href = '<?php echo site_url('pages/index/sortordersaved') ?>';
			}
		})
		.fail(function (jqXHR, exception) {})
		.always(function () {});

		e.preventDefault();
	});
});
</script>