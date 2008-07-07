--TEST--
DB_ibase error mapping
--SKIPIF--
<?php require "skipif.inc"; ?>
--FILE--
<?php
require "connect.inc";
require "mktable.inc";
require dirname(__FILE__)."/../errors.inc";
?>
--EXPECT--
Trying to provoke DB_ERROR_NOSUCHTABLE
  DB Error: no such table
Trying to provoke DB_ERROR_ALREADY_EXISTS
  DB Error: already exists
Trying to provoke DB_ERROR_NOSUCHTABLE
  DB Error: no such table
Trying to provoke DB_ERROR_CONSTRAINT
Trying to provoke DB_ERROR_DIVZERO
  DB Error: division by zero
Trying to provoke DB_ERROR_INVALID_NUMBER
  DB Error: invalid number
Trying to provoke DB_ERROR_NOSUCHFIELD
  DB Error: no such field
Trying to provoke DB_ERROR_SYNTAX
  DB Error: syntax error
