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
    $img_id = mt_rand();
    $image_id = "images/image$img_id.jpeg";
    //check file type
    if(preg_match('(jpg|png|jpeg)', $element->src)){
    copy("$element->src", $image_id);
    $images[] = $image_id;
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
  foreach($title[$i]->find('span.storycontent') as $element){
    $full_text[] = $element->plaintext;
  }
}
return $full_text;
}

?>
