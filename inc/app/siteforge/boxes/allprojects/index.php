<?php

loader_import ('siteforge.Filters');
loader_import ('saf.GUI.Pager');

global $cgi;

if (! isset ($cgi->offset)) {
	$cgi->offset = 0;
}

$q = db_query (
	'select * from siteforge_project where (status = 2 or status > 3) order by name asc'
);

if (! $q->execute ()) {
	die ($q->error ());
}

$total = $q->rows ();
$list = $q->fetch ($cgi->offset, 50);
$q->free ();

$pg = new Pager ($cgi->offset, 50, $total);
$pg->setUrl (
	site_prefix () . '/index/siteforge-allprojects-action?'
);
$pg->getInfo ();

page_title (intl_get ('All Projects'));

template_simple_register ('pager', $pg);

echo template_simple (
	'allprojects.spt',
	array (
		'list' => $list,
	)
);

?>