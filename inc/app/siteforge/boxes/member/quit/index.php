<?php

if (! $parameters['proj']) {
	die ('No project specified');
}

if (session_valid ()) {
	db_execute (
		'delete from siteforge_project_member
		where proj_id = ? and user_id = ?',
		$parameters['proj'],
		session_username ()
	);
}

header ('Location: ' . site_prefix () . '/index/siteforge-app/proj.' . $parameters['proj']);
exit;

?>