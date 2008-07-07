<?php

loader_import ('siteforge.Filters');
loader_import ('siteforge.Functions');

header ('Content-Type: application/rss+xml');

if ($parameters['topic']) {
	$list = db_fetch_array (
		'select * from siteforge_forum_post where forum_id = ? order by posted desc limit 10',
		$parameters['topic']
	);

	echo template_simple (
		'rss_forum_topic.spt',
		array (
			'list' => $list,
			'name' => db_shift ('select name from siteforge_forum where id = ?', $parameters['topic']),
		)
	);
} elseif ($parameters['post']) {
	$post = db_single ('select subject from siteforge_forum_post where id = ?', $parameters['post']);
	$list = db_fetch_array (
		'select * from siteforge_forum_post where id = ? or post_id = ? order by posted desc limit 10',
		$parameters['post'],
		$parameters['post']
	);

	echo template_simple (
		'rss_forum_post.spt',
		array (
			'list' => $list,
			'name' => $post->subject,
			'topic' => db_shift ('select name from siteforge_forum where id = ?', $post->forum_id),
		)
	);
} elseif ($parameters['proj']) {
	$list = db_fetch_array (
		'select p.* from siteforge_forum_post p, siteforge_forum f where p.forum_id = f.id and f.proj_id = ? order by p.posted desc limit 10',
		$parameters['proj']
	);

	echo template_simple (
		'rss_forum.spt',
		array (
			'list' => $list,
			'proj' => $parameters['proj'],
		)
	);
} else {
	$list = db_fetch_array (
		'select * from siteforge_forum_post order by posted desc limit 10'
	);

	echo template_simple (
		'rss_forum.spt',
		array (
			'list' => $list,
		)
	);
}

exit;

?>