<?php

loader_import ('siteforge.Filters');

if ($parameters['proj']) {

$stats = array ();

$today = db_pairs (
	'select dl_file, count(*) as total
	from siteforge_stat
	where proj_id = ?
	and ts >= ? and ts <= ?
	group by dl_file asc',
	$parameters['proj'],
	date ('Y-m-d 00:00:00'),
	date ('Y-m-d 23:59:59')
);

$yesterday = db_pairs (
	'select dl_file, count(*) as total
	from siteforge_stat
	where proj_id = ?
	and ts >= ? and ts <= ?
	group by dl_file asc',
	$parameters['proj'],
	date ('Y-m-d 00:00:00', time () - 86400),
	date ('Y-m-d 23:59:59', time () - 86400)
);

$month = db_pairs (
	'select dl_file, count(*) as total
	from siteforge_stat
	where proj_id = ?
	and ts >= ? and ts <= ?
	group by dl_file asc',
	$parameters['proj'],
	date ('Y-m-01 00:00:00'),
	date ('Y-m-t 23:59:59')
);

$total = db_pairs (
	'select dl_file, count(*) as total
	from siteforge_stat
	where proj_id = ?
	group by dl_file asc',
	$parameters['proj']
);

foreach ($today as $k => $v) {
	if (empty ($k)) {
		$k = 'project';
	}
	if (! isset ($stats[$k])) {
		$stats[$k] = array (
			'today' => 0,
			'yesterday' => 0,
			'month' => 0,
			'total' => 0,
		);
	}
	$stats[$k]['today'] = $v;
}

foreach ($yesterday as $k => $v) {
	if (empty ($k)) {
		$k = 'project';
	}
	if (! isset ($stats[$k])) {
		$stats[$k] = array (
			'today' => 0,
			'yesterday' => 0,
			'month' => 0,
			'total' => 0,
		);
	}
	$stats[$k]['yesterday'] = $v;
}

foreach ($month as $k => $v) {
	if (empty ($k)) {
		$k = 'project';
	}
	if (! isset ($stats[$k])) {
		$stats[$k] = array (
			'today' => 0,
			'yesterday' => 0,
			'month' => 0,
			'total' => 0,
		);
	}
	$stats[$k]['month'] = $v;
}

foreach ($total as $k => $v) {
	if (empty ($k)) {
		$k = 'project';
	}
	if (! isset ($stats[$k])) {
		$stats[$k] = array (
			'today' => 0,
			'yesterday' => 0,
			'month' => 0,
			'total' => 0,
		);
	}
	$stats[$k]['total'] = $v;
}

function siteforge_sort_stats ($a, $b) {
        if ($a == 'project') {
                return -1;
        } elseif ($b == 'project') {
                return 1;
        }
        if ($a == $b) {
                return 0;
        }
        if (version_compare ($a, $b) == -1) {
        	return 1;
        }
        return -1;
        //return ($a > $b) ? -1 : 1;
}

uksort ($stats, 'siteforge_sort_stats');

page_title (siteforge_filter_proj ($parameters['proj']) . ' - ' . intl_get ('Stats'));

echo template_simple (
	'stats.spt',
	array (
		'stats' => $stats,
		'proj' => $parameters['proj'],
	)
);

} else {

	// global stats

	echo template_simple (
		'stats_global.spt',
		array (
			'users' => session_user_get_total (false, false, false),
			'projects' => db_shift ('select count(*) from siteforge_project where (status = 2 or status > 3)'),
			'downloads' => db_shift ('select count(*) from siteforge_stat where dl_file is not null'),
			'hits' => db_shift ('select count(*) from siteforge_stat where dl_file is null'),
			'top5' => db_pairs (
				'select proj_id, count(*) as total
				from siteforge_stat
				group by proj_id
				order by total desc
				limit 5'
			),
		)
	);

}

?>