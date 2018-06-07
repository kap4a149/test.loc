<?php
include_once 'simple_html_dom.php';

//parsed page
$html = file_get_html('https://dailyillini.com/news/');

$title = parsePostLinks();
$images = parsePostImages();
$date = parsePostDate();
$full_text = parseFullText();


function parsePostLinks(){
  global $html;
  foreach($html->find('.searchheadline > a') as $element){
    $link_id++;
    $title[$link_id] = $element;
    }
    return $title;
}


function parsePostImages(){
  global $html;
  foreach($html->find('.categoryimage') as $element){
    $i++;
    $image_id = "images/image$i.png";
    //check file type
    if(stristr($element->src, '.jpg') == TRUE){
      copy("$element->src", $image_id);
      $images[$i] = $image_id;
    }
    else{
      copy("$element->src", $image_id);
      $images[$i] = $image_id;
    }
    }
    return $images;
}


function parsePostDate(){
  global $html;
  foreach($html->find('p.categorydate > span.time-wrapper') as $element){
      $date_id++;
      $date[$date_id] = $element->innertext;
    }
    return $date;
}


function parseFullText(){
  global $title;
  for($id_full = 1; $id_full<= count($title); $id_full++){
  $html = file_get_html($title[$id_full]->href);
  foreach($html->find('span.storycontent > p') as $element){
    $full_text[$id_full] = $element;
  }
}
return $full_text;
}

echo '1' . count($title) . '<br>';
echo '2' .count($images) . '<br>';
echo '3' . count($date) . '<br>';
echo '4' .count($full_text) . '<br>';


function insertValuesIntoSql(){
    global $title;
    global $images;
    global $date;
    global $full_text;
    $db = new PDO('mysql:host=localhost;dbname=news;charset=utf8', 'root', '');
    for($i = 0; $i<count($title); $i++){
    $stmt = $db->prepare("INSERT INTO parsenews (title, date, image, text) VALUES (:title, :date, :image, :text)");
    $stmt->bindParam(':title', $title[$i]);
    $stmt->bindParam(':date', $date[$i]);
    $stmt->bindParam(':image', $images[$i]);
    $stmt->bindParam(':text', $full_text[$i]);
    $stmt->execute();
    }
  }

?>
