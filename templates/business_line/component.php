<?php
/**
 * @version		$Id: component.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
define( 'TEMPLATEPATH', dirname(__FILE__) );


$LiveSiteUrl = JURI::root();
$s5templatename = $this->template;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head" />
	<link href="<?php echo $LiveSiteUrl ?>templates/<?php echo $s5templatename ?>/css/bootstrap/bootstrap-default-min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $LiveSiteUrl ?>templates/<?php echo $s5templatename ?>/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $LiveSiteUrl ?>templates/<?php echo $s5templatename ?>/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo $LiveSiteUrl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
	<link href="<?php echo $LiveSiteUrl ?>templates/<?php echo $s5templatename ?>/css/template.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="<?php echo $LiveSiteUrl ?>templates/<?php echo $s5templatename ?>/css/editor.css" rel="stylesheet" type="text/css" media="screen" />
	<style type="text/css">
	.button {
	background:#333333;
	color:#FFFFFF;
	margin-top:10px;
	}
	label {
	display:block;
	margin-top:4px;
	margin-bottom:4px;
	}
	a, h1, h2, h3, h4, h5 {
	color:#000000;}
	body {font-family: Helvetica,Arial,Sans-Serif ;}
	</style>
</head>
<body class="contentpane">
	<div style="padding:14px;">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
	</div>
</body>
</html>
