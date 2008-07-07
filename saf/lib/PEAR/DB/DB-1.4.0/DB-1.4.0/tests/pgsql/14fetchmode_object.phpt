--TEST--
DB_pgsql::fetchmode object
--SKIPIF--
<?php require "skipif.inc"; ?>
--FILE--
<?php
require './connect.inc';
include '../fetchmode_object.inc';
?>
--EXPECT--
--- fetch with param DB_FETCHMODE_OBJECT ---
stdClass -> a b c d
stdClass -> a b c d
--- fetch with default fetchmode DB_FETCHMODE_OBJECT ---
stdClass -> a b c d
stdClass -> a b c d
--- fetch with default fetchmode DB_FETCHMODE_OBJECT and class DB_Row ---
db_row -> a b c d
db_row -> a b c d
