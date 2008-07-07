<?php

if (! empty ($parameters['query'])) {
	global $cgi;

	if (! isset ($cgi->offset)) {
		$cgi->offset = 0;
	}

	$forums = db_shift_array (
		'select id from siteforge_forum where proj_id = ?',
		$parameters['proj']
	);

	$q = db_query (
		'select * from siteforge_forum_post where forum_id in(' . join (',', $forums) . ') and (subject like ? or body like ?)'
	);

	$query = '%' . $parameters['query'] . '%';

	if (! $q->execute ($query, $query)) {
		page_title (intl_get ('An Error Occurred'));
		echo '<p>' . intl_get ('Error Message') . ': ' . $q->error () . '</p>';
		echo $q->tmp_sql;
		return;
	}

	$total = $q->rows ();
	$parameters['list'] = $q->fetch ($cgi->offset, 10);
	$q->free ();

	loader_import ('siteforge.Filters');
	loader_import ('saf.Misc.Search');

	foreach (array_keys ($parameters['list']) as $k) {
		$parameters['list'][$k]->body = siteforge_filter_wiki_body ($parameters['list'][$k]->body);
		$parameters['list'][$k]->body = preg_replace ('/<p><strong>(.*?) said:<\/strong><\/p>\n\n<blockquote>(.*)<\/blockquote>/s', '', $parameters['list'][$k]->body);
		$parameters['list'][$k]->body = search_highlight ($parameters['list'][$k]->body, $parameters['query']);
		foreach (explode ("\n", $parameters['list'][$k]->body) as $line) {
			if (strpos ($line, $parameters['query']) !== false) {
				$parameters['list'][$k]->body = $line;
				break;
			}
		}
	}

	loader_import ('saf.GUI.Pager');

	$pg = new Pager ($cgi->offset, 10, $total);
	$pg->setUrl (
		site_prefix () . '/index/siteforge-forum-search-action?proj=' . $parameters['proj'] . '&query=' . $parameters['query']
	);
	$pg->getInfo ();

	template_simple_register ('pager', $pg);

	page_title (intl_get ('Forum Search'));
	echo template_simple ('forum_search_results.spt', $parameters);
} else {
	page_title (intl_get ('Forum Search'));
	echo template_simple ('forum_search.spt', $parameters);
}

?>