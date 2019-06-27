$(document).ready(function(){
	var height = $(document).height();
	$(".button,body").css('font-size',height*0.022);

	$("#hint").keyup(function(){
		var x = $("#hint").val();
		if(x.length>0){
			$("#result").show();
			$.ajax({
				url:"ajax/searching.php",
				data:{type:'confess',q:x},
				success:function(result){
					if(result == 789456){
						$("#result").html("<h3>Can't find anybody with this name</h3>");
					}
					else{
						$("#result").html(result);
					}	
				}
			});
			//$("#result").load("ajax/searching.php",{q:x,type:'confess'});
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

 	$("#noFilterPost").on('click',function(){	
 		noFilter();
 		$('#FilterPost').show();
 	});
 	$("form").submit(function(){
       $(".posting").show();
    });
});
 
var all = -10;

function value(string){
	$("#hint").val(string);
	$("#result").hide();
}

function noFilter(){
	all+=10;
	$("#loader").hide();
	$("#spiner").css('display','block');
	$.ajax({
		url:"ajax/confession.php",
		dataType:"html",
		data:{all:all},
		success:function(result){
			if(result == 789456){
				$("#noFilter").before("<h3 style='text-align:center;' > No More Posts :( </h3>");	
				$("#loader").hide();
			}
			else{
				$("#noFilter").before(result);
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
noFilter();