<?php

if (! isset ($parameters['day'])) {
	$parameters['day'] = date ('Y-m-d');
}

$events = $e->getDay ($parameters['day']);

$events =& siteevent_translate ($events);

list ($y, $mm, $d) = split ('-', $parameters['day']);

foreach (array_keys ($events) as $k) {
	$event =& $events[$k];

	if (! empty ($parameters['category'])) {
		if ($event->category != $parameters['category']) {
			unset ($events[$k]);
			continue;
		}
	}

	if (! empty ($parameters['audience'])) {
		if ($event->audience != $parameters['audience']) {
			unset ($events[$k]);
			continue;
		}
	}

	if ($event->time == '00:00:00') {
		$event->time = '';
	} else {
		list ($h, $m, $s) = split (':', $event->time);
		$t = $event->time;
		$event->time = ltrim (strftime ('%I:%M %p', mktime ($h, $m, $s, $d, $mm, $y)), '0');
		if ($event->until_time > $t) {
			$event->time .= ' - ';
			list ($h, $m, $s) = split (':', $event->until_time);
			$event->time .= ltrim (strftime ('%I:%M %p', mktime ($h, $m, $s, $d, $mm, $y)), '0');
		}
	}
	$event->time = str_replace (':00', '', $event->time);
	if (substr_count ($event->time, 'AM') > 1) {
		$event->time = str_replace (' AM ', ' ', $event->time);
	}
	if (substr_count ($event->time, 'PM') > 1) {
		$event->time = str_replace (' PM ', ' ', $event->time);
	}
}

list ($y, $m, $d) = split ('-', $parameters['day']);
page_title (intl_get ('Events For') . ' ' . strftime ('%B %e, %Y', mktime (5, 0, 0, $m, $d, $y)));
page_title (appconf ('siteevent_title'));
echo template_simple (
	'categories.spt',
	array (
		'list' => db_fetch_array ('select * from siteevent_category order by name asc'),
		'current' => $parameters['category'],
		'alist' => db_fetch_array ('select * from siteevent_audience order by name asc'),
		'audience' => $parameters['audience'],
		'simplecal' => $parameters['simplecal'],
		'view' => $parameters['view'],
	)
);
echo template_simple (
	'day.spt',
	array (
		'list' => $events,
		'date' => strftime (appconf ('date_format'), strtotime ($parameters['day'])),
		'prevDate' => Date::subtract ($parameters['day'], '1 day'),
		'prevDay' => strftime (appconf ('date_format'), strtotime (Date::subtract ($parameters['day'], '1 day'))),
		'nextDate' => Date::add ($parameters['day'], '1 day'),
		'nextDay' => strftime (appconf ('date_format'), strtotime (Date::add ($parameters['day'], '1 day'))),
	)
);

echo '<p>';
if (appconf ('ical_links')) {
	if (! empty ($parameters['category'])) {
		$cat = '?category=' . $parameters['category'];
	} else {
		$cat = '';
	}
	echo '<a href="' . site_prefix () . '/index/siteevent-ical-action' . $cat . '">' . intl_get ('Subscribe (iCalendar)') . '</a> &nbsp; &nbsp; &nbsp; &nbsp;';
}
if (appconf ('rss_links')) {
	if (! empty ($parameters['category'])) {
		$cat = '?category=' . $parameters['category'];
	} else {
		$cat = '';
	}
	echo '<a href="' . site_prefix () . '/index/siteevent-rss-action' . $cat . '">' . intl_get ('Subscribe (RSS)') . '</a> &nbsp; &nbsp; &nbsp; &nbsp;';
}
echo '</p>';

page_title (appconf ('siteevent_title'));
if (appconf ('template_calendar')) {
	page_template (appconf ('template_calendar'));
} elseif (appconf ('template')) {
	page_template (appconf ('template'));
}

?>