
$(document).ready(function(){
	/*$(window).bind('beforeunload', function(){
  		return 'This will delete all the Messages';
	});*/
	var height = $(window).height();
	$(".input,input[type='radio']").css('height',height*0.050);
	$('.button,.banner,#imageSubmit').css('font-size',height*0.024);
	$('h3').css('font-size',height*0.04);
	$('p,.radio').css('font-size',height*0.024);

	$("#uname").focusout(function(){
		var string = $("#uname").val();
		if(string.length>0){
			$("#uname_span").load("ajax/sign_up.php?q="+string+"&t=uname");
		}
		else{
			$("#uname_span").html("Fill out field");
		}
	});

	$("#pass2").focusout(function(){
		var match = $("#pass1").val();
		var mat = $("#pass2").val();
		if(mat == match){
			$("#pass_span").html("<span style='color:green'>Password Matches :)</span>");
		}
		else{
			$("#pass_span").html("<span style='color:#f44336;'>Password do not Match :(</span>");
		}
	});
});

function clean(type){
	if(type == "pass1" || type == "pass2" || type == "age" ){
		var textfield = document.getElementById(type);
		var regex = /[^1-9]/gi;
		if(textfield.value.search(regex) > -1) {
			textfield.value = textfield.value.replace(regex, "");
	    }
    } 
    if(type == "uname"){
    	var textfield = document.getElementById(type);
		var regex = /[^a-z 0-9 .!_-]/gi;
		if(textfield.value.search(regex) > -1) {
			textfield.value = textfield.value.replace(regex, "");
	        }
    }
}
function crop(type){
	document.getElementById('id01').style.display='block';
	document.getElementById("type").value = type ;
}
function _(el){
  return document.getElementById(el);
}
function uploadFile(){
  var file = _("image").files[0];
  // alert(file.name+" | "+file.size+" | "+file.type);
  var formdata = new FormData();
  formdata.append("image", file);
  var ajax = new XMLHttpRequest();
  ajax.upload.addEventListener("progress", progressHandler, false);
  ajax.addEventListener("load", completeHandler, false);
  ajax.open("POST", "../Cropper.php");
  ajax.send(formdata);
}
function progressHandler(event){
  //_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
  var percent = (event.loaded / event.total) * 100;
  _("progressBar").value = Math.round(percent);
  _("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
 //_("status").innerHTML = event.target.responseText;
 _("progressBar").value = 100;
}
