<p>The public facing site is coming soon...</p>

<p><a href="../admin" class="btn btn-primary" target="_blank">Access Site Manager <span class="icon-chevron-right icon-white"></span></a></p>

<?php 
$prevLevel = -1;
$currLevel = -1;

foreach($pages as $page) {
	$currLevel = $page->depth;

	if($currLevel > $prevLevel) {
		echo '<ul class="depth-' . $page->depth . '"><li><a href="' . site_url($page->slug) . '">' . $page->title . '</a>';
	} else if ($currLevel < $prevLevel) {
		$tmp = $prevLevel;

		while($tmp > $currLevel) {
			echo '</li></ul>';

			$tmp -= 1;
		}

		echo '</li><li><a href="' . site_url($page->slug) . '">' . $page->title . '</a>';
	} else {
		echo '</li><li><a href="' . site_url($page->slug) . '">' . $page->title . '</a>';
	}

	$prevLevel = $page->depth;
}
$tmp = $currLevel;

while($tmp > 0) {
	echo '</li></ul>';

	$tmp -= 1;
}
?>