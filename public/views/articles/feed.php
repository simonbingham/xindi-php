<?php echo '<?xml version="1.0"?>' . "\n"; ?>
<rss version="2.0">
  <channel>
    <title><?php echo $feed_title; ?></title>
    <link><?php echo $feed_link; ?></link>
    <description><?php echo $feed_description; ?></description>
	<?php foreach($articles as $article): ?>
		<item>
			<title><?php echo $article->title; ?></title>
			<link><?php echo site_url('news/' . $article->slug); ?></link>
			<pubdate><?php echo date('D, d M Y H:i:s O', strtotime($article->published)); ?></pubdate>
		</item>
	<?php endforeach; ?>
  </channel>
</rss>