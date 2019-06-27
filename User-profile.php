<?php 
include_once "Header.php";

$uid = $_SESSION['uid'];
$uname = $_SESSION['uname'];

$post = $_GET['about']; 
if($post){
	$post = addslashes($post);
	$update = mysqli_query($db_conx,"UPDATE members SET about='$post' WHERE uid='$uid' ");
}

$user = mysqli_query($db_conx,"SELECT about FROM members WHERE uid='$uid' ");
$fetch = mysqli_fetch_array($user);
$about = $fetch['about'];
$query = mysqli_query($db_conx,"SELECT * FROM badges WHERE uid = '$uid' ");
$row = mysqli_fetch_array($query);
if($row>1){
	$response = $row['response'];
	if($response == 0 ){
		$response = null;
	}
	$interest = $row['my_interest'];
	if($interest == 0 ){
		$interest = null;
	}
	$match = $row['matches'];
	if($match == 0 ){
		$match = null;
	}
	$confess = $row['confess'];
	if($confess == 0 ){
		$confess = null; 
	}
	$target = $row['target'];
	if($target == 0 ){
		$target = null;
	}
}
$follow_query = mysqli_query($db_conx,"SELECT uid FROM follow WHERE rid='$uid' ");
$follow = mysqli_num_rows($follow_query);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
<link rel="stylesheet" type="text/css" href="css/user-profile.css?v=2">
<script type="text/javascript" src="script/editing.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	 var height = $(window).height();
	$("body,.button").css('font-size',height*0.022);

	$("#pencil").click(function(){
		$("#aboutModal").show();
	});
	$(".border").on('vmousedown',function(){
		$(this).css({'background-color':'#009688','color':'white'});
	});
	$(".border").on('vmouseup',function(){
		$(this).css({'background-color':'white','color':'black'});
	});
	$(".bar").on('vmousedown',function(){
		$(this).css({'background-color':'purple','color':'white'});
	});
	$(".bar").on('vmouseup',function(){
		$(this).css({'background-color':'white','color':'black'});
	});
});

</script>

</head>
<body>

<div class="anshul">
	<a href="Home.php"><img src="images/icons/banner_2.png" width="100%"></a>
</div>

<div class="w3-card-2" style="width:100%;padding:10px;border-radius:10px;">
	<header class="w3-container w3-indigo" >
	  <h3><?php echo $uname; ?></h3>
	</header>
	<div style="padding:5px;">
	  <div id="dp" >
	  	<div class="banner" onclick="crop('dp')">Edit</div><img src="images/Users/dp/<?php echo $uid; ?>.jpg?nocache=<?php echo time(); ?>"  width="100%" height="100%" >
	  </div>
	  <h3>About:-<img id="pencil" src="images/icons/pencil.png" style="float:right;margin-top:5px;"></h3>
	  <p style="font-family: 'Cinzel', serif;color:black;"><?php echo nl2br($about); ?></p>

	  <hr>
	  <div style="display:flex">
	  	<a href="Editing.php" class="w3-half center">Edit Profile</a>
	  	<div class="w3-half center"><?php echo $follow; ?></div>
	  </div>
	</div>
</div>

<div class="div">
	<a href="Activity.php?x=response" class="w3-half button border"><span id="response" class="badge w3-badge w3-red"><?php echo $response ; ?></span>Response</a>
	<a href="Activity.php?x=interest" class="w3-half button bar"><span id="interest" class="badge w3-badge w3-red"><?php echo $interest ; ?></span>My Interest</a>
</div>
<div class="div">
	<a href="Activity.php?x=match" class="w3-half button bar"><span id="match" class="badge w3-badge w3-red"><?php echo $match ; ?></span>Match</a>
	<a href="Inbox.php" class="w3-half button border">Inbox</a>
</div>
<div class="div">
	<a href="ActivityConfess.php?x=target" class="w3-half button border"><span id="confess" class="badge w3-badge w3-red"><?php echo $target ; ?></span>Target</a>
	<a href="ActivityConfess.php?x=myConfession" class="w3-half button bar"><span id="confess" class="badge w3-badge w3-red"><?php echo $confess; ?></span>Confession</a>
</div>

<!--Image cropper-->
<div id="id01" class="w3-modal ">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn">&times;</span>
    <form method="POST" enctype="multipart/form-data" action="Cropper.php"  >
      <p></p>
      <input id="type" type="hidden" name="category">
      <input type="file" id="image" name="image" required >
      <input type="submit" value="Upload Image" id="imageSubmit" onclick="uploadFile()">
      <progress id="progressBar" value="0" max="100" style="width:100%;"></progress>
      <h3 id="status"></h3>
      <p></p>
      <p style="width:100%;">Only '.jpg' AND '.jpeg' Are allowed.</p>
      <p style="width:100%;">Upload time depends on image size.</p>
    </form>
    </div>
  </div>
</div>

<!---Modal-->
<div id="aboutModal" class="w3-modal" >
  <div class="w3-modal-content w3-card-8" style="border-radius:5px;">
    <header class="w3-container w3-teal">
      <span onclick="document.getElementById('aboutModal').style.display='none'"
      class="w3-closebtn">&times;</span>
      </header>
      <form action="User-profile.php" method="GET">
      	<textarea name="about" maxlength="250"><?php echo $about ; ?></textarea><br>
      	<input class="w3-teal" type="Submit">
      </form>
  </div>
</div>

</body>
</html>