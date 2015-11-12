<?php

error_reporting(0);

$sitename  = "Fonts Site Title";
$siteurl   = "yourdomain.com";  // your domain name without the http://www. and removing any ending forward slash. i.e. yourdomain.com
$siteemail = "info@".$siteurl;

$fontsize  = 54;  // Recommended to leave at 54. The size of the font text on the preview image. By default this is 54. If previews are already generated, you'll need to delete all the files within 'downloaded/previews' to re-generate. If a font size is bigger than then image size - it will automatically be reduced when the preview is generated.
$imagetext = "";  // Text to use on all font previews. If this is left as nothing, the font name is used. If this is changed once font previews have been generated, you'll need to delete all the files within 'downloaded/previews' to re-generate.

// DO NOT CHANGE BELOW THIS LINE
$font_originals_path  = "storage/originals/";
$font_previews_path   = "storage/previews/";
$font_characters_path = "storage/characters/";
$font_contents_path   = "storage/contents/";
$font_custom_path     = "storage/custom/";

include_once("function-library.php");

?>