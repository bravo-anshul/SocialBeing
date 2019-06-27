<?php 
include_once "../ajax/headerAjax.php";

$pid = $_REQUEST['pid'];
$type = $_REQUEST['type'];

if($type == 'message'){
	$delete = mysqli_query($db_conx,"DELETE FROM messages WHERE mid='$pid' ");
}
elseif($type == 'post'){
	$delete = mysqli_query($db_conx,"DELETE FROM posts WHERE pid='$pid' ");
}	

?> 