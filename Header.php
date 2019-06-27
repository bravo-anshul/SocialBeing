<?php 
if(!isset($_SESSION)){
	session_start();
}
$db_conx = mysqli_connect("localhost", "social48_bravo", "Anshul267485", "social48_beingsocial","3306") or die ('Hmm, this is wierd, we are having issues connecting to our databases. Try again in a little bit, thank you!');
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="images/icons/logo_transparent1.png">
<meta name="viewport" content="width=device-width, initial-scale=1">	
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<script src="script/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="css/w3.css">
<script src="script/universal.js"></script>
<script src="script/touch.js"></script>	
<link rel="stylesheet" type="text/css" href="css/universal.css?v=2">
<script type="text/javascript">
	$(document).ready(function(){
		if($(window).width()>800){
			location.href="PC.php";
		}
	});
</script>
<style type="text/css">

</style>
</head>
<body>
<?php 
if (!isset($_SESSION['uid'])){
	echo '<div class="anshul">
			<img src="images/icons/banner_2.png" width="100%"> 
		</div>
			';
	echo "<hr>";
	echo "<h3 style='text-align:center;' > You are not logged in ... </h3>";
	echo "<h3 style='text-align:center;' > Log in here.. :) <a href='index.php'><img src='images/icons/home.png'></a></h3>";
	die();
}
$uid = $_SESSION['uid'];
$noti_query = mysqli_query($db_conx,"SELECT sid FROM notification WHERE rid='$uid' ");
$inboxNoti = mysqli_num_rows($noti_query);
if($inboxNoti == 0){
	$inboxNoti = null;
}
$target_query = mysqli_query($db_conx,"SELECT target FROM badges WHERE uid='$uid' ");
$fetch_target = mysqli_fetch_array($target_query);
$userNoti = $fetch_target['target'];
if($userNoti == 0){
	$userNoti = null;
}

?>
<div class="redirect" style="display: none;"><strong>Redirecting.....</strong></div>

<div id="hide"><img style="width:50%;" src="/images/icons/menu.png?v=1"></div>
<div id="show" class="w3-animate-right" >
	<div id="container">
		<div id="right" class="icon"><img width="100%" src="/images/icons/right.png"></div>
		<div class="icon"><a href="Home.php"><img width="60%" src="/images/icons/home.png?v=1"></a></div>
		<div class="icon"><a href="Match.php"><img width="60%" src="/images/icons/heart.png"></a></div>
		<div class="icon"><a href="Confession.php"><img width="60%" src="/images/icons/letter.png"></a></div>
		<div class="icon"><a href="Search.php"><img width="60%" src="/images/icons/group.png"></a></div>
		<div class="icon"><a href="Inbox.php"><img width="60%" src="/images/icons/inbox.png"></a></div>
		<div class="icon"><a href="User-profile.php"><img width="60%" src="/images/icons/users.png"></a></div>
		<div class="icon"><a href="Logout.php"><img width="60%" src="/images/icons/power.png"></a></div>
		<span id="inboxNoti" class="noti"><?php echo $inboxNoti; ?></span>
		<span id="userNoti"  class="noti"><?php echo $userNoti; ?></span>
	</div>
</div>	
</body> 
</html>