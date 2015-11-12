<?php

include_once("config.inc.php");

$f   = $_REQUEST['f'];
if(!$f) die("error locating file!");
else {
  $filename = $font_contents_path.base64_decode($f);
  $tempexp = explode(".", $filename);
			$final = COUNT($tempexp)-1;
			$extension = strtolower($tempexp[$final]);
  $dataFile = fopen( $filename, "r" ) ;

  if ( $dataFile )
  {
   while (!feof($dataFile)) 
   {
       $buffer = fgets($dataFile, 4096);
	   if($extension == "txt") echo nl2br($buffer);
	   else echo $buffer;
   }

   fclose($dataFile);
  }
  else
  {
   die( "fopen failed for $filename" ) ;
  }
}
?>