if(! String.prototype.capitalize) String.prototype.capitalize=function(){
	return this.toString().charAt(0).toUpperCase() + this.toString().slice(1);
};
(function($){
window.s5_columns_equalizer = function(elements){
	this.elements;
	this.initialize(elements);
}
s5_columns_equalizer.prototype.initialize = function(elements){
	this.elements = $(elements);
}
s5_columns_equalizer.prototype.equalize = function(hw){
		if(!hw) { hw = 'height'; }
		var max = 0, 
			prop = (typeof document.body.style.maxHeight != 'undefined' ? 'min-' : '') + hw; //ie6 ftl
			offset = 'offset' + hw.toString().capitalize();
		this.elements.each(function(i, element) {
			var calc = element[offset];
			if(calc > max) { max = calc; }
		});
		this.elements.each(function(i, element) {
			$(element).css(prop, max - (element[offset] - $(element).css(hw).replace('px','')));
		});
		return max;
}
})(jQuery);


var s5_resize_columns_small_tablets_screen_size = "yes";
var s5_screen_width = 0;
var s5_screen_height = 0;
function s5_load_resize_columns() {
s5_screen_width = document.body.offsetWidth;
s5_screen_height = document.body.offsetHeight;
if (s5_resize_columns_small_tablets == "single") {
	if (document.body.offsetWidth <= 750) {
		var s5_remove_resize = document.getElementById("s5_columns_wrap").querySelectorAll('DIV,ASIDE');
		for (var s5_remove_resize_y=0; s5_remove_resize_y<s5_remove_resize.length; s5_remove_resize_y++) {
			if (s5_remove_resize[s5_remove_resize_y].className.indexOf("s5_resize") >= 0) {
				s5_remove_resize[s5_remove_resize_y].style.minHeight = "1px";
			}
		}
	}
}

if (document.body.offsetWidth <= 580) {
	var s5_remove_resize = document.getElementById("s5_body").querySelectorAll('DIV,ASIDE');
	for (var s5_remove_resize_y=0; s5_remove_resize_y<s5_remove_resize.length; s5_remove_resize_y++) {
		if (s5_remove_resize[s5_remove_resize_y].className.indexOf("s5_resize") >= 0) {
			s5_remove_resize[s5_remove_resize_y].style.minHeight = "1px";
		}
	}
}

if (document.body.offsetWidth > 580) {

if (s5_resize_columns_small_tablets == "single" && document.body.offsetWidth <= 750) {
s5_resize_columns_small_tablets_screen_size = "no";
}
else {
s5_resize_columns_small_tablets_screen_size = "yes";
}

if (document.getElementById("s5_columns_wrap") && s5_resize_columns_small_tablets_screen_size == "yes") {
	var s5_resize_center_columns = document.getElementById("s5_columns_wrap").querySelectorAll('DIV,ASIDE');
	for (var s5_resize_center_columns_y=0; s5_resize_center_columns_y<s5_resize_center_columns.length; s5_resize_center_columns_y++) {
		if (s5_resize_center_columns[s5_resize_center_columns_y].id == "s5_center_column_wrap_inner" || s5_resize_center_columns[s5_resize_center_columns_y].id == "s5_left_column_wrap" || s5_resize_center_columns[s5_resize_center_columns_y].id == "s5_right_column_wrap") {
			s5_resize_center_columns[s5_resize_center_columns_y].style.minHeight = "1px";
			if (s5_resize_center_columns[s5_resize_center_columns_y].className == "") {
				s5_resize_center_columns[s5_resize_center_columns_y].className = "s5_resize_center_columns";
			}
			else {
				var s5_resize_classname = s5_resize_center_columns[s5_resize_center_columns_y].className;
				if (s5_resize_classname.indexOf("s5_resize") < 0) {
					s5_resize_center_columns[s5_resize_center_columns_y].className = "s5_resize_center_columns " + s5_resize_center_columns[s5_resize_center_columns_y].className;
				}
			}
		}
	}
}

if (s5_resize_columns  == "all") {

	if (document.getElementById("s5_top_row1")) {
		var s5_resize_top_row1 = document.getElementById("s5_top_row1").querySelectorAll('DIV,ASIDE');
		for (var s5_resize_top_row1_y=0; s5_resize_top_row1_y<s5_resize_top_row1.length; s5_resize_top_row1_y++) {
			if (s5_resize_top_row1[s5_resize_top_row1_y].className.indexOf("s5_resize_top_row1") >= 0) {
				s5_resize_top_row1[s5_resize_top_row1_y].style.minHeight = "1px";
			}
			if (s5_resize_top_row1[s5_resize_top_row1_y].className == "s5_module_box_2") {
				if (s5_resize_top_row1[s5_resize_top_row1_y].className == "") {
					s5_resize_top_row1[s5_resize_top_row1_y].className = "s5_resize_top_row1";
				}
				else {	
					var s5_resize_classname = s5_resize_top_row1[s5_resize_top_row1_y].className;
					if (s5_resize_classname.indexOf("s5_resize") < 0) {
						s5_resize_top_row1[s5_resize_top_row1_y].className = "s5_resize_top_row1 " + s5_resize_top_row1[s5_resize_top_row1_y].className;
					}
				}
			}
		}
	}
	
	if (document.getElementById("s5_top_row2")) {
		var s5_resize_top_row2 = document.getElementById("s5_top_row2").querySelectorAll('DIV,ASIDE');
		for (var s5_resize_top_row2_y=0; s5_resize_top_row2_y<s5_resize_top_row2.length; s5_resize_top_row2_y++) {
			if (s5_resize_top_row2[s5_resize_top_row2_y].className.indexOf("s5_resize_top_row2") >= 0) {
				s5_resize_top_row2[s5_resize_top_row2_y].style.minHeight = "1px";
			}
			if (s5_resize_top_row2[s5_resize_top_row2_y].className == "s5_module_box_2") {
				if (s5_resize_top_row2[s5_resize_top_row2_y].className == "") {
					s5_resize_top_row2[s5_resize_top_row2_y].className = "s5_resize_top_row2";
				}
				else {	
					var s5_resize_classname = s5_resize_top_row2[s5_resize_top_row2_y].className;
					if (s5_resize_classname.indexOf("s5_resize") < 0) {
						s5_resize_top_row2[s5_resize_top_row2_y].className = "s5_resize_top_row2 " + s5_resize_top_row2[s5_resize_top_row2_y].className;
					}
				}
			}
		}
	}
	
	if (document.getElementById("s5_top_row3")) {
		var s5_resize_top_row3 = document.getElementById("s5_top_row3").querySelectorAll('DIV,ASIDE');
		for (var s5_resize_top_row3_y=0; s5_resize_top_row3_y<s5_resize_top_row3.length; s5_resize_top_row3_y++) {
			if (s5_resize_top_row3[s5_resize_top_row3_y].className.indexOf("s5_resize_top_row3") >= 0) {
				s5_resize_top_row3[s5_resize_top_row3_y].style.minHeight = "1px";
			}
			if (s5_resize_top_row3[s5_resize_top_row3_y].className == "s5_module_box_2") {
				if (s5_resize_top_row3[s5_resize_top_row3_y].className == "") {
					s5_resize_top_row3[s5_resize_top_row3_y].className = "s5_resize_top_row3";
				}
				else {	
					var s5_resize_classname = s5_resize_top_row3[s5_resize_top_row3_y].className;
					if (s5_resize_classname.indexOf("s5_resize") < 0) {
						s5_resize_top_row3[s5_resize_top_row3_y].className = "s5_resize_top_row3 " + s5_resize_top_row3[s5_resize_top_row3_y].className;
					}
				}
			}
		}
	}
	
	if (document.getElementById("s5_above_columns_inner")) {
		var s5_resize_above_columns_inner = document.getElementById("s5_above_columns_inner").querySelectorAll('DIV,ASIDE');
		for (var s5_resize_above_columns_inner_y=0; s5_resize_above_columns_inner_y<s5_resize_above_columns_inner.length; s5_resize_above_columns_inner_y++) {
			if (s5_resize_above_columns_inner[s5_resize_above_columns_inner_y].className.indexOf("s5_resize_above_columns_inner") >= 0) {
				s5_resize_above_columns_inner[s5_resize_above_columns_inner_y].style.minHeight = "1px";
			}
			if (s5_resize_above_columns_inner[s5_resize_above_columns_inner_y].className == "s5_module_box_2") {
				if (s5_resize_above_columns_inner[s5_resize_above_columns_inner_y].className == "") {
					s5_resize_above_columns_inner[s5_resize_above_columns_inner_y].className = "s5_resize_above_columns_inner";
				}
				else {	
					var s5_resize_classname = s5_resize_above_columns_inner[s5_resize_above_columns_inner_y].className;
					if (s5_resize_classname.indexOf("s5_resize") < 0) {
						s5_resize_above_columns_inner[s5_resize_above_columns_inner_y].className = "s5_resize_above_columns_inner " + s5_resize_above_columns_inner[s5_resize_above_columns_inner_y].className;
					}
				}
			}
		}
	}
	
	if (document.getElementById("s5_middle_top")) {
		var s5_resize_middle_top = document.getElementById("s5_middle_top").querySelectorAll('DIV,ASIDE');
		for (var s5_resize_middle_top_y=0; s5_resize_middle_top_y<s5_resize_middle_top.length; s5_resize_middle_top_y++) {
			if (s5_resize_middle_top[s5_resize_middle_top_y].className.indexOf("s5_resize_middle_top") >= 0) {
				s5_resize_middle_top[s5_resize_middle_top_y].style.minHeight = "1px";
			}
			if (s5_resize_middle_top[s5_resize_middle_top_y].className == "s5_module_box_2") {
				if (s5_resize_middle_top[s5_resize_middle_top_y].className == "") {
					s5_resize_middle_top[s5_resize_middle_top_y].className = "s5_resize_middle_top";
				}
				else {	
					var s5_resize_classname = s5_resize_middle_top[s5_resize_middle_top_y].className;
					if (s5_resize_classname.indexOf("s5_resize") < 0) {
						s5_resize_middle_top[s5_resize_middle_top_y].className = "s5_resize_middle_top " + s5_resize_middle_top[s5_resize_middle_top_y].className;
					}
				}
			}
		}
	}
	
	if (document.getElementById("s5_above_body")) {
		var s5_resize_above_body = document.getElementById("s5_above_body").querySelectorAll('DIV,ASIDE');
		for (var s5_resize_above_body_y=0; s5_resize_above_body_y<s5_resize_above_body.length; s5_resize_above_body_y++) {
			if (s5_resize_above_body[s5_resize_above_body_y].className.indexOf("s5_resize_above_body") >= 0) {
				s5_resize_above_body[s5_resize_above_body_y].style.minHeight = "1px";
			}
			if (s5_resize_above_body[s5_resize_above_body_y].className == "s5_fourdivs_4") {
				if (s5_resize_above_body[s5_resize_above_body_y].className == "") {
					s5_resize_above_body[s5_resize_above_body_y].className = "s5_resize_above_body";
				}
				else {	
					var s5_resize_classname = s5_resize_above_body[s5_resize_above_body_y].className;
					if (s5_resize_classname.indexOf("s5_resize") < 0) {
						s5_resize_above_body[s5_resize_above_body_y].className = "s5_resize_above_body " + s5_resize_above_body[s5_resize_above_body_y].className;
					}
				}
			}
		}
	}
	
	if (document.getElementById("s5_below_body")) {
		var s5_resize_below_body = document.getElementById("s5_below_body").querySelectorAll('DIV,ASIDE');
		for (var s5_resize_below_body_y=0; s5_resize_below_body_y<s5_resize_below_body.length; s5_resize_below_body_y++) {
			if (s5_resize_below_body[s5_resize_below_body_y].className.indexOf("s5_resize_below_body") >= 0) {
				s5_resize_below_body[s5_resize_below_body_y].style.minHeight = "1px";
			}
			if (s5_resize_below_body[s5_resize_below_body_y].className == "s5_fourdivs_4") {
				if (s5_resize_below_body[s5_resize_below_body_y].className == "") {
					s5_resize_below_body[s5_resize_below_body_y].className = "s5_resize_below_body";
				}
				else {	
					var s5_resize_classname = s5_resize_below_body[s5_resize_below_body_y].className;
					if (s5_resize_classname.indexOf("s5_resize") < 0) {
						s5_resize_below_body[s5_resize_below_body_y].className = "s5_resize_below_body " + s5_resize_below_body[s5_resize_below_body_y].className;
					}
				}
			}
		}
	}
	
	if (document.getElementById("s5_middle_bottom")) {
		var s5_resize_middle_bottom = document.getElementById("s5_middle_bottom").querySelectorAll('DIV,ASIDE');
		for (var s5_resize_middle_bottom_y=0; s5_resize_middle_bottom_y<s5_resize_middle_bottom.length; s5_resize_middle_bottom_y++) {
			if (s5_resize_middle_bottom[s5_resize_middle_bottom_y].className.indexOf("s5_resize_middle_bottom") >= 0) {
				s5_resize_middle_bottom[s5_resize_middle_bottom_y].style.minHeight = "1px";
			}
			if (s5_resize_middle_bottom[s5_resize_middle_bottom_y].className == "s5_module_box_2") {
				if (s5_resize_middle_bottom[s5_resize_middle_bottom_y].className == "") {
					s5_resize_middle_bottom[s5_resize_middle_bottom_y].className = "s5_resize_middle_bottom";
				}
				else {	
					var s5_resize_classname = s5_resize_middle_bottom[s5_resize_middle_bottom_y].className;
					if (s5_resize_classname.indexOf("s5_resize") < 0) {
						s5_resize_middle_bottom[s5_resize_middle_bottom_y].className = "s5_resize_middle_bottom " + s5_resize_middle_bottom[s5_resize_middle_bottom_y].className;
					}
				}
			}
		}
	}
	
	if (document.getElementById("s5_below_columns_inner")) {
		var s5_resize_below_columns_inner = document.getElementById("s5_below_columns_inner").querySelectorAll('DIV,ASIDE');
		for (var s5_resize_below_columns_inner_y=0; s5_resize_below_columns_inner_y<s5_resize_below_columns_inner.length; s5_resize_below_columns_inner_y++) {
			if (s5_resize_below_columns_inner[s5_resize_below_columns_inner_y].className.indexOf("s5_resize_below_columns_inner") >= 0) {
				s5_resize_below_columns_inner[s5_resize_below_columns_inner_y].style.minHeight = "1px";
			}
			if (s5_resize_below_columns_inner[s5_resize_below_columns_inner_y].className == "s5_module_box_2") {
				if (s5_resize_below_columns_inner[s5_resize_below_columns_inner_y].className == "") {
					s5_resize_below_columns_inner[s5_resize_below_columns_inner_y].className = "s5_resize_below_columns_inner";
				}
				else {	
					var s5_resize_classname = s5_resize_below_columns_inner[s5_resize_below_columns_inner_y].className;
					if (s5_resize_classname.indexOf("s5_resize") < 0) {
						s5_resize_below_columns_inner[s5_resize_below_columns_inner_y].className = "s5_resize_below_columns_inner " + s5_resize_below_columns_inner[s5_resize_below_columns_inner_y].className;
					}
				}
			}
		}
	}
	
	if (document.getElementById("s5_bottom_row1")) {
		var s5_resize_bottom_row1 = document.getElementById("s5_bottom_row1").querySelectorAll('DIV,ASIDE');
		for (var s5_resize_bottom_row1_y=0; s5_resize_bottom_row1_y<s5_resize_bottom_row1.length; s5_resize_bottom_row1_y++) {
			if (s5_resize_bottom_row1[s5_resize_bottom_row1_y].className.indexOf("s5_resize_bottom_row1") >= 0) {
				s5_resize_bottom_row1[s5_resize_bottom_row1_y].style.minHeight = "1px";
			}
			if (s5_resize_bottom_row1[s5_resize_bottom_row1_y].className == "s5_module_box_2") {
				if (s5_resize_bottom_row1[s5_resize_bottom_row1_y].className == "") {
					s5_resize_bottom_row1[s5_resize_bottom_row1_y].className = "s5_resize_bottom_row1";
				}
				else {	
					var s5_resize_classname = s5_resize_bottom_row1[s5_resize_bottom_row1_y].className;
					if (s5_resize_classname.indexOf("s5_resize") < 0) {
						s5_resize_bottom_row1[s5_resize_bottom_row1_y].className = "s5_resize_bottom_row1 " + s5_resize_bottom_row1[s5_resize_bottom_row1_y].className;
					}
				}
			}
		}
	}
	
	if (document.getElementById("s5_bottom_row2")) {
		var s5_resize_bottom_row2 = document.getElementById("s5_bottom_row2").querySelectorAll('DIV,ASIDE');
		for (var s5_resize_bottom_row2_y=0; s5_resize_bottom_row2_y<s5_resize_bottom_row2.length; s5_resize_bottom_row2_y++) {
			if (s5_resize_bottom_row2[s5_resize_bottom_row2_y].className.indexOf("s5_resize_bottom_row2") >= 0) {
				s5_resize_bottom_row2[s5_resize_bottom_row2_y].style.minHeight = "1px";
			}
			if (s5_resize_bottom_row2[s5_resize_bottom_row2_y].className == "s5_module_box_2") {
				if (s5_resize_bottom_row2[s5_resize_bottom_row2_y].className == "") {
					s5_resize_bottom_row2[s5_resize_bottom_row2_y].className = "s5_resize_bottom_row2";
				}
				else {	
					var s5_resize_classname = s5_resize_bottom_row2[s5_resize_bottom_row2_y].className;
					if (s5_resize_classname.indexOf("s5_resize") < 0) {
						s5_resize_bottom_row2[s5_resize_bottom_row2_y].className = "s5_resize_bottom_row2 " + s5_resize_bottom_row2[s5_resize_bottom_row2_y].className;
					}
				}
			}
		}
	}
	
	if (document.getElementById("s5_bottom_row3")) {
		var s5_resize_bottom_row3 = document.getElementById("s5_bottom_row3").querySelectorAll('DIV,ASIDE');
		for (var s5_resize_bottom_row3_y=0; s5_resize_bottom_row3_y<s5_resize_bottom_row3.length; s5_resize_bottom_row3_y++) {
			if (s5_resize_bottom_row3[s5_resize_bottom_row3_y].className.indexOf("s5_resize_bottom_row3") >= 0) {
				s5_resize_bottom_row3[s5_resize_bottom_row3_y].style.minHeight = "1px";
			}
			if (s5_resize_bottom_row3[s5_resize_bottom_row3_y].className == "s5_module_box_2") {
				if (s5_resize_bottom_row3[s5_resize_bottom_row3_y].className == "") {
					s5_resize_bottom_row3[s5_resize_bottom_row3_y].className = "s5_resize_bottom_row3";
				}
				else {	
					var s5_resize_classname = s5_resize_bottom_row3[s5_resize_bottom_row3_y].className;
					if (s5_resize_classname.indexOf("s5_resize") < 0) {
						s5_resize_bottom_row3[s5_resize_bottom_row3_y].className = "s5_resize_bottom_row3 " + s5_resize_bottom_row3[s5_resize_bottom_row3_y].className;
					}
				}
			}
		}
	}

}


if (document.getElementById("s5_columns_wrap") && s5_resize_columns_small_tablets_screen_size == "yes") {

new s5_columns_equalizer('.s5_resize_center_columns').equalize('height');

}

if (s5_resize_columns  == "all") {
	new s5_columns_equalizer('.s5_resize_top_row1').equalize('height');
	new s5_columns_equalizer('.s5_resize_top_row2').equalize('height');
	new s5_columns_equalizer('.s5_resize_top_row3').equalize('height');
	new s5_columns_equalizer('.s5_resize_above_columns_inner').equalize('height');
	new s5_columns_equalizer('.s5_resize_middle_top').equalize('height');
	new s5_columns_equalizer('.s5_resize_above_body').equalize('height');
	new s5_columns_equalizer('.s5_resize_below_body').equalize('height');
	new s5_columns_equalizer('.s5_resize_middle_bottom').equalize('height');
	new s5_columns_equalizer('.s5_resize_below_columns_inner').equalize('height');
	new s5_columns_equalizer('.s5_resize_bottom_row1').equalize('height');
	new s5_columns_equalizer('.s5_resize_bottom_row2').equalize('height');
	new s5_columns_equalizer('.s5_resize_bottom_row3').equalize('height');
}

}

}

jQuery(document).ready( function() {

window.setTimeout(s5_load_resize_columns,s5_resize_columns_delay);

if (s5_resize_columns_browser_check != "ie7" && s5_resize_columns_browser_check != "ie8") {

	window.setTimeout(s5_load_resize_columns,2000);

	window.setTimeout(s5_load_resize_columns,2500);

	window.setTimeout(s5_load_resize_columns,3500);
	
}

});


function s5_screen_width_check() {
	if (s5_screen_width != document.body.offsetWidth) {
		s5_load_resize_columns();
		window.setTimeout(s5_load_resize_columns,2000);
	}
	if (s5_screen_height != document.body.offsetHeight) {
		s5_load_resize_columns();
		window.setTimeout(s5_load_resize_columns,3000);
	}
}
jQuery(window).resize(s5_screen_width_check);
