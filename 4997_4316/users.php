<!DOCTYPE HTML>
<html>

<?php
session_start();
$ad_id=$_SESSION['id'];
//echo $_SESSION['username'];
//echo '<br>'.$ad_id;
?>

<head><meta charset="utf8"/>
<title> "Τεχνική Υποστήριξη Δήμου Ναυπάκτου!"</title> 
<link href="users.css" rel="stylesheet">
</head>

<body>
<div class="links">
	<a href=" logged_in.php">Home</a><br>
	<?php
		echo '<a href="login.php">'.$_SESSION['username'].'</a><br>';
	?>
	<a href="logout.php">Logout</a>	
</div>
<h1>Τεχνική Υποστήριξη Δήμου Ναυπάκτου</h1><br><br>

<?php
	//Connection to database
	$db_host="localhost";
	$db_username="root";
	$db_password="";
	$db_name="DB1";
	$con=mysql_connect("$db_host","$db_username","$db_password") or die("Couldn't connect to MySQL");
	mysql_select_db("$db_name") or die("No database");
	mysql_set_charset("utf8",$con);
	
	$qr1="SELECT * FROM person WHERE authorization='a' ";
	$res1=mysql_query($qr1,$con);
?>

<div class="editing">
	<h4>Τροποποίηση στοιχείων ενός χρήστη</h4>
	<?php
		echo '<form method="post" action="users.php">';
		echo "Επέλεξε το username του χρήστη του οποίου τα στοιχεία θέλεις να αλλάξεις:"; 
		echo '<select name="usersunm">'; 
		while($row1=mysql_fetch_array($res1,MYSQL_ASSOC)){
			echo '<option value="'.$row1['username'].'">'.$row1['username'].'</option>';
		}
		echo '</select><br>';
		echo 'Νέο password:<input name="nwpsd" type="text" size="20" ><br>';
		echo 'Αλλαγή authorization <input name="auth" type="checkbox"><br>';
		echo '<input type="submit" name="submit1" value="Αλλαγή"><br>';
		echo '</form>'
?>
</div>
<br><br><br><br>

<div class="deleting">
<h4>Διαγραφή ενός χρήστη</h4>

<?php
	$qr1="SELECT * FROM person WHERE authorization='a' ";
	$res1=mysql_query($qr1,$con);
	echo '<form method="post" action="users.php">';
	echo "Επέλεξε το username που θέλεις να διαγράψεις:";
	echo  '<select name="usersunm1">'; 
	while($row1=mysql_fetch_array($res1,MYSQL_ASSOC)){
		echo '<option value="'.$row1['username'].'">'.$row1['username'].'</option>';
	}
	echo '</select><br>';
	echo '<input type="submit" name="submit2" value="Διαγραφή"><br>';
	echo '</form>';
	echo '</div>';

	//Αλλαγή
	if (isset ($_POST['submit1'])){
	$usr=$_POST['usersunm'];
	if ((isset ($_POST['submit1'])) && ($_POST['nwpsd']!=NULL)) {
		$nwps=$_POST['nwpsd'];
		$qr2="UPDATE person SET password='$nwps' WHERE username='$usr'";
		mysql_query($qr2,$con);
	}
	if (isset($_POST['submit1']) && isset($_POST['auth'])){
		$ath='b';	
		$qr2="UPDATE person SET authorization='$ath' WHERE username='$usr'";
		mysql_query($qr2,$con);
	}
	}

	//Διαγραφή
	if(isset ($_POST['submit2'])){
		$usrn=$_POST['usersunm1'];
		//echo $usrn;
		$qr3="DELETE FROM person WHERE username='$usrn'";
		mysql_query($qr3,$con);
	}
?>
</body>
</html>