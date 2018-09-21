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
	//var map = new google.maps.Map(document.getElementById("map"), myOptions); 
	var xmlhttp;//Μεταβλητή που επιτρέπει επικοινωνία με τον server
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} 
	else if (window.ActiveXObject){ // code for IE6, IE5.  
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	else {
		alert("Your browser does not support XMLHTTP!");
	} 
	var url_="xartis.php";
	xmlhttp.open("GET",url_,true);
	xmlhttp.onload=function() { rstatech(xmlhttp, map) };
	xmlhttp.send(null);
}


function rstatech(Xobj,map1){
	if(Xobj.readyState==4){
		var markerlist = Xobj.responseXML.getElementsByTagName("marker");//
		for(i=0; i<markerlist.length; i++){
    	var marker = new google.maps.Marker({
	        position: new google.maps.LatLng(markerlist.item(i).getAttribute("lat"),markerlist.item(i).getAttribute("lng")), 
	        map: map1,
	    });
  	}
	}
}
google.maps.event.addDomListener(window,'load',initialize);
//window.onload = initialize;

/*var auto_refresh = setInterval(
function ()
{initialize();
}, 120000);*/