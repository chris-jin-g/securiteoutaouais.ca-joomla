<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

JPluginHelper::importPlugin('content');

function modChrome_notitle($module, &$params, &$attribs)
{

	$s5_module_title = $module->title;

	$responsive_class_placement_beginning = strpos($s5_module_title,"class=");
	$responsive_class = "";

	if ($responsive_class_placement_beginning >= 1) {
		$responsive_class = substr($s5_module_title, $responsive_class_placement_beginning + 6, 5000);
		$s5_module_title = substr($s5_module_title, 0, $responsive_class_placement_beginning);
	}

	if (!empty ($module->content)) : ?>
		<div class="moduletable<?php echo htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8'); ?><?php if ($responsive_class != "") { echo ' '.$responsive_class; } ?>">
			<?php $module->content = JHTML::_('content.prepare', $module->content);echo $module->content; ?>
		</div>
	<?php endif;
}


function modChrome_fourdivs($module, &$params, &$attribs)
{
	if (!empty ($module->content)) :

	$s5_module_title = $module->title;

	$responsive_class_placement_beginning = strpos($s5_module_title,"class=");
	$responsive_class = "";

	if ($responsive_class_placement_beginning >= 1) {
		$responsive_class = substr($s5_module_title, $responsive_class_placement_beginning + 6, 5000);
		$s5_module_title = substr($s5_module_title, 0, $responsive_class_placement_beginning);
	}

	?>
		<div class="s5_fourdivs_1<?php echo htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8'); ?><?php if ($responsive_class != "") { echo ' '.$responsive_class; } ?>">
		<div class="s5_fourdivs_2">
		<div class="s5_fourdivs_3">
		<div class="s5_fourdivs_4">
			<?php if ($module->showtitle) { echo '<h3 class="s5_fourdivs_title">'.$s5_module_title.'</h3>'; } ?>
			<?php $module->content = JHTML::_('content.prepare', $module->content);echo $module->content; ?>
		</div>
		</div>
		</div>
		</div>
	<?php endif;
}


