<?php

/* Setup MySQL Access */
$DBhost = "localhost";
$DBuser = "";  // your db user
$DBpass = "";  // your db pass
$DBname = ""; // your db name
mysql_connect($DBhost, $DBuser, $DBpass) or die ("Cannot connect to database server");
mysql_select_db($DBname) or die ("Cannot select site database");

?>
