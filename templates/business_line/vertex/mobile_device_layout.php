<?php 

// PLEASE NOTE THAT THIS IS A LEGACY FILE THAT IS ONLY USED FOR TEMPLATES BUILT OFF OF VERTEX 1

$user = JFactory::getUser(); 
$user_id = $user->get('id'); ?>

<div id="s5_md_outer_wrap">
<div id="s5_main_body_wrap">

<div id="s5_md_padding_wrap">

	<div id="s5_md_header_wrap">
	<div id="s5_md_header_wrap_inner">
	
		<div id="s5_md_logo_wrap">
		<div id="s5_md_logo_wrap_inner">
		
			<?php if($s5_pos_logo == "published") { ?>
				<div id="s5_logo_module" onclick="window.document.location.href='<?php echo $LiveSiteUrl ?>'">
					<jdoc:include type="modules" name="logo" style="notitle" />
				</div>	
			<?php } else { ?>
				<div id="s5_logo" onclick="window.document.location.href='<?php echo $LiveSiteUrl ?>'"></div>
			<?php } ?>
			
			<div style="clear:both;height:0px"></div>
		
		</div>
		</div>
		
		<div id="s5_md_menu_login_wrap">
		<div id="s5_md_menu_login_wrap_inner">
			
			<div id="s5_md_menu_wrap">
			<div id="s5_md_menu_wrap_inner">
			
				<?php 
				$s5_mobile_menu = s5_mobile_menu_helper::get_s5_mobile_menu($s5_mobile_device_menu_title,$s5_menu_type,$s5_mobile_device_menu_subs);
				echo $s5_mobile_menu;
				?>
				
			</div>
			</div>
			
			<?php if ($s5_mobile_device_register == "enabled") { ?>
				<?php if ($user_id) { } else { ?>
				<div id="s5_md_register_wrap">
				<div id="s5_md_register_wrap_inner">
					
					<?php $s5_register_text = JText::_('REGISTER'); ?>		
					<a class="button" id="s5_md_register" href="<?php echo JRoute::_( 'index.php?option=com_users&view=registration' ); ?>"><?php echo ucwords(strtolower($s5_register_text)) ?></a>
				
				</div>
				</div>
				<?php } ?>
			<?php } ?>
			
			<?php if ($s5_mobile_device_login == "enabled") { ?>
			
				<div id="s5_md_login_wrap">
				<div id="s5_md_login_wrap_inner">
			
							<?php if ($user_id) {  ?>
							  
							  <a class="button" id="s5_md_login" href="<?php echo JRoute::_( 'index.php?option=com_users&view=login' ); ?>"><?php echo JText::_('LOGOUT'); ?></a>

							<?php } else { ?>
							 
							 <a id="s5_md_login" class="button" href="<?php echo JRoute::_( 'index.php?option=com_users&task=logout' ); ?>"><?php echo JText::_('LOGIN'); ?></a>

							<?php }  ?>		
				</div>
				</div>
				
			<?php } ?>
			
			<div style="clear:both;height:0px"></div>
		
		</div>
		</div>
		
		<?php if ($s5_pos_search == "published") { ?>
		
			<div id="s5_md_search_wrap">
			<div id="s5_md_search_wrap_inner">
			
				<jdoc:include type="modules" name="search" style="notitle" />
				
				<div style="clear:both;height:0px"></div>
			
			</div>
			</div>
			
		<?php } ?>
		
		<?php if ($s5_pos_mobile_top_1 == "published") { ?>
		
			<div id="s5_md_mobile_top_1_wrap">
			<div id="s5_md_mobile_top_1_wrap_inner">
			
				<jdoc:include type="modules" name="mobile_top_1" style="xhtml" />
			
			</div>
			</div>
		
		<?php } ?>
		
		<?php if ($s5_pos_mobile_top_2 == "published") { ?>
		
			<div id="s5_md_mobile_top_2_wrap">
			<div id="s5_md_mobile_top_2_wrap_inner">
			
				<jdoc:include type="modules" name="mobile_top_2" style="xhtml" />
			
			</div>
			</div>
		
		<?php } ?>
		
		<?php if ($s5_show_component == "yes") { ?>
		
			<div id="s5_md_main_content_wrap">
			<div id="s5_md_main_content_wrap_inner">
			
				<?php if ($s5_pos_breadcrumb == "published") { ?>
		
					<div id="s5_md_breadcrumb_wrap">
					<div id="s5_md_breadcrumb_wrap_inner">
					
						<jdoc:include type="modules" name="breadcrumb" style="notitle" />
					
					</div>
					</div>
				
				<?php } ?>
									
				<jdoc:include type="message" />
				<jdoc:include type="component" />
			
			</div>
			</div>
			
		<?php } ?>
		
		
		<?php if ($s5_pos_mobile_bottom_1 == "published") { ?>
		
			<div id="s5_md_mobile_bottom_1_wrap">
			<div id="s5_md_mobile_bottom_1_wrap_inner">
			
				<jdoc:include type="modules" name="mobile_bottom_1" style="xhtml" />
			
			</div>
			</div>
		
		<?php } ?>
		
		<?php if ($s5_pos_mobile_bottom_2 == "published") { ?>
		
			<div id="s5_md_mobile_bottom_2_wrap">
			<div id="s5_md_mobile_bottom_2_wrap_inner">
			
				<jdoc:include type="modules" name="mobile_bottom_2" style="xhtml" />
			
			</div>
			</div>
		
		<?php } ?>
	
		<div id="s5_md_footer_wrap">
		<div id="s5_md_footer_wrap_inner">
		
			<?php include("templates/".$s5_template_name."/vertex/footer.php"); ?>
			<br /><br />
			<a id="s5_md_switch" href="?switch=0"><?php echo $s5_mobile_device_pc_text ?></a>
		
		</div>
		</div>
	
	</div>
	</div>
	
</div>

</div>
</div>
