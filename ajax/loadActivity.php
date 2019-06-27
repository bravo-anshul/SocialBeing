<?php 
include_once "headerAjax.php";
$sid = $_SESSION['uid'];
$count = $_REQUEST['count'];
$type = $_REQUEST['type'];

if($type == 'interest'){
	$query = mysqli_query($db_conx,"SELECT rid FROM interest WHERE uid='$sid' AND result='1' ORDER BY time DESC");
}
elseif($type == 'response'){
	$query = mysqli_query($db_conx,"SELECT uid FROM interest WHERE rid='$sid' AND result='1' ORDER BY time DESC");
}
elseif($type == 'match'){
	$query = mysqli_query($db_conx,"SELECT uid,rid FROM interest WHERE (rid='$sid' OR uid='$sid') AND result='3' ORDER BY time DESC	");
}

$total=mysqli_num_rows($query);

if($count<$total){
	for($x=0;$x<10;$x++,$count++){
		mysqli_data_seek($query,$count);
		$fetch = mysqli_fetch_array($query);
		$rid = $fetch['rid'];
		$userID = $fetch['uid'];
		if($rid==$sid){
			$rid=$userID;
		}
		if($userID==$sid){
			$userID=$rid;
		}
		$user = mysqli_query($db_conx,"SELECT name,uname,age,college,uid FROM members WHERE (uid='$rid' OR uid='$userID') ");
		$row = mysqli_fetch_array($user);
		$name = $row['name'];
		$uname = $row['uname'];
		$age = $row['age'];
		$college = $row['college'];
		$uid = $row['uid'];
		if($uid){
			echo 	'<a href="Profile.php?x='.$uid.'"><div class="w3-card-4 w3-light-grey" style="padding:10px; border-radius:10px;margin:5px;">
							<header class="w3-container w3-teal" >
						  		<h3>'.$uname.'</h3>
							</header>
							<div style="display:flex">
								<div>
									<img style="border-radius:5px;" src="/images/Users/dp/'.$uid.'.jpg?nocache='.time().'" width="50%" onerror="src=\'images/Users/default.png\'" >
								</div>
			 					<div class="">
									<p>'.$name.'</p>
									<p>'.$college.'</p>
									<p id="exp" style="margin-bottom:0px;">'.$age.'</p>
								</div>
							</div>	
						</div></a>';
		}				
	}	
} 
else {
	echo 789456;
}
?>