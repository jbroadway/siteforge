<?php

/* Parameters contains:
 * - action: Type of action performed (see below)
 * - changelog: Summary of the changes
 * - collection: The collection the item belongs to
 * - data: The modified document itself
 * - key: The primary key value of the item
 * - message: A brief description of the event
 * - transition: The transition that triggered this service
 *
 * Note that services are triggered *after* the change has been
 * made.  The only way you can undo changes in a service is by
 * using the cms.Versioning.Rex API if the collection in question
 * supports versioning (not all do).  Also, you can, if necessary,
 * create further modifications to the document, also via the
 * Rex API.
 *
 * Transition is one of:
 * - edit
 *
 * Action is one of:
 * - modify: Ordinary modifications (source and store)
 * - replace: A change was approved, overwriting the live version
 * - republish: A change was made as a draft, requiring approval
 * - update: Update to a draft that was republished
 */

if ($parameters['collection'] != 'siteforge_project') {
	return;
}

$email = session_user_get_email ($parameters['data']['user_id']);

if ($parameters['data']['status'] == 3) { // Rejected
	@mail (
		$email,
		intl_get ('Project Submission Rejected'),
		template_simple ('email_rejected.spt', $parameters['data']),
		'From: noreply@' . preg_replace ('/^www\./', '', site_domain ())
	);
} elseif ($parameters['data']['status'] == 2) { // Approved
	@mail (
		$email,
		intl_get ('Project Submission Approved'),
		template_simple ('email_approved.spt', $parameters['data']),
		'From: noreply@' . preg_replace ('/^www\./', '', site_domain ())
	);
} else { // Other, notify of admin edit
	@mail (
		$email,
		intl_get ('Project Information Edited'),
		template_simple ('email_edited.spt', $parameters['data']),
		'From: noreply@' . preg_replace ('/^www\./', '', site_domain ())
	);
}

?>