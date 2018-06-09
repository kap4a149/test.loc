<?php
$db = new PDO('mysql:host=localhost;dbname=news;charset=utf8', 'root', '');


function insertParseDataIntoSql(){
    global $db;
    global $title;
    global $news_name;
    global $images;
    global $date;
    global $full_text;
    for($count = 0; $count<count($title); $count++){
      $stmt = $db->prepare("INSERT INTO parsednews (news, date, img, text) VALUES (:news, :date, :img, :text)");

    // $stmt = $db->prepare("INSERT INTO parsednews (news, date, img, text) VALUES (:news, :date, :img, :text)");
    $stmt->bindParam(':news', $news_name[$count]);
    $stmt->bindParam(':date', $date[$count]);
    $stmt->bindParam(':text', $full_text[$count]);
    $stmt->bindParam(':img', $images[$count]);
    $stmt->execute();
    }
  }


function getParsedLastThreeNews(){
  global $db;
  $stmt = $db->prepare("SELECT news, date, img, text FROM parsednews LIMIT 3");
  $stmt->execute();
  $result = $stmt->fetchAll();
    echo "<div class=\"newsName\">" . $result[0][0] . '</div>' . '<br />' . "<div class = \"newsDate\">" . $result[0][1] . '</div>' . '<br />' . "<img class=\"newsImage\" src=" . $result[0][2] . "><div class = \"content\">". $result[0][3] . '</div><br />';
    echo "<div class=\"newsName\">" . $result[1][0] . '</div>' . '<br />' . "<div class = \"newsDate\">" . $result[1][1] . '</div>' . '<br />' . "<img class=\"newsImage\" src=" . $result[1][2] . "><div class = \"content\">". $result[1][3] . '</div><br />';
    echo "<div class=\"newsName\">" . $result[2][0] . '</div>' . '<br />' . "<div class = \"newsDate\">" . $result[2][1] . '</div>' . '<br />' . "<img class=\"newsImage\" src=" . $result[2][2] . "><div class = \"content\">". $result[2][3] . '</div><br />';
}


 ?>
