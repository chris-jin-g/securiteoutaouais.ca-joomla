<script type="text/javascript">//<![CDATA[
var s5_load_parallax_scroll_speed = <?php echo $s5_parallax_speed; ?>.0;
function s5_check_parallax_scroll(s5_parallax_element,s5_parallax_position) {
	if (document.getElementById(s5_parallax_element)) {
		//Detect elements that are view when page loads so that they start at background-position:0 0
		if (document.getElementById(s5_parallax_element).offsetTop <= window.innerHeight) {
			document.getElementById(s5_parallax_element).style.backgroundPosition = s5_parallax_position + (((window.pageYOffset + document.getElementById(s5_parallax_element).offsetTop) - (document.getElementById(s5_parallax_element).offsetTop)) / s5_load_parallax_scroll_speed)*-1 + "px";
		}
		//Detect elements that are outside of the viewable area so they do not start scrolling until they come into view
		else {
			if ((window.pageYOffset + window.innerHeight >= document.getElementById(s5_parallax_element).offsetTop) && (window.pageYOffset <= (document.getElementById(s5_parallax_element).offsetTop + document.getElementById(s5_parallax_element).offsetHeight))) {
				document.getElementById(s5_parallax_element).style.backgroundPosition = s5_parallax_position + (((window.pageYOffset + window.innerHeight) - (document.getElementById(s5_parallax_element).offsetTop)) / s5_load_parallax_scroll_speed)*-1 + "px";
			}
		}
	}
}
<?php if ($browser == "ie9") { ?>
	function s5_load_parallax() {
<?php } ?>
<?php if ($browser != "ie9") { ?>
	jQuery(document).ready( function() {
<?php } ?>
	function s5_parallax_scroll_handler() {
		<?php if ($s5_top_row1_area1_background_parallax == "yes" && $s5_top_row1_area1_background_image != "") { ?>
		s5_check_parallax_scroll("s5_top_row1_area1",<?php if (strrpos($s5_top_row1_area1_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_top_row1_area2_background_parallax == "yes" && $s5_top_row1_area2_background_image != "") { ?>
		s5_check_parallax_scroll("s5_top_row1_area2",<?php if (strrpos($s5_top_row1_area2_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_top_row2_area1_background_parallax == "yes" && $s5_top_row2_area1_background_image != "") { ?>
		s5_check_parallax_scroll("s5_top_row2_area1",<?php if (strrpos($s5_top_row2_area1_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_top_row2_area2_background_parallax == "yes" && $s5_top_row2_area2_background_image != "") { ?>
		s5_check_parallax_scroll("s5_top_row2_area2",<?php if (strrpos($s5_top_row2_area2_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_top_row3_area1_background_parallax == "yes" && $s5_top_row3_area1_background_image != "") { ?>
		s5_check_parallax_scroll("s5_top_row3_area1",<?php if (strrpos($s5_top_row3_area1_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_top_row3_area2_background_parallax == "yes" && $s5_top_row3_area2_background_image != "") { ?>
		s5_check_parallax_scroll("s5_top_row3_area2",<?php if (strrpos($s5_top_row3_area2_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_center_area1_background_parallax == "yes" && $s5_center_area1_background_image != "") { ?>
		s5_check_parallax_scroll("s5_center_area1",<?php if (strrpos($s5_center_area1_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_center_area2_background_parallax == "yes" && $s5_center_area2_background_image != "") { ?>
		s5_check_parallax_scroll("s5_center_area2",<?php if (strrpos($s5_center_area2_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_above_columns_wrap1_background_parallax == "yes" && $s5_above_columns_wrap1_background_image != "") { ?>
		s5_check_parallax_scroll("s5_above_columns_wrap1",<?php if (strrpos($s5_above_columns_wrap1_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_above_columns_wrap2_background_parallax == "yes" && $s5_above_columns_wrap2_background_image != "") { ?>
		s5_check_parallax_scroll("s5_above_columns_wrap2",<?php if (strrpos($s5_above_columns_wrap2_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_columns_wrap_background_parallax == "yes" && $s5_columns_wrap_background_image != "") { ?>
		s5_check_parallax_scroll("s5_columns_wrap",<?php if (strrpos($s5_columns_wrap_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_columns_wrap_inner_background_parallax == "yes" && $s5_columns_wrap_inner_background_image != "") { ?>
		s5_check_parallax_scroll("s5_columns_wrap_inner",<?php if (strrpos($s5_columns_wrap_inner_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_below_columns_wrap1_background_parallax == "yes" && $s5_below_columns_wrap1_background_image != "") { ?>
		s5_check_parallax_scroll("s5_below_columns_wrap1",<?php if (strrpos($s5_below_columns_wrap1_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_below_columns_wrap2_background_parallax == "yes" && $s5_below_columns_wrap2_background_image != "") { ?>
		s5_check_parallax_scroll("s5_below_columns_wrap2",<?php if (strrpos($s5_below_columns_wrap2_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_bottom_row1_area1_background_parallax == "yes" && $s5_bottom_row1_area1_background_image != "") { ?>
		s5_check_parallax_scroll("s5_bottom_row1_area1",<?php if (strrpos($s5_bottom_row1_area1_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_bottom_row1_area2_background_parallax == "yes" && $s5_bottom_row1_area2_background_image != "") { ?>
		s5_check_parallax_scroll("s5_bottom_row1_area2",<?php if (strrpos($s5_bottom_row1_area2_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_bottom_row2_area1_background_parallax == "yes" && $s5_bottom_row2_area1_background_image != "") { ?>
		s5_check_parallax_scroll("s5_bottom_row2_area1",<?php if (strrpos($s5_bottom_row2_area1_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_bottom_row2_area2_background_parallax == "yes" && $s5_bottom_row2_area2_background_image != "") { ?>
		s5_check_parallax_scroll("s5_bottom_row2_area2",<?php if (strrpos($s5_bottom_row2_area2_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_bottom_row3_area1_background_parallax == "yes" && $s5_bottom_row3_area1_background_image != "") { ?>
		s5_check_parallax_scroll("s5_bottom_row3_area1",<?php if (strrpos($s5_bottom_row3_area1_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
		<?php if ($s5_bottom_row3_area2_background_parallax == "yes" && $s5_bottom_row3_area2_background_image != "") { ?>
		s5_check_parallax_scroll("s5_bottom_row3_area2",<?php if (strrpos($s5_bottom_row3_area3_background_image_position,"center") > 0) { ?>"50% "<?php } else { ?>"0px "<?php } ?>);
		<?php } ?>
    } 
	s5_parallax_scroll_handler();
    if(window.addEventListener) {
        window.addEventListener('scroll', s5_parallax_scroll_handler, false);   
		window.addEventListener('resize', s5_parallax_scroll_handler, false);   
	}
    else if (window.attachEvent) {
        window.attachEvent('onscroll', s5_parallax_scroll_handler); 
		window.attachEvent('onresize', s5_parallax_scroll_handler); 
	}
	}<?php if ($browser != "ie9") { ?>);<?php } ?>
		
	<?php if ($browser == "ie9") { ?>
	window.setTimeout(s5_load_parallax,1000);
	<?php } ?>

//]]></script>