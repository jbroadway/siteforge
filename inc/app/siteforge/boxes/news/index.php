<?php

loader_import ('siteforge.Filters');
loader_import ('siteforge.Functions');

if ($context != 'action') {
	if ($parameters['proj']) {
		$news = db_fetch_array (
			'select id, headline, ts from siteforge_news where proj_id = ? order by ts desc limit 5',
			$parameters['proj']
		);
		echo template_simple (
			'news_project.spt',
			array (
				'news' => $news,
				'proj' => $parameters['proj'],
			)
		);
	} else {
		$news = db_fetch_array (
			'select id, proj_id, headline, ts from siteforge_news order by ts desc limit 5'
		);
		echo template_simple (
			'news_global.spt',
			array (
				'news' => $news,
			)
		);
	}
} else {
	if ($parameters['id']) {
		$obj = db_single (
			'select * from siteforge_news where id = ?',
			$parameters['id']
		);
		global $cgi;
		$cgi->proj = $obj->proj_id;
		page_title ($obj->headline);
		echo template_simple (
			'news_story.spt',
			$obj
		);
	} elseif ($parameters['proj']) {
		global $cgi;

		if (! isset ($cgi->offset)) {
			$cgi->offset = 0;
		}

		$q = db_query (
			'select id, headline, ts from siteforge_news where proj_id = ? order by ts desc'
		);
		if (! $q->execute ($parameters['proj'])) {
			die ($q->error ());
		}
		$total = $q->rows ();
		$news = $q->fetch ($cgi->offset, 10);
		$q->free ();

		loader_import ('saf.GUI.Pager');

		$pg = new Pager ($cgi->offset, 10, $total);
		$pg->setUrl (
			site_prefix () . '/index/siteforge-news-action?proj=' . $parameters['proj']
		);
		$pg->getInfo ();

		page_title (siteforge_filter_proj ($parameters['proj']) . ' - ' . intl_get ('News'));

		template_simple_register ('pager', $pg);

		echo template_simple (
			'news_project_full.spt',
			array (
				'news' => $news,
				'proj' => $parameters['proj'],
			)
		);
	}
}

?>