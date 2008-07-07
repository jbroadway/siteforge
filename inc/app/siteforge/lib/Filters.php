<?php

loader_import ('saf.Date');

function siteforge_filter_name ($name) {
	return strtolower (
		preg_replace (
			'/[^a-zA-Z0-9]+/',
			'-',
			$name
		)
	);
}

function siteforge_filter_cat_name ($id) {
	return strtolower (
		preg_replace (
			'/[^a-zA-Z0-9]+/',
			'-',
			db_shift ('select name from siteforge_category where id = ?', $id)
		)
	);
}

function siteforge_filter_cat ($id) {
	return db_shift ('select name from siteforge_category where id = ?', $id);
}

function siteforge_filter_date ($ts) {
	return Date::format ($ts, 'F j, Y - g:i A');
}

function siteforge_filter_proj ($id) {
	return db_shift ('select name from siteforge_project where id = ?', $id);
}

function siteforge_filter_audience ($id) {
	return db_shift ('select name from siteforge_audience where id = ?', $id);
}

function siteforge_filter_status ($id) {
	return db_shift ('select name from siteforge_status where id = ?', $id);
}

function siteforge_filter_license ($id) {
	return db_shift ('select name from siteforge_license where id = ?', $id);
}

function siteforge_filter_topic ($id) {
	return db_shift ('select name from siteforge_forum where id = ?', $id);
}

function siteforge_filter_body ($body) {
	return str_replace (
		array ("\r", "\n"),
		array ('', "<br />\n"),
		htmlentities_compat ($body)
	);
}

function siteforge_filter_doc ($body) {
	return str_replace (
		array ("\r", "\n"),
		array ('', "<br />\n"),
		$body
	);
}

function siteforge_filter_mtime ($mtime) {
	return date ('F j, Y - g:i A', $mtime);
}

function siteforge_filter_doc_body ($body) {
	global $cgi;

	if (strtoupper (substr (PHP_OS, 0, 3)) === 'WIN') {
		$join = ';';
	} else {
		$join = ':';
	}
	ini_set ('include_path', 'inc/app/siteforge/lib/Ext' . $join . ini_get ('include_path'));

	loader_import ('siteforge.Ext.Text.Wiki');

	$wiki = new Text_Wiki ();
	$wiki->setRenderConf ('xhtml', 'freelink', 'pages', db_shift_array ('select id from siteforge_doc where proj_id = ?', $cgi->proj));
	$wiki->setRenderConf ('xhtml', 'freelink', 'view_url', site_prefix () . '/index/siteforge-app/proj.' . $cgi->proj . '/doc.');
	$wiki->setRenderConf ('xhtml', 'freelink', 'new_url', site_prefix () . '/index/siteforge-app/proj.' . $cgi->proj . '/doc.');
	$wiki->setRenderConf ('xhtml', 'freelink', 'new_text', '');
	$wiki->disableRule ('wikilink');
	$wiki->setRenderConf ('xhtml', 'interwiki', 'sites', array (
		'Bug' => site_prefix () . '/index/siteforge-bugs-action/id.',
		'Doc' => site_prefix () . '/index/siteforge-app/proj.' . $cgi->proj . '/doc.',
		'Forum' => site_prefix () . '/index/siteforge-forum-post-action/id.',
		'News' => site_prefix () . '/index/siteforge-news-action/id.',
		'Project' => site_prefix () . '/index/siteforge-app/proj.',
	));
	$wiki->setRenderConf ('xhtml', 'interwiki', 'target', '');
	return $wiki->transform ($body, 'Xhtml');
}

function siteforge_filter_wiki_body ($body) {
	global $cgi;

	if (strtoupper (substr (PHP_OS, 0, 3)) === 'WIN') {
		$join = ';';
	} else {
		$join = ':';
	}
	ini_set ('include_path', 'inc/app/siteforge/lib/Ext' . $join . ini_get ('include_path'));

	loader_import ('siteforge.Ext.Text.Wiki');

	$wiki = new Text_Wiki ();
	$wiki->setRenderConf ('xhtml', 'freelink', 'pages', db_shift_array ('select id from siteforge_doc where proj_id = ?', $cgi->proj));
	$wiki->setRenderConf ('xhtml', 'freelink', 'view_url', site_prefix () . '/index/siteforge-app/proj.' . $cgi->proj . '/doc.');
	$wiki->setRenderConf ('xhtml', 'freelink', 'new_url', site_prefix () . '/index/siteforge-app/proj.' . $cgi->proj . '/doc.');
	$wiki->setRenderConf ('xhtml', 'freelink', 'new_text', '');
	$wiki->disableRule ('wikilink');
	$wiki->setRenderConf ('xhtml', 'interwiki', 'sites', array (
		'Bug' => site_prefix () . '/index/siteforge-bugs-action/id.',
		'Doc' => site_prefix () . '/index/siteforge-app/proj.' . $cgi->proj . '/doc.',
		'Forum' => site_prefix () . '/index/siteforge-forum-post-action/id.',
		'News' => site_prefix () . '/index/siteforge-news-action/id.',
		'Project' => site_prefix () . '/index/siteforge-app/proj.',
	));
	$wiki->setRenderConf ('xhtml', 'interwiki', 'target', '');
	return $wiki->transform ($body, 'Xhtml');
}

function siteforge_filter_wiki_rss ($body) {
	return htmlentities_compat (strip_tags (siteforge_filter_wiki_body ($body)));
}

function siteforge_filter_wiki_blockquote ($body) {
	$out = '> ' . str_replace ("\n", "\n> ", $body);
	return str_replace ('> >', '>>', $out);
}

function siteforge_filter_rss_date ($ts) {
	loader_import ('siteforge.Functions');
	return Date::format ($ts, 'Y-m-d\TH:i:s') . siteforge_timezone (Date::format ($ts, 'Z'));
}

function siteforge_filter_filesize ($size) {
	return strtoupper (format_filesize ($size));
}

function siteforge_filter_bug_attachment ($name) {
	return array_pop (explode ('.', basename ($name), 2));
}

?>