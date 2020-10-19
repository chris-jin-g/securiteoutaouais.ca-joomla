<?php if ($browser != "ie7" && $browser != "ie8") { ?>
	<script type="text/javascript">//<![CDATA[
	document.write('<style type="text/css">.s5_lr_tab_inner{-webkit-transform: rotate(270deg);-moz-transform: rotate(270deg);-o-transform: rotate(270deg);-ms-transform: rotate(270deg);}</style>');
	//]]></script>
<?php } ?>

<?php if($s5_lr_tab1_text != "") { ?>
	<div class="<?php echo $s5_lr_tab1_class;?> s5_lr_tab" <?php if($s5_lr_tab1_click != "") { ?>onclick="window.document.location.href='<?php echo $s5_lr_tab1_click; ?>'"<?php } ?> style="color:#<?php echo $s5_lr_tab_font; ?>;background-color:#<?php echo $s5_lr_tab_color; ?>;border:1px solid #<?php echo $s5_lr_tab_border; ?>;<?php if($s5_lr_tab1_left_right == "left") { ?>left:-2px;<?php } ?><?php if($s5_lr_tab1_left_right == "right") { ?>right:-2px;<?php } ?>top:<?php echo $s5_lr_tab1_vp;?>%;height:<?php echo $s5_lr_tab1_height ?>px" id="s5_lr_tab1">
		<div class="s5_lr_tab_inner" id="s5_lr_tab_inner1" <?php if ($browser != "ie7" && $browser != "ie8" && $browser != "ie9") { ?>style="margin-top: <?php echo ($s5_lr_tab1_height) - 30?>px;"<?php } ?>>
			<?php echo $s5_lr_tab1_text; ?>
		</div>
	</div>
<?php } ?>

<?php if($s5_lr_tab2_text != "") { ?>
	<div class="<?php echo $s5_lr_tab2_class;?> s5_lr_tab" <?php if($s5_lr_tab2_click != "") { ?>onclick="window.document.location.href='<?php echo $s5_lr_tab2_click; ?>'"<?php } ?> style="color:#<?php echo $s5_lr_tab_font; ?>;background-color:#<?php echo $s5_lr_tab_color; ?>;border:1px solid #<?php echo $s5_lr_tab_border; ?>;<?php if($s5_lr_tab2_left_right == "left") { ?>left:-2px;<?php } ?><?php if($s5_lr_tab2_left_right == "right") { ?>right:-2px;<?php } ?>top:<?php echo $s5_lr_tab2_vp;?>%;height:<?php echo $s5_lr_tab2_height ?>px" id="s5_lr_tab2">
		<div class="s5_lr_tab_inner" id="s5_lr_tab_inner2" <?php if ($browser != "ie7" && $browser != "ie8") { ?>style="margin-top: <?php echo ($s5_lr_tab1_height) - 30?>px;"<?php } ?>>
			<?php echo $s5_lr_tab2_text; ?>
		</div>
	</div>
<?php } ?>