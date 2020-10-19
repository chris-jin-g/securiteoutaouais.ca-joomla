<?php

$dir = dirname(dirname(__FILE__));
function json2Array($json) {return json_decode($json, 1);}
function getCurrentAlias() {
  $active = JFactory::getApplication()->getMenu()->getActive();
  if($active) {
    return $active;
  }
  return null;
}

global $s5_vertex_version, $s5_template_name;
$s5_vertex_version = '1.0';

function getTemplateName($template) {
  $db = JFactory::getDBO();
  $query = "SELECT * FROM #__template_styles WHERE template = '$template';";
  $db->setQuery($query);
  $result = $db->loadAssocList();
  $titles = array();
  $i = 0;
  $home_id = 0;
  foreach($result as $k => $style) {
    $ids[] = $style['id'];
    $titles[$style['id']] = $style['title'];
    if($style['home'] == 1) {
      $home_id = $style['id'];
    }
    $i++;
  }
  $ids = implode(",", $ids);
  $u_main = JURI::root();
  $u = JFactory::getURI();
  //$u = $u->toString();
  $com = $u->getPath();//($u_main, '', $u);
  $alias = getCurrentAlias();
  if(!$alias) {$alias="none";}
  if(empty($alias->template_style_id)) {
    $query2 = "SELECT * FROM #__menu WHERE template_style_id IN (". $ids .") LIMIT 1";
  } else {
    $query2 = "SELECT * FROM #__menu WHERE template_style_id = ". $alias->template_style_id;
  }
  $db->setQuery($query2);
  $result2 = $db->loadAssocList();
  $i2 = 0;
	$id = 0;
  foreach($result2 as $k => $item) {
    if($item['link'] == $com || preg_match("/" . $item['alias'] . "/i", $alias->alias)) {
      $id = $item['template_style_id'];
      $i2++;
    }
  }
  if($i2 == 0) {
    $id = $home_id;
  }
  return $titles[$id];
}

function getVersion($dir) {
  global $s5_vertex_version;
  if(file_exists($dir . '/xml/Specific.xml')) {
    $templateXml = simplexml_load_file($dir . '/xml/Specific.xml', 'SimpleXMLElement', LIBXML_NOCDATA);
    $s5_vertex_version = $templateXml->version;
  } else {
    exit('Template XML file not found');
  }
}

function getJoomlaParams($dir = false) {
  $admin_options = array();
  if(file_exists($dir . '/xml/Specific.xml')) {
    $templateXml = simplexml_load_file($dir . '/xml/Specific.xml', 'SimpleXMLElement', LIBXML_NOCDATA);
    $fieldsets = $templateXml->config->fields;
    foreach($fieldsets->fieldset as $key => $fieldset){
      foreach($fieldset as $key => $item){
        $admin_options[(string)$item['name'][0]] = (string)$item['default'][0];
      }
    }
  } else {
    exit('Template XML file not found');
  }
  return $admin_options;
}

function getVertexParams($dir = false){
  if(file_exists($dir . '/xml/Vertex.xml')) {
    $vertexXml = simplexml_load_file($dir . '/xml/Vertex.xml', 'SimpleXMLElement', LIBXML_NOCDATA);
    $admin_options = array();
    $fieldsets = $vertexXml->admin;
    foreach($fieldsets->fieldset as $key => $fieldset){
      foreach($fieldset as $key => $item){
        $admin_options[(string)$item['name'][0]] = (string)$item['default'][0];
      }
    }
  } else {
    exit('Vertex XML file not found');
  }
  return $admin_options;
}

function handleJSONFile($file = false, $style = false, $dir = false) {
  getVersion($dir);
  $config = array();
  if(file_exists($dir . '/' . $file)) {
    $check = file_get_contents($dir . '/' . $file);
    $file_data = json2Array($check);
    if(isset($file_data['vertexFramework'][$style]) && is_array($file_data['vertexFramework'][$style])) {
      $defaults = getJoomlaParams($dir);
      $defaults = array_merge($defaults, getVertexParams($dir));
      foreach($defaults as $key => $val){
        $key = str_replace('xml_', '', $key);
        $config[$key] = '';
      }
      foreach($file_data['vertexFramework'][$style] as $key => $val){
        $key = str_replace('xml_', '', $key);
        $config[$key] = preg_replace('/\\\/', '', $val);
      }
    } else {
      $defaults = getJoomlaParams($dir);
      $defaults = array_merge($defaults, getVertexParams($dir));
      foreach($defaults as $key => $val){
        $key = str_replace('xml_', '', $key);
        $config[$key] = preg_replace('/\\\/', '', $val);
      }
    }
  } else {
    $defaults = getJoomlaParams($dir);
    $defaults = array_merge($defaults, getVertexParams($dir));
    foreach($defaults as $key => $val){
      $key = str_replace('xml_', '', $key);
      $config[$key] = preg_replace('/\\\/', '', $val);
    }
  }
  
   # Parse Multilang Text
  $lang = JFactory::getLanguage();
  $lang_tag = $lang->getTag();
  foreach($config as $key => $val){
  	if(substr($key, -5)=='_lang'){
  		$langvals = explode("\n",$val); 
  		for($i=0;$i<count($langvals);$i++){
  			
  			$sublangval =  explode("=",$langvals[$i]); 
			$sublangval = str_replace("\r","",$sublangval);
			$sublangval = str_replace("\n","",$sublangval);
  			if(trim($sublangval[0]) == $lang_tag ){
  			  
  				 $newkey = str_replace("_lang","",$key);
  				 $config[$newkey] = $sublangval[1];
  			}
  		}
  	 
  	}     
  }
  # End Parse Multilang Text
  
  return $config;
}

