<?php
session_start();
require "local-config.php";

if (isset($_SESSION['valid']))
{

	if (isset($_POST['pnr']))
	{
		$pnr = $_POST['pnr'];
		$info = file_get_contents($msyshost . "/api.php?key=".$msyskey."&usr=".$msysuser."&cmd=isMember&pnr=" .$pnr);

		$split = explode(",", $info);
		$payed = $split[1];

		if ($payed == '1')
		{
			$title = "Medlem!";
			$style = "misc/sucess.css";
			$phrase = $pnr . "<br>Personen är medlem";
			$image = "misc/green.png";
		}
		else
		{
			$title = "Icke medlem";
			$style = "misc/failure.css";
			$phrase = $pnr . "<br>Personen är inte medlem";
			$image = "misc/red.png";
		}

	}

	echo "
		<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		<title>$title</title>
		<link rel=\"stylesheet\" href=\"$basestyle\" type=\"text/css\" media=\"screen\"/>
		";
		if(isset($style))
		{
			echo "<link rel=\"stylesheet\" href=\"$style\" type=\"text/css\" media=\"screen\"/>";
		}
		echo "
		</head>
		<div id=\"content\">
		<img src=\"$image\">
		<h1>$phrase</h1>
		<form name=\"pnr\" method=\"post\" action=\"ismember.php\">
                Personnummer: <input name=\"pnr\" type=\"number\" id=\"pnr\">
                <button type=\"submit\" name=\"submit\" value=\"Kontrollera\">Kontrollera</button>
		<p></p>
		<a href=\"logout.php\" class=\"logout\">Logga ut</a>
		</div>
		";

}
else
{
	echo "
		<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		<title>$title</title>
		<link rel=\"stylesheet\" href=\"$basestyle\" type=\"text/css\" media=\"screen\"/>
		</head>
		<div id=\"content\">
		<img src=\"$image\">
		<h1>$phrase</h1>
		<form name=\"form1\" method=\"post\" action=\"checklogin.php\">
		<label>Användare: </label><input name=\"myusername\" type=\"text\" id=\"myusername\" tabindex=\"1\"><br>
		<label>Lösenord: </label><input name=\"mypassword\" type=\"password\" id=\"mypassword\"><br>
		<button type=\"submit\" name=\"Submit\" value=\"Logga in\">Logga in</button>
	";
        if(isset($_GET['f']) and $_GET['f']==1)
        {
                echo "<h2>Inloggningen misslyckades.</h2>";
        }
	echo "</div>";

}
?>
