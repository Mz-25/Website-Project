<?php
$db_host="localhost";
	$db_username="root";
	$db_password="";
	$db_name="DB1";
	$con=mysql_connect("$db_host","$db_username","$db_password") or die("Couldn't connect to MySQL");
	mysql_select_db("$db_name") or die("No database");
	mysql_set_charset("utf8",$con);

if(!empty($_POST))
{
foreach($_POST as $field_name => $val) 
{ 
//clean post values 
$field_userid = strip_tags(trim($field_name)); 
$val = strip_tags(trim(mysql_real_escape_string($val)));
//from the fieldname:user_id we need to get user_id 
$split_data=explode(':',$field_userid);
$ad_id=$split_data[2];
$rep_id = $split_data[1]; 
$field_name = $split_data[0]; 
if(!empty($rep_id) && !empty($field_name) && !empty($ad_id) && !empty($val)){ 
//update the values
	$quer="SELECT state FROM report WHERE r_id=$rep_id ";
	$res=mysql_query($quer,$con);
	$cell=mysql_fetch_array($res,MYSQL_ASSOC);
	if($field_name=="state"){
		if($cell['state']!='s'){
			mysql_query("UPDATE report SET $field_name='s' WHERE r_id= $rep_id") or mysql_error();
			mysql_query("UPDATE report SET ad_id='$ad_id' WHERE r_id= $rep_id") or mysql_error();
			date_default_timezone_set('Europe/Athens');
			$imer=date("Y-m-d H:i:sa");
			mysql_query("UPDATE report SET solv_date='$imer' WHERE r_id= $rep_id") or mysql_error();
			mysql_query("UPDATE report SET solved_time=TIMESTAMPDIFF(HOUR,reg_date,solv_date) WHERE r_id= $rep_id") or mysql_error();
		}
	}
	else{
		if($cell['state']!='s'){
		mysql_query("UPDATE report SET $field_name='$val' WHERE r_id=$rep_id") or mysql_error();
		}
	}
	echo "Updated"; 
} 
else { 
echo "Invalid Requests"; 
} 
} 
} 
else { 
echo "Invalid Requests"; 
}
?>