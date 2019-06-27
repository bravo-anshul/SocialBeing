<?php 
include_once '../ajax/headerAjax.php';

$name = $_POST['name'];
$uname = $_POST['uname'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$age = $_POST['age'];
$college = $_POST['college'];
$gen = $_POST['gender'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>BEING SOCIAL</title>
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

if (!empty($uname) && !empty($email) && !empty($pass) && !empty($name) && !empty($age) && !empty($college) && !empty($gen) ){
	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		if(strlen($pass)>6 || strlen($pass)<6){
			echo "<h3 style='text-align:center;' > Password must be of six digits :( </h3>";
			die();
		}
		$check_email = mysqli_query($db_conx,"SELECT email FROM members WHERE email='$email'");
 		if(!(mysqli_num_rows($check_email)>0)){
			$check_uname = mysqli_query($db_conx,"SELECT uname FROM members WHERE uname = '$uname' ");
			$count_uname = mysqli_num_rows($check_uname);
			if($count_uname>0){
				echo "<h3 style='text-align:center;' > Username alerady taken :( </h3>";
			} 
			else{
				$insert = mysqli_query($db_conx,"INSERT INTO members (uid , name , uname , email , pass , age , college , gender ) VALUES('', '$name', '$uname', '$email' , '$pass' , '$age' , '$college' , '$gen')");
				$query = mysqli_query($db_conx,"SELECT uid FROM members ORDER BY uid DESC LIMIT 1 ");
				$row = mysqli_fetch_array($query);
				$uid = $row['uid'];

				$badges = mysqli_query($db_conx,"INSERT INTO badges (uid,response,my_interest,matches,confess,target) VALUES('$uid',0,0,0,0,0)");
				$user_log = mysqli_query($db_conx,"INSERT INTO user_log (uid,browser,device,ip_addr,lastActive,DOR) VALUES('$uid',0,0,0,0,NOW()) ");
				$follow = mysqli_query($db_conx,"INSERT INTO follow (uid,rid) VALUES('$uid','$uid')");
				if($insert === TRUE && $badges === TRUE && $user_log === TRUE && $follow === TRUE ){
					$query = mysqli_query($db_conx,"SELECT uid,uname FROM members ORDER BY uid DESC LIMIT 1");
					$row = mysqli_fetch_array($query);
					$_SESSION['uid'] = $row['uid'];
					$_SESSION['uname'] = $row['uname'];
					echo '<script>location.href="../User-profile.php";</script>';
				}
				else{
					echo "<h3 style='text-align:center;' > Something went wrong .. Please try again. :( </h3>";
				}
			}
		}	
		else{
			echo "<h3 style='text-align:center;' > Email already registered. Use another Email :) </h3>";
		}
	}
	else{
		echo "<h3 style='text-align:center;' > Email is not in correct form :( </h3>";
	}

}
else{
	echo "<h3 style='text-align:center;' > Please fill out all the details. </h3>";
}

?>