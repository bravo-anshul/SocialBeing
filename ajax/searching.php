 <?php 
include_once "headerAjax.php";

$u = $_REQUEST['q'];
$c = $_REQUEST['c'];
$type = $_REQUEST['type'];
$count = $_REQUEST['count'];
$counter = $_REQUEST['counter'];

if($type == 'confess'){
	$number = mysqli_query($db_conx,"SELECT uid FROM members WHERE (name LIKE '$u%' OR uname LIKE '$u%') ");
	$loop = mysqli_num_rows($number);
}
else{
	$loop = 9;
}

if($c && $u){
	$query = mysqli_query($db_conx,"SELECT uname,name,college,age,uid FROM members WHERE (name LIKE '$u%' OR uname LIKE '$u%') AND college='$c'  ");
}
elseif($u){
	$query = mysqli_query($db_conx,"SELECT uname,name,college,age,uid FROM members WHERE (name LIKE '$u%' OR uname LIKE '$u%')  ");
}
elseif($c){
	$query = mysqli_query($db_conx,"SELECT name,age,uid FROM members WHERE college='$c' ORDER BY uid DESC ") ;
	if($count>=mysqli_num_rows($query)){
		echo 789456;
		die();
	} 
	for($x=0;$x<3;$x++){
		echo '<div style="display: flex;">';
		for($y=0;$y<3;$y++,$count++){
			mysqli_data_seek($query,$count);
			$row = mysqli_fetch_array($query);
			$uid = $row['uid'];
			$name = $row['name'];
			$age = $row['age'];
			if($uid == null){
				continue;
			}
			echo'<div class="w3-card-4 w3-half profile w3-third w3-animate-bottom">
					<a href="Profile.php?x='.$uid.'"><img class="img" src="images/Users/dp/'.$uid.'.jpg?nocache='.time().'" onerror="src=\'images/Users/default.png\'"></a>
					<p class="name">'.$name.'</p>
					<hr>
					<p class="name">'.$age.'</p>
				</div>' ;
		}
		echo '</div>';
	}
	die();
}

if($counter>=mysqli_num_rows($query)){
	echo 789456;
	die();
}
for($x=0;$x<$loop;$x++,$counter++){
	mysqli_data_seek($query,$counter);
	$row = mysqli_fetch_array($query);
	$name = $row['name']; 
	$uname = $row['uname']; 
	$age = $row['age'];
	$college = $row['college'];
	$uid = $row['uid'];
	if(!isset($uid)){
		continue;
	}
	echo 	''.($type!='confess'?'<a href="Profile.php?x='.$uid.'">':'<div onclick="value(\''.$uname.'\')" >').'<div class="w3-card-4 w3-light-grey w3-animate-bottom" style="padding:10px; border-radius:10px;margin:5px;">
					<header class="w3-container w3-teal" >
				  		<h3>'.$uname.'</h3>
					</header>
					<div style="display:flex">
						<div>
							<img style="border-radius:5px;" src="/images/Users/dp/'.$uid.'.jpg?nocache='.time().'" width="50%" onerror="src=\'images/Users/default.png\'" >
						</div>
						<div class="">
							<p>'.$name.'</p>
							<p>'.$college.'</p>
							<p id="exp" style="margin-bottom:0px;">'.$age.'</p>
						</div>
					</div>	
				</div>'.($type!='confess'?'</a>':'</div>').'';
} 

?>