 
<?php
include_once "headerAjax.php";

$data = $_REQUEST['q'];
$type = $_REQUEST['t'];
if($type == "uname"){
	$query = mysqli_query($db_conx,"SELECT * FROM members WHERE uname = '$data' ");
	$count = mysqli_num_rows($query);
	if($count > 0){
		echo "<span style='color:#f44336;'>username already taken :(</span>";
	}
	else{
		echo "<span style='color:green'> username OK :)</span>";
	}
}
if($type == "email"){
	$query = mysqli_query($db_conx,"SELECT * FROM members WHERE email LIKE '%$data%' ");
	$count = mysqli_num_rows($query);
	if($count > 0){
		echo "<span style='color:#f44336;'>Email already registered :(</span>";
	}
	else{
		echo "<span style='color:green'>Email OK :)</span>";
	}
}

?>
