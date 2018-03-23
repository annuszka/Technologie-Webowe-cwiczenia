<?php
header('Access-Control-Allow-Origin *');
header('Content-Type: application/json; charset=utf-8');
$db = new PDO('sqlite:webcaching.db');
//zalozenie nowej bazy dla sklepu
$sql = "CREATE TABLE IF NOT EXISTS kategorie(
idk INTEGER PRIMARY KEY,
kategoria TEXT UNIQUE)";
$db->exec($sql);
$sql = "CREATE TABLE IF NOT EXISTS towary(
idt INTEGER PRIMARY KEY, idk INTEGER, kod TEXT, cena FLOAT, nazwa TEXT)
";
$db->exec($sql);
//wypelnienia tabel
$db->beginTransaction();
for($i=1;$i<10;$i++)
{
	$sql = "INSERT OR IGNORE INTO kategoria(idk, kategoria) VALUES($i,'Kategoria nr $i')";

	$db->exec($sql);
}
$db->commit();
$db->beginTransaction(); // zeby szybciej bo by dlugo trwao jak 100000 linii
for($i=0;$i<10000; $i++)
{
	$nr = 1000000+$i;
	$kod = "590" . (1000000000+$nr);
	$cena = mt_rand(500,10000)/ 100.0; //cena w groszach wiec dzielimy przez 100
	$kat = mt_rand(1,10);
	$nazwa = 'Towar numer ' . $nr;
	$sql = "INSERT OR IGNORE INTO towary(idk,kod,cena,nazwa) VALUES($kat, '$kod',$cena, '$nazwa')";
	$db->exec($sql);
}
$db->commit();
?>