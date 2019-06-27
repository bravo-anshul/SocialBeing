<?php 
session_start();
$db_conx = mysqli_connect("localhost", "social48_bravo", "Anshul267485", "social48_beingsocial","3306") or die ('Hmm, this is wierd, we are having issues connecting to our databases. Try again in a little bit, thank you!,problemsdk');

$likes = mysqli_query($db_conx,"CREATE TABLE IF NOT EXISTS likes (
			uid int(11),
			pid int(11)

	)");

$members = mysqli_query($db_conx,"CREATE TABLE IF NOT EXISTS members (
		uid int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT ,
		name varchar(40) ,
		uname varchar(25) UNIQUE ,
		email varchar(45) ,
		pass int(7) ,
		age int(3) ,
		gender enum('m','f') , 
		college varchar(25),
		about varchar(355)
	)");

$posts = mysqli_query($db_conx,"CREATE TABLE IF NOT EXISTS posts (
		pid int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT ,
		uid int(11) , 
		targetName varchar(40) ,
		targetId int(11) ,
		identity enum('1','2') , 
		body varchar(400) ,
		likes int(11) , 
		college varchar(40) ,
		uname varchar(16) ,
		time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
	) ")	;

$messages = mysqli_query($db_conx,"CREATE TABLE IF NOT EXISTS messages(
		mid int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT ,
		sid int(11) ,
		rid int(11) , 
		time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
		body text 
	)")	;
$badges = mysqli_query($db_conx,"CREATE TABLE IF NOT EXISTS badges (
		uid int(11) ,
		reponse int(11) , 
		my_interest int(11) ,
		matches int(11) , 
		confess int(11) ,
		target int(11)
	)")	;

$follow = mysqli_query($db_conx,"CREATE TABLE IF NOT EXISTS follow(
		uid int(11) , 
		rid int(11)
	)");

$interest = mysqli_query($db_conx,"CREATE TABLE IF NOT EXISTS interest(
		uid int(11) , 
		rid int(11) ,
		result enum('1','2','3') ,
		time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
	)");

$user_log = mysqli_query($db_conx,"CREATE TABLE IF NOT EXISTS user_log (
		uid int(11) ,
		device varchar(155) ,
		browser varchar(155) ,
		lastActive timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
		ip_addr varchar(20)
	) ");
$post_backup = mysqli_query($db_conx,"CREATE TABLE IF NOT EXISTS post_backup(
		uid int(11) ,
		pid int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT ,
		body text ,
		targetName varchar(255) ,
		targetId int(11) ,
		device varchar(255) ,
		ip_addr varchar(122) ,
		time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
	) ");

if($likes === TRUE){
	echo "likes created ";
}
else{
	echo "slikes went wrong";
}

if($members === TRUE){
	echo "members created ";
}
else{
	echo "members went wrong";
}

if($posts === TRUE){
	echo "posts created ";
}
else{
	echo "posts went wrong";
}

if($messages === TRUE){
	echo "messages created ";
}
else{
	echo "messages went wrong";
}

if($badges === TRUE){
	echo "badges created ";
}
else{
	echo "badges went wrong";
}

if($post_backup === TRUE){
	echo "post_backup created ";
}
else{
	echo "post_backup went wrong";
}

if($user_log === TRUE){
	echo "user_log created ";
}
else{
	echo "user_log went wrong";
}

if($follow === TRUE){
	echo "follow created ";
}
else{
	echo "follow went wrong";
}

if($interest === TRUE){
	echo "interest created ";
}
else{
	echo "interest went wrong";
}

?>