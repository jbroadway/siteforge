<?php

// check for donation request to show
$proj = db_single ('select * from siteforge_project where id = ?', $parameters['proj']);
if ($proj->donation_paypal_id != '' && $parameters['step'] != 2) {
	loader_import ('siteforge.Filters');
	page_title (intl_get ('To support this software, you are kindly asked to make a contribution.'));
	echo template_simple ('donation.spt', $proj);
	return;
}

if (! $proj || strpos ($parameters['proj'], '..') !== false) {
	die ('Invalid project ID');
}

if (strpos ($parameters['dl'], '..') !== false || ! @file_exists ('inc/app/siteforge/data/' . $parameters['proj'] . '/' . $parameters['dl'])) {
	die ('Invalid filename');
}

// 1. track download stats

db_execute (
	'insert into siteforge_stat
		(id, proj_id, ts, dl_file, ip)
	values
		(null, ?, now(), ?, ?)',
	$parameters['proj'],
	$parameters['dl'],
	$_SERVER['REMOTE_ADDR']
);

// 2. download file

set_time_limit (0);

header ('Cache-control: private');
header ('Content-Type: ' . preg_replace ('|[,;].*$|i', '', mime ('inc/app/siteforge/data/' . $parameters['proj'] . '/' . $parameters['dl'])));
header ('Content-Disposition: inline; filename="' . $parameters['dl'] . '"');
header ('Content-Length: ' . filesize ('inc/app/siteforge/data/' . $parameters['proj'] . '/' . $parameters['dl']));
//echo @join ('', @file ('inc/app/siteforge/data/' . $parameters['proj'] . '/' . $parameters['dl']));
readfile ('inc/app/siteforge/data/' . $parameters['proj'] . '/' . $parameters['dl']);
exit;

?>