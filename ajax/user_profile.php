<?php 

include_once "headerAjax.php";

$rid = $_REQUEST['uid'];
$uid = $_SESSION['uid'];

$find = mysqli_query($db_conx,"SELECT uid FROM follow WHERE uid = '$uid' AND rid = '$rid' ");
$count = mysqli_num_rows($find);
if($count>0){
	$delete = mysqli_query($db_conx,"DELETE FROM follow WHERE uid = '$uid' AND rid = '$rid' ");
	echo '<p style="color:black">Follow</p>';
}
else{
	$insert = mysqli_query($db_conx,"INSERT INTO follow (uid,rid) VALUES('$uid','$rid')");
	echo '<p style="color:purple">UnFollow</p>';
}

?>