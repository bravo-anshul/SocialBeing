<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="images/icons/logo_transparent1.png">
<meta name="mobile-web-app-capable" content="yes">
<meta name="theme-color" content="#009688">
<link rel="manifest" href="back_end/webapp.json?v=3">
<link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<script src="script/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="css/w3.css">
<link rel="stylesheet" type="text/css" href="css/login.css?v=3">
<script src="script/touch.js"></script>	
<!--CHANGE INDIAN EDUCATION SYSTEM-->
<script> 
$(document).ready(function(){ 
if(screen.width>800){
  window.location = "PC.php";
}
var font = $(window).height();
$(".button,#login,#loader").css('font-size',font*0.045);
$('button,a').css('font-size',font*0.035);
$("input").css({'font-size':font*0.03,'height':font*0.065});
$("h1").css('font-size',font*0.07);

var width = $(document).width();
var height = $(document).height();
$("#bgImg").css({'height':height,'width':width});
  $(".button").on("vmousedown", function() { 
    $(this).css({"background-color":"#009688","color":"white"});
   }); 
  $(".button").on("vmouseup", function() { 
    $(this).css({"background-color":"white","color":'black'});
  }); 
  $("#del").on("vmousedown", function(){
  	var val = $("#pass").val();
  	var len = val.length - 1;
  	val = val.slice(0,len);
  	$("#pass").val(val);
  });
  $("#close").on("vmousedown", function(){
   	$("#loader").hide();
   	$(".button").css('pointer-events','auto');
  });
  $("#pass").on('vmousedown',function(){
    $("#div1").show();
  });
});

function button(value){
  var val = $("#pass").val();
  var val = val + value;
  $("#pass").val(val);
  var email = $("#email").val();
  var len = $("#pass").val();
  if(len.length == 6){
    if(email == null){
      $("#response").text("Please fill the email");
      $("#pass").val(null);
    }
    $("#loader").css('display','block');
    $(".button").css('pointer-events','none');
    $("#response").text("Checking Please Wait....");
    var pass = $("#pass").val();
    $("#response").load("ajax/loader.php",{email:email,pass:pass});
    $("#pass").val(null);
  }
}
</script>
<style type="text/css">


</style>
</head>
<body>
<div style="position:relative;"><img src="images/icons/cxcx.jpg" id="bgImg"> 
<div id="login" class="">
  <h1>Social Being !!</h1>
  <input id="email" class="w3-teal" type="text" placeholder="Email" >
  <input id="pass" class="w3-teal" type="password"  placeholder="Password" disabled>
  <div id="div1" class="w3-animate-bottom" style="display: none;">
    <div style="display:flex;" >
      <div id="1" class="w3-third button" onclick="button('1')" >1</div>
      <div id="2" class="w3-third button" onclick="button('2')" >2</div>
      <div id="3" class="w3-third button" onclick="button('3')" >3</div>
    </div>
     <div style="display:flex" >
      <div id="4" class="w3-third button" onclick="button('4')" >4</div>
      <div id="5" class="w3-third button" onclick="button('5')" >5</div>
      <div id="6" class="w3-third button" onclick="button('6')" >6</div>
    </div>
     <div style="display:flex" >
      <div id="7" class="w3-third button" onclick="button('7')" >7</div>
      <div id="8" class="w3-third button" onclick="button('8')" >8</div>
      <div id="9" class="w3-third button" onclick="button('9')" >9</div>
    </div>
  </div>  
</div>
 <div class="box">
    <a href="Tour.php" class="w3-btn w3-teal w3-twothird">New here.?</a>
    <button style="border:2px solid white;margin-top:25px;" id="del" class="w3-btn w3-third"><-</button>    
  </div>

<p id="footer">Founded by:- Anshul Shrivastava</p>  
<!--Anshul Shrivastava Production-->
<div id="loader">
	<span id="close">X</span>
	<p id="response" style="color:white">Checking Please Wait ...</p>
</div>
</div>
</body>
</html>