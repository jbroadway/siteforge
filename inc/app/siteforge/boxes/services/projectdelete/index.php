<?php

if ($parameters['collection'] != 'siteforge_project') {
	return;
}

if (! is_array ($parameters['key'])) {
	$parameters['key'] = array ($parameters['key']);
}

foreach ($parameters['key'] as $proj) {
	foreach (db_shift_array ('select id from siteforge_bug where proj_id = ?', $proj) as $bug) {
		db_execute ('delete from siteforge_bug_comment where bug_id = ?', $bug);
	}
	db_execute ('delete from siteforge_bug where proj_id = ?', $proj);
	db_execute ('delete from siteforge_news where proj_id = ?', $proj);
	db_execute ('delete from siteforge_doc where proj_id = ?', $proj);
	db_execute ('delete from siteforge_project_member where proj_id = ?', $proj);
	db_execute ('delete from siteforge_stat where proj_id = ?', $proj);
	foreach (db_shift_array ('select id from siteforge_forum where proj_id = ?', $proj) as $forum) {
		db_execute ('delete from siteforge_forum_post where forum_id = ?', $forum);
	}
	db_execute ('delete from siteforge_forum where proj_id = ?', $proj);
}

?>