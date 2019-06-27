<?php 
include_once "Header.php";

$sid = $_SESSION['uid'];
$userId = $_REQUEST['q'];
$type = $_REQUEST['x'];

if($type == 'confession'){
	$query = mysqli_query($db_conx,"SELECT * FROM posts WHERE uid='$userId' AND identity='1' ORDER BY time DESC ");
}
elseif($type == 'target'){
	$query = mysqli_query($db_conx,"SELECT * FROM posts WHERE targetId='$userId' ORDER BY time DESC ");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>userActivity</title>
<link rel="stylesheet" type="text/css" href="css/confession.css">
<script type="text/javascript">
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
</script>
</head>
<body>

<div class="anshul">
	<a href="Home.php"><img src="images/icons/banner_2.png" width="100%"></a>
</div>
<hr>

<?php 

$count = mysqli_num_rows($query);
if($count == 0){
	echo "<h3 style='text-align:center;' > No Posts to show :( </h3>";
	die();
}
for($x=0;$x<$count;$x++){
	mysqli_data_seek($query,$x);
	$fetch = mysqli_fetch_array($query);
	$id = $fetch['identity'];
	$targetName = $fetch['targetName'];
	$targetId = $fetch['targetId'];
	$body = $fetch['body'];
	$pid = $fetch['pid'];
	$likes = $fetch['likes'];
	$uid = $fetch['uid'];
	$uname = $fetch['uname'];
	
	$like = mysqli_query($db_conx,"SELECT pid FROM likes WHERE uid = '$sid' AND pid = '$pid' ");
	$status = mysqli_num_rows($like);
	if($status>0){
	$string = '<img src="images/icons/bravo_teal.png" width="9%" class="liked" onclick="liking('.$pid.')" >';
	}
	else{
		$string = '<img src="images/icons/bravo1.jpg" width="9%" class="unliked" onclick="liking('.$pid.')" >';
	}

	if($uid){
		echo'<div>
				<div class="w3-card-4" style="padding:5px;border-radius:7px;">
					<div style="display:flex">
						<div class="w3-third" id="dp">
								'.($id==1 ? '<a href="Profile.php?x='.$uid.'"><img src="images/Users/dp/'.$uid.'.jpg?nocache='.time().'" class="img" width="100%" height="auto"></a>' :
								           '<img src="images/icons/anonymous.png" class="img" width="100%" height="auto">' ).'
						</div>
						<div class="w3-third" id="middle">
							'.($id==1 ? '<a href="Profile.php?x='.$uid.'"><p>'.$uname.'</p></a>' :
								        '<p>Anonymous</p>'  ).'
							<img src="images/icons/target.png" id="target">
							<a href="Profile.php?x='.$targetId.'"><p>'.$targetName.'</p></a>
						</div>
						<div class="w3-third" id="dp">
							<a href="Profile.php?x='.$targetId.'"><img src="images/Users/dp/'.$targetId.'.jpg?nocache='.time().'" class="img" width="100%" height="auto" "></a>
						</div>
					</div>	
				<p id="text">'.$body.'</p>
				</div>
				<div id="counter'.$pid.'" style="position:relative;">
					'.$string.'
					<div class="w3-teal counter"  >'.$likes.'</div>
				</div>	
				<hr class="hr">
	        </div>';
		}        
}

?>

</body>
</html>