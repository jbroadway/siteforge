<?php

global $cgi;

loader_import ('saf.Misc.RPC');

if (! $cgi->table || ! $cgi->items || ! $cgi->key) {
	echo rpc_response (false);
	exit;
}

if (! $cgi->verify ('table', 'regex', '/^[a-zA-Z0-9_-]+$/')) {
	echo rpc_response (false);
	exit;
}

if (! $cgi->verify ('key', 'regex', '/^[a-zA-Z0-9_-]+$/')) {
	echo rpc_response (false);
	exit;
}

if (session_is_resource ($cgi->table) && ! session_allowed ($cgi->table, 'rw', 'resource')) {
	echo rpc_response (false);
	exit;
}

$items = preg_split ('/, ?/', $cgi->items);

foreach ($items as $item) {
	db_execute ('insert into ' . $cgi->table . ' (' . $cgi->key . ') values (?)', $item);
}

echo rpc_response (true);
exit;

?>