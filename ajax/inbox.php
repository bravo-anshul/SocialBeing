<?php 
include_once "headerAjax.php";

$sid = $_SESSION['uid'];
$count = $_REQUEST['count'];

$query = mysqli_query($db_conx,"SELECT DISTINCT sid,rid FROM (SELECT * FROM  messages ORDER BY time DESC) AS anshul WHERE (sid='$sid' OR rid='$sid')");

$total = mysqli_num_rows($query);
$userArray = array();

if($total == 0){
	echo 894561;
	die();
}

for($x=0;$x<$total;$x++){
	mysqli_data_seek($query,$x);
	$fetch = mysqli_fetch_array($query);
	$reciever = $fetch['rid'];
	$sender = $fetch['sid'];
	if($sender == $sid){
		array_push($userArray, $reciever);
	}
	elseif($reciever == $sid){
		array_push($userArray, $sender);
	}		 
}
 
$userArray = array_unique($userArray);
$z = count($userArray);

if($count<$z){
	for($y=0;$y<10;$count++,$y++){
		if($userArray[$count]){
			$userID = $userArray[$count];
			$queryBody = mysqli_query($db_conx,"SELECT body,sid FROM messages WHERE (sid='$sid' OR sid='$userID') AND (rid='$sid' OR rid='$userID') ORDER BY time DESC ");
			$fetchBody = mysqli_fetch_array($queryBody);
			$getUser = mysqli_query($db_conx,"SELECT uname FROM members WHERE uid='$userID'");
			$username = mysqli_fetch_array($getUser);
			$uname = $username['uname'];
			$body = $fetchBody['body'];
			$currentsid = $fetchBody['sid'];
			if($userID){
				echo '<a href="Messages.php?x='.$userID.'&uname='.$uname.'"><div class="w3-card-4 w3-light-grey" style="padding:10px; border-radius:10px;margin:5px;">
								<header class="w3-container w3-teal" >
							  		<h3>'.$uname.'</h3>
								</header>
								<div class="container" >
									<div style="position:relative;">
										<img style="border-radius:5px;" src="/images/Users/dp/'.$userID.'.jpg?nocache='.time().'" width="75%" onerror="src=\'images/Users/default.png\'" >
									</div>
									<div class="">
										<p class="'.($currentsid == $sid ?  "reciever":  "sender").'">'.$body.'</p>
									</div>
									<span class="w3-third"></span>
								</div>	
						</div></a>';
			}	
		}
	}
}	
else{
	echo 789456;
}
?>