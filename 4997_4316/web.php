<!DOCTYPE HTML>
<html>
<head><meta charset="utf8"/>
<title> "Τεχνική Υποστήριξη Δήμου Ναυπάκτου!"</title>
<link href="web.css" rel="stylesheet">
</head>
<!-- Connection to database-->
<?php
$db_host="localhost";
$db_username="root";
$db_password="";
$db_name="DB1";
$con=mysql_connect("$db_host","$db_username","$db_password") or die("Couldn't connect to MySQL");
mysql_select_db("$db_name") or die("No database");
?>

<body>

<div class="bg-img">
<div class="bar">	
	<p>
		<a href="form.php"> Sign up </a>
	</p> 
	<form  name="login" method ="post" action="login.php">
		Username: <input name = "uname" type="text">   Password: <input name="pword" type="password"> 
		<input name="log" type="submit" value="Login">
	</form>	
			
</div>
</div>

<div class="arxi">
	<h1>Τεχνική Υποστήριξη Δήμου Ναυπάκτου</h1>
	<p>  Καλωσορίσατε στην επίσημη ιστοσελίδα τεχνικής υποστήριξης του Δήμου Ναυπάκτου. Εδώ μπορείτε να μας ενημερώσετε για τυχόν προβλήματα που 
		παρατηρήσατε στο Δήμο μας ώστε να επιληφθούμε επι του θέματος. Στόχος μας είναι η συντήρηση της πόλης μας, σας ευχαριστούμε.</p> <br><br>
</div>

<!-- Χάρτης-->
<div class="xartis" id="map_canvas">
</div>
<script type ="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript" src="xartis.js" charset="UTF-8"></script>

<div class="stat">
<h4>Στατιστικά στοιχεία αναφορών</h4>
<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
$('#statistics1').load('statistika1.php').fadeIn("slow");//fadeIn χρησιμοποιείται για να μπαίνουν ομαλά τα στατιστικά στοιχεία σε κάθε reload.Jquery μέθοδος. 
$('#statistics2').load('statistika2.php').fadeIn("slow");
$('#statistics3').load('statistika3.php').fadeIn("slow");
$('#statistics4').load('statistika4.php').fadeIn("slow");
}, 1000); // refresh every 1000 milliseconds
</script>
<section>Συνολικός αριθμός αναφορών στο σύστημα:<div id="statistics1"></div>
	   Συνολίκός αριθμός ανοιχτών αναφορών:<div id="statistics2"></div>
	   Συνολικός αριθμός επιλυμένων αναφορών:<div id="statistics3"></div>
	   Μέσος χρόνος επίλυσης αναφορών σε ώρες:<div id="statistics4"></div>	
</section>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"> </script>
<script src="stat.js"> </script>
</div>

<?php
	session_unset();
?>
</body>
</html>