<?php

/* pulls from admin if URL entered in admin area */
if ($s5_urlforSEO  == ""){ 
$LiveSiteUrl = JURI::root();}
if ($s5_urlforSEO  != ""){ 
$LiveSiteUrl = $s5_urlforSEO."/";}

/* template directory URL used index.php */
$s5_template_name = $this->template;
$s5_directory_path = $LiveSiteUrl."templates/".$s5_template_name;

/* If browser calls */
$br = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '';
$browser = "other";

if(strrpos($br,"msie 6") > 1) {
$browser = "ie6";} 

if(strrpos($br,"msie 7") > 1) {
$browser = "ie7";} 

if(strrpos($br,"msie 8") > 1) {
$browser = "ie8";} 

if(strrpos($br,"msie 9") > 1) {
$browser = "ie9";} 

if(strrpos($br,"opera") > 1) {
$browser = "opera";} 

if(strrpos($br,"firefox") > 1) {
$browser = "firefox";} 

if(strrpos($br,"chrome") > 1) {
$browser = "chrome";} 

if(strrpos($br,"safari") > 1) {
$browser = "safari";} 


/* Hides frontpage component area when enabled in admin */
$s5_show_component = "yes";

jimport( 'joomla.version' );
$version = new JVersion();
$version_number = 'version_'.$version->getShortVersion();

$app = JFactory::getApplication();
$menu = $app->getMenu()->getActive();

if(!empty($s5_hide_component_items)) {
    if(is_array($s5_hide_component_items)) {} else $s5_hide_component_items = explode(',', $s5_hide_component_items);
  $s5_hide_component_array_count = count($s5_hide_component_items);
  for ($s5_hide_component_array_holder = 0; $s5_hide_component_array_holder < $s5_hide_component_array_count; $s5_hide_component_array_holder++) {
    if ( $menu && $s5_hide_component_items[$s5_hide_component_array_holder] == $menu->id) {
      $s5_show_component = "no";
    }
  }
}


// Change a hex color
function change_Color($color, $dif)
{
 $color = str_replace('#','', $color);
 $rgb = '';
 if (strlen($color) != 6) {
  // reduce the default amount a little
  $dif = ($dif==20)?$dif/10:$dif;
  for ($x = 0; $x < 3; $x++) {
   $c = hexdec(substr($color,(1*$x),1)) - $dif;
   $c = ($c < 0) ? 0 : dechex($c);
   $rgb .= $c;
  }
 } else {
  for ($x = 0; $x < 3; $x++) {
   $c = hexdec(substr($color, (2*$x),2)) - $dif;
   $c = ($c < 0) ? 0 : dechex($c);
   $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
  }
 }
 return ''.$rgb;
}


// Hex to rgb
function hex2rgb($hex) {
$hex = str_replace("#", "", $hex);
if(strlen($hex) == 3) {
$r = hexdec(substr($hex,0,1).substr($hex,0,1));
$g = hexdec(substr($hex,1,1).substr($hex,1,1));
$b = hexdec(substr($hex,2,1).substr($hex,2,1));
} else {
$r = hexdec(substr($hex,0,2));
$g = hexdec(substr($hex,2,2));
$b = hexdec(substr($hex,4,2));
}
$rgb = array($r, $g, $b);
return $rgb; 
}

?>