<?php
$db = new PDO('mysql:host=localhost;dbname=news;charset=utf8', 'service', '12345');


function insertParseDataIntoSql(){
    global $db;
    global $title;
    global $images;
    global $date;
    global $full_text;
    for($i = 1; $i<count($title); $i++){
    $stmt = $db->prepare("INSERT INTO parsednews (title, date, img, text) VALUES (:title, :date, :img, :text)");
    $stmt->bindParam(':title', $title[$i]);
    $stmt->bindParam(':date', $date[$i]);
    $stmt->bindParam(':text', $full_text[$i]);
    $stmt->bindParam(':img', $images[$i]);
    $stmt->execute();
    }
  }


function getParsedLastThreeNews(){
  global $db;
  $stmt = $db->prepare("SELECT title, date, img, text FROM parsednews LIMIT 3");
  $stmt->execute();
  $result = $stmt->fetchAll();
    echo "<div class=\"newsName\">" . $result[0][0] . '</div>' . '<br />' . "<div class = \"newsDate\">" . $result[0][1] . '</div>' . '<br />' . "<img class=\"newsImage\" src=" . $result[0][2] . "><div class = \"content\">". $result[0][3] . '</div><br />';
    echo "<div class=\"newsName\">" . $result[1][0] . '</div>' . '<br />' . "<div class = \"newsDate\">" . $result[1][1] . '</div>' . '<br />' . "<img class=\"newsImage\" src=" . $result[1][2] . "><div class = \"content\">". $result[1][3] . '</div><br />';
    echo "<div class=\"newsName\">" . $result[2][0] . '</div>' . '<br />' . "<div class = \"newsDate\">" . $result[2][1] . '</div>' . '<br />' . "<img class=\"newsImage\" src=" . $result[2][2] . "><div class = \"content\">". $result[2][3] . '</div><br />';

}


 ?>
