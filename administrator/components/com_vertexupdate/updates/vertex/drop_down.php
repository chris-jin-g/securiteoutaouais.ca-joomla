<script type="text/javascript">//<![CDATA[
document.write('<style type="text/css">#s5_drop_down_button{color:#<?php echo $s5_drop_down_button_text_color ?>}#s5_drop_down_button:hover{color:#<?php echo $s5_drop_down_button_text_hover_color ?>}</style>');
//]]></script>

<div id="s5_drop_down_container"<?php if ($s5_drop_down_overlay == "overlay") { ?> style="position:absolute;z-index:3"<?php } ?>>

	<div id="s5_drop_down_container_inner" style="border-bottom:solid <?php echo $s5_drop_down_border_size ?>px #<?php echo $s5_drop_down_border_color ?>;">

		<div id="s5_drop_down_wrap">
			
			<div id="s5_drop_down">
			<div id="s5_drop_down_inner"<?php if ($s5_drop_down_width == "body") { ?> class="s5_wrap"<?php } ?>>
			
				<?php if ($s5_pos_drop_down_1 == "published") { ?>
					<div id="s5_pos_drop_down_1" class="s5_float_left" style="width:<?php echo $s5_pos_drop_down_1_width ?>%">
						<?php s5_module_call('drop_down_1','round_box'); ?>
					</div>
				<?php } ?>
				
				<?php if ($s5_pos_drop_down_2 == "published") { ?>
					<div id="s5_pos_drop_down_2" class="s5_float_left" style="width:<?php echo $s5_pos_drop_down_2_width ?>%">
						<?php s5_module_call('drop_down_2','round_box'); ?>
					</div>
				<?php } ?>
				
				<?php if ($s5_pos_drop_down_3 == "published") { ?>
					<div id="s5_pos_drop_down_3" class="s5_float_left" style="width:<?php echo $s5_pos_drop_down_3_width ?>%">
						<?php s5_module_call('drop_down_3','round_box'); ?>
					</div>
				<?php } ?>
				
				<?php if ($s5_pos_drop_down_4 == "published") { ?>
					<div id="s5_pos_drop_down_4" class="s5_float_left" style="width:<?php echo $s5_pos_drop_down_4_width ?>%">
						<?php s5_module_call('drop_down_4','round_box'); ?>
					</div>
				<?php } ?>
				
				<?php if ($s5_pos_drop_down_5 == "published") { ?>
					<div id="s5_pos_drop_down_5" class="s5_float_left" style="width:<?php echo $s5_pos_drop_down_5_width ?>%">
						<?php s5_module_call('drop_down_5','round_box'); ?>
					</div>
				<?php } ?>
				
				<?php if ($s5_pos_drop_down_6 == "published") { ?>
					<div id="s5_pos_drop_down_6" class="s5_float_left" style="width:<?php echo $s5_pos_drop_down_6_width ?>%">
						<?php s5_module_call('drop_down_6','round_box'); ?>
					</div>
				<?php } ?>						
				<div style="clear:both; height:0px"></div>

			</div>
			</div>
		
		</div>
	
	</div>
	
	<div id="s5_drop_down_button_container" style="text-align:center;display:block;">
	
	<div id="s5_drop_down_background" style="padding-left:<?php echo $s5_drop_down_shadow_size ?>px;padding-right:<?php echo $s5_drop_down_shadow_size ?>px;height:4000px;margin-top:-4000px;background: #<?php echo $s5_drop_down_background ?>;opacity: <?php echo $s5_drop_down_background_opacity ?>;filter: alpha(opacity=<?php echo $s5_drop_down_background_opacity * 100 ?>)">
	
	<div id="s5_drop_down_shadow" style="height:4000px;<?php if ($s5_drop_down_shadow == "show") { ?>-webkit-box-shadow: 0px 2px <?php echo $s5_drop_down_shadow_size ?>px rgba(0, 0, 0, <?php echo $s5_drop_down_shadow_opacity ?>);-moz-box-shadow: 0px 2px <?php echo $s5_drop_down_shadow_size ?>px rgba(0, 0, 0, <?php echo $s5_drop_down_shadow_opacity ?>);box-shadow: 0px 2px <?php echo $s5_drop_down_shadow_size ?>px rgba(0, 0, 0, <?php echo $s5_drop_down_shadow_opacity ?>);<?php } ?>"></div>
	
	</div>

		<div id="s5_drop_down_button" style="display:block;<?php if ($s5_drop_down_button_position == "center" || $s5_drop_down_button_position == "right") { ?>margin-left:auto;<?php } ?><?php if ($s5_drop_down_button_position == "center" || $s5_drop_down_button_position == "left") { ?>margin-right:auto;<?php } ?><?php if ($s5_drop_down_button_position == "left") { ?>margin-left:20px;<?php } ?><?php if ($s5_drop_down_button_position == "right") { ?>margin-right:20px;<?php } ?>width:<?php echo $s5_drop_down_button_width ?>px;height:<?php echo $s5_drop_down_button_height + 6 ?>px;background: #<?php echo $s5_drop_down_button_gradient_start ?>;background: -moz-linear-gradient(top, #<?php echo $s5_drop_down_button_gradient_start ?> 0%, #<?php echo $s5_drop_down_button_gradient_stop ?> 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $s5_drop_down_button_gradient_start ?>), color-stop(100%,#<?php echo $s5_drop_down_button_gradient_stop ?>));background: -webkit-linear-gradient(top, #<?php echo $s5_drop_down_button_gradient_start ?> 0%,#<?php echo $s5_drop_down_button_gradient_stop ?> 100%);background: -o-linear-gradient(top, #<?php echo $s5_drop_down_button_gradient_start ?> 0%,#<?php echo $s5_drop_down_button_gradient_stop ?> 100%);background: -ms-linear-gradient(top, #<?php echo $s5_drop_down_button_gradient_start ?> 0%,#<?php echo $s5_drop_down_button_gradient_stop ?> 100%);background: linear-gradient(top, #<?php echo $s5_drop_down_button_gradient_start ?> 0%,#<?php echo $s5_drop_down_button_gradient_stop ?> 100%);filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#<?php echo $s5_drop_down_button_gradient_start ?>', EndColorStr='#<?php echo $s5_drop_down_button_gradient_stop ?>');border:solid <?php echo $s5_drop_down_button_border_size ?>px #<?php echo $s5_drop_down_button_border_color ?>;border-top:none;-moz-border-radius:0px 0px <?php echo $s5_drop_down_button_radius_size ?>px <?php echo $s5_drop_down_button_radius_size ?>px;-webkit-border-radius:0px 0px <?php echo $s5_drop_down_button_radius_size ?>px <?php echo $s5_drop_down_button_radius_size ?>px;<?php if ($browser != "ie9") { ?>border-radius:0px 0px <?php echo $s5_drop_down_button_radius_size ?>px <?php echo $s5_drop_down_button_radius_size ?>px;<?php } ?>margin-top:-<?php echo $s5_drop_down_button_border_size + 6 ?>px;font-weight:<?php echo $s5_drop_down_button_text_weight ?>;font-size:<?php echo $s5_drop_down_button_text_size ?>pt;<?php if ($s5_drop_down_button_shadow == "show") { ?>-webkit-box-shadow: 0px 2px <?php echo $s5_drop_down_button_shadow_size ?>px rgba(0, 0, 0, <?php echo $s5_drop_down_button_shadow_opacity ?>);-moz-box-shadow: 0px 2px <?php echo $s5_drop_down_button_shadow_size ?>px rgba(0, 0, 0, <?php echo $s5_drop_down_button_shadow_opacity ?>);box-shadow: 0px 2px <?php echo $s5_drop_down_button_shadow_size ?>px rgba(0, 0, 0, <?php echo $s5_drop_down_button_shadow_opacity ?>);<?php } ?>">
			<span id="s5_drop_down_text" style="display:table-cell;vertical-align:middle;width:<?php echo $s5_drop_down_button_width ?>px;height:<?php echo $s5_drop_down_button_height + 6 ?>px;padding-top:6px">
				<?php if ($browser == "ie7") { ?>
					<div style="height:<?php echo $s5_drop_down_button_height / 2 ?>px"></div>
				<?php } ?>
				
				<span id="s5_drop_down_text_inner">
					<?php echo $s5_drop_down_button_open_text ?>
				</span>
				
				<?php if ($browser == "ie8" || $browser == "ie9") { ?>
					<div style="height:4px"></div>
				<?php } ?>
			</span>
		</div>

	</div>
	
	<div style="display:block;clear:both;height:0px"></div>

