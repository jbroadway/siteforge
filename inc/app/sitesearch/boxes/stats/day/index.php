<?php

loader_import ('sitesearch.Filters');
loader_import ('sitesearch.Logger');
loader_import ('saf.GUI.Pager');

// single day's searches

$logger = new SiteSearchLogger;

global $cgi;

if (empty ($cgi->date)) {
	$cgi->date = date ('Y-m-d');
}

if (! isset ($cgi->offset)) {
	$cgi->offset = 0;
}

$res = $logger->getSearches ($cgi->date, $cgi->offset, 20);
if (! is_array ($res)) {
	$res = array ();
}

$pg = new Pager ($cgi->offset, 20, $logger->total);
$pg->getInfo ();
$pg->setUrl (site_prefix () . '/index/sitesearch-stats-day-action?date=%s', $cgi->date);

page_title ('SiteSearch - Searches by Day - ' . sitesearch_filter_shortdate ($cgi->date));

template_simple_register ('pager', $pg);
echo template_simple ('stats_day.spt', array ('list' => $res));

?>