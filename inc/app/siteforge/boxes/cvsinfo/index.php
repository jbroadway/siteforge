<?php

// 1. verify the project

if (! db_shift ('select count(*) from siteforge_project where id = ?', $parameters['proj'])) {
	page_title (intl_get ('Project Not Found'));
	echo '<a href="#" onclick="history.go (-1)">' . intl_get ('Back') . '</a>';
	return;
}

loader_import ('siteforge.Filters');

page_title (siteforge_filter_proj ($parameters['proj']) . ' - ' . intl_get ('CVS Information'));

$parameters['cvs_server'] = preg_replace ('/^www\./', '', site_domain ());

$parameters['modules'] = array ();

exec ('ls -A ' . escapeshellarg (appconf ('cvs_base') . '/' . $parameters['proj']), $parameters['modules']);

echo template_simple (
	'cvsinfo.spt',
	$parameters
);

?>
