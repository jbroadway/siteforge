<?php

loader_import ('siteforge.Filters');

echo template_simple (
	'my_projects.spt',
	array (
		'list' => db_fetch_array (
			'select id, name, status from siteforge_project where user_id = ? order by name asc',
			session_username ()
		),
		'member' => db_fetch_array (
			'select p.id, p.name from siteforge_project p, siteforge_project_member m where m.user_id = ? and m.proj_id = p.id order by p.name asc',
			session_username ()
		),
	)
);

?>