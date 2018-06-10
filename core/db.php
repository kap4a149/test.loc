<?php
$db = new PDO('mysql:host=localhost;dbname=news;charset=utf8', 'root', '');


function insertParseDataIntoSql(){
    global $db;
    global $news_name;
    global $images;
    global $date;
    global $full_text;
    for($count = 0; $count<count($news_name); $count++){
    $stmt = $db->prepare("INSERT INTO parsednews (news, date, img, text) VALUES (:news, :date, :img, :text)");
    $stmt->bindParam(':news', $news_name[$count]);
    $stmt->bindParam(':date', $date[$count]);
    $stmt->bindParam(':text', $full_text[$count]);
    $stmt->bindParam(':img', $images[$count]);
    $stmt->execute();
    }
  }


function getParsedLastThreeNews(){
  global $db;
  $stmt = $db->prepare("SELECT news, date, img, text FROM parsednews ORDER BY date DESC LIMIT 3");
  $stmt->execute();
  $result = $stmt->fetchAll();
  for($i=0; $i < 3; $i++){
  echo "<div class=\"newsName\">" . $result[$i][0] . '</div>' . '<br />' . "<div class = \"newsDate\">" . $result[$i][1] . '</div>' . '<br />' . "<img class=\"newsImage\" src=" . $result[$i][2] . "><div class = \"content\">". $result[$i][3] . '</div><br />';
}
}

 ?>
