<style type="text/css"> 

<?php if ($s5_module_ft_size != "default") { ?>
.module_round_box_outer, #s5_above_body, #s5_below_body {
font-size:<?php echo $s5_module_ft_size; ?>em !important;
}
<?php } ?>

<?php if ($s5_component_ft_size != "default") { ?>
#s5_component_wrap {
font-size:<?php echo $s5_component_ft_size; ?>em !important;
}
<?php } ?>

<?php if ($s5_parent_menu_ft_size != "default") { ?>
#s5_nav {
font-size:<?php echo $s5_parent_menu_ft_size; ?>em !important;
}
<?php } ?>

<?php if ($s5_sub_menu_ft_size != "default") { ?>
#subMenusContainer {
font-size:<?php echo $s5_sub_menu_ft_size; ?>em !important;
}
<?php } ?>

<?php if ($s5_responsive_mobile_bar_position == "enabled" && $s5_responsive_mobile_layout == "sidebar") { ?>
#s5_responsive_mobile_top_bar {
position:fixed !important;
}
<?php } ?>

<?php if ($s5_images_width != "") { ?>
.s5_module_box_1 img, .item-page img, .blog-featured img, .blog img {
width:<?php echo $s5_images_width; ?>% !important;
-webkit-box-sizing: border-box !important; /* Safari/Chrome, other WebKit */
-moz-box-sizing: border-box !important;    /* Firefox, other Gecko */
box-sizing: border-box !important;         /* Opera/IE 8+ */
}
ul.actions img {
width:auto !important;
}
<?php } ?>

/* MAX IMAGE WIDTH */

img {
<?php if ($s5_auto_height == "yes") { ?>
height:auto !important;
<?php } ?>
<?php if ($s5_max_width == "yes") { ?>
max-width:100% !important;
-webkit-box-sizing: border-box !important; /* Safari/Chrome, other WebKit */
-moz-box-sizing: border-box !important;    /* Firefox, other Gecko */
box-sizing: border-box !important;         /* Opera/IE 8+ */
<?php } ?>
}

#map_canvas img, .gm-style img {
max-width:none !important;
}

.full_width {
width:100% !important;
-webkit-box-sizing: border-box !important; /* Safari/Chrome, other WebKit */
-moz-box-sizing: border-box !important;    /* Firefox, other Gecko */
box-sizing: border-box !important;         /* Opera/IE 8+ */
}

<?php if ($browser == "ie7") { ?>
img.ie7, img.boxed, img.boxed_black, img.padded {
max-width:95% !important;
}
<?php } ?>

<?php if($s5_responsive_cookie == "desktop") { ?>
#s5_menu_wrap {
display:block !important;
}
<?php } ?>

<?php if ($browser == "ie7" || $browser == "ie8") { ?>
#s5_drop_down_container {
overflow:visible !important;
}
<?php } ?>

.S5_submenu_itemTablet{
background:none !important;
}

<?php if ($s5_columns_fixed_fluid == "%") { ?>
#s5_right_wrap, #s5_left_wrap, #s5_right_inset_wrap, #s5_left_inset_wrap, #s5_right_top_wrap, #s5_left_top_wrap, #s5_right_bottom_wrap, #s5_left_bottom_wrap {
width:100% !important;
}
<?php if ($s5_pos_right_inset == "published" && $s5_pos_right_inset == "published") { ?>
#s5_right_wrap {
width:<?php echo ($s5_right_width/($s5_right_width + $s5_right_inset_width))*100; ?>% !important;
}
#s5_right_inset_wrap {
width:<?php echo ($s5_right_inset_width/($s5_right_width + $s5_right_inset_width))*100; ?>% !important;
}
<?php } ?>
<?php if ($s5_pos_left_inset == "published" && $s5_pos_left_inset == "published") { ?>
#s5_left_wrap {
width:<?php echo ($s5_left_width/($s5_left_width + $s5_left_inset_width))*100; ?>% !important;
}
#s5_left_inset_wrap {
width:<?php echo ($s5_left_inset_width/($s5_left_width + $s5_left_inset_width))*100; ?>% !important;
}
<?php } ?>
#s5_right_column_wrap {
width:<?php echo $s5_right_column_width/2; ?>% !important;
margin-left:-<?php echo ($s5_right_column_width/2) + ($s5_left_column_width/2); ?>% !important;
}
#s5_left_column_wrap {
width:<?php echo $s5_left_column_width/2; ?>% !important;
}
#s5_center_column_wrap_inner {
margin-right:<?php echo $s5_center_column_margin_right ?>% !important;
margin-left:<?php echo $s5_center_column_margin_left ?>% !important;
}
<?php } ?>

<?php if ($s5_responsive == "enabled" && $browser != "ie7") { ?>
#s5_responsive_mobile_drop_down_wrap input {
width:96% !important;
}
#s5_responsive_mobile_drop_down_search input {
width:100% !important;
}
<?php } ?>

<?php if ($s5_responsive == "enabled" && $browser == "ie7") { ?>
#s5_responsive_mobile_drop_down_wrap input {
width:90% !important;
}
#s5_responsive_mobile_drop_down_search input {
width:93% !important;
}
<?php } ?>

<?php if ($s5_responsive_cookie == "desktop") { ?>
	body {
	height:100% !important;
	position:relative !important;
	padding-bottom:48px !important;
	}
<?php } ?>

<?php if ($s5_responsive == "enabled" && ($s5_responsive_cookie  == "not_set" || $s5_responsive_cookie  == "mobile" || $s5_scrolltotop  == "yes" || $s5_scrolltotop  == "override")) { ?>
@media screen and (max-width: <?php echo $s5_responsive_mobile_bar_trigger; ?>px){
	body {
	height:100% !important;
	position:relative !important;
	<?php 
	if ($s5_responsive_scroll_arrow == "override" || $s5_scrolltotop == "no") {
	$s5_show_responsive_scroll_arrow = "no";
	} else {
	$s5_show_responsive_scroll_arrow = "yes";
	}
	if ($s5_responsive == "enabled" && (($s5_responsive_mobile_links == "enabled" && $s5_responsive_mobile_text != "") || $s5_show_responsive_scroll_arrow  == "yes")) { ?>
	padding-bottom:48px !important;
	<?php } ?>
	}
	#s5_responsive_menu_button {
	display:block !important;
	}
	<?php if ($s5_responsive_scroll_arrow == "override") { ?>
	#s5_responsive_scroll_arrow, #s5_responsive_scroll_arrow a {
	display:block !important;
	}
	<?php } ?>
}
<?php } ?>

<?php if ($s5_menu_onclick == "enabled" && $s5_responsive == "enabled") { ?>
@media screen and (max-width: 970px){
	#subMenusContainer .S5_subtext {
	width:85%;
	}
}
<?php } ?>


<?php if ($s5_responsive == "enabled" && $s5_responsive_mobile_layout == "sidebar") { ?>

	#s5_responsive_mobile_sidebar {
	background:#<?php echo $s5_responsive_mobile_sidebar_start; ?>;
	background: -moz-linear-gradient(top, #<?php echo $s5_responsive_mobile_sidebar_start; ?> 0%, #<?php echo $s5_responsive_mobile_sidebar_stop; ?> 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $s5_responsive_mobile_sidebar_start; ?>), color-stop(100%,#<?php echo $s5_responsive_mobile_sidebar_stop; ?>));
	background: -webkit-linear-gradient(top, #<?php echo $s5_responsive_mobile_sidebar_start; ?> 0%,#<?php echo $s5_responsive_mobile_sidebar_stop; ?> 100%);
	background: -o-linear-gradient(top, #<?php echo $s5_responsive_mobile_sidebar_start; ?> 0%,#<?php echo $s5_responsive_mobile_sidebar_stop; ?> 100%);
	background: -ms-linear-gradient(top, #<?php echo $s5_responsive_mobile_sidebar_start; ?> 0%,#<?php echo $s5_responsive_mobile_sidebar_stop; ?> 100%);
	background: linear-gradient(top, #<?php echo $s5_responsive_mobile_sidebar_start; ?> 0%,#<?php echo $s5_responsive_mobile_sidebar_stop; ?> 100%);
	font-family: <?php echo $s5_fonts_responsive_mobile_bar ?> !important;
	}
	
	#s5_responsive_mobile_sidebar a, #s5_responsive_mobile_search, #s5_responsive_mobile_sidebar_login_register_wrap, #s5_responsive_mobile_sidebar_menu_wrap, .module_round_box-sidebar, .module_round_box-sidebar .s5_mod_h3, .module_round_box-sidebar .s5_h3_first, .module_round_box-sidebar .s5_h3_last, #s5_responsive_mobile_sidebar_menu_wrap h3 {
	color:#<?php echo $s5_responsive_mobile_sidebar_font_color; ?> !important;
	font-family: <?php echo $s5_fonts_responsive_mobile_bar ?> !important;
	}
	
	.s5_responsive_mobile_sidebar_inactive .s5_responsive_mobile_sidebar_title_wrap:hover, #s5_responsive_mobile_sidebar_title_wrap_login_open, #s5_responsive_mobile_sidebar_title_wrap_register_open, #s5_responsive_mobile_sidebar_search_wrap_inner1, #s5_responsive_mobile_sidebar .first_level_li:hover {
	background:#<?php echo $s5_responsive_mobile_sidebar_input_bg; ?>;
	cursor:pointer;
	font-family: <?php echo $s5_fonts_responsive_mobile_bar ?> !important;
	}
	
	.s5_mobile_sidebar_h3_open, #s5_responsive_mobile_sidebar_menu_wrap h3:hover {
	background:#<?php echo $s5_responsive_mobile_sidebar_input_bg; ?>;
	cursor:pointer;
	}
	
	.s5_mobile_sidebar_h3_open span, #s5_responsive_mobile_sidebar_title_wrap_register_open, #s5_responsive_mobile_sidebar_title_wrap_login_open, #s5_responsive_mobile_sidebar a.s5_mobile_sidebar_active, #s5_responsive_mobile_sidebar .s5_mobile_sidebar_h3_open a {
	color:#<?php echo $s5_responsive_mobile_bar_active_color; ?> !important;
	}
	
	#s5_responsive_mobile_sidebar_menu_wrap div, #s5_responsive_mobile_sidebar_login_bottom, #s5_responsive_mobile_sidebar_register_bottom {
	background:#<?php echo $s5_responsive_mobile_sidebar_menu_subs_bg; ?>;
	}
	
	#s5_responsive_mobile_sidebar_search_wrap, #s5_responsive_mobile_sidebar_login_register_wrap, #s5_responsive_mobile_sidebar_menu_wrap {
	border-bottom:solid 1px #<?php echo $s5_responsive_mobile_sidebar_section_border; ?>;
	font-family: <?php echo $s5_fonts_responsive_mobile_bar ?> !important;
	}
	
	#s5_pos_sidebar_top, #s5_pos_sidebar_bottom {
	border-bottom:solid 1px #<?php echo $s5_responsive_mobile_sidebar_section_border; ?>;
	}
	
	#s5_responsive_mobile_sidebar_login_bottom #modlgn-username, #s5_responsive_mobile_sidebar_login_bottom #modlgn-passwd, #s5_responsive_mobile_sidebar_register_bottom input {
	background:#<?php echo $s5_responsive_mobile_sidebar_inputbox_bg_color; ?>;
	color:#<?php echo $s5_responsive_mobile_sidebar_inputbox_font_color; ?>;
	border:solid 1px #<?php echo $s5_responsive_mobile_sidebar_inputbox_border_color; ?>;
	font-family: <?php echo $s5_fonts_responsive_mobile_bar ?> !important;
	}
	<?php if($s5_language_direction == '1') { ?>
	#s5_responsive_mobile_toggle_click_menu span {
	border-right:none !important;
	border-left:solid 1px #<?php echo $s5_responsive_mobile_bar_start; ?>;
	}
	#s5_responsive_mobile_toggle_click_menu {
	border-right:none !important;
	border-left:solid 1px #<?php echo $s5_responsive_mobile_bar_stop; ?>;
	float:right !important;
	}
	<?php } ?>

