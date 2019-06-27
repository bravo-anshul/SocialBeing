<?PHP
$db_conx = mysqli_connect("localhost", "ADMIN", "ank09607", "laravel","3306") or die ('Hmm, this is wierd, we are having issues connecting to our databases. Try again in a little bit, thank you!');
$tbl_users = "CREATE TABLE IF NOT EXISTS name_account (
              uid INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			  name VARCHAR(25) NOT NULL,
			  type ENUM('U','P','G','C','B','S','N') NOT NULL DEFAULT 'N', 
			  PRIMARY KEY (uid)
             )";
/*--U-user,P-page,G-group,C-community,B-default class groups,S-buysell page,N-EmailId is not confirm--*/
/*-Avatar:-if file exists then show else default avatar img will shows NO need of Avatar column-*/
$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
	echo "<h3>account table created OK :) </h3>"; 
} else {
	echo "<h3>account table NOT created :( </h3>"; 
} 

$tbl_users = "CREATE TABLE IF NOT EXISTS login_account (
              uid INT(11) UNSIGNED NOT NULL ,
			  uname VARCHAR(10) NOT NULL,
			  email VARCHAR(25) NOT NULL,
			  password VARCHAR(35) NOT NULL,
	   	      lastlogin DATETIME NOT NULL,
			  PRIMARY KEY (uid)
             )";
$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
	echo "<h3>login_account table created OK :) </h3>"; 
} else {
	echo "<h3>login_account table NOT created :( </h3>"; 
}

$tbl_users = "CREATE TABLE IF NOT EXISTS college_account (
              uid INT(11) UNSIGNED NOT NULL ,
			  branch ENUM('CS','CE','IT','EC','ME','PC','AU','EE') NOT NULL DEFAULT 'CS', 
			  year TINYINT NOT NULL DEFAULT '13', 
			  course ENUM('BE','ME') NOT NULL DEFAULT 'BE',
			  PRIMARY KEY (uid)
             )";
/*-year ENUM('2011','2012','2013','2014','2015','2016') NOT NULL DEFAULT '2013', -*/
/*-We will dynamicaly calculate the year value in first,second,third and final year and even passout students-*/
/*--What if student got year back--*/
$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
	echo "<h3>college_account table created OK :) </h3>"; 
} else {
	echo "<h3>college_account table NOT created :( </h3>"; 
}

$tbl_users = "CREATE TABLE IF NOT EXISTS profile_account (
              uid INT(11) UNSIGNED NOT NULL ,
			  tagline VARCHAR(50) NULL,
			  msgsent ENUM('E','F','N') NOT NULL DEFAULT 'E',
			  fllwrqst ENUM('Y','A') NOT NULL DEFAULT 'Y',
			  seegb ENUM('E','F','N') NOT NULL DEFAULT 'E',
			  postgb ENUM('E','F','N') NOT NULL DEFAULT 'E',
			  seefrd ENUM('E','F','N') NOT NULL DEFAULT 'E',
			  seeprofile ENUM('E','F','N') NOT NULL DEFAULT 'E',
			  PRIMARY KEY (uid)
             )";
$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
	echo "<h3>profile table created OK :) </h3>"; 
} else {
	echo "<h3>profile table NOT created :( </h3>"; 
} 
$tbl_users = "CREATE TABLE IF NOT EXISTS about_account (
              uid INT(11) UNSIGNED NOT NULL,
			  gender ENUM('M','F') NOT NULL DEFAULT 'M',
			  birthdate DATE NULL,
			  city VARCHAR(16) NULL,
			  hometown VARCHAR(16) NULL,
			  status ENUM('S','C','CO') NOT NULL DEFAULT 'S',
              school VARCHAR(25) NULL,
			  mobile VARCHAR(13) NULL,
			  signup DATETIME NOT NULL,			  
			  ip VARCHAR(40) NOT NULL,
			  seemail ENUM('E','F','N') NOT NULL DEFAULT 'E',
			  seemoblie ENUM('E','F','N','FL') NOT NULL DEFAULT 'E',
			  PRIMARY KEY (uid)
               )";
/*S-SINGLE,C-COMMITED,CO-COMPLICATED--*/
/*-F-frdsonly,FL-frdsandfllws-Yes we have to search frds for mobile its privacy issue-*/
$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
	echo "<h3>about_account table created OK :) </h3>"; 
} else {
	echo "<h3>about_account table NOT created :( </h3>"; 
} 


$tbl_relation = "CREATE TABLE IF NOT EXISTS relation (
                U1 INT(11) UNSIGNED NOT NULL,
				U2 INT(11) UNSIGNED NOT NULL,
				F ENUM('Y','N','A') NOT NULL DEFAULT 'N',
				B ENUM('Y','N') NOT NULL DEFAULT 'N',
				FL ENUM('Y','N','A') NOT NULL DEFAULT 'N',
				L ENUM('Y','N','A') NOT NULL DEFAULT 'N',
				Constraint PK PRIMARY KEY (U1,U2)           
                )"; 
// NN AA YY // N 1 2 A Y
/*L-leader*/
$query = mysqli_query($db_conx, $tbl_relation); 
if ($query === TRUE) {
	echo "<h3>relations table created OK :) </h3>"; 
} else {
	echo "<h3>relations table NOT created :( </h3>"; 
}


/*
$tbl_chat = "CREATE TABLE IF NOT EXISTS chat ( 
                id INT(11) NOT NULL AUTO_INCREMENT,
                sender INT(11) NOT NULL,
                reciever INT(11) NOT NULL,
				body VARCHAR(100) NOT NULL,
                datemade DATETIME NOT NULL,
                msgread ENUM('0','1') NOT NULL DEFAULT '0',
				PRIMARY KEY (id)              
                )"; 
$query = mysqli_query($db_conx, $tbl_chat); 
if ($query === TRUE) {
	echo "<h3>chat table created OK :) </h3>"; 
} else {
	echo "<h3>chat table NOT created :( </h3>"; 
}*/
$tbl_activity = "CREATE TABLE IF NOT EXISTS activity ( 
                aid INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                author INT(11) UNSIGNED NOT NULL,
				account INT(11) UNSIGNED NOT NULL,
				activity VARCHAR(1) NOT NULL,
				header VARCHAR(500) NULL,
				body VARCHAR(2000) NOT NULL,
				likes SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
				report SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
				comments SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
				share SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
                permission ENUM('E','F') NOT NULL DEFAULT 'E',
				datemade DATETIME NOT NULL,
				PRIMARY KEY (aid)              
                )";
/*--PERMISSION E-Public,F-Frds and followers--*/
$query = mysqli_query($db_conx, $tbl_activity); 
if ($query === TRUE) {
	echo "<h3>activity table created OK :) </h3>";
} else {
	echo "<h3>activity table NOT created :( </h3>"; 
}
$tbl_notification = "CREATE TABLE IF NOT EXISTS notification ( 
                nid INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
				sid INT(11) UNSIGNED NOT NULL,
                actor INT(11) UNSIGNED NOT NULL,
				notify ENUM('A','I','P','L','S','C') NOT NULL,
				datetime DATETIME NOT NULL,
				PRIMARY KEY (nid)
                )"; 
$query = mysqli_query($db_conx, $tbl_notification); 
if ($query === TRUE) {
	echo "<h3>notification table created OK :) </h3>"; 
} else {
	echo "<h3>notification table NOT created :( </h3>"; 
}