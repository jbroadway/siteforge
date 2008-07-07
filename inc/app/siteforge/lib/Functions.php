<?php

function siteforge_project_owner ($proj) {
	if (! session_valid ()) {
		return false;
	}
	if (session_username () != db_shift ('select user_id from siteforge_project where id = ?', $proj)) {
		return false;
	}
	return true;
}

function siteforge_user_can_join ($owner, $members) {
	if (! session_valid ()) {
		return false;
	}
	if (session_username () == $owner) {
		return false;
	}
	if (in_array (session_username (), $members)) {
		return false;
	}
	return true;
}

function siteforge_is_member ($members) {
	if (in_array (session_username (), $members)) {
		return true;
	}
	return false;
}

function siteforge_rss_date () {
	return date ('Y-m-d\TH:i:s') . siteforge_timezone (date ('Z'));
}

function siteforge_timezone ($offset) {
	$out = $offset[0];
	$offset = substr ($offset, 1);
	$h = floor ($offset / 3600);
	$m = floor (($offset % 3600) / 60);
	return $out . str_pad ($h, 2, '0', STR_PAD_LEFT) . ':' . str_pad ($m, 2, '0', STR_PAD_LEFT);
}

?>