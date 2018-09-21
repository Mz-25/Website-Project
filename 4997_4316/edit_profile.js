$(function(){
	var message_status=$('#status');
	$("section[contenteditable=true]").blur(function(){//καλεί την function όταν το editable στοιχείο χάσει focus
		var field_userid=$(this).attr("id"); //παίρνει το attribute id του editable στοιχείου
		var value=$(this).text(); //παίρνει την νέα τιμή του editable στοιχείου
		$.post('edit_profile.php',field_userid + "=" + value,function(data){
			if (data!= ''){
				//message_status.show();
				//message_status.text(data);
				setTimeout(function(){message_status.hide()},3000);
			}
		});
	});	
});