<?php

loader_import ('siteforge.CustomProject');

class Project extends SiteForge_CustomProject {
	function Project ($id = false) {
		parent::SiteForge_CustomProject ('siteforge_project', 'id');
		

		if (is_array ($id)) {
			$newkey = $this->add ($id);
			if (is_numeric ($newkey)) {
				$this->setCurrent ($this->get ($newkey));
			} else {
				$this->setCurrent ($this->get ($id['id']));
			}
		} elseif (is_object ($id)) {
			$this->setCurrent ($id);
		} elseif ($id) {
			$this->setCurrent ($this->get ($id));
		}


		$this->_cascade['Stat'] = 'proj_id';
		$this->_cascade['Bug'] = 'proj_id';
		$this->_cascade['News'] = 'proj_id';
		$this->_cascade['Doc'] = 'proj_id';
	}

	function &setStat (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->proj_id = $this->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_stat set proj_id = ? where id = ?',
			$this->pkey (),
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return $o;
	}

	function unsetStat (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->proj_id = 0;
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_stat set proj_id = ? where id = ?',
			0,
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return true;
	}

	function getStats ($id = false) {
		if (! $id) {
			$id = $this->val ('id');
		} elseif (is_object ($id)) {
			$id = $id->id;
		}

		return db_fetch_array (
			'select * from siteforge_stat
			where proj_id = ?',
			$id
		);
	}

	function &setBug (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->proj_id = $this->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_bug set proj_id = ? where id = ?',
			$this->pkey (),
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return $o;
	}

	function unsetBug (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->proj_id = 0;
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_bug set proj_id = ? where id = ?',
			0,
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return true;
	}

	function getBugs ($id = false) {
		if (! $id) {
			$id = $this->val ('id');
		} elseif (is_object ($id)) {
			$id = $id->id;
		}

		return db_fetch_array (
			'select * from siteforge_bug
			where proj_id = ?',
			$id
		);
	}

	function &setNews (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->proj_id = $this->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_news set proj_id = ? where id = ?',
			$this->pkey (),
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return $o;
	}

	function unsetNews (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->proj_id = 0;
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_news set proj_id = ? where id = ?',
			0,
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return true;
	}

	function getNews ($id = false) {
		if (! $id) {
			$id = $this->val ('id');
		} elseif (is_object ($id)) {
			$id = $id->id;
		}

		return db_fetch_array (
			'select * from siteforge_news
			where proj_id = ?',
			$id
		);
	}

	function &setDoc (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->proj_id = $this->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_doc set proj_id = ? where id = ?',
			$this->pkey (),
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return $o;
	}

	function unsetDoc (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->proj_id = 0;
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_doc set proj_id = ? where id = ?',
			0,
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return true;
	}

	function getDocs ($id = false) {
		if (! $id) {
			$id = $this->val ('id');
		} elseif (is_object ($id)) {
			$id = $id->id;
		}

		return db_fetch_array (
			'select * from siteforge_doc
			where proj_id = ?',
			$id
		);
	}

	function &setCategory (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set category = ? where id = ?',
			$k,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->category = $k;
		return $o;
	}

	function unsetCategory (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set category = ? where id = ?',
			0,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->category = 0;
		return true;
	}

	function getCategory () {
		return db_single (
			'select * from siteforge_category
			where id = ?',
			$this->val ('category')
		);
	}

	function &setStatus (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set status = ? where id = ?',
			$k,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->status = $k;
		return $o;
	}

	function unsetStatus (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set status = ? where id = ?',
			0,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->status = 0;
		return true;
	}

	function getStatus () {
		return db_single (
			'select * from siteforge_status
			where id = ?',
			$this->val ('status')
		);
	}

	function &setLicense (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set license = ? where id = ?',
			$k,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->license = $k;
		return $o;
	}

	function unsetLicense (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set license = ? where id = ?',
			0,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->license = 0;
		return true;
	}

	function getLicense () {
		return db_single (
			'select * from siteforge_license
			where id = ?',
			$this->val ('license')
		);
	}

	function &setAudience (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set audience = ? where id = ?',
			$k,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->audience = $k;
		return $o;
	}

	function unsetAudience (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set audience = ? where id = ?',
			0,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->audience = 0;
		return true;
	}

	function getAudience () {
		return db_single (
			'select * from siteforge_audience
			where id = ?',
			$this->val ('audience')
		);
	}
}

class Category extends Generic {
	function Category ($id = false) {
		parent::Generic ('siteforge_category', 'id');
		

		if (is_array ($id)) {
			$newkey = $this->add ($id);
			if (is_numeric ($newkey)) {
				$this->setCurrent ($this->get ($newkey));
			} else {
				$this->setCurrent ($this->get ($id['id']));
			}
		} elseif (is_object ($id)) {
			$this->setCurrent ($id);
		} elseif ($id) {
			$this->setCurrent ($this->get ($id));
		}

		// Category cascade
	}

