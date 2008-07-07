<?php

if (! session_valid ()) {
	die ('You must be logged in to create a project.');
}

loader_import ('siteforge.Filters');

class SiteforgeProjectAddForm extends MailForm {
	function SiteforgeProjectAddForm () {
		parent::MailForm ();
		$this->parseSettings ('inc/app/siteforge/forms/project/add/settings.php');
		page_title (intl_get ('Create a Project'));
	}

	function onSubmit ($vals) {
		if ($vals['external_url'] == 'http://') {
			$vals['external_url'] = '';
		}

		loader_import ('siteforge.Objects');

		$proj = new Project;

		if (! $proj->add (array (
			'id' => $vals['proj_id'],
			'user_id' => session_username (),
			'name' => $vals['name'],
			'category' => $vals['category'],
			'status' => 1, // Pending
			'description' => $vals['description'],
			'license' => $vals['license'],
			'audience' => $vals['audience'],
			'ext_url' => $vals['external_url'],
			'ts' => date ('Y-m-d H:i:s'),
			'ext_bugs' => '',
			'ext_docs' => '',
			'ext_forum' => '',
			'donation_paypal_id' => '',
			'donation_default_amt' => 0.00,
			'donation_message' => '',
		))) {
			page_title (intl_get ('An Error Occurred'));
			echo '<p>' . intl_get ('Error Message') . ': ' . $proj->error . '</p>';
			return;
		}

		// 4. reply to user
		page_title (intl_get ('Thank You'));
		echo '<p>' . intl_get ('Your project has been submitted for approval.  You will receive an email when your project has been reviewed by the webmaster.') . '</p>';
	}
}

?>
