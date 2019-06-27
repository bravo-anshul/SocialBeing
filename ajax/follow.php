<?php 
include_once "headerAjax.php";

$uid = $_REQUEST['uid'];
$sid = $_SESSION['uid'];  

$query = mysqli_query($db_conx,"SELECT uid FROM follow WHERE uid='$sid' AND rid='$uid' ");
$count = mysqli_num_rows($query);
if($count>0){
	$delete = mysqli_query($db_conx,"DELETE FROM follow WHERE uid = '$sid' AND rid = '$uid' ");
	echo "Follow";
}
else{
	$insert = mysqli_query($db_conx,"INSERT INTO follow (uid,rid) VALUES('$sid','$uid')");
	echo "Following";
}

?>