<?php

$ext = db_shift ('select ext_bugs from siteforge_project where id = ?', $parameters['proj']);
if (! empty ($ext)) {
        header ('Location: ' . $ext);
        exit;
}

loader_import ('siteforge.Filters');
loader_import ('siteforge.Functions');
loader_import ('saf.File.Directory');

if ($parameters['id']) {
	$obj = db_single (
		'select * from siteforge_bug where id = ?',
		$parameters['id']
	);

	// verify the project
	if (! db_shift ('select count(*) from siteforge_project where id = ?', $obj->proj_id)) {
		page_title (intl_get ('Project Not Found'));
		echo '<a href="#" onclick="history.go (-1)">' . intl_get ('Back') . '</a>';
		return;
	}

	$obj->comments = db_fetch_array (
		'select * from siteforge_bug_comment where bug_id = ? order by ts asc',
		$parameters['id']
	);
	foreach (array_keys ($obj->comments) as $k) {
		if (@is_dir ('inc/app/siteforge/data/_' . $obj->proj_id)) {
			$obj->comments[$k]->attachment = array_shift (Dir::find ('c' . $obj->comments[$k]->id . '.*', 'inc/app/siteforge/data/_' . $obj->proj_id));
		} else {
			$obj->comments[$k]->attachment = false;
		}
	}

	page_title ($obj->subject);
	$extras = array ();
	$c = appconf ('extras');
	$c2 = $c;
	for ($i = 1; $i < count ($c) + 1; $i++) {
		$name = array_shift (array_keys ($c2));
		$cur = array_shift ($c2);
		$extras[$name] = $obj->{'extra' . $i};
	}

	$obj->extras = $extras;
	$obj->user = $parameters['username'];

	global $cgi;
	$cgi->proj = $obj->proj_id;

	if (@is_dir ('inc/app/siteforge/data/_' . $obj->proj_id)) {
		$obj->attachment = array_shift (Dir::find ($parameters['id'] . '.*', 'inc/app/siteforge/data/_' . $obj->proj_id));
	} else {
		$obj->attachment = false;
	}

	echo template_simple (
		'bug.spt',
		$obj
	);
} elseif ($parameters['proj']) {
	// verify the project
	if (! db_shift ('select count(*) from siteforge_project where id = ?', $parameters['proj'])) {
		page_title (intl_get ('Project Not Found'));
		echo '<a href="#" onclick="history.go (-1)">' . intl_get ('Back') . '</a>';
		return;
	}

	if ($context == 'action') {
		global $cgi;
	
		if (! isset ($cgi->offset)) {
			$cgi->offset = 0;
		}

		$where = '';

		if (! isset ($cgi->_status) || empty ($cgi->_status)) {
			$where .= ' and status != "resolved"';
		} else {
			$where .= ' and status = ' . db_quote ($cgi->_status);
		}

		for ($i = 1; $i < count (appconf ('extras')) + 1; $i++) {
			if (! empty ($cgi->{'_extra' . $i})) {
				$where .= ' and extra' . $i . ' = ' . db_quote ($cgi->{'_extra' . $i});
			}
		}
	
		$q = db_query (
			'select id, user_id, subject, ts, status from siteforge_bug where proj_id = ? ' . $where . ' order by ts desc'
		);
		if (! $q->execute ($parameters['proj'])) {
			die ($q->error ());
		}
		$total = $q->rows ();
		$bugs = $q->fetch ($cgi->offset, 10);
		$q->free ();

		loader_import ('cms.Versioning.Rex');

		$rex = new Rex (false);

		$rex->facets['status'] = new rSelectFacet (
			'status',
			array (
				'display' => intl_get ('Status'),
				'type' => 'select',
				'values' => "array ('new','feature request','verified','invalid','not reproducible','need more info','resolved')",
				'count' => false,
				'preserve' => array ('proj'),
			)
		);

		$c = 1;
		foreach (appconf ('extras') as $name => $options) {
			$rex->facets['extra' . $c] = new rSelectFacet (
				'extra' . $c,
				array (
					'display' => $name,
					'type' => 'select',
					'values' => 'unserialize (\'' . serialize ($options) . '\')',
					'count' => false,
					'preserve' => array ('proj'),
				)
			);
			$c++;
		}

		loader_import ('saf.GUI.Pager');
	
		$pg = new Pager ($cgi->offset, 10, $total);
		$pg->setUrl (
			site_prefix () . '/index/siteforge-bugs-action?proj=%s&_status=%s&_extra1=%s&_extra2=%s&_extra3=%s',
			$parameters['proj'],
			$parameters['_status'],
			$parameters['_extra1'],
			$parameters['_extra2'],
			$parameters['_extra3']
		);
		$pg->getInfo ();
	
		page_title (siteforge_filter_proj ($parameters['proj']) . ' - ' . intl_get ('Bugs'));
	
		template_simple_register ('pager', $pg);
	
		echo template_simple (
			'bugs.spt',
			array (
				'bugs' => $bugs,
				'proj' => $parameters['proj'],
				'status' => $cgi->status,
				'facets' => $rex->renderFacets (2),
			)
		);
	} else {
		$bugs = db_fetch_array (
			'select id, subject, ts from siteforge_bug where proj_id = ? and status != "resolved" order by ts desc limit 5',
			$parameters['proj']
		);
	
		echo template_simple (
			'bugs_summary.spt',
			array (
				'bugs' => $bugs,
				'proj' => $parameters['proj'],
			)
		);
	}
}

?>
