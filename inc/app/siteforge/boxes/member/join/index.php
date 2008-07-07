<?php

if (! $parameters['proj']) {
	die ('No project specified');
}

loader_import ('siteforge.Functions');

if (! siteforge_user_can_join (
	db_shift (
		'select user_id from siteforge_project where id = ?',
		$parameters['proj']
	),
	db_shift_array (
		'select user_id from siteforge_project_member where proj_id = ?',
		$parameters['proj']
))) {
	header ('Location: ' . site_prefix () . '/index/siteforge-app/proj.' . $parameters['proj']);
	exit;
}

if (session_valid ()) {
	db_execute (
		'insert into siteforge_project_member
			(proj_id, user_id)
		values
			(?, ?)',
		$parameters['proj'],
		session_username ()
	);
}

header ('Location: ' . site_prefix () . '/index/siteforge-app/proj.' . $parameters['proj']);
exit;

?>