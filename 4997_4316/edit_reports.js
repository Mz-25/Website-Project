$(function(){
	var message_status=$('#status');
	$("td[contenteditable=true]").blur(function(){
		var field_userid=$(this).attr("id");
		var value=$(this).text();
		$.post('edit_reports.php',field_userid + "=" + value,function(data){
			if (data!= ''){
				message_status.show();
				message_status.text(data);
				setTimeout(function(){message_status.hide()},3000);
			}
		});
	});	
});