<?php } ?>

<?php if ($s5_responsive == "enabled" || $s5_responsive_cookie == "desktop") { ?>

	#s5_responsive_mobile_bottom_bar, #s5_responsive_mobile_top_bar {
	background:#<?php echo $s5_responsive_mobile_bar_stop; ?>;
	background: <?php if ($s5_responsive_mobile_bar_static == "enabled") { ?>url(<?php echo $s5_directory_path ?>/images/vertex/responsive/mobile_static_<?php echo $s5_responsive_mobile_bar_style; ?>.png), <?php } ?>-moz-linear-gradient(top, #<?php echo $s5_responsive_mobile_bar_start; ?> 0%, #<?php echo $s5_responsive_mobile_bar_stop; ?> 100%); /* FF3.6+ */
	background: <?php if ($s5_responsive_mobile_bar_static == "enabled") { ?>url(<?php echo $s5_directory_path ?>/images/vertex/responsive/mobile_static_<?php echo $s5_responsive_mobile_bar_style; ?>.png), <?php } ?>-webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $s5_responsive_mobile_bar_start; ?>), color-stop(100%,#<?php echo $s5_responsive_mobile_bar_stop; ?>)); /* Chrome,Safari4+ */
	background: <?php if ($s5_responsive_mobile_bar_static == "enabled") { ?>url(<?php echo $s5_directory_path ?>/images/vertex/responsive/mobile_static_<?php echo $s5_responsive_mobile_bar_style; ?>.png), <?php } ?>-webkit-linear-gradient(top, #<?php echo $s5_responsive_mobile_bar_start; ?> 0%,#<?php echo $s5_responsive_mobile_bar_stop; ?> 100%); /* Chrome10+,Safari5.1+ */
	background: <?php if ($s5_responsive_mobile_bar_static == "enabled") { ?>url(<?php echo $s5_directory_path ?>/images/vertex/responsive/mobile_static_<?php echo $s5_responsive_mobile_bar_style; ?>.png), <?php } ?>-o-linear-gradient(top, #<?php echo $s5_responsive_mobile_bar_start; ?> 0%,#<?php echo $s5_responsive_mobile_bar_stop; ?> 100%); /* Opera11.10+ */
	background: <?php if ($s5_responsive_mobile_bar_static == "enabled") { ?>url(<?php echo $s5_directory_path ?>/images/vertex/responsive/mobile_static_<?php echo $s5_responsive_mobile_bar_style; ?>.png), <?php } ?>-ms-linear-gradient(top, #<?php echo $s5_responsive_mobile_bar_start; ?> 0%,#<?php echo $s5_responsive_mobile_bar_stop; ?> 100%); /* IE10+ */
	background: <?php if ($s5_responsive_mobile_bar_static == "enabled") { ?>url(<?php echo $s5_directory_path ?>/images/vertex/responsive/mobile_static_<?php echo $s5_responsive_mobile_bar_style; ?>.png), <?php } ?>linear-gradient(top, #<?php echo $s5_responsive_mobile_bar_start; ?> 0%,#<?php echo $s5_responsive_mobile_bar_stop; ?> 100%); /* W3C */
	<?php if ($browser == "ie9") { ?>
	filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#<?php echo $s5_responsive_mobile_bar_start; ?>', EndColorStr='#<?php echo $s5_responsive_mobile_bar_stop; ?>'); /* IE9 */
	<?php } ?>
	<?php if ($browser == "ie7" || $browser == "ie8") { ?>
	-pie-background: <?php if ($s5_responsive_mobile_bar_static == "enabled") { ?>url(<?php echo $s5_directory_path ?>/images/vertex/responsive/mobile_static_<?php echo $s5_responsive_mobile_bar_style; ?>.png), <?php } ?>linear-gradient(top, #<?php echo $s5_responsive_mobile_bar_start; ?> 0%,#<?php echo $s5_responsive_mobile_bar_stop; ?> 100%); /* IE8 */
	behavior: url(<?php echo $s5_directory_path ?>/css/PIE.htc);
	<?php } ?>
	font-family: <?php echo $s5_fonts_responsive_mobile_bar ?> !important;
	}
	
	.s5_responsive_mobile_drop_down_inner, .s5_responsive_mobile_drop_down_inner input, .s5_responsive_mobile_drop_down_inner button, .s5_responsive_mobile_drop_down_inner .button, #s5_responsive_mobile_drop_down_search .validate {
	font-family: <?php echo $s5_fonts_responsive_mobile_bar ?> !important;
	}
	
	.s5_responsive_mobile_drop_down_inner button:hover, .s5_responsive_mobile_drop_down_inner .button:hover {
	background:#<?php echo $s5_responsive_mobile_bar_stop; ?> !important;
	}
	
	#s5_responsive_mobile_drop_down_menu, #s5_responsive_mobile_drop_down_menu a, #s5_responsive_mobile_drop_down_login a {
	font-family: <?php echo $s5_fonts_responsive_mobile_bar ?> !important;
	color:#<?php echo $s5_responsive_mobile_bar_font_color; ?> !important;
	}
	
	#s5_responsive_mobile_bar_active, #s5_responsive_mobile_drop_down_menu .current a, .s5_responsive_mobile_drop_down_inner .s5_mod_h3, .s5_responsive_mobile_drop_down_inner .s5_h3_first {
	color:#<?php echo $s5_responsive_mobile_bar_active_color; ?> !important;
	}
	
	.s5_responsive_mobile_drop_down_inner button, .s5_responsive_mobile_drop_down_inner .button, .s5_responsive_mobile_present #s5_responsive_mobile_drop_down_wrap .btn, .s5_responsive_mobile_present #s5_responsive_mobile_drop_down_wrap .btn:hover {
	background:#<?php echo $s5_responsive_mobile_bar_active_color; ?> !important;
	}
	
	#s5_responsive_mobile_drop_down_menu .active ul li, #s5_responsive_mobile_drop_down_menu .current ul li a, #s5_responsive_switch_mobile a, #s5_responsive_switch_desktop a, #s5_responsive_mobile_drop_down_wrap {
	color:#<?php echo $s5_responsive_mobile_bar_font_color; ?> !important;
	}
	
	#s5_responsive_mobile_toggle_click_menu span {
	border-right:solid 1px #<?php echo $s5_responsive_mobile_bar_start; ?>;
	}

	#s5_responsive_mobile_toggle_click_menu {
	border-right:solid 1px #<?php echo $s5_responsive_mobile_bar_stop; ?>;
	}

	#s5_responsive_mobile_toggle_click_search span, #s5_responsive_mobile_toggle_click_register span, #s5_responsive_mobile_toggle_click_login span, #s5_responsive_mobile_scroll a {
	border-left:solid 1px #<?php echo $s5_responsive_mobile_bar_start; ?>;
	}

	#s5_responsive_mobile_toggle_click_search, #s5_responsive_mobile_toggle_click_register, #s5_responsive_mobile_toggle_click_login, #s5_responsive_mobile_scroll {
	border-left:solid 1px #<?php echo $s5_responsive_mobile_bar_stop; ?>;
	}

	.s5_responsive_mobile_open, .s5_responsive_mobile_closed:hover, #s5_responsive_mobile_scroll:hover {
	background:#<?php echo $s5_responsive_mobile_bar_start; ?>;
	}

	#s5_responsive_mobile_drop_down_menu .s5_responsive_mobile_drop_down_inner, #s5_responsive_mobile_drop_down_register .s5_responsive_mobile_drop_down_inner, #s5_responsive_mobile_drop_down_login .s5_responsive_mobile_drop_down_inner, #s5_responsive_mobile_drop_down_search .s5_responsive_mobile_drop_down_inner {
	background:#<?php echo $s5_responsive_mobile_bar_start; ?>;
	}

<?php } ?>

<?php if ($s5_responsive_tablet_hide != "" && $s5_responsive == "enabled"){ ?>

	@media screen and (min-width:580px) and (max-width: 970px){
	
		<?php echo @implode(",",$s5_responsive_tablet_hide); ?> {
			display:none;
		}
	
	}
	
<?php } ?>

<?php if ($s5_responsive_mobile_hide != "" && $s5_responsive == "enabled"){ ?>

	@media screen and (max-width: 579px){
	
		<?php echo @implode(",",$s5_responsive_mobile_hide); ?> {
			display:none;
		}
	
	}
	
<?php } ?>

<?php if ($s5_max_body_width != ""){ ?>

	.s5_wrap {
	max-width:<?php echo $s5_max_body_width; ?>px !important;
	}
	
<?php } ?>

