<!DOCTYPE HTML>
<html>
<head><meta charset="utf8"/>
	<title> Φόρμα Εγγραφής </title>
	<link href="form.css" rel="stylesheet">
</head>

<body>
	<p><a href="web.php">Home </a></p>
	<h1>Τεχνική υποστήριξη Δήμου Ναυπάκτου</h1>
	<br><br>
	<div class="forma">
		<h2> Συμπλήρωσε τη φόρμα εγγραφής </h2>
		<form method="post" action="form.php">
			'Ονομα: <input name="nm" type="text" size="20"> <br> <br>
 			Επώνυμο: <input name="sname" type="text" size="20"> <br> <br>
 			Τηλέφωνο: <input name="til" type="text" size="15"> <br> <br>
 			Email(*): <input name="mail" type="text" size="30"> <br> <br>
			Φύλο(*): <input name="gender0" type="radio" value="m"> Αρσενικό
			<input name="gender1" type="radio" value="f"> Θηλυκό<br> <br>
			Ημερομηνία Γέννησης(*): <input type ="date" name="bday" > (Π.χ 1990-01-31) <br> <br>
 			Username(*): <input name="uname" type="text" size="20"> <br> <br>
 			Password(*): <input name="pwor" type="password" size="20"> <br> <br>
 			Επαλήθευση Password: <input name="pwo" type="password" size="20"><br> <br>
			<p>
			(Τα στοιχεία με τον αστερίσκο (*) είναι υποχρεωτικό να συμπληρωθούν) </p>
 			<input type="submit" name="submit" value="Εγγραφή">
		</form>

		<!-- Connect to database-->
		<?php
				$db_host= "localhost";
				$db_username= "root";
				$db_password= "";
				$db_name= "db1";
		 		if(isset ($_POST['submit'])){
		 			$con = mysql_connect("$db_host","$db_username","$db_password"); 
		 			if (!$con) { 
		 				die("Couldn't connect to MySQL"); 
		 			}
					mysql_select_db("$db_name",$con) or die("No database");
					mysql_set_charset("utf8",$con);
 					
 					$gend= isset($_POST['gender0']) ? 'm' : 'f';
 					$frnm=$_POST['nm'];
 					$lsnm=$_POST['sname'];
 					$usnm=$_POST['uname'];
 					$pswd=$_POST['pwor'];
 					$pswd1=$_POST['pwo'];
 					$ml=$_POST['mail'];
 					$phnb=$_POST['til'];
 					$imer=$_POST['bday'];

 					//Έλεγχοι που γίνονται στα στοιχεία που δίνονται στη φόρμα
 					if((strlen($pswd)==0) || (strlen($usnm)==0)){
 						echo '<script> alert(";Έίτε το πεδίο username είτε το πεδίο password είτε και τα δύο είναι κενά")</script>';
 						exit(" ");
 						//exit("Δεν δόθηκαν τιμές για τα πεδία username ή password!");
 					}
 					if($pswd != $pswd1){
 						echo '<script>alert("Οι δύο τιμές για το password δεν ταυτίζονται")</script>';
 						exit(" "); 
 						//exit("Η τιμή που δόθηκε στην επαλήθευση του password δεν ταιριάζει με αυτή του πεδίου password!");
 					}
 					if ((strlen($pswd)>20) || (strlen($pswd)<4)){
 						echo '<script>alert("Το password σας πρέπει να είναι μεταξύ 4 και 20 χαρακτήρων")</script>';
 						exit(" ");
 						//exit ("Το password σας πρέπει να είναι μεταξύ 4 και 20 χαρακτήρων!");
 					}
 					if ((strlen($usnm)> 20) || (strlen($usnm)< 4)) {
 						echo '<script>alert("Το username σας πρέπει να είναι μεταξύ 4 και 20 χαρακτήρων")</script>';
 						exit(" ");
 						//exit("Το username σας πρέπει να είναι μεταξύ 4 και 20 χαρακτήρων! ");
 					}
 					if(strlen($ml)==0){
 						echo '<script>alert("Δεν συμπληρώσατε το υποχρεωτικό πεδίο e-mail")</script>';
 						exit(" ");
 						//exit("Δεν δόθηκε τιμή για το υποχρεωτικό πεδίο e-mail ");
 					}
 					if(filter_var($ml, FILTER_VALIDATE_EMAIL)) {
     					//echo "Nice!";	
    				}
    				else {
        				echo '<script>alert("Δεν δόθηκε έγκυρο e-mail")</script>';
 						exit(" ");
        				//exit("Λάθος τιμή για e-mail!");
    				}
 					if ((!isset($_POST['gender0'])) && (!isset($_POST['gender1']))){
 						echo '<script>alert("Δεν επιλέχθηκε τιμή για το υποχρεωτικό πεδίο φύλο!")</script>';
 						exit(" ");
 						//exit ("Δεν επιλέχθηκε τιμή για το φύλο!");
 					}
 					if ($imer == 0){
 						echo '<script>alert("Δεν συμπληρώθηκε η ημερομηνία γέννησης!")</script>';
 						exit(" ");
 						//exit("Δεν δόθηκε ημερομηνία γέννησης!");
 					}
 					$uq1= "INSERT INTO person (p_id,name,surname,username,password,email,phone_number,birthdate,authorization,gender) VALUES (NULL,'$frnm','$lsnm','$usnm','$pswd','$ml','$phnb','$imer','a','$gend')";
 					mysql_query($uq1,$con);
 					$uq2= "SELECT * FROM person where username='$usnm' ";
					$result= mysql_query($uq2,$con);
					$row=mysql_fetch_array($result,MYSQL_ASSOC);
					$u_id=$row['p_id'];
					date_default_timezone_set('Europe/Athens');
					$imer=date("Y-m-d H:i:sa");
 					$uq3= "INSERT INTO user (u_id,sign_up_date) VALUES ('$u_id','$imer')";
 					if (mysql_query($uq3,$con)){
 						echo '<script>alert("Έχετε εγγραφεί επιτυχώς")</script>';
 					}
 					
 					mysql_close($con);
 				}
 		?>
		<br>
	</div>

</body>

</html>