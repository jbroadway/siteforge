<?php

loader_import ('siteforge.Filters');
loader_import ('siteforge.Functions');

header ('Content-Type: application/rss+xml');

if ($parameters['proj']) {
	$news = db_fetch_array (
		'select id, headline, ts from siteforge_news where proj_id = ? order by ts desc limit 10',
		$parameters['proj']
	);

	echo template_simple (
		'rss_news.spt',
		array (
			'list' => $news,
			'proj' => $parameters['proj'],
		)
	);
} else {
	$news = db_fetch_array (
		'select id, proj_id, headline, ts from siteforge_news order by ts desc limit 10'
	);
	echo template_simple (
		'rss_news_global.spt',
		array (
			'list' => $news,
		)
	);
}

exit;

?>