<?php if ($s5_columns_fixed_fluid == "px" && $s5_responsive_column_increase == "enabled" && $s5_responsive == "enabled" && $s5_fixed_fluid == "%"){ ?>

	<?php if ($s5_max_body_width >= "1300"){ ?>

	@media screen and (min-width: 1300px){
	
		#s5_right_top_wrap {
		width:<?php echo $s5_right_column_width * 1.3; ?>px !important;
		}
		#s5_right_inset_wrap {
		width:<?php echo $s5_right_inset_width * 1.3; ?>px !important;
		}
		#s5_right_wrap {
		width:<?php echo $s5_right_width * 1.3; ?>px !important;
		}
		#s5_right_bottom_wrap {
		width:<?php echo $s5_right_column_width * 1.3 ?>px !important;
		}
		#s5_left_top_wrap {
		width:<?php echo $s5_left_column_width * 1.3; ?>px !important;
		}
		#s5_left_inset_wrap {
		width:<?php echo $s5_left_inset_width * 1.3; ?>px !important;
		}
		#s5_left_wrap {
		width:<?php echo $s5_left_width * 1.3; ?>px !important;
		}
		#s5_left_bottom_wrap {
		width:<?php echo $s5_left_column_width * 1.3; ?>px !important;
		}
		#s5_right_column_wrap {
		width:<?php echo $s5_right_column_width * 1.3; ?>px !important;
		margin-left:-<?php echo ($s5_right_column_width + $s5_left_column_width) * 1.3; ?>px !important;
		}
		#s5_left_column_wrap {
		width:<?php echo $s5_left_column_width * 1.3; ?>px !important;
		}
		#s5_center_column_wrap_inner {
		margin-left:<?php echo $s5_center_column_margin_left * 1.3; ?>px !important;
		margin-right:<?php echo $s5_center_column_margin_right * 1.3; ?>px !important;
		}
	
	}
	
	<?php } ?>
	
	<?php if ($s5_max_body_width >= "1900"){ ?>
	
	@media screen and (min-width: 1900px){
	
		#s5_right_top_wrap {
		width:<?php echo $s5_right_column_width * 1.6; ?>px !important;
		}
		#s5_right_inset_wrap {
		width:<?php echo $s5_right_inset_width * 1.6; ?>px !important;
		}
		#s5_right_wrap {
		width:<?php echo $s5_right_width * 1.6; ?>px !important;
		}
		#s5_right_bottom_wrap {
		width:<?php echo $s5_right_column_width * 1.6; ?>px !important;
		}
		#s5_left_top_wrap {
		width:<?php echo $s5_left_column_width * 1.6; ?>px !important;
		}
		#s5_left_inset_wrap {
		width:<?php echo $s5_left_inset_width * 1.6; ?>px !important;
		}
		#s5_left_wrap {
		width:<?php echo $s5_left_width * 1.6; ?>px !important;
		}
		#s5_left_bottom_wrap {
		width:<?php echo $s5_left_column_width * 1.6; ?>px !important;
		}
		#s5_right_column_wrap {
		width:<?php echo $s5_right_column_width * 1.6; ?>px !important;
		margin-left:-<?php echo ($s5_right_column_width + $s5_left_column_width) * 1.6; ?>px !important;
		}
		#s5_left_column_wrap {
		width:<?php echo $s5_left_column_width * 1.6; ?>px !important;
		}
		#s5_center_column_wrap_inner {
		margin-left:<?php echo $s5_center_column_margin_left * 1.6; ?>px !important;
		margin-right:<?php echo $s5_center_column_margin_right * 1.6; ?>px !important;
		}
	
	}
	
	<?php } ?>
	
	<?php if ($s5_max_body_width >= "2500"){ ?>
	
	@media screen and (min-width: 2500px){
	
		#s5_right_top_wrap {
		width:<?php echo $s5_right_column_width * 1.9; ?>px !important;
		}
		#s5_right_inset_wrap {
		width:<?php echo $s5_right_inset_width * 1.9; ?>px !important;
		}
		#s5_right_wrap {
		width:<?php echo $s5_right_width * 1.9; ?>px !important;
		}
		#s5_right_bottom_wrap {
		width:<?php echo $s5_right_column_width * 1.9; ?>px !important;
		}
		#s5_left_top_wrap {
		width:<?php echo $s5_left_column_width * 1.9; ?>px !important;
		}
		#s5_left_inset_wrap {
		width:<?php echo $s5_left_inset_width * 1.9; ?>px !important;
		}
		#s5_left_wrap {
		width:<?php echo $s5_left_width * 1.9; ?>px !important;
		}
		#s5_left_bottom_wrap {
		width:<?php echo $s5_left_column_width * 1.9; ?>px !important;
		}
		#s5_right_column_wrap {
		width:<?php echo $s5_right_column_width * 1.9; ?>px !important;
		margin-left:-<?php echo ($s5_right_column_width + $s5_left_column_width) * 1.9; ?>px !important;
		}
		#s5_left_column_wrap {
		width:<?php echo $s5_left_column_width * 1.9; ?>px !important;
		}
		#s5_center_column_wrap_inner {
		margin-left:<?php echo $s5_center_column_margin_left * 1.9; ?>px !important;
		margin-right:<?php echo $s5_center_column_margin_right * 1.9; ?>px !important;
		}
	
	}
	
	<?php } ?>
	
<?php } ?>

<?php 
if ($s5_right_width >= $s5_right_inset_width) {
$s5_right_largest = $s5_right_width;
}
else {
$s5_right_largest = $s5_right_inset_width;
}
if ($s5_left_width >= $s5_left_inset_width) {
$s5_left_largest = $s5_left_width;
}
else {
$s5_left_largest = $s5_left_inset_width;
}
if (($s5_pos_right_inset == "unpublished" && $s5_pos_right == "unpublished") && ($s5_pos_right_top == "published" || $s5_pos_right_bottom == "published")) {
$s5_right_largest = $s5_right_column_width;
}
if (($s5_pos_left_inset == "unpublished" && $s5_pos_left == "unpublished") && ($s5_pos_left_top == "published" || $s5_pos_left_bottom == "published")) {
$s5_left_largest = $s5_left_column_width;
}
?>

<?php if ($s5_columns_fixed_fluid == "px" && $s5_responsive == "enabled") { ?>

	@media screen and (max-width: 970px){
	
		#s5_right_top_wrap {
		width:<?php echo $s5_right_largest; ?>px !important;
		}
		#s5_right_inset_wrap {
		width:<?php echo $s5_right_largest; ?>px !important;
		}
		#s5_right_wrap {
		width:<?php echo $s5_right_largest; ?>px !important;
		}
		#s5_right_bottom_wrap {
		width:<?php echo $s5_right_largest; ?>px !important;
		}
		#s5_left_top_wrap {
		width:<?php echo $s5_left_largest; ?>px !important;
		}
		#s5_left_inset_wrap {
		width:<?php echo $s5_left_largest; ?>px !important;
		}
		#s5_left_wrap {
		width:<?php echo $s5_left_largest; ?>px !important;
		}
		#s5_left_bottom_wrap {
		width:<?php echo $s5_left_largest; ?>px !important;
		}
		#s5_right_column_wrap {
		width:<?php echo $s5_right_largest; ?>px !important;
		margin-left:-<?php echo ($s5_right_largest + $s5_left_largest); ?>px !important;
		}
		#s5_left_column_wrap {
		width:<?php echo $s5_left_largest; ?>px !important;
		}
		#s5_center_column_wrap_inner {
		margin-left:<?php echo $s5_left_largest; ?>px !important;
		margin-right:<?php echo $s5_right_largest; ?>px !important;
		}
	
	}
	

<?php } ?>


<?php if ($s5_columns_fixed_fluid == "px" && $s5_responsive_columns_small_tablet == "reduce"  && $s5_responsive == "enabled"){ ?>

	@media screen and (max-width: 750px){
	
		#s5_right_top_wrap {
		width:<?php echo $s5_right_largest * 0.8; ?>px !important;
		}
		#s5_right_inset_wrap {
		width:<?php echo $s5_right_largest * 0.8; ?>px !important;
		}
		#s5_right_wrap {
		width:<?php echo $s5_right_largest * 0.8; ?>px !important;
		}
		#s5_right_bottom_wrap {
		width:<?php echo $s5_right_largest * 0.8; ?>px !important;
		}
		#s5_left_top_wrap {
		width:<?php echo $s5_left_largest * 0.8; ?>px !important;
		}
		#s5_left_inset_wrap {
		width:<?php echo $s5_left_largest * 0.8; ?>px !important;
		}
		#s5_left_wrap {
		width:<?php echo $s5_left_largest * 0.8; ?>px !important;
		}
		#s5_left_bottom_wrap {
		width:<?php echo $s5_left_largest * 0.8; ?>px !important;
		}
		#s5_right_column_wrap {
		width:<?php echo $s5_right_largest * 0.8; ?>px !important;
		margin-left:-<?php echo ($s5_right_largest + $s5_left_largest) * 0.8; ?>px !important;
		}
		#s5_left_column_wrap {
		width:<?php echo $s5_left_largest * 0.8; ?>px !important;
		}
		#s5_center_column_wrap_inner {
		margin-left:<?php echo $s5_left_largest * 0.8; ?>px !important;
		margin-right:<?php echo $s5_right_largest * 0.8; ?>px !important;
		}
	
	}

<?php } ?>


<?php if ($s5_columns_fixed_fluid == "px" && $s5_responsive_columns_small_tablet == "single"  && $s5_responsive == "enabled"){ ?>

		@media screen and (max-width: 750px){

		#s5_columns_wrap_inner {
		width:100% !important;
		}

		#s5_center_column_wrap {
		width:100% !important;
		left:100% !important;
		}

		#s5_left_column_wrap {
		left:0% !important;
		}
		
		#s5_left_top_wrap, #s5_left_column_wrap, #s5_left_inset_wrap, #s5_left_wrap, #s5_left_bottom_wrap, #s5_right_top_wrap, #s5_right_column_wrap, #s5_right_inset_wrap, #s5_right_wrap, #s5_right_bottom_wrap {
		width:100% !important;
		}
		
		#s5_center_column_wrap_inner {
		margin:0px !important;
		}
		
		#s5_left_column_wrap {
		margin-right:0px !important;
		}
		
		#s5_right_column_wrap {
		margin-left:0px !important;
		}
		
		.items-row .item {
		width:100% !important;
		padding-left:0px !important;
		padding-right:0px !important;
		margin-right:0px !important;
		margin-left:0px !important;
		}
	
	}

<?php } ?>


