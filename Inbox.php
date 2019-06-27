<?php 
include_once "Header.php";

$sid = $_SESSION['uid'];

$delete = mysqli_query($db_conx,"DELETE FROM notification WHERE rid='$sid' ");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Inbox</title>	
<script type="text/javascript">
$(document).ready(function(){
	$("#loader").on('vmousedown',function(){
		$(this).css({'background-color':'#009688','color':'white'});
	});
	$("#loader").on('vmouseup',function(){
		$(this).css({'background-color':'white','color':'black'});
	});
});
var count =-10;
function load(){
	$("#loader").hide();
	$("#spiner").css('display','block');
	count+=10;
	$.ajax({
		url:"ajax/inbox.php",
		data:{count:count},
		success:function(result){
			if(result == 789456){
				$("#result").before("<h3 style='text-align:center;' > No More Chats :( </h3>");
				$("#loader").hide();
			}
			else if(result == 894561){
				$("#result").before("<h3 style='text-align:center'> No Chats yet :( </h3>");
				$("#loader").hide();
			}
			else{
				$("#result").before(result);
				$("#loader").show();
			}	
			$("#spiner").hide();
		}
	});
} 
load();
</script>
<style type="text/css">
	h3{
		font-size: 4vh;
	}
	p{
		font-size: 2.3vh;
		margin:5px;
	}
	.hollowButton{
		font-size: 2.2vh;
		margin:10px 30%;
		border:2px solid #009688;
		border-radius: 10px;
		text-align: center;
	}
	.body{
		position: absolute;
		top:25%;
		left:25%;
	}
	.reciever{
		position:absolute;
		padding:5px 10px;
		color:white;
		background-color: #3f51b5;
		margin:3px 5px;
		border-radius:10px;
	}
	.sender{
		position:absolute;
		padding:5px 10px;
		color:white;
		background-color: #009688;
		margin:3px 5px;
		border-radius:10px; 

	}
	.container{
		display:flex;
		overflow: hidden;
		position: relative;
	}
	#inboxNoti{
		display: none;
	}
</style>
</head>
<body>
<div class="anshul">
	<img src="images/icons/banner_2.png" width="100%"> 
</div>
<span id="result"></span>
<img id="spiner" src="images/icons/spiner.gif" > 
<div class="hollowButton"  id="loader" onclick="load()"  ><p>Load More</p></div>

</body>
</html>