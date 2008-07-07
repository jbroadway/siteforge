<?php

loader_import ('siteforge.Filters');
loader_import ('siteforge.Functions');

global $cgi;

if (! siteforge_project_owner ($cgi->proj)) {
	die ('You must be the owner of this project to add downloads.');
}

class SiteforgeDownloadAddForm extends MailForm {
	function SiteforgeDownloadAddForm () {
		parent::MailForm ();
		$this->parseSettings ('inc/app/siteforge/forms/download/add/settings.php');
		page_title (intl_get ('Add Download'));
		$this->message = intl_get ('File size limit') . ': ' . str_replace ('M', 'MB', ini_get ('upload_max_filesize'));
	}

	function onSubmit ($vals) {
		if (! $vals['dl']->move ('inc/app/siteforge/data/' . $vals['proj'])) {
			page_title ('Error');
			echo '<p>' . intl_get ('Unable to save file.  The site administrator will need to check the server permissions.') . '</p>';
			return;
		}

		umask (0000);
		chmod ('inc/app/siteforge/data/' . $vals['proj'] . '/' . $vals['dl']->name, 0777);

		header ('Location: ' . site_prefix () . '/index/siteforge-downloads-action/proj.' . $vals['proj']);
		exit;
	}
}

?>