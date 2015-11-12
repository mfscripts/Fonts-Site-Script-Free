<?php

include_once("config.inc.php");

$custom       = $_REQUEST['custom'];
$d            = $_REQUEST['d'];
$fontfilename = $_REQUEST['fontfilename'];

  $imagewidth = 800;
  $imageheight = 90;
  $previewspath = $font_custom_path;
  $imagetext = $custom;
  $im = @imagecreate($imagewidth, $imageheight)
	 or die("Cannot Initialize new GD image stream");

	 // Create some colors
  $white = imagecolorallocate($im, 255, 255, 255);
  $grey = imagecolorallocate($im, 128, 128, 128);
  $black = imagecolorallocate($im, 0, 0, 0);

  $color = array();  
  $color[0] = imagecolorallocate($im, 0x33, 0x33, 0x33);

  $col = $color[0];

  $font = $font_contents_path.$d."/".$fontfilename;

  $bbox = imagettfbbox($fontsize, 0, $font, $imagetext);
  while ($bbox[1]+$bbox[7] > $imageheight) {
	$fontsize = $fontsize - 2;
	$bbox = imagettfbbox($fontsize, 0, $font, $imagetext);
  }

  $xc=($bbox[0]+$bbox[2]);
  $yc=($bbox[1]+$bbox[7]);

  $xpos = 17;
  $ypos = 70;

  $result = imagettftext($im, $fontsize, 0, $xpos, $ypos, $col, $font, $imagetext);

  header("Content-type: image/gif");
  imagegif($im, "", 80);
  imagedestroy($im);
  
  exit;
?>