$(document).ready(function(){
	var i = 1;
	setInterval(function(){
		$("#ani").fadeOut(1000,function(){
			$("#ani").attr("src","img/ani/"+i+".jpg");
		});
		$("#ani").fadeIn(1000);
		i++;
		if(i > 3){ i = 1};
	},5000)
})