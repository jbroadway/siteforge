<?php

if (! session_valid ()) {
	die ('You must be logged in to delete docs.');
} elseif (session_username () != db_shift ('select user_id from siteforge_project where id = ?', $parameters['proj'])) {
	die ('You must be the owner of this project to delete docs.');
}

db_execute (
	'delete from siteforge_doc where id = ? and proj_id = ?',
	$parameters['doc'],
	$parameters['proj']
);

header ('Location: ' . site_prefix () . '/index/siteforge-doc-action/proj.' . $parameters['proj']);
exit;

?>