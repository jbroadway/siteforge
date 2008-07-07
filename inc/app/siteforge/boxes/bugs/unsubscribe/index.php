<?php

if (! $parameters['email']) {
	$parameters['email'] = session_user_get_email (session_username ());
}

db_execute (
	'delete from siteforge_bug_subscriber where bug_id = ? and email = ?',
	$parameters['bug'],
	$parameters['email']
);

$proj = db_shift ('select proj_id from siteforge_bug where id = ?', $parameters['bug']);

page_title (intl_get ('Unsubscribed'));

echo '<p>' . intl_get ('You have been unsubscribed from bug') . ' #' . $parameters['bug'] . '.  <a href="' . site_prefix () . '/index/siteforge-app/proj.' . $proj . '">' . intl_get ('Continue.') . '</a></p>';

?>