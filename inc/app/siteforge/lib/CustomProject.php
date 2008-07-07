<?php

loader_import ('saf.Database.Generic');

class SiteForge_CustomProject extends Generic {
	function SiteForge_CustomProject ($table = '', $pkey = '', $fkey = '', $listFields = '*', $isAuto = true) {
		parent::Generic ($table, $pkey, $fkey, $listFields, $isAuto);
		$this->isAuto = false;
	}

	function add ($struct) {
		$res = parent::add ($struct);
		if ($res) {
			$struct = (array) $struct;

			db_execute (
				'insert into siteforge_forum
					(id, proj_id, name, summary)
				values
					(null, ?, ?, ?)',
				$struct['id'],
				'General',
				'General questions/discussion goes here.'
			);

			mkdir ('inc/app/siteforge/data/' . $struct['id']);
			umask (0000);
			chmod ('inc/app/siteforge/data/' . $struct['id'], 0777);

			$struct['forward'] = urlencode (
				sprintf (
					'%s/index/cms-edit-form?_return=/index/cms-browse-action/collection.siteforge_project&_collection=siteforge_project&_key=%s',
					site_prefix (),
					$struct['id']
				)
			);

			@mail (
				appconf ('admin_email'),
				intl_get ('New Project'),
				template_simple ('email_project_add.spt', $struct),
				'From: noreply@' . preg_replace ('/^www\./', '', site_domain ())
			);
		}
		return $res;
	}
}

?>
