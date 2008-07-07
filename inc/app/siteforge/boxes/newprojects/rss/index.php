<?php

loader_import ('siteforge.Filters');
loader_import ('siteforge.Functions');

header ('Content-Type: application/rss+xml');

echo template_simple (
	'rss_newprojects.spt',
	array (
		'list' => db_fetch_array (
			'select * from siteforge_project where (status = 2 or status > 3) order by ts desc limit 10'
		),
	)
);

exit;

?>