<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"  crossorigin="anonymous"></script>
	<title>uwierzytelnienie</title><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<script src="sha256.js"></script>
	<script src="tw50.js"></script>
</head>
<body>
	<div class="container">
		<h1>poprawne uwierzytelnienie</h1>
		<hr />
<?php
if(isset($_POST["pass"])) $pass = $_POST["pass"];
if(isset($_POST["login"])) $login = $_POST["login"];
if(!empty($login) && !empty($pass))
{
	//hash("sha256", "swsz") = "6c38..."
	$h = hash("sha256", $_SESSION["key"] . "6c38175c784eef2c8995c9c44f844768461ceb35ff31dfebf02de72627a847bf"); //zamienic cale to hash(sha , haslo) na "6c38175c784..... zhaszowane haslo"
	//print $h." "."<br />".$pass. " ".$_SESSION['key']."<br />";
	
	if($h == $pass && "jasio" ==$login)
		print '<div class="alert alert-success">hasło ok</div>';
	else
		print '<div class="alert alert-danger">błędne hasło</div>';
}
//przy kazdym uwierzytelnieniu potrzebny jest nowy, unikatowy klucz jednorazowy
$_SESSION['key'] = md5(uniqid("",true));
?>


		<form id="form1" method="post" action="">
			<div class="input-group">
				<label for="login">login:</label>
				<input type="text" name="login" class="form-control" />
			</div>
			<div class="input-group">
				<label for="pass">haslo:</label>
				<input type="password" id="pass" name="pass" class="form-control"/> <!--na czas testu zmiana na text zeby bylo widac jakie haslo-->

</div>
<input type="hidden" id="key" value="<?php print $_SESSION['key']; ?>" /> <br /><!-- docelowo ma byc type hidden, value to bedzie ten md5 -->
<input type="submit" class="btn btn-primary" value="sprawdz" />
</form>

	</div>
</body>
</html>
<?php 

?>