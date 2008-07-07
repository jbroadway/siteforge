<?php

// This is where app-level variables can be centrally stored.  This file is
// automatically included when the first call to your app is made.  Use the
// appconf_set ('name', 'value'); function to add values here.

// This is the name of the project site as displayed on the SiteForge index
// page.
appconf_set ('name', 'Welcome to SiteForge');

// This is the email address of the owner of the whole site.
appconf_set ('admin_email', 'you@' . str_replace ('www.', '', site_domain ()));

// This is the base folder under which all CVS root folders will be created.
appconf_set ('cvs_base', '/usr/local/cvsroot');

// Up to five extras are allowed here.  An extra is a added property for bug
// reporting.  They are specified as an array of key/value pairs where the
// key is the name of the extra property as will be shown to the site users,
// and the value is an array of possible values for this extra.
appconf_set ('extras', array (
	intl_get ('PHP Version') => array (
		'4.1.x',
		'4.2.x',
		'4.3.x',
		'4.4.x',
		'5.0.x',
		'5.1.x',
		'5.2.x',
		'6.0.x',
	),
	intl_get ('Server OS') => array (
		'Linux',
		'Mac OS X',
		'Windows',
		'*BSD',
		'Solaris',
		'Other',
	),
	intl_get ('Sitellite Version') => array (
		'4.0.x',
		'4.2.x',
		'4.3.x',
		'5.0.x',
	),
));

// Below we are adding the main RSS feeds.  You do not need to customize
// these.  They are simply included here to eliminate including them
// in every box of the application.
page_add_link (
	'alternate',
	'application/rss+xml',
	site_url () . '/index/siteforge-newprojects-rss-action',
	false,
	false,
	intl_get ('New Projects')
);

page_add_link (
	'alternate',
	'application/rss+xml',
	site_url () . '/index/siteforge-news-rss-action',
	false,
	false,
	intl_get ('Site-Wide News')
);

page_add_script (
	'function siteforge_preview (f) {
		t = f.target;
		a = f.action;

		f.target = "_blank";
		f.action = "' . site_prefix () . '/index/siteforge-preview-action";
		f.submit ();

		f.target = t;
		f.action = a;
		return false;
	}'
);

?>