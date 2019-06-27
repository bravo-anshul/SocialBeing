<?php 

include_once "Header.php";

$rid = $_REQUEST['x'];
$uname = $_REQUEST['uname'];
$sid = $_SESSION['uid'];
$mess = mysqli_query($db_conx,"SELECT sid FROM messages where (sid = '$sid' OR sid='$rid') AND (rid = '$rid' OR rid='$sid') ");
$curr_msgs = mysqli_num_rows($mess);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
<link rel="stylesheet" type="text/css" href="css/message.css">
<script type="text/javascript">
$(document).ready(function(){
	/*$(window).bind('beforeunload', function(){
		$("#window").hide();
  		return 'This will delete all the Messages';
	});*/
	var height = $(document).height();
	$('.button,.input,.hollowButton').css('font-size',height*0.02);
	$('h3').css('font-size',height*0.04);

	$(".button").on("vmousedown",function(){
		$(this).css({"background-color":"white","color":"#009688"});
	});
	$(".button").on("vmouseup",function(){
		$(this).css({"background-color":"#009688","color":"white"});
	});
	$("#loaderM").on('vmousedown',function(){
		$(this).css({'background-color':'#009688','color':'white'});
	});
	$("#loaderM").on('vmouseup',function(){
		$(this).css({'background-color':'white','color':'black'});
		$(this).hide();
		$("#spinerM").css('display','block');
		load();
	});
	$(document).on('taphold','.holder',function(){
		$("#modal").show();
		var x = $(this).attr('value');
		$("#demo").attr('value',x);
	});
	$("#cancel").on('vmousedown',function(){
		$('#modal').hide();
	});
	$("#hide").hide();

});
var x = 0;
var curr_msgs = <?php echo $curr_msgs; ?>;


function load(){
	count = curr_msgs-x;
	x+=10;
		$.ajax({
			url:"ajax/messages.php",
			dataType:"html",
			data:{count:count,rid:<?php echo $rid; ?>,type:"load"},
			success:function(result){
				$("#messages").after(result);
				$("#spinerM").hide();
				if(result == "<h3 style='text-align:center;' > No more messages :) </h3>"|| result == "<h3 style='text-align:center;' > No messages yet :) </h3>"){
					$("#loaderM").hide();
				}
				else{
					$("#loaderM").show();
				}	
			}
		});
}
function send(){
	var message = $(".input").val();
	$(".input").val(null);
	repeat(message);
}
function repeat(message){
	$("#result1").load("ajax/messages.php",{curr_msgs:curr_msgs,rid:<?php echo $rid; ?>,body:message,type:"send"});
}
function del(){
	var mid = $("#demo").attr("value");
	$.ajax({
		url:"back_end/delete.php",
		data:{pid:mid,type:"message"},
		success:function(){
			alert("Message Removed :) Refresh page to see changes !");
		}
	});
	$("#modal").hide();
}
load();
setInterval(repeat,8000);
</script>	

</head>
<body>
<span id="demo"></span>
<div class="w3-card-4" id="window">
	<header class="w3-container w3-teal" style="margin-bottom:5px;border-radius;5px;">
  		<a href='Profile.php?x=<?php echo $rid; ?>'><h3><?php echo $uname; ?></h3></a>
	</header>
	<img id="spinerM" src="images/icons/spiner.gif" > 
	<div class="hollowButton" id="loaderM" ><p>Load More</p></div>
	<span id="messages"></span>
	<span id="result1"></span>
</div>	
<div id="area" >
	<input  class="input w3-indigo w3-half" placeholder="Your message here....">
	<div onclick="send()" class="button w3-half">Send</div>
</div>
<!--DELETE-->
<div id="modal" class="w3-modal">
  <div class="w3-modal-content w3-card-8" style="border-radius:5px;">
    <header class="w3-container w3-teal">
      <span onclick="document.getElementById('modal').style.display='none'"
      class="w3-closebtn">&times;</span>
    </header>
    <div style="display:flex;">
    	<div onclick="del()" id="del" class="hollowButton w3-half"><p>Remove</p></div>
    	<div id="cancel" class="hollowButton w3-half"><p>Cancel</p></div>
    </div>
  </div>
</div>

</body>
</html>