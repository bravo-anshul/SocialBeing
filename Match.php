<?php 
include_once "Header.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Match</title>
<meta name="theme-color" content="#2c3e50">
<script type="text/javascript" src="script/match.js"></script>
<link rel="stylesheet" type="text/css" href="css/match.css">
</head>
<body>

<div id="loader">
	<img style="margin-top:70%;" src="images/icons/heart.gif">
	<img style="margin-top:70%;" src="images/icons/heart_black.gif">
</div>

<div id="option" class="w3-indigo" style="display:flex;padding:10px;">
	<select id="gender" class="w3-indigo w3-third input">
	  <option class="w3-indigo" value="m">Male</option>
	  <option class="w3-indigo" value="f">Female</option>
	</select>
	<select id="age" class="w3-indigo w3-third input">
	  <option class="w3-indigo" value="16">16</option>
	  <option class="w3-indigo" value="17">17</option>
	  <option class="w3-indigo" value="18" selected>18</option>
	  <option class="w3-indigo" value="19">19</option>
	  <option class="w3-indigo" value="20">20</option>
	  <option class="w3-indigo" value="21">21</option>
	  <option class="w3-indigo" value="22">22</option>
	</select>
	<input list="college" value="T.I.T" class="w3-indigo w3-third input" id="c1" placeholder="College" required>
	     <datalist id="college">
		    <option value="T.I.T">
		    <option value="L.N.C.T">
		    <option value="Oriental">
		    <option value="Truba">
		    <option value="Coorporate">
	     </datalist> 
</div>
<div id="search" class="button" onclick="match()" >Search :)</div>

<span id="result1"></span>

<!---------------->
<div id="navigation" style="display:flex;">
	<div class="w3-third img" id="bravo" ><img id="bravo1" src="images/icons/bravo1.jpg" style="width:100%;height:auto;" ></div>
	<div class="w3-third img" ><img id="cross" src="images/icons/cross.png" style="width:100%;height:auto;" ></div>
	<div class="w3-third img" id="reveal"><span></span></div>
</div>


</body>
</html>