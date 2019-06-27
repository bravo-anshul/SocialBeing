<?php 
include_once "headerAjax.php";

$sid = $_SESSION['uid'];
$college = $_REQUEST['college'];
$age = $_REQUEST['age'];
$gender = $_REQUEST['gender'];

$responseId = $_REQUEST['uid'];
$type = $_REQUEST['type'];

if($responseId && $type){
	if($type == 'interested'){
		$check = mysqli_query($db_conx,"SELECT uid FROM interest WHERE uid='$responseId' AND rid='$sid' AND result='1' ");
		if(mysqli_num_rows($check)>0){
			$update = mysqli_query($db_conx,"UPDATE interest SET result='3' WHERE uid='$responseId' AND rid='$sid' ");
			$match = mysqli_query($db_conx,"UPDATE badges SET matches=matches+1 WHERE uid='$sid' ");
			$match1 = mysqli_query($db_conx,"UPDATE badges SET matches=matches+1 WHERE uid='$responseId' ");
		}
		else{
			$insert = mysqli_query($db_conx,"INSERT INTO interest(uid,rid,result) VALUES('$sid','$responseId','1') ");
			$query = mysqli_query($db_conx,"UPDATE badges SET my_interest=my_interest+1 WHERE uid='$sid' ");
	        $query1 = mysqli_query($db_conx,"UPDATE badges SET response=response+1 WHERE uid='$responseId' ");
		}
	}
	elseif($type == 'notInterested'){
		$check = mysqli_query($db_conx,"SELECT uid FROM interest WHERE uid='$responseId' AND rid='$sid' AND result='1' ");
		if(mysqli_num_rows($check)>0){
			$update = mysqli_query($db_conx,"UPDATE interest SET result='2' WHERE uid='$responseId' AND rid='$sid' ");
		}
		else{
			$insert = mysqli_query($db_conx,"INSERT INTO interest(uid,rid,result) VALUES('$sid','$responseId','2') ");
		}
	}
}

$user_id = mysqli_query($db_conx,"SELECT uid FROM members WHERE members.uid NOT IN 
								  (SELECT interest.uid FROM interest WHERE interest.rid='$sid' AND interest.result='3')
								  AND members.uid NOT IN (SELECT interest.rid FROM interest WHERE interest.uid='$sid') 
								  AND members.uid!='$sid' AND age='$age' AND college='$college' AND gender='$gender' LIMIT 1 ");

$fetch = mysqli_fetch_array($user_id);
$uid = $fetch['uid'];

if($uid){
	$user = mysqli_query($db_conx,"SELECT uname,name,age,college,about FROM members WHERE uid = '$uid' ");
	$row = mysqli_fetch_array($user);
	$uname = $row['uname'];
	$name = $row['name'];
	$user_college = $row['college'];
	$user_age = $row['age'];
	$about = $row['about'];

	echo '  <div class="w3-card-4" style="padding:10px; min-height:400px; border-radius:10px;">
				<header class="w3-container w3-teal" style="margin-bottom:5px;border-radius:5px;">
			  		<h3><a href="Profile.php?x='.$uid.'"<span>'.$uname.'</span></a></h3>
				</header>
				<div style="display:flex">
					<div class="w3-half">
						<img id="userId" src="images/Users/dp/'.$uid.'.jpg?nocache='.time().'"  width="100%" onerror="src=\'images/Users/default.png\'" height="auto" value='.$uid.' >
					</div>
					<div class="w3-half">
						<p>'.$name.'</p>
						<p>'.$age.'</p>
						<p>'.$college.'</p>
						<div id="pic" class="button">View More Pictures</div>
					</div>
				</div>	
				<hr>
				<h4>About:-</h4>
				<p style="text-align:left;font-family: \'Cinzel\', serif;">'.nl2br($about).'</p>
			</div>
			<div id="modal" class="w3-modal">
			  <div class="w3-modal-content w3-card-8" style="border-radius:5px;">
			    <header class="w3-container w3-teal">
			      <span onclick="document.getElementById(\'modal\').style.display=\'none\'"
			      class="w3-closebtn">&times;</span>
			      </header>
			    <div style="display:flex">
					<div class="pictures w3-third"><img src="/images/Users/1/'.$uid.'.jpg?nocache='.time().'" height="auto" onerror="src=\'images/Users/default.png\'" width="100%"></div>
					<div class="pictures w3-third"><img src="/images/Users/2/'.$uid.'.jpg?nocache='.time().'" height="auto" onerror="src=\'images/Users/default.png\'" width="100%"></div>
					<div class="pictures w3-third"><img src="/images/Users/3/'.$uid.'.jpg?nocache='.time().'" height="auto" onerror="src=\'images/Users/default.png\'" width="100%"></div>
				</div>	
				<div style="display:flex">
					<div class="pictures w3-third"><img src="/images/Users/4/'.$uid.'.jpg?nocache='.time().'" height="auto" onerror="src=\'images/Users/default.png\'" width="100%"></div>
					<div class="pictures w3-third"><img src="/images/Users/5/'.$uid.'.jpg?nocache='.time().'" height="auto" onerror="src=\'images/Users/default.png\'" width="100%"></div>
					<div class="pictures w3-third"><img src="/images/Users/6/'.$uid.'.jpg?nocache='.time().'" height="auto" onerror="src=\'images/Users/default.png\'" width="100%"></div>
				</div>	
			  </div>
			</div>';
}
else{
	echo 789456;
}
/*SELECT uid FROM members WHERE members.uid NOT IN 
								  (SELECT interest.uid FROM interest WHERE interest.rid='$sid' AND interest.result='3')
								  AND members.uid NOT IN (SELECT interest.rid FROM interest WHERE interest.uid='$sid') 
								  AND members.uid!='$sid' AND age='$age' AND college='$college' AND gender='$gender' LIMIT 1 ")*/
?>
