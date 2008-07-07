<?php

loader_import ('siteforge.Filters');
loader_import ('saf.GUI.Pager');

global $cgi;

if (! isset ($cgi->offset)) {
	$cgi->offset = 0;
}

$q = db_query (
	'select * from siteforge_project where category = ? and (status != 1 and status != 3)'
);

if (! $q->execute ($parameters['cat'])) {
	die ($q->error ());
}

$total = $q->rows ();
$projects = $q->fetch ($cgi->offset, 10);
$q->free ();

$pg = new Pager ($cgi->offset, 10, $total);
$pg->setUrl (
	site_prefix () . '/index/siteforge-app?cat=%s',
	$parameters['cat']
);
$pg->getInfo ();

page_title (intl_get ('Category') . ': ' . siteforge_filter_cat ($parameters['cat']));

template_simple_register ('pager', $pg);

echo template_simple (
	'category.spt',
	array (
		'list' => $projects,
	)
);

?>