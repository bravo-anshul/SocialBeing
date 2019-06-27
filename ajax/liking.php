<?php 
include_once "headerAjax.php";

$uid = $_SESSION['uid'];
$type = $_REQUEST['type'];
$pid = $_REQUEST['pid'];
$type = $_REQUEST['type'];

$like = mysqli_query($db_conx,"SELECT pid FROM likes WHERE pid='$pid' AND uid='$uid' ");
$likeCount = mysqli_num_rows($like);
if($likeCount > 0){
	$remove = mysqli_query($db_conx,"DELETE FROM likes WHERE pid = '$pid' AND uid = '$uid' ");
	$update = mysqli_query($db_conx,"UPDATE posts SET likes = likes-1 WHERE pid = '$pid' ");
	$query = mysqli_query($db_conx,"SELECT likes FROM posts WHERE pid = '$pid' ");
	$fetch = mysqli_fetch_array($query);
	$likes = $fetch['likes'];
	echo   '<div id="counter'.$pid.'" style="position:relative;">
				<img src="images/icons/bravo1.jpg" width="9%" class="unliked" onclick="liking('.$pid.')" >
				<div class="w3-teal counter"  >'.$likes.'</div>'.
				($type == 'myConfession' ? '<div class="w3-indigo delete" value='.$pid.'">DELETE</div>':'').'				
			</div>	';
}
else{
	$insert = mysqli_query($db_conx,"INSERT INTO likes (uid,pid) VALUES('$uid','$pid')");
	$update = mysqli_query($db_conx,"UPDATE posts SET likes = likes+1 WHERE pid = '$pid' ");
	$query = mysqli_query($db_conx,"SELECT likes FROM posts WHERE pid = '$pid' ");
	$fetch = mysqli_fetch_array($query);
	$likes = $fetch['likes'];	
	echo   '<div id="counter'.$pid.'" style="position:relative;">
				<img src="images/icons/bravo_comp.jpg" width="27%" class="liked" onclick="liking('.$pid.')" >
				<div class="w3-teal counter"  >'.$likes.'</div>'.
				($type == 'myConfession' ? '<div class="w3-indigo delete" value='.$pid.'">DELETE</div>':'').'				
			</div>	';
}
?> 