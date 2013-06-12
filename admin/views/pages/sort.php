<h1>Sort Pages</h1>
  
<?php 
$userdata = $this->session->all_userdata();
$message = isset($message) ? $message : '';
echo render_message($userdata, $message);
?>

<ul id="sortable" class="ui-sortable">
	<?php foreach($pages as $page) { ?>
		<li data-pageid="<?php echo $page->id ?>"><i class="icon-retweet"></i> <?php echo $page->title ?></li>
	<?php } ?>
</ul>

<p><span class="label label-info">Note</span> You can move the pages by dragging them to the new position.</p>

<button id="savesort" class="btn btn-primary">Save &amp; exit</button>

<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>window.jQuery.ui || document.write('<script src="assets/js/jquery-ui.min.js"><\/script>')</script>
<script>
jQuery(function ($){
	var originalOrder = [];
	<?php foreach($pages as $page) { ?>
	originalOrder.push({left: <?php echo $page->left_value ?>, right: <?php echo $page->right_value ?>});
	<?php } ?>
		
	$( "#sortable" ).sortable({
		placeholder: "ui-state-highlight"
	}).disableSelection();
		
	$('#savesort').bind('click', function (e){
		// figure out new positions...
		var newOrder = [];
		$('#sortable>li').each(function (i,el){
			newOrder.push( {pageid: parseInt(el.getAttribute('data-pageid')), left: originalOrder[i].left, right: originalOrder[i].right } );	
		});
			
		// send to server
		$.ajax({
			type: 'POST',
			url: '/xindi/index.cfm/admin:pages/savesort',
			data: { payload: JSON.stringify(newOrder) },
			dataType: 'json'
		})
		.done(function (data, textStatus) {
			if (data.saved) {
				window.location.href = '/xindi/index.cfm/admin:pages';
			}
		})
		.fail(function (jqXHR, exception) {})
		.always(function () {});
		e.preventDefault();
	});
});
</script>