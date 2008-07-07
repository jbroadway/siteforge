<?php

global $cgi;

$user = db_shift ('select user_id from siteforge_forum_post where id = ?', $cgi->id);
$topic = db_shift ('select forum_id from siteforge_forum_post where id = ?', $cgi->id);
$proj = db_shift ('select proj_id from siteforge_forum where id = ?', $topic);

if (session_admin () || session_username () == $user || session_username () == db_shift ('select user_id from siteforge_project where id = ?', $proj)) {
} else {
	die ('You are not authorized to edit this post.');
	return;
}

class SiteforgeForumPostEditForm extends MailForm {
	function SiteforgeForumPostEditForm () {
		parent::MailForm ();
		$this->parseSettings ('inc/app/siteforge/forms/forum/post/edit/settings.php');

		global $cgi;

		$this->_post = db_single ('select * from siteforge_forum_post where id = ?', $cgi->id);

		page_title (intl_get ('Edit Message') . ': ' . $this->_post->subject);

		$this->widgets['subject']->setValue ($this->_post->subject);
		$this->widgets['body']->setValue ($this->_post->body);
	}

	function onSubmit ($vals) {
		db_execute (
			'update siteforge_forum_post
				set subject = ?, body = ?
				where id = ?',
			$vals['subject'],
			$vals['body'],
			$vals['id']
		);

		loader_import ('siteforge.Filters');

		page_title (intl_get ('Message Updated'));
		echo '<p>' . intl_get ('Your changes have been saved.') . '  <a href="' . site_prefix () . '/index/siteforge-forum-post-action/id.' . $vals['id'] . '/title.' . siteforge_filter_name ($vals['subject']) . '">' . intl_get ('Continue.') . '</a></p>';
	}
}

?>