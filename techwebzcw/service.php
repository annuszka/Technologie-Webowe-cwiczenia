<?php
/*
 * Prosty WebService typu REST
 * Używaj service.php?imie=Ja albo service.php?nazw=Ko
 */
header('Access-Control-Allow-Origin *');
header('Content-Type: application/json; charset=utf-8');
$db = new PDO('sqlite:baza.db');
$wynik = array();
if(isset($_GET['imie']))
{
  $imie = $_GET['imie'];
  $sql = "SELECT pozycja, imie FROM imiona WHERE imie LIKE :imie";
  $res = $db -> prepare($sql);
  $res -> bindValue(':imie', $imie.'%');
  $res -> execute();
  $wynik = $res -> fetchAll(PDO::FETCH_ASSOC);
}
if(isset($_GET['nazw']))
{
  $nazw = $_GET['nazw'];
  $sql = "SELECT pozycja, DISTINCT(nazwisko) FROM nazwiska WHERE nazwisko LIKE :nazw ORDER BY nazwisko";
  $res = $db -> prepare($sql);
  $res -> bindValue(':nazw', $nazw.'%');
  $res -> execute();
  $wynik = $res -> fetchAll(PDO::FETCH_ASSOC);
}
for($i=0;$i<count($wynik);$i++)
  $wynik[$i]['pozycja'] *= 1; /*mnozymy razy jeden bo z sql zawsze tekst wyjdzie a chcemy zeby pozycja byla jako liczba np do sortwania, wymuszamy to, mozna plus 0 np*/
print json_encode($wynik);
?>