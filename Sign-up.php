<!DOCTYPE html>
<html>
<head>
	<title>Sign-up</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#2c3e50">
<link rel="stylesheet" type="text/css" href="css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<script src="script/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var window_size = $(document).height();
	var height = $(window).height();
	$(".input,.hint,input[type='radio'],input[type='checkbox']").css('height',height*0.040);
	$('p,span,input[type="submit"]').css('font-size',height*0.025);
	$('.input').css('font-size',height*0.022);
	$('h1').css('font-size',height*0.05);
	$("body").css('height',window_size+50);
	//$('.input').css('font-size',height*0.028);

	$("#uname").focusout(function(){
		var string = $("#uname").val();
		if(string.length>0){
			$("#uname_span").load("ajax/sign_up.php?q="+string+"&t=uname");
		}
	});
	$("#email").focusout(function(){
		var string = $("#email").val();
		if(string.length>0){
			$("#span_email").load("ajax/sign_up.php?q="+string+"&t=email");
		}
	}); 
	$("#pass2").focusout(function(){
		var x = $("#pass1").val();
		var y = $("#pass2").val();
		if((x) && (y)){
			var match = $("#pass1").val();
			var mat = $("#pass2").val();
			if(mat == match){
				$("#pass_span").html("<span style='color:green'>Password Matches :)</span>");
			}
			else{
				$("#pass_span").html("<span style='color:#f44336;'>Password do not Match :(</span>");
			}
		}	
	});
	$(".close").click(function(){
		$(".info").hide();
	})
});
function clean(type){
	if(type == "pass1" || type == "pass2"){
		var textfield = document.getElementById(type);
		var regex = /[^1-9]/gi;
		if(textfield.value.search(regex) > -1) {
			textfield.value = textfield.value.replace(regex, "");
	    }
    } 
    if(type == "uname"){
    	var textfield = document.getElementById(type);
		var regex = /[^a-z0-9!_#]/gi;
		if(textfield.value.search(regex) > -1) {
			textfield.value = textfield.value.replace(regex, "");
	    }
    }
    if(type == 'age'){
    	var textfield = document.getElementById(type);
		var regex = /[^0-9]/gi;
		if(textfield.value.search(regex) > -1) {
			textfield.value = textfield.value.replace(regex, "");
	    }
    }
}
function check(){
	if($("#checkbox").is(':checked')){
		$("input[type='submit']").prop('disabled',false);
	}
	else{
		$("input[type='submit']").prop('disabled',true);
	}	
}
function info(string){
	$(".info").hide();
	$("#"+string).show();
}
</script>
<style type="text/css">
	body{
		padding: 5px;
		background: linear-gradient(#2c3e50,#3498db,#45ADA8,#547980, #594F4F);
	}
	p{
		position: relative;
		color: white;
		font-weight: 15px;
		font-family: 'Cinzel', serif;
		margin:5px;
		margin-left:12%;
	}
	h1{
		font-family: "Lobster", serif;
		text-align: center;
		color:white;
	}
	input[type="submit"]{
		display: block;
		margin:0 auto;
		margin-top: 15px;
		padding:5px 45px;
		border:0px;
		border-radius: 10px;
		color:white;
	}
	input[type='submit']:enabled{
		background-color: #3498db;
	}
	input[type="submit"]:disabled{
		background-color: grey;
	}
	input[type="radio"]{
		margin-left: 12%;
	}
	input[type="checkbox"]{
		margin-left: 12%;
	}
	hr{
		margin:5px;
	}
	.hint{
		z-index: 3;
		margin-left: 5%;
	}
	.info{
		display: none;;
		padding: 5px;
		padding-top: 15px;
		position: absolute;
		margin-bottom: 50px;
		background:url("images/icons/darkbg.png");
		border-radius: 5px;
		color:white;
		width:97%;
		top:12%;
		z-index: 2;
	}
	.info_text{
		font-family: 'Raleway',sans-serif;
		margin-left: 5px;
	}
	.radio{
		margin-left: 5px;
		margin-bottom: 5px;
		color:white;
		font-family: 'Cinzel', serif;
	}
	.input{
		outline: none;
		padding:5px;
		width: 70%;
		border-radius: 25px;
		border:0px ;
		margin-left:12%;
		font-family: 'Cinzel',sans-serif;
	}
	.form{
		margin:auto;
		padding:5px;
	}
	.span{
		margin-left: 12%;
		font-size: 'Raleway' , sans-serif;
		color:white;
	}
	.close{
		float: right;
		margin-right: 5px;
		font-weight: 900;
	}
	#terms{
		margin-left:5px;
		margin-top:0px;
		font-family: sans-serif;
		color:white;
	}
</style>
</head>
<body>
<h1>Sign-Up</h1>
<div>
	<form class="form " action="back_end/creation.php" method="POST" autocomplete="on">
		<p>Name</p>
		<input class="input" name="name" type="text" required onkeyup="clean('name')" maxlength="20"  autofill>

		<p>User-Name <img onclick="info('usernameInfo')" src="images/icons/hint.png" class="hint"> </p>
		<input class="input" name="uname" type="text" maxlength="15" id="uname" required  onkeyup="clean('uname')" autofill >
		<span class="span" id="uname_span"></span>
		
		<p>Email </p>
		<input class="input" id="email" type="email" name="email" required autofill>
		<span class="span" id="span_email"></span>

		<p>Password <img onclick="info('passwordInfo')" src="images/icons/hint.png" class="hint"></p>
		<input class="input"  name="pass" id="pass1" type="password" onkeyup="clean('pass1')" maxlength="6" minlength="4" required>

		<p>Re-Enter</p>
		<input class="input" id="pass2" onkeyup="clean('pass2')"  type="password" maxlength="6" minlength="4" required>
		<span class="span" id="pass_span"></span>

		<p>Age</p>
        <input class="input" id="age" type="text" name="age" required onkeyup="clean('age')" maxlength=2>

		<p>College <img onclick="info('collegeInfo')" src="images/icons/hint.png" class="hint"></p>
		<input class="input" list="college" name="college" placeholder="Specify or Select " required>
	     <datalist id="college">
		    <option value="T.I.T">
		    <option value="L.N.C.T">
		    <option value="Oriental">
		    <option value="Truba">
		    <option value="Coorporate">
	     </datalist>

		<p>Gender</p>
		<div style="display:flex"><input type="radio" name="gender" value="m" required><span class="radio">Male</span><input type="radio" name="gender" value="f"><span class="radio">Female</span></div>
	    <br>
	    <div style="display:flex"><input type="checkbox" onclick="check()" id="checkbox" value="true"><p id="terms">I agree with the <a href="#" onclick="info('termsInfo')">Terms & Conditions.</a></p></div>
		<input type="submit" disabled>
	</form>
</div>	
<div id="usernameInfo" class="info"><span class="info_text">User-NAME:<span class="close">X</span></span><hr><span class="info_text">1). Must be Unique.<br>2). Can be 15 characters long.<br>3). Can contain A-z,1-9,(#,_,!)</span></div>
<div id="passwordInfo" class="info"><span class="info_text">Password<span class="close">X</span></span><hr><span class="info_text">1). Can only be 1 to 9 six digit password.<br><br> Why?:- For security Improvment. <br><br>NOTE:- PLease remember your password because right now we don't have a recovery method. :)</div>
<div id="termsInfo" class="info"><span class="info_text">Terms & Conditions<span class="close">X</span></span><hr><span class="info_text">1). I take Whole responsibilty of every confession I make on this Website. <br>2). Founder of this website has no connection with my confessions personally nor professionally.<br><br>NOTE:- You Are hidden if you choose, from other users. However,you  aren't invisible from your service provider. :) (We can track you)</span></div>
<div id="collegeInfo" class="info"><span class="info_text">College<span class="close">X</span></span><hr><span class="info_text">1). You can specify your college or select from our list.<br> 2). Be sure while specifying because all the trending posts you will see will be from your college. <br>3). However,you can still change your college by editing in your profile, :) </div>

</body> 
</html>
