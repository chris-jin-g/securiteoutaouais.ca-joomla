<?php 



if ($s5_responsive_mobile_layout == "dropdowns" || $s5_responsive_mobile_layout == "") {



	//Disable the drop down icons if there is no module present

	if (s5_check_module("register")) {

	$s5_responsive_mobile_bar_register = "enabled";

	} else {

	$s5_responsive_mobile_bar_register = "disabled";

	}

	if (s5_check_module("login")) {

	$s5_responsive_mobile_bar_login = "enabled";

	} else {

	$s5_responsive_mobile_bar_login = "disabled";

	}

	//Enable the drop down icons if there is a custom url entered

	if ($s5_login_url != "") {

	$s5_responsive_mobile_bar_login = "enabled";

	}

	if ($s5_register_url != "") {

	$s5_responsive_mobile_bar_register = "enabled";

	}

	//Check to see if the s5 box module is published. If it's present then login and register should not be called in the drop downs.

	$s5_check_s5_box_published = "no";

	$s5_check_s5_box = JModuleHelper::getModule('mod_s5_box');

	$s5_check_s5_box_name = $s5_check_s5_box->title;

	if ($s5_check_s5_box_name != "") {

	$s5_check_s5_box_published = "yes";

	}

	//Disable register if the user is logged in

	$user = JFactory::getUser(); 

	$user_id = $user->get('id'); 

	if ($user_id){

	$s5_responsive_mobile_bar_register = "disabled";

	}

	//Disable login and register if the user turns them off for just mobile

	if ($s5_responsive_force_off_login == "off") {

	$s5_responsive_mobile_bar_login = "disabled";

	}

	if ($s5_responsive_force_off_register == "off") {

	$s5_responsive_mobile_bar_register = "disabled";

	}

	?>



	<!-- s5_responsive_mobile_top_bar_spacer must be called to keep a space at the top of the page since s5_responsive_mobile_top_bar_wrap is position absolute. -->	

	<div id="s5_responsive_mobile_top_bar_spacer"></div>



	<!-- s5_responsive_mobile_top_bar_wrap must be called off the page and not with display:none or it will cause issues with the togglers. -->

	<div id="s5_responsive_mobile_top_bar_wrap" style="margin-top:-50000px;position:absolute;z-index:20;top:0px">



		<div id="s5_responsive_mobile_top_bar" class="s5_responsive_mobile_bar_<?php echo $s5_responsive_mobile_bar_style; ?>">



				<div id="s5_responsive_mobile_toggle_click_menu" style="<?php if ($s5_responsive_mobile_bar_menu == "enabled") { ?>display:block;<?php } else { ?>display:none;<?php } ?>">

					<span></span>

				</div>

				

				<?php if ($s5_responsive_mobile_bar_active == "enabled") { ?>

					<div id="s5_responsive_mobile_bar_active">

						<span>
							<?php $menu = JFactory::getApplication()->getMenu()->getActive() ?>
							<?php echo $menu ? $menu->title : '' ?>

						</span>

					</div>

				<?php } ?>

				

				<div id="s5_responsive_mobile_toggle_click_login" style="<?php if ($s5_responsive_mobile_bar_login == "enabled") { ?>display:block;<?php } else { ?>display:none;<?php } ?>float:right">

					<span></span>

				</div>

				

				<div id="s5_responsive_mobile_toggle_click_register" style="<?php if ($s5_responsive_mobile_bar_register == "enabled") { ?>display:block;<?php } else { ?>display:none;<?php } ?>float:right">

					<span></span>

				</div>

				

				<div id="s5_responsive_mobile_toggle_click_search" style="<?php if ($s5_responsive_mobile_bar_search == "enabled") { ?>display:block;<?php } else { ?>display:none;<?php } ?>float:right">

					<span></span>

				</div>



			<div style="clear:both;height:0px"></div>

			

		</div>



		<div id="s5_responsive_mobile_drop_down_wrap" class="s5_responsive_mobile_drop_down_wrap_loading">

			<div id="s5_responsive_mobile_drop_down_menu">

				<div class="s5_responsive_mobile_drop_down_inner" style="-webkit-box-shadow: 0px 0px 16px rgba(0, 0, 0, <?php echo $s5_responsive_mobile_bar_shadow_opacity ?>);-moz-box-shadow: 0px 0px 16px rgba(0, 0, 0, <?php echo $s5_responsive_mobile_bar_shadow_opacity ?>);box-shadow: 0px 0px 16px rgba(0, 0, 0, <?php echo $s5_responsive_mobile_bar_shadow_opacity ?>);">

					<?php if ($s5_responsive_mobile_bar_menu == "enabled") { ?>

						<?php include("responsive_mobile_menu.php"); ?>

					<?php } ?>

				</div>

			</div>

			

			<div id="s5_responsive_mobile_drop_down_search">

				<div class="s5_responsive_mobile_drop_down_inner" style="-webkit-box-shadow: 0px 0px 16px rgba(0, 0, 0, <?php echo $s5_responsive_mobile_bar_shadow_opacity ?>);-moz-box-shadow: 0px 0px 16px rgba(0, 0, 0, <?php echo $s5_responsive_mobile_bar_shadow_opacity ?>);box-shadow: 0px 0px 16px rgba(0, 0, 0, <?php echo $s5_responsive_mobile_bar_shadow_opacity ?>);">

					<?php if ($s5_responsive_mobile_bar_search == "enabled") { ?>

					  <?php $lang = JFactory::getLanguage()->load('mod_search');?>

						<form method="post" action="<?php echo JURI::Base()?>">

							<input type="text" onfocus="if (this.value=='<?php echo JText::_("MOD_SEARCH");?>...') this.value='';" onblur="if (this.value=='') this.value='<?php echo JText::_("MOD_SEARCH");?>...';" value="<?php echo JText::_("MOD_SEARCH");?>..." id="s5_responsive_mobile_search" name="searchword" />

							<input type="hidden" value="search" name="task" />

							<input type="hidden" value="com_search" name="option" />

							<input type="hidden" value="1" name="Itemid" />

						</form>

					<?php } ?>

				</div>

			</div>

			

			<div id="s5_responsive_mobile_drop_down_login">

				<div class="s5_responsive_mobile_drop_down_inner" id="s5_responsive_mobile_drop_down_login_inner" style="-webkit-box-shadow: 0px 0px 16px rgba(0, 0, 0, <?php echo $s5_responsive_mobile_bar_shadow_opacity ?>);-moz-box-shadow: 0px 0px 16px rgba(0, 0, 0, <?php echo $s5_responsive_mobile_bar_shadow_opacity ?>);box-shadow: 0px 0px 16px rgba(0, 0, 0, <?php echo $s5_responsive_mobile_bar_shadow_opacity ?>);">

				</div>

			</div>

			

			<?php 

			if ($s5_check_s5_box_published == "no") {

				if (s5_check_module('login')) { ?>

					<div id="s5_responsive_mobile_login_wrap" style="display:none">

					<?php s5_module_call('login','round_box'); ?>

					</div>

				<?php }

			}

			?>

		

			<div id="s5_responsive_mobile_drop_down_register">

				<div class="s5_responsive_mobile_drop_down_inner" id="s5_responsive_mobile_drop_down_register_inner" style="-webkit-box-shadow: 0px 0px 16px rgba(0, 0, 0, <?php echo $s5_responsive_mobile_bar_shadow_opacity ?>);-moz-box-shadow: 0px 0px 16px rgba(0, 0, 0, <?php echo $s5_responsive_mobile_bar_shadow_opacity ?>);box-shadow: 0px 0px 16px rgba(0, 0, 0, <?php echo $s5_responsive_mobile_bar_shadow_opacity ?>);">

				</div>

			</div>

			

			<?php 

			if ($s5_check_s5_box_published == "no") {

				if (s5_check_module('register')) { ?>

					<div id="s5_responsive_mobile_register_wrap" style="display:none">

					<?php s5_module_call('register','round_box'); ?>

					</div>

				<?php }

			}

			?>

				

		</div>



	</div>



	<script type="text/javascript">

		var s5_responsive_trigger = <?php echo $s5_responsive_mobile_bar_trigger; ?>;

		var s5_responsive_login_url = "<?php echo $s5_login_url; ?>";

		var s5_responsive_register_url = "<?php echo $s5_register_url; ?>";

		var s5_responsive_layout = "dropdowns";

	</script>

	<script type="text/javascript" src="<?php echo $s5_directory_path ?>/js/core/s5_responsive_mobile_bar-min.js"></script>

	

<?php } else if ($s5_responsive_mobile_layout == "sidebar") { ?>



	<?php if ($s5_responsive_menu_button != "override") { ?>

		<!-- s5_responsive_mobile_top_bar_spacer must be called to keep a space at the top of the page since s5_responsive_mobile_top_bar_wrap is position absolute. -->	

		<div id="s5_responsive_mobile_top_bar_spacer"></div>



		<!-- s5_responsive_mobile_top_bar_wrap must be called off the page and not with display:none or it will cause issues with the togglers. -->

		<div id="s5_responsive_mobile_top_bar_wrap" style="margin-top:-50000px;position:absolute;z-index:20;top:0px">



			<div id="s5_responsive_mobile_top_bar" onclick="s5_responsive_mobile_sidebar()" class="s5_responsive_mobile_bar_<?php echo $s5_responsive_mobile_bar_style; ?>">



					<div id="s5_responsive_mobile_toggle_click_menu">

						<span></span>

					</div>

					

					<?php if ($s5_responsive_mobile_bar_active == "enabled") { ?>

						<div id="s5_responsive_mobile_bar_active">

							<span>

								<?php echo JFactory::getApplication()->getMenu()->getActive()->title; ?>

							</span>

						</div>

					<?php } ?>



				<div style="clear:both;height:0px"></div>

				

			</div>



		</div>

	<?php } ?>



	<script type="text/javascript">

		var s5_responsive_trigger = <?php echo $s5_responsive_mobile_bar_trigger; ?>;

		var s5_responsive_layout = "sidebar";

		var s5_responsive_layout_direction = "_<?php if($s5_language_direction == '1') { echo 'rtl'; } else { echo 'ltr'; } ?>";

		var s5_responsive_menu_auto_open = "<?php echo $s5_responsive_mobile_sidebar_menu_auto_open; ?>";

	</script>

	<script type="text/javascript" src="<?php echo $s5_directory_path ?>/js/core/s5_responsive_mobile_bar-min.js"></script>



<?php } ?>

