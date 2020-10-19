<!-- Call bottom bar for mobile devices if layout is responsive -->	
<?php if ($s5_responsive_scroll_arrow == "override" || $s5_scrolltotop == "no") {
$s5_show_responsive_scroll_arrow = "no";
} else {
$s5_show_responsive_scroll_arrow = "yes";
}
?>
<?php if ($s5_responsive == "enabled" && ($s5_responsive_cookie  == "not_set" || $s5_responsive_cookie  == "mobile" || $s5_show_responsive_scroll_arrow == "yes")) { ?>
	<div id="s5_responsive_mobile_bottom_bar_outer" style="display:none">
	<div id="s5_responsive_mobile_bottom_bar" class="s5_responsive_mobile_bar_<?php echo $s5_responsive_mobile_bar_style; ?>">
		<!-- Call mobile links if links are enabled and cookie is currently set to mobile -->	
		<?php if ($s5_responsive_cookie  == "not_set" || $s5_responsive_cookie  == "mobile") { ?>
			<div id="s5_responsive_switch_mobile">
				<a id="s5_responsive_switch" href="?s5_responsive_switch_<?php echo $s5_livesite_cookie_var; ?>=0"><?php echo $s5_responsive_desktop_text ?></a>
			</div>
		<?php } ?>

		<?php if ($s5_show_responsive_scroll_arrow == "yes") { ?>
			<div id="s5_responsive_mobile_scroll">
				<a href="#s5_scrolltotop" class="s5_scrolltotop"></a>
			</div>
		<?php } ?>
		<div style="clear:both;height:0px"></div>
	</div>
	</div>
<?php } ?>

<!-- Call bottom bar for all devices if user has chosen to see desktop version -->	
<?php if ($s5_responsive_cookie  == "desktop") { ?>
	<div id="s5_responsive_mobile_bottom_bar_outer">
	<div id="s5_responsive_mobile_bottom_bar" class="s5_responsive_mobile_bar_<?php echo $s5_responsive_mobile_bar_style; ?>">
		<?php if ($s5_responsive_cookie  == "desktop") { ?>
			<div id="s5_responsive_switch_desktop">
				<a id="s5_responsive_switch" href="?s5_responsive_switch_<?php echo $s5_livesite_cookie_var; ?>=1"><?php echo $s5_responsive_mobile_text ?></a>
			</div>
		<?php } ?>
		<div style="clear:both;height:0px"></div>
	</div>
	</div>
<?php } ?>
