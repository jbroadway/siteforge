<?php

global $cgi;

$proj = db_shift ('select proj_id from siteforge_forum where id = ?', $cgi->id);

if (session_admin () || session_username () == db_shift ('select user_id from siteforge_project where id = ?', $proj)) {
} else {
	die ('You are not authorized to delete this topic.');
	return;
}

db_execute (
	'delete from siteforge_forum where id = ?',
	$cgi->id
);

db_execute (
	'delete from siteforge_forum_post where forum_id = ?',
	$cgi->id
);

header ('Location: ' . site_prefix () . '/index/siteforge-forum-action/proj.' . $proj);
exit;

?>