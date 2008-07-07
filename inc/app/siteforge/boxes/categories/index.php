<?php

loader_import ('siteforge.Filters');

$categories = db_fetch_array (
	'select * from siteforge_category order by name asc'
);

foreach (array_keys ($categories) as $k) {
	$categories[$k]->count = db_shift (
		'select count(*) from siteforge_project where category = ? and (status = 2 or status > 3)',
		$categories[$k]->id
	);
}

echo template_simple (
	'categories.spt',
	array (
		'list' => $categories,
	)
);

?>