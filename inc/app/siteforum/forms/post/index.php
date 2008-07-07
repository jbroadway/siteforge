<?php

global $cgi;

if (! session_valid ()) {
	page_title (intl_get ('You must be logged in to post'));
	echo template_simple ('post_not_registered.spt', $cgi);
	return;
}

if (empty ($cgi->post) && empty ($cgi->topic)) {
	header ('Location: ' . site_prefix () . '/index/siteforum-app');
	exit;
}

class SiteforumPostForm extends MailForm {
	function SiteforumPostForm () {
		parent::MailForm ();

		page_title (intl_get ('Post a Message'));
		$this->parseSettings ('inc/app/siteforum/forms/post/settings.php');

		page_add_script ('
			function siteforum_preview (f) {
				t = f.target;
				a = f.action;

				f.target = "_blank";
				f.action = "' . site_prefix () . '/index/siteforum-post-preview-action";
				f.submit ();

				f.target = t;
				f.action = a;
				return false;
			}

			function siteforum_insert_tag (tag) {
				e = document.getElementById ("siteforum-body");
				if (tag == "a") {
					e.value += "<a href=\"http://\"></a>";
				} else {
					e.value += "<" + tag + "></" + tag + ">";
				}
				return false;
			}
		');

		global $cgi;
		$this->widgets['submit_button']->buttons[1]->extra = 'onclick="return siteforum_preview (this.form)"';
		$this->widgets['submit_button']->buttons[2]->extra = 'onclick="history.go (-1); return false"';

		if (! empty ($cgi->quote)) {
			$obj = db_single ('select * from siteforum_post where id = ?', $cgi->quote);
			if (strpos ($obj->subject, 'Re: ' ) !== 0) {
				$obj->subject = 'Re: ' . $obj->subject;
			}
			$this->widgets['subject']->setValue ($obj->subject);

			$this->widgets['body']->setValue (
				"<strong>"
				. $obj->user_id
				. " said:</strong>\n"
				. "<blockquote>"
				. $obj->body
				. "</blockquote>\n\n"
			);
		}

		if (! session_admin ()) {
			$this->widgets['notice'] = new MF_Widget_hidden ('notice');
			$this->widgets['notice']->form =& $this;
			$this->widgets['notice']->setValue ('no');
		}
	}

	function onSubmit ($vals) {
		loader_import ('siteforum.Post');
		loader_import ('siteforum.Filters');
		loader_import ('siteforum.Topic');

		$p = new SiteForum_Post;

		if (! session_admin ()) {
			$notice = 'no';
		} else {
			if ($vals['notice'] == 'Make this post a notice.') {
				$notice = 'yes';
			} else {
				$notice = 'no';
			}
		}

		$t = new SiteForum_Topic;
		$topic = $t->get ($vals['topic']);

		if (! $res = $p->add (
			array (
				'user_id' => session_username (),
				'topic_id' => $vals['topic'],
				'post_id' => $vals['post'],
				'ts' => date ('Y-m-d H:i:s'),
				'subject' => $vals['subject'],
				'body' => $vals['body'],
				'sig' => db_shift ('select sig from sitellite_user where username = ?', session_username ()),
				'notice' => $notice,
				'sitellite_access' => $topic->sitellite_access,
				'sitellite_status' => $topic->sitellite_status,
			)
		)) {
			page_title (intl_get ('Database Error'));
			echo '<p>' . intl_get ('An error occurred.  Please try again later.') . '</p>';
			echo '<p>' . intl_get ('Error Message') . ': ' . $p->error . '</p>';
			return;
		}

		$vals['id'] = $res;

		if (! empty ($vals['post'])) {
			$p->touch ($vals['post']);
		}

		if ($vals['subscribe'] == 'Subscribe me to this forum thread.') {
			if (! $vals['post']) {
				$vals['post'] = $res;
			}
			db_execute ('insert into siteforum_subscribe (id, post_id, user_id) values (null, ?, ?)', $vals['post'], session_username ());
		}

		$ae = appconf ('admin_email');
		if ($ae) {
			@mail ($ae, intl_get ('Forum Posting Notice'), template_simple ('post_email.spt', $vals), 'From: ' . appconf ('forum_name') . '@' . site_domain ());
		}

		$exempt = explode (',', $ae);
		$res = db_fetch_array ('select distinct u.email, u.username from sitellite_user u, siteforum_subscribe s where s.user_id = u.username and s.post_id = ?', $vals['post']);

		foreach ($res as $row) {
			if (in_array ($row->email, $exempt)) {
				continue;
			}
			$vals['user_id'] = $row->username;
			@mail ($row->email, intl_get ('Forum Posting Notice'), template_simple ('post_email_subscriber.spt', $vals), 'From: ' . appconf ('forum_name') . '@' . site_domain ());
		}

		page_title (intl_get ('Message Posted'));
		echo template_simple ('post_submitted.spt', $vals);
	}
}

if (appconf ('template')) {
	page_template (appconf ('template'));
}

?>
