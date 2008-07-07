<?php

// 1. verify the input data

if (strpos ($parameters['proj'], '/') !== false || strpos ($parameters['proj'], '..') !== false) {
	die ('Invalid project ID');
}

if (strpos ($parameters['comment'], '/') !== false || strpos ($parameters['comment'], '..') !== false) {
	die ('Invalid comment ID');
}

if (strpos ($parameters['file'], '/') !== false || strpos ($parameters['file'], '..') !== false) {
	die ('Invalid filename');
}

if (! @file_exists ('inc/app/siteforge/data/_' . $parameters['proj'] . '/c' . $parameters['comment'] . '.' . $parameters['file'])) {
	die ('Invalid filename');
}

// 2. download file

set_time_limit (0);

header ('Cache-control: private');
header ('Content-Type: ' . preg_replace ('|[,;].*$|i', '', mime ('inc/app/siteforge/data/_' . $parameters['proj'] . '/c' . $parameters['comment'] . '.' . $parameters['file'])));
header ('Content-Disposition: inline; filename="' . $parameters['file'] . '"');
header ('Content-Length: ' . filesize ('inc/app/siteforge/data/_' . $parameters['proj'] . '/c' . $parameters['comment'] . '.' . $parameters['file']));
//echo @join ('', @file ('inc/app/siteforge/data/' . $parameters['proj'] . '/' . $parameters['dl']));
readfile ('inc/app/siteforge/data/_' . $parameters['proj'] . '/c' . $parameters['comment'] . '.' . $parameters['file']);
exit;

?>