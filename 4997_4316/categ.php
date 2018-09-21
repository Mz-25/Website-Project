<!DOCTYPE HTML>
<html>

<?php
  session_start();
  $ad_id=$_SESSION['id'];
//echo $_SESSION['username'];
//echo '<br>'.$ad_id;
?>

<head> <meta charset="utf8"/>
  <title>Επεξεργασία κατηγοριών αναφορών</title>
  <link href="categ.css" rel="stylesheet">
</head>

<body>
  <div class="lnks"><a href="logged_in.php">Home</a><br>
    <?php
    echo '<a href="login.php">'.$_SESSION['username'].'</a><br>';
    ?>
    <a href="logout.php">Logout</a>
</div> 

  <h1>Τεχνική Υποστήριξη Δήμου Ναυπάκτου</h1><br><br>

<!-- Connection to database-->
<?php 
$db_name = "db1";
$db_host= "localhost";
$db_username= "root";
$db_password= "";
$con=mysql_connect ("$db_host","$db_username", "$db_password") or die ("Couldn't connect to mysql");
mysql_select_db($db_name) or die ("No database");
mysql_set_charset("utf8",$con);
?>

<div class="c_add">
  <p> Δημιουργία νέας κατηγορίας</p>
  <form method="post" action="categ.php">
    Όνομα νέας κατηγορίας: <input name="cat_name" type="text" size="20"><br><br>
    Περιγραφή νέας κατηγορίας: <textarea name="cat_descr" rows="2" cols="45"> </textarea><br>
  <input type="submit" name="submit" value="Δημιουργία">
  </form>
<br><br>

<?php
if(isset ($_POST['submit'])){
  $ca_nm=$_POST['cat_name'];
  $ca_d=$_POST['cat_descr'];
  $qr="SELECT * FROM category WHERE c_name='$ca_nm'";
  $res=mysql_query($qr,$con);
  if(mysql_num_rows($res)!=0){
    echo '<script>alert("Η κατηγορία που προσπαθείτε να δημιουργήσετε υπάρχει ήδη")</script>';
    exit(" ");
    //exit("Αυτή η κατηγορία υπάρχει ήδη!");
  }
  $que2="INSERT INTO category(c_id,c_name,c_description) VALUES (NULL,'$ca_nm','$ca_d')";
  mysql_query($que2,$con);
}
?>

</div>
<?php
  $que1="SELECT c_name FROM category";
  $res1=mysql_query($que1,$con);
  echo '<div class="c_del">';
  echo '<p>Διαγραφή κατηγορίας</p>';
  echo '<form method="post" action="categ.php">';
  echo 'Κατηγορίες:<select name="cat">';
  while($row1=mysql_fetch_array($res1)){
   echo '<option value="'.$row1['c_name'].'">'.$row1['c_name'].'</option>';
   }
   echo '</select>';
   echo'<input type="submit" name="submit1" value="Διαγραφή">';
  echo'</form>';
  if (isset ($_POST['submit1'])){
  $cat_nm=$_POST['cat'];
  $que3="DELETE FROM category WHERE c_name='$cat_nm'";
  mysql_query($que3,$con);
  }
  echo '</div>';
  ?>
</body>
</html>
