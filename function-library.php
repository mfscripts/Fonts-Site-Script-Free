<?php

include_once("db_connect.php");

// functions go here
function formatField($input) {
	$input = strip_tags($input);
	$input = str_replace(";", ":", $input);
	$input = mysql_real_escape_string($input);
	return trim($input);
}

function escape_string ($string) {
	if(version_compare(phpversion(),"4.3.0")=="-1") {
		return mysql_escape_string($string);
	} else {
		return mysql_real_escape_string($string);
	}
}

function createletter($letter, $charval) {
	global $characters;
	global $d;
	global $fontfilename;
	global $font_contents_path;
	
	$fontsize = 16;
	$imagewidth = 24;
	$imageheight = 44;
	$imagetext = $letter;
	$im = @imagecreate($imagewidth, $imageheight);
	     // Create some colors
	$white = imagecolorallocate($im, 255, 255, 255);
	$grey = imagecolorallocate($im, 128, 128, 128);
	$black = imagecolorallocate($im, 0, 0, 0);

	$color = array();  
	$color[0] = imagecolorallocate($im, 0x33, 0x33, 0x33);

	srand((double)microtime()*1000000);
	$number = rand(0, 2);
	$col = $color[0];
	$font = $font_contents_path.$d."/".$fontfilename;

	$bbox = imagettfbbox($fontsize, 0, $font, $imagetext);
	while ($bbox[1]+$bbox[7] > $imageheight) {
	$fontsize = $fontsize - 2;
	$bbox = imagettfbbox($fontsize, 0, $font, $imagetext);
	}

	$xc=($bbox[0]+$bbox[2]);
	$yc=($bbox[1]+$bbox[7]);

	$xpos = ($imagewidth - $xc)/2;
	$ypos = 32;

	$result = imagettftext($im, $fontsize, 0, $xpos, $ypos, $col, $font, $imagetext);

	$filename = $charval.".ttf";
	$filename = str_replace(".ttf", ".gif", $filename);
	$newname = $characters.$filename;
	imagegif($im, $newname, 80);
	imagedestroy($im);
}

function generatePassword($length = 30) {
  $password = "";
  $possible = "0123456789bcdfghjkmnpqrstvwxyz"; 
  $i = 0; 
  while ($i < $length) { 
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
    if (!strstr($password, $char)) { 
      $password .= $char;
      $i++;
    }
  }
  return $password;
}

function createhtmlname($name) {
  $replace_values = array(" ", "'", "\"", "\\", "/", "?", "|", "@", "#", "~", "!", "£", "$", "%", "^", "&", "*", "(", ")", "[", "]", "{", "}", "+", "=", "-");
  $name = str_replace($replace_values, "_", $name);
  $name = str_replace(".", "", $name);
  $name = str_replace(",", "", $name);
  return strtolower($name);
}

function gradient_region($img, $x, $y, $width, $height,$src_color, $dest_color=0) {
   $src_alpha = ($src_color) >> 24;
   $src_red = ($src_color & 0xFF0000) >> 16;
   $src_green = ($src_color & 0x00FF00) >> 8;
   $src_blue = ($src_color & 0x0000FF);
   
   $dest_alpha = ($dest_color) >> 24;
   $dest_red = ($dest_color & 0xFF0000) >> 16;
   $dest_green = ($dest_color & 0x00FF00) >> 8;
   $dest_blue = ($dest_color & 0x0000FF);
	   
	   
   $inc_alpha = ($dest_alpha - $src_alpha) / $height;
   $inc_red = ($dest_red - $src_red)/$height;
   $inc_green = ($dest_green - $src_green)/$height;
   $inc_blue = ($dest_blue - $src_blue)/$height;
   
   // If you need more performance, the step can be increased
   for ($i=0;$i<$height;$i++){
	   $src_alpha += $inc_alpha;
	   $src_blue += $inc_blue;
	   $src_green += $inc_green;
	   $src_red += $inc_red;
	   imagefilledrectangle($img,
		   $x,$y+$i,        
		   $x+$width,$y+$i,
		   imagecolorallocatealpha($img,
		   $src_red,$src_green,$src_blue,$src_alpha));
   }
}

function convert_number($number) { 
    if (($number < 0) || ($number > 999999999)) 
    { 
        return "$number"; 
    } 

    $Gn = floor($number / 1000000);  /* Millions (giga) */ 
    $number -= $Gn * 1000000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Million"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 
}

function clean_directory($directory, $empty = FALSE) {
	if(substr($directory,-1) == '/')
	{
		$directory = substr($directory,0,-1);
	}
	if(!file_exists($directory) || !is_dir($directory))
	{
		return FALSE;
	}elseif(is_readable($directory))
	{
		$handle = opendir($directory);
		while (FALSE !== ($item = readdir($handle)))
		{
			if($item != '.' && $item != '..')
			{
				$path = $directory.'/'.$item;
				if(is_dir($path)) 
				{
					clean_directory($path);
				}else{
					unlink($path);
				}
			}
		}
		closedir($handle);
		if($empty == FALSE)
		{
			if(!rmdir($directory))
			{
				return FALSE;
			}
		}
	}
	mkdir($directory);
	return TRUE;
}

?>