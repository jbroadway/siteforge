<?php

// 1. verify the project

if (! db_shift ('select count(*) from siteforge_project where id = ?', $parameters['proj'])) {
	page_title (intl_get ('Project Not Found'));
	echo '<a href="#" onclick="history.go (-1)">' . intl_get ('Back') . '</a>';
	return;
}

$ext = db_shift ('select ext_forum from siteforge_project where id = ?', $parameters['proj']);
if (! empty ($ext)) {
	header ('Location: ' . $ext);
	exit;
}

loader_import ('siteforge.Filters');
loader_import ('siteforge.Functions');

page_title (siteforge_filter_proj ($parameters['proj']) . ' - ' . intl_get ('Forum'));

$parameters['list'] = db_fetch_array (
	'select * from siteforge_forum where proj_id = ? order by name asc',
	$parameters['proj']
);

$forums = array ();

foreach (array_keys ($parameters['list']) as $k) {
	$parameters['list'][$k]->threads = db_shift (
		'select count(*) from siteforge_forum_post where forum_id = ? and post_id is null',
		$parameters['list'][$k]->id
	);
	$parameters['list'][$k]->posts = db_shift (
		'select count(*) from siteforge_forum_post where forum_id = ?',
		$parameters['list'][$k]->id
	);
	$parameters['list'][$k]->latest = db_fetch_array (
		'select id, user_id, posted, post_id, subject from siteforge_forum_post where forum_id = ? order by posted desc limit 1',
		$parameters['list'][$k]->id
	);
	$forums[] = $parameters['list'][$k]->id;
}

$parameters['stats'] = array (
	array (
		'name' => intl_get ('Active Users'),
		'title' => intl_get ('Users who are currently logged into the forum or website.'),
		'total' => session_user_get_active (),
	),
	array (
		'name' => intl_get ('Total Users'),
		'title' => intl_get ('Total number of registered users.'),
		'total' => session_user_get_total (false, false, false),
	),
	array (
		'name' => intl_get ('Today\'s Posts'),
		'title' => intl_get ('Number of forum postings made today.'),
		'total' => db_shift (
			'select count(*) from siteforge_forum_post where forum_id in(' . join (',', $forums) . ') and posted >= ?',
			date ('Y-m-d 00:00:00')
		),
	),
	array (
		'name' => intl_get ('This Week\'s Posts'),
		'title' => intl_get ('Number of forum postings made this week.'),
		'total' => db_shift (
			'select count(*) from siteforge_forum_post where forum_id in(' . join (',', $forums) . ') and posted >= ?',
			date ('Y-m-d 00:00:00', time () - 604800)
		),
	),
	array (
		'name' => intl_get ('Total Posts'),
		'title' => intl_get ('Total number of forum postings.'),
		'total' => db_shift ('select count(*) from siteforge_forum_post where forum_id in(' . join (',', $forums) . ')'),
	),
);

echo template_simple (
	'forum.spt',
	$parameters
);

page_add_link (
	'alternate',
	'application/rss+xml',
	site_url () . '/index/siteforge-forum-rss-action/proj.' . $parameters['proj'],
	false,
	false,
	intl_get ('Latest Forum Posts')
);

?>
