<?php 
//Connect to database
$db_host="localhost";
$db_username="root";
$db_password="";
$db_name="DB1";
$con=mysql_connect("$db_host","$db_username","$db_password") or die("Couldn't connect to MySQL");
mysql_select_db("$db_name") or die("No database");

header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
//XML
echo '<markers>';
$query1="SELECT * FROM report ORDER BY reg_date DESC LIMIT 0,20";
$result=mysql_query($query1,$con);
while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
$gps=explode(',',$row['gps'],2);
echo '<marker lat="'.$gps[0].'" lng="'.$gps[1].'">';
echo '</marker>';	
}
echo '</markers>';
?>