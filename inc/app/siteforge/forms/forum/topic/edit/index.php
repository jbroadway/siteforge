<?php

global $cgi;

$proj = db_shift ('select proj_id from siteforge_forum where id = ?', $cgi->id);

if (session_admin () || session_username () == db_shift ('select user_id from siteforge_project where id = ?', $proj)) {
} else {
	die ('You are not authorized to edit this topic.');
	return;
}

class SiteforgeForumTopicEditForm extends MailForm {
	function SiteforgeForumTopicEditForm () {
		parent::MailForm ();
		$this->parseSettings ('inc/app/siteforge/forms/forum/topic/edit/settings.php');

		global $cgi;

		$this->_topic = db_single ('select * from siteforge_forum where id = ?', $cgi->id);

		page_title (intl_get ('Edit Topic') . ': ' . $this->_topic->name);

		$this->widgets['name']->setValue ($this->_topic->name);
		$this->widgets['summary']->setValue ($this->_topic->summary);
	}

	function onSubmit ($vals) {
		db_execute (
			'update siteforge_forum
				set name = ?, summary = ?
				where id = ?',
			$vals['name'],
			$vals['summary'],
			$vals['id']
		);
		header ('Location: ' . site_prefix () . '/index/siteforge-forum-action/proj.' . $this->_topic->proj_id);
		exit;
	}
}

?>