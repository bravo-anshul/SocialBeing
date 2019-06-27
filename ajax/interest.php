<?php 
include_once "headerAjax.php";

$sid = $_SESSION['uid'];
$uid = $_REQUEST['uid'];
$type = $_REQUEST['type'];

if($type == 'interest'){
	$query = mysqli_query($db_conx,"INSERT INTO interest (uid,rid,result) VALUES('$sid','$uid','1') ");
	$query = mysqli_query($db_conx,"UPDATE badges SET my_interest=my_interest+1 WHERE uid='$sid' ");
	$query1 = mysqli_query($db_conx,"UPDATE badges SET response=response+1 WHERE uid='$uid' ");
}
if($type == 'notInterested'){
	$query = mysqli_query($db_conx,"DELETE FROM interest WHERE uid='$sid' AND rid='$uid' ");
}
if($type == 'accept'){
	$query = mysqli_query($db_conx,"UPDATE interest SET result='3' WHERE uid='$uid' AND rid='$sid' ");
	$match = mysqli_query($db_conx,"UPDATE badges SET matches=matches+1 WHERE uid='$sid' ");
	$match1 = mysqli_query($db_conx,"UPDATE badges SET matches=matches+1 WHERE uid='$uid' ");

}
if($type == 'decline'){
	$query = mysqli_query($db_conx,"DELETE FROM interest WHERE uid='$uid' AND rid='$sid' ");
}

?>