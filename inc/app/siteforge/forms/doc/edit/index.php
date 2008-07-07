<?php

global $cgi;

$proj = db_shift ('select proj_id from siteforge_doc where id = ?', $cgi->doc);

if (! session_valid ()) {
	die ('You must be logged in to edit docs.');
} elseif (session_username () != db_shift ('select user_id from siteforge_project where id = ?', $proj)) {
	die ('You must be the owner of this project to edit docs.');
}

class SiteforgeDocEditForm extends MailForm {
	function SiteforgeDocEditForm () {
		parent::MailForm ();
		$this->parseSettings ('inc/app/siteforge/forms/doc/edit/settings.php');

		global $cgi;

		$doc = db_single ('select * from siteforge_doc where id = ? and proj_id = ?', $cgi->doc, $cgi->proj);
		$this->widgets['id']->setValue ($doc->id);
		$this->widgets['title']->setValue ($doc->title);
		$this->widgets['sort_weight']->setValue ($doc->sort_weight);
		$this->widgets['body']->setValue ($doc->body);

		page_title (intl_get ('Edit Doc') . ': ' . $doc->title);
	}

	function onSubmit ($vals) {
		db_execute (
			'update siteforge_doc set id = ?, title = ?, sort_weight = ?, body = ? where id = ? and proj_id = ?',
			$vals['id'],
			$vals['title'],
			$vals['sort_weight'],
			$vals['body'],
			$vals['doc'],
			$vals['proj']
		);

		header ('Location: ' . site_prefix () . '/index/siteforge-app/proj.' . $vals['proj'] . '/doc.' . $vals['id']);
		exit;
	}
}

?>