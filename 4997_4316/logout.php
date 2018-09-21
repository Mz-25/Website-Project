<!DOCTYPE HTML>
<html>
<head><meta charset="utf8"/>
	<title>LogOut</title>
	<link href="logout.css" rel="stylesheet">
	<img src="frogbye.png">
<head>
<body>
<?php
session_unset();
$_SESSION['id']=0;
$_SESSION['username']=NUll;
?>
<main> BYE BYE </main>
</body>
</html>