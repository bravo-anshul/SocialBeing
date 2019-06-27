<?php 
session_start(); 
$uid = $_SESSION['uid'];

function img_resize($target, $newcopy, $w, $h,$name,$ori) {
	$img = imagecreatefromjpeg($target);
	if($ori == 8 || $ori == 6 || $ori == 3) {
	    switch($ori) {
	        case 8:
	            $img = imagerotate($img,90,0);
	            break;
	        case 3:
	            $img = imagerotate($img,180,0);
	            break;
	        case 6:
	            $img = imagerotate($img,-90,0);
	            break;
	    }
	    imagejpeg($img,"images/rotate_$name");
	    $target = "images/rotate_".$name;
	}
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    } else {
           $h = $w / $scale_ratio;
    } 
    echo $ori;
    $tci = imagecreatetruecolor($w, $h);
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    imagejpeg($tci, $newcopy, 100);
    unlink("images/$name");
    unlink($target);
}

$name = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];
$exif = exif_read_data($_FILES['image']['tmp_name']);
$ori = $exif['Orientation'];
$size = $_FILES['image']['size'];
$loc = "images/";
$category = $_POST['category'];
$width1 = 160;
$height1 = 220;
$boom = explode('.', $name);
$fileExtn = end($boom);
$fileExtn = strtolower($fileExtn);


if(move_uploaded_file($tmp_name, $loc.$name)){
	list($width,$height) = getimagesize($tmp_name);
	$target ="images/".$name;
	$new = "images/resized_$name";
	$rotate_name = "images/rotate_$name";
	img_resize($target,$new,1000,1000,$name,$ori);

}
elseif(!isset($tmp_name)){
	echo "<h3 style='text-align:center; font-size:3vh;' > Please Select a file. :) </h3>";
	die();
}

elseif($fileExtn!='jpg'&&$fileExtn!='jpeg'){
	echo "<h3 style='text-align:center; font-size:3vh;' > Only Images are allowed. :) </h3>";
	die();
}

else{
	echo "<h3 style='text-align:center; font-size:3vh;' > Something went Wrong please try again :( </h3>";
	die();
}	

?>

<!DOCTYPE html>
<html>
<head>
<script src="script/jquery.js"></script>
<script src="script/jquery.Jcrop.min.js"></script>
<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<title>Image Cropper</title>
<style type="text/css">
	input[type="submit"]{
		display: block;
		margin:0 auto;
		padding:5px 45px;
		border:0px;
		border-radius: 10px;
		color:white;
		background-color: #3498db;
		font-size: 3vh;
	}
	input[type='submit']:enabled{
		background-color: #3498db;
	}
	input[type="submit"]:disabled{
		background-color: grey;
	}
	.header{
		margin-top: 5%;
		font-size: 3vh;
		padding:5px;
		text-align: center;
		color:white; 
		font-family: 'Lobster',sans-serif;	
	}
	#img{
		margin-top: 5%;
		margin-bottom: 5%;
	}	
</style>
<script type="text/javascript">
$(document).ready(function(){
	$("button").click(function(){
		$("img").css("transform","rotatez(90deg)");
	});
	$("#target").Jcrop({
		setSelect: [ 0,0,<?php echo $width1 ?>,<?php echo $height1 ?> ],
		opactiy:0.8,
		canDrag:false,
		aspectRatio:<?php echo $width1 ?>/<?php echo $height1 ?>,
		onSelect: updatecords,
		onChange: updatecords 
	});
	function updatecords(c){
	  $('#cropx').val(c.x);
	  $('#cropy').val(c.y);
	  $('#cropw').val(c.w);
	  $('#croph').val(c.h);
	};
});
function active(){
	$("input[type='submit']").prop('disabled',false);
}
</script>
</head>
<body>
	<header class="w3-teal header">Image Cropper</header>

	<div id="img"><img src="<?php echo "images/resized_$name" ?>" id="target" onload="active()" /></div>
	<div id="container">
		<form action="Thumbnail.php" method="POST" id="myform">
		  <input type="hidden" name="cropx" id="cropx" value="0" />
		  <input type="hidden" name="cropy" id="cropy" value="0" />
		  <input type="hidden" name="cropw" id="cropw" value="0" />
		  <input type="hidden" name="croph" id="croph" value="0" />
		  <input type="hidden" name="ext"   id="ext"  value="<?php echo $fileExtn ?>">
		  <input type="hidden" name="name"   id="name1"  value="<?php echo $name ?>">
		  <input type="hidden" name="target"  value="<?php echo $target ?>">
		  <input type="hidden" name="height"   id="height"  value="<?php echo $height ?>">
		  <input type="hidden" name="width"   id="width"  value="<?php echo $width ?>">
		  <input type="hidden" name="category" id="category" value="<?php echo $category ?>">
 		
		  <input type="submit" value="Save" disabled />
		</form>
	</div>


</body>
</html>