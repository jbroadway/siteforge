<?php

if (! session_valid ()) {
	page_title (intl_get ('Error'));
	echo '<p>' . intl_get ('You are not authorized to modify this bug report.') . '</p>';
	return;
}

loader_import ('siteforge.Functions');

if (! siteforge_project_owner (db_shift ('select proj_id from siteforge_bug where id = ?', $parameters['bug']))) {
//if (session_username () != db_shift ('select user_id from siteforge_bug where id = ?', $parameters['bug'])) {
	page_title (intl_get ('Error'));
	echo '<p>' . intl_get ('You are not authorized to modify this bug report.') . '</p>';
	return;
}

db_execute (
	'update siteforge_bug set status = ? where id = ?',
	$parameters['status'],
	$parameters['bug']
);

$bug = db_single ('select * from siteforge_bug where id = ?', $parameters['bug']);
$owner = $bug->user_id;
$email = session_user_get_email ($owner);
$emails = db_shift_array ('select * from siteforge_bug_subscriber where bug_id = ?', $parameters['bug']);

$mail_body = template_simple ('bugs_email_status.spt', $bug);

@mail (
	$email,
	'[' . $bug->proj_id . '] ' . intl_get ('Bug Status Update'),
	$mail_body,
	'From: noreply@' . preg_replace ('/^www\./', '', site_domain ())
);

foreach ($emails as $address) {
	@mail (
		$address,
		'[' . $bug->proj_id . '] ' . intl_get ('Bug Status Update'),
		$mail_body . template_simple ('bugs_email_unsubscribe.spt', array ('bug' => $bug->id, 'email' => $address)),
		'From: noreply@' . preg_replace ('/^www\./', '', site_domain ())
	);
}

header ('Location: ' . site_prefix () . '/index/siteforge-bugs-action/id.' . $parameters['bug']);
exit;

?>