<?php 
include_once "Header.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Confession</title> 

<link rel="stylesheet" type="text/css" href="css/confession.css">
<script src="script/confession.js?v=1"></script>
</head>

<body> 
<div class="anshul">
	<a href="Home.php"><img src="images/icons/banner_2.png" width="100%"></a>
</div>

<div class="w3-card-4" style="display:flex;border-radius:5px;margin:10px;">
	<div id="add_post" class="button w3-half">Add Post</div>
	<a href="Filter.php" id="FilterPost" class="button w3-half" style="border-color:purple;">Following</a>
	<div id="noFilterPost" class="button w3-half" style="border-color:purple;display:none">College</div>
</div>

<span id="noFilter"></span>
<img id="spiner" src="images/icons/spiner.gif" > 
<div id="loader" class="button" onclick="noFilter()"><p>Load More</p></div>

<div id="modal" class="w3-modal">
  <div class="w3-modal-content w3-card-8" style="border-radius:5px;">
     <form class="w3-teal" name="posting" method="POST" action="back_end/posting.php">
		<span id="close" class="w3-closebtn">&times;</span>
		<div style="display:flex">
			<select class="w3-teal" id="identity" name="identity" >
			    <option class="w3-teal" selected value="2"> Anonymous </option>
			    <option class="w3-teal" value="1"> Username </option>
			</select>
			<input type="text" name="target" id="hint" class="w3-half w3-teal" placeholder="Target" required>
		</div>	
		<span id="result"></span>
		<hr>
		<textarea name="post" id="post" maxlength="400">Your feeelings Here.... :) </textarea>
		<hr>
		<input type="submit" class="w3-teal">
	 </form>
	</div>
  </div>
</div>

<div class="posting"><strong>Posting......</strong></div>

</body>
</html>