<?php if ($s5_columns_fixed_fluid == "%" && $s5_responsive == "enabled" && $s5_responsive_fluid_comibine_columns != "default") { ?>

	@media screen and (max-width: <?php echo $s5_responsive_fluid_comibine_columns; ?>px){
	
		#s5_right_wrap, #s5_left_wrap, #s5_right_inset_wrap, #s5_left_inset_wrap, #s5_right_top_wrap, #s5_left_top_wrap, #s5_right_bottom_wrap, #s5_left_bottom_wrap {
		width:100% !important;
		}
		#s5_right_column_wrap {
		width:<?php echo $s5_right_largest/2; ?>% !important;
		margin-left:-<?php echo ($s5_right_largest + $s5_left_largest)/2; ?>% !important;
		}
		#s5_left_column_wrap {
		width:<?php echo $s5_left_largest/2; ?>% !important;
		}
		#s5_center_column_wrap_inner {
		margin-left:<?php echo $s5_left_largest; ?>% !important;
		margin-right:<?php echo $s5_right_largest; ?>% !important;
		}
	
	}
	

<?php } ?>


<?php if ($s5_columns_fixed_fluid == "%" && $s5_responsive_fluid_single_column != "default"  && $s5_responsive == "enabled"){ ?>

		@media screen and (max-width: <?php echo $s5_responsive_fluid_single_column; ?>px){

		#s5_columns_wrap_inner {
		width:100% !important;
		}

		#s5_center_column_wrap {
		width:100% !important;
		left:100% !important;
		}

		#s5_left_column_wrap {
		left:0% !important;
		}
		
		#s5_left_top_wrap, #s5_left_column_wrap, #s5_left_inset_wrap, #s5_left_wrap, #s5_left_bottom_wrap, #s5_right_top_wrap, #s5_right_column_wrap, #s5_right_inset_wrap, #s5_right_wrap, #s5_right_bottom_wrap {
		width:100% !important;
		}
		
		#s5_center_column_wrap_inner {
		margin:0px !important;
		}
		
		#s5_left_column_wrap {
		margin-right:0px !important;
		}
		
		#s5_right_column_wrap {
		margin-left:0px !important;
		}
		
		.items-row .item {
		width:100% !important;
		padding-left:0px !important;
		padding-right:0px !important;
		margin-right:0px !important;
		margin-left:0px !important;
		}
	
	}

<?php } ?>


<?php if ($s5_responsive_center_single_column != "default" && $s5_responsive == "enabled"){ ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_center_single_column; ?>px){
		
		#s5_middle_top .s5_float_left, #s5_middle_bottom .s5_float_left {
		width:100% !important;
		}
		
		.items-row .item {
		width:100% !important;
		padding-left:0px !important;
		padding-right:0px !important;
		margin-right:0px !important;
		margin-left:0px !important;
		}
	
	}

<?php } ?>



<?php if ($s5_responsive_row_widths_top_row_1 != "default" && $s5_responsive == "enabled"){

	$s5_responsive_row_widths_top_row_1_exploded = explode(":", $s5_responsive_row_widths_top_row_1); ?>
	
	<?php if ($s5_responsive_row_widths_top_row_1_exploded[0] == "1") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_1_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row1 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row1 .s5_float_left {
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_1_exploded[0] == "2") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_1_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row1 {
			min-height: 0px !important;
			}
			<?php } ?>
			
			#s5_top_row1 .s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_1_exploded[0] == "3") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_1_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row1 {
			min-height: 0px !important;
			}
			<?php } ?>
			
			#s5_top_row1 .s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_1_exploded[0] == "4") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_1_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row1 {
			min-height: 0px !important;
			}
			<?php } ?>
			
			#s5_top_row1 #s5_pos_top_row1_1.s5_float_left, #s5_top_row1 #s5_pos_top_row1_2.s5_float_left, #s5_top_row1 #s5_pos_top_row1_3.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}
			
			#s5_top_row1 #s5_pos_top_row1_4.s5_float_left, #s5_top_row1 #s5_pos_top_row1_5.s5_float_left, #s5_top_row1 #s5_pos_top_row1_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_1_exploded[0] == "5") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_1_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row1 {
			min-height: 0px !important;
			}
			<?php } ?>
			
			#s5_top_row1 #s5_pos_top_row1_1.s5_float_left, #s5_top_row1 #s5_pos_top_row1_2.s5_float_left {
			float:left !important;
			width:50% !important;
			}
			
			#s5_top_row1 #s5_pos_top_row1_3.s5_float_left, #s5_top_row1 #s5_pos_top_row1_4.s5_float_left, #s5_top_row1 #s5_pos_top_row1_5.s5_float_left, #s5_top_row1 #s5_pos_top_row1_6.s5_float_left {
			float:left !important;
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_1_exploded[0] == "6") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_1_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row1 {
			min-height: 0px !important;
			}
			<?php } ?>
			
			#s5_top_row1 #s5_pos_top_row1_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_top_row1 #s5_pos_top_row1_2.s5_float_left, #s5_top_row1 #s5_pos_top_row1_3.s5_float_left, #s5_top_row1 #s5_pos_top_row1_4.s5_float_left, #s5_top_row1 #s5_pos_top_row1_5.s5_float_left, #s5_top_row1 #s5_pos_top_row1_6.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_1_exploded[0] == "7") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_1_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row1 {
			min-height: 0px !important;
			}
			<?php } ?>
			
			#s5_top_row1 #s5_pos_top_row1_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_top_row1 #s5_pos_top_row1_2.s5_float_left, #s5_top_row1 #s5_pos_top_row1_3.s5_float_left, #s5_top_row1 #s5_pos_top_row1_4.s5_float_left, #s5_top_row1 #s5_pos_top_row1_5.s5_float_left, #s5_top_row1 #s5_pos_top_row1_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>

<?php } ?>


<?php if ($s5_responsive_row_widths_top_row_2 != "default" && $s5_responsive == "enabled"){

	$s5_responsive_row_widths_top_row_2_exploded = explode(":", $s5_responsive_row_widths_top_row_2); ?>
	
	<?php if ($s5_responsive_row_widths_top_row_2_exploded[0] == "1") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_2_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row2 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row2 .s5_float_left {
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_2_exploded[0] == "2") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_2_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row2 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row2 .s5_float_left {
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_2_exploded[0] == "3") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_2_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row2 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row2 .s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_2_exploded[0] == "4") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_2_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row2 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row2 #s5_pos_top_row2_1.s5_float_left, #s5_top_row2 #s5_pos_top_row2_2.s5_float_left, #s5_top_row2 #s5_pos_top_row2_3.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}
			
			#s5_top_row2 #s5_pos_top_row2_4.s5_float_left, #s5_top_row2 #s5_pos_top_row2_5.s5_float_left, #s5_top_row2 #s5_pos_top_row2_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_2_exploded[0] == "5") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_2_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row2 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row2 #s5_pos_top_row2_1.s5_float_left, #s5_top_row2 #s5_pos_top_row2_2.s5_float_left {
			float:left !important;
			width:50% !important;
			}
			
			#s5_top_row2 #s5_pos_top_row2_3.s5_float_left, #s5_top_row2 #s5_pos_top_row2_4.s5_float_left, #s5_top_row2 #s5_pos_top_row2_5.s5_float_left, #s5_top_row2 #s5_pos_top_row2_6.s5_float_left {
			float:left !important;
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_2_exploded[0] == "6") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_2_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row2 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row2 #s5_pos_top_row2_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_top_row2 #s5_pos_top_row2_2.s5_float_left, #s5_top_row2 #s5_pos_top_row2_3.s5_float_left, #s5_top_row2 #s5_pos_top_row2_4.s5_float_left, #s5_top_row2 #s5_pos_top_row2_5.s5_float_left, #s5_top_row2 #s5_pos_top_row2_6.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_2_exploded[0] == "7") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_2_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row2 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row2 #s5_pos_top_row2_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_top_row2 #s5_pos_top_row2_2.s5_float_left, #s5_top_row2 #s5_pos_top_row2_3.s5_float_left, #s5_top_row2 #s5_pos_top_row2_4.s5_float_left, #s5_top_row2 #s5_pos_top_row2_5.s5_float_left, #s5_top_row2 #s5_pos_top_row2_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>

<?php } ?>


<?php if ($s5_responsive_row_widths_top_row_3 != "default" && $s5_responsive == "enabled"){

	$s5_responsive_row_widths_top_row_3_exploded = explode(":", $s5_responsive_row_widths_top_row_3); ?>
	
	<?php if ($s5_responsive_row_widths_top_row_3_exploded[0] == "1") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_3_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row3 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row3 .s5_float_left {
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_3_exploded[0] == "2") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_3_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row3 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row3 .s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_3_exploded[0] == "3") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_3_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row3 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row3 .s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_3_exploded[0] == "4") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_3_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row3 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row3 #s5_pos_top_row3_1.s5_float_left, #s5_top_row3 #s5_pos_top_row3_2.s5_float_left, #s5_top_row3 #s5_pos_top_row3_3.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}
			
			#s5_top_row3 #s5_pos_top_row3_4.s5_float_left, #s5_top_row3 #s5_pos_top_row3_5.s5_float_left, #s5_top_row3 #s5_pos_top_row3_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_3_exploded[0] == "5") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_3_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row3 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row3 #s5_pos_top_row3_1.s5_float_left, #s5_top_row3 #s5_pos_top_row3_2.s5_float_left {
			float:left !important;
			width:50% !important;
			}
			
			#s5_top_row3 #s5_pos_top_row3_3.s5_float_left, #s5_top_row3 #s5_pos_top_row3_4.s5_float_left, #s5_top_row3 #s5_pos_top_row3_5.s5_float_left, #s5_top_row3 #s5_pos_top_row3_6.s5_float_left {
			float:left !important;
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_3_exploded[0] == "6") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_3_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row3 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row3 #s5_pos_top_row3_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_top_row3 #s5_pos_top_row3_2.s5_float_left, #s5_top_row3 #s5_pos_top_row3_3.s5_float_left, #s5_top_row3 #s5_pos_top_row3_4.s5_float_left, #s5_top_row3 #s5_pos_top_row3_5.s5_float_left, #s5_top_row3 #s5_pos_top_row3_6.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_top_row_3_exploded[0] == "7") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_top_row_3_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_top_row3 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_top_row3 #s5_pos_top_row3_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_top_row3 #s5_pos_top_row3_2.s5_float_left, #s5_top_row3 #s5_pos_top_row3_3.s5_float_left, #s5_top_row3 #s5_pos_top_row3_4.s5_float_left, #s5_top_row3 #s5_pos_top_row3_5.s5_float_left, #s5_top_row3 #s5_pos_top_row3_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>

