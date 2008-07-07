<?php

if (! session_valid ()) {
	page_title (intl_get ('Bugs Login'));

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

class SiteforgeBugsAddForm extends MailForm {
	function SiteforgeBugsAddForm () {
		parent::MailForm ();
		//$this->parseSettings ('inc/app/siteforge/forms/bugs/add/settings.php');
		page_title (intl_get ('Bug Report'));

		$this->uploadFiles = false;
		$this->extra = 'enctype="multipart/form-data"';

		$this->addWidget ('hidden', 'proj');

		$w =& $this->addWidget ('text', 'subject');
		$w->alt = intl_get ('Summary');
		$w->extra = 'size="40"';

		$n = 1;
		foreach (appconf ('extras') as $name => $options) {
			$w =& $this->addWidget ('select', 'extra' . $n);
			$w->alt = $name;
			$values = array ('' => '- ' . intl_get ('SELECT') . ' -');
			foreach ($options as $v) {
				$values[$v] = $v;
			}
			$w->setValues ($values);
			$n++;
		}

		$w =& $this->addWidget ('template', 'instructions');
		$w->template = '<tr><td colspan="2" align="right"><a href="{site/prefix}/index/siteforge-doc-instructions-action" target="_blank">{intl Wiki Formatting Rules}</a></td></tr>';

		$w =& $this->addWidget ('textarea', 'body');
		$w->alt = intl_get ('Details');
		$w->labelPosition = 'left';
		$w->cols = 50;
		$w->rows = 12;

		$w =& $this->addWidget ('file', 'file');
		$w->alt = intl_get ('Attach a File');

		$w =& $this->addWidget ('msubmit', 'submit_button');
		$b =& $w->getButton ();
		$b->setValues (intl_get ('Send'));
		$b =& $w->addButton ('submit_button', intl_get ('Preview'));
		$b->extra = 'onclick="return siteforge_preview (this.form)"';
	}

	function onSubmit ($vals) {
		if (! isset ($vals['extra1'])) {
			$vals['extra1'] = '';
		}
		if (! isset ($vals['extra2'])) {
			$vals['extra2'] = '';
		}
		if (! isset ($vals['extra3'])) {
			$vals['extra3'] = '';
		}
		if (! isset ($vals['extra4'])) {
			$vals['extra4'] = '';
		}
		if (! isset ($vals['extra5'])) {
			$vals['extra5'] = '';
		}

		db_execute (
			'insert into siteforge_bug
				(id, proj_id, user_id, subject, ts, status, body, extra1, extra2, extra3, extra4, extra5)
			values
				(null, ?, ?, ?, now(), "new", ?, ?, ?, ?, ?, ?)',
			$vals['proj'],
			session_username (),
			$vals['subject'],
			$vals['body'],
			$vals['extra1'],
			$vals['extra2'],
			$vals['extra3'],
			$vals['extra4'],
			$vals['extra5']
		);

		$bug_id = db_lastid ();
		$vals['id'] = $bug_id;

		// save attached file
		if (is_uploaded_file ($vals['file']->tmp_name)) {
			if (! @file_exists ('inc/app/siteforge/data/_' . $vals['proj'])) {
				mkdir ('inc/app/siteforge/data/_' . $vals['proj']);
				umask (0000);
				chmod ('inc/app/siteforge/data/_' . $vals['proj'], 0777);
			}
			$vals['file']->move ('inc/app/siteforge/data/_' . $vals['proj'], $vals['id'] . '.' . $vals['file']->name);
			umask (0000);
			chmod ('inc/app/siteforge/data/_' . $vals['proj'] . '/' . $vals['id'] . '.' . $vals['file']->name, 0777);
		}

		$proj_owner = db_shift ('select user_id from siteforge_project where id = ?', $vals['proj']);
		$proj_email = session_user_get_email ($proj_owner);

		$mail_body = template_simple ('bugs_email.spt', $vals);

		@mail (
			$proj_email,
			'[' . $vals['proj'] . '] ' . intl_get ('Bug Report'),
			$mail_body,
			'From: noreply@' . preg_replace ('/^www\./', '', site_domain ())
		);

		$submitter_email = session_user_get_email (session_username ());

		db_execute (
			'insert into siteforge_bug_subscriber (id, bug_id, email) values (null, ?, ?)',
			$bug_id,
			$submitter_email
		);

		@mail (
			$submitter_email,
			'[' . $vals['proj'] . '] ' . intl_get ('Bug Report'),
			$mail_body . template_simple ('bugs_email_unsubscribe.spt', array ('bug' => $bug_id, 'email' => $submitter_email)),
			'From: noreply@' . preg_replace ('/^www\./', '', site_domain ())
		);

		page_title (intl_get ('Thank You'));
		echo '<p>' . intl_get ('Your bug report has been sent.') . '  <a href="' . site_prefix () . '/index/siteforge-bugs-action/proj.' . $vals['proj'] . '">' . intl_get ('Return to bug list.') . '</a></p>';
	}
}

?>