function modChrome_round_box($module, &$params, &$attribs) {

	$dir = dirname(dirname(__FILE__));
	if (file_exists($dir . '/templateDetails.xml')) {
	  $template_xml_load = simplexml_load_file($dir . '/templateDetails.xml', 'SimpleXMLElement', LIBXML_NOCDATA);
	  $template_description = $template_xml_load->description;
	  $template_creation_date = $template_xml_load->creationDate;
	} else {
	  $template_description = 'blank';
	}

	if(strrpos($template_description,"callie") <= 0 && strrpos($template_description,"Callie") <= 0 && strrpos($template_description,"compassion") <= 0 && strrpos($template_description,"Compassion") <= 0 && $template_creation_date != "November 2011" && strrpos($template_description,"presti") <= 0 && strrpos($template_description,"Presti") <= 0 && $template_creation_date != "February 2013" && strrpos($template_description,"maxed") <= 0 && strrpos($template_description,"Maxed") <= 0 && $template_creation_date != "September 2011") {

		$suffix = trim(htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8'));
		if ($suffix == "_menu") {
			$suffix = "";
		}

		if ($suffix == "_text") {
			$suffix = "";
		}

		$suffix_color = "no";
		$suffix_ion_class = "";

		if($suffix) {
			$arr = array();
			$exploded = explode(" ", $suffix);
			foreach ($exploded as $value)
			{
				if (ctype_xdigit($value))
				{
					$suffix_color = $value;
				}
				else if (strrpos($value, '5_icon.'))
				{
					$suffix_ion_class = $value;
				}
				else
				{
					$arr[] = $value;
				}
			}

			$suffix = implode($arr, ' ');
		}

		if (!preg_match('/^-/', $suffix)) {
			$suffix = ' ' . $suffix;
		}

		if (!empty ($module->content)) {

			$s5_module_title = $module->title;

			$responsive_class_placement_beginning = strpos($s5_module_title,"class=");
			$responsive_class = "";

			if ($responsive_class_placement_beginning >= 1) {
				$responsive_class = substr($s5_module_title, $responsive_class_placement_beginning + 6, 5000);
				$s5_module_title = substr($s5_module_title, 0, $responsive_class_placement_beginning);
			}

			if ($module->showtitle) {

				$s5_h3 = strpos($s5_module_title," ");

				if ($s5_h3 != "") {
				$s5_h3_beginning = substr($s5_module_title, 0, $s5_h3);
				$s5_h3_end = substr($s5_module_title, $s5_h3, 500);
				}
				else {
				$s5_h3_beginning = $s5_module_title;
				$s5_h3_end = "";
				}

			} ?>

			<div class="module_round_box_outer<?php if ($responsive_class != "") { echo ' '.$responsive_class; } ?>">

			<div class="module_round_box<?php echo $suffix ?>">

				<div class="s5_module_box_1">
					<div class="s5_module_box_2">
						<?php if ($module->showtitle) : ?>
						<div <?php if ($suffix_color != "no") { ?>style="background:#<?php echo $suffix_color; ?>" <?php } ?>class="s5_mod_h3_outer">
							<h3 class="s5_mod_h3">
							<?php if ($suffix_ion_class != "") { ?>
							<i class="s5_mod_ion_icon <?php echo str_replace(".", " ", $suffix_ion_class); ?>"></i>
							<?php } ?>
							<?php if(strrpos($template_description,"gamers") > 0 || strrpos($template_description,"Gamers") > 0 || $template_creation_date == "September 2013") { ?><span class="s5_h3_inner"><?php } ?>
								<span class="s5_h3_first"><?php echo $s5_h3_beginning ?> </span><span class="s5_h3_last"><?php echo $s5_h3_end ?></span>
							<?php if(strrpos($template_description,"gamers") > 0 || strrpos($template_description,"Gamers") > 0 || $template_creation_date == "September 2013") { ?></span><?php } ?>
							</h3>
							<?php if ($suffix == "-split_line" || $suffix == "-centered_split_line") { ?>
							<div class="s5_line_module1">
								<div class="s5_line_module2">
								</div>
							</div>
							<?php } ?>
						</div>
						<?php if ($suffix == "-line") { ?>
							<div class="s5_line_module1">
								<div class="s5_line_module2">
								</div>
							</div>
						<?php } ?>
						<div class="s5_mod_h3_below" style="clear:both"></div>
						<?php endif; ?>
						<div class="s5_outer<?php echo $suffix ?>">
						<?php $module->content = JHTML::_('content.prepare', $module->content);echo $module->content; ?>
						</div>
						<div style="clear:both; height:0px"></div>
					</div>
				</div>

			</div>

			</div>

		<?php }


	} else if(strrpos($template_description,"callie") > 0 || strrpos($template_description,"Callie") > 0) {

		$suffix = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

		if ($suffix == "_menu") {
		$suffix = "";
		}
		if ($suffix == "_text") {
		$suffix = "";
		}
		if ($suffix == "_nav") {
		$suffix = "";
		}

		if ($suffix != "-medium" && $suffix != "-dark" && $suffix != "-highlight") {

			if (!empty ($module->content)) {

			if ($module->showtitle) {

			$s5_h3 = strpos($module->title," ");

			if ($s5_h3 != "") {
			$s5_h3_beginning = substr($module->title, 0, $s5_h3);
			$s5_h3_end = substr($module->title, $s5_h3, 500);
			}
			else {
			$s5_h3_beginning = $module->title;
			$s5_h3_end = "";
			}

			$s5_suffix = strpos($suffix," ");

			if ($s5_suffix != "") {
			$s5_suffix_word_color = substr($suffix, 0, $s5_suffix);
			$s5_suffix_word = substr($suffix, $s5_suffix +1, 500);
			}
			else {
			$s5_suffix_word_color = "";
			$s5_suffix_word = "";
			}

			}

			if ($module->showtitle) {

			$s5_h3 = strpos($module->title," ");

			if ($s5_h3 != "") {
			$s5_h3_beginning = substr($module->title, 0, $s5_h3);
			$s5_h3_end = substr($module->title, $s5_h3, 500);
			}
			else {
			$s5_h3_beginning = $module->title;
			$s5_h3_end = "";
			}

			} ?>

			<div class="module_round_box_outer">
			<div class="module_round_box_outer2<?php echo $suffix ?>">

			<?php if ($module->showtitle) { ?>
				<div class="s5_mod_h3_outer">
					<h3 class="s5_mod_h3"><span class="s5_mod_h3_inner"><span class="s5_h3_word_wrap"><span class="s5_h3_first"><?php echo $s5_h3_beginning ?> </span><?php echo $s5_h3_end ?></span><?php if ($s5_suffix_word != "") { ?><span style="background:#<?php echo $s5_suffix_word_color ?>" class="s5_h3_tag_wrap"><?php echo $s5_suffix_word ?></span><?php } ?></span></h3>
				<div style="clear:both;height:0px"></div>
				</div>
			<?php } ?>

			<div class="module_round_box<?php if ($module->showtitle) { ?>_with_title<?php } ?>">

					<div class="s5_module_box_1">
						<div class="s5_module_box_2">
							<?php $module->content = JHTML::_('content.prepare', $module->content);echo $module->content; ?>
							<div style="clear:both; height:0px"></div>
						</div>
					</div>

			</div>
			</div>

			</div>

			<?php }

		}

	} else if(strrpos($template_description,"compassion") > 0 || strrpos($template_description,"Compassion") > 0 || $template_creation_date == "November 2011") {

		$suffix = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
		if ($suffix == "_menu") {
		$suffix = "";
		}
		if ($suffix == "_text") {
		$suffix = "";
		}

		if (!empty ($module->content)) : ?>

			<?php if ($module->showtitle) : ?>

				<?php

				$s5_h3 = strpos($module->title," ");

				if ($s5_h3 != "") {
				$s5_h3_beginning = substr($module->title, 0, $s5_h3);
				$s5_h3_end = substr($module->title, $s5_h3, 500);
				}
				else {
				$s5_h3_beginning = $module->title;
				$s5_h3_end = "";
				}

				$s5_suffix = strpos($suffix," ");

				if ($s5_suffix != "") {
				$s5_suffix_word_color = substr($suffix, 0, $s5_suffix);
				$s5_suffix_word = substr($suffix, $s5_suffix +1, 500);
				}
				else {
				$s5_suffix_word_color = "";
				$s5_suffix_word = "";
				}

				?>

			<?php endif; ?>

			<?php if ($module->showtitle) : ?>

				<?php

				$s5_h3 = strpos($module->title," ");

				if ($s5_h3 != "") {
				$s5_h3_beginning = substr($module->title, 0, $s5_h3);
				$s5_h3_end = substr($module->title, $s5_h3, 500);
				}
				else {
				$s5_h3_beginning = $module->title;
				$s5_h3_end = "";
				}

				?>

			<?php endif; ?>


			<?php if ($suffix == "-gray") { ?>
			<?php if ($module->showtitle) : ?>
			<div class="s5_mod_h3_outer<?php echo $suffix ?>">
					<h3 class="s5_mod_h3">
						<span class="s5_mod_h3_inner">
							<span class="s5_h3_word_wrap">
								<span class="s5_h3_first">
									<?php echo $s5_h3_beginning ?>
								</span>
							<?php echo $s5_h3_end ?>
							</span>
							<?php if ($s5_suffix_word != "") { ?>
								<span class="s5_h3_tag_wrap">
									<?php echo $s5_suffix_word ?>
								</span>
							<?php } ?>
						</span>
					</h3>
			</div>
			<?php endif; ?>
			<?php } ?>

			<div class="module_round_box_outer">
			<div class="module_round_box<?php echo $suffix ?>">


					<div class="s5_module_box_1">
						<div class="s5_module_box_2">
							<?php if ($suffix != "-gray") { ?>
							<?php if ($module->showtitle) : ?>
							<div class="s5_mod_h3_outer">
								<h3 class="s5_mod_h3">
									<span class="s5_mod_h3_inner">
										<span class="s5_h3_word_wrap">
											<span class="s5_h3_first">
												<?php echo $s5_h3_beginning ?>
											</span>
										<?php echo $s5_h3_end ?>
										</span>
										<?php if ($s5_suffix_word != "") { ?>
											<span class="s5_h3_tag_wrap">
												<?php echo $s5_suffix_word ?>
											</span>
										<?php } ?>
									</span>
								</h3>
							</div>
							<?php endif; ?>
							<?php } ?>
							<?php $module->content = JHTML::_('content.prepare', $module->content);echo $module->content; ?>
							<div style="clear:both; height:0px"></div>
						</div>
					</div>


			</div>
		</div>
		<?php endif;

	} else if(strrpos($template_description,"presti") > 0 || strrpos($template_description,"Presti") > 0 || $template_creation_date == "February 2013") {

		$suffix = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
		if ($suffix == "_menu") {
		$suffix = "";
		}
		if ($suffix == "_text") {
		$suffix = "";
		}

		if (!empty ($module->content)) :

				$s5_module_title = $module->title;

				$responsive_class_placement_beginning = strpos($s5_module_title,"class=");
				$responsive_class = "";

				if ($responsive_class_placement_beginning >= 1) {
					$responsive_class = substr($s5_module_title, $responsive_class_placement_beginning + 6, 5000);
					$s5_module_title = substr($s5_module_title, 0, $responsive_class_placement_beginning);
				}

			?>

			<?php if ($module->showtitle) : ?>

				<?php

				$s5_h3 = strpos($s5_module_title," ");

				if ($s5_h3 != "") {
				$s5_h3_beginning = substr($s5_module_title, 0, $s5_h3);
				$s5_h3_end = substr($s5_module_title, $s5_h3, 500);
				}
				else {
				$s5_h3_beginning = $s5_module_title;
				$s5_h3_end = "";
				}

				?>

			<?php endif; ?>

			<?php
			$s5_inner_title = "no";

			if ($module->position == "s5_box1" || $module->position == "s5_box2" || $module->position == "s5_box3" || $module->position == "s5_box4" || $module->position == "s5_box5" || $module->position == "s5_box6" || $module->position == "s5_box7" || $module->position == "s5_box8" || $module->position == "s5_box9" || $module->position == "s5_box10" || $module->position == "register" || $module->position == "login" || $module->position == "top_row2_1" || $module->position == "top_row2_2" || $module->position == "top_row2_3" || $module->position == "top_row2_4" || $module->position == "top_row2_5" || $module->position == "top_row2_6") {
			$s5_inner_title = "yes";
			}
			?>

			<div class="module_round_box_outer<?php if ($responsive_class != "") { echo ' '.$responsive_class; } ?>">

			<?php if ($module->showtitle && $s5_inner_title == "no") : ?>
			<div class="s5_mod_h3_outer">
				<h3 class="s5_mod_h3"><span class="s5_h3_first"><?php echo $s5_h3_beginning ?> </span><?php echo $s5_h3_end ?></h3>
			</div>
			<?php endif; ?>

			<div class="module_round_box<?php echo $suffix ?>">

					<div class="s5_module_box_1">
						<div class="s5_module_box_2">
							<?php if ($module->showtitle && $s5_inner_title == "yes") : ?>
							<div class="s5_mod_h3_outer">
								<h3 class="s5_mod_h3"><span class="s5_h3_first"><?php echo $s5_h3_beginning ?> </span><?php echo $s5_h3_end ?></h3>
							</div>
							<?php endif; ?>
							<?php $module->content = JHTML::_('content.prepare', $module->content);echo $module->content; ?>
							<div style="clear:both; height:0px"></div>
						</div>
					</div>


			</div>

			</div>

		<?php endif;

	} else if(strrpos($template_description,"maxed") > 0 || strrpos($template_description,"Maxed") > 0 || $template_creation_date == "September 2011") {

		$suffix = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
		if ($suffix == "_menu") {
		$suffix = "";
		}
		if ($suffix == "_text") {
		$suffix = "";
		}

			if (!empty ($module->content)) : ?>

				<?php if ($module->showtitle) : ?>

					<?php

					$s5_h3 = strpos($module->title," ");

					if ($s5_h3 != "") {
					$s5_h3_beginning = substr($module->title, 0, $s5_h3);
					$s5_h3_end = substr($module->title, $s5_h3, 500);
					}
					else {
					$s5_h3_beginning = $module->title;
					$s5_h3_end = "";
					}

					?>

				<?php endif; ?>



				<div class="module_round_box_outer">
				<div class="module_round_box<?php echo $suffix ?>">


						<div class="s5_module_box_1">
							<div class="s5_module_box_2">
								<?php if ($module->showtitle) : ?>
								<div class="s5_mod_h3_outer">
									<h3 class="s5_mod_h3"><span class="s5_h3_outer"><span class="s5_h3_first"><?php echo $s5_h3_beginning ?> </span><?php echo $s5_h3_end ?></span></h3>
								</div>
								<?php endif; ?>
								<?php $module->content = JHTML::_('content.prepare', $module->content);echo $module->content; ?>
								<div style="clear:both; height:0px"></div>
							</div>
						</div>


				</div>
				</div>



			<?php endif;

	}
}



function modChrome_title_only($module, &$params, &$attribs)
{
	echo $module->title;
}


?>