<?php
include_once 'simple_html_dom.php';
include 'db.php';

//parsed page
$html = file_get_html('https://dailyillini.com/news/');

$title = parsePostLinks();
$news_name = parseNewsName();
$images = parsePostImages();
$date = parsePostDate();
$full_text = parseFullText();


function parsePostLinks(){
  global $html;
  foreach($html->find('.searchheadline > a') as $element){
    $title[] = file_get_html($element->href);
    }
    return $title;
}


function parseNewsName(){
  global $html;
  foreach($html->find('h2 > a') as $element){
    $news_name[] = $element->plaintext;
    }
    return $news_name;
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
      $images[] = $image_id . '.jpg';
    }
    //PNG
    if(stristr($element->src, '.png') == TRUE){
      copy("$element->src", $image_id . '.png');
      $images[] = $image_id . '.png';
    }
    //JPEG
    if(stristr($element->src, '.jpeg') == TRUE){
      copy("$element->src", $image_id . '.jpeg');
      $images[] = $image_id . '.jpeg';
    }
    }
    return $images;
}


function parsePostDate(){
  global $html;
  foreach($html->find('p.categorydate > span.time-wrapper') as $element){
      $formatedDate = str_replace(',', '', $element->plaintext);
      $newdate = date('Y-m-d', strtotime($element->plaintext));
      $date[] = $newdate;
    }
    return $date;
}

function parseFullText(){
  global $title;
  for($i = 0; $i < count($title); $i++){
  foreach($title[$i]->find('p > span') as $element){
    $full_text[] = $element->plaintext;
  }
}
return $full_text;
}

// echo count($news_name) . '<br />';
// echo count($date) . '<br />';
// echo count($images) . '<br />';
// echo count($news_name) . '<br />';

?>
