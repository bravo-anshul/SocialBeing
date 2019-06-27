<?php 
include_once "Header.php";
$sid = $_SESSION['uid'];
$type = $_REQUEST['x'];

if($type == 'target'){
	$delete = mysqli_query($db_conx,"UPDATE badges SET target=0 WHERE uid='$sid' ");
}
elseif($type == 'myConfession'){
	$delete = mysqli_query($db_conx,"UPDATE badges SET confess=0 WHERE uid='$sid' ");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Confessions</title>
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click','.delete',function(){
		var y = $(this).attr('value');
		$("#demo").attr('value',y);
		$("#modal").show();
		$("#response").replaceWith('<div id="response" onclick="del()" class="button w3-half"><p>DELETE</p></div>');
	});
	$(document).on('vmousedown','.button',function(){
		$(this).css({'background-color':'#009688'});
	});
	$(document).on('vmouseup','.button',function(){
		$(this).css({'background-color':'white'});
	});
});
var count = -10;

function liking(pid){
	$.ajax({
		url:"ajax/liking.php",
		dataType:"html",
		data:{pid:pid,type:'<?php echo $type; ?>'},
		success:function(result){
			$('#counter'+pid).replaceWith(result);
		}
	});
}

function del(){
	var pid = $("#demo").attr('value');
	$.ajax({
		url:"back_end/delete.php",
		data:{pid:pid,type:"post"},
		success:function(){
			alert("POST DELETED :) Refresh page to see changes !");
		}
	});
	$("#modal").hide();
}
function load(){
	$("#loader").hide();
	$("#spiner").css('display','block');
	count+=10;
	$.ajax({
		url:"ajax/loadConfess.php",
		data:{count:count,type:'<?php echo $type; ?>'},
		success:function(result){
			$("#result").append(result);
			if(result == "<h3 style='text-align:center;' > No More Posts :( </h3>"){
				$("#loader").hide();
			}
			else{
				$("#loader").show();
			}
			$("#spiner").hide();
		}
	});
}
load();
</script>
<style type="text/css">
	p{ 
		font-size: 2.2vh;
		margin:0px;
	}
	.unliked,.liked{
		margin: 15px;
		margin-left: 20px;
		margin-bottom: 0px;
	}
	.img{
		border-radius:5px;
	}
	.counter{
		color:white;
		position: absolute;
		padding:5px 25px;
		top: 35%;
		left: 37%;
		border-radius:7px;
		font-family: "Lobster", "sans-serif";
		font-size: 2.2vh;
	}
	.delete{
		color:white;
		position: absolute;
		padding:5px 25px;
		top: 35%;
		right:10%;
		border-radius:7px;
		font-family: "Lobster", "sans-serif";
		font-size: 2.2vh;
	}
	#dp{ 
		overflow: hidden;
		margin: auto;
		width: 50%;
	}
	#middle{
		text-align: center;
		font-family: 'Cinzel', serif;
		padding: 5px;
	}
	#target{
		width: 20%;
	}
	#text{
		margin: 3px;
		margin-top:20px;
	    font-family: 'Raleway', sans-serif;
	}
	#response{
		border-color:red;
	}
</style>
</head>
<body>
<div class="anshul">
	<a href="Home.php"><img src="images/icons/banner_2.png" width="100%"></a>
</div>


<span id="result"></span>
<img id="spiner" src="images/icons/spiner.gif" > 
<div id="loader" class="button" onclick="load()"><p>Load More</p></div>
<span id="demo"></span>


<!----OMODAIL---->
<div id="modal" class="w3-modal">
  <div class="w3-modal-content w3-card-8" style="border-radius:5px;">
    <header class="w3-container w3-teal">
      <span onclick="document.getElementById('modal').style.display='none'"
      class="w3-closebtn">&times;</span>
     </header>
    <div style="display:flex;">
		<span id='response'></span>
		<div onclick="document.getElementById('modal').style.display='none'" class="button w3-half"><p>Cancel</p></div>
	</div>
  </div>
</div>

</body>
</html>