<?php

loader_import ('siteforge.Filters');
loader_import ('siteforge.Functions');

header ('Content-Type: application/rss+xml');

$bugs = db_fetch_array (
	'select * from siteforge_bug where proj_id = ? and status != "resolved" order by ts desc limit 10',
	$parameters['proj']
);

echo template_simple (
	'rss_bugs.spt',
	array (
		'list' => $bugs,
		'proj' => $parameters['proj'],
	)
);

exit;

?>