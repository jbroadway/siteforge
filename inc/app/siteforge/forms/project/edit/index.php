<?php

if (! session_valid ()) {
	die ('You must be logged in to edit this project.');
}

loader_import ('siteforge.Filters');

class SiteforgeProjectEditForm extends MailForm {
	function SiteforgeProjectEditForm () {
		parent::MailForm ();
		$this->parseSettings ('inc/app/siteforge/forms/project/edit/settings.php');

		global $cgi;

		page_title (intl_get ('Edit Project') . ': ' . siteforge_filter_proj ($cgi->proj_id));

		$proj = db_single ('select * from siteforge_project where id = ?', $cgi->proj_id);
		if ($proj->status == 1 || $proj->status == 3) {
			die ('Action not allowed');
		}

		foreach (get_object_vars ($proj) as $k => $v) {
			if ($k == 'ts' || $k == 'user_id' || $k == 'id') {
				continue;
			}
			$this->widgets[$k]->setValue ($v);
		}
	}

	function onSubmit ($vals) {
		if ($vals['ext_url'] == 'http://') {
			$vals['ext_url'] = '';
		}
		if ($vals['ext_bugs'] == 'http://') {
                        $vals['ext_bugs'] = '';
		}
		if ($vals['ext_docs'] == 'http://') {
                        $vals['ext_docs'] = '';
                }
		if ($vals['ext_forum'] == 'http://') {
                        $vals['ext_forum'] = '';
                }

		// 1. update db
		db_execute (
			'update siteforge_project
				set name = ?, category = ?, status = ?, description = ?, license = ?, audience = ?, ext_url = ?, ext_bugs = ?, ext_docs = ?, ext_forum = ?, donation_paypal_id = ?, donation_default_amt = ?, donation_message = ?
			where
				id = ? and user_id = ?',
				$vals['name'],
				$vals['category'],
				$vals['status'],
				$vals['description'],
				$vals['license'],
				$vals['audience'],
				$vals['ext_url'],
				$vals['ext_bugs'],
				$vals['ext_docs'],
				$vals['ext_forum'],
				$vals['donation_paypal_id'],
				$vals['donation_default_amt'],
				$vals['donation_message'],
				$vals['proj_id'],
				session_username ()
		);

		// 2. reply to user
		page_title (intl_get ('Project Updated'));
		echo '<p>' . intl_get ('Your changes have been saved.') . '  <a href="' . site_prefix () . '/index/siteforge-app/proj.' . $vals['proj_id'] . '">' . intl_get ('Continue.') . '</a></p>';
	}
}

?>
