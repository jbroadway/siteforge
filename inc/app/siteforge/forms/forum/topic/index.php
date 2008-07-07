<?php

global $cgi;

if (! session_admin () || session_username () != db_shift ('select user_id from siteforge_project where id = ?', $cgi->proj)) {
	die ('You are not authorized to add a topic.');
	return;
}

class SiteforgeForumTopicForm extends MailForm {
	function SiteforgeForumTopicForm () {
		parent::MailForm ();
		$this->parseSettings ('inc/app/siteforge/forms/forum/topic/settings.php');
		page_title (intl_get ('Add Topic'));
	}

	function onSubmit ($vals) {
		db_execute (
			'insert into siteforge_forum
				(id, proj_id, name, summary)
			values
				(null, ?, ?, ?)',
			$vals['proj'],
			$vals['name'],
			$vals['summary']
		);
		header ('Location: ' . site_prefix () . '/index/siteforge-forum-action/proj.' . $vals['proj']);
		exit;
	}
}

?>