</div>

	<script type="text/javascript">
		
		function s5_SmoothScroll(obj){
		this.status='close';
		this.obj=obj;
		}
		s5_SmoothScroll.prototype.toggle=function(){
		obj=jQuery(this.obj);
		if(this.status=='close'){
		obj.animate({'marginTop':0},{duration:'slow',easing:'easeOutExpo',queue:false,'complete':function(){s5_drop_down_change_text();}});
		obj.parent().animate({'height':obj.outerHeight()},{duration:'slow',easing:'easeOutExpo',queue:false});
		this.status='open';
		}
		else{
		obj.animate({'marginTop':-obj.outerHeight()},{duration:'slow',easing:'easeOutExpo',queue:false,'complete':function(){s5_drop_down_change_text();}});
		obj.parent().animate({'height':0},{duration:'slow',easing:'easeOutExpo',queue:false});
		this.status='close';
		}
		}
		s5_SmoothScroll.prototype.hide=function(){
		jQuery(this.obj).css('marginTop',-jQuery(this.obj).outerHeight());
		};

		var s5_drop_down_click = "closed";
	
		function s5_drop_down_change_text() {
			if (s5_drop_down_click == "closed") {
				document.getElementById("s5_drop_down_text_inner").innerHTML = "<?php echo $s5_drop_down_button_close_text ?>";
				s5_drop_down_click = "open";
			}
			else if (s5_drop_down_click == "open") {
				document.getElementById("s5_drop_down_text_inner").innerHTML = "<?php echo $s5_drop_down_button_open_text ?>";
				s5_drop_down_click = "closed";
			}
		}
		
		var s5_ie_drop_down_var1 = 0;
		var s5_ie_drop_down_var2 = 0;
		
        <?php if ($browser == "ie9") { ?>
        function s5_load_drop_down() {
		<?php } ?>
		<?php if ($browser != "ie9") { ?>
        jQuery(document).ready(function() {
		<?php } ?>
		
		<?php if ($browser == "ie9") { ?>
		s5_ie_drop_down_var1 = 17;
		s5_ie_drop_down_var2 = 23;
		<?php } ?>
		
		<?php if ($browser == "ie8") { ?>
		s5_ie_drop_down_var1 = 21;
		s5_ie_drop_down_var2 = 25;
		<?php } ?>
		
		<?php if ($browser == "ie7") { ?>
		s5_ie_drop_down_var1 = 0;
		s5_ie_drop_down_var2 = 4;
		<?php } ?>
		
		<?php if ($browser != "ie7" && $browser != "ie8" && $browser != "ie9") { ?>
		s5_ie_drop_down_var2 = 4;
		<?php } ?>

	(function($){	
		s5_ie_drop_down_var2 = 4;
				
		document.getElementById("s5_drop_down_container").style.display = "block";
		document.getElementById("s5_drop_down_container").style.width = document.documentElement.offsetWidth - s5_ie_drop_down_var1 + "px";
		document.getElementById("s5_drop_down_background").style.width = document.documentElement.offsetWidth - s5_ie_drop_down_var2 + "px";
		document.getElementById("s5_drop_down_container_inner").style.height = document.getElementById("s5_drop_down_wrap").offsetHeight + "px";
		
		$('#s5_drop_down_container_inner').wrap('<div id="s5_drop_down_inner" style="margin: 0px; position: relative; overflow: hidden; height: 0px;"></div>');

		var scroll = new s5_SmoothScroll('#s5_drop_down_container_inner');
		scroll.hide();
		$('#s5_drop_down_button').bind('click', function(e){
			e .preventDefault();
			scroll.toggle();
		});
	
	})(jQuery);

		}<?php if ($browser != "ie9") { ?>);<?php } ?>
		
		<?php if ($browser == "ie9") { ?>
		window.setTimeout(s5_load_drop_down,1000);
		<?php } ?>
		
		function s5_drop_down_resize() {
			document.getElementById("s5_drop_down_container").style.width = "auto";
			document.getElementById("s5_drop_down_background").style.width = "auto";
			document.getElementById("s5_drop_down_container_inner").style.height = "auto";
			if (s5_drop_down_click == "open") {
			document.getElementById("s5_drop_down_inner").style.height = "auto";
			}
			document.getElementById("s5_drop_down_container").style.width = document.documentElement.offsetWidth - s5_ie_drop_down_var1 + "px";
			document.getElementById("s5_drop_down_background").style.width = document.documentElement.offsetWidth - s5_ie_drop_down_var2 + "px";
			document.getElementById("s5_drop_down_container_inner").style.height = document.getElementById("s5_drop_down_wrap").offsetHeight + "px";
		}
		
		jQuery(window).bind('resize',function(){s5_drop_down_resize();});

	</script>
