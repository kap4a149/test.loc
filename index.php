<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once 'core1/simple_html_dom.php';

// include 'core/parser.php';
// include 'core/db.php';


// parseNewsFullText('https://dailyillini.com/showcase/2018/06/04/urbanas-muslim-american-society-calls-for-community-education-at-9th-annual-ramadan-dinner/');

$db = new PDO('mysql:host=localhost;dbname=news;charset=utf8', 'service', '12345');

$html = file_get_html('https://dailyillini.com/news/');


//Парсинг и запись ссылок в базу данных
foreach($html->find('.searchheadline > a') as $element){
  $stmt = $db->prepare('INSERT INTO aqq VALUES(:link)');
  $stmt->bindParam(':link', $element);
  $stmt->execute();
  }

// Парсинг и запись картинок в базу данных
  foreach($html->find('.categoryimage') as $element){
  $i++;
  $image_id = "images/image$i.png";
  //check file type
  if(stristr($element->src, '.jpg') == TRUE){
    copy("$element->src", $image_id);
    $stmt = $db->prepare('INSERT INTO aqq VALUES(:image)');
    $stmt->bindParam(':image', $image_id);
    $stmt->execute();
  }

  if(stristr($element->src, '.png') == TRUE){
    copy("$element->src", $image_id);
    $stmt = $db->prepare('INSERT INTO aqq VALUES(:image)');
    $stmt->bindParam(':image', $image_id);
    $stmt->execute();
  }
  }


  // Парсинг и запись даты в базу данных
  foreach($html->find('p.categorydate > span.time-wrapper') as $element){
    $stmt = $db->prepare('INSERT INTO aqq VALUES(:link)');
      $stmt->bindParam(':link', $element);
      $stmt->execute();
  }

?>
