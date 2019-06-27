 
<?php
include_once "headerAjax.php";
$email = $_REQUEST['email'];
$pass = $_REQUEST['pass'];

$query = mysqli_query($db_conx,"SELECT uid,uname FROM members WHERE email = '$email' AND pass = '$pass' ");
$count = mysqli_num_rows($query);
if($count > 0){
	$row = mysqli_fetch_array($query);
	$_SESSION['uid'] = $row['uid'];
	$_SESSION['uname'] = $row['uname'];

	$ip = $_SERVER['REMOTE_ADDR'];
	$device = $_SERVER['HTTP_REFERER'];
	$browser = $_SERVER['HTTP_USER_AGENT'];
	$uid = $_SESSION['uid'];

	$user_log = mysqli_query($db_conx,"UPDATE user_log SET ip_addr='$ip',device='$device',browser='$browser',lastActive=NOW() WHERE uid='$uid' ");
	echo '<script>location.href="Home.php";</script>' ;
	die();
}
else {
	echo "<p style='color:white'>Email or Password Wrong !</p><br>";
}
 


?>