<!DOCTYPE HTML>
<html>

<?php
	session_start();
?>

<head> <meta charset="utf8"/>
	<title>"Τεχνική Υποστήριξη Δήμου Ναυπάκτου"</title>
	<link href="login.css" rel="stylesheet">
</head>
<!-- Connect to database-->
<?php
	$db_host="localhost";
	$db_username="root";
	$db_password="";
	$db_name="DB1";
	$con=mysql_connect("$db_host","$db_username","$db_password") or die("Couldn't connect to MySQL");
	mysql_select_db("$db_name") or die("No database");
	mysql_set_charset("utf8",$con);
?>
<!--Έλεγχοι για τα στοιχεία που δόθηκαν στο login -->
<?php
	if (isset($_POST['log'])){
			$user= $_POST['uname'];
			//echo $user;
			$qry="SELECT * FROM person WHERE username='$user'";			
			$result=mysql_query($qry,$con);
			if (mysql_num_rows($result)==0) {
				echo '<a href="web.php">Επιστροφή στην αρχική σελίδα!</a><br>';
				exit("Δόθηκε λάθος τιμή για username");
			}
			$row=mysql_fetch_array($result,MYSQL_ASSOC);
			$_SESSION['username']=$row['username'];	
			$_SESSION['id']=$row['p_id'];
			$pwrd=$row['password'];
			$id=$row['p_id'];
			$_SESSION['knd']=$row['authorization'];
			if ($pwrd != $_POST['pword']) {
				echo '<a href="web.php">Επιστροφή στην αρχική σελίδα!</a><br>';
				exit ("Δόθηκε λάθος τιμή για password!");
			}
		}
?>
<body>
  <div class="bar">
		<a href="logged_in.php"> Home</a><br>
		<a href="logout.php">Logout</a>
</div>
		
		<h1>Τεχνική Υποστήριξη Δήμου Ναυπάκτου</h1>
		<br>
