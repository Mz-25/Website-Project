<?php
	//Connect to database
	$db_host="localhost";
	$db_username="root";
	$db_password="";
	$db_name="DB1";
	$con=mysql_connect("$db_host","$db_username","$db_password") or die("Couldn't connect to MySQL");
	mysql_select_db("$db_name") or die("No database");
	mysql_set_charset("utf8",$con);

if(!empty($_POST))
{
	foreach($_POST as $field_name => $val) { 
		//clean post values 
		$field_userid = strip_tags(trim($field_name)); 
		$val = strip_tags(trim(mysql_real_escape_string($val)));
		//from the fieldname:user_id we need to get user_id 
		$split_data=explode(':',$field_userid);
		$user_id = $split_data[1]; 
		$field_name = $split_data[0]; 
		if(!empty($user_id) && !empty($field_name) && !empty($val)) { 
			//update the values
			mysql_query("UPDATE person SET $field_name='$val' WHERE p_id= $user_id") or mysql_error(); 
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





