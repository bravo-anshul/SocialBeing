<?php 
include_once "headerAjax.php";

$sid = $_SESSION['uid'];
$noFilter = $_REQUEST['all'];
$filter = $_REQUEST['filter'];

if(isset($noFilter)){
	$selectCollege = mysqli_query($db_conx,"SELECT college FROM members WHERE uid = '$sid' ");
	$row = mysqli_fetch_array($selectCollege);
	$college = $row['college'];
	$number = $noFilter;
	$query = mysqli_query($db_conx,"SELECT * FROM posts WHERE college = '$college' ORDER BY time DESC ");
}	
elseif(isset($filter)){
	$number = $filter;
	$query = mysqli_query($db_conx,"SELECT posts.* from posts,follow where (posts.uid=follow.rid or posts.targetId=follow.rid) AND follow.uid='$sid' and identity=1 
									UNION 
									select posts.* from posts,follow where posts.targetId=follow.rid and follow.uid='$sid' and identity = 2 order by time desc");
}
$count = mysqli_num_rows($query);
 
if($number<$count){
	for($y=0;$y<10;$y++,$number++){
		mysqli_data_seek($query,$number);
		$fetch = mysqli_fetch_array($query);
		$id = $fetch['identity'];
		$targetName = $fetch['targetName'];
		$targetId = $fetch['targetId'];
		$body = $fetch['body'];
		$pid = $fetch['pid'];
		$likes = $fetch['likes'];
		$uid = $fetch['uid'];
		$uname = $fetch['uname'];
		
		$like = mysqli_query($db_conx,"SELECT pid FROM likes WHERE uid = '$sid' AND pid = '$pid' ");
		$status = mysqli_num_rows($like);

		if($status>0){
			$string = '<img src="images/icons/bravo_teal.png" width="9%" class="liked" onclick="liking('.$pid.')" >';
		}
		else{
			$string = '<img src="images/icons/bravo1.jpg" width="9%" class="unliked" onclick="liking('.$pid.')" >';
		}

		if($uid){
			echo'<div>
					<div class="w3-card-4" style="padding:5px;border-radius:7px;margin-top:20px" >
						<div style="display:flex">
							<div class="w3-third" id="dp">
								'.($id==1 ? '<a href="Profile.php?x='.$uid.'"><img src="images/Users/dp/'.$uid.'.jpg?nocache='.time().'" class="img" width="100%" height="auto" onerror="src=\'images/Users/default.png\'"></a>' :
								           '<img src="images/icons/anonymous.png" class="img" width="100%" height="auto">' ).'
							</div>
							<div class="w3-third" id="middle">
								'.($id==1 ? '<a href="Profile.php?x='.$uid.'"><p>'.$uname.'</p></a>' :
									        '<p>Anonymous</p>'  ).'
								<img src="images/icons/target.png" id="target">
								<a href="Profile.php?x='.$targetId.'"><p>'.$targetName.'</p></a>
							</div>
							<div class="w3-third" id="dp">
								<a href="Profile.php?x='.$targetId.'"><img src="images/Users/dp/'.$targetId.'.jpg?nocache='.time().'" class="img" width="100%" height="auto" onerror="src=\'images/Users/default.png\'"></a>
							</div>
						</div>	
						<p id="text">'.$body.'</p>
						<hr class="hr">
						<div id="counter'.$pid.'" style="position:relative;">
							'.$string.'
							<div class="w3-teal counter"  >'.$likes.'</div>
						</div>	
					</div>					
		        </div>';
		}        
	}
}
else {
	echo 789456;
}

?> 