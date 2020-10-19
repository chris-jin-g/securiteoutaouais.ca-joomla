<?php

// Initially set all module values to unpublished

$vertex_positions = array('s5_pos_top_menu','s5_pos_middle_menu','s5_pos_bottom_menu','s5_pos_logo','s5_pos_breadcrumb','s5_pos_banner','s5_pos_search','s5_pos_login','s5_pos_register','s5_pos_top_row1_1','s5_pos_top_row1_2','s5_pos_top_row1_3','s5_pos_top_row1_4','s5_pos_top_row1_5','s5_pos_top_row1_6','s5_pos_top_row2_1','s5_pos_top_row2_2','s5_pos_top_row2_3','s5_pos_top_row2_4','s5_pos_top_row2_5','s5_pos_top_row2_6','s5_pos_top_row3_1','s5_pos_top_row3_2','s5_pos_top_row3_3','s5_pos_top_row3_4','s5_pos_top_row3_5','s5_pos_top_row3_6','s5_pos_above_columns_1','s5_pos_above_columns_2','s5_pos_above_columns_3','s5_pos_above_columns_4','s5_pos_above_columns_5','s5_pos_above_columns_6','s5_pos_left_top','s5_pos_left','s5_pos_left_inset','s5_pos_right_top','s5_pos_right','s5_pos_right_inset','s5_pos_middle_top_1','s5_pos_middle_top_2','s5_pos_middle_top_3','s5_pos_middle_top_4','s5_pos_middle_top_5','s5_pos_middle_top_6','s5_pos_above_body_1','s5_pos_above_body_2','s5_pos_above_body_3','s5_pos_above_body_4','s5_pos_above_body_5','s5_pos_above_body_6','s5_pos_left_bottom','s5_pos_right_bottom','s5_pos_middle_bottom_1','s5_pos_middle_bottom_2','s5_pos_middle_bottom_3','s5_pos_middle_bottom_4','s5_pos_middle_bottom_5','s5_pos_middle_bottom_6','s5_pos_below_body_1','s5_pos_below_body_2','s5_pos_below_body_3','s5_pos_below_body_4','s5_pos_below_body_5','s5_pos_below_body_6','s5_pos_below_columns_1','s5_pos_below_columns_2','s5_pos_below_columns_3','s5_pos_below_columns_4','s5_pos_below_columns_5','s5_pos_below_columns_6','s5_pos_bottom_row1_1','s5_pos_bottom_row1_2','s5_pos_bottom_row1_3','s5_pos_bottom_row1_4','s5_pos_bottom_row1_5','s5_pos_bottom_row1_6','s5_pos_bottom_row2_1','s5_pos_bottom_row2_2','s5_pos_bottom_row2_3','s5_pos_bottom_row2_4','s5_pos_bottom_row2_5','s5_pos_bottom_row2_6','s5_pos_bottom_row3_1','s5_pos_bottom_row3_2','s5_pos_bottom_row3_3','s5_pos_bottom_row3_4','s5_pos_bottom_row3_5','s5_pos_bottom_row3_6','s5_pos_debug','s5_pos_language','s5_pos_custom_1','s5_pos_custom_2','s5_pos_custom_3','s5_pos_custom_4','s5_pos_custom_5','s5_pos_custom_6','s5_pos_custom_7','s5_pos_custom_8','s5_pos_custom_9','s5_pos_custom_10','s5_pos_mobile_top_1','s5_pos_mobile_top_2','s5_pos_mobile_bottom_1','s5_pos_mobile_bottom_2','s5_pos_footer','s5_pos_drop_down_1','s5_pos_drop_down_2','s5_pos_drop_down_3','s5_pos_drop_down_4','s5_pos_drop_down_5','s5_pos_drop_down_6','s5_pos_sidebar_top','s5_pos_sidebar_bottom','s5_pos_cart');

if (isset($s5_top_row1_calculation)) {} else {$s5_top_row1_calculation = "automatic";}
if (isset($s5_top_row2_calculation)) {} else {$s5_top_row2_calculation = "automatic";}
if (isset($s5_top_row3_calculation)) {} else {$s5_top_row3_calculation = "automatic";}
if (isset($s5_above_columns_calculation)) {} else {$s5_above_columns_calculation = "automatic";}
if (isset($s5_middle_top_calculation)) {} else {$s5_middle_top_calculation = "automatic";}
if (isset($s5_above_body_calculation)) {} else {$s5_above_body_calculation = "automatic";}
if (isset($s5_middle_bottom_calculation)) {} else {$s5_middle_bottom_calculation = "automatic";}
if (isset($s5_below_body_calculation)) {} else {$s5_below_body_calculation = "automatic";}
if (isset($s5_below_columns_calculation)) {} else {$s5_below_columns_calculation = "automatic";}
if (isset($s5_bottom_row1_calculation)) {} else {$s5_bottom_row1_calculation = "automatic";}
if (isset($s5_bottom_row2_calculation)) {} else {$s5_bottom_row2_calculation = "automatic";}
if (isset($s5_bottom_row3_calculation)) {} else {$s5_bottom_row3_calculation = "automatic";}
if (isset($s5_drop_down_calculation)) {} else {$s5_drop_down_calculation = "automatic";}

// Vars to unpublish all modules for 404

$title_article = "";
$option = JRequest::getVar('option');
$view = JRequest::getVar('view');
$id = (int) JRequest::getInt('id');
if($option=='com_content' && $view=='article'){
	$db=JFactory::getDBO();
	$db->setQuery('SELECT title FROM #__content WHERE id='.$id);
	$title_article = $db->loadResult();
}

foreach($vertex_positions as $position) {

	$$position = 'unpublished';

	// Check if modules are published

	$position_name = str_replace('s5_pos_', '', "$position");

	if ($this->countModules("$position_name")) {
		$$position = 'published';
	}

	// Unpublish all modules for 404

	if($option=='com_content' && $view=='article'){
		if($title_article == '404 Error Page'){
			if ($position_name != "debug" && $position_name != "bottom_menu" && $position_name != "logo" && $position_name != "top_menu" && $position_name != "footer" && $position_name != "search") {
				$$position = 'unpublished';
			}
		}
	}

}

