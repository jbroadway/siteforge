<?php

// 1. verify the input data

if (strpos ($parameters['proj'], '/') !== false || strpos ($parameters['proj'], '..') !== false) {
	die ('Invalid project ID');
}

if (strpos ($parameters['bug'], '/') !== false || strpos ($parameters['bug'], '..') !== false) {
	die ('Invalid bug ID');
}

if (strpos ($parameters['file'], '/') !== false || strpos ($parameters['file'], '..') !== false) {
	die ('Invalid filename');
}

if (! @file_exists ('inc/app/siteforge/data/_' . $parameters['proj'] . '/' . $parameters['bug'] . '.' . $parameters['file'])) {
	die ('Invalid filename');
}

// 2. download file

set_time_limit (0);

header ('Cache-control: private');
header ('Content-Type: ' . preg_replace ('|[,;].*$|i', '', mime ('inc/app/siteforge/data/_' . $parameters['proj'] . '/' . $parameters['bug'] . '.' . $parameters['file'])));
header ('Content-Disposition: inline; filename="' . $parameters['file'] . '"');
header ('Content-Length: ' . filesize ('inc/app/siteforge/data/_' . $parameters['proj'] . '/' . $parameters['bug'] . '.' . $parameters['file']));
//echo @join ('', @file ('inc/app/siteforge/data/' . $parameters['proj'] . '/' . $parameters['dl']));
readfile ('inc/app/siteforge/data/_' . $parameters['proj'] . '/' . $parameters['bug'] . '.' . $parameters['file']);
exit;

?>