<div id="s5_responsive_mobile_sidebar_inner1" class="s5_responsive_mobile_sidebar_<?php echo $s5_responsive_mobile_bar_style; ?>">
<div id="s5_responsive_mobile_sidebar_inner2">

	<?php if ($s5_responsive_mobile_bar_search == "enabled") { ?>
	<div id="s5_responsive_mobile_sidebar_search_wrap">
	<div id="s5_responsive_mobile_sidebar_search_wrap_inner1">
	<div id="s5_responsive_mobile_sidebar_search_wrap_inner2">
	<?php $lang = JFactory::getLanguage()->load('mod_search');?>
	<form method="post" action="<?php echo JURI::Base()?>">
		<input type="text" onfocus="if (this.value=='<?php echo JText::_("MOD_SEARCH");?>...') this.value='';" onblur="if (this.value=='') this.value='<?php echo JText::_("MOD_SEARCH");?>...';" value="<?php echo JText::_("MOD_SEARCH");?>..." id="s5_responsive_mobile_search" name="searchword" />
		<input type="hidden" value="search" name="task" />
		<input type="hidden" value="com_search" name="option" />
		<input type="hidden" value="1" name="Itemid" />
	</form>
	</div>
	</div>
	</div>
	<div style="clear:both"></div>
	<?php } ?>

	<?php if ($s5_pos_sidebar_top == "published") { ?>
		<div id="s5_pos_sidebar_top">
			<?php s5_module_call('sidebar_top','round_box'); ?>
		</div>
	<?php } ?>

	<?php if ($s5_responsive_force_off_login == "on" || $s5_responsive_force_off_register == "on") { ?>
	<?php if (($s5_login  != "") || ($s5_register  != "")) { ?>
	<div id="s5_responsive_mobile_sidebar_login_register_wrap">

		<?php if ($s5_login  != "" && $s5_responsive_force_off_login == "on") { ?>
		<div id="s5_responsive_mobile_sidebar_login_wrap" class="s5_responsive_mobile_sidebar_inactive"<?php if ($s5_login_url == "") { ?> style="display:none"<?php } ?>>
			<div class="s5_responsive_mobile_sidebar_title_wrap" id="s5_responsive_mobile_sidebar_title_wrap_login" <?php if ($s5_login_url == "") { ?>onclick="s5_responsive_mobile_sidebar_login()"<?php } ?><?php if ($s5_login_url != "") { ?>onclick="window.document.location.href='<?php echo $s5_login_url ?>'"<?php } ?>>
			<div class="s5_responsive_mobile_sidebar_title_wrap_inner">
				<span class="s5_responsive_mobile_sidebar_title_wrap_inner">
				<?php if ($s5_user_id) { echo $s5_loginout; } else { echo $s5_login; } ?>
				</span>
			</div>
			</div>
			<div id="s5_responsive_mobile_sidebar_login_bottom" class="s5_responsive_mobile_sidebar_login_inactive">
			</div>
		<div style="clear:both"></div>
		</div>
		<?php } ?>

		<?php if ($s5_user_id) { } else {?>
		<?php if ($s5_register  != "" && $s5_responsive_force_off_register == "on") { ?>
		<div id="s5_responsive_mobile_sidebar_register_wrap" class="s5_responsive_mobile_sidebar_inactive"<?php if ($s5_register_url == "") { ?> style="display:none"<?php } ?>>
			<div class="s5_responsive_mobile_sidebar_title_wrap" id="s5_responsive_mobile_sidebar_title_wrap_register" <?php if ($s5_register_url == "") { ?>onclick="s5_responsive_mobile_sidebar_register()"<?php } ?><?php if ($s5_register_url != "") { ?>onclick="window.document.location.href='<?php echo $s5_register_url ?>'"<?php } ?>>
			<div class="s5_responsive_mobile_sidebar_title_wrap_inner">
				<span class="s5_responsive_mobile_sidebar_title_wrap_inner">
				<?php echo $s5_register; ?>
				</span>
			</div>
			</div>
			<div id="s5_responsive_mobile_sidebar_register_bottom" class="s5_responsive_mobile_sidebar_register_inactive">
			</div>
		<div style="clear:both"></div>
		</div>
		<?php } ?>
		<?php } ?>

	<div style="clear:both"></div>
	</div>
	<?php } ?>
	<?php } ?>

	<?php if ($s5_responsive_mobile_bar_menu == "enabled") { ?>
		<div id="s5_responsive_mobile_sidebar_menu_wrap">
			<?php include("responsive_mobile_menu.php"); ?>
		</div>
	<?php } ?>

	<?php if ($s5_pos_sidebar_bottom == "published") { ?>
		<div id="s5_pos_sidebar_bottom">
			<?php s5_module_call('sidebar_bottom','round_box'); ?>
		</div>
	<?php } ?>

</div>
</div>
