$(document).ready(function(){
	var height = $(document).height();
	$('.button,.input').css('font-size',height*0.025);
	$('h3').css('font-size',height*0.04);

	$("#navigation").hide();
	$(document).resize(function(){
		var x = $(document).height();
		$("#loader").css('height',x);
	});
	$("#pic").on('vmousedown',function(){
		$(this).css({'background-color':'#009688','color':'black'});
	});
	$(document).on("click","#pic",function(){
		$("#modal").show();
	});
	$(document).ajaxStart(function(){
		$("#loader").show();
	});
	$(document).ajaxStop(function(){
		$("#loader").hide();
		$("#bravo1").attr('src','images/icons/bravo1.jpg');
		$("#cross").attr('src','images/icons/cross.png');
	});
	$("#reveal").click(function(){
		$("#show").show();
	});
	$("#bravo1").click(function(){
		match('interested');
		$(this).attr("src","images/icons/bravo_teal.png");
	});
	$("#cross").click(function(){
		match('notInterested');
		$(this).attr('src','images/icons/cross_red.png');
	});
});	

function match(type){
	var x = $(document).height();
	$("#loader").css('height',x);
	var uid = $("#userId").attr('value');
	var gender = $("#gender").val();
	var age = $("#age").val();
	var college = $("#c1").val();
	if(college.length>0){
		$("#navigation").show();
		$.ajax({
			url:"ajax/match.php",
			data:{age:age,gender:gender,college:college,type:type,uid:uid},
			success:function(result){
				if(result == 789456){
					$("#result1").html("<h3 style='text-align:center;'>Can't Find Anyone :(</h3><p id='cinzel'>But we are expanding.. Try after sometime :) </p><p id='cinzel'>Or Try Change the Filter</p>");
					$("#bravo1").hide();
					$("#cross").hide();
				}
				else{
					$("#bravo1").show();
					$("#cross").show();
					$("#result1").html(result);
				}
			}
		});
	}
	else{
		$("#result1").html("<h3 style='text-align:center;'>Please fill out the college field.</h3>");
	}
}