<?php

global $cgi;

$proj = db_shift ('select proj_id from siteforge_forum where id = ?', $cgi->id);

if (session_admin () || session_username () == db_shift ('select user_id from siteforge_project where id = ?', $proj)) {
} else {
	die ('You are not authorized to delete this post.');
	return;
}

$topic_id = db_shift (
	'select forum_id from siteforge_forum_post where id = ?',
	$cgi->id
);
$topic_name = db_shift (
	'select name from siteforge_forum where id = ?',
	$topic_id
);

db_execute (
	'delete from siteforge_forum_post where id = ?',
	$cgi->id
);

db_execute (
	'delete from siteforge_forum_post where post_id = ?',
	$cgi->id
);

loader_import ('siteforge.Filters');

page_title (intl_get ('Message Deleted'));
echo '<p>' . intl_get ('Your message has been deleted.') . '  <a href="' . site_prefix () . '/index/siteforge-forum-topic-action/id.' . $topic_id . '/title.' . siteforge_filter_name ($topic_name) . '">' . intl_get ('Continue.') . '</a></p>';

?>