--TEST--
DB_pgsql::error mapping
--SKIPIF--
<?php require "skipif.inc"; ?>
--FILE--
<?php
require "mktable.inc";
// The DB_ERROR_CONSTRAINT test will fail on PostgreSQL < 7.x
require "../errors.inc";
?>
--EXPECT--
Trying to provoke DB_ERROR_NOSUCHTABLE
  DB Error: no such table
Trying to provoke DB_ERROR_ALREADY_EXISTS
  DB Error: already exists
Trying to provoke DB_ERROR_NOSUCHTABLE
  DB Error: no such table
Trying to provoke DB_ERROR_CONSTRAINT
  DB Error: constraint violation
Trying to provoke DB_ERROR_DIVZERO
  DB Error: division by zero
Trying to provoke DB_ERROR_INVALID_NUMBER
  DB Error: invalid number
Trying to provoke DB_ERROR_NOSUCHFIELD
  DB Error: no such field
Trying to provoke DB_ERROR_SYNTAX
  DB Error: syntax error
