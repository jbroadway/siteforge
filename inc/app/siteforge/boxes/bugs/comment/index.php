<?php

if (! session_valid ()) {
	page_title (intl_get ('Error'));
	echo '<p>' . intl_get ('You must be logged in to comment.') . '</p>';
	return;
}

db_execute (
	'insert into siteforge_bug_comment
		(id, bug_id, user_id, ts, body)
	values
		(null, ?, ?, now(), ?)',
	$parameters['bug'],
	session_username (),
	$parameters['body']
);

$cid = db_lastid ();

if ($parameters['subscribe'] == 'yes') {
	db_execute (
		'insert into siteforge_bug_subscriber (id, bug_id, email) values (null, ?, ?)',
		$parameters['bug'],
		session_user_get_email (session_username ())
	);
} else {
	db_execute (
		'delete from siteforge_bug_subscriber where bug_id = ? and email = ?',
		$parameters['bug'],
		session_user_get_email (session_username ())
	);
}

$bug = db_single ('select * from siteforge_bug where id = ?', $parameters['bug']);
$owner = $bug->user_id;
$email = session_user_get_email ($owner);
$emails = db_shift_array ('select * from siteforge_bug_subscriber where bug_id = ?', $parameters['bug']);
$bug->commenter = session_username ();
$bug->comment = $parameters['body'];

// save attached file
if (is_uploaded_file ($parameters['file']->tmp_name)) {
	if (! @file_exists ('inc/app/siteforge/data/_' . $bug->proj_id)) {
		mkdir ('inc/app/siteforge/data/_' . $bug->proj_id);
		umask (0000);
		chmod ('inc/app/siteforge/data/_' . $bug->proj_id, 0777);
	}
	$parameters['file']->move ('inc/app/siteforge/data/_' . $bug->proj_id, 'c' . $cid . '.' . $parameters['file']->name);
	umask (0000);
	chmod ('inc/app/siteforge/data/_' . $bug->proj_id . '/c' . $cid . '.' . $parameters['file']->name, 0777);
}

$mail_body = template_simple ('bugs_email_comment.spt', $bug);

@mail (
	$email,
	'[' . $bug->proj_id . '] ' . intl_get ('Bug Comment'),
	$mail_body,
	'From: noreply@' . preg_replace ('/^www\./', '', site_domain ())
);

foreach ($emails as $address) {
	@mail (
		$address,
		'[' . $bug->proj_id . '] ' . intl_get ('Bug Comment'),
		$mail_body . template_simple ('bugs_email_unsubscribe.spt', array ('bug' => $bug->id, 'email' => $address)),
		'From: noreply@' . preg_replace ('/^www\./', '', site_domain ())
	);
}

header ('Location: ' . site_prefix () . '/index/siteforge-bugs-action/id.' . $parameters['bug'] . '#siteforge-bug-comments');
exit;

?>