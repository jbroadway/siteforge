<?php

loader_import ('siteforge.Filters');

echo template_simple (
	'newprojects.spt',
	array (
		'list' => db_fetch_array (
			'select * from siteforge_project where (status = 2 or status > 3) order by ts desc limit 5'
		),
	)
);

?>