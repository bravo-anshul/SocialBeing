 <?php 
include_once "Header.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
<script type="text/javascript" src="script/search.js"></script>
<link rel="stylesheet" type="text/css" href="css/search.css">
</head>
<body>
<div class="anshul">
	<a href="Home.php"><img src="images/icons/banner_2.png" width="100%"></a>
</div>

<div style="display:flex;border-radius:5px;" class="w3-indigo">
	<div class="icon"><img width="60%" src="/images/icons/group.png"></div>
	<input id="name" class="w3-twothird w3-indigo input" type="text" placeholder="Name or Username (optional)">
</div>
<div style="display:flex;border:1px solid #3f51b5;border-radius:5px;margin-top:5px;"  >
	<input list="college" name="college" id="option" class="input w3-indigo w3-half" value="T.I.T" placeholder="College (optional)">
	    <datalist id="college">
		    <option value="T.I.T">
		    <option value="L.N.C.T">
		    <option value="Oriental">
			<option value="Truba">
		    <option value="Coorporate">
	    </datalist>
	<div class="button w3-half" >Search</div>
</div>

<hr>

<div id="result1">
	<span id="result"></span>
</div>
	
<br>
<img id="spiner" src="images/icons/spiner.gif" >
<div class="load w3-half" >Load more</div>
<script type="text/javascript">
	search();
</script>
</body>
</html>