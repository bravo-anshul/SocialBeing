<?php 

include_once "ajax/headerAjax.php";

$uid = $_SESSION['uid'];

if(isset($_POST['cropx'])){
  $category = $_POST['category'];
  $ext = $_POST['ext'];
  $name = $_POST['name'];
    $new = "images/Users/$category/$uid.jpg";
    $add = "images/Users/$category/$uid.jpg";
  $src = imagecreatefromjpeg("images/resized_$name");
  $tmp = imagecreatetruecolor(160,220);
  imagecopyresampled($tmp, $src, 0, 0, $_POST['cropx'], $_POST['cropy'] , 160, 220, $_POST['cropw'] ,$_POST['croph'] );
  imagejpeg($tmp , $new,90);
  unlink("images/resized_$name");
  echo '<script>location.href="Editing.php";</script>' ;
}


?>

