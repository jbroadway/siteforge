<?php

loader_import ('siteforge.Filters');
loader_import ('siteforge.Functions');

global $cgi;

if (! isset ($cgi->offset)) {
	$cgi->offset = 0;
}

$post = db_single ('select * from siteforge_forum_post where id = ?', $parameters['id']);

$topic = db_single ('select * from siteforge_forum where id = ?', $post->forum_id);

$parameters['forum_id'] = $post->forum_id;
$parameters['forum_name'] = $topic->name;
$parameters['proj'] = $topic->proj_id;
$cgi->proj = $topic->proj_id;

page_title (siteforge_filter_proj ($parameters['proj']) . ' - ' . intl_get ('Forum') . ' / ' . $topic->name . ' / ' . $post->subject);

$q = db_query (
	'select * from siteforge_forum_post where id = ? or post_id = ? order by posted asc'
);

if (! $q->execute ($parameters['id'], $parameters['id'])) {
	page_title (intl_get ('An Error Occurred'));
	echo '<p>' . intl_get ('Error Message') . ': ' . $q->error () . '</p>';
	return;
}

$total = $q->rows ();
$parameters['list'] = $q->fetch ($cgi->offset, 10);
$q->free ();

foreach (array_keys ($parameters['list']) as $k) {
	$parameters['list'][$k]->user_posts = db_shift ('select count(*) from siteforge_forum_post where user_id = ?', $parameters['list'][$k]->user_id);
}

loader_import ('saf.GUI.Pager');

$pg = new Pager ($cgi->offset, 10, $total);
$pg->setUrl (
	site_prefix () . '/index/siteforge-forum-post-action?id=' . $parameters['id']
);
$pg->getInfo ();

template_simple_register ('pager', $pg);

if ($post->post_id) {
	$parameters['id'] = $post->post_id;
}

echo template_simple (
	'forum_post.spt',
	$parameters
);

page_add_link (
	'alternate',
	'application/rss+xml',
	site_url () . '/index/siteforge-forum-rss-action/proj.' . $parameters['proj'] . '/post.' . $parameters['id'],
	false,
	false,
	intl_get ('Responses to this Post')
);

?>