<?php

loader_import ('siteforge.Filters');
loader_import ('siteforge.Functions');

global $cgi;

if (! isset ($cgi->offset)) {
	$cgi->offset = 0;
}

$topic = db_single ('select * from siteforge_forum where id = ?', $parameters['id']);

$parameters['proj'] = $topic->proj_id;

page_title (siteforge_filter_proj ($parameters['proj']) . ' - ' . intl_get ('Forum') . ' / ' . $topic->name);

$q = db_query (
	'select * from siteforge_forum_post where forum_id = ? and (post_id is null or post_id = 0) order by updated desc'
);

if (! $q->execute ($parameters['id'])) {
	page_title (intl_get ('An Error Occurred'));
	echo '<p>' . intl_get ('Error Message') . ': ' . $q->error () . '</p>';
	return;
}

$total = $q->rows ();
$parameters['list'] = $q->fetch ($cgi->offset, 10);
$q->free ();

foreach (array_keys ($parameters['list']) as $k) {
	$parameters['list'][$k]->replies = db_shift (
		'select count(*) from siteforge_forum_post where post_id = ?',
		$parameters['list'][$k]->id
	);
	$parameters['list'][$k]->latest = db_fetch_array (
		'select id, user_id, posted, post_id, subject from siteforge_forum_post where (post_id = ? or id = ?) order by posted desc limit 1',
		$parameters['list'][$k]->id,
		$parameters['list'][$k]->id
	);
}

loader_import ('saf.GUI.Pager');

$pg = new Pager ($cgi->offset, 10, $total);
$pg->setUrl (
	site_prefix () . '/index/siteforge-forum-topic-action?id=' . $parameters['id']
);
$pg->getInfo ();

template_simple_register ('pager', $pg);

echo template_simple (
	'forum_topic.spt',
	$parameters
);

page_add_link (
	'alternate',
	'application/rss+xml',
	site_url () . '/index/siteforge-forum-rss-action/proj.' . $parameters['proj'] . '/topic.' . $parameters['id'],
	false,
	false,
	intl_get ('Latest Post in this Topic')
);

?>