<!-- Έλεγχος για τη μορφή που θα παρουσιαστεί-->
<?php 
	$knd=$_SESSION['knd'];
	//USER
	if($knd=='a'){
		$id=$_SESSION['id'];	
		$qr1= "SELECT * FROM person WHERE p_id= $id";
		$qr2= "SELECT * FROM user WHERE u_id= $id";
		$result1=mysql_query($qr1,$con);
		$result2=mysql_query($qr2,$con);
		$row1=mysql_fetch_array($result1,MYSQL_ASSOC);
		$row2=mysql_fetch_array($result2,MYSQL_ASSOC);
		echo '<div class="anaf"><a href="form2.php"> Δημιουργία αναφοράς προβλήματος</a></div>';
		//Editable στοιχεία user
		echo '<div class="imag"><img src="user.jpg"></div>';
		echo '<div class ="pers_inf">';
		echo '<h4>Προσωπικά στοιχεία χρήστη</h4>';
		echo '<b>Όνομα: </b><section id="name:'.$id.'" contenteditable="true">'.$row1['name'].'</section>';
		echo '<b>Επώνυμο:</b><section id="surname:'.$id.'" contenteditable="true">'.$row1['surname'].'</section>';
		echo '<b>E-mail:</b><section id="email:'.$id.'" contenteditable="true">'.$row1['email'].'</section>';
		echo '<b>Αριθμός τηλεφώνου</b>: <section id="phone_number:'.$id.'" contenteditable="true">' .$row1['phone_number'].'</section>';
		echo '<b>Ημερομηνία γέννησης:</b> <section id="birthdate:'.$id.'" contenteditable="true">' .$row1['birthdate'].'</section>';
		echo '<b>Φύλο:</b> &nbsp; ';
		($row1['gender']=='m') ? print("Αρσενικό") : print ("Θηλυκό"); //den dexotan echo se afti ti morfi if
		echo '<br>';
		echo '<b>Ημερομηνία εγγραφής:</b> &nbsp;' .$row2['sign_up_date'].'<br>';
    	echo '</div>';
    	echo '<br><br>';
    	echo '<script src="http://code.jquery.com/jquery-1.11.1.min.js"> </script>';
		echo '<script src="edit_profile.js"> </script>';
    	echo '<div class="rep_info">';
    	echo '<br><br>';
    	$qr4= "SELECT * FROM report WHERE us_id=$id ORDER BY reg_date DESC";
    	$result4=mysql_query($qr4,$con);
    	echo '<table border="1" width="60%"	align="center">';
		echo '<caption>Στοιχεία Αναφορών</caption>';
		echo '<tr>';
		echo '<th> Αρ/Αν </th> <th>Ημερ. Καταχώρησης</th> <th>Κατάσταση Αναφοράς</th><th>Ημερ.Επίλυσης</th><th>Σχόλια</th>';
		echo '</tr>';
    	while (($row4=mysql_fetch_array($result4,MYSQL_ASSOC))) {
    		echo '<tr>';
    		echo '<td>'. $row4['r_id'] . '</td>'; 
    		echo '<td>'.$row4['reg_date'] .'</td>';
			echo '<td>';
			($row4['state']== 'u') ? print("Μη επιλυμένη") : print("Επιλυμένη");
			echo '</td>'; 
	 		echo '<td>'.$row4['solv_date'].'</td>';
	 		echo '<td>'.$row4['a_comments'].'</td>';
	 		echo '</tr>';
     	}
     	echo '</table>';
     	echo '</div>'; 
 	}
	else{
		//ADMINISTRATOR
		$id=$_SESSION['id'];
		$qr5="SELECT * FROM person WHERE p_id= $id";
		$qr6="SELECT * FROM administrator WHERE a_id= $id";
		$result5=mysql_query($qr5,$con);
		$result6=mysql_query($qr6,$con);
		$row5=mysql_fetch_array($result5,MYSQL_ASSOC);
		$row6=mysql_fetch_array($result6,MYSQL_ASSOC);
    	echo '<img src="administrator.jpg">';
    	echo '<div class ="pers_inf">';
		echo '<h4>Προσωπικά στοιχεία διαχειριστή</h4>';
		echo '<b>Όνομα:</b> &nbsp; ' . $row5['name'] . '<br>';
		echo '<b>Επώνυμο:</b> &nbsp; ' .$row5['surname'].'<br>';
		echo '<b>E-mail:</b> &nbsp; ' .$row5['email'].'<br>';
		echo '<b>Αριθμός τηλεφώνου:</b> &nbsp; ' .$row5['phone_number'].'<br>';
		echo '<b>Ημερομηνία γέννησης:</b> &nbsp; ' .$row5['birthdate'].'<br>';
		echo '<b>Φύλο:</b> &nbsp; ';
		($row5['gender']=='m') ? print("Αρσενικό") : print ("Θηλυκό");
		echo '<br>';
		echo '<b>Βιογραφικό:</b> &nbsp; '.$row6['bio'].'<br>';
		echo '</div>';
		echo '<br><br>';
		echo '<div class="options">';
		echo '<ul>';
		echo '<li><a href="users.php">Τροποποίηση ή Διαγραφή εγγεγραμμένων χρηστών</a></li>';
		echo '<li><a href="rep.php">Επίλυση αναφοράς</a></li>';
		echo '<li><a href="categ.php">Πρόσθεση ή διαγραφή κατηγορίας</a></li>';
		echo '</ul>';
		echo '</div>';
		echo '<table border="2" width="80%" align="center">';
		echo '<caption align="center">Αναφορές που έχουν επιλυθεί</caption>';
		echo '<tr><th>Αρ/Αν</th><th>Περιγραφή προβλήματος</th><th>Γεωγραφική Θέση</th><th>Σχόλια Διαχειριστή</th><th>Ημερ/Καταχ</th><th>Ημερ/Επίλυσης</th><th>Αρ/Κατηγ</th><th>Κωδ/Διαχ</th></tr>';
		$adqry="SELECT * FROM report WHERE state='s' ";
		$adrel=mysql_query($adqry,$con);
		while($adrow=mysql_fetch_array($adrel,MYSQL_ASSOC)){
			echo '<tr>';
			echo '<td>'.$adrow['r_id'].'</td>';
			echo '<td>'.$adrow['r_description'].'</td>';
			echo '<td>'.$adrow['gps'].'</td>';
			echo '<td>'.$adrow['a_comments'].'</td>';
			echo '<td>'.$adrow['reg_date'].'</td>';
			echo '<td>'.$adrow['solv_date'].'</td>';
			echo '<td>'.$adrow['categ_id'].'</td>';
			echo '<td>'.$adrow['ad_id'].'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}	
	?>
	
		
</body>
</html>
