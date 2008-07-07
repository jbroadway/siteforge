<?php

loader_import ('siteforge.Filters');

$parameters['set'] = conf ('Server', 'default_template_set');

echo template_simple ('preview.spt', $parameters);

exit;

?>