<?php
//connect with database
$db_name = "db1";
$db_host= "localhost";
$db_username= "root";
$db_password= "";
$con=mysql_connect ("$db_host","$db_username", "$db_password") or die ("Couldn't connect to mysql");
mysql_select_db($db_name) or die ("No database");
$quer2= "SELECT COUNT(*) FROM report WHERE state='u'";
$res2=mysql_query($quer2,$con);
echo mysql_result($res2,0);
?>