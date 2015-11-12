<?php

if(!$ptitle) $ptitle = $sitename;

?>

<html>
<head>
<title><?php echo $ptitle; ?> - <?php echo $sitename; ?></title>
    <META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <META NAME="keywords" CONTENT="">
    <META NAME="description" CONTENT="">
	<meta name="distribution" content="global">
<link rel="stylesheet" href="styles/styles.css" type="text/css">
<script type="text/javascript" language="javascript">
<!-- 
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=150,height=60,left = 300,top = 200');");
}
//--> </script> 
</head>

<body bgcolor="#cccccc" style="margin-top:0px;margin-bottom:0px;margin-right:0px;margin-left:0px;">
<table width="100%" cellpadding="0" cellspacing="0" height="100%">
<tr><td width="100%" height="50" valign="top" background="images/logo.jpg">
<table width="100%" cellpadding="0" cellspacing="0" height="100%"><tr><td>
&nbsp;
</td>
<td align="right" valign="bottom" width="130" style="padding-right:6px;padding-bottom:4px;">
<?php
$temp = mysql_query("SELECT tally FROM tblstats WHERE id = 1 LIMIT 1");
$today = mysql_result($temp, 0, tally);
$temp = mysql_query("SELECT tally FROM tblstats WHERE id = 2 LIMIT 1");
$overall = mysql_result($temp, 0, tally);
echo "<font class=\"topsmall\">Downloads Today: <b>".$today."</b><br>Downloads Overall: <b>".$overall."</b></font>";
?>
</td></tr></table>
</td></tr>
<tr><td height="21" style="background-image:url(images/nav-break.jpg);">
<table width="100%" cellpadding="0" cellspacing="0" height="100%">
<tr>
<td valign="top" width="7"><img src="images/nav-<?php if($htmlpage == 1) echo "on"; else echo "off"; ?>-left.jpg" width="7" height="21"></td><td style="background-image:url(images/nav-<?php if($htmlpage == 1) echo "on"; else echo "off"; ?>-mid.jpg);" align="center" width="60">
<a href="index.html">home</a>
</td><td width="7"><img src="images/nav-<?php if($htmlpage == 1) echo "on"; else echo "off"; ?>-right.jpg" width="7" height="21"></td><td width="1"><img src="images/nav-break.jpg" width="1" height="21"></td>

<td valign="top" width="7"><img src="images/nav-<?php if($htmlpage == 2) echo "on"; else echo "off"; ?>-left.jpg" width="7" height="21"></td><td style="background-image:url(images/nav-<?php if($htmlpage == 2) echo "on"; else echo "off"; ?>-mid.jpg);" align="center" width="65">
<a href="browse-results.html">browse</a>
</td><td width="7"><img src="images/nav-<?php if($htmlpage == 2) echo "on"; else echo "off"; ?>-right.jpg" width="7" height="21"></td><td width="1"><img src="images/nav-break.jpg" width="1" height="21"></td>

<td valign="top" width="7"><img src="images/nav-<?php if($htmlpage == 3) echo "on"; else echo "off"; ?>-left.jpg" width="7" height="21"></td><td style="background-image:url(images/nav-<?php if($htmlpage == 3) echo "on"; else echo "off"; ?>-mid.jpg);" align="center" width="75">
<a href="categories.html">categories</a>
</td><td width="7"><img src="images/nav-<?php if($htmlpage == 3) echo "on"; else echo "off"; ?>-right.jpg" width="7" height="21"></td><td width="1"><img src="images/nav-break.jpg" width="1" height="21"></td>

<td valign="top" width="7"><img src="images/nav-<?php if($htmlpage == 4) echo "on"; else echo "off"; ?>-left.jpg" width="7" height="21"></td><td style="background-image:url(images/nav-<?php if($htmlpage == 4) echo "on"; else echo "off"; ?>-mid.jpg);" align="center" width="60">
<a href="search.html">search</a>
</td><td width="7"><img src="images/nav-<?php if($htmlpage == 4) echo "on"; else echo "off"; ?>-right.jpg" width="7" height="21"></td><td width="1"><img src="images/nav-break.jpg" width="1" height="21"></td>

<td valign="top" width="7"><img src="images/nav-<?php if($htmlpage == 5) echo "on"; else echo "off"; ?>-left.jpg" width="7" height="21"></td><td style="background-image:url(images/nav-<?php if($htmlpage == 5) echo "on"; else echo "off"; ?>-mid.jpg);" align="center" width="70">
<a href="contact-us.html">contact us</a>
</td><td width="7"><img src="images/nav-<?php if($htmlpage == 5) echo "on"; else echo "off"; ?>-right.jpg" width="7" height="21"></td><td width="1"><img src="images/nav-break.jpg" width="1" height="21"></td>

<td style="background-image:url(images/nav-break.jpg);">&nbsp;</td>
</tr></table>

</td></tr>
<tr><td bgcolor="#ffffff" valign="top">

<table width="100%" cellpadding="6" cellspacing="0" height="100%"><tr><td valign="top"style="background-image: url('images/bg-
<?php 
if($htmlpage == 1) echo "home";
elseif($htmlpage == 2) echo "browse";
elseif($htmlpage == 3) echo "categories";
elseif($htmlpage == 4) echo "font-search";
elseif($htmlpage == 5) echo "contact-us";
else echo "home";
?>
.jpg'); background-repeat: no-repeat;
background-position: top right; padding-left:12px;">