<?php } ?>


<?php if ($s5_responsive_row_widths_above_columns != "default" && $s5_responsive == "enabled"){

	$s5_responsive_row_widths_above_columns_exploded = explode(":", $s5_responsive_row_widths_above_columns); ?>
	
	<?php if ($s5_responsive_row_widths_above_columns_exploded[0] == "1") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_above_columns_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_above_columns_inner {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_above_columns_inner .s5_float_left {
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_above_columns_exploded[0] == "2") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_above_columns_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_above_columns_inner {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_above_columns_inner .s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_above_columns_exploded[0] == "3") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_above_columns_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_above_columns_inner {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_above_columns_inner .s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_above_columns_exploded[0] == "4") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_above_columns_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_above_columns_inner {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_above_columns_inner #s5_above_columns_1.s5_float_left, #s5_above_columns_inner #s5_above_columns_2.s5_float_left, #s5_above_columns_inner #s5_above_columns_3.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}
			
			#s5_above_columns_inner #s5_above_columns_4.s5_float_left, #s5_above_columns_inner #s5_above_columns_5.s5_float_left, #s5_above_columns_inner #s5_above_columns_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_above_columns_exploded[0] == "5") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_above_columns_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_above_columns_inner {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_above_columns_inner #s5_above_columns_1.s5_float_left, #s5_above_columns_inner #s5_above_columns_2.s5_float_left {
			float:left !important;
			width:50% !important;
			}
			
			#s5_above_columns_inner #s5_above_columns_3.s5_float_left, #s5_above_columns_inner #s5_above_columns_4.s5_float_left, #s5_above_columns_inner #s5_above_columns_5.s5_float_left, #s5_above_columns_inner #s5_above_columns_6.s5_float_left {
			float:left !important;
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_above_columns_exploded[0] == "6") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_above_columns_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_above_columns_inner {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_above_columns_inner #s5_above_columns_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_above_columns_inner #s5_above_columns_2.s5_float_left, #s5_above_columns_inner #s5_above_columns_3.s5_float_left, #s5_above_columns_inner #s5_above_columns_4.s5_float_left, #s5_above_columns_inner #s5_above_columns_5.s5_float_left, #s5_above_columns_inner #s5_above_columns_6.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_above_columns_exploded[0] == "7") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_above_columns_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_above_columns_inner {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_above_columns_inner #s5_above_columns_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_above_columns_inner #s5_above_columns_2.s5_float_left, #s5_above_columns_inner #s5_above_columns_3.s5_float_left, #s5_above_columns_inner #s5_above_columns_4.s5_float_left, #s5_above_columns_inner #s5_above_columns_5.s5_float_left, #s5_above_columns_inner #s5_above_columns_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>

<?php } ?>


<?php if ($s5_responsive_row_widths_middle_top != "default" && $s5_responsive == "enabled"){

	$s5_responsive_row_widths_middle_top_exploded = explode(":", $s5_responsive_row_widths_middle_top); ?>
	
	<?php if ($s5_responsive_row_widths_middle_top_exploded[0] == "1") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_middle_top_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_middle_top {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_middle_top .s5_float_left {
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_middle_top_exploded[0] == "2") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_middle_top_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_middle_top {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_middle_top .s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_middle_top_exploded[0] == "3") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_middle_top_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_middle_top {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_middle_top .s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_middle_top_exploded[0] == "4") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_middle_top_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_middle_top {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_middle_top #s5_pos_middle_top_1.s5_float_left, #s5_middle_top #s5_pos_middle_top_2.s5_float_left, #s5_middle_top #s5_pos_middle_top_3.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}
			
			#s5_middle_top #s5_pos_middle_top_4.s5_float_left, #s5_middle_top #s5_pos_middle_top_5.s5_float_left, #s5_middle_top #s5_pos_middle_top_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_middle_top_exploded[0] == "5") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_middle_top_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_middle_top {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_middle_top #s5_pos_middle_top_1.s5_float_left, #s5_middle_top #s5_pos_middle_top_2.s5_float_left {
			float:left !important;
			width:50% !important;
			}
			
			#s5_middle_top #s5_pos_middle_top_3.s5_float_left, #s5_middle_top #s5_pos_middle_top_4.s5_float_left, #s5_middle_top #s5_pos_middle_top_5.s5_float_left, #s5_middle_top #s5_pos_middle_top_6.s5_float_left {
			float:left !important;
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_middle_top_exploded[0] == "6") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_middle_top_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_middle_top {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_middle_top #s5_pos_middle_top_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_middle_top #s5_pos_middle_top_2.s5_float_left, #s5_middle_top #s5_pos_middle_top_3.s5_float_left, #s5_middle_top #s5_pos_middle_top_4.s5_float_left, #s5_middle_top #s5_pos_middle_top_5.s5_float_left, #s5_middle_top #s5_pos_middle_top_6.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_middle_top_exploded[0] == "7") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_middle_top_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_middle_top {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_middle_top #s5_pos_middle_top_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_middle_top #s5_pos_middle_top_2.s5_float_left, #s5_middle_top #s5_pos_middle_top_3.s5_float_left, #s5_middle_top #s5_pos_middle_top_4.s5_float_left, #s5_middle_top #s5_pos_middle_top_5.s5_float_left, #s5_middle_top #s5_pos_middle_top_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>

<?php } ?>


<?php if ($s5_responsive_row_widths_above_body != "default" && $s5_responsive == "enabled"){

	$s5_responsive_row_widths_above_body_exploded = explode(":", $s5_responsive_row_widths_above_body); ?>
	
	<?php if ($s5_responsive_row_widths_above_body_exploded[0] == "1") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_above_body_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_above_body {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_above_body_inner .s5_float_left {
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_above_body_exploded[0] == "2") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_above_body_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_above_body {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_above_body_inner .s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_above_body_exploded[0] == "3") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_above_body_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_above_body {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_above_body_inner .s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_above_body_exploded[0] == "4") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_above_body_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_above_body {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_above_body_inner #s5_above_body_1.s5_float_left, #s5_above_body_inner #s5_above_body_2.s5_float_left, #s5_above_body_inner #s5_above_body_3.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}
			
			#s5_above_body_inner #s5_above_body_4.s5_float_left, #s5_above_body_inner #s5_above_body_5.s5_float_left, #s5_above_body_inner #s5_above_body_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_above_body_exploded[0] == "5") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_above_body_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_above_body {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_above_body_inner #s5_above_body_1.s5_float_left, #s5_above_body_inner #s5_above_body_2.s5_float_left {
			float:left !important;
			width:50% !important;
			}
			
			#s5_above_body_inner #s5_above_body_3.s5_float_left, #s5_above_body_inner #s5_above_body_4.s5_float_left, #s5_above_body_inner #s5_above_body_5.s5_float_left, #s5_above_body_inner #s5_above_body_6.s5_float_left {
			float:left !important;
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_above_body_exploded[0] == "6") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_above_body_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_above_body {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_above_body_inner #s5_above_body_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_above_body_inner #s5_above_body_2.s5_float_left, #s5_above_body_inner #s5_above_body_3.s5_float_left, #s5_above_body_inner #s5_above_body_4.s5_float_left, #s5_above_body_inner #s5_above_body_5.s5_float_left, #s5_above_body_inner #s5_above_body_6.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_above_body_exploded[0] == "7") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_above_body_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_above_body {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_above_body_inner #s5_above_body_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_above_body_inner #s5_above_body_2.s5_float_left, #s5_above_body_inner #s5_above_body_3.s5_float_left, #s5_above_body_inner #s5_above_body_4.s5_float_left, #s5_above_body_inner #s5_above_body_5.s5_float_left, #s5_above_body_inner #s5_above_body_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>

<?php } ?>


<?php if ($s5_responsive_row_widths_middle_bottom != "default" && $s5_responsive == "enabled"){

	$s5_responsive_row_widths_middle_bottom_exploded = explode(":", $s5_responsive_row_widths_middle_bottom); ?>
	
	<?php if ($s5_responsive_row_widths_middle_bottom_exploded[0] == "1") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_middle_bottom_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_middle_bottom {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_middle_bottom .s5_float_left {
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_middle_bottom_exploded[0] == "2") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_middle_bottom_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_middle_bottom {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_middle_bottom .s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_middle_bottom_exploded[0] == "3") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_middle_bottom_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_middle_bottom {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_middle_bottom .s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_middle_bottom_exploded[0] == "4") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_middle_bottom_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_middle_bottom {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_middle_bottom #s5_pos_middle_bottom_1.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_2.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_3.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}
			
			#s5_middle_bottom #s5_pos_middle_bottom_4.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_5.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_middle_bottom_exploded[0] == "5") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_middle_bottom_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_middle_bottom {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_middle_bottom #s5_pos_middle_bottom_1.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_2.s5_float_left {
			float:left !important;
			width:50% !important;
			}
			
			#s5_middle_bottom #s5_pos_middle_bottom_3.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_4.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_5.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_6.s5_float_left {
			float:left !important;
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_middle_bottom_exploded[0] == "6") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_middle_bottom_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_middle_bottom {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_middle_bottom #s5_pos_middle_bottom_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_middle_bottom #s5_pos_middle_bottom_2.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_3.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_4.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_5.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_6.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_middle_bottom_exploded[0] == "7") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_middle_bottom_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_middle_bottom {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_middle_bottom #s5_pos_middle_bottom_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_middle_bottom #s5_pos_middle_bottom_2.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_3.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_4.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_5.s5_float_left, #s5_middle_bottom #s5_pos_middle_bottom_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>

<?php } ?>


<?php if ($s5_responsive_row_widths_below_body != "default" && $s5_responsive == "enabled"){

	$s5_responsive_row_widths_below_body_exploded = explode(":", $s5_responsive_row_widths_below_body); ?>
	
	<?php if ($s5_responsive_row_widths_below_body_exploded[0] == "1") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_below_body_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_below_body {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_below_body_inner .s5_float_left {
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_below_body_exploded[0] == "2") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_below_body_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_below_body {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_below_body_inner .s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_below_body_exploded[0] == "3") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_below_body_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_below_body {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_below_body_inner .s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_below_body_exploded[0] == "4") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_below_body_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_below_body {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_below_body_inner #s5_below_body_1.s5_float_left, #s5_below_body_inner #s5_below_body_2.s5_float_left, #s5_below_body_inner #s5_below_body_3.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}
			
			#s5_below_body_inner #s5_below_body_4.s5_float_left, #s5_below_body_inner #s5_below_body_5.s5_float_left, #s5_below_body_inner #s5_below_body_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_below_body_exploded[0] == "5") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_below_body_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_below_body {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_below_body_inner #s5_below_body_1.s5_float_left, #s5_below_body_inner #s5_below_body_2.s5_float_left {
			float:left !important;
			width:50% !important;
			}
			
			#s5_below_body_inner #s5_below_body_3.s5_float_left, #s5_below_body_inner #s5_below_body_4.s5_float_left, #s5_below_body_inner #s5_below_body_5.s5_float_left, #s5_below_body_inner #s5_below_body_6.s5_float_left {
			float:left !important;
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_below_body_exploded[0] == "6") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_below_body_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_below_body {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_below_body_inner #s5_below_body_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_below_body_inner #s5_below_body_2.s5_float_left, #s5_below_body_inner #s5_below_body_3.s5_float_left, #s5_below_body_inner #s5_below_body_4.s5_float_left, #s5_below_body_inner #s5_below_body_5.s5_float_left, #s5_below_body_inner #s5_below_body_6.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_below_body_exploded[0] == "7") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_below_body_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_below_body {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_below_body_inner #s5_below_body_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_below_body_inner #s5_below_body_2.s5_float_left, #s5_below_body_inner #s5_below_body_3.s5_float_left, #s5_below_body_inner #s5_below_body_4.s5_float_left, #s5_below_body_inner #s5_below_body_5.s5_float_left, #s5_below_body_inner #s5_below_body_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>

<?php } ?>


<?php if ($s5_responsive_row_widths_below_columns != "default" && $s5_responsive == "enabled"){

	$s5_responsive_row_widths_below_columns_exploded = explode(":", $s5_responsive_row_widths_below_columns); ?>
	
	<?php if ($s5_responsive_row_widths_below_columns_exploded[0] == "1") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_below_columns_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_below_columns_inner {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_below_columns_inner .s5_float_left {
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_below_columns_exploded[0] == "2") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_below_columns_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_below_columns_inner {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_below_columns_inner .s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_below_columns_exploded[0] == "3") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_below_columns_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_below_columns_inner {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_below_columns_inner .s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_below_columns_exploded[0] == "4") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_below_columns_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_below_columns_inner {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_below_columns_inner #s5_below_columns_1.s5_float_left, #s5_below_columns_inner #s5_below_columns_2.s5_float_left, #s5_below_columns_inner #s5_below_columns_3.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}
			
			#s5_below_columns_inner #s5_below_columns_4.s5_float_left, #s5_below_columns_inner #s5_below_columns_5.s5_float_left, #s5_below_columns_inner #s5_below_columns_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_below_columns_exploded[0] == "5") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_below_columns_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_below_columns_inner {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_below_columns_inner #s5_below_columns_1.s5_float_left, #s5_below_columns_inner #s5_below_columns_2.s5_float_left {
			float:left !important;
			width:50% !important;
			}
			
			#s5_below_columns_inner #s5_below_columns_3.s5_float_left, #s5_below_columns_inner #s5_below_columns_4.s5_float_left, #s5_below_columns_inner #s5_below_columns_5.s5_float_left, #s5_below_columns_inner #s5_below_columns_6.s5_float_left {
			float:left !important;
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_below_columns_exploded[0] == "6") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_below_columns_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_below_columns_inner {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_below_columns_inner #s5_below_columns_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_below_columns_inner #s5_below_columns_2.s5_float_left, #s5_below_columns_inner #s5_below_columns_3.s5_float_left, #s5_below_columns_inner #s5_below_columns_4.s5_float_left, #s5_below_columns_inner #s5_below_columns_5.s5_float_left, #s5_below_columns_inner #s5_below_columns_6.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_below_columns_exploded[0] == "7") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_below_columns_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_below_columns_inner {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_below_columns_inner #s5_below_columns_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_below_columns_inner #s5_below_columns_2.s5_float_left, #s5_below_columns_inner #s5_below_columns_3.s5_float_left, #s5_below_columns_inner #s5_below_columns_4.s5_float_left, #s5_below_columns_inner #s5_below_columns_5.s5_float_left, #s5_below_columns_inner #s5_below_columns_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>

<?php } ?>


<?php if ($s5_responsive_row_widths_bottom_row_1 != "default" && $s5_responsive == "enabled"){

	$s5_responsive_row_widths_bottom_row_1_exploded = explode(":", $s5_responsive_row_widths_bottom_row_1); ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_1_exploded[0] == "1") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_1_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row1 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row1 .s5_float_left {
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_1_exploded[0] == "2") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_1_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row1 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row1 .s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_1_exploded[0] == "3") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_1_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row1 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row1 .s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_1_exploded[0] == "4") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_1_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row1 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row1 #s5_pos_bottom_row1_1.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_2.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_3.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}
			
			#s5_bottom_row1 #s5_pos_bottom_row1_4.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_5.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_1_exploded[0] == "5") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_1_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row1 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row1 #s5_pos_bottom_row1_1.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_2.s5_float_left {
			float:left !important;
			width:50% !important;
			}
			
			#s5_bottom_row1 #s5_pos_bottom_row1_3.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_4.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_5.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_6.s5_float_left {
			float:left !important;
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_1_exploded[0] == "6") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_1_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row1 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row1 #s5_pos_bottom_row1_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_bottom_row1 #s5_pos_bottom_row1_2.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_3.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_4.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_5.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_6.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_1_exploded[0] == "7") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_1_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row1 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row1 #s5_pos_bottom_row1_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_bottom_row1 #s5_pos_bottom_row1_2.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_3.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_4.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_5.s5_float_left, #s5_bottom_row1 #s5_pos_bottom_row1_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>

<?php } ?>


<?php if ($s5_responsive_row_widths_bottom_row_2 != "default" && $s5_responsive == "enabled"){

	$s5_responsive_row_widths_bottom_row_2_exploded = explode(":", $s5_responsive_row_widths_bottom_row_2); ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_2_exploded[0] == "1") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_2_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row2 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row2 .s5_float_left {
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_2_exploded[0] == "2") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_2_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row2 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row2 .s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_2_exploded[0] == "3") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_2_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row2 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row2 .s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_2_exploded[0] == "4") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_2_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row2 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row2 #s5_pos_bottom_row2_1.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_2.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_3.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}
			
			#s5_bottom_row2 #s5_pos_bottom_row2_4.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_5.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_2_exploded[0] == "5") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_2_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row2 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row2 #s5_pos_bottom_row2_1.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_2.s5_float_left {
			float:left !important;
			width:50% !important;
			}
			
			#s5_bottom_row2 #s5_pos_bottom_row2_3.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_4.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_5.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_6.s5_float_left {
			float:left !important;
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_2_exploded[0] == "6") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_2_exploded[1]; ?>px){
			
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row2 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row2 #s5_pos_bottom_row2_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_bottom_row2 #s5_pos_bottom_row2_2.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_3.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_4.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_5.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_6.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_2_exploded[0] == "7") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_2_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row2 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row2 #s5_pos_bottom_row2_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_bottom_row2 #s5_pos_bottom_row2_2.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_3.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_4.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_5.s5_float_left, #s5_bottom_row2 #s5_pos_bottom_row2_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>

<?php } ?>


