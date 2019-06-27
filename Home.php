<?php 
include_once "Header.php";

$sid = $_SESSION['uid'];

$badge = mysqli_query($db_conx,"SELECT response,matches FROM badges WHERE uid='$sid' ");
$fetch = mysqli_fetch_array($badge);
$match = $fetch['matches'];
$response = $fetch['response'];

$selectCollege = mysqli_query($db_conx,"SELECT college FROM members WHERE uid = '$sid' ");
$row = mysqli_fetch_array($selectCollege);
$college = $row['college'];

$posts = mysqli_query($db_conx,"SELECT * FROM posts ORDER BY likes DESC LIMIT 5 ");

?> 

<!DOCTYPE html>
<html> 
<head>
	<title>Home</title>
<link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/confession.css">
<link rel="stylesheet" type="text/css" href="css/home.css"> 
<script type="text/javascript">
$(document).ready(function(){
	var response = <?php echo $response; ?>;
	var match = <?php echo $match; ?>;
	if(response == 0){
		$("#rightTop").remove();
		$("#leftTop").css('width','50%');
	}
	if(match == 0){
		$("#leftTop").remove();
		$("#rightTop").css({'margin-left':'50%','width':'50%'});
	}
	$(".button").on('vmousedown',function(){
		$(this).css({'background-color':'#009688','color':'white'});
	});
	$(".button").on('vmouseup',function(){
		$(this).css({'background-color':'white','color':'black'});
	});
});
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
function follow(uid,follow){
	$.ajax({
		url:"ajax/follow.php",
		data:{uid:uid},
		success:function(result){
			$("#button_"+uid).html(result);
			if(result == "Following"){
				$("#follow_"+uid).html(follow+1);
			}
			else{
				$("#follow_"+uid).html(follow-1);
			}
		}
	});
}
</script>
<style type="text/css">
	#more{
		position: relative;
		margin-left:33%;
		padding:5px 15px;
		}
</style>
</head>
<body>

<div class="anshul">
	<img src="images/icons/banner_2.png" width="100%"> 
</div>
<hr>

<div class="banner">
	<a href="Activity.php?x=match" class="w3-half" id="leftTop"><p id="matchSpan"><?php echo $match; ?> New Match</p></a>
	<a href="Activity.php?x=response" class="w3-half" id="rightTop"><p id="responseSpan"><?php echo $response; ?> New Response</p></a>
</div>
<h4>Popular Posts</h4>
<hr>
<?php 

for($x=0;$x<5;$x++){
	mysqli_data_seek($posts,$x);
	$fetch = mysqli_fetch_array($posts);
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
					<div class="w3-card-4 cardContainer" style="border-radius:7px;padding:5px;margin-top:10px;" >
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
					    <hr>
					    <div id="counter'.$pid.'" style="position:relative;">
							'.$string.'
							<div class="w3-teal counter"  >'.$likes.'</div>
						</div>	
					</div>
		        </div>';
		}        	
}
?>
<br>
<a href="Confession.php" class="button" id="more" >More Posts</a>
<h4>Popular Peoples</h4>
<?php 

$people = mysqli_query($db_conx,"SELECT rid,count(uid)AS number FROM follow GROUP BY rid ORDER BY number DESC LIMIT 8 ");

for($y=0;$y<6;$y++){
	mysqli_data_seek($people,$y);
	$row = mysqli_fetch_array($people);
	$uid = $row['rid'];
	$followers = $row['number'];
	$user = mysqli_query($db_conx,"SELECT name FROM members WHERE uid='$uid'");
	$fetch = mysqli_fetch_array($user);
	$name = $fetch['name'];
	$follow_query = mysqli_query($db_conx,"SELECT uid FROM follow WHERE uid='$sid' AND rid='$uid' ");
	$count = mysqli_num_rows($follow_query);
	if($count>0){
		$follow = 'Following';
	}
	else{
		$follow = 'Follow';
	}
	$y++;
	mysqli_data_seek($people,$y);
	$row2 = mysqli_fetch_array($people);
	$uid2 = $row2['rid'];
	$followers2 = $row2['number'];
	$user2 = mysqli_query($db_conx,"SELECT name FROM members WHERE uid='$uid2'");
	$fetch2 = mysqli_fetch_array($user2);
	$name2 = $fetch2['name'];	
	$follow_query2 = mysqli_query($db_conx,"SELECT uid FROM follow WHERE uid='$sid' AND rid='$uid2' ");
	$count2 = mysqli_num_rows($follow_query2);
	if($count2>0){
		$follow2 = 'Following';
	}
	else{
		$follow2 = 'Follow';
	}
	if($uid && $uid2){
		echo '<div style="display:flex">
				<div class="w3-card-4 w3-half profile">
					<a href="Profile.php?x='.$uid.'"><img class="img" src="images/Users/dp/'.$uid.'.jpg?nocache='.time().'"></a>
					<p>'.$name.'</p>
					<p id="follow_'.$uid.'" >'.$followers.'</p>
					<div onclick="follow('.$uid.','.$followers.')" id="button_'.$uid.'" class="button">'.$follow.'</div>
				</div>
				<div class="w3-card-4 w3-half profile">
					<a href="Profile.php?x='.$uid2.'"><img class="img" src="images/Users/dp/'.$uid2.'.jpg?nocache='.time().'"></a>
					<p>'.$name2.'</p>
					<p id="follow_'.$uid2.'" >'.$followers2.'</p>
					<div onclick="follow('.$uid2.','.$followers2.')" id="button_'.$uid2.'" class="button">'.$follow2.'</div>
				</div>	
			</div>';
	}		
}

?>
<br>
<a href="Search.php" class="button" id="more" >More Peoples</a>
<hr>

</body>
</html>