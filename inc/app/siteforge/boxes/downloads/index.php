<?php

// 1. verify the project

if (! db_shift ('select count(*) from siteforge_project where id = ?', $parameters['proj'])) {
	page_title (intl_get ('Project Not Found'));
	echo '<a href="#" onclick="history.go (-1)">' . intl_get ('Back') . '</a>';
	return;
}

if (strpos ($parameters['proj'], '..') !== false) {
	die ('Invalid project ID');
}

loader_import ('saf.File.Directory');
loader_import ('siteforge.Filters');
loader_import ('siteforge.Functions');

$flist = Dir::fetch ('inc/app/siteforge/data/' . $parameters['proj']);
$files = array ();

foreach ($flist as $k => $v) {
	if (strpos ($v, '.') === 0) {
		continue;
	}
	$files[$v] = array (
		'time' => filemtime ('inc/app/siteforge/data/' . $parameters['proj'] . '/' . $v),
		'size' => filesize ('inc/app/siteforge/data/' . $parameters['proj'] . '/' . $v),
	);
}

arsort ($files);

if ($context != 'action') {
	// limit to newest three
	$flist = $files;
	$files = array ();
	$c = 0;
	foreach ($flist as $k => $v) {
		$files[$k] = $v;
		$c++;
		if ($c >= 3) {
			break;
		}
	}
} else {
	page_title (siteforge_filter_proj ($parameters['proj']) . ' - ' . intl_get ('Downloads'));

	echo loader_box ('siteforge/nav', $parameters);
}

echo template_simple (
	'downloads.spt',
	array (
		'list' => $files,
		'context' => $context,
		'proj' => $parameters['proj'],
		'user' => db_shift ('select user_id from siteforge_project where id = ?', $parameters['proj']),
	)
);

?>