<?php if ($s5_responsive_row_widths_bottom_row_3 != "default" && $s5_responsive == "enabled"){

	$s5_responsive_row_widths_bottom_row_3_exploded = explode(":", $s5_responsive_row_widths_bottom_row_3); ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_3_exploded[0] == "1") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_3_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row3 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row3 .s5_float_left {
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_3_exploded[0] == "2") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_3_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row3 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row3 .s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_3_exploded[0] == "3") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_3_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row3 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row3 .s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_3_exploded[0] == "4") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_3_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row3 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row3 #s5_pos_bottom_row3_1.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_2.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_3.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}
			
			#s5_bottom_row3 #s5_pos_bottom_row3_4.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_5.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_3_exploded[0] == "5") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_3_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row3 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row3 #s5_pos_bottom_row3_1.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_2.s5_float_left {
			float:left !important;
			width:50% !important;
			}
			
			#s5_bottom_row3 #s5_pos_bottom_row3_3.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_4.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_5.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_6.s5_float_left {
			float:left !important;
			width:100% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_3_exploded[0] == "6") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_3_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row3 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row3 #s5_pos_bottom_row3_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_bottom_row3 #s5_pos_bottom_row3_2.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_3.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_4.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_5.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_6.s5_float_left {
			float:left !important;
			width:33.3% !important;
			}

		}
		
	<?php } ?>
	
	<?php if ($s5_responsive_row_widths_bottom_row_3_exploded[0] == "7") { ?>

		@media screen and (min-width:580px) and (max-width: <?php echo $s5_responsive_row_widths_bottom_row_3_exploded[1]; ?>px){
		
			<?php if ($s5_resize_columns_row_distribution == "no") { ?>
			.s5_resize_bottom_row3 {
			min-height: 0px !important;
			}
			<?php } ?>
		
			#s5_bottom_row3 #s5_pos_bottom_row3_1.s5_float_left {
			float:left !important;
			width:100% !important;
			}
			
			#s5_bottom_row3 #s5_pos_bottom_row3_2.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_3.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_4.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_5.s5_float_left, #s5_bottom_row3 #s5_pos_bottom_row3_6.s5_float_left {
			float:left !important;
			width:50% !important;
			}

		}
		
	<?php } ?>

<?php } ?>




