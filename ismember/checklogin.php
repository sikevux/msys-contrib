<?php
session_start();
ob_start();
require "local-config.php";

($GLOBALS["___mysqli_ston"] = mysqli_connect("$host",  "$username",  "$password")) or die("cannot connect");
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE $db_name")) or die("cannot select DB");

$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $myusername) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
$mypassword = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $mypassword) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
$sql = "SELECT * FROM $tbl_name WHERE username='$myusername' and password=sha1('$mypassword')";
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

if (mysqli_num_rows($result)) {
	$_SESSION['valid'] = 1;
	header("location:ismember.php");
}
else {
	header("location:ismember.php?f=1"); //f=1 används för att meddela användaren om att inloggningen misslyckades
}
ob_end_flush();
?>
