<?php
include_once 'core/simple_html_dom.php';

$html = file_get_html('https://dailyillini.com/news/');

// parse linkss
foreach($html->find('.searchheadline > a') as $element){
     echo $element;
   }

// parse picture
foreach($html->find('.categoryimage') as $element){
$i++;
//check file type
if(stristr($element->src, '.jpg') == TRUE){
  copy("$element->src", "images/image$i.jpg");
}

if(stristr($element->src, '.png') == TRUE){
  copy("$element->src", "images/image$i.png");
}
}

  // parse date
  foreach($html->find('.time-wrapper') as $element){
    echo $element . '<br />';
    echo '<hr>';
  }
}

function parseNewsFullText($newsLink){
  $html = file_get_html($newsLink);
  foreach($html->find('span.storycontent > p') as $element){
    echo $element . '<br />';
  }
}


?>
