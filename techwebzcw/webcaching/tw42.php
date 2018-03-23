
<?php
//webcaching , szybciej , na dole pokaze sie ile milisekund zajelo pobranie danych z bazy
$start = microtime(true);
header('Access-Control-Allow-Origin *');
header('Content-Type: application/json; charset=utf-8');
$db = new PDO('sqlite:webcaching.db');
if(isset($_GET['kat']))
	$kat = intval($_GET['kat']);
else
	$kat = 0;
if(!file_exists('cache'.$kat) && time()-filemtime('cache'.$kat) > 60)
{
	if($kat>0)
	{
		$sql = "SELECT * FROM towary LEFT JOIN kategorie ON towary.idk = kategorie.idk WHERE towary.idk = $kat ORDER BY nazwa";
	}
	else
		$sql = "SELECT * FROM towary LEFT JOIN kategorie ON towary.idk = kategorie.idk ORDER BY nazwa";
	$res = $db->query($sql);
	$wyniki = array(array());
	while($row = $res->fetch(PDO::FETCH_ASSOC))
	{
		$wyniki[] = $row;
	}
	file_put_contents('cache'.$kat, json_encode($wyniki));
}
readfile('cache'.$kat);
$stop=round(1000*(microtime(true)-$start),1);
//print(json_encode(array('czas'=>$stop, 'wyniki'=>$wyniki))); //wyswitli czas

print($stop);
?>