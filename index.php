<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


include_once 'core/parser.php';


parsePostLinks();

parsePostImages();

parsePostDate();

parseFullText();

// when all data has been parsed, write this in database
insertValuesIntoSql();



?>