if (file_exists($dir . '/templateDetails.xml')) {
  $template_xml = simplexml_load_file($dir . '/templateDetails.xml', 'SimpleXMLElement', LIBXML_NOCDATA);
  $template_name = $template_xml->name;
  $template_date = $template_xml->creationDate;
} else {
  $template_name = 'blank';
}

$style_name = getTemplateName($template_name);
//var_dump($style_name);
$file = 'vertex.json';
$params = handleJSONFile($file, $style_name, $dir);

foreach($params as $k => $v){$$k = $v;}

if (isset($s5_lr_tab1_text)) {} else {$s5_lr_tab1_text = "";}
if (isset($s5_lr_tab2_text)) {} else {$s5_lr_tab2_text = "";}
if (isset($s5_lr_tab1_click)) {} else {$s5_lr_tab1_click = "";}
if (isset($s5_lr_tab2_click)) {} else {$s5_lr_tab2_click = "";}

$s5_lr_tab1_text = str_replace(" ","&nbsp;",$s5_lr_tab1_text);
$s5_lr_tab2_text = str_replace(" ","&nbsp;",$s5_lr_tab2_text);	
$s5_urlforSEO = $s5_seourl;

if ($s5_fstyle != "") {
$s5_fstyle = ":".$s5_fstyle;
}

if ($s5_fstyle_responsive_mobile_bar != "") {
$s5_fstyle_responsive_mobile_bar = ":".$s5_fstyle_responsive_mobile_bar;
}

$s5_fonts_with_style = $s5_fonts.$s5_fstyle;
$s5_fonts_responsive_mobile_bar_with_style = $s5_fonts_responsive_mobile_bar.$s5_fstyle_responsive_mobile_bar;

$s5_fonts_with_style = str_replace(" ","+",$s5_fonts_with_style);
$s5_fonts_responsive_mobile_bar_with_style = str_replace(" ","+",$s5_fonts_responsive_mobile_bar_with_style);	

if ($s5_columns_fixed_fluid == "") {
$s5_columns_fixed_fluid = "px";
}

$s5_full_width_flex_menu = "no";

if ($s5_responsive_mobile_bar_trigger == "") {
$s5_responsive_mobile_bar_trigger = "750";
}

if ($s5_responsive_mobile_sidebar_large_width == "") {
$s5_responsive_mobile_sidebar_large_width = "400";
}

$s5_responsive_scroll_arrow = "";
$s5_responsive_menu_button = "";

function start_session() {
  if(version_compare(phpversion(), "5.4.0") != -1){
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
  } else {
    if(session_id() == '') {
      session_start();
    }
  }
}

global $s5_jthis;
$s5_jthis = $this;

function s5_get_option($opt_name,$demo=false, $shortname=null){
	$demo_mode = "yes";
	if($shortname == null){$shortname = $opt_name;}
	if(defined('_JEXEC')){global $s5_jthis;
	$$opt_name = $s5_jthis->params->get($opt_name);$enable=$demo_mode;}
	else{$$opt_name = get_settings($opt_name);$enable=get_settings('demo_mode');}
	if($enable == 'yes' && $demo != false){
		if(isset($_GET[$shortname])){
			$_SESSION[$shortname] = $_GET[$shortname];}
		if(isset($_SESSION[$shortname])){
			$$opt_name = $_SESSION[$shortname];}
	}
	return $$opt_name;
}

foreach ($_SESSION as $session_option=>$session_option_val) {
	if(strrpos($session_option,"s5_") >= 0) {
		${$session_option} = $session_option_val;
	}
}

$s5_rtl = s5_get_option("xml_s5_rtl",1,'lang'); 
if($s5_rtl == "rtl") {
$s5_language_direction = "1";
}

$domain = $_SERVER['HTTP_HOST'];
$path = $_SERVER['SCRIPT_NAME'];
$queryString = $_SERVER['QUERY_STRING'];
$url = "http://" . $domain . $path . "?" . $queryString;
$url2 = "http://" . $domain . $_SERVER['REQUEST_URI'];

if(strrpos($url2,"shape5.com") > 1) {
$url_new = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if ( "www." != substr( $_SERVER[ 'HTTP_HOST' ] , 0 , 4) ) {
$url_new = "http://www.".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
header('Location:'.$url_new);
}
}

if(strrpos($url2,"pages/portfolio") > 1) {
$s5_info_slide = "yes";
}

if(strrpos($url2,"template-features/lazy-load-enabled") > 1) {
$s5_lazyload = "all";
}

if(strrpos($url2,"template-features/tool-tips-enabled") > 1) {
$s5_tooltips = "yes";
}

if(strrpos($url2,"template-features/info-slide-enabled") > 1) {
$s5_info_slide = "yes";
}

if(strrpos($url2,"template-features/multibox-enabled") > 1) {
$s5_multibox = "yes";
}

if(strrpos($url2,"?") > 1 && strrpos($url2,"=") > 1) {
	$url_split_marker1 = explode("?",$url2);
	$url_split_marker1_explode = $url_split_marker1[1];
	$url_split_marker2 = explode("=",$url_split_marker1_explode);
	$url_split_marker2_explode = $url_split_marker2[0];
	${$url_split_marker2_explode} = s5_get_option($url_split_marker2_explode,1,$url_split_marker2_explode);
}

?>