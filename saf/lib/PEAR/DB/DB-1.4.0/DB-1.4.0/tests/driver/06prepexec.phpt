--TEST--
DB_driver::prepare/execute test
--SKIPIF--
<?php chdir(dirname(__FILE__)); include("skipif.inc"); ?>
--FILE--
<?php
include("mktable.inc");
include("../prepexe.inc");
?>
--EXPECT--
sth1,sth2,sth3 created
sth1 executed
sth2 executed
sth3 executed
results:
72 -  -  -
72 - bing -  -
72 - gazonk - opaque
placeholder
test -
