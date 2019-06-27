<?php 
include_once "headerAjax.php";

$sid = $_SESSION['uid'];
$rid = $_REQUEST['rid'];
$body = $_REQUEST['body'];
$count = $_REQUEST['count'];
$uname = $_REQUEST['uname'];
$curr_msgs = $_REQUEST['curr_msgs'];
$type = $_REQUEST['type'];

if($type == "load"){
	if($count>0){
		$messages = mysqli_query($db_conx,"SELECT sid,body,mid FROM messages where (sid = '$sid' OR sid='$rid') AND (rid = '$rid' OR rid='$sid') ORDER BY time ASC ");
		$x = $count-10;
		for($y=0;$y<10;$y++,$x++){
			if($x<0){
				continue;
			}
			mysqli_data_seek($messages,$x);
			$row = mysqli_fetch_array($messages);
			$mess = $row['body'];
			$id = $row['sid'];
			$mid = $row['mid'];
				if($id == $sid){
					echo'<div value='.$mid.' class="holder"><p class="reciever">'.$mess.'</p></div>';
				}
				else{
					echo'<div value='.$mid.' class="holder"><p class="sender">'.$mess.'</p></div>';
				}
		}
	}
	elseif($count==0) {
		echo "<h3 style='text-align:center;' > No messages yet :) </h3>";
	}	
	else{
		echo "<h3 style='text-align:center;' > No more messages :) </h3>";
	}
}
   
///////////////////////////////////////////////////////////////////////

elseif($type == "send"){
	if($body){
		$body = addslashes($body);
		$notification = mysqli_query($db_conx,"SELECT sid FROM notification WHERE sid='$sid' AND rid='$rid' ");
		if(mysqli_num_rows($notification)<1){
			$noti_insert = mysqli_query($db_conx,"INSERT INTO notification (sid,rid) VALUES('$sid','$rid') ");
		}
		$insert = mysqli_query($db_conx,"INSERT INTO messages (sid,rid,body) VALUES('$sid','$rid','$body') ");
	}
	$select_post = mysqli_query($db_conx,"SELECT sid,body,mid FROM messages WHERE (sid = '$sid' OR sid='$rid') AND (rid = '$rid' OR rid='$sid') ORDER BY time ASC ");
	$count = mysqli_num_rows($select_post);
	$x = $count - $curr_msgs;
	for($y=0;$y<$x;$curr_msgs++,$y++){
		mysqli_data_seek($select_post,$curr_msgs);
		$row = mysqli_fetch_array($select_post);
		$body1 = $row['body'];
		$id = $row['sid'];
		$mid = $row['mid'];
		if($id == $sid){
			echo'<div value="'.$mid.'" class="holder"><p class="reciever">'.$body1.'</p></div>';
		}
		else{
			echo'<div value="'.$mid.'" class="holder"><p class="sender">'.$body1.'</p></div>';
		}
	}
}
?>