	function &setProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->category = $this->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set category = ? where id = ?',
			$this->pkey (),
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return $o;
	}

	function unsetProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->category = 0;
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set category = ? where id = ?',
			0,
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return true;
	}

	function getProjects ($id = false) {
		if (! $id) {
			$id = $this->val ('id');
		} elseif (is_object ($id)) {
			$id = $id->id;
		}

		return db_fetch_array (
			'select * from siteforge_project
			where category = ?',
			$id
		);
	}
}

class Status extends Generic {
	function Status ($id = false) {
		parent::Generic ('siteforge_status', 'id');
		

		if (is_array ($id)) {
			$newkey = $this->add ($id);
			if (is_numeric ($newkey)) {
				$this->setCurrent ($this->get ($newkey));
			} else {
				$this->setCurrent ($this->get ($id['id']));
			}
		} elseif (is_object ($id)) {
			$this->setCurrent ($id);
		} elseif ($id) {
			$this->setCurrent ($this->get ($id));
		}

		// Status cascade
	}

	function &setProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->status = $this->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set status = ? where id = ?',
			$this->pkey (),
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return $o;
	}

	function unsetProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->status = 0;
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set status = ? where id = ?',
			0,
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return true;
	}

	function getProjects ($id = false) {
		if (! $id) {
			$id = $this->val ('id');
		} elseif (is_object ($id)) {
			$id = $id->id;
		}

		return db_fetch_array (
			'select * from siteforge_project
			where status = ?',
			$id
		);
	}
}

class License extends Generic {
	function License ($id = false) {
		parent::Generic ('siteforge_license', 'id');
		

		if (is_array ($id)) {
			$newkey = $this->add ($id);
			if (is_numeric ($newkey)) {
				$this->setCurrent ($this->get ($newkey));
			} else {
				$this->setCurrent ($this->get ($id['id']));
			}
		} elseif (is_object ($id)) {
			$this->setCurrent ($id);
		} elseif ($id) {
			$this->setCurrent ($this->get ($id));
		}

		// License cascade
	}

	function &setProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->license = $this->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set license = ? where id = ?',
			$this->pkey (),
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return $o;
	}

	function unsetProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->license = 0;
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set license = ? where id = ?',
			0,
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return true;
	}

	function getProjects ($id = false) {
		if (! $id) {
			$id = $this->val ('id');
		} elseif (is_object ($id)) {
			$id = $id->id;
		}

		return db_fetch_array (
			'select * from siteforge_project
			where license = ?',
			$id
		);
	}
}

class Audience extends Generic {
	function Audience ($id = false) {
		parent::Generic ('siteforge_audience', 'id');
		

		if (is_array ($id)) {
			$newkey = $this->add ($id);
			if (is_numeric ($newkey)) {
				$this->setCurrent ($this->get ($newkey));
			} else {
				$this->setCurrent ($this->get ($id['id']));
			}
		} elseif (is_object ($id)) {
			$this->setCurrent ($id);
		} elseif ($id) {
			$this->setCurrent ($this->get ($id));
		}

		// Audience cascade
	}

	function &setProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->audience = $this->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set audience = ? where id = ?',
			$this->pkey (),
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return $o;
	}

	function unsetProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->audience = 0;
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_project set audience = ? where id = ?',
			0,
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return true;
	}

	function getProjects ($id = false) {
		if (! $id) {
			$id = $this->val ('id');
		} elseif (is_object ($id)) {
			$id = $id->id;
		}

		return db_fetch_array (
			'select * from siteforge_project
			where audience = ?',
			$id
		);
	}
}

class News extends Generic {
	function News ($id = false) {
		parent::Generic ('siteforge_news', 'id');
		

		if (is_array ($id)) {
			$newkey = $this->add ($id);
			if (is_numeric ($newkey)) {
				$this->setCurrent ($this->get ($newkey));
			} else {
				$this->setCurrent ($this->get ($id['id']));
			}
		} elseif (is_object ($id)) {
			$this->setCurrent ($id);
		} elseif ($id) {
			$this->setCurrent ($this->get ($id));
		}

		// News cascade
	}

	function &setProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_news set proj_id = ? where id = ?',
			$k,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->proj_id = $k;
		return $o;
	}

	function unsetProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_news set proj_id = ? where id = ?',
			0,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->proj_id = 0;
		return true;
	}

	function getProject () {
		return db_single (
			'select * from siteforge_project
			where id = ?',
			$this->val ('proj_id')
		);
	}
}

