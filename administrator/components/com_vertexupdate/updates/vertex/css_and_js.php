<?php if ($s5_favicon && $s5_favicon != "") {
	if(strrpos($s5_favicon,"ttp://") > 0) { ?>
		<link href="<?php echo $s5_favicon; ?>" rel="shortcut icon" type="image/x-icon" />
	<?php } else { ?>
		<link href="<?php echo $LiveSiteUrl; echo $s5_favicon; ?>" rel="shortcut icon" type="image/x-icon" />
	<?php } ?>
<?php } else { ?>
	<link href="<?php echo $s5_directory_path ?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<?php } ?>

<?php
s5_jslibrary_call();
$doc=JFactory::getDocument();
//Calls jquery javascript
if($version->RELEASE <= '2.5'){
$doc->addScript($s5_directory_path.'/js/jquery/jquery.min.js');
$doc->addScript($s5_directory_path.'/js/jquery/jquery-noconflict.js');

?>
<script type="text/javascript">//<![CDATA[
if(jQuery.easing.easeOutExpo==undefined){
document.write('<script src="<?php echo $s5_directory_path; ?>/js/jquery/jquery-ui.min.js"><\/script>');
}
//]]></script>
<?php }
if($version->RELEASE >= '3.0'){
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');
JHtml::_('jquery.ui', array('core', 'sortable')); 
?>
<script type="text/javascript">
	if(jQuery().jquery=='1.11.0') { jQuery.easing['easeOutExpo'] = jQuery.easing['easeOutCirc'] };
</script>
<?php 
	if($option!="com_kunena") {
		$doc->addScript($s5_directory_path.'/js/jquery/jquery-ui-addons.js');
	}
}
?>

<?php if($version->RELEASE >= '3.0'){ ?>
	<link href="<?php echo $s5_directory_path ?>/css/bootstrap/bootstrap-default-min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $s5_directory_path ?>/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
	<?php if ($s5_bootstrap == "dark") { ?>
		<link href="<?php echo $s5_directory_path ?>/css/bootstrap/bootstrap-dark-overrides.css" rel="stylesheet" type="text/css" />
	<?php } ?>
	<?php if($s5_language_direction == "1") { ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $s5_directory_path ?>/css/bootstrap/bootstrap-rtl.css" />
	<?php } ?>
<?php } ?>

<?php if($version->RELEASE >= '3.0' && $s5_font_awesome == "enabled"){ ?>
	<link rel="stylesheet" href="<?php echo $s5_directory_path ?>/css/font-awesome/css/font-awesome.min.css">
	<?php if ($browser == "ie7" || $browser == "ie8") { ?>
	<link rel="stylesheet" href="<?php echo $s5_directory_path ?>/css/font-awesome/font-awesome-ie7.min.css">
	<?php } ?>
<?php } ?>

<?php if($s5_ionicons == "enabled"){ ?>
	<link rel="stylesheet" href="<?php echo $s5_directory_path ?>/css/ionicons/css/ionicons.min.css">
<?php } ?>

<!-- Css and js addons for vertex features -->
<?php if(($s5_responsive == "enabled" || $s5_responsive_cookie == "desktop") && $s5_fonts_responsive_mobile_bar != "Arial" && $s5_fonts_responsive_mobile_bar != "Tahoma" && $s5_fonts_responsive_mobile_bar != "Helvetica" && $s5_fonts_responsive_mobile_bar != "Sans-Serif" && $s5_fonts_responsive_mobile_bar != "Verdana") { ?>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=<?php echo $s5_fonts_responsive_mobile_bar_with_style; ?>" />
<?php } ?>
<?php require(dirname(__FILE__)."/../css/core/s5_vertex_addons-min.php"); ?>
<?php require(dirname(__FILE__)."/../js/core/s5_vertex_addons-min.php"); ?>

<?php if ($s5_show_menu == "show") { ?>
<script type="text/javascript" src="<?php echo $s5_directory_path ?>/js/core/s5_flex_menu-min.js"></script>
<link rel="stylesheet" href="<?php echo $s5_directory_path ?>/css/s5_flex_menu.css" type="text/css" />
<?php } ?>
<?php if ($s5_fullscroll_names != "" && $s5_fullscroll == "enabled") {
$s5_fs_tags = $s5_fullscroll_names;
$s5_fs_tag2s = $s5_fullscroll_names;
$s5_fs_tags = explode(',', $s5_fs_tags);
$s5_fs_tag2s = explode(',', $s5_fs_tag2s);
if ($s5_fullscroll_homepage == "enabled") {
$fsmenu = JFactory::getApplication()->getMenu();
if ($fsmenu->getActive() == $fsmenu->getDefault()) {
?>
<script type="text/javascript" src="<?php echo $s5_directory_path ?>/js/core/jquery.fullPage-min.js"></script>
<script type="text/javascript" src="<?php echo $s5_directory_path ?>/js/core/jquery.slimscroll-min.js"></script>
<link rel="stylesheet" href="<?php echo $s5_directory_path ?>/css/core/s5_fullpage-min.css" type="text/css" />
<script type="text/javascript">
	var jqins5 = window.innerHeight;
	var jqbofws5 = jQuery( window ).width();
	<?php if ($s5_fullscroll_hideheight == "") {
		$s5_fullscroll_hideheight = "0";
	} ?>
	<?php if ($s5_fullscroll_hidewidth == "") {
		$s5_fullscroll_hidewidth = "0";
	} ?>
	jQuery(document).ready(function() {
			if (jqins5 >= <?php echo $s5_fullscroll_hideheight ?>) {
			if (jqbofws5 >= <?php echo $s5_fullscroll_hidewidth ?>) {
				jQuery('#s5_body_padding').fullpage({
					anchors: [<?php foreach( $s5_fs_tag2s as $s5_fs_tag2 ){  echo "'".$s5_fs_tag2."page',"; } ?>],
					navigation: true,
					navigationPosition: 'right',
					navigationTooltips: [<?php foreach( $s5_fs_tags as $s5_fs_tag ){  echo "'".$s5_fs_tag."',"; } ?>]
				});
			}
			}
		});
</script>
<?php } } if ($s5_fullscroll_homepage != "enabled" && $s5_fullscroll == "enabled") {  ?>
<script type="text/javascript" src="<?php echo $s5_directory_path ?>/js/core/jquery.fullPage-min.js"></script>
<script type="text/javascript" src="<?php echo $s5_directory_path ?>/js/core/jquery.slimscroll-min.js"></script>
<link rel="stylesheet" href="<?php echo $s5_directory_path ?>/css/core/s5_fullpage-min.css" type="text/css" />
<script type="text/javascript">
	var jqins5 = window.innerHeight;
	var jqbofws5 = jQuery( window ).width();
	<?php if ($s5_fullscroll_hideheight == "") {
		$s5_fullscroll_hideheight = "0";
	} ?>
	<?php if ($s5_fullscroll_hidewidth == "") {
		$s5_fullscroll_hidewidth = "0";
	} ?>
	jQuery(document).ready(function() {
			if (jqins5 >= <?php echo $s5_fullscroll_hideheight ?>) {
			if (jqbofws5 >= <?php echo $s5_fullscroll_hidewidth ?>) {
				jQuery('#s5_body_padding').fullpage({
					anchors: [<?php foreach( $s5_fs_tag2s as $s5_fs_tag2 ){  echo "'".$s5_fs_tag2."page',"; } ?>],
					navigation: true,
					navigationPosition: 'right',
					navigationTooltips: [<?php foreach( $s5_fs_tags as $s5_fs_tag ){  echo "'".$s5_fs_tag."',"; } ?>]
				});
			}
			}
		});
</script>
<?php } } ?>
<link rel="stylesheet" href="<?php echo $LiveSiteUrl ?>templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $LiveSiteUrl ?>templates/system/css/general.css" type="text/css" />

<?php if (version_compare($s5_vertex_version, '3.9', '<=')) { ?>
<link href="<?php echo $s5_directory_path ?>/css/template_default.css" rel="stylesheet" type="text/css" />
<?php } ?>

<link href="<?php echo $s5_directory_path ?>/css/template.css" rel="stylesheet" type="text/css" />

<?php if($mobile==true){ ?>
<link href="<?php echo $s5_directory_path ?>/css/mobile_device.css" rel="stylesheet" type="text/css" />
<?php } ?>

<?php if (version_compare($s5_vertex_version, '3.9', '<=')) { ?>
<link href="<?php echo $s5_directory_path ?>/css/com_content.css" rel="stylesheet" type="text/css" />
<?php } ?>

<link href="<?php echo $s5_directory_path ?>/css/editor.css" rel="stylesheet" type="text/css" />

<?php if($s5_thirdparty == "enabled") { ?>
<link href="<?php echo $s5_directory_path ?>/css/thirdparty.css" rel="stylesheet" type="text/css" />
<?php } ?>

<?php if($s5_language_direction == "1") { ?>
	<link href="<?php echo $s5_directory_path ?>/css/<?php if (version_compare($s5_vertex_version, '4.0', '>=')) { ?>rtl/<?php } ?>template_rtl.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $s5_directory_path ?>/css/<?php if (version_compare($s5_vertex_version, '4.0', '>=')) { ?>rtl/<?php } ?>editor_rtl.css" rel="stylesheet" type="text/css" />
	<?php if($mobile==true){ ?>
	<link href="<?php echo $s5_directory_path ?>/css/mobile_device_rtl.css" rel="stylesheet" type="text/css" />
	<?php } ?>
<?php } ?>

<?php if($s5_fonts != "Arial" && $s5_fonts != "Helvetica" && $s5_fonts != "Sans-Serif" && $s5_fonts != "Tahoma" && $s5_fonts != "Times New Roman" && $s5_fonts != "Verdana") { ?>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=<?php echo $s5_fonts_with_style;?>" />
<?php } ?>

<?php if ($s5_multibox  == "yes") { ?>
<link href="<?php echo $s5_directory_path ?>/css/multibox/multibox.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $s5_directory_path ?>/css/multibox/ajax.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $s5_directory_path ?>/js/multibox/overlay.js"></script>
<script type="text/javascript" src="<?php echo $s5_directory_path ?>/js/multibox/multibox.js"></script>
<?php } ?>

<?php if($s5_font_resizer == "yes" && $mobile==false) { ?>
<script type="text/javascript" src="<?php echo $s5_directory_path ?>/js/core/s5_font_adjuster-min.js"></script>
<?php } ?>

<?php
// Disable responsive calls for IE7 and IE8 if it is disabled in the template configuration.
if (($browser == "ie7" || $browser == "ie8") && $s5_responsive_ie == "disabled") {
	$s5_responsive = "disabled";
} ?>

<?php if($s5_responsive == "enabled" || $s5_responsive_cookie == "desktop") { ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $s5_directory_path ?>/css/core/s5_responsive_bars-min.css" />
	<link href="<?php echo $s5_directory_path ?>/css/core/s5_responsive_hide_classes-min.css" rel="stylesheet" type="text/css" />
	<style type="text/css"> @media screen and (min-width: 650px){.s5_responsive_mobile_sidebar_show_ltr {width:<?php echo $s5_responsive_mobile_sidebar_large_width; ?>px !important;}.s5_responsive_mobile_sidebar_body_wrap_show_ltr {margin-left:<?php echo $s5_responsive_mobile_sidebar_large_width; ?>px !important;}.s5_responsive_mobile_sidebar_show_rtl {width:<?php echo $s5_responsive_mobile_sidebar_large_width; ?>px !important;}.s5_responsive_mobile_sidebar_body_wrap_show_rtl {margin-right:<?php echo $s5_responsive_mobile_sidebar_large_width; ?>px !important;}#s5_responsive_mobile_sidebar_inner1 {width:<?php echo $s5_responsive_mobile_sidebar_large_width; ?>px !important;}}</style>
<?php } ?>

<?php if ($s5_responsive == "enabled") { ?>

	<link rel="stylesheet" type="text/css" href="<?php echo $s5_directory_path ?>/css/s5_responsive.css" />
	<?php if($s5_language_direction == "1") { ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $s5_directory_path ?>/css/<?php if (version_compare($s5_vertex_version, '4.0', '>=')) { ?>rtl/<?php } ?>s5_responsive_rtl.css" />
	<?php } ?>

	<?php
	// Media query script for IE7 and IE8. Must be called after media query css.
	if ($browser == "ie7" || $browser == "ie8") { ?>
	<script type="text/javascript">
	var s5_max_body_width = 0;
	<?php if ($s5_max_body_width != ""){ ?>
	s5_max_body_width = <?php echo $s5_max_body_width; ?>;
	<?php } ?>
	var s5_fixed_fluid = "<?php echo $s5_fixed_fluid; ?>";
	var s5_responsive_column_increase = "<?php echo $s5_responsive_column_increase; ?>";
	var s5_responsive_columns_small_tablet = "<?php echo $s5_responsive_columns_small_tablet; ?>";
	var s5_responsive_hide_tablet = "<?php echo @implode(",",$s5_responsive_tablet_hide); ?>";
	var s5_responsive_hide_mobile = "<?php echo @implode(",",$s5_responsive_mobile_hide); ?>";
	var s5_right_width_orig = <?php echo $s5_right_width; ?>;
	var s5_right_inset_width_orig = <?php echo $s5_right_inset_width; ?>;
	var s5_left_width_orig = <?php echo $s5_left_width; ?>;
	var s5_left_inset_width_orig = <?php echo $s5_left_inset_width; ?>;
	</script>
	<script type="text/javascript" src="<?php echo $s5_directory_path ?>/js/core/s5_responsive_ie-min.js"></script>
	<?php } ?>

<?php } ?>

<?php if(JFile::exists(JPATH_THEMES."/".$this->template."/css/custom.css")) { ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $s5_directory_path ?>/css/custom.css" />
<?php } ?>