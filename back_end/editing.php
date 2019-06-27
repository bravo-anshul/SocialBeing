<?php 
include_once '../ajax/headerAjax.php';
$uid = $_SESSION['uid'];
$name = $_POST['name'];
$uname = $_POST['uname'];
$pass = $_POST['pass'];
$age = $_POST['age'];
$college = $_POST['college'];
$gen = $_POST['gender'];

$check_uname = mysqli_query($db_conx,"SELECT uname FROM members WHERE uname = '$uname' ");
$count_uname = mysqli_num_rows($check_uname);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Editing</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" type="text/css" href="../css/universal.css">	
</head>
<body>
<div class="anshul">
	<img src="../images/icons/banner_2.png" width="100%"> 
</div>
</body>
</html>

<?php
if($count_uname>0){
	echo "<h3 style='text-align:center;' > Username alerady taken :( </h3>";
} 
else{
	if($name){
		$name = mysqli_query($db_conx,"UPDATE members SET name='$name' WHERE uid='$uid' ");
	}	
	if($uname){
		$_SESSION['uname'] = $uname;
		$uname = mysqli_query($db_conx,"UPDATE members SET uname='$uname' WHERE uid='$uid' ");
	}
	if($pass){
		$pass = mysqli_query($db_conx,"UPDATE members SET pass='$pass' WHERE uid='$uid' ");
	}
	if($age){
		$age = mysqli_query($db_conx,"UPDATE members SET age='$age' WHERE uid='$uid' ");
	}
	if($college){
		$college = mysqli_query($db_conx,"UPDATE members SET college='$college' WHERE uid='$uid' ");
	}			
	if($gen){
		$gen = mysqli_query($db_conx,"UPDATE members SET gender='$gen' WHERE uid='$uid' ");
	}	
	header('Location:../User-profile.php');
}

?> 