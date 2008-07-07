<?php

if (! session_valid ()) {
	page_title (intl_get ('Forum Login'));

	global $cgi;

	if (isset ($cgi->username)) {
		echo '<p>' . intl_get ('Invalid password.  Please try again.') . '</p>';
	} else {
		echo '<p>' . intl_get ('Please enter your username and password to post a message.') . '</p>';
	}

	echo template_simple ('<form method="post">
		<input type="hidden" name="topic" value="{cgi/topic}" />
		<input type="hidden" name="post" value="{cgi/post}" />
		<input type="hidden" name="quote" value="{cgi/quote}" />
		<table cellpadding="5" border="0">
			<tr>
				<td>Username</td>
				<td><input type="text" name="username" /></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Enter" /></td>
			</tr>
		</table>
		</form>'
	);

	return;
}

loader_import ('siteforge.Filters');

class SiteforgeForumPostForm extends MailForm {
	function SiteforgeForumPostForm () {
		parent::MailForm ();
		$this->parseSettings ('inc/app/siteforge/forms/forum/post/settings.php');
		page_title (intl_get ('New Message'));

		global $cgi;

		if ($cgi->quote) {
			$quote = db_single (
				'select * from siteforge_forum_post where id = ?',
				$cgi->quote
			);
			$this->widgets['subject']->setDefault (
				str_replace ('Re: Re: ', 'Re: ', 'Re: ' . $quote->subject)
			);
			$this->widgets['body']->setDefault (
				sprintf (
					"**%s said:**\n%s\n\n",
					$quote->user_id,
					siteforge_filter_wiki_blockquote ($quote->body)
				)
			);
		} elseif ($cgi->post) {
			$quote = db_single (
				'select * from siteforge_forum_post where id = ?',
				$cgi->post
			);
			$this->widgets['subject']->setDefault (
				str_replace ('Re: Re: ', 'Re: ', 'Re: ' . $quote->subject)
			);
		}
	}

	function onSubmit ($vals) {
		if ($vals['post']) {
			$sql = 'insert into siteforge_forum_post
				(id, forum_id, user_id, posted, updated, post_id, subject, body)
			values
				(null, ?, ?, now(), now(), ?, ?, ?)';
			if (! db_execute (
				$sql,
				$vals['topic'],
				session_username (),
				$vals['post'],
				$vals['subject'],
				$vals['body']
			)) {
				die (db_error ());
			}
			$id = $vals['post'];
			$subject = db_shift ('select subject from siteforge_forum_post where id = ?', $id);
			db_execute ('update siteforge_forum_post set updated = now() where id = ?', $id);
		} else {
			$sql = 'insert into siteforge_forum_post
				(id, forum_id, user_id, posted, updated, post_id, subject, body)
			values
				(null, ?, ?, now(), now(), null, ?, ?)';
			if (! db_execute (
				$sql,
				$vals['topic'],
				session_username (),
				$vals['subject'],
				$vals['body']
			)) {
				die (db_error ());
			}
			$id = db_lastid ();
			$subject = $vals['subject'];
		}

		page_title (intl_get ('Message Posted'));
		echo '<p>' . intl_get ('Your message has been posted.') . '  <a href="' . site_prefix () . '/index/siteforge-forum-post-action/id.' . $id . '/title.' . siteforge_filter_name ($subject) . '">' . intl_get ('Continue.') . '</a></p>';
	}
}

?>