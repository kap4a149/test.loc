<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);


include_once 'core/parser.php';

include_once 'pages/news.php';


// // when all data has been parsed, write this in database
insertParseDataIntoSql();
//
// show parsed data from database
getParsedLastThreeNews();



?>
