
$(document).ready(function(){
	var uid = $("#span_uid").val();

	$("#follow").on("vmousedown",function(){
		$(this).css({"background-color":"purple","color":"white"});
	});
	$("#follow").on("vmouseup",function(){
		$(this).css({"background-color":"white","color":"black"});
		$("#modal").show();
	});
	$("#follow_modal").on("vmousedown",function(){

		$("#follow").load("ajax/user_profile.php",{uid:uid});
		$("#modal").hide();
		$("#follow").html("<?php echo $following; ?>");
	});
	$("#close").click(function(){
		$("#interest_modal").hide();
	});
});	
function modalShow(string){
	$("#interest_modal").show();
	if(string == 'interest'){
		$("#response").replaceWith("<div id='response' onclick='showInterest()' class='button w3-half'><p>Show Interest</p></div>");
	}
	if(string == 'interested'){
		$("#response").replaceWith("<div id='response' onclick='notInterested()' class='button w3-half'><p>Not Interested</p></div>");
	}
	if(string == 'react'){
		$("#response").replaceWith("<div id='response' style='display:flex' ><div  onclick='accept()' class='button'><p>Accept</p></div>"
																		+
			                       "<div  onclick='decline()' class='button'><p>Decline</p></div></div>");
	}
}
function showInterest(){
	var uid = $("#span_uid").val();

	$.ajax({
		url:"ajax/interest.php",
		data:{type:"interest",uid:uid}
	});
	$("#interest_modal").hide();
	$("#interest").html("<p id='interested' style='color:#009688' onclick='modalShow(\"interested\")'>Interested</p>");
}

function notInterested(){
	var uid = $("#span_uid").val();
	$.ajax({
		url:"ajax/interest.php",
		data:{type:"notInterested",uid:uid}
	});
	$("#interest_modal").hide();
	$("#interest").html("<p id='interest' onclick='modalShow(\"interest\")'>Show Interest</p>");
}

function accept(){
	var uid = $("#span_uid").val();
	$.ajax({
		url:"ajax/interest.php",
		data:{type:"accept",uid:uid}
	});
	$("#interest_modal").hide();
	$("#interest").html("<p style='color:#009688' >Match :)</p>");
}

function decline(){
	var uid = $("#span_uid").val();
	$.ajax({
		url:"ajax/interest.php",
		data:{type:"decline",uid:uid}
	});
	$("#interest_modal").hide();
	$("#interest").html("<p id='interest' onclick='modalShow(\"interest\")'>Show Interest</p>");
}