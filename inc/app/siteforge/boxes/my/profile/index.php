<?php

echo template_simple (
	'my_profile.spt',
	array (
		'list' => db_fetch_array (
			'select * from siteforge_project where user_id = ? and (status = 2 or status > 3) order by name asc',
			$parameters['user']
		),
		'member' => db_fetch_array (
			'select p.id, p.name from siteforge_project p, siteforge_project_member m where m.user_id = ? and m.proj_id = p.id order by p.name asc',
			$parameters['user']
		),
	)
);

?>