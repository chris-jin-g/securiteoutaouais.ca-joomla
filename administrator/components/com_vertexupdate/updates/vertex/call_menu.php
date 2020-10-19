<?php
	//S5 Flex menu start
	$app =  JFactory::getApplication();
	$templateparams  = $app->getTemplate(true)->params;
	jimport('joomla.filesystem.file');	
	
	$document = JFactory::getDocument();
	
	$duration = ($s5_duration == '' ? '500' : $s5_duration);
	$hideDelay = ($s5_hide_delay == '' ? '500' : $s5_hide_delay);
    $opacity = ($s5_opacity == '' ? '100' : $s5_opacity);
    $orientation = ($s5_orientation == '' ? 'horizontal' : $s5_orientation);
	$effect = ($s5_effect == '' ? '2' : $s5_effect);
	
	if ($s5_menu_onclick == "enabled" && $s5_responsive == "enabled") {
	$tabletWidth=1400;
	}
	else {
	$tabletWidth=0;
	}
	
	if($effect == 0){
		$effect = "slide";
	}else if ($effect == 1){
		$effect = "fade";
	}else if ($effect == 2){
		$effect = "slide & fade";
	}else if ($effect == 3){
		$duration = "0";
		$effect = "fade";
	}
	
?>
	<script type="text/javascript">
	//<![CDATA[
		<?php if ($browser == "ie9") { ?>
        function s5_load_flex_menu() {
		<?php } ?>
		<?php if ($browser != "ie9") { ?>
        jQuery(document).ready( function() {
		<?php } ?>
            var myMenu = new MenuMatic({
				tabletWidth:<?php echo $tabletWidth;?>,
                effect:"<?php echo $effect; ?>",
                duration:<?php echo $duration*0.5; ?>,
                physics: 'linear',
                hideDelay:<?php echo $hideDelay*0.5; ?>,
                orientation:"<?php echo $orientation; ?>",
                tweakInitial:{x:0, y:0},
				<?php if($s5_full_width_flex_menu == "yes") { ?>
				fullWidth: function(){
					if(window.innerWidth<<?php echo $s5_full_width_flex_menu_res; ?>) return "auto";
						return document.getElementById("<?php echo $s5_full_width_flex_menu_div_id; ?>").offsetWidth+"px";
				},
				<?php } ?>
                 <?php if($s5_language_direction == "1") { ?>
	                direction:{    x: 'left',    y: 'down' },
				<?php } ?>
                <?php if($s5_language_direction != "1") { ?>
    	            direction:{    x: 'right',    y: 'down' },
				<?php } ?>
                opacity:<?php echo $opacity; ?>
            });
        }<?php if ($browser != "ie9") { ?>);<?php } ?>
		
		<?php if ($browser == "ie9") { ?>
		window.setTimeout(s5_load_flex_menu,1000);
		<?php } ?>
	//]]>	
    </script>    
<?php //S5 Flex menu end ?>
