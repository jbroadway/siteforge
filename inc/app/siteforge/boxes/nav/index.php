<?php

loader_import ('siteforge.Filters');

page_add_link (
	'alternate',
	'application/rss+xml',
	site_url () . '/index/siteforge-news-rss-action/proj.' . $parameters['proj'],
	false,
	false,
	siteforge_filter_proj ($parameters['proj']) . ' - ' . intl_get ('Project News')
);

page_add_link (
	'alternate',
	'application/rss+xml',
	site_url () . '/index/siteforge-bugs-rss-action/proj.' . $parameters['proj'],
	false,
	false,
	siteforge_filter_proj ($parameters['proj']) . ' - ' . intl_get ('Latest Bugs')
);

echo template_simple (
	'nav.spt',
	$parameters
);

?>