<?php 
include_once "Header.php";

$uid = $_SESSION['uid'];
$uname = $_SESSION['uname'];

$query = mysqli_query($db_conx,"SELECT name,uname,college,age,gender FROM members WHERE uid='$uid'");
$row = mysqli_fetch_array($query);
$name = $row['name'];
$age = $row['age'];
$college = $row['college'];

?>
   
<!DOCTYPE html> 
<html>
<head> 
	<title>Edit</title>
<link rel="stylesheet" type="text/css" href="css/editing.css?v=1">
<script type="text/javascript" src="script/editing.js"></script>

</head>
<body >
<h3 class="w3-teal">Edit-Profile</h3>
<div id="image_holder" class="w3-card-4">
	
<div id="dp" class="w3-center pictures">
	<div class="banner" onclick="crop('dp')">Edit</div><img src="/images/Users/dp/<?php echo $uid;?>.jpg?nocache=<?php echo time(); ?>" width="100%" height="auto">
</div>	
<div style="display:flex">
	<div class="pictures w3-third"><div class="banner" onclick="crop('1')">Edit</div><img src="/images/Users/1/<?php echo $uid;?>.jpg?nocache=<?php echo time(); ?>" height="auto" width="100%"></div>
	<div class="pictures w3-third"><div class="banner" onclick="crop('2')">Edit</div><img src="/images/Users/2/<?php echo $uid;?>.jpg?nocache=<?php echo time(); ?>" height="auto" width="100%"></div>
	<div class="pictures w3-third"><div class="banner" onclick="crop('3')">Edit</div><img src="/images/Users/3/<?php echo $uid;?>.jpg?nocache=<?php echo time(); ?>" height="auto" width="100%"></div>
</div>	
<div style="display:flex">
	<div class="pictures w3-third"><div class="banner" onclick="crop('4')">Edit</div><img src="/images/Users/4/<?php echo $uid;?>.jpg?nocache=<?php echo time(); ?>" height="auto" width="100%"></div>
	<div class="pictures w3-third"><div class="banner" onclick="crop('5')">Edit</div><img src="/images/Users/5/<?php echo $uid;?>.jpg?nocache=<?php echo time(); ?>" height="auto" width="100%"></div>
	<div class="pictures w3-third"><div class="banner" onclick="crop('6')">Edit</div><img src="/images/Users/6/<?php echo $uid;?>.jpg?nocache=<?php echo time(); ?>" height="auto" width="100%"></div>
</div>	

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

<hr>
<!--<h3 style="text-align:left;color:black">Details :-</h3>-->
<div class="button" onclick="$('#details').show();$(this).hide();">Details</div>

<div class="w3-animate-bottom" id="details" style="display: none;">
	<form method="POST" action="back_end/editing.php">
		<p>Name :-</p>
		<input class="input" name="name" type="text" onkeyup="clean('name')" placeholder="<?php echo $name; ?>" >

		<p>User-Name :- </p>
		<input class="input" name="uname" type="text" maxlength="15" id="uname"  onkeyup="clean('uname')" placeholder="<?php echo $uname; ?>" ><br>
		<span class="span" id="uname_span"></span>

		<p>Password :-</p>
		<input class="input"  name="pass" id="pass1" type="password" onkeyup="clean('pass1')" maxlength="6" minlength="6">

		<p>Re-Enter :-</p>
		<input class="input" id="pass2" onkeyup="clean('pass2')"  type="password" maxlength="6" minlength="6"><br>
		<span class="span" id="pass_span"></span>

		<p>Age :-</p>
	    <input class="input"id="age" type="text" name="age" onkeyup="clean('age')" maxlength=2 placeholder="<?php echo $age; ?>">

		<p>College :-</p>
		<input class="input" list="college" name="college" placeholder="Specify or Select ">
		  <datalist id="college">
		    <option value="T.I.T">
		    <option value="L.N.C.T">
		    <option value="Oriental">
		    <option value="Truba">
		    <option value="Coorporate">
		  </datalist>

		<input class="button" type="submit" >
	</form>
</div>
</body>
</html>