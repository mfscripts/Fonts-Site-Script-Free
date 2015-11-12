<?php

include_once("config.inc.php");

$thumbid = $_REQUEST['thumbid'];

$imagewidth = 800;
$imageheight = 90;
$previewspath = $font_previews_path;
$newpath = $font_originals_path;

if(!file_exists($previewspath.$thumbid.".gif")) {

	$temp = mysql_query("SELECT * FROM tblfonts WHERE id = ".$thumbid." LIMIT 1");

	while ($row = mysql_fetch_array($temp)) {

		if(strlen($imagetext) == 0) $imagetext = $row[name];
		$im = @imagecreatetruecolor($imagewidth, $imageheight)
		   or die("Cannot Initialize new GD image stream");

		$bg1 = imagecolorallocate($im, 255, 255, 255);
		$bg2 = imagecolorallocate($im, 227, 227, 227);
		gradient_region($im, 0, 0, $imagewidth, $imageheight, $bg1, $bg2);
		$color = imagecolorallocate($im, 36, 36, 36);

		$font = $font_contents_path.$row[id]."/".$row[fontfilename];

		if(!file_exists($font)) {
		  include('includes/pclzip.lib.php');
		  $archive = new PclZip($newpath.$row[id].".zip");
		  if ($archive->extract($font_contents_path.$row[id]."/", $row[id]) == 0) 
		  {
		    $font = "";
		  }
		}

		$bbox = imagettfbbox($fontsize, 0, $font, $imagetext);
		while ($bbox[1]+$bbox[7] > $imageheight) {
			$fontsize = $fontsize - 2;
			$bbox = imagettfbbox($fontsize, 0, $font, $imagetext);
		}

		$xc=($bbox[0]+$bbox[2]);
		$yc=($bbox[1]+$bbox[7]);

		$xpos = 17;
		$ypos = 70;

		$result = imagettftext($im, $fontsize, 0, $xpos, $ypos, $color, $font, $imagetext);

		$trans_color = imagecolorallocate($im, 255, 255, 255);
		imagecolortransparent($im, $trans_color);

		$filename = $row[id].".ttf";
		$filename = str_replace(".ttf", ".gif", $filename);
		$newname = $previewspath.$filename;
		Imagegif($im, $newname);
		imagedestroy($im);
	}

}
header("Content-type: image/gif");
$filename = $previewspath.$thumbid.".gif";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
echo $contents;
exit;
?>