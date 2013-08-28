<?php
session_start();
ob_start();
require "local-config.php";

mysql_connect("$host", "$username", "$password") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");

$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql = "SELECT * FROM $tbl_name WHERE username='$myusername' and password=sha1('$mypassword')";
$result = mysql_query($sql);

if (mysql_num_rows($result)) {
	$_SESSION['valid'] = 1;
	header("location:ismember.php");
}
else {
	header("location:ismember.php?f=1"); //f=1 används för att meddela användaren om att inloggningen misslyckades
}
ob_end_flush();
?>
