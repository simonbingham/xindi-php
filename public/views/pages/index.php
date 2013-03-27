<?php if(count($breadcrumbs->result())) { ?>
	<ul class="breadcrumb">
		<?php foreach($breadcrumbs->result() as $breadcrumb) { ?>
			<li><a href="<?php echo site_url($breadcrumb->slug); ?>"><?php echo $breadcrumb->title; ?></a> <span class="divider">/</span></li>
		<?php } ?>
		<li><?php echo $title; ?></li>
	</ul>
<?php } ?>

<?php echo $content;?>