<?php if ($s5_body_background == "yes") { ?>
	
	body {
		background:none !important;
		background-color:#<?php echo $s5_body_background_color; ?> !important;
		<?php if ($s5_body_background_image != "") {
		if ($s5_body_background_image_size == "custom") { $s5_body_background_image_size = $s5_body_background_image_size_custom; }
		?>
		background-image:url(<?php if(strrpos($s5_body_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_body_background_image; ?>) !important;
		background-size: <?php echo $s5_body_background_image_size; ?> !important;
		background-attachment: <?php echo $s5_body_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_body_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_body_background_image_position; ?> !important;
		<?php } ?>
	}

<?php } ?>

<?php if ($s5_top_row1_area1_background == "yes") { ?>

	#s5_top_row1_area1 {
		<?php if ($s5_top_row1_area1_background_image == "") {?>
		background:#<?php echo $s5_top_row1_area1_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_top_row1_area1_background_image != "") {
		if ($s5_top_row1_area1_background_image_size == "custom") { $s5_top_row1_area1_background_image_size = $s5_top_row1_area1_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_top_row1_area1_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_top_row1_area1_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_top_row1_area1_background_image; ?>) !important;
		background-size: <?php echo $s5_top_row1_area1_background_image_size; ?>;
		background-attachment: <?php echo $s5_top_row1_area1_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_top_row1_area1_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_top_row1_area1_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_top_row1_area2_background == "yes") { ?>

	#s5_top_row1_area2 {
		<?php if ($s5_top_row1_area2_background_image == "") {?>
		background:#<?php echo $s5_top_row1_area2_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_top_row1_area2_background_image != "") {
		if ($s5_top_row1_area2_background_image_size == "custom") { $s5_top_row1_area2_background_image_size = $s5_top_row1_area2_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_top_row1_area2_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_top_row1_area2_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_top_row1_area2_background_image; ?>) !important;
		background-size: <?php echo $s5_top_row1_area2_background_image_size; ?>;
		background-attachment: <?php echo $s5_top_row1_area2_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_top_row1_area2_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_top_row1_area2_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_top_row2_area1_background == "yes") { ?>

	#s5_top_row2_area1 {
		<?php if ($s5_top_row2_area1_background_image == "") {?>
		background:#<?php echo $s5_top_row2_area1_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_top_row2_area1_background_image != "") {
		if ($s5_top_row2_area1_background_image_size == "custom") { $s5_top_row2_area1_background_image_size = $s5_top_row2_area1_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_top_row2_area1_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_top_row2_area1_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_top_row2_area1_background_image; ?>) !important;
		background-size: <?php echo $s5_top_row2_area1_background_image_size; ?>;
		background-attachment: <?php echo $s5_top_row2_area1_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_top_row2_area1_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_top_row2_area1_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_top_row2_area2_background == "yes") { ?>

	#s5_top_row2_area2 {
		<?php if ($s5_top_row2_area2_background_image == "") {?>
		background:#<?php echo $s5_top_row2_area2_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_top_row2_area2_background_image != "") {
		if ($s5_top_row2_area2_background_image_size == "custom") { $s5_top_row2_area2_background_image_size = $s5_top_row2_area2_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_top_row2_area2_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_top_row2_area2_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_top_row2_area2_background_image; ?>) !important;
		background-size: <?php echo $s5_top_row2_area2_background_image_size; ?>;
		background-attachment: <?php echo $s5_top_row2_area2_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_top_row2_area2_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_top_row2_area2_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_top_row3_area1_background == "yes") { ?>

	#s5_top_row3_area1 {
		<?php if ($s5_top_row3_area1_background_image == "") {?>
		background:#<?php echo $s5_top_row3_area1_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_top_row3_area1_background_image != "") {
		if ($s5_top_row3_area1_background_image_size == "custom") { $s5_top_row3_area1_background_image_size = $s5_top_row3_area1_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_top_row3_area1_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_top_row3_area1_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_top_row3_area1_background_image; ?>) !important;
		background-size: <?php echo $s5_top_row3_area1_background_image_size; ?>;
		background-attachment: <?php echo $s5_top_row3_area1_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_top_row3_area1_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_top_row3_area1_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_top_row3_area2_background == "yes") { ?>

	#s5_top_row3_area2 {
		<?php if ($s5_top_row3_area2_background_image == "") {?>
		background:#<?php echo $s5_top_row3_area2_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_top_row3_area2_background_image != "") {
		if ($s5_top_row3_area2_background_image_size == "custom") { $s5_top_row3_area2_background_image_size = $s5_top_row3_area2_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_top_row3_area2_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_top_row3_area2_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_top_row3_area2_background_image; ?>) !important;
		background-size: <?php echo $s5_top_row3_area2_background_image_size; ?>;
		background-attachment: <?php echo $s5_top_row3_area2_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_top_row3_area2_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_top_row3_area2_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_center_area1_background == "yes") { ?>

	#s5_center_area1 {
		<?php if ($s5_center_area1_background_image == "") {?>
		background:#<?php echo $s5_center_area1_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_center_area1_background_image != "") {
		if ($s5_center_area1_background_image_size == "custom") { $s5_center_area1_background_image_size = $s5_center_area1_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_center_area1_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_center_area1_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_center_area1_background_image; ?>) !important;
		background-size: <?php echo $s5_center_area1_background_image_size; ?>;
		background-attachment: <?php echo $s5_center_area1_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_center_area1_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_center_area1_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_center_area2_background == "yes") { ?>

	#s5_center_area2 {
		<?php if ($s5_center_area2_background_image == "") {?>
		background:#<?php echo $s5_center_area2_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_center_area2_background_image != "") {
		if ($s5_center_area2_background_image_size == "custom") { $s5_center_area2_background_image_size = $s5_center_area2_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_center_area2_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_center_area2_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_center_area2_background_image; ?>) !important;
		background-size: <?php echo $s5_center_area2_background_image_size; ?>;
		background-attachment: <?php echo $s5_center_area2_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_center_area2_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_center_area2_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_above_columns_wrap1_background == "yes") { ?>

	#s5_above_columns_wrap1 {
		<?php if ($s5_above_columns_wrap1_background_image == "") {?>
		background:#<?php echo $s5_above_columns_wrap1_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_above_columns_wrap1_background_image != "") {
		if ($s5_above_columns_wrap1_background_image_size == "custom") { $s5_above_columns_wrap1_background_image_size = $s5_above_columns_wrap1_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_above_columns_wrap1_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_above_columns_wrap1_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_above_columns_wrap1_background_image; ?>) !important;
		background-size: <?php echo $s5_above_columns_wrap1_background_image_size; ?>;
		background-attachment: <?php echo $s5_above_columns_wrap1_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_above_columns_wrap1_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_above_columns_wrap1_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_above_columns_wrap2_background == "yes") { ?>

	#s5_above_columns_wrap2 {
		<?php if ($s5_above_columns_wrap2_background_image == "") {?>
		background:#<?php echo $s5_above_columns_wrap2_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_above_columns_wrap2_background_image != "") {
		if ($s5_above_columns_wrap2_background_image_size == "custom") { $s5_above_columns_wrap2_background_image_size = $s5_above_columns_wrap2_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_above_columns_wrap2_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_above_columns_wrap2_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_above_columns_wrap2_background_image; ?>) !important;
		background-size: <?php echo $s5_above_columns_wrap2_background_image_size; ?>;
		background-attachment: <?php echo $s5_above_columns_wrap2_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_above_columns_wrap2_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_above_columns_wrap2_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_columns_wrap_background == "yes") { ?>

	#s5_columns_wrap {
		<?php if ($s5_columns_wrap_background_image == "") {?>
		background:#<?php echo $s5_columns_wrap_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_columns_wrap_background_image != "") {
		if ($s5_columns_wrap_background_image_size == "custom") { $s5_columns_wrap_background_image_size = $s5_columns_wrap_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_columns_wrap_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_columns_wrap_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_columns_wrap_background_image; ?>) !important;
		background-size: <?php echo $s5_columns_wrap_background_image_size; ?>;
		background-attachment: <?php echo $s5_columns_wrap_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_columns_wrap_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_columns_wrap_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_columns_wrap_inner_background == "yes") { ?>

	#s5_columns_wrap_inner {
		<?php if ($s5_columns_wrap_inner_background_image == "") {?>
		background:#<?php echo $s5_columns_wrap_inner_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_columns_wrap_inner_background_image != "") {
		if ($s5_columns_wrap_inner_background_image_size == "custom") { $s5_columns_wrap_inner_background_image_size = $s5_columns_wrap_inner_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_columns_wrap_inner_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_columns_wrap_inner_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_columns_wrap_inner_background_image; ?>) !important;
		background-size: <?php echo $s5_columns_wrap_inner_background_image_size; ?>;
		background-attachment: <?php echo $s5_columns_wrap_inner_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_columns_wrap_inner_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_columns_wrap_inner_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_below_columns_wrap1_background == "yes") { ?>

	#s5_below_columns_wrap1 {
		<?php if ($s5_below_columns_wrap1_background_image == "") {?>
		background:#<?php echo $s5_below_columns_wrap1_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_below_columns_wrap1_background_image != "") {
		if ($s5_below_columns_wrap1_background_image_size == "custom") { $s5_below_columns_wrap1_background_image_size = $s5_below_columns_wrap1_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_below_columns_wrap1_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_below_columns_wrap1_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_below_columns_wrap1_background_image; ?>) !important;
		background-size: <?php echo $s5_below_columns_wrap1_background_image_size; ?>;
		background-attachment: <?php echo $s5_below_columns_wrap1_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_below_columns_wrap1_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_below_columns_wrap1_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_below_columns_wrap2_background == "yes") { ?>

	#s5_below_columns_wrap2 {
		<?php if ($s5_below_columns_wrap2_background_image == "") {?>
		background:#<?php echo $s5_below_columns_wrap2_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_below_columns_wrap2_background_image != "") {
		if ($s5_below_columns_wrap2_background_image_size == "custom") { $s5_below_columns_wrap2_background_image_size = $s5_below_columns_wrap2_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_below_columns_wrap2_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_below_columns_wrap2_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_below_columns_wrap2_background_image; ?>) !important;
		background-size: <?php echo $s5_below_columns_wrap2_background_image_size; ?>;
		background-attachment: <?php echo $s5_below_columns_wrap2_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_below_columns_wrap2_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_below_columns_wrap2_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_bottom_row1_area1_background == "yes") { ?>

	#s5_bottom_row1_area1 {
		<?php if ($s5_bottom_row1_area1_background_image == "") {?>
		background:#<?php echo $s5_bottom_row1_area1_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_bottom_row1_area1_background_image != "") {
		if ($s5_bottom_row1_area1_background_image_size == "custom") { $s5_bottom_row1_area1_background_image_size = $s5_bottom_row1_area1_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_bottom_row1_area1_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_bottom_row1_area1_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_bottom_row1_area1_background_image; ?>) !important;
		background-size: <?php echo $s5_bottom_row1_area1_background_image_size; ?>;
		background-attachment: <?php echo $s5_bottom_row1_area1_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_bottom_row1_area1_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_bottom_row1_area1_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_bottom_row1_area2_background == "yes") { ?>

	#s5_bottom_row1_area2 {
		<?php if ($s5_bottom_row1_area2_background_image == "") {?>
		background:#<?php echo $s5_bottom_row1_area2_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_bottom_row1_area2_background_image != "") {
		if ($s5_bottom_row1_area2_background_image_size == "custom") { $s5_bottom_row1_area2_background_image_size = $s5_bottom_row1_area2_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_bottom_row1_area2_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_bottom_row1_area2_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_bottom_row1_area2_background_image; ?>) !important;
		background-size: <?php echo $s5_bottom_row1_area2_background_image_size; ?>;
		background-attachment: <?php echo $s5_bottom_row1_area2_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_bottom_row1_area2_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_bottom_row1_area2_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_bottom_row2_area1_background == "yes") { ?>

	#s5_bottom_row2_area1 {
		<?php if ($s5_bottom_row2_area1_background_image == "") {?>
		background:#<?php echo $s5_bottom_row2_area1_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_bottom_row2_area1_background_image != "") {
		if ($s5_bottom_row2_area1_background_image_size == "custom") { $s5_bottom_row2_area1_background_image_size = $s5_bottom_row2_area1_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_bottom_row2_area1_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_bottom_row2_area1_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_bottom_row2_area1_background_image; ?>) !important;
		background-size: <?php echo $s5_bottom_row2_area1_background_image_size; ?>;
		background-attachment: <?php echo $s5_bottom_row2_area1_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_bottom_row2_area1_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_bottom_row2_area1_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_bottom_row2_area2_background == "yes") { ?>

	#s5_bottom_row2_area2 {
		<?php if ($s5_bottom_row2_area2_background_image == "") {?>
		background:#<?php echo $s5_bottom_row2_area2_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_bottom_row2_area2_background_image != "") {
		if ($s5_bottom_row2_area2_background_image_size == "custom") { $s5_bottom_row2_area2_background_image_size = $s5_bottom_row2_area2_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_bottom_row2_area2_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_bottom_row2_area2_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_bottom_row2_area2_background_image; ?>) !important;
		background-size: <?php echo $s5_bottom_row2_area2_background_image_size; ?>;
		background-attachment: <?php echo $s5_bottom_row2_area2_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_bottom_row2_area2_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_bottom_row2_area2_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_bottom_row3_area1_background == "yes") { ?>

	#s5_bottom_row3_area1 {
		<?php if ($s5_bottom_row3_area1_background_image == "") {?>
		background:#<?php echo $s5_bottom_row3_area1_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_bottom_row3_area1_background_image != "") {
		if ($s5_bottom_row3_area1_background_image_size == "custom") { $s5_bottom_row3_area1_background_image_size = $s5_bottom_row3_area1_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_bottom_row3_area1_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_bottom_row3_area1_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_bottom_row3_area1_background_image; ?>) !important;
		background-size: <?php echo $s5_bottom_row3_area1_background_image_size; ?>;
		background-attachment: <?php echo $s5_bottom_row3_area1_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_bottom_row3_area1_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_bottom_row3_area1_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>

<?php if ($s5_bottom_row3_area2_background == "yes") { ?>

	#s5_bottom_row3_area2 {
		<?php if ($s5_bottom_row3_area2_background_image == "") {?>
		background:#<?php echo $s5_bottom_row3_area2_background_color; ?> !important;
		<?php } ?>
		<?php if ($s5_bottom_row3_area2_background_image != "") {
		if ($s5_bottom_row3_area2_background_image_size == "custom") { $s5_bottom_row3_area2_background_image_size = $s5_bottom_row3_area2_background_image_size_custom; }
		?>
		background-color:#<?php echo $s5_bottom_row3_area2_background_color; ?> !important;
		background-image:url(<?php if(strrpos($s5_bottom_row3_area2_background_image,"/") <= 0) {echo $LiveSiteUrl; echo "images/";} echo $s5_bottom_row3_area2_background_image; ?>) !important;
		background-size: <?php echo $s5_bottom_row3_area2_background_image_size; ?>;
		background-attachment: <?php echo $s5_bottom_row3_area2_background_image_attachment; ?> !important;
		background-repeat:<?php echo $s5_bottom_row3_area2_background_image_repeat; ?> !important;
		background-position:<?php echo $s5_bottom_row3_area2_background_image_position; ?>;
		<?php } ?>
	}
	
<?php } ?>


<?php if ($s5_menudetach  == "yes") { ?>	

	<?php $s5_menufloat_opacityie = $s5_menufloat_opacity * 100; ?>

	<?php if ($s5_menufloat_opacity != "") { ?>
		#s5_menu_wrap.s5_wrap, #s5_menu_wrap.s5_wrap_fmfullwidth {	
			-moz-opacity: <?php echo $s5_menufloat_opacity; ?>;
			-khtml-opacity: <?php echo $s5_menufloat_opacity; ?>;
			filter:alpha(opacity=<?php echo $s5_menufloat_opacityie; ?>);
			opacity:<?php echo $s5_menufloat_opacity; ?> !important;
		}
	<?php } ?>
		
	<?php if ($s5_fmenufullwidth  == "yes") { ?>
		.s5_wrap_fmfullwidth ul.menu {
			width:<?php echo $s5_body_width; echo $s5_fixed_fluid ?>;
			<?php if ($s5_fmenufullwidthcenter  == "yes") { ?>
			margin:0 auto !important;
			max-width:<?php echo $s5_max_body_width; ?>px;
			<?php } ?>
		}	
		#s5_menu_wrap.s5_wrap_fmfullwidth {
			<?php if ($s5_fmenuheight != "") { ?>
			height:<?php echo $s5_fmenuheight; ?>px;	
			<?php } ?>
			width:100% !important;
			z-index:2;
			position: fixed;
			<?php if ($s5_menufloattop != "") { ?>
			top:<?php echo $s5_menufloattop; ?>px !important;
			<?php } ?>
			margin-top:0px !important;
			left:0 !important;
			margin-left:0px !important;
			-webkit-backface-visibility: hidden;
			-webkit-transform: translateZ(2);
		}
	<?php } ?>

	.subMenusContainer, .s5_drop_down_container {  
		position: fixed !important;
	}	
	
	#s5_menu_wrap.s5_wrap {	
		<?php if ($s5_menuleftmargin != "") { ?>
		margin-left:<?php echo $s5_menuleftmargin; ?>px;
		<?php } ?>
		<?php if ($s5_menurightmargin != "") { ?>
		margin-right:<?php echo $s5_menurightmargin; ?>px;
		<?php } ?>
		<?php if ($s5_fmenuheight != "") { ?>
		height:<?php echo $s5_fmenuheight; ?>px;
		<?php } ?>
		position: fixed;
		<?php if ($s5_menufloattop != "") { ?>
		top:<?php echo $s5_menufloattop; ?>px !important;
		<?php } ?>
		z-index:2;
		<?php if ($s5_menuleftpadding != "") { ?>
		padding-left:<?php echo $s5_menuleftpadding; ?>px;
		<?php } ?>
		<?php if ($s5_menurightpadding != "") { ?>
		padding-right:<?php echo $s5_menurightpadding; ?>px;
		<?php } ?>
		margin-top:0px !important;
	}	
	
     <?php if ($s5_fmenuslidein == "yes") { ?>
		<?php if ($s5_menumilliseconds == "") { $s5_menumilliseconds = "300"; } ?>
         #s5_menu_wrap { 
			-webkit-transition: top <?php echo $s5_menumilliseconds; ?>ms ease-out;
			-moz-transition: top <?php echo $s5_menumilliseconds; ?>ms ease-out;
			-o-transition:top <?php echo $s5_menumilliseconds; ?>ms ease-out;
			transition: top <?php echo $s5_menumilliseconds; ?>ms ease-out;	
		}
         #s5_menu_wrap.s5_wrap_fmfullwidth, #s5_menu_wrap.s5_wrap {    
			top:0px;
		}
	<?php } ?>
	
	#s5_menu_wrap.s5_wrap, #s5_menu_wrap.s5_wrap_fmfullwidth {
		<?php if ($s5_menufloat_bordersize != "" || $s5_menufloat_bordercolor != "") { ?>
		border-bottom:<?php echo $s5_menufloat_bordersize; ?>px solid #<?php echo $s5_menufloat_bordercolor; ?>;
		<?php } ?>
		<?php if ($s5_menufloatbackstart != "") { ?>
		background: #<?php echo $s5_menufloatbackstart; ?> !important; /* Old browsers */
		background: -moz-linear-gradient(top, #<?php echo $s5_menufloatbackstart; ?> 0%, #<?php echo $s5_menufloatbackend; ?> 100%) !important; /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $s5_menufloatbackstart; ?>), color-stop(100%,#<?php echo $s5_menufloatbackend; ?>)) !important; /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #<?php echo $s5_menufloatbackstart; ?> 0%,#<?php echo $s5_menufloatbackend; ?> 100%) !important; /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #<?php echo $s5_menufloatbackstart; ?> 0%,#<?php echo $s5_menufloatbackend; ?> 100%) !important; /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #<?php echo $s5_menufloatbackstart; ?> 0%,#<?php echo $s5_menufloatbackend; ?> 100%) !important; /* IE10+ */
		background: linear-gradient(to bottom, #<?php echo $s5_menufloatbackstart; ?> 0%,#<?php echo $s5_menufloatbackend; ?> 100%) !important; /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php echo $s5_menufloatbackstart; ?>', endColorstr='#<?php echo $s5_menufloatbackend; ?>',GradientType=0 ) !important; /* IE6-9 */
		<?php } ?>
		<?php if ($s5_menufloatbackgroundimage  != "") { ?>
		background:<?php if ($s5_menufloatbackstart  != "") { ?>#<?php echo $s5_menufloatbackstart; ?><?php } ?> url(<?php echo $s5_menufloatbackgroundimage; ?>) repeat !important;
		<?php } ?>
	}
	
	<?php if ($s5_fmenudropshadowsize != "") { ?>
		#s5_menu_wrap.s5_wrap, #s5_menu_wrap.s5_wrap_fmfullwidth {	
			-webkit-box-shadow: 0 0 <?php echo $s5_fmenudropshadowsize; ?>px rgba(0, 0, 0, <?php echo $s5_fmenudropshadowopacity; ?>);	
			-moz-box-shadow: 0 0 <?php echo $s5_fmenudropshadowsize; ?>px rgba(0, 0, 0, <?php echo $s5_fmenudropshadowopacity; ?>); 
			box-shadow: 0 0 <?php echo $s5_fmenudropshadowsize; ?>px rgba(0, 0, 0, <?php echo $s5_fmenudropshadowopacity; ?>); 
		}	
	<?php } ?>
	
<?php } ?>




</style>