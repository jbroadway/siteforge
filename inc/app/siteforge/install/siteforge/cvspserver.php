service cvspserver
{
	port        = 2401
	disable     = no
	socket_type = stream
	protocol    = tcp
	wait        = no
	user        = root
	passenv     = PATH
	server      = /usr/bin/cvs
	server_args = -f<?php

foreach ($allow_roots as $root) {
	echo ' --allow-root=' . $conf['CVS']['base'] . '/' . $root;
}

?> pserver
	flags       = REUSE
}
