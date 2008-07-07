<?php

if (isset ($parameters['unsub'])) {
	header ('Location: ' . site_prefix () . '/index/siteforge-bugs-unsubscribe-action?bug=' . $parameters['bug'] . '&email=' . $parameters['email']);
	exit;
}

if (! $parameters['email']) {
	$parameters['email'] = session_user_get_email (session_username ());
}

db_execute (
	'insert into siteforge_bug_subscriber (id, bug_id, email) values (null, ?, ?)',
	$parameters['bug'],
	$parameters['email']
);

$proj = db_shift ('select proj_id from siteforge_bug where id = ?', $parameters['bug']);

page_title (intl_get ('Subscribed'));

echo '<p>' . intl_get ('You have been subscribed to bug') . ' #' . $parameters['bug'] . '.  <a href="' . site_prefix () . '/index/siteforge-app/proj.' . $proj . '">' . intl_get ('Continue.') . '</a></p>';

?>