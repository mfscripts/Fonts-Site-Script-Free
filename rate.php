<?php

include_once("config.inc.php");

$id = $_REQUEST['id'];
$h  = $_REQUEST['h'];

?>

<html>
<head>
<script type="text/javascript" language="javascript">
function timedclose()
{
  window.close();
}
</script>
<title>- Rating Font</title>
<style type="text/css">
body {
    font-family: Tahoma;
	background-color: #ffffff;
	font-size: 14px;
	font-weight:none;
	color: #000000;
}
</style>
</head>

<body bgcolor="#ffffff" style="margin-top:3px;" onload="setTimeout('timedclose()', 2000)">

<?php

if (strlen($id) == 0) echo "There was no font specified, please try again.<br>";

if (strlen($h) == 0) echo "There was an error, please try again.<br>";

$temp2 = mysql_query("SELECT votesup, votesdown FROM tblfonts WHERE id=$id");
$votesup = mysql_result($temp2, 0, votesup);
$votesdown = mysql_result($temp2, 0, votesdown);
if($h == '1') $votesup++;
elseif($h == '0') $votesdown++;
$total = $votesup + $votesdown;
if($votesup > 0) {
  $percenteach = ($votesup/$total) * 100;
  $percent = round($percenteach, 0);
}
else $percent = "0";
$temp2 = mysql_query("UPDATE tblfonts SET votesup=$votesup, votesdown=$votesdown, rating='$percent' WHERE id=$id");

echo "<div align=\"center\">Your vote has been counted.<br><br>This window will now close...</div>";
?>
</body>
</html>