<!-- Call mobile sidebar -->
<?php if ($s5_responsive_mobile_layout == "sidebar" && $s5_responsive == "enabled") {?>
<div id="s5_responsive_mobile_sidebar" class="s5_responsive_mobile_sidebar_hide_<?php if($s5_language_direction == "1") { echo "rtl"; } else { echo "ltr"; } ?>">
	<?php require(dirname(__FILE__)."/../../vertex/responsive/responsive_mobile_sidebar.php"); ?>
</div>
<div id="s5_responsive_mobile_sidebar_body_wrap">
<div id="s5_responsive_mobile_sidebar_body_wrap_inner">
<?php } ?>

<!-- Call top bar for mobile devices if layout is responsive -->	
<?php if ($s5_responsive == "enabled") { ?>
	<?php require(dirname(__FILE__)."/../../vertex/responsive/responsive_mobile_top_bar.php"); ?>
<?php } ?>

<!-- Fixed Tabs -->	
<?php if($s5_lr_tab1_text != "" || $s5_lr_tab1_text != "") {
	require(dirname(__FILE__)."/../../vertex/fixed_tabs.php"); 
} ?>

<!-- Drop Down -->	
<?php if ($s5_pos_drop_down_1 == "published" || $s5_pos_drop_down_2 == "published" || $s5_pos_drop_down_3 == "published" || $s5_pos_drop_down_4 == "published" || $s5_pos_drop_down_5 == "published" || $s5_pos_drop_down_6 == "published") { ?>
	<?php require(dirname(__FILE__)."/../../vertex/drop_down.php"); ?>
<?php } ?>

<!-- Parallax Backgrounds -->
<?php if (
	(@$s5_top_row1_area1_background_parallax == "yes" && @$s5_top_row1_area1_background != "") 
	|| (@$s5_top_row1_area2_background_parallax == "yes" && @$s5_top_row1_area2_background != "") 
	|| (@$s5_top_row2_area1_background_parallax == "yes" && @$s5_top_row2_area1_background != "") 
	|| (@$s5_top_row2_area2_background_parallax == "yes" && @$s5_top_row2_area2_background != "") 
	|| (@$s5_top_row3_area1_background_parallax == "yes" && @$s5_top_row3_area1_background != "") 
	|| (@$s5_top_row3_area2_background_parallax == "yes" && @$s5_top_row3_area2_background != "") 
	|| (@$s5_center_area1_background_parallax == "yes" && @$s5_center_area1_background != "") 
	|| (@$s5_center_area2_background_parallax == "yes" && @$s5_center_area2_background != "") 
	|| (@$s5_above_columns_wrap1_background_parallax == "yes" && @$s5_above_columns_wrap1_background != "") 
	|| (@$s5_above_columns_wrap2_background_parallax == "yes" && @$s5_above_columns_wrap2_background != "") 
	|| (@$s5_columns_wrap_background_parallax == "yes" && @$s5_columns_wrap_background != "") 
	|| (@$s5_columns_wrap_inner_background_parallax == "yes" && @$s5_columns_wrap_inner_background != "") 
	|| (@$s5_below_columns_wrap1_background_parallax == "yes" && @$s5_below_columns_wrap1_background != "") 
	|| (@$s5_below_columns_wrap2_background_parallax == "yes" && @$s5_below_columns_wrap2_background != "") 
	|| (@$s5_bottom_row1_area1_background_parallax == "yes" && @$s5_bottom_row1_area1_background != "") 
	|| (@$s5_bottom_row1_area2_background_parallax == "yes" && @$s5_bottom_row1_area2_background != "") 
	|| (@$s5_bottom_row2_area1_background_parallax == "yes" && @$s5_bottom_row2_area1_background != "") 
	|| (@$s5_bottom_row2_area2_background_parallax == "yes" && @$s5_bottom_row2_area2_background != "") 
	|| (@$s5_bottom_row3_area1_background_parallax == "yes" && @$s5_bottom_row3_area1_background != "") 
	|| (@$s5_bottom_row3_area2_background_parallax == "yes" && @$s5_bottom_row3_area2_background != "")) { ?>
	<?php require(dirname(__FILE__)."/../../vertex/parallax_backgrounds.php"); ?>
<?php } ?>

<!-- Floating Menu Spacer -->
<?php if ($s5_menudetach  == "yes") { ?>	
<div id="s5_floating_menu_spacer" style="display:none;width:100%;"></div>
<?php } ?>