<?php

/**
 *
 * 1. Copy to /root/bin from siteforge/install/siteforge
 *
 * cp -R inc/app/siteforge/install/siteforge /root/bin/siteforge
 * chmod -R 700 /root/bin/siteforge
 *
 * 2. Schedule to run hourly as root via cron:
 *
 * 0 * * * * /usr/local/bin/php -f /root/bin/siteforge/cron.php
 *
 */

// a function for randomly generating passwords
function siteforge_passwd ($length = 8) {
	$p = '';
	$chars = '0123456789bcdfghjkmnpqrstvwxyz';
	$c = 0;
	while ($c < $length) {
		$ch = substr ($chars, mt_rand (0, strlen ($chars) - 1), 1);
		if (! strstr ($p, $ch)) {
			$p .= $ch;
			$c++;
		}
	}
	return $p;
}

function siteforge_get_user ($username) {
	global $conf, $conn, $c2;

	if ($c2) {
		$c = $c2;
	} else {
		$c = $conn;
	}

	$res2 = mysql_query (
		'select email from sitellite_user where username = \'' . mysql_escape_string ($username) . '\'',
		$c
	);
	if (! $res2) {
		echo 'Query failed: ' . mysql_error ($c) . "\n";
		exit;
	}
	$user = mysql_fetch_assoc ($res2);
	mysql_free_result ($res2);
	return $user;
}

function debug ($msg) {
	if ($GLOBALS['conf']['debug'] == true) {
		echo 'D: ' . $msg . "\n";
	}
}

ob_implicit_flush (1);

//read conf.php as ini file
$conf = parse_ini_file ('/root/bin/siteforge/conf.php', true);
//$conf['debug'] = true;

// connect to the database
$conn = mysql_connect (
	$conf['Database']['server'] . ':' . $conf['Database']['port'],
	$conf['Database']['username'],
	$conf['Database']['password']
);
if (! $conn) {
	echo 'Could not establish database connection: ' . mysql_error ($conn) . "\n";
	exit;
} else {
	debug ('Connected');
}

if (! mysql_select_db ($conf['Database']['database'], $conn)) {
	echo 'Could not select the database: ' . mysql_error ($conn) . "\n";
	exit;
} else {
	debug ('Selected');
}

if ($conf['User Database'] && $conf['User Database']['database'] != $conf['Database']['database']) {
	$c2 = mysql_connect (
		$conf['User Database']['server'] . ':' . $conf['User Database']['port'],
		$conf['User Database']['username'],
		$conf['User Database']['password'],
		true
	);
	if (! $c2) {
		echo 'Could not establish database connection: ' . mysql_error ($c2) . "\n";
		exit;
	}

	if (! mysql_select_db ($conf['User Database']['database'], $c2)) {
		echo 'Could not select the database: ' . mysql_error ($c2) . "\n";
		exit;
	}
} else {
	$c2 = false;
}

// make sure we can write to /etc/xinetd.d/cvspserver
$fp = fopen ('/etc/xinetd.d/cvspserver', 'w');
if (! $fp) {
	echo 'Failed to open /etc/xinetd.d/cvspserver' . "\n";
	exit;
} else {
	debug ('Opened cvspserver');
}

// grab all the approved projects
$res = mysql_query (
	'select * from siteforge_project where (status = 2 or status > 3)',
	$conn
);
if (! $res) {
	echo 'Query failed: ' . mysql_error ($conn) . "\n";
	exit;
} else {
	debug ('Query succeeded');
}

$allow_roots = array ();

while ($row = mysql_fetch_assoc ($res)) {
	debug ('Current project: ' . $row['id']);

	if (! is_dir ($conf['CVS']['base'] . '/' . $row['id'])) {
		// repository doesn't exist yet

		// create a new project repository
		mkdir ($conf['CVS']['base'] . '/' . $row['id']);
		umask (0000);
		chmod ($conf['CVS']['base'] . '/' . $row['id'], 0755);
		exec ($conf['CVS']['command'] . ' -d ' . $conf['CVS']['base'] . '/' . $row['id'] . ' init', $out, $err);

		// generate random password
		$passwd = siteforge_passwd (8);
		$salt = siteforge_passwd (2);

		// enable the project owner and anonymous access to the project repository
		exec ('/bin/echo ' . escapeshellarg ($row['id']) . ' > ' . $conf['CVS']['base'] . '/' . $row['id'] . '/CVSROOT/writers', $out, $err);
		exec ('/bin/echo "anonymous::' . $conf['CVS']['user'] . '" > ' . $conf['CVS']['base'] . '/' . $row['id'] . '/CVSROOT/passwd', $out, $err);
		exec ('/bin/echo "' . $row['id'] . ':' . crypt ($passwd, $salt) . ':' . $conf['CVS']['user'] . '" >> ' . $conf['CVS']['base'] . '/' . $row['id'] . '/CVSROOT/passwd', $out, $err);

		// adjust the repository permissions
		chown ($conf['CVS']['base'] . '/' . $row['id'], $conf['CVS']['user']);
		umask (0000);
		chmod ($conf['CVS']['base'] . '/' . $row['id'], 0700);

		// email the project owner with the password, bcc the site admin
		/*$res2 = mysql_query (
			'select email from sitellite_user where username = \'' . mysql_escape_string ($row['user_id']) . '\''
		);
		if (! $res2) {
			echo 'Query failed: ' . mysql_error () . "\n";
			exit;
		}
		$user = mysql_fetch_assoc ($res2);
		mysql_free_result ($res2);*/
		$user = siteforge_get_user ($row['user_id']);
		$message = join ('', file ('/root/bin/siteforge/email.php'));
		ob_start ();
		eval ('?' . '>' . $message);
		$message = ob_get_contents ();
		ob_end_clean ();
		@mail (
			$user['email'],
			'Project Repository Information',
			$message,
			'From: noreply@' . preg_replace ('/^www\./', '', $conf['Site']['domain']) . "\r\n" .
			'BCC: ' . $conf['Site']['admin_email']
		);
	}

	// add to allowed roots
	$allow_roots[] = $row['id'];
}

// rewrite /etc/xinet.d/cvspserver file
$cvspserver = join ('', file ('/root/bin/siteforge/cvspserver.php'));
ob_start ();
eval ('?' . '>' . $cvspserver);
$cvspserver = ob_get_contents ();
ob_end_clean ();
fwrite ($fp, $cvspserver);

fclose ($fp);

// restart xinetd
exec ('/bin/kill -HUP `cat /var/run/xinetd.pid`', $out, $err);

/*

Pseudocode:

foreach (projects with status != 2) {

	if (folder missing from cvsroot) {
		mkdir cvsroot/project_id

		cvs -d cvsroot/project_id init

		writer username is project_id
		password is randomly generated

		add writer to writers (username)

		add writer/password to passwd

		add anonymous to passwd

		email password and instructions to site owner
	}

	add to allow_root list
}

rewrite /etc/xinetd.d/cvspserver

restart xinetd

*/

?>