if($title_article == '404 Error Page'){ ?><style>#system-message-container,#s5_component_wrap h2,.actions,.article-info,.pagenav,.page-header{display:none;}</style><?php }


// column size calculations

$s5_center_column_margin_right = 0;
$s5_center_column_margin_left = 0;
$s5_left_column_width = 0; // The combined total of left and left_inset - calculated below
$s5_right_column_width = 0; // The combined total of right and right_inset - calculated below
$s5_left_top_bottom_width = $s5_left_width + $s5_left_inset_width; // Used for left_top or left_bottom only if nothing is pubished to left or left_inset
$s5_right_top_bottom_width = $s5_right_width + $s5_right_inset_width; // Used for right_top or right_bottom only if nothing is pubished to right or right_inset

// $s5_left_width, $s5_left_inset_width, $s5_right_width, and $s5_right_inset_width are defined in parameters.php through the template configuration.

if ($s5_pos_left == "unpublished") {
	$s5_left_width = 0;
}

if ($s5_pos_left_inset == "unpublished") {
	$s5_left_inset_width = 0;
}

if ($s5_pos_right == "unpublished") {
	$s5_right_width = 0;
}

if ($s5_pos_right_inset == "unpublished") {
	$s5_right_inset_width = 0;
}

if ($s5_pos_left == "published") {
	$s5_center_column_margin_left = $s5_center_column_margin_left + $s5_left_width;
	$s5_left_column_width = $s5_left_column_width + $s5_left_width;
}

if ($s5_pos_left_inset == "published") {
	$s5_center_column_margin_left = $s5_center_column_margin_left + $s5_left_inset_width;
	$s5_left_column_width = $s5_left_column_width + $s5_left_inset_width;
}

if ($s5_pos_right == "published") {
	$s5_center_column_margin_right = $s5_center_column_margin_right + $s5_right_width;
	$s5_right_column_width = $s5_right_column_width + $s5_right_width;
}

if ($s5_pos_right_inset == "published") {
	$s5_center_column_margin_right = $s5_center_column_margin_right + $s5_right_inset_width;
	$s5_right_column_width = $s5_right_column_width + $s5_right_inset_width;
}

if ($s5_pos_right_top == "published" || $s5_pos_right_bottom == "published") {
	$s5_center_column_margin_right = $s5_right_width + $s5_right_inset_width;
	$s5_right_column_width = $s5_right_width + $s5_right_inset_width;
	if ($s5_pos_right == "unpublished" && $s5_pos_right_inset == "unpublished") {
		$s5_center_column_margin_right = $s5_right_top_bottom_width;
		$s5_right_column_width = $s5_right_top_bottom_width;
	}
}

if ($s5_pos_left_top == "published" || $s5_pos_left_bottom == "published") {
	$s5_center_column_margin_left = $s5_left_width + $s5_left_inset_width;
	$s5_left_column_width = $s5_left_width + $s5_left_inset_width;
	if ($s5_pos_left == "unpublished" && $s5_pos_left_inset == "unpublished") {
		$s5_center_column_margin_left = $s5_left_top_bottom_width;
		$s5_left_column_width = $s5_left_top_bottom_width;
	}
}

// top_row1 calculations

if ($s5_pos_top_row1_1 == "published" || $s5_pos_top_row1_2 == "published" || $s5_pos_top_row1_3 == "published" || $s5_pos_top_row1_4 == "published" || $s5_pos_top_row1_5 == "published" || $s5_pos_top_row1_6 == "published") {

	$s5_pos_top_row1_1_width = 0;
	$s5_pos_top_row1_2_width = 0;
	$s5_pos_top_row1_3_width = 0;
	$s5_pos_top_row1_4_width = 0;
	$s5_pos_top_row1_5_width = 0;
	$s5_pos_top_row1_6_width = 0;

	$s5_top_row1_counter = 0;

	if ($s5_pos_top_row1_1 == "published") { $s5_top_row1_counter = $s5_top_row1_counter + 1; }
	if ($s5_pos_top_row1_2 == "published") { $s5_top_row1_counter = $s5_top_row1_counter + 1; }
	if ($s5_pos_top_row1_3 == "published") { $s5_top_row1_counter = $s5_top_row1_counter + 1; }
	if ($s5_pos_top_row1_4 == "published") { $s5_top_row1_counter = $s5_top_row1_counter + 1; }
	if ($s5_pos_top_row1_5 == "published") { $s5_top_row1_counter = $s5_top_row1_counter + 1; }
	if ($s5_pos_top_row1_6 == "published") { $s5_top_row1_counter = $s5_top_row1_counter + 1; }

	if ($s5_top_row1_calculation == "automatic") {

		if ($s5_top_row1_counter == 1) {
			$s5_pos_top_row1_1_width = 100;
			$s5_pos_top_row1_2_width = 100;
			$s5_pos_top_row1_3_width = 100;
			$s5_pos_top_row1_4_width = 100;
			$s5_pos_top_row1_5_width = 100;
			$s5_pos_top_row1_6_width = 100;
		}

		if ($s5_top_row1_counter == 2) {
			$s5_pos_top_row1_1_width = 50;
			$s5_pos_top_row1_2_width = 50;
			$s5_pos_top_row1_3_width = 50;
			$s5_pos_top_row1_4_width = 50;
			$s5_pos_top_row1_5_width = 50;
			$s5_pos_top_row1_6_width = 50;
		}

		if ($s5_top_row1_counter == 3) {
			$s5_pos_top_row1_1_width = 33.3;
			$s5_pos_top_row1_2_width = 33.3;
			$s5_pos_top_row1_3_width = 33.3;
			$s5_pos_top_row1_4_width = 33.3;
			$s5_pos_top_row1_5_width = 33.3;
			$s5_pos_top_row1_6_width = 33.3;
		}

		if ($s5_top_row1_counter == 4) {
			$s5_pos_top_row1_1_width = 25;
			$s5_pos_top_row1_2_width = 25;
			$s5_pos_top_row1_3_width = 25;
			$s5_pos_top_row1_4_width = 25;
			$s5_pos_top_row1_5_width = 25;
			$s5_pos_top_row1_6_width = 25;
		}

		if ($s5_top_row1_counter == 5) {
			$s5_pos_top_row1_1_width = 20;
			$s5_pos_top_row1_2_width = 20;
			$s5_pos_top_row1_3_width = 20;
			$s5_pos_top_row1_4_width = 20;
			$s5_pos_top_row1_5_width = 20;
			$s5_pos_top_row1_6_width = 20;
		}

		if ($s5_top_row1_counter == 6) {
			$s5_pos_top_row1_1_width = 16.66;
			$s5_pos_top_row1_2_width = 16.66;
			$s5_pos_top_row1_3_width = 16.66;
			$s5_pos_top_row1_4_width = 16.66;
			$s5_pos_top_row1_5_width = 16.66;
			$s5_pos_top_row1_6_width = 16.66;
		}

	}

	if ($s5_top_row1_calculation != "automatic") {

		$s5_top_row1_manual_widths = str_replace(" ","",$s5_top_row1_manual_widths);
		$s5_top_row1_manual_widths = str_replace("%","",$s5_top_row1_manual_widths);
		$s5_top_row1_manual_widths = str_replace(";",",",$s5_top_row1_manual_widths);
		$s5_top_row1_manual_widths = $s5_top_row1_manual_widths.",0,0,0,0,0,0,0";

		$s5_top_row1_manual_widths_exploded = explode(",", $s5_top_row1_manual_widths);
		$s5_pos_top_row1_1_width = $s5_top_row1_manual_widths_exploded[0];
		$s5_pos_top_row1_2_width = $s5_top_row1_manual_widths_exploded[1];
		$s5_pos_top_row1_3_width = $s5_top_row1_manual_widths_exploded[2];
		$s5_pos_top_row1_4_width = $s5_top_row1_manual_widths_exploded[3];
		$s5_pos_top_row1_5_width = $s5_top_row1_manual_widths_exploded[4];
		$s5_pos_top_row1_6_width = $s5_top_row1_manual_widths_exploded[5];

		if (substr_count($s5_top_row1_manual_widths, ',') != 5) {

		}

		$s5_top_row1_width_check = 0;

		if ($s5_pos_top_row1_1 == "published") { $s5_top_row1_width_check = $s5_top_row1_width_check + $s5_pos_top_row1_1_width; }
		if ($s5_pos_top_row1_2 == "published") { $s5_top_row1_width_check = $s5_top_row1_width_check + $s5_pos_top_row1_2_width; }
		if ($s5_pos_top_row1_3 == "published") { $s5_top_row1_width_check = $s5_top_row1_width_check + $s5_pos_top_row1_3_width; }
		if ($s5_pos_top_row1_4 == "published") { $s5_top_row1_width_check = $s5_top_row1_width_check + $s5_pos_top_row1_4_width; }
		if ($s5_pos_top_row1_5 == "published") { $s5_top_row1_width_check = $s5_top_row1_width_check + $s5_pos_top_row1_5_width; }
		if ($s5_pos_top_row1_6 == "published") { $s5_top_row1_width_check = $s5_top_row1_width_check + $s5_pos_top_row1_6_width; }

		if ($s5_top_row1_width_check != 100) {

		}

	}

	if ($s5_top_row1_counter == 1) {
		$s5_pos_top_row1_1_width = 100;
		$s5_pos_top_row1_2_width = 100;
		$s5_pos_top_row1_3_width = 100;
		$s5_pos_top_row1_4_width = 100;
		$s5_pos_top_row1_5_width = 100;
		$s5_pos_top_row1_6_width = 100;
	}

}

// top_row2 calculations

if ($s5_pos_top_row2_1 == "published" || $s5_pos_top_row2_2 == "published" || $s5_pos_top_row2_3 == "published" || $s5_pos_top_row2_4 == "published" || $s5_pos_top_row2_5 == "published" || $s5_pos_top_row2_6 == "published") {

	$s5_pos_top_row2_1_width = 0;
	$s5_pos_top_row2_2_width = 0;
	$s5_pos_top_row2_3_width = 0;
	$s5_pos_top_row2_4_width = 0;
	$s5_pos_top_row2_5_width = 0;
	$s5_pos_top_row2_6_width = 0;

	$s5_top_row2_counter = 0;

	if ($s5_pos_top_row2_1 == "published") { $s5_top_row2_counter = $s5_top_row2_counter + 1; }
	if ($s5_pos_top_row2_2 == "published") { $s5_top_row2_counter = $s5_top_row2_counter + 1; }
	if ($s5_pos_top_row2_3 == "published") { $s5_top_row2_counter = $s5_top_row2_counter + 1; }
	if ($s5_pos_top_row2_4 == "published") { $s5_top_row2_counter = $s5_top_row2_counter + 1; }
	if ($s5_pos_top_row2_5 == "published") { $s5_top_row2_counter = $s5_top_row2_counter + 1; }
	if ($s5_pos_top_row2_6 == "published") { $s5_top_row2_counter = $s5_top_row2_counter + 1; }

	if ($s5_top_row2_calculation == "automatic") {

		if ($s5_top_row2_counter == 1) {
			$s5_pos_top_row2_1_width = 100;
			$s5_pos_top_row2_2_width = 100;
			$s5_pos_top_row2_3_width = 100;
			$s5_pos_top_row2_4_width = 100;
			$s5_pos_top_row2_5_width = 100;
			$s5_pos_top_row2_6_width = 100;
		}

		if ($s5_top_row2_counter == 2) {
			$s5_pos_top_row2_1_width = 50;
			$s5_pos_top_row2_2_width = 50;
			$s5_pos_top_row2_3_width = 50;
			$s5_pos_top_row2_4_width = 50;
			$s5_pos_top_row2_5_width = 50;
			$s5_pos_top_row2_6_width = 50;
		}

		if ($s5_top_row2_counter == 3) {
			$s5_pos_top_row2_1_width = 33.3;
			$s5_pos_top_row2_2_width = 33.3;
			$s5_pos_top_row2_3_width = 33.3;
			$s5_pos_top_row2_4_width = 33.3;
			$s5_pos_top_row2_5_width = 33.3;
			$s5_pos_top_row2_6_width = 33.3;
		}

		if ($s5_top_row2_counter == 4) {
			$s5_pos_top_row2_1_width = 25;
			$s5_pos_top_row2_2_width = 25;
			$s5_pos_top_row2_3_width = 25;
			$s5_pos_top_row2_4_width = 25;
			$s5_pos_top_row2_5_width = 25;
			$s5_pos_top_row2_6_width = 25;
		}

		if ($s5_top_row2_counter == 5) {
			$s5_pos_top_row2_1_width = 20;
			$s5_pos_top_row2_2_width = 20;
			$s5_pos_top_row2_3_width = 20;
			$s5_pos_top_row2_4_width = 20;
			$s5_pos_top_row2_5_width = 20;
			$s5_pos_top_row2_6_width = 20;
		}

		if ($s5_top_row2_counter == 6) {
			$s5_pos_top_row2_1_width = 16.66;
			$s5_pos_top_row2_2_width = 16.66;
			$s5_pos_top_row2_3_width = 16.66;
			$s5_pos_top_row2_4_width = 16.66;
			$s5_pos_top_row2_5_width = 16.66;
			$s5_pos_top_row2_6_width = 16.66;
		}

	}

	if ($s5_top_row2_calculation != "automatic") {

		$s5_top_row2_manual_widths = str_replace(" ","",$s5_top_row2_manual_widths);
		$s5_top_row2_manual_widths = str_replace("%","",$s5_top_row2_manual_widths);
		$s5_top_row2_manual_widths = str_replace(";",",",$s5_top_row2_manual_widths);
		$s5_top_row2_manual_widths = $s5_top_row2_manual_widths.",0,0,0,0,0,0,0";

		$s5_top_row2_manual_widths_exploded = explode(",", $s5_top_row2_manual_widths);
		$s5_pos_top_row2_1_width = $s5_top_row2_manual_widths_exploded[0];
		$s5_pos_top_row2_2_width = $s5_top_row2_manual_widths_exploded[1];
		$s5_pos_top_row2_3_width = $s5_top_row2_manual_widths_exploded[2];
		$s5_pos_top_row2_4_width = $s5_top_row2_manual_widths_exploded[3];
		$s5_pos_top_row2_5_width = $s5_top_row2_manual_widths_exploded[4];
		$s5_pos_top_row2_6_width = $s5_top_row2_manual_widths_exploded[5];

		if (substr_count($s5_top_row2_manual_widths, ',') != 5) {

		}

		$s5_top_row2_width_check = 0;

		if ($s5_pos_top_row2_1 == "published") { $s5_top_row2_width_check = $s5_top_row2_width_check + $s5_pos_top_row2_1_width; }
		if ($s5_pos_top_row2_2 == "published") { $s5_top_row2_width_check = $s5_top_row2_width_check + $s5_pos_top_row2_2_width; }
		if ($s5_pos_top_row2_3 == "published") { $s5_top_row2_width_check = $s5_top_row2_width_check + $s5_pos_top_row2_3_width; }
		if ($s5_pos_top_row2_4 == "published") { $s5_top_row2_width_check = $s5_top_row2_width_check + $s5_pos_top_row2_4_width; }
		if ($s5_pos_top_row2_5 == "published") { $s5_top_row2_width_check = $s5_top_row2_width_check + $s5_pos_top_row2_5_width; }
		if ($s5_pos_top_row2_6 == "published") { $s5_top_row2_width_check = $s5_top_row2_width_check + $s5_pos_top_row2_6_width; }

		if ($s5_top_row2_width_check != 100) {

		}

	}

	if ($s5_top_row2_counter == 1) {
		$s5_pos_top_row2_1_width = 100;
		$s5_pos_top_row2_2_width = 100;
		$s5_pos_top_row2_3_width = 100;
		$s5_pos_top_row2_4_width = 100;
		$s5_pos_top_row2_5_width = 100;
		$s5_pos_top_row2_6_width = 100;
	}

}

// top_row3 calculations

if ($s5_pos_top_row3_1 == "published" || $s5_pos_top_row3_2 == "published" || $s5_pos_top_row3_3 == "published" || $s5_pos_top_row3_4 == "published" || $s5_pos_top_row3_5 == "published" || $s5_pos_top_row3_6 == "published") {

	$s5_pos_top_row3_1_width = 0;
	$s5_pos_top_row3_2_width = 0;
	$s5_pos_top_row3_3_width = 0;
	$s5_pos_top_row3_4_width = 0;
	$s5_pos_top_row3_5_width = 0;
	$s5_pos_top_row3_6_width = 0;

	$s5_top_row3_counter = 0;

	if ($s5_pos_top_row3_1 == "published") { $s5_top_row3_counter = $s5_top_row3_counter + 1; }
	if ($s5_pos_top_row3_2 == "published") { $s5_top_row3_counter = $s5_top_row3_counter + 1; }
	if ($s5_pos_top_row3_3 == "published") { $s5_top_row3_counter = $s5_top_row3_counter + 1; }
	if ($s5_pos_top_row3_4 == "published") { $s5_top_row3_counter = $s5_top_row3_counter + 1; }
	if ($s5_pos_top_row3_5 == "published") { $s5_top_row3_counter = $s5_top_row3_counter + 1; }
	if ($s5_pos_top_row3_6 == "published") { $s5_top_row3_counter = $s5_top_row3_counter + 1; }

	if ($s5_top_row3_calculation == "automatic") {

		if ($s5_top_row3_counter == 1) {
			$s5_pos_top_row3_1_width = 100;
			$s5_pos_top_row3_2_width = 100;
			$s5_pos_top_row3_3_width = 100;
			$s5_pos_top_row3_4_width = 100;
			$s5_pos_top_row3_5_width = 100;
			$s5_pos_top_row3_6_width = 100;
		}

		if ($s5_top_row3_counter == 2) {
			$s5_pos_top_row3_1_width = 50;
			$s5_pos_top_row3_2_width = 50;
			$s5_pos_top_row3_3_width = 50;
			$s5_pos_top_row3_4_width = 50;
			$s5_pos_top_row3_5_width = 50;
			$s5_pos_top_row3_6_width = 50;
		}

		if ($s5_top_row3_counter == 3) {
			$s5_pos_top_row3_1_width = 33.3;
			$s5_pos_top_row3_2_width = 33.3;
			$s5_pos_top_row3_3_width = 33.3;
			$s5_pos_top_row3_4_width = 33.3;
			$s5_pos_top_row3_5_width = 33.3;
			$s5_pos_top_row3_6_width = 33.3;
		}

		if ($s5_top_row3_counter == 4) {
			$s5_pos_top_row3_1_width = 25;
			$s5_pos_top_row3_2_width = 25;
			$s5_pos_top_row3_3_width = 25;
			$s5_pos_top_row3_4_width = 25;
			$s5_pos_top_row3_5_width = 25;
			$s5_pos_top_row3_6_width = 25;
		}

		if ($s5_top_row3_counter == 5) {
			$s5_pos_top_row3_1_width = 20;
			$s5_pos_top_row3_2_width = 20;
			$s5_pos_top_row3_3_width = 20;
			$s5_pos_top_row3_4_width = 20;
			$s5_pos_top_row3_5_width = 20;
			$s5_pos_top_row3_6_width = 20;
		}

		if ($s5_top_row3_counter == 6) {
			$s5_pos_top_row3_1_width = 16.66;
			$s5_pos_top_row3_2_width = 16.66;
			$s5_pos_top_row3_3_width = 16.66;
			$s5_pos_top_row3_4_width = 16.66;
			$s5_pos_top_row3_5_width = 16.66;
			$s5_pos_top_row3_6_width = 16.66;
		}

	}

	if ($s5_top_row3_calculation != "automatic") {

		$s5_top_row3_manual_widths = str_replace(" ","",$s5_top_row3_manual_widths);
		$s5_top_row3_manual_widths = str_replace("%","",$s5_top_row3_manual_widths);
		$s5_top_row3_manual_widths = str_replace(";",",",$s5_top_row3_manual_widths);
		$s5_top_row3_manual_widths = $s5_top_row3_manual_widths.",0,0,0,0,0,0,0";

		$s5_top_row3_manual_widths_exploded = explode(",", $s5_top_row3_manual_widths);
		$s5_pos_top_row3_1_width = $s5_top_row3_manual_widths_exploded[0];
		$s5_pos_top_row3_2_width = $s5_top_row3_manual_widths_exploded[1];
		$s5_pos_top_row3_3_width = $s5_top_row3_manual_widths_exploded[2];
		$s5_pos_top_row3_4_width = $s5_top_row3_manual_widths_exploded[3];
		$s5_pos_top_row3_5_width = $s5_top_row3_manual_widths_exploded[4];
		$s5_pos_top_row3_6_width = $s5_top_row3_manual_widths_exploded[5];

		if (substr_count($s5_top_row3_manual_widths, ',') != 5) {

		}

		$s5_top_row3_width_check = 0;

		if ($s5_pos_top_row3_1 == "published") { $s5_top_row3_width_check = $s5_top_row3_width_check + $s5_pos_top_row3_1_width; }
		if ($s5_pos_top_row3_2 == "published") { $s5_top_row3_width_check = $s5_top_row3_width_check + $s5_pos_top_row3_2_width; }
		if ($s5_pos_top_row3_3 == "published") { $s5_top_row3_width_check = $s5_top_row3_width_check + $s5_pos_top_row3_3_width; }
		if ($s5_pos_top_row3_4 == "published") { $s5_top_row3_width_check = $s5_top_row3_width_check + $s5_pos_top_row3_4_width; }
		if ($s5_pos_top_row3_5 == "published") { $s5_top_row3_width_check = $s5_top_row3_width_check + $s5_pos_top_row3_5_width; }
		if ($s5_pos_top_row3_6 == "published") { $s5_top_row3_width_check = $s5_top_row3_width_check + $s5_pos_top_row3_6_width; }

		if ($s5_top_row3_width_check != 100) {

		}

	}

	if ($s5_top_row3_counter == 1) {
		$s5_pos_top_row3_1_width = 100;
		$s5_pos_top_row3_2_width = 100;
		$s5_pos_top_row3_3_width = 100;
		$s5_pos_top_row3_4_width = 100;
		$s5_pos_top_row3_5_width = 100;
		$s5_pos_top_row3_6_width = 100;
	}

}



// above_columns calculations

if ($s5_pos_above_columns_1 == "published" || $s5_pos_above_columns_2 == "published" || $s5_pos_above_columns_3 == "published" || $s5_pos_above_columns_4 == "published" || $s5_pos_above_columns_5 == "published" || $s5_pos_above_columns_6 == "published") {

	$s5_pos_above_columns_1_width = 0;
	$s5_pos_above_columns_2_width = 0;
	$s5_pos_above_columns_3_width = 0;
	$s5_pos_above_columns_4_width = 0;
	$s5_pos_above_columns_5_width = 0;
	$s5_pos_above_columns_6_width = 0;

	$s5_above_columns_counter = 0;

	if ($s5_pos_above_columns_1 == "published") { $s5_above_columns_counter = $s5_above_columns_counter + 1; }
	if ($s5_pos_above_columns_2 == "published") { $s5_above_columns_counter = $s5_above_columns_counter + 1; }
	if ($s5_pos_above_columns_3 == "published") { $s5_above_columns_counter = $s5_above_columns_counter + 1; }
	if ($s5_pos_above_columns_4 == "published") { $s5_above_columns_counter = $s5_above_columns_counter + 1; }
	if ($s5_pos_above_columns_5 == "published") { $s5_above_columns_counter = $s5_above_columns_counter + 1; }
	if ($s5_pos_above_columns_6 == "published") { $s5_above_columns_counter = $s5_above_columns_counter + 1; }

	if ($s5_above_columns_calculation == "automatic") {

		if ($s5_above_columns_counter == 1) {
			$s5_pos_above_columns_1_width = 100;
			$s5_pos_above_columns_2_width = 100;
			$s5_pos_above_columns_3_width = 100;
			$s5_pos_above_columns_4_width = 100;
			$s5_pos_above_columns_5_width = 100;
			$s5_pos_above_columns_6_width = 100;
		}

		if ($s5_above_columns_counter == 2) {
			$s5_pos_above_columns_1_width = 50;
			$s5_pos_above_columns_2_width = 50;
			$s5_pos_above_columns_3_width = 50;
			$s5_pos_above_columns_4_width = 50;
			$s5_pos_above_columns_5_width = 50;
			$s5_pos_above_columns_6_width = 50;
		}

		if ($s5_above_columns_counter == 3) {
			$s5_pos_above_columns_1_width = 33.3;
			$s5_pos_above_columns_2_width = 33.3;
			$s5_pos_above_columns_3_width = 33.3;
			$s5_pos_above_columns_4_width = 33.3;
			$s5_pos_above_columns_5_width = 33.3;
			$s5_pos_above_columns_6_width = 33.3;
		}

		if ($s5_above_columns_counter == 4) {
			$s5_pos_above_columns_1_width = 25;
			$s5_pos_above_columns_2_width = 25;
			$s5_pos_above_columns_3_width = 25;
			$s5_pos_above_columns_4_width = 25;
			$s5_pos_above_columns_5_width = 25;
			$s5_pos_above_columns_6_width = 25;
		}

		if ($s5_above_columns_counter == 5) {
			$s5_pos_above_columns_1_width = 20;
			$s5_pos_above_columns_2_width = 20;
			$s5_pos_above_columns_3_width = 20;
			$s5_pos_above_columns_4_width = 20;
			$s5_pos_above_columns_5_width = 20;
			$s5_pos_above_columns_6_width = 20;
		}

		if ($s5_above_columns_counter == 6) {
			$s5_pos_above_columns_1_width = 16.66;
			$s5_pos_above_columns_2_width = 16.66;
			$s5_pos_above_columns_3_width = 16.66;
			$s5_pos_above_columns_4_width = 16.66;
			$s5_pos_above_columns_5_width = 16.66;
			$s5_pos_above_columns_6_width = 16.66;
		}

	}

	if ($s5_above_columns_calculation != "automatic") {

		$s5_above_columns_manual_widths = str_replace(" ","",$s5_above_columns_manual_widths);
		$s5_above_columns_manual_widths = str_replace("%","",$s5_above_columns_manual_widths);
		$s5_above_columns_manual_widths = str_replace(";",",",$s5_above_columns_manual_widths);
		$s5_above_columns_manual_widths = $s5_above_columns_manual_widths.",0,0,0,0,0,0,0";

		$s5_above_columns_manual_widths_exploded = explode(",", $s5_above_columns_manual_widths);
		$s5_pos_above_columns_1_width = $s5_above_columns_manual_widths_exploded[0];
		$s5_pos_above_columns_2_width = $s5_above_columns_manual_widths_exploded[1];
		$s5_pos_above_columns_3_width = $s5_above_columns_manual_widths_exploded[2];
		$s5_pos_above_columns_4_width = $s5_above_columns_manual_widths_exploded[3];
		$s5_pos_above_columns_5_width = $s5_above_columns_manual_widths_exploded[4];
		$s5_pos_above_columns_6_width = $s5_above_columns_manual_widths_exploded[5];

		if (substr_count($s5_above_columns_manual_widths, ',') != 5) {

		}

		$s5_above_columns_width_check = 0;

		if ($s5_pos_above_columns_1 == "published") { $s5_above_columns_width_check = $s5_above_columns_width_check + $s5_pos_above_columns_1_width; }
		if ($s5_pos_above_columns_2 == "published") { $s5_above_columns_width_check = $s5_above_columns_width_check + $s5_pos_above_columns_2_width; }
		if ($s5_pos_above_columns_3 == "published") { $s5_above_columns_width_check = $s5_above_columns_width_check + $s5_pos_above_columns_3_width; }
		if ($s5_pos_above_columns_4 == "published") { $s5_above_columns_width_check = $s5_above_columns_width_check + $s5_pos_above_columns_4_width; }
		if ($s5_pos_above_columns_5 == "published") { $s5_above_columns_width_check = $s5_above_columns_width_check + $s5_pos_above_columns_5_width; }
		if ($s5_pos_above_columns_6 == "published") { $s5_above_columns_width_check = $s5_above_columns_width_check + $s5_pos_above_columns_6_width; }

		if ($s5_above_columns_width_check != 100) {

		}

	}

	if ($s5_above_columns_counter == 1) {
		$s5_pos_above_columns_1_width = 100;
		$s5_pos_above_columns_2_width = 100;
		$s5_pos_above_columns_3_width = 100;
		$s5_pos_above_columns_4_width = 100;
		$s5_pos_above_columns_5_width = 100;
		$s5_pos_above_columns_6_width = 100;
	}

}



// middle_top calculations

if ($s5_pos_middle_top_1 == "published" || $s5_pos_middle_top_2 == "published" || $s5_pos_middle_top_3 == "published" || $s5_pos_middle_top_4 == "published" || $s5_pos_middle_top_5 == "published" || $s5_pos_middle_top_6 == "published") {

	$s5_pos_middle_top_1_width = 0;
	$s5_pos_middle_top_2_width = 0;
	$s5_pos_middle_top_3_width = 0;
	$s5_pos_middle_top_4_width = 0;
	$s5_pos_middle_top_5_width = 0;
	$s5_pos_middle_top_6_width = 0;

	$s5_middle_top_counter = 0;

	if ($s5_pos_middle_top_1 == "published") { $s5_middle_top_counter = $s5_middle_top_counter + 1; }
	if ($s5_pos_middle_top_2 == "published") { $s5_middle_top_counter = $s5_middle_top_counter + 1; }
	if ($s5_pos_middle_top_3 == "published") { $s5_middle_top_counter = $s5_middle_top_counter + 1; }
	if ($s5_pos_middle_top_4 == "published") { $s5_middle_top_counter = $s5_middle_top_counter + 1; }
	if ($s5_pos_middle_top_5 == "published") { $s5_middle_top_counter = $s5_middle_top_counter + 1; }
	if ($s5_pos_middle_top_6 == "published") { $s5_middle_top_counter = $s5_middle_top_counter + 1; }

	if ($s5_middle_top_calculation == "automatic") {

		if ($s5_middle_top_counter == 1) {
			$s5_pos_middle_top_1_width = 100;
			$s5_pos_middle_top_2_width = 100;
			$s5_pos_middle_top_3_width = 100;
			$s5_pos_middle_top_4_width = 100;
			$s5_pos_middle_top_5_width = 100;
			$s5_pos_middle_top_6_width = 100;
		}

		if ($s5_middle_top_counter == 2) {
			$s5_pos_middle_top_1_width = 50;
			$s5_pos_middle_top_2_width = 50;
			$s5_pos_middle_top_3_width = 50;
			$s5_pos_middle_top_4_width = 50;
			$s5_pos_middle_top_5_width = 50;
			$s5_pos_middle_top_6_width = 50;
		}

		if ($s5_middle_top_counter == 3) {
			$s5_pos_middle_top_1_width = 33.3;
			$s5_pos_middle_top_2_width = 33.3;
			$s5_pos_middle_top_3_width = 33.3;
			$s5_pos_middle_top_4_width = 33.3;
			$s5_pos_middle_top_5_width = 33.3;
			$s5_pos_middle_top_6_width = 33.3;
		}

		if ($s5_middle_top_counter == 4) {
			$s5_pos_middle_top_1_width = 25;
			$s5_pos_middle_top_2_width = 25;
			$s5_pos_middle_top_3_width = 25;
			$s5_pos_middle_top_4_width = 25;
			$s5_pos_middle_top_5_width = 25;
			$s5_pos_middle_top_6_width = 25;
		}

		if ($s5_middle_top_counter == 5) {
			$s5_pos_middle_top_1_width = 20;
			$s5_pos_middle_top_2_width = 20;
			$s5_pos_middle_top_3_width = 20;
			$s5_pos_middle_top_4_width = 20;
			$s5_pos_middle_top_5_width = 20;
			$s5_pos_middle_top_6_width = 20;
		}

		if ($s5_middle_top_counter == 6) {
			$s5_pos_middle_top_1_width = 16.66;
			$s5_pos_middle_top_2_width = 16.66;
			$s5_pos_middle_top_3_width = 16.66;
			$s5_pos_middle_top_4_width = 16.66;
			$s5_pos_middle_top_5_width = 16.66;
			$s5_pos_middle_top_6_width = 16.66;
		}

	}

	if ($s5_middle_top_calculation != "automatic") {

		$s5_middle_top_manual_widths = str_replace(" ","",$s5_middle_top_manual_widths);
		$s5_middle_top_manual_widths = str_replace("%","",$s5_middle_top_manual_widths);
		$s5_middle_top_manual_widths = str_replace(";",",",$s5_middle_top_manual_widths);
		$s5_middle_top_manual_widths = $s5_middle_top_manual_widths.",0,0,0,0,0,0,0";

		$s5_middle_top_manual_widths_exploded = explode(",", $s5_middle_top_manual_widths);
		$s5_pos_middle_top_1_width = $s5_middle_top_manual_widths_exploded[0];
		$s5_pos_middle_top_2_width = $s5_middle_top_manual_widths_exploded[1];
		$s5_pos_middle_top_3_width = $s5_middle_top_manual_widths_exploded[2];
		$s5_pos_middle_top_4_width = $s5_middle_top_manual_widths_exploded[3];
		$s5_pos_middle_top_5_width = $s5_middle_top_manual_widths_exploded[4];
		$s5_pos_middle_top_6_width = $s5_middle_top_manual_widths_exploded[5];

		if (substr_count($s5_middle_top_manual_widths, ',') != 5) {

		}

		$s5_middle_top_width_check = 0;

		if ($s5_pos_middle_top_1 == "published") { $s5_middle_top_width_check = $s5_middle_top_width_check + $s5_pos_middle_top_1_width; }
		if ($s5_pos_middle_top_2 == "published") { $s5_middle_top_width_check = $s5_middle_top_width_check + $s5_pos_middle_top_2_width; }
		if ($s5_pos_middle_top_3 == "published") { $s5_middle_top_width_check = $s5_middle_top_width_check + $s5_pos_middle_top_3_width; }
		if ($s5_pos_middle_top_4 == "published") { $s5_middle_top_width_check = $s5_middle_top_width_check + $s5_pos_middle_top_4_width; }
		if ($s5_pos_middle_top_5 == "published") { $s5_middle_top_width_check = $s5_middle_top_width_check + $s5_pos_middle_top_5_width; }
		if ($s5_pos_middle_top_6 == "published") { $s5_middle_top_width_check = $s5_middle_top_width_check + $s5_pos_middle_top_6_width; }

		if ($s5_middle_top_width_check != 100) {

		}

	}

	if ($s5_middle_top_counter == 1) {
		$s5_pos_middle_top_1_width = 100;
		$s5_pos_middle_top_2_width = 100;
		$s5_pos_middle_top_3_width = 100;
		$s5_pos_middle_top_4_width = 100;
		$s5_pos_middle_top_5_width = 100;
		$s5_pos_middle_top_6_width = 100;
	}

}

// above_body calculations

if ($s5_pos_above_body_1 == "published" || $s5_pos_above_body_2 == "published" || $s5_pos_above_body_3 == "published" || $s5_pos_above_body_4 == "published" || $s5_pos_above_body_5 == "published" || $s5_pos_above_body_6 == "published") {

	$s5_pos_above_body_1_width = 0;
	$s5_pos_above_body_2_width = 0;
	$s5_pos_above_body_3_width = 0;
	$s5_pos_above_body_4_width = 0;
	$s5_pos_above_body_5_width = 0;
	$s5_pos_above_body_6_width = 0;

	$s5_above_body_counter = 0;

	if ($s5_pos_above_body_1 == "published") { $s5_above_body_counter = $s5_above_body_counter + 1; }
	if ($s5_pos_above_body_2 == "published") { $s5_above_body_counter = $s5_above_body_counter + 1; }
	if ($s5_pos_above_body_3 == "published") { $s5_above_body_counter = $s5_above_body_counter + 1; }
	if ($s5_pos_above_body_4 == "published") { $s5_above_body_counter = $s5_above_body_counter + 1; }
	if ($s5_pos_above_body_5 == "published") { $s5_above_body_counter = $s5_above_body_counter + 1; }
	if ($s5_pos_above_body_6 == "published") { $s5_above_body_counter = $s5_above_body_counter + 1; }

	if ($s5_above_body_calculation == "automatic") {

		if ($s5_above_body_counter == 1) {
			$s5_pos_above_body_1_width = 100;
			$s5_pos_above_body_2_width = 100;
			$s5_pos_above_body_3_width = 100;
			$s5_pos_above_body_4_width = 100;
			$s5_pos_above_body_5_width = 100;
			$s5_pos_above_body_6_width = 100;
		}

		if ($s5_above_body_counter == 2) {
			$s5_pos_above_body_1_width = 50;
			$s5_pos_above_body_2_width = 50;
			$s5_pos_above_body_3_width = 50;
			$s5_pos_above_body_4_width = 50;
			$s5_pos_above_body_5_width = 50;
			$s5_pos_above_body_6_width = 50;
		}

		if ($s5_above_body_counter == 3) {
			$s5_pos_above_body_1_width = 33.3;
			$s5_pos_above_body_2_width = 33.3;
			$s5_pos_above_body_3_width = 33.3;
			$s5_pos_above_body_4_width = 33.3;
			$s5_pos_above_body_5_width = 33.3;
			$s5_pos_above_body_6_width = 33.3;
		}

		if ($s5_above_body_counter == 4) {
			$s5_pos_above_body_1_width = 25;
			$s5_pos_above_body_2_width = 25;
			$s5_pos_above_body_3_width = 25;
			$s5_pos_above_body_4_width = 25;
			$s5_pos_above_body_5_width = 25;
			$s5_pos_above_body_6_width = 25;
		}

		if ($s5_above_body_counter == 5) {
			$s5_pos_above_body_1_width = 20;
			$s5_pos_above_body_2_width = 20;
			$s5_pos_above_body_3_width = 20;
			$s5_pos_above_body_4_width = 20;
			$s5_pos_above_body_5_width = 20;
			$s5_pos_above_body_6_width = 20;
		}

		if ($s5_above_body_counter == 6) {
			$s5_pos_above_body_1_width = 16.66;
			$s5_pos_above_body_2_width = 16.66;
			$s5_pos_above_body_3_width = 16.66;
			$s5_pos_above_body_4_width = 16.66;
			$s5_pos_above_body_5_width = 16.66;
			$s5_pos_above_body_6_width = 16.66;
		}

	}

	if ($s5_above_body_calculation != "automatic") {

		$s5_above_body_manual_widths = str_replace(" ","",$s5_above_body_manual_widths);
		$s5_above_body_manual_widths = str_replace("%","",$s5_above_body_manual_widths);
		$s5_above_body_manual_widths = str_replace(";",",",$s5_above_body_manual_widths);
		$s5_above_body_manual_widths = $s5_above_body_manual_widths.",0,0,0,0,0,0,0";

		$s5_above_body_manual_widths_exploded = explode(",", $s5_above_body_manual_widths);
		$s5_pos_above_body_1_width = $s5_above_body_manual_widths_exploded[0];
		$s5_pos_above_body_2_width = $s5_above_body_manual_widths_exploded[1];
		$s5_pos_above_body_3_width = $s5_above_body_manual_widths_exploded[2];
		$s5_pos_above_body_4_width = $s5_above_body_manual_widths_exploded[3];
		$s5_pos_above_body_5_width = $s5_above_body_manual_widths_exploded[4];
		$s5_pos_above_body_6_width = $s5_above_body_manual_widths_exploded[5];

		if (substr_count($s5_above_body_manual_widths, ',') != 5) {

		}

		$s5_above_body_width_check = 0;

		if ($s5_pos_above_body_1 == "published") { $s5_above_body_width_check = $s5_above_body_width_check + $s5_pos_above_body_1_width; }
		if ($s5_pos_above_body_2 == "published") { $s5_above_body_width_check = $s5_above_body_width_check + $s5_pos_above_body_2_width; }
		if ($s5_pos_above_body_3 == "published") { $s5_above_body_width_check = $s5_above_body_width_check + $s5_pos_above_body_3_width; }
		if ($s5_pos_above_body_4 == "published") { $s5_above_body_width_check = $s5_above_body_width_check + $s5_pos_above_body_4_width; }
		if ($s5_pos_above_body_5 == "published") { $s5_above_body_width_check = $s5_above_body_width_check + $s5_pos_above_body_5_width; }
		if ($s5_pos_above_body_6 == "published") { $s5_above_body_width_check = $s5_above_body_width_check + $s5_pos_above_body_6_width; }

		if ($s5_above_body_width_check != 100) {

		}

	}

	if ($s5_above_body_counter == 1) {
		$s5_pos_above_body_1_width = 100;
		$s5_pos_above_body_2_width = 100;
		$s5_pos_above_body_3_width = 100;
		$s5_pos_above_body_4_width = 100;
		$s5_pos_above_body_5_width = 100;
		$s5_pos_above_body_6_width = 100;
	}

}

// middle_bottom calculations

if ($s5_pos_middle_bottom_1 == "published" || $s5_pos_middle_bottom_2 == "published" || $s5_pos_middle_bottom_3 == "published" || $s5_pos_middle_bottom_4 == "published" || $s5_pos_middle_bottom_5 == "published" || $s5_pos_middle_bottom_6 == "published") {

	$s5_pos_middle_bottom_1_width = 0;
	$s5_pos_middle_bottom_2_width = 0;
	$s5_pos_middle_bottom_3_width = 0;
	$s5_pos_middle_bottom_4_width = 0;
	$s5_pos_middle_bottom_5_width = 0;
	$s5_pos_middle_bottom_6_width = 0;

	$s5_middle_bottom_counter = 0;

	if ($s5_pos_middle_bottom_1 == "published") { $s5_middle_bottom_counter = $s5_middle_bottom_counter + 1; }
	if ($s5_pos_middle_bottom_2 == "published") { $s5_middle_bottom_counter = $s5_middle_bottom_counter + 1; }
	if ($s5_pos_middle_bottom_3 == "published") { $s5_middle_bottom_counter = $s5_middle_bottom_counter + 1; }
	if ($s5_pos_middle_bottom_4 == "published") { $s5_middle_bottom_counter = $s5_middle_bottom_counter + 1; }
	if ($s5_pos_middle_bottom_5 == "published") { $s5_middle_bottom_counter = $s5_middle_bottom_counter + 1; }
	if ($s5_pos_middle_bottom_6 == "published") { $s5_middle_bottom_counter = $s5_middle_bottom_counter + 1; }

	if ($s5_middle_bottom_calculation == "automatic") {

		if ($s5_middle_bottom_counter == 1) {
			$s5_pos_middle_bottom_1_width = 100;
			$s5_pos_middle_bottom_2_width = 100;
			$s5_pos_middle_bottom_3_width = 100;
			$s5_pos_middle_bottom_4_width = 100;
			$s5_pos_middle_bottom_5_width = 100;
			$s5_pos_middle_bottom_6_width = 100;
		}

		if ($s5_middle_bottom_counter == 2) {
			$s5_pos_middle_bottom_1_width = 50;
			$s5_pos_middle_bottom_2_width = 50;
			$s5_pos_middle_bottom_3_width = 50;
			$s5_pos_middle_bottom_4_width = 50;
			$s5_pos_middle_bottom_5_width = 50;
			$s5_pos_middle_bottom_6_width = 50;
		}

		if ($s5_middle_bottom_counter == 3) {
			$s5_pos_middle_bottom_1_width = 33.3;
			$s5_pos_middle_bottom_2_width = 33.3;
			$s5_pos_middle_bottom_3_width = 33.3;
			$s5_pos_middle_bottom_4_width = 33.3;
			$s5_pos_middle_bottom_5_width = 33.3;
			$s5_pos_middle_bottom_6_width = 33.3;
		}

		if ($s5_middle_bottom_counter == 4) {
			$s5_pos_middle_bottom_1_width = 25;
			$s5_pos_middle_bottom_2_width = 25;
			$s5_pos_middle_bottom_3_width = 25;
			$s5_pos_middle_bottom_4_width = 25;
			$s5_pos_middle_bottom_5_width = 25;
			$s5_pos_middle_bottom_6_width = 25;
		}

		if ($s5_middle_bottom_counter == 5) {
			$s5_pos_middle_bottom_1_width = 20;
			$s5_pos_middle_bottom_2_width = 20;
			$s5_pos_middle_bottom_3_width = 20;
			$s5_pos_middle_bottom_4_width = 20;
			$s5_pos_middle_bottom_5_width = 20;
			$s5_pos_middle_bottom_6_width = 20;
		}

		if ($s5_middle_bottom_counter == 6) {
			$s5_pos_middle_bottom_1_width = 16.66;
			$s5_pos_middle_bottom_2_width = 16.66;
			$s5_pos_middle_bottom_3_width = 16.66;
			$s5_pos_middle_bottom_4_width = 16.66;
			$s5_pos_middle_bottom_5_width = 16.66;
			$s5_pos_middle_bottom_6_width = 16.66;
		}

	}

	if ($s5_middle_bottom_calculation != "automatic") {

		$s5_middle_bottom_manual_widths = str_replace(" ","",$s5_middle_bottom_manual_widths);
		$s5_middle_bottom_manual_widths = str_replace("%","",$s5_middle_bottom_manual_widths);
		$s5_middle_bottom_manual_widths = str_replace(";",",",$s5_middle_bottom_manual_widths);
		$s5_middle_bottom_manual_widths = $s5_middle_bottom_manual_widths.",0,0,0,0,0,0,0";

		$s5_middle_bottom_manual_widths_exploded = explode(",", $s5_middle_bottom_manual_widths);
		$s5_pos_middle_bottom_1_width = $s5_middle_bottom_manual_widths_exploded[0];
		$s5_pos_middle_bottom_2_width = $s5_middle_bottom_manual_widths_exploded[1];
		$s5_pos_middle_bottom_3_width = $s5_middle_bottom_manual_widths_exploded[2];
		$s5_pos_middle_bottom_4_width = $s5_middle_bottom_manual_widths_exploded[3];
		$s5_pos_middle_bottom_5_width = $s5_middle_bottom_manual_widths_exploded[4];
		$s5_pos_middle_bottom_6_width = $s5_middle_bottom_manual_widths_exploded[5];

		if (substr_count($s5_middle_bottom_manual_widths, ',') != 5) {

		}

		$s5_middle_bottom_width_check = 0;

		if ($s5_pos_middle_bottom_1 == "published") { $s5_middle_bottom_width_check = $s5_middle_bottom_width_check + $s5_pos_middle_bottom_1_width; }
		if ($s5_pos_middle_bottom_2 == "published") { $s5_middle_bottom_width_check = $s5_middle_bottom_width_check + $s5_pos_middle_bottom_2_width; }
		if ($s5_pos_middle_bottom_3 == "published") { $s5_middle_bottom_width_check = $s5_middle_bottom_width_check + $s5_pos_middle_bottom_3_width; }
		if ($s5_pos_middle_bottom_4 == "published") { $s5_middle_bottom_width_check = $s5_middle_bottom_width_check + $s5_pos_middle_bottom_4_width; }
		if ($s5_pos_middle_bottom_5 == "published") { $s5_middle_bottom_width_check = $s5_middle_bottom_width_check + $s5_pos_middle_bottom_5_width; }
		if ($s5_pos_middle_bottom_6 == "published") { $s5_middle_bottom_width_check = $s5_middle_bottom_width_check + $s5_pos_middle_bottom_6_width; }

		if ($s5_middle_bottom_width_check != 100) {

		}

	}

	if ($s5_middle_bottom_counter == 1) {
		$s5_pos_middle_bottom_1_width = 100;
		$s5_pos_middle_bottom_2_width = 100;
		$s5_pos_middle_bottom_3_width = 100;
		$s5_pos_middle_bottom_4_width = 100;
		$s5_pos_middle_bottom_5_width = 100;
		$s5_pos_middle_bottom_6_width = 100;
	}

}

// below_body calculations

if ($s5_pos_below_body_1 == "published" || $s5_pos_below_body_2 == "published" || $s5_pos_below_body_3 == "published" || $s5_pos_below_body_4 == "published" || $s5_pos_below_body_5 == "published" || $s5_pos_below_body_6 == "published") {

	$s5_pos_below_body_1_width = 0;
	$s5_pos_below_body_2_width = 0;
	$s5_pos_below_body_3_width = 0;
	$s5_pos_below_body_4_width = 0;
	$s5_pos_below_body_5_width = 0;
	$s5_pos_below_body_6_width = 0;

	$s5_below_body_counter = 0;

	if ($s5_pos_below_body_1 == "published") { $s5_below_body_counter = $s5_below_body_counter + 1; }
	if ($s5_pos_below_body_2 == "published") { $s5_below_body_counter = $s5_below_body_counter + 1; }
	if ($s5_pos_below_body_3 == "published") { $s5_below_body_counter = $s5_below_body_counter + 1; }
	if ($s5_pos_below_body_4 == "published") { $s5_below_body_counter = $s5_below_body_counter + 1; }
	if ($s5_pos_below_body_5 == "published") { $s5_below_body_counter = $s5_below_body_counter + 1; }
	if ($s5_pos_below_body_6 == "published") { $s5_below_body_counter = $s5_below_body_counter + 1; }

	if ($s5_below_body_calculation == "automatic") {

		if ($s5_below_body_counter == 1) {
			$s5_pos_below_body_1_width = 100;
			$s5_pos_below_body_2_width = 100;
			$s5_pos_below_body_3_width = 100;
			$s5_pos_below_body_4_width = 100;
			$s5_pos_below_body_5_width = 100;
			$s5_pos_below_body_6_width = 100;
		}

		if ($s5_below_body_counter == 2) {
			$s5_pos_below_body_1_width = 50;
			$s5_pos_below_body_2_width = 50;
			$s5_pos_below_body_3_width = 50;
			$s5_pos_below_body_4_width = 50;
			$s5_pos_below_body_5_width = 50;
			$s5_pos_below_body_6_width = 50;
		}

		if ($s5_below_body_counter == 3) {
			$s5_pos_below_body_1_width = 33.3;
			$s5_pos_below_body_2_width = 33.3;
			$s5_pos_below_body_3_width = 33.3;
			$s5_pos_below_body_4_width = 33.3;
			$s5_pos_below_body_5_width = 33.3;
			$s5_pos_below_body_6_width = 33.3;
		}

		if ($s5_below_body_counter == 4) {
			$s5_pos_below_body_1_width = 25;
			$s5_pos_below_body_2_width = 25;
			$s5_pos_below_body_3_width = 25;
			$s5_pos_below_body_4_width = 25;
			$s5_pos_below_body_5_width = 25;
			$s5_pos_below_body_6_width = 25;
		}

		if ($s5_below_body_counter == 5) {
			$s5_pos_below_body_1_width = 20;
			$s5_pos_below_body_2_width = 20;
			$s5_pos_below_body_3_width = 20;
			$s5_pos_below_body_4_width = 20;
			$s5_pos_below_body_5_width = 20;
			$s5_pos_below_body_6_width = 20;
		}

		if ($s5_below_body_counter == 6) {
			$s5_pos_below_body_1_width = 16.66;
			$s5_pos_below_body_2_width = 16.66;
			$s5_pos_below_body_3_width = 16.66;
			$s5_pos_below_body_4_width = 16.66;
			$s5_pos_below_body_5_width = 16.66;
			$s5_pos_below_body_6_width = 16.66;
		}

	}

	if ($s5_below_body_calculation != "automatic") {

		$s5_below_body_manual_widths = str_replace(" ","",$s5_below_body_manual_widths);
		$s5_below_body_manual_widths = str_replace("%","",$s5_below_body_manual_widths);
		$s5_below_body_manual_widths = str_replace(";",",",$s5_below_body_manual_widths);
		$s5_below_body_manual_widths = $s5_below_body_manual_widths.",0,0,0,0,0,0,0";

		$s5_below_body_manual_widths_exploded = explode(",", $s5_below_body_manual_widths);
		$s5_pos_below_body_1_width = $s5_below_body_manual_widths_exploded[0];
		$s5_pos_below_body_2_width = $s5_below_body_manual_widths_exploded[1];
		$s5_pos_below_body_3_width = $s5_below_body_manual_widths_exploded[2];
		$s5_pos_below_body_4_width = $s5_below_body_manual_widths_exploded[3];
		$s5_pos_below_body_5_width = $s5_below_body_manual_widths_exploded[4];
		$s5_pos_below_body_6_width = $s5_below_body_manual_widths_exploded[5];

		if (substr_count($s5_below_body_manual_widths, ',') != 5) {

		}

		$s5_below_body_width_check = 0;

		if ($s5_pos_below_body_1 == "published") { $s5_below_body_width_check = $s5_below_body_width_check + $s5_pos_below_body_1_width; }
		if ($s5_pos_below_body_2 == "published") { $s5_below_body_width_check = $s5_below_body_width_check + $s5_pos_below_body_2_width; }
		if ($s5_pos_below_body_3 == "published") { $s5_below_body_width_check = $s5_below_body_width_check + $s5_pos_below_body_3_width; }
		if ($s5_pos_below_body_4 == "published") { $s5_below_body_width_check = $s5_below_body_width_check + $s5_pos_below_body_4_width; }
		if ($s5_pos_below_body_5 == "published") { $s5_below_body_width_check = $s5_below_body_width_check + $s5_pos_below_body_5_width; }
		if ($s5_pos_below_body_6 == "published") { $s5_below_body_width_check = $s5_below_body_width_check + $s5_pos_below_body_6_width; }

		if ($s5_below_body_width_check != 100) {

		}

	}

	if ($s5_below_body_counter == 1) {
		$s5_pos_below_body_1_width = 100;
		$s5_pos_below_body_2_width = 100;
		$s5_pos_below_body_3_width = 100;
		$s5_pos_below_body_4_width = 100;
		$s5_pos_below_body_5_width = 100;
		$s5_pos_below_body_6_width = 100;
	}

}


// below_columns calculations

if ($s5_pos_below_columns_1 == "published" || $s5_pos_below_columns_2 == "published" || $s5_pos_below_columns_3 == "published" || $s5_pos_below_columns_4 == "published" || $s5_pos_below_columns_5 == "published" || $s5_pos_below_columns_6 == "published") {

	$s5_pos_below_columns_1_width = 0;
	$s5_pos_below_columns_2_width = 0;
	$s5_pos_below_columns_3_width = 0;
	$s5_pos_below_columns_4_width = 0;
	$s5_pos_below_columns_5_width = 0;
	$s5_pos_below_columns_6_width = 0;

	$s5_below_columns_counter = 0;

	if ($s5_pos_below_columns_1 == "published") { $s5_below_columns_counter = $s5_below_columns_counter + 1; }
	if ($s5_pos_below_columns_2 == "published") { $s5_below_columns_counter = $s5_below_columns_counter + 1; }
	if ($s5_pos_below_columns_3 == "published") { $s5_below_columns_counter = $s5_below_columns_counter + 1; }
	if ($s5_pos_below_columns_4 == "published") { $s5_below_columns_counter = $s5_below_columns_counter + 1; }
	if ($s5_pos_below_columns_5 == "published") { $s5_below_columns_counter = $s5_below_columns_counter + 1; }
	if ($s5_pos_below_columns_6 == "published") { $s5_below_columns_counter = $s5_below_columns_counter + 1; }

	if ($s5_below_columns_calculation == "automatic") {

		if ($s5_below_columns_counter == 1) {
			$s5_pos_below_columns_1_width = 100;
			$s5_pos_below_columns_2_width = 100;
			$s5_pos_below_columns_3_width = 100;
			$s5_pos_below_columns_4_width = 100;
			$s5_pos_below_columns_5_width = 100;
			$s5_pos_below_columns_6_width = 100;
		}

		if ($s5_below_columns_counter == 2) {
			$s5_pos_below_columns_1_width = 50;
			$s5_pos_below_columns_2_width = 50;
			$s5_pos_below_columns_3_width = 50;
			$s5_pos_below_columns_4_width = 50;
			$s5_pos_below_columns_5_width = 50;
			$s5_pos_below_columns_6_width = 50;
		}

		if ($s5_below_columns_counter == 3) {
			$s5_pos_below_columns_1_width = 33.3;
			$s5_pos_below_columns_2_width = 33.3;
			$s5_pos_below_columns_3_width = 33.3;
			$s5_pos_below_columns_4_width = 33.3;
			$s5_pos_below_columns_5_width = 33.3;
			$s5_pos_below_columns_6_width = 33.3;
		}

		if ($s5_below_columns_counter == 4) {
			$s5_pos_below_columns_1_width = 25;
			$s5_pos_below_columns_2_width = 25;
			$s5_pos_below_columns_3_width = 25;
			$s5_pos_below_columns_4_width = 25;
			$s5_pos_below_columns_5_width = 25;
			$s5_pos_below_columns_6_width = 25;
		}

		if ($s5_below_columns_counter == 5) {
			$s5_pos_below_columns_1_width = 20;
			$s5_pos_below_columns_2_width = 20;
			$s5_pos_below_columns_3_width = 20;
			$s5_pos_below_columns_4_width = 20;
			$s5_pos_below_columns_5_width = 20;
			$s5_pos_below_columns_6_width = 20;
		}

		if ($s5_below_columns_counter == 6) {
			$s5_pos_below_columns_1_width = 16.66;
			$s5_pos_below_columns_2_width = 16.66;
			$s5_pos_below_columns_3_width = 16.66;
			$s5_pos_below_columns_4_width = 16.66;
			$s5_pos_below_columns_5_width = 16.66;
			$s5_pos_below_columns_6_width = 16.66;
		}

	}

	if ($s5_below_columns_calculation != "automatic") {

		$s5_below_columns_manual_widths = str_replace(" ","",$s5_below_columns_manual_widths);
		$s5_below_columns_manual_widths = str_replace("%","",$s5_below_columns_manual_widths);
		$s5_below_columns_manual_widths = str_replace(";",",",$s5_below_columns_manual_widths);
		$s5_below_columns_manual_widths = $s5_below_columns_manual_widths.",0,0,0,0,0,0,0";

		$s5_below_columns_manual_widths_exploded = explode(",", $s5_below_columns_manual_widths);
		$s5_pos_below_columns_1_width = $s5_below_columns_manual_widths_exploded[0];
		$s5_pos_below_columns_2_width = $s5_below_columns_manual_widths_exploded[1];
		$s5_pos_below_columns_3_width = $s5_below_columns_manual_widths_exploded[2];
		$s5_pos_below_columns_4_width = $s5_below_columns_manual_widths_exploded[3];
		$s5_pos_below_columns_5_width = $s5_below_columns_manual_widths_exploded[4];
		$s5_pos_below_columns_6_width = $s5_below_columns_manual_widths_exploded[5];

		if (substr_count($s5_below_columns_manual_widths, ',') != 5) {

		}

		$s5_below_columns_width_check = 0;

		if ($s5_pos_below_columns_1 == "published") { $s5_below_columns_width_check = $s5_below_columns_width_check + $s5_pos_below_columns_1_width; }
		if ($s5_pos_below_columns_2 == "published") { $s5_below_columns_width_check = $s5_below_columns_width_check + $s5_pos_below_columns_2_width; }
		if ($s5_pos_below_columns_3 == "published") { $s5_below_columns_width_check = $s5_below_columns_width_check + $s5_pos_below_columns_3_width; }
		if ($s5_pos_below_columns_4 == "published") { $s5_below_columns_width_check = $s5_below_columns_width_check + $s5_pos_below_columns_4_width; }
		if ($s5_pos_below_columns_5 == "published") { $s5_below_columns_width_check = $s5_below_columns_width_check + $s5_pos_below_columns_5_width; }
		if ($s5_pos_below_columns_6 == "published") { $s5_below_columns_width_check = $s5_below_columns_width_check + $s5_pos_below_columns_6_width; }

		if ($s5_below_columns_width_check != 100) {

		}

	}

	if ($s5_below_columns_counter == 1) {
		$s5_pos_below_columns_1_width = 100;
		$s5_pos_below_columns_2_width = 100;
		$s5_pos_below_columns_3_width = 100;
		$s5_pos_below_columns_4_width = 100;
		$s5_pos_below_columns_5_width = 100;
		$s5_pos_below_columns_6_width = 100;
	}

}



// bottom_row1 calculations

if ($s5_pos_bottom_row1_1 == "published" || $s5_pos_bottom_row1_2 == "published" || $s5_pos_bottom_row1_3 == "published" || $s5_pos_bottom_row1_4 == "published" || $s5_pos_bottom_row1_5 == "published" || $s5_pos_bottom_row1_6 == "published") {

	$s5_pos_bottom_row1_1_width = 0;
	$s5_pos_bottom_row1_2_width = 0;
	$s5_pos_bottom_row1_3_width = 0;
	$s5_pos_bottom_row1_4_width = 0;
	$s5_pos_bottom_row1_5_width = 0;
	$s5_pos_bottom_row1_6_width = 0;

	$s5_bottom_row1_counter = 0;

	if ($s5_pos_bottom_row1_1 == "published") { $s5_bottom_row1_counter = $s5_bottom_row1_counter + 1; }
	if ($s5_pos_bottom_row1_2 == "published") { $s5_bottom_row1_counter = $s5_bottom_row1_counter + 1; }
	if ($s5_pos_bottom_row1_3 == "published") { $s5_bottom_row1_counter = $s5_bottom_row1_counter + 1; }
	if ($s5_pos_bottom_row1_4 == "published") { $s5_bottom_row1_counter = $s5_bottom_row1_counter + 1; }
	if ($s5_pos_bottom_row1_5 == "published") { $s5_bottom_row1_counter = $s5_bottom_row1_counter + 1; }
	if ($s5_pos_bottom_row1_6 == "published") { $s5_bottom_row1_counter = $s5_bottom_row1_counter + 1; }

	if ($s5_bottom_row1_calculation == "automatic") {

		if ($s5_bottom_row1_counter == 1) {
			$s5_pos_bottom_row1_1_width = 100;
			$s5_pos_bottom_row1_2_width = 100;
			$s5_pos_bottom_row1_3_width = 100;
			$s5_pos_bottom_row1_4_width = 100;
			$s5_pos_bottom_row1_5_width = 100;
			$s5_pos_bottom_row1_6_width = 100;
		}

		if ($s5_bottom_row1_counter == 2) {
			$s5_pos_bottom_row1_1_width = 50;
			$s5_pos_bottom_row1_2_width = 50;
			$s5_pos_bottom_row1_3_width = 50;
			$s5_pos_bottom_row1_4_width = 50;
			$s5_pos_bottom_row1_5_width = 50;
			$s5_pos_bottom_row1_6_width = 50;
		}

		if ($s5_bottom_row1_counter == 3) {
			$s5_pos_bottom_row1_1_width = 33.3;
			$s5_pos_bottom_row1_2_width = 33.3;
			$s5_pos_bottom_row1_3_width = 33.3;
			$s5_pos_bottom_row1_4_width = 33.3;
			$s5_pos_bottom_row1_5_width = 33.3;
			$s5_pos_bottom_row1_6_width = 33.3;
		}

		if ($s5_bottom_row1_counter == 4) {
			$s5_pos_bottom_row1_1_width = 25;
			$s5_pos_bottom_row1_2_width = 25;
			$s5_pos_bottom_row1_3_width = 25;
			$s5_pos_bottom_row1_4_width = 25;
			$s5_pos_bottom_row1_5_width = 25;
			$s5_pos_bottom_row1_6_width = 25;
		}

		if ($s5_bottom_row1_counter == 5) {
			$s5_pos_bottom_row1_1_width = 20;
			$s5_pos_bottom_row1_2_width = 20;
			$s5_pos_bottom_row1_3_width = 20;
			$s5_pos_bottom_row1_4_width = 20;
			$s5_pos_bottom_row1_5_width = 20;
			$s5_pos_bottom_row1_6_width = 20;
		}

		if ($s5_bottom_row1_counter == 6) {
			$s5_pos_bottom_row1_1_width = 16.66;
			$s5_pos_bottom_row1_2_width = 16.66;
			$s5_pos_bottom_row1_3_width = 16.66;
			$s5_pos_bottom_row1_4_width = 16.66;
			$s5_pos_bottom_row1_5_width = 16.66;
			$s5_pos_bottom_row1_6_width = 16.66;
		}

	}

	if ($s5_bottom_row1_calculation != "automatic") {

		$s5_bottom_row1_manual_widths = str_replace(" ","",$s5_bottom_row1_manual_widths);
		$s5_bottom_row1_manual_widths = str_replace("%","",$s5_bottom_row1_manual_widths);
		$s5_bottom_row1_manual_widths = str_replace(";",",",$s5_bottom_row1_manual_widths);
		$s5_bottom_row1_manual_widths = $s5_bottom_row1_manual_widths.",0,0,0,0,0,0,0";

		$s5_bottom_row1_manual_widths_exploded = explode(",", $s5_bottom_row1_manual_widths);
		$s5_pos_bottom_row1_1_width = $s5_bottom_row1_manual_widths_exploded[0];
		$s5_pos_bottom_row1_2_width = $s5_bottom_row1_manual_widths_exploded[1];
		$s5_pos_bottom_row1_3_width = $s5_bottom_row1_manual_widths_exploded[2];
		$s5_pos_bottom_row1_4_width = $s5_bottom_row1_manual_widths_exploded[3];
		$s5_pos_bottom_row1_5_width = $s5_bottom_row1_manual_widths_exploded[4];
		$s5_pos_bottom_row1_6_width = $s5_bottom_row1_manual_widths_exploded[5];

		if (substr_count($s5_bottom_row1_manual_widths, ',') != 5) {

		}

		$s5_bottom_row1_width_check = 0;

		if ($s5_pos_bottom_row1_1 == "published") { $s5_bottom_row1_width_check = $s5_bottom_row1_width_check + $s5_pos_bottom_row1_1_width; }
		if ($s5_pos_bottom_row1_2 == "published") { $s5_bottom_row1_width_check = $s5_bottom_row1_width_check + $s5_pos_bottom_row1_2_width; }
		if ($s5_pos_bottom_row1_3 == "published") { $s5_bottom_row1_width_check = $s5_bottom_row1_width_check + $s5_pos_bottom_row1_3_width; }
		if ($s5_pos_bottom_row1_4 == "published") { $s5_bottom_row1_width_check = $s5_bottom_row1_width_check + $s5_pos_bottom_row1_4_width; }
		if ($s5_pos_bottom_row1_5 == "published") { $s5_bottom_row1_width_check = $s5_bottom_row1_width_check + $s5_pos_bottom_row1_5_width; }
		if ($s5_pos_bottom_row1_6 == "published") { $s5_bottom_row1_width_check = $s5_bottom_row1_width_check + $s5_pos_bottom_row1_6_width; }

		if ($s5_bottom_row1_width_check != 100) {

		}

	}

	if ($s5_bottom_row1_counter == 1) {
		$s5_pos_bottom_row1_1_width = 100;
		$s5_pos_bottom_row1_2_width = 100;
		$s5_pos_bottom_row1_3_width = 100;
		$s5_pos_bottom_row1_4_width = 100;
		$s5_pos_bottom_row1_5_width = 100;
		$s5_pos_bottom_row1_6_width = 100;
	}

}

// bottom_row2 calculations

if ($s5_pos_bottom_row2_1 == "published" || $s5_pos_bottom_row2_2 == "published" || $s5_pos_bottom_row2_3 == "published" || $s5_pos_bottom_row2_4 == "published" || $s5_pos_bottom_row2_5 == "published" || $s5_pos_bottom_row2_6 == "published") {

	$s5_pos_bottom_row2_1_width = 0;
	$s5_pos_bottom_row2_2_width = 0;
	$s5_pos_bottom_row2_3_width = 0;
	$s5_pos_bottom_row2_4_width = 0;
	$s5_pos_bottom_row2_5_width = 0;
	$s5_pos_bottom_row2_6_width = 0;

	$s5_bottom_row2_counter = 0;

	if ($s5_pos_bottom_row2_1 == "published") { $s5_bottom_row2_counter = $s5_bottom_row2_counter + 1; }
	if ($s5_pos_bottom_row2_2 == "published") { $s5_bottom_row2_counter = $s5_bottom_row2_counter + 1; }
	if ($s5_pos_bottom_row2_3 == "published") { $s5_bottom_row2_counter = $s5_bottom_row2_counter + 1; }
	if ($s5_pos_bottom_row2_4 == "published") { $s5_bottom_row2_counter = $s5_bottom_row2_counter + 1; }
	if ($s5_pos_bottom_row2_5 == "published") { $s5_bottom_row2_counter = $s5_bottom_row2_counter + 1; }
	if ($s5_pos_bottom_row2_6 == "published") { $s5_bottom_row2_counter = $s5_bottom_row2_counter + 1; }

	if ($s5_bottom_row2_calculation == "automatic") {

		if ($s5_bottom_row2_counter == 1) {
			$s5_pos_bottom_row2_1_width = 100;
			$s5_pos_bottom_row2_2_width = 100;
			$s5_pos_bottom_row2_3_width = 100;
			$s5_pos_bottom_row2_4_width = 100;
			$s5_pos_bottom_row2_5_width = 100;
			$s5_pos_bottom_row2_6_width = 100;
		}

		if ($s5_bottom_row2_counter == 2) {
			$s5_pos_bottom_row2_1_width = 50;
			$s5_pos_bottom_row2_2_width = 50;
			$s5_pos_bottom_row2_3_width = 50;
			$s5_pos_bottom_row2_4_width = 50;
			$s5_pos_bottom_row2_5_width = 50;
			$s5_pos_bottom_row2_6_width = 50;
		}

		if ($s5_bottom_row2_counter == 3) {
			$s5_pos_bottom_row2_1_width = 33.3;
			$s5_pos_bottom_row2_2_width = 33.3;
			$s5_pos_bottom_row2_3_width = 33.3;
			$s5_pos_bottom_row2_4_width = 33.3;
			$s5_pos_bottom_row2_5_width = 33.3;
			$s5_pos_bottom_row2_6_width = 33.3;
		}

		if ($s5_bottom_row2_counter == 4) {
			$s5_pos_bottom_row2_1_width = 25;
			$s5_pos_bottom_row2_2_width = 25;
			$s5_pos_bottom_row2_3_width = 25;
			$s5_pos_bottom_row2_4_width = 25;
			$s5_pos_bottom_row2_5_width = 25;
			$s5_pos_bottom_row2_6_width = 25;
		}

		if ($s5_bottom_row2_counter == 5) {
			$s5_pos_bottom_row2_1_width = 20;
			$s5_pos_bottom_row2_2_width = 20;
			$s5_pos_bottom_row2_3_width = 20;
			$s5_pos_bottom_row2_4_width = 20;
			$s5_pos_bottom_row2_5_width = 20;
			$s5_pos_bottom_row2_6_width = 20;
		}

		if ($s5_bottom_row2_counter == 6) {
			$s5_pos_bottom_row2_1_width = 16.66;
			$s5_pos_bottom_row2_2_width = 16.66;
			$s5_pos_bottom_row2_3_width = 16.66;
			$s5_pos_bottom_row2_4_width = 16.66;
			$s5_pos_bottom_row2_5_width = 16.66;
			$s5_pos_bottom_row2_6_width = 16.66;
		}

	}

	if ($s5_bottom_row2_calculation != "automatic") {

		$s5_bottom_row2_manual_widths = str_replace(" ","",$s5_bottom_row2_manual_widths);
		$s5_bottom_row2_manual_widths = str_replace("%","",$s5_bottom_row2_manual_widths);
		$s5_bottom_row2_manual_widths = str_replace(";",",",$s5_bottom_row2_manual_widths);
		$s5_bottom_row2_manual_widths = $s5_bottom_row2_manual_widths.",0,0,0,0,0,0,0";

		$s5_bottom_row2_manual_widths_exploded = explode(",", $s5_bottom_row2_manual_widths);
		$s5_pos_bottom_row2_1_width = $s5_bottom_row2_manual_widths_exploded[0];
		$s5_pos_bottom_row2_2_width = $s5_bottom_row2_manual_widths_exploded[1];
		$s5_pos_bottom_row2_3_width = $s5_bottom_row2_manual_widths_exploded[2];
		$s5_pos_bottom_row2_4_width = $s5_bottom_row2_manual_widths_exploded[3];
		$s5_pos_bottom_row2_5_width = $s5_bottom_row2_manual_widths_exploded[4];
		$s5_pos_bottom_row2_6_width = $s5_bottom_row2_manual_widths_exploded[5];

		if (substr_count($s5_bottom_row2_manual_widths, ',') != 5) {

		}

		$s5_bottom_row2_width_check = 0;

		if ($s5_pos_bottom_row2_1 == "published") { $s5_bottom_row2_width_check = $s5_bottom_row2_width_check + $s5_pos_bottom_row2_1_width; }
		if ($s5_pos_bottom_row2_2 == "published") { $s5_bottom_row2_width_check = $s5_bottom_row2_width_check + $s5_pos_bottom_row2_2_width; }
		if ($s5_pos_bottom_row2_3 == "published") { $s5_bottom_row2_width_check = $s5_bottom_row2_width_check + $s5_pos_bottom_row2_3_width; }
		if ($s5_pos_bottom_row2_4 == "published") { $s5_bottom_row2_width_check = $s5_bottom_row2_width_check + $s5_pos_bottom_row2_4_width; }
		if ($s5_pos_bottom_row2_5 == "published") { $s5_bottom_row2_width_check = $s5_bottom_row2_width_check + $s5_pos_bottom_row2_5_width; }
		if ($s5_pos_bottom_row2_6 == "published") { $s5_bottom_row2_width_check = $s5_bottom_row2_width_check + $s5_pos_bottom_row2_6_width; }

		if ($s5_bottom_row2_width_check != 100) {

		}

	}

	if ($s5_bottom_row2_counter == 1) {
		$s5_pos_bottom_row2_1_width = 100;
		$s5_pos_bottom_row2_2_width = 100;
		$s5_pos_bottom_row2_3_width = 100;
		$s5_pos_bottom_row2_4_width = 100;
		$s5_pos_bottom_row2_5_width = 100;
		$s5_pos_bottom_row2_6_width = 100;
	}

}

// bottom_row3 calculations

if ($s5_pos_bottom_row3_1 == "published" || $s5_pos_bottom_row3_2 == "published" || $s5_pos_bottom_row3_3 == "published" || $s5_pos_bottom_row3_4 == "published" || $s5_pos_bottom_row3_5 == "published" || $s5_pos_bottom_row3_6 == "published") {

	$s5_pos_bottom_row3_1_width = 0;
	$s5_pos_bottom_row3_2_width = 0;
	$s5_pos_bottom_row3_3_width = 0;
	$s5_pos_bottom_row3_4_width = 0;
	$s5_pos_bottom_row3_5_width = 0;
	$s5_pos_bottom_row3_6_width = 0;

	$s5_bottom_row3_counter = 0;

	if ($s5_pos_bottom_row3_1 == "published") { $s5_bottom_row3_counter = $s5_bottom_row3_counter + 1; }
	if ($s5_pos_bottom_row3_2 == "published") { $s5_bottom_row3_counter = $s5_bottom_row3_counter + 1; }
	if ($s5_pos_bottom_row3_3 == "published") { $s5_bottom_row3_counter = $s5_bottom_row3_counter + 1; }
	if ($s5_pos_bottom_row3_4 == "published") { $s5_bottom_row3_counter = $s5_bottom_row3_counter + 1; }
	if ($s5_pos_bottom_row3_5 == "published") { $s5_bottom_row3_counter = $s5_bottom_row3_counter + 1; }
	if ($s5_pos_bottom_row3_6 == "published") { $s5_bottom_row3_counter = $s5_bottom_row3_counter + 1; }

	if ($s5_bottom_row3_calculation == "automatic") {

		if ($s5_bottom_row3_counter == 1) {
			$s5_pos_bottom_row3_1_width = 100;
			$s5_pos_bottom_row3_2_width = 100;
			$s5_pos_bottom_row3_3_width = 100;
			$s5_pos_bottom_row3_4_width = 100;
			$s5_pos_bottom_row3_5_width = 100;
			$s5_pos_bottom_row3_6_width = 100;
		}

		if ($s5_bottom_row3_counter == 2) {
			$s5_pos_bottom_row3_1_width = 50;
			$s5_pos_bottom_row3_2_width = 50;
			$s5_pos_bottom_row3_3_width = 50;
			$s5_pos_bottom_row3_4_width = 50;
			$s5_pos_bottom_row3_5_width = 50;
			$s5_pos_bottom_row3_6_width = 50;
		}

		if ($s5_bottom_row3_counter == 3) {
			$s5_pos_bottom_row3_1_width = 33.3;
			$s5_pos_bottom_row3_2_width = 33.3;
			$s5_pos_bottom_row3_3_width = 33.3;
			$s5_pos_bottom_row3_4_width = 33.3;
			$s5_pos_bottom_row3_5_width = 33.3;
			$s5_pos_bottom_row3_6_width = 33.3;
		}

		if ($s5_bottom_row3_counter == 4) {
			$s5_pos_bottom_row3_1_width = 25;
			$s5_pos_bottom_row3_2_width = 25;
			$s5_pos_bottom_row3_3_width = 25;
			$s5_pos_bottom_row3_4_width = 25;
			$s5_pos_bottom_row3_5_width = 25;
			$s5_pos_bottom_row3_6_width = 25;
		}

		if ($s5_bottom_row3_counter == 5) {
			$s5_pos_bottom_row3_1_width = 20;
			$s5_pos_bottom_row3_2_width = 20;
			$s5_pos_bottom_row3_3_width = 20;
			$s5_pos_bottom_row3_4_width = 20;
			$s5_pos_bottom_row3_5_width = 20;
			$s5_pos_bottom_row3_6_width = 20;
		}

		if ($s5_bottom_row3_counter == 6) {
			$s5_pos_bottom_row3_1_width = 16.66;
			$s5_pos_bottom_row3_2_width = 16.66;
			$s5_pos_bottom_row3_3_width = 16.66;
			$s5_pos_bottom_row3_4_width = 16.66;
			$s5_pos_bottom_row3_5_width = 16.66;
			$s5_pos_bottom_row3_6_width = 16.66;
		}

	}

	if ($s5_bottom_row3_calculation != "automatic") {

		$s5_bottom_row3_manual_widths = str_replace(" ","",$s5_bottom_row3_manual_widths);
		$s5_bottom_row3_manual_widths = str_replace("%","",$s5_bottom_row3_manual_widths);
		$s5_bottom_row3_manual_widths = str_replace(";",",",$s5_bottom_row3_manual_widths);
		$s5_bottom_row3_manual_widths = $s5_bottom_row3_manual_widths.",0,0,0,0,0,0,0";

		$s5_bottom_row3_manual_widths_exploded = explode(",", $s5_bottom_row3_manual_widths);
		$s5_pos_bottom_row3_1_width = $s5_bottom_row3_manual_widths_exploded[0];
		$s5_pos_bottom_row3_2_width = $s5_bottom_row3_manual_widths_exploded[1];
		$s5_pos_bottom_row3_3_width = $s5_bottom_row3_manual_widths_exploded[2];
		$s5_pos_bottom_row3_4_width = $s5_bottom_row3_manual_widths_exploded[3];
		$s5_pos_bottom_row3_5_width = $s5_bottom_row3_manual_widths_exploded[4];
		$s5_pos_bottom_row3_6_width = $s5_bottom_row3_manual_widths_exploded[5];

		if (substr_count($s5_bottom_row3_manual_widths, ',') != 5) {

		}

		$s5_bottom_row3_width_check = 0;

		if ($s5_pos_bottom_row3_1 == "published") { $s5_bottom_row3_width_check = $s5_bottom_row3_width_check + $s5_pos_bottom_row3_1_width; }
		if ($s5_pos_bottom_row3_2 == "published") { $s5_bottom_row3_width_check = $s5_bottom_row3_width_check + $s5_pos_bottom_row3_2_width; }
		if ($s5_pos_bottom_row3_3 == "published") { $s5_bottom_row3_width_check = $s5_bottom_row3_width_check + $s5_pos_bottom_row3_3_width; }
		if ($s5_pos_bottom_row3_4 == "published") { $s5_bottom_row3_width_check = $s5_bottom_row3_width_check + $s5_pos_bottom_row3_4_width; }
		if ($s5_pos_bottom_row3_5 == "published") { $s5_bottom_row3_width_check = $s5_bottom_row3_width_check + $s5_pos_bottom_row3_5_width; }
		if ($s5_pos_bottom_row3_6 == "published") { $s5_bottom_row3_width_check = $s5_bottom_row3_width_check + $s5_pos_bottom_row3_6_width; }

		if ($s5_bottom_row3_width_check != 100) {

		}

	}

	if ($s5_bottom_row3_counter == 1) {
		$s5_pos_bottom_row3_1_width = 100;
		$s5_pos_bottom_row3_2_width = 100;
		$s5_pos_bottom_row3_3_width = 100;
		$s5_pos_bottom_row3_4_width = 100;
		$s5_pos_bottom_row3_5_width = 100;
		$s5_pos_bottom_row3_6_width = 100;
	}

}



// drop_down calculations

if ($s5_pos_drop_down_1 == "published" || $s5_pos_drop_down_2 == "published" || $s5_pos_drop_down_3 == "published" || $s5_pos_drop_down_4 == "published" || $s5_pos_drop_down_5 == "published" || $s5_pos_drop_down_6 == "published") {

	$s5_pos_drop_down_1_width = 0;
	$s5_pos_drop_down_2_width = 0;
	$s5_pos_drop_down_3_width = 0;
	$s5_pos_drop_down_4_width = 0;
	$s5_pos_drop_down_5_width = 0;
	$s5_pos_drop_down_6_width = 0;

	$s5_drop_down_counter = 0;

	if ($s5_pos_drop_down_1 == "published") { $s5_drop_down_counter = $s5_drop_down_counter + 1; }
	if ($s5_pos_drop_down_2 == "published") { $s5_drop_down_counter = $s5_drop_down_counter + 1; }
	if ($s5_pos_drop_down_3 == "published") { $s5_drop_down_counter = $s5_drop_down_counter + 1; }
	if ($s5_pos_drop_down_4 == "published") { $s5_drop_down_counter = $s5_drop_down_counter + 1; }
	if ($s5_pos_drop_down_5 == "published") { $s5_drop_down_counter = $s5_drop_down_counter + 1; }
	if ($s5_pos_drop_down_6 == "published") { $s5_drop_down_counter = $s5_drop_down_counter + 1; }

	if ($s5_drop_down_calculation == "automatic") {

		if ($s5_drop_down_counter == 1) {
			$s5_pos_drop_down_1_width = 100;
			$s5_pos_drop_down_2_width = 100;
			$s5_pos_drop_down_3_width = 100;
			$s5_pos_drop_down_4_width = 100;
			$s5_pos_drop_down_5_width = 100;
			$s5_pos_drop_down_6_width = 100;
		}

		if ($s5_drop_down_counter == 2) {
			$s5_pos_drop_down_1_width = 50;
			$s5_pos_drop_down_2_width = 50;
			$s5_pos_drop_down_3_width = 50;
			$s5_pos_drop_down_4_width = 50;
			$s5_pos_drop_down_5_width = 50;
			$s5_pos_drop_down_6_width = 50;
		}

		if ($s5_drop_down_counter == 3) {
			$s5_pos_drop_down_1_width = 33.3;
			$s5_pos_drop_down_2_width = 33.3;
			$s5_pos_drop_down_3_width = 33.3;
			$s5_pos_drop_down_4_width = 33.3;
			$s5_pos_drop_down_5_width = 33.3;
			$s5_pos_drop_down_6_width = 33.3;
		}

		if ($s5_drop_down_counter == 4) {
			$s5_pos_drop_down_1_width = 25;
			$s5_pos_drop_down_2_width = 25;
			$s5_pos_drop_down_3_width = 25;
			$s5_pos_drop_down_4_width = 25;
			$s5_pos_drop_down_5_width = 25;
			$s5_pos_drop_down_6_width = 25;
		}

		if ($s5_drop_down_counter == 5) {
			$s5_pos_drop_down_1_width = 20;
			$s5_pos_drop_down_2_width = 20;
			$s5_pos_drop_down_3_width = 20;
			$s5_pos_drop_down_4_width = 20;
			$s5_pos_drop_down_5_width = 20;
			$s5_pos_drop_down_6_width = 20;
		}

		if ($s5_drop_down_counter == 6) {
			$s5_pos_drop_down_1_width = 16.66;
			$s5_pos_drop_down_2_width = 16.66;
			$s5_pos_drop_down_3_width = 16.66;
			$s5_pos_drop_down_4_width = 16.66;
			$s5_pos_drop_down_5_width = 16.66;
			$s5_pos_drop_down_6_width = 16.66;
		}

	}

	if ($s5_drop_down_calculation != "automatic") {

		$s5_drop_down_manual_widths = str_replace(" ","",$s5_drop_down_manual_widths);
		$s5_drop_down_manual_widths = str_replace("%","",$s5_drop_down_manual_widths);
		$s5_drop_down_manual_widths = str_replace(";",",",$s5_drop_down_manual_widths);
		$s5_drop_down_manual_widths = $s5_drop_down_manual_widths.",0,0,0,0,0,0,0";

		$s5_drop_down_manual_widths_exploded = explode(",", $s5_drop_down_manual_widths);
		$s5_pos_drop_down_1_width = $s5_drop_down_manual_widths_exploded[0];
		$s5_pos_drop_down_2_width = $s5_drop_down_manual_widths_exploded[1];
		$s5_pos_drop_down_3_width = $s5_drop_down_manual_widths_exploded[2];
		$s5_pos_drop_down_4_width = $s5_drop_down_manual_widths_exploded[3];
		$s5_pos_drop_down_5_width = $s5_drop_down_manual_widths_exploded[4];
		$s5_pos_drop_down_6_width = $s5_drop_down_manual_widths_exploded[5];

		if (substr_count($s5_drop_down_manual_widths, ',') != 5) {

		}

		$s5_drop_down_width_check = 0;

		if ($s5_pos_drop_down_1 == "published") { $s5_drop_down_width_check = $s5_drop_down_width_check + $s5_pos_drop_down_1_width; }
		if ($s5_pos_drop_down_2 == "published") { $s5_drop_down_width_check = $s5_drop_down_width_check + $s5_pos_drop_down_2_width; }
		if ($s5_pos_drop_down_3 == "published") { $s5_drop_down_width_check = $s5_drop_down_width_check + $s5_pos_drop_down_3_width; }
		if ($s5_pos_drop_down_4 == "published") { $s5_drop_down_width_check = $s5_drop_down_width_check + $s5_pos_drop_down_4_width; }
		if ($s5_pos_drop_down_5 == "published") { $s5_drop_down_width_check = $s5_drop_down_width_check + $s5_pos_drop_down_5_width; }
		if ($s5_pos_drop_down_6 == "published") { $s5_drop_down_width_check = $s5_drop_down_width_check + $s5_pos_drop_down_6_width; }

		if ($s5_drop_down_width_check != 100) {

		}

	}

	if ($s5_drop_down_counter == 1) {
		$s5_pos_drop_down_1_width = 100;
		$s5_pos_drop_down_2_width = 100;
		$s5_pos_drop_down_3_width = 100;
		$s5_pos_drop_down_4_width = 100;
		$s5_pos_drop_down_5_width = 100;
		$s5_pos_drop_down_6_width = 100;
	}

}

?>