<?php 
include_once "Header.php";
$sid = $_SESSION['uid'];
$type = $_REQUEST['x'];

if($type == 'interest'){
	$delete = mysqli_query($db_conx,"UPDATE badges SET my_interest=0 WHERE uid='$sid' ");
}
elseif($type == 'response'){
	$delete = mysqli_query($db_conx,"UPDATE badges SET response=0 WHERE uid='$sid' ");
}
elseif($type == 'match'){
	$delete = mysqli_query($db_conx,"UPDATE badges SET matches=0 WHERE uid='$sid' ");
}

?> 
<!DOCTYPE html>
<html>
<head>
	<title>Activities</title>
<script type="text/javascript">
var count = -10;
function load(){
	$("#loader").hide();
	$("#spiner").css('display','block');
	count+=10;
	$.ajax({
		url:"ajax/loadActivity.php",
		data:{count:count,type:'<?php echo $type; ?>'},
		success:function(result){
			if(result == 789456){
				$("#result").append("<h3 style='text-align:center;' > Find some new Peoples :) </h3>")
				$("#loader").hide();
			}
			else{
				$("#result").append(result);
				$("#loader").show();
			}
			$("#spiner").hide();
		}		
	}); 
}
function hide(){
	$("#loader").hide();
}
load();
</script>
<style type="text/css">
	p{ 
		font-size: 2.2vh;
		margin:10px;
	}
	h3{
		font-size: 4vh;
	}
</style>
</head>
	
<body>
<div class="anshul">
	<a href="Home.php"><img src="images/icons/banner_2.png" width="100%"></a>
</div>

<span id="result"></span>
<img id="spiner" src="images/icons/spiner.gif" > 
<div id="loader" class="button" onclick="load()"><p style="margin:0px;">Load More</p></div>

</body>
</html> 