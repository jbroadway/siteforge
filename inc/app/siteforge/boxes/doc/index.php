<?php

$ext = db_shift ('select ext_docs from siteforge_project where id = ?', $parameters['proj']);
if (! empty ($ext)) {
        header ('Location: ' . $ext);
        exit;
}

loader_import ('siteforge.Filters');
loader_import ('siteforge.Functions');

if (! isset ($parameters['proj'])) {
	page_title (intl_get ('Not Found'));
	echo '<p>' . intl_get ('The document you requested was not found.') . '</p>';
	return;
}

if (! $parameters['doc']) {
	$docs = db_pairs (
		'select id, title from siteforge_doc where proj_id = ? order by sort_weight desc, title asc',
		$parameters['proj']
	);
	if (count ($docs) == 0) {
		$doc = new StdClass;
		$doc->title = intl_get ('Not Found');
		$doc->proj_id = $parameters['proj'];
		$doc->body = intl_get ('The document you requested was not found.');
		page_title (siteforge_filter_proj ($doc->proj_id) . ' - ' . intl_get ('Docs'));
		echo template_simple (
			'doc.spt',
			$doc
		);
		return;
	}
	$doc = db_single (
		'select * from siteforge_doc where id = ? and proj_id = ?',
		array_shift (array_keys ($docs)),
		$parameters['proj']
	);

} else {
	$doc = db_single (
		'select * from siteforge_doc where id = ? and proj_id = ?',
		$parameters['doc'],
		$parameters['proj']
	);
	if (! $doc) {
		page_title (intl_get ('Not Found'));
		echo '<p>' . intl_get ('The document you requested was not found.') . '</p>';
		return;
	}
	$docs = db_pairs (
		'select id, title from siteforge_doc where proj_id = ? order by sort_weight desc, title asc',
		$doc->proj_id
	);
}

global $cgi;

$cgi->proj = $doc->proj_id;

$doc->nav =& $docs;

page_title (siteforge_filter_proj ($doc->proj_id) . ' - ' . intl_get ('Docs'));

echo template_simple (
	'doc.spt',
	$doc
);

?>
