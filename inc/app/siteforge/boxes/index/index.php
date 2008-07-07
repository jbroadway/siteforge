<?php

loader_import ('siteforge.Filters');

if (isset ($parameters['doc'])) {
	// show document
	echo loader_box ('siteforge/doc', $parameters);
} elseif (isset ($parameters['proj'])) {
	// show project page
	echo loader_box ('siteforge/project', $parameters);
} elseif (isset ($parameters['cat'])) {
	// show category listing
	echo loader_box ('siteforge/category', $parameters);
} else {
	// show default global index
	page_title (appconf ('name'));
	echo template_simple ('index.spt', $parameters);
}

?>