class Doc extends Generic {
	function Doc ($id = false) {
		parent::Generic ('siteforge_doc', 'id');
		

		if (is_array ($id)) {
			$newkey = $this->add ($id);
			if (is_numeric ($newkey)) {
				$this->setCurrent ($this->get ($newkey));
			} else {
				$this->setCurrent ($this->get ($id['id']));
			}
		} elseif (is_object ($id)) {
			$this->setCurrent ($id);
		} elseif ($id) {
			$this->setCurrent ($this->get ($id));
		}

		// Doc cascade
	}

	function &setProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_doc set proj_id = ? where id = ?',
			$k,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->proj_id = $k;
		return $o;
	}

	function unsetProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_doc set proj_id = ? where id = ?',
			0,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->proj_id = 0;
		return true;
	}

	function getProject () {
		return db_single (
			'select * from siteforge_project
			where id = ?',
			$this->val ('proj_id')
		);
	}
}

class Bug extends Generic {
	function Bug ($id = false) {
		parent::Generic ('siteforge_bug', 'id');
		

		if (is_array ($id)) {
			$newkey = $this->add ($id);
			if (is_numeric ($newkey)) {
				$this->setCurrent ($this->get ($newkey));
			} else {
				$this->setCurrent ($this->get ($id['id']));
			}
		} elseif (is_object ($id)) {
			$this->setCurrent ($id);
		} elseif ($id) {
			$this->setCurrent ($this->get ($id));
		}


		$this->_cascade['Comment'] = 'bug_id';
	}

	function &setComment (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->bug_id = $this->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_bug_comment set bug_id = ? where id = ?',
			$this->pkey (),
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return $o;
	}

	function unsetComment (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
			$o->_current->bug_id = 0;
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_bug_comment set bug_id = ? where id = ?',
			0,
			$k
		)) {
			$this->error = db_error ();
			return false;
		}
		return true;
	}

	function getComments ($id = false) {
		if (! $id) {
			$id = $this->val ('id');
		} elseif (is_object ($id)) {
			$id = $id->id;
		}

		return db_fetch_array (
			'select * from siteforge_bug_comment
			where bug_id = ?',
			$id
		);
	}

	function &setProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_bug set proj_id = ? where id = ?',
			$k,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->proj_id = $k;
		return $o;
	}

	function unsetProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_bug set proj_id = ? where id = ?',
			0,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->proj_id = 0;
		return true;
	}

	function getProject () {
		return db_single (
			'select * from siteforge_project
			where id = ?',
			$this->val ('proj_id')
		);
	}
}

class Comment extends Generic {
	function Comment ($id = false) {
		parent::Generic ('siteforge_bug_comment', 'id');
		

		if (is_array ($id)) {
			$newkey = $this->add ($id);
			if (is_numeric ($newkey)) {
				$this->setCurrent ($this->get ($newkey));
			} else {
				$this->setCurrent ($this->get ($id['id']));
			}
		} elseif (is_object ($id)) {
			$this->setCurrent ($id);
		} elseif ($id) {
			$this->setCurrent ($this->get ($id));
		}

		// Comment cascade
	}

	function &setBug (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_bug_comment set bug_id = ? where id = ?',
			$k,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->bug_id = $k;
		return $o;
	}

	function unsetBug (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_bug_comment set bug_id = ? where id = ?',
			0,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->bug_id = 0;
		return true;
	}

	function getBug () {
		return db_single (
			'select * from siteforge_bug
			where id = ?',
			$this->val ('bug_id')
		);
	}
}

class Stat extends Generic {
	function Stat ($id = false) {
		parent::Generic ('siteforge_stat', 'id');
		

		if (is_array ($id)) {
			$newkey = $this->add ($id);
			if (is_numeric ($newkey)) {
				$this->setCurrent ($this->get ($newkey));
			} else {
				$this->setCurrent ($this->get ($id['id']));
			}
		} elseif (is_object ($id)) {
			$this->setCurrent ($id);
		} elseif ($id) {
			$this->setCurrent ($this->get ($id));
		}

		// Stat cascade
	}

	function &setProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_stat set proj_id = ? where id = ?',
			$k,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->proj_id = $k;
		return $o;
	}

	function unsetProject (&$o) {
		if (is_subclass_of ($o, 'Generic')) {
			$k = $o->pkey ();
		} else {
			$k = $o->id;
		}
		if (! db_execute (
			'update siteforge_stat set proj_id = ? where id = ?',
			0,
			$this->pkey ()
		)) {
			$this->error = db_error ();
			return false;
		}
		$this->_current->proj_id = 0;
		return true;
	}

	function getProject () {
		return db_single (
			'select * from siteforge_project
			where id = ?',
			$this->val ('proj_id')
		);
	}
}

?>