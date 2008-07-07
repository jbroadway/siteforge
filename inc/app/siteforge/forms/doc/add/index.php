<?php

global $cgi;

if (! session_valid ()) {
	die ('You must be logged in to add docs.');
} elseif (session_username () != db_shift ('select user_id from siteforge_project where id = ?', $cgi->proj)) {
	die ('You must be the owner of this project to add docs.');
}

class SiteforgeDocAddForm extends MailForm {
	function SiteforgeDocAddForm () {
		parent::MailForm ();
		$this->parseSettings ('inc/app/siteforge/forms/doc/add/settings.php');
		page_title (intl_get ('Add Doc'));
	}

	function onSubmit ($vals) {
		db_execute (
			'insert into siteforge_doc
				(id, proj_id, title, sort_weight, body)
			values
				(?, ?, ?, ?, ?)',
			$vals['id'],
			$vals['proj'],
			$vals['title'],
			$vals['sort_weight'],
			$vals['body']
		);

		header ('Location: ' . site_prefix () . '/index/siteforge-app/proj.' . $vals['proj'] . '/doc.' . $vals['id']);
		exit;
	}
}

?>