<?php

/**
  * Configuration for database connection
  *
  */

$host       = "localhost";
$username   = "new.globtrex.com";
$password   = "y69U8drr5wDqsMzZ";
$dbname     = "new.globtrex.com"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );