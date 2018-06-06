<?php

$db = new PDO('mysql:host=localhost;dbname=news;charset=utf8', 'service', '12345');

$stmt = $db->prepare('INSERT INTO aqq VALUES(:link)');
?>
