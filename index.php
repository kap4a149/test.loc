<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once 'core1/simple_html_dom.php';

$html = file_get_html('https://dailyillini.com/news/');

$title = array();
$images = array();
$date = array();



//parse links and add it to array
foreach($html->find('.searchheadline > a') as $element){
  $link_id++;
  $title[$link_id] = $element;
  }

//parse images an add it to array
  foreach($html->find('.categoryimage') as $element){
  $i++;
  $image_id = "images/image$i.png";
  //check file type
  if(stristr($element->src, '.jpg') == TRUE){
    copy("$element->src", $image_id);
    $images[$i] = $image_id;
  }

  if(stristr($element->src, '.png') == TRUE){
    copy("$element->src", $image_id);
    $images[$i] = $image_id;
  }
  }


  // parse date and add it to array
  foreach($html->find('p.categorydate > span.time-wrapper') as $element){
    $date_id++;
    $date[$date_id] = $element;
  }

  function insertValuesIntoSql(){
    global $title;
    global $images;
    global $date;
    $db = new PDO('mysql:host=localhost;dbname=news;charset=utf8', 'root', '');
    for($i = 1; $i<count($title); $i++){
    $stmt = $db->prepare("INSERT INTO parsenews (title, date, image) VALUES (:title, :date, :image)");
    $stmt->bindParam(':title', $title[$i]);
    $stmt->bindParam(':date', $date[$i]);
    $stmt->bindParam(':image', $images[$i]);
    $stmt->execute();
    }
  }

  insertValuesIntoSql();

?>
