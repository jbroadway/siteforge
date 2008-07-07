<?php

loader_import ('siteforge.Filters');
loader_import ('siteforge.Functions');

global $cgi;

if (! siteforge_project_owner ($cgi->proj)) {
	die ('You must be the owner of this project to post news.');
}

class SiteforgeNewsAddForm extends MailForm {
	function SiteforgeNewsAddForm () {
		parent::MailForm ();
		$this->parseSettings ('inc/app/siteforge/forms/news/add/settings.php');
		page_title (intl_get ('Add News'));
	}

	function onSubmit ($vals) {
		db_execute (
			'insert into siteforge_news
				(id, proj_id, headline, ts, body)
			values
				(null, ?, ?, now(), ?)',
			$vals['proj'],
			$vals['headline'],
			$vals['body']
		);

		header ('Location: ' . site_prefix () . '/index/siteforge-news-action/id.' . db_lastid () . '/headline.' . siteforge_filter_name ($vals['headline']));
		exit;
	}
}

?>