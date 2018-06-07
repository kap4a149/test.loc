<?php
include_once 'simple_html_dom.php';
include 'db.php';

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
    $image_id = "images/image$i";
    //check file type
    //JPG
    if(stristr($element->src, '.jpg') == TRUE){
      copy("$element->src", $image_id . '.jpg');
      $images[$i] = $image_id . '.jpg';
    }
    //PNG
    if(stristr($element->src, '.png') == TRUE){
      copy("$element->src", $image_id . '.png');
      $images[$i] = $image_id . '.png';
    }
    //JPEG
    if(stristr($element->src, '.jpeg') == TRUE){
      copy("$element->src", $image_id . '.jpeg');
      $images[$i] = $image_id . '.jpeg';
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
  // foreach($html->find('p > span') as $element){
  foreach($html->find('span.storycontent') as $element){
  // foreach($html->find('span.storycontent > p') as $element){
    $full_text[$id_full] = $element;
  }
}
return $full_text;
}

?>
