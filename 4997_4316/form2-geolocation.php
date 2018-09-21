<!DOCTYPE HTML >

<?php
session_start();
$user_id=$_SESSION['id'];

//CONNECTION TO DATABASE
$db_host= "localhost";
$db_username= "root";
$db_password= "";
$db_name= "db1";
$con = mysql_connect("$db_host","$db_username","$db_password"); 
if (!$con) { 
   die("Couldn't connect to MySQL"); 
 }
 mysql_select_db("$db_name",$con) or die("No database");
 mysql_set_charset("utf8",$con);
?>


<html>
<head><meta charset="utf8"/>
	<title> Αναφορά προβλήματος</title>
	<link href="form2.css" rel="stylesheet">
</head>

<script type ="text/javascript" src="https://maps.googleapis.com/maps/api/js">
	</script>
	<script type="text/javascript">
	function initialize() {
		<!-- Πρώτα παίρνουμε το αντικείμενο που δημιουργήσαμε στο div xartis και μετά δημιουργούμε ένα νέο Google map object-->
		var map_canvas = document.getElementById('map_canvas');
		<!-- Συνάρτηση που λέει στο API από που παίρνει το χάρτη-->
		var mapOptions = {
		center: new google.maps.LatLng(38.393603,21.835773),
		zoom:14,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(map_canvas,mapOptions); 
	google.maps.event.addListener(map,'click',function(event) { 
		document.getElementById('latlongclicked').value = event.latLng.lat() + ', ' + event.latLng.lng()})
  }
google.maps.event.addDomListener(window,'load',initialize);
</script> 

<body>
	<p><a href="logged_in.php">Home</a><br>
    <?php
     echo '<a href="login.php">'.$_SESSION['username'].'</a><br>';
    ?>
		<a href="logout.php">Logout</a>
	</p>
	<h1> Τεχνική Υποστήριξη Δήμου Ναυπάκτου </h1>
	<br><br>

<script>
function geoFindMe() {
  var output = document.getElementById("out");

  if (!navigator.geolocation){
    output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
    return;
  }

  function success(position) {
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;
    document.setElementValue()
    //var str=latitude +","+ longtitude;
    //$('#gt').val()="latitude" +","+"longtitude";
    output.innerHTML = '<p>Latitude is ' + latitude + '° <br>Longitude is ' + longitude + '°</p>';
    var img = new Image();
    img.src = "http://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";

    output.appendChild(img);
    
  };

  function error() {
    output.innerHTML = "Unable to retrieve your location";
  };

  output.innerHTML = "<p>Locating…</p>";

  navigator.geolocation.getCurrentPosition(success, error);
}
</script>
<p><button onclick="geoFindMe()">Show my location</button></p>
<div id="out"></div>
 
</body>
</html>

  <?php
	  echo '<div class="forma" style="border-style:double">';
		echo '<h2>Συμπλήρωση αναφοράς τεχνικού προβλήματος</h2>';
		echo '<form action="form2.php" method="post" enctype="multipart/form-data"> <!-- Enctype δείχνει ότι το περιεχόμενο που θέλουμε να χρησιμοποιήσουμε είναι binary(upload)-->';
    $que1="SELECT c_name FROM category";
    $res1=mysql_query($que1,$con);
    echo 'Είδος Προβλήματος:<select name="categ">';
      while($row1=mysql_fetch_array($res1)){
            echo '<option value="'.$row1['c_name'].'">'.$row1['c_name'].'</option>';
       }
      echo '</select><br><br>';
			
   echo "Περιγραφή προβλήματος:";
   echo '<textarea name="prob" rows="5" cols="36">';
	 echo '</textarea>';
	 echo '<br><br>';
	 echo "Γεωγραφική Θέση(*):";
   echo '<input name="gt" type="text" size="40" id="latlongclicked"> (Πατήστε το χάρτη πιο κάτω) <br><br>';
	 //echo '<button onclick=geoFindMe()>Show my location</button>';
   //echo '<div id="out"></div>';
   echo	'<div class="xartis" id="map_canvas">';
	 echo	'</div> <br><br>';
	 echo	'<label for="file"> Φωτογραφίες προβλήματος: </label><br>';
	 echo	"Upload Image 1:";
   echo '<input type="file" name="img1" id="file"><br> <!-- Browser κουμπί-->';
   echo	"Upload Image 2:";
   echo '<input type="file" name="img2" id="file"><br>';
   echo	"Upload Image 3:";
   echo '<input type="file" name="img3" id="file"><br>';
   echo "Upload Image 4:"; 
   echo '<input type="file" name="img4" id="file"><br>';
	 echo '<input type="submit" name="submit" value="Υποβολή αναφοράς"><br><br>';
	 echo '</form>';
	 echo '<section>(Τα στοιχεία με αστερίσκο (*) είναι υποχρεωτικό να συμπληρώνονται)</section>';
	 echo '</div>';
		
	   //REPORT
      $allowedExts=array("jpeg","jpg");
      if (isset ($_POST['submit'])){
        $dscr=$_POST['prob'];
       $thesi=$_POST['gt'];
       $ctg=$_POST['categ'];
       date_default_timezone_set('Europe/Athens');
       $imer=date("Y-m-d H:i:sa");
       if($thesi==NULL){
        echo '<script> alert("Το υποχρεωτικό πεδίο γεωγραφική θέση δεν έχει συμπληρωθεί.")</script>';
        exit(" ");
       }
       $query= "SELECT * FROM category WHERE c_name='$ctg' ";
       $rs= mysql_query($query,$con);
        while ($rowc= mysql_fetch_array ($rs,MYSQL_ASSOC)){
        $categ= $rowc['c_id'];
        }
        $anqr= "INSERT INTO report (state,gps,r_id,r_description,reg_date,solv_date,solved_time,a_comments,us_id,ad_id,categ_id) VALUES ('u','$thesi',NULL,'$dscr','$imer',NULL,NULL,NULL,'$user_id',1,'$categ')";
        mysql_query($anqr,$con);
		
		//PHOTOS
		$quer="SELECT r_id FROM report WHERE reg_date='$imer' and us_id='$user_id' ";
        $res=mysql_query($quer,$con);
        $row=mysql_fetch_array($res,MYSQL_ASSOC);
        $row=$row['r_id'];
		
		//PHOTO 1
        if ((isset($_POST['submit'])) && $_FILES["img1"]["name"]!=NULL) {
        $temp=explode(".", $_FILES["img1"]["name"]);
        $extension=end($temp);
      if ((($_FILES["img1"]["type"] == "image/jpeg")
      || ($_FILES["img1"]["type"] == "image/jpg")
      || ($_FILES["img1"]["type"] == "image/pjpeg"))
      && ($_FILES["img1"]["size"] < 3000000)
      && in_array($extension, $allowedExts)) 
      {
      if ($_FILES["img1"]["error"] > 0) {
        echo "Return Code: ".$_FILES["img1"]["error"] . "<br>";
      } 
      else {
        if (file_exists("photos/".$_FILES["img1"]["name"])) {
          echo $_FILES["img1"]["name"]." already exists.<br>";
        } 
        else {
          $image1="photos/".$_FILES["img1"]["name"];
          move_uploaded_file($_FILES["img1"]["tmp_name"],$image1);
          $qr1="INSERT INTO images(rep_id,photo) VALUES ('$row','$image1')";
          mysql_query($qr1,$con);
        }
      }
      } else {
        echo "Invalid file!<br>";
    }
  }
  
  //PHOTO 2
  if ((isset($_POST['submit'])) && $_FILES["img2"]["name"]!=NULL) {
        $temp=explode(".", $_FILES["img2"]["name"]);
        $extension=end($temp);
      if ((($_FILES["img2"]["type"] == "image/jpeg")
      || ($_FILES["img2"]["type"] == "image/jpg")
      || ($_FILES["img2"]["type"] == "image/pjpeg"))
      && ($_FILES["img2"]["size"] < 3000000)
      && in_array($extension, $allowedExts)) 
      {
      if ($_FILES["img2"]["error"] > 0) {
        echo "Return Code: ".$_FILES["img1"]["error"] . "<br>";
      } 
      else {
        if (file_exists("photos/".$_FILES["img2"]["name"])) {
          echo $_FILES["img2"]["name"]." already exists.<br>";
        } 
        else {
          $image2="photos/".$_FILES["img2"]["name"];
          move_uploaded_file($_FILES["img2"]["tmp_name"],$image2);
          $qr2="INSERT INTO images(rep_id,photo) VALUES ('$row','$image2')";
          mysql_query($qr2,$con);
        }
      }
      } else {
        echo "Invalid file!<br>";
    }
  }

  //PHOTO 3
  if ((isset($_POST['submit'])) && $_FILES["img3"]["name"]!=NULL) {
        $temp=explode(".", $_FILES["img1"]["name"]);
        $extension=end($temp);
      if ((($_FILES["img3"]["type"] == "image/jpeg")
      || ($_FILES["img3"]["type"] == "image/jpg")
      || ($_FILES["img3"]["type"] == "image/pjpeg"))
      && ($_FILES["img3"]["size"] < 3000000)
      && in_array($extension, $allowedExts)) 
      {
      if ($_FILES["img3"]["error"] > 0) {
        echo "Return Code: ".$_FILES["img1"]["error"] . "<br>";
      } 
      else {
        if (file_exists("photos/".$_FILES["img3"]["name"])) {
          echo $_FILES["img3"]["name"]." already exists.<br>";
        } 
        else {
          $image3="photos/".$_FILES["img3"]["name"];
          move_uploaded_file($_FILES["img3"]["tmp_name"],$image3);
          $qr3="INSERT INTO images(rep_id,photo) VALUES ('$row','$image3')";
          mysql_query($qr3,$con);
        }
      }
      } else {
        echo "Invalid file!<br>";
    }
  }

  //PHOTO 4
  if ((isset($_POST['submit'])) && $_FILES["img4"]["name"]!=NULL) { //$_FILES onoma tou koumpiou k to xaraktiristiko tou file 
        $temp=explode(".", $_FILES["img4"]["name"]);
        $extension=end($temp);
      if ((($_FILES["img4"]["type"] == "image/jpeg")
      || ($_FILES["img4"]["type"] == "image/jpg")
      || ($_FILES["img4"]["type"] == "image/pjpeg"))
      && ($_FILES["img4"]["size"] < 3000000)
      && in_array($extension, $allowedExts)) 
      {
      if ($_FILES["img1"]["error"] > 0) { //elegxos gia apodekto extension
        echo "Return Code: ".$_FILES["img4"]["error"] . "<br>";
      } 
      else {
        if (file_exists("photos/".$_FILES["img4"]["name"])) {
          echo $_FILES["img4"]["name"]." already exists. <br>";
        } 
        else { //to path sto opio tha kano save to photo
          $image4="photos/".$_FILES["img4"]["name"];
          move_uploaded_file($_FILES["img4"]["tmp_name"],$image4);
          $qr4="INSERT INTO images(rep_id,photo) VALUES ('$row','$image4')";
          mysql_query($qr4,$con);
        }
      }
      } else {
        echo "Invalid file!<br>";
    }
  }
	mysql_close($con);
  }
?>
