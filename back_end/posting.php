<?php 

include_once "../ajax/headerAjax.php";

$uid = $_SESSION['uid'];
$targetName = $_POST['target'];
$identity = $_POST['identity']; 
$body = $_POST['post'];

if(empty($uid)){
	echo "U must log in";
	die();
}

$ip = $_SERVER['REMOTE_ADDR'];
$device = $_SERVER['HTTP_USER_AGENT'];

$college_selector = mysqli_query($db_conx,"SELECT college,uname FROM members WHERE uid = '$uid'");
$row = mysqli_fetch_array($college_selector);
$college = $row['college'];
$uname = $_SESSION['uname'];
$targetQuery = mysqli_query($db_conx,"SELECT uid FROM members WHERE uname = '$targetName'");

if(mysqli_num_rows($targetQuery)>0){
	$fetch = mysqli_fetch_array($targetQuery);
	$targetId = $fetch['uid'];
	$tar = mysqli_query($db_conx,"UPDATE badges SET target = target+1 where uid = '$targetId' ");
	$confess = mysqli_query($db_conx,"UPDATE badges SET confess=confess+1 WHERE uid='$uid' ");
}
else{
	$targetId = 0;
}
$body = addslashes($body);
$query = mysqli_query($db_conx,"INSERT INTO posts (pid , uid , targetName , targetId , identity , body , likes , college , uname) VALUES('' , '$uid' ,'$targetName' ,$targetId ,'$identity','$body','0','$college','$uname') ");
$backup = mysqli_query($db_conx,"INSERT INTO post_backup (uid,pid,body,targetName,targetId,device,ip_addr) VALUES('$uid','','$body','$targetName','$targetId','$device','$ip') ");
if($query === TRUE){
	echo '<script>location.href="../Confession.php";</script>' ;
}
else{
	echo "<h3 style='text-align:center;'>Something Went Wrong Please try again :(</h3>";
}

?> 