<!DOCTYPE HTML>

<?php
session_start();
//echo $_SESSION['username'];
$a_id=$_SESSION['id'];
//echo $a_id;
?>

<html>
<head><meta charset="utf8"/>
<title> "Τεχνική Υποστήριξη Δήμου Ναυπάκτου!"</title>
<link href="rep.css" rel="stylesheet">
</head>

<body>
<div class="links">
<a href="logged_in.php">Home</a><br>
<?php
	echo '<a href="login.php">'.$_SESSION['username'].'</a><br>';
?>
<a href="logout.php">Logout</a>
</div>	
<h1>Τεχνική Υποστήριξη Δήμου Ναυπάκτου</h1>
<!-- <section text-size="25px">Προκειμένου να λύσετε μια αναφορά πρέπει πρώτα να πατήσετε στο κελί 
	Σχόλια για τυχόν σχόλια που έχετε και έπειτα να πατήσετε στο κελί κατάστασης</section>-->

<?php
//Connection to database
$db_host="localhost";
$db_username="root";
$db_password="";
$db_name="DB1";
$con=mysql_connect("$db_host","$db_username","$db_password") or die("Couldn't connect to MySQL");
mysql_select_db("$db_name") or die("No database");
mysql_set_charset("utf8",$con);
?>

<p>Αναφορές που δεν έχουν επιλυθεί:</p>
<?php
	$qry1= " SELECT * FROM report WHERE state='u' ";
	$result1=mysql_query($qry1,$con);
	echo '<div class="reports">';
	echo '<table border="1" width="80%" align="left">';
	echo '<caption align="center"></caption>';
	echo '<tr>';
	echo '<th>Αρ/Αν</th>';
	echo '<th>Κωδ. Χρήστη</th>';
	echo '<th>Κωδ. Κατηγορίας</th>';
	echo '<th>Σχόλια</th>';
	echo '<th>Ημερ. Καταχ.</th>';
	echo '<th>Γεωγραφική Θέση</th>';
	echo '<th>Περιγραφή Προβλήματος</th>';
	echo '<th>Κατάσταση</th>';
	echo '<th>Φωτογραφίες</th>';
	echo '</tr>';
	while ($row1=mysql_fetch_array($result1,MYSQL_ASSOC)){
		echo '<tr>';
		echo '<td>'.$row1['r_id'].'</td>';
		echo '<td>'.$row1['us_id'].'</td>';
		echo '<td>'.$row1['categ_id'].'</td>';
		echo '<td id="a_comments:'.$row1['r_id'].':'.$a_id.'" contenteditable="true">'.$row1['a_comments'].'</td>';
		echo '<td>'.$row1['reg_date'].'</td>';
		echo '<td>'.$row1['gps'].'</td>';
		echo '<td>'.$row1['r_description'].'</td>';
		echo '<td id="state:'.$row1['r_id'].':'.$a_id.'" contenteditable="true">';
		($row1['state']== 'u') ? print("Μη επιλυμένη") : print("Επιλυμένη");
		echo '</td>';
		$rid=$row1['r_id'];
		$qr="SELECT * FROM images WHERE rep_id='$rid' ";
		$resu=mysql_query($qr,$con);
		$pht=" ";
		while($rows=mysql_fetch_array($resu,MYSQL_ASSOC)){
			$pht=$pht.'<br>'.$rows['photo'];
		}
		echo '<td>'.$pht.'</td>';
	}
	echo '</table>';
	echo '</div>';
?>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"> </script>
<script src="edit_reports.js"> </script>
</body>
</html>