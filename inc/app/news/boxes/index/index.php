<?php

global $cgi;

loader_import ('news.Story');
loader_import ('news.Functions');

$story = new NewsStory;

if (! empty ($parameters['story'])) { // view story

	$obj = $story->get ($parameters['story']);
	if (! $obj) {
		echo template_simple ('not_found.spt', array ('error' => $story->error));
		return;
	}

	if (! empty ($parameters['highlight'])) {
		loader_import ('saf.Misc.Search');
		$obj->body = search_bar ($parameters['highlight'], '/index/news-search-action') . search_highlight ($obj->body, $parameters['highlight']);
		$obj->highlight = $parameters['highlight'];
	}

	$pages = news_page_split ($obj->body);
	if (! $cgi->pagenum) {
		$cgi->pagenum = 1;
	}
	$obj->body = news_page_nav ($pages, $cgi->pagenum, $obj->id, $parameters['highlight']);
	$obj->pagenum = $cgi->pagenum;

	if (appconf ('comments')) {
		$obj->comments = true;
		loader_import ('news.Comment');
		$c = new NewsComment;
		$c->orderBy ('ts asc');
		$obj->commentList = $c->find ($obj->id);
		if (! $obj->commentList) {
			$obj->commentList = array ();
		}
	} else {
		$obj->comments = false;
	}

	if (! appconf ('sections') || $parameters['menu'] == 'no') {
		$obj->menu = 'no';
	} else {
		$obj->menu = '';
	}

	$obj->sec = $parameters['sec'];
	$obj->home = $parameters['home'];

	if ($box['context'] == 'action') {
		page_title ($obj->title);
		page_description ($obj->summary);
		//page_keywords ($obj->keywords);
	}
	$obj->context = $box['context'];

	echo template_simple ('story.spt', $obj);

} elseif (! empty ($parameters['section'])) { // view section list

	if (! $parameters['limit']) {
		$parameters['limit'] = appconf ('limit');
	}
	if (! $parameters['offset']) {
		$parameters['offset'] = 0;
	}
	$story->limit ($parameters['limit']);
	$story->offset ($parameters['offset']);
	$story->orderBy ('date desc, rank desc, id desc');
	$list = $story->find (array ('category' => $parameters['section']));
	if (! $list) {
		echo template_simple ('invalid_section.spt', array ('error' => $story->error));
		return;
	}

	$total = $story->total;

	loader_import ('saf.GUI.Pager');

	$pg = new Pager ($parameters['offset'], $parameters['limit'], $total);
	$pg->setUrl (site_prefix () . '/index/news-app?section=' . $parameters['section']);
	$pg->getInfo ();

	$date = false;
	$newlist = array ();
	foreach ($list as $item) {
		if ($date != $item->date) {
			$date = $item->date;
			$i = new StdClass;
			$i->_type = 'date';
			$i->date = $item->date;
			$newlist[] = $i;
		}
		$newlist[] = $item;
	}
	$list = $newlist;

	if (appconf ('comments_blog_style')) {
		loader_import ('news.Comment');
		$c = new NewsComment;

		foreach ($list as $k => $item) {
			$list[$k]->comments = $c->count ($item->id);
		}
	}

	template_simple_register ('pager', $pg);
	echo template_simple (
		'section.spt',
		array (
			'list' => $list,
			'comments' => appconf ('comments_blog_style'),
			'rss' => appconf ('rss_links'),
		)
	);

} elseif (! empty ($parameters['author'])) { // view all by author

	if (! $parameters['limit']) {
		$parameters['limit'] = appconf ('limit');
	}
	if (! $parameters['offset']) {
		$parameters['offset'] = 0;
	}
	$story->limit ($parameters['limit']);
	$story->offset ($parameters['offset']);
	$story->orderBy ('date desc, rank desc, id desc');
	$list = $story->find (array ('author' => $parameters['author']));
	if (! $list) {
		echo template_simple ('invalid_author.spt', array ('error' => $story->error));
		return;
	}

	$total = $story->total;

	loader_import ('saf.GUI.Pager');

	$pg = new Pager ($parameters['offset'], $parameters['limit'], $total);
	$pg->setUrl (site_prefix () . '/index/news-app?author=' . $parameters['author']);
	$pg->getInfo ();

	$date = false;
	$newlist = array ();
	foreach ($list as $item) {
		if ($date != $item->date) {
			$date = $item->date;
			$i = new StdClass;
			$i->_type = 'date';
			$i->date = $item->date;
			$newlist[] = $i;
		}
		$newlist[] = $item;
	}
	$list = $newlist;

	template_simple_register ('pager', $pg);
	echo template_simple (
		'author.spt',
		array (
			'list' => $list,
			'rss' => appconf ('rss_links'),
		)
	);

} else { // main list

	if (! $parameters['limit']) {
		$parameters['limit'] = appconf ('frontpage_limit');
	}
	if (! $parameters['offset']) {
		$parameters['offset'] = 0;
	}
	$story->limit ($parameters['limit']);
	$story->offset ($parameters['offset']);
	$story->orderBy ('date desc, rank desc, id desc');

	if (empty ($parameters['sec'])) {
		$params = array ();
	} else {
		$params = array ('category' => $parameters['sec']);
	}

	$list = $story->find ($params);
	if (! $list) {
		echo template_simple ('no_stories.spt', array ('error' => $story->error));
		return;
	}

	$total = $story->total;

	if (appconf ('comments_blog_style')) {
		loader_import ('news.Comment');
		$c = new NewsComment;

		foreach ($list as $k => $item) {
			$list[$k]->comments = $c->count ($item->id);
		}
	}

	if (! appconf ('sections') || $parameters['menu'] == 'no') {
		$menu = 'no';
	} else {
		$menu = '';
	}

	if (! appconf ('sections')) {
		loader_import ('saf.GUI.Pager');

		$pg = new Pager ($parameters['offset'], $parameters['limit'], $total);
		$pg->setUrl (site_prefix () . '/index/news-app?menu=no&limit=' . $parameters['limit']);
		$pg->getInfo ();
		template_simple_register ('pager', $pg);
	}

	if ($context == 'action') {
		page_title (appconf ('news_name'));
	}

	echo template_simple (
		'frontpage.spt',
		array (
			'pager' => is_object ($pg),
			'list' => $list,
			'menu' => $menu,
			'date' => $parameters['date'],
			'context' => $box['context'],
			'comments' => appconf ('comments_blog_style'),
			'rss' => appconf ('rss_links'),
			'sec' => $parameters['sec'],
			'home' => $parameters['home'],
			'limit' => $parameters['limit'],
			'total' => $total,
		)
	);
}

?>