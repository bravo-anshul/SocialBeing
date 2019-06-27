<?php 
include_once "headerAjax.php";
$sid = $_SESSION['uid'];
$count = $_REQUEST['count'];
$type = $_REQUEST['type'];

if($type == 'myConfession'){
	$query = mysqli_query($db_conx,"SELECT * FROM posts WHERE uid='$sid' ORDER BY time DESC ");
}	
elseif($type == 'target'){
	$query = mysqli_query($db_conx,"SELECT * FROM posts WHERE targetId='$sid' ORDER BY time DESC ");
}
$total = mysqli_num_rows($query);

if($count<$total){
	for($x=0;$x<10;$x++,$count++){
		mysqli_data_seek($query,$count);
		$fetch = mysqli_fetch_array($query);
		$id = $fetch['identity'];
		$targetName = $fetch['targetName'];
		$targetId = $fetch['targetId'];
		$body = $fetch['body'];
		$pid = $fetch['pid'];
		$likes = $fetch['likes'];
		$uid = $fetch['uid'];
		$uname = $fetch['uname'];
		
		$like = mysqli_query($db_conx,"SELECT pid FROM likes WHERE uid='$sid' AND pid='$pid' ");
		$status = mysqli_num_rows($like);

		if($status>0){
			$string = '<img src="images/icons/bravo_teal.png" width="9%" class="liked" onclick="liking('.$pid.')" >';
		}
		else{
			$string = '<img src="images/icons/bravo1.jpg" width="9%" class="unliked" onclick="liking('.$pid.')" >';
		}

		if($uid){
			echo'<div>
					<div class="w3-card-4" style="padding:5px;border-radius:7px; margin-top:10px;">
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
					<div id="counter'.$pid.'" style="position:relative;">
						'.$string.'
						<div class="w3-teal counter" >'.$likes.'</div>'.
						($type == 'myConfession' ? '<div class="w3-indigo delete" value='.$pid.'">DELETE</div>':'').'
					</div>	
					</div>
		        </div>';
		}    
    }
}
else {
	echo "<h3 style='text-align:center;' > No More Posts :( </h3>";
}
?>