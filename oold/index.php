<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'core/parser.php';
include 'core/db.php';

parseLinks();

parseImage();

parseDate();

parseNewsFullText('https://dailyillini.com/showcase/2018/06/04/urbanas-muslim-american-society-calls-for-community-education-at-9th-annual-ramadan-dinner/');

$db = new PDO('mysql:host=localhost;dbname=news;charset=utf8', 'service', '12345');

$stmt = $db->prepare('INSERT INTO aqq VALUES(:link)');
$stmt->bindParam(':link', parseLinks());
$stmt->execute();


// dbConnect();
//
// exequteQuery('Select * from parsednews');

?>
