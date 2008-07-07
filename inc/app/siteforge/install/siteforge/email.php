Your project CVS repository has been created.  You can access it with the
following CVS information:

CVSROOT=:pserver:<?php echo $row['id']; ?>@<?php echo $conf['CVS']['server']; ?>:<?php echo $conf['CVS']['base']; ?>/<?php echo $row['id'] . "\n"; ?>
Username: <?php echo $row['id'] . "\n"; ?>
Password: <?php echo $passwd . "\n"; ?>

Note: Do NOT lose this password (and don't give it out to anyone).  It is
the key to accessing the source files of your project.  Keep it somewhere
very secret and very safe.

For more information, visit your project website at:

http://<?php echo $conf['Site']['domain'] . $conf['Site']['subfolder']; ?>/index/siteforge-cvsinfo-action/proj.<?php echo $row['id'] . "\n"; ?>

--
