$(document).ready(function(){
	$.getJSON("email_res.php", function(data){
		$("#f_email").focusout(function(){
			var email = $("#f_email").val();
			var regEx = new RegExp(email, "i");
			if(email){
			$.each(data,function(id, obj){
				if(obj.email.search(regEx) != -1){
					$("#email_verify")
					.text("Korisnik sa email-om koji ste uneli vec postoji!")
					.css("color","red");
					return false;
				}else{
					$("#email_verify")
					.text("Email koji ste uneli je dostupan!")
					.css("color","green");
				}
			})}
		})
	});	
});