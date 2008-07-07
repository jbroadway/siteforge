<?php

loader_import ('siteforge.Filters');
loader_import ('siteforge.Functions');

// 1. find the project

$proj = db_single (
	'select * from siteforge_project where id = ?',
	$parameters['proj']
);

if (! $proj) {
	page_title (intl_get ('Project Not Found'));
	echo '<a href="#" onclick="history.go (-1)">' . intl_get ('Back') . '</a>';
	return;
}

// 2. track visitor stats

db_execute (
	'insert into siteforge_stat
		(id, proj_id, ts, dl_file, ip)
	values
		(null, ?, now(), null, ?)',
	$parameters['proj'],
	$_SERVER['REMOTE_ADDR']
);

$proj->members = db_shift_array (
	'select user_id from siteforge_project_member where proj_id = ?',
	$parameters['proj']
);

// 3. show the project page

page_title (siteforge_filter_proj ($parameters['proj']));

echo template_simple (
	'project.spt',
	$proj
);

?>