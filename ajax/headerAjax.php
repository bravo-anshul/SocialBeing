<?php 
if(!isset($_SESSION)){
	session_start();
}
//session_start();
$db_conx = mysqli_connect("localhost", "social48_bravo", "Anshul267485", "social48_beingsocial","3306") or die ('Hmm, this is wierd, we are having issues connecting to our databases. Try again in a little bit, thank you!');
/*
$db_conx = mysqli_connect("localhost", "root", "", "social48_beingsocial","3306") or die ('Hmm, this is wierd, we are having issues connecting to our databases. Try again in a little bit, thank you!');
*/

?> 