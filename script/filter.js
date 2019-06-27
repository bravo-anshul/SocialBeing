$(document).ready(function(){
	var height = $(document).height();
	$(".button,body").css('font-size',height*0.022);

	$("#hint").keyup(function(){
		var x = $("#hint").val();
		if(x.length>0){
			$("#result").show();
			$("#result").load("Prototype/gethint.php",{q:x});
		}	
		else{
			$("#result").hide();
		}
	});
	$("#close").click(function(){
		$("#modal").hide();
	});
	$("#add_post").on('vmousedown',function() { 
  		$(this).css("background-color","#009688");
  		$("#modal").show();
 	}); 
 	$("#add_post").on('vmouseup',function(){
 		$(this).css("background-color","white");
 	});
 	$("#posting").load("ajax/confession.php");


});
 
var filter = -5;
 
function value(string){
	$("#hint").val(string);
	$(".value").hide();
}
function Filter(){
	filter+=5;
	$("#loader").hide();
	$("#spiner").css('display','block');
	$.ajax({
		url:"ajax/confession.php",
		dataType:"html",
		data:{filter:filter},
		success:function(result){
			if(result == 789456){
				$("#filter").before("<h3 style='text-align:center;' > No More Posts :( </h3>");	
				$("#loader").hide();
			}
			else{
				$("#filter").before(result);
				$("#loader").show();
			}
			$("#spiner").hide();			
		}
	});
}

function liking(pid){
	$.ajax({
		url:"ajax/liking.php",
		dataType:"html",
		data:{pid:pid},
		success:function(result){
			$('#counter'+pid).replaceWith(result);
		}
	});
}
Filter();