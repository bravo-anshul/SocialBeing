<?php 

include_once "Header.php";

$uid = $_REQUEST['x'];
$sid = $_SESSION['uid'];

if(empty($uid)){
	echo'<div class="anshul">
			<img src="images/icons/banner_2.png" width="100%"> 
		</div>';
	echo "<h3 style='text-align:center;' > This person is not our member :( </h3>";
	die();
}
if($uid == $_SESSION['uid']){

	header("location:User-profile.php");
	die();
}

$select_user = mysqli_query($db_conx,"SELECT uname,name,age,college,about FROM members WHERE uid = '$uid' ");
$row = mysqli_fetch_array($select_user);
$uname = $row['uname'];
$name = $row['name'];
$age = $row['age'];
$college = $row['college'];
$about = $row['about'];

$follow = mysqli_query($db_conx,"SELECT uid FROM follow WHERE uid = '$sid' AND rid = '$uid' ");
$row = mysqli_fetch_array($follow);
$num = $row['uid'];
if($num>0){
	$follow = "<p style='color:purple'>Unfollow</p>";
}
else{
	$follow = "<p>Follow</p>";
}

$interest = mysqli_query($db_conx,"SELECT uid,rid,result FROM interest WHERE (uid='$uid' OR uid='$sid') AND (rid='$uid' OR rid='$sid') ");
$fetch_interest = mysqli_fetch_array($interest);
$result = $fetch_interest['result'];
$interest_uid = $fetch_interest['uid'];
$interest_rid = $fetch_interest['rid'];

if(mysqli_num_rows($interest)>0){
	if($interest_uid == $sid && $interest_rid == $uid && $result=='1'){
		$interest_string = "<p id='interested' style='color:#009688' onclick='modalShow(\"interested\")'>Interested</p>";
	}
	else{
		if($interest_uid == $uid && $interest_rid == $sid && $result=='1'){
			$interest_string = "<p style='color:#009688' onclick='modalShow(\"react\")'>Response</p>";
		}
		else{
			if(($interest_uid == $sid||$interest_uid == $uid) && ($interest_rid == $uid||$interest_rid == $sid) && $result=='3'){
				$interest_string = "<p style='color:#009688'>Match :)</p>";
			}
			else{
				$interest_string = "<p id='interest' onclick='modalShow(\"interest\")'>Show Interest</p>";
			}	
		}	
	}
}
else{
	$interest_string = "<p id='interest' onclick='modalShow(\"interest\")'>Show Interest</p>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
<link rel="stylesheet" type="text/css" href="css/profile.css">	
<script type="text/javascript" src="script/profile.js"></script>

</head>
<body>

<input type="hidden" id="span_uid" value="<?php echo $uid; ?>" ></input>


<div class="anshul">
	<a href="Home.php"><img src="images/icons/banner_2.png" width="100%"></a>
</div>
<div class="w3-card-2" style="padding:10px; margin-bottom:10px; border-radius:10px;">
	<header class="w3-container w3-teal" >
  		<h3><?php echo $uname; ?></h3>
	</header>
	<div style="display:flex">
		<div id="dp" class="pictures">
			<img src="images/Users/dp/<?php echo $uid;?>.jpg?nocache=<?php echo time(); ?>" width="100%" height="auto" >
		</div>
		<div class="" style="width:50%;margin:5px;">
			<div id="interest" class="button"><?php echo $interest_string; ?></div>
			<div id="follow" class="button"><?php echo $follow; ?></div>
			<div id="message" class=" button"><a href="Messages.php?x=<?php echo $uid; ?>&uname=<?php echo $uname; ?>"><p>Message</p></a></div>
		</div>	
	</div>	
	<hr style="margin-top:5px;">
	<p><?php echo $name; ?></p><hr>
	<p><?php echo $age; ?></p><hr>
	<p><?php echo $college; ?></p>
	<hr>
	<h3>About:-</h3>
	<p style="font-family: 'Cinzel', serif;"><?php echo nl2br($about); ?></p>
</div>
<div style="display:flex">
	<div class="pictures w3-third"><img src="/images/Users/1/<?php echo $uid;?>.jpg?nocache=<?php echo time(); ?>" height="auto" width="100%"></div>
	<div class="pictures w3-third"><img src="/images/Users/2/<?php echo $uid;?>.jpg?nocache=<?php echo time(); ?>" height="auto" width="100%"></div>
	<div class="pictures w3-third"><img src="/images/Users/3/<?php echo $uid;?>.jpg?nocache=<?php echo time(); ?>" height="auto" width="100%"></div>
</div>	
<div style="display:flex">
	<div class="pictures w3-third"><img src="/images/Users/4/<?php echo $uid;?>.jpg?nocache=<?php echo time(); ?>" height="auto" width="100%"></div>
	<div class="pictures w3-third"><img src="/images/Users/5/<?php echo $uid;?>.jpg?nocache=<?php echo time(); ?>" height="auto" width="100%"></div>
	<div class="pictures w3-third"><img src="/images/Users/6/<?php echo $uid;?>.jpg?nocache=<?php echo time(); ?>" height="auto" width="100%"></div>
</div>	

<!----INTEREST MODAL -->
<div id="interest_modal" class="w3-modal">
  <div class="w3-modal-content w3-card-8">
    <header class="w3-container w3-teal">
      <span onclick="document.getElementById('interest_modal').style.display='none'"
      class="w3-closebtn">&times;</span>
      <h4><p><?php echo $uname; ?></p></h4>
    </header>
	<div style="display:flex;">
		<div id="response" ></div>
		<div id="close" class="button w3-half"><p>Cancel</p></div>
	</div>
  </div>
</div>

<!----FOLLOW MODAL-->
<div id="modal" class="w3-modal">
  <div class="w3-modal-content w3-card-8">
    <header class="w3-container w3-teal">
      <span onclick="document.getElementById('modal').style.display='none'"
      class="w3-closebtn">&times;</span>
      <h4><p><?php echo $uname; ?></p></h4>
    </header>
    <div class="w3-container">
    	<div id="follow_modal" class=" button"><p>Go ahead !!</p></div>
    </div>
  </div>
</div>

<div class="div">
	<a href="UserActivity.php?x=confession&q=<?php echo $uid; ?>" class="w3-half button ">Confessions</a>
	<a style='border-color:purple;' href="UserActivity.php?x=target&q=<?php echo $uid; ?>" class="w3-half button ">Target</a>
</div>


</body>
</html>
