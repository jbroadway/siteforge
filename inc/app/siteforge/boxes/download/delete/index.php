<?php

if (! session_valid ()) {
	die ('Not logged in.');
}

if (session_username () != db_shift ('select user_id from siteforge_project where id = ?', $parameters['proj'])) {
	die ('You must be the owner of this project to delete downloads.');
}

if (empty ($parameters['dl']) || strpos ($parameters['dl'], '..') !== false) {
	die ('Invalid download file');
}

if (! unlink ('inc/app/siteforge/data/' . $parameters['proj'] . '/' . $parameters['dl'])) {
	page_title (intl_get ('Error'));
	echo '<p>' . intl_get ('Unable to delete the specified download file.') . '</p>';
	return;
}

header ('Location: ' . site_prefix () . '/index/siteforge-downloads-action/proj.' . $parameters['proj']);
exit;

?>