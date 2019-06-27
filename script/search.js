$(document).ready(function(){
	/*$("#name").keyup(function(){
		var val = $("#name").val();
		var college = $("#option").val();
		if(val.length>0){
			$("#result").load("ajax/searching.php",{q:val,c:college});
		}
		else{
			$("#result").html("Please Fill out the name");
		} 
	});*/
	var font = $(document).height() * 0.025 ;
	$("p,.button,.input").css('font-size',font);

	$(document).ajaxStart(function(){
		$("#spiner").css({'display':'block'});
	});
	$(document).ajaxStop(function(){
		$("#spiner").hide();
	});	 

	$(".load").on('vmousedown',function(){
		$(this).css({'background-color':'#009688','color':'white'});
		search();
	});
	$(".load").on('vmouseup',function(){
		$(this).css({'background-color':'white','color':'black'});
	});	
	$(".button").on("vmousedown",function(){
		$(this).css("background-color","white");
		$(this).css("color","black");
		search(12);
	});
	$(".button").on("vmouseup",function(){
		$(this).css("background-color","#009688");
		$(this).css("color","white");
	});
});
var count = -9;
var counter = -9;

function search(x){
	if(x == 12){
		$("div").remove('.w3-card-4');
		$("h3").remove();
		count = -9;
		counter = -9;
	}
	var val = $("#name").val();
	var college = $("#option").val();
	if(val.length>0 || college.length>0){
		if(val.length == 0){
			count+=9;
		}
		else{
			counter+=9;
		}
		$.ajax({
			url:"ajax/searching.php",
			data:{q:val,c:college,count:count,counter:counter},
			success:function(result){
				if(result == 789456){
					$("#result").append("<h3 style='text-align:center;' > End of result :) </h3>");
					$(".load").hide();
				}
				else{
					$(".load").show();
					$("#result").append(result);
				}					
			}			
		});
		//$("#result").load("ajax/searching.php",{q:val,c:college,count:count});
	}
	else{
		$("#result").html("<h3 style='text-align:center;' > Please Fill One of the input options :) </h3>");
	}	
}
