 $(document).ready(function(){
 	$('img').error(function(){
 		$(this).attr('src','images/Users/default.png');
 	});
	$("#hide").on("click", function() { 
		$("#show").show();
		$(this).hide();
	});
	$("#right").on("click",function(){
		$("#hide").show();
		$("#show").hide();
	});
	$('a').click(function(){
		$(".redirect").show();
	});
});	 