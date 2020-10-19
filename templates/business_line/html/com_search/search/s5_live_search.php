<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
	//$resultsText = JRequest::getVar('results_text') ;
	//$noResultsText = JRequest::getVar('no_results_text') ;

	//get the module params
	$database =& JFactory::getDBO();
	$searchword = JRequest::getVar('searchword','');

	$query = "SELECT params"
	. "\n FROM #__modules "
	. "\n WHERE module = 'mod_s5_live_search'"
	;
	$database->setQuery( $query );
	$row = $database->loadResult();

	$app	= JFactory::getApplication();
	//$params = $app->getParams();
	jimport( 'joomla.html.parameter' );
	
	$version = new JVersion();
	if($version->RELEASE <= '2.5'){
		$params = new JParameter( $row );
	}else {
		$params = new JRegistry( $row );
	}
	
	
	

	$resultsText 	= $params->get('more_results_text', 'Search Results - Click Here For Full Results');
	$noResultsText	= $params->get('no_results_text', 'No results');
	$searchphrase	= $params->get('searchphrase', 'any');
	$ordering		= $params->get('ordering', 'newest');
?>
<div id="s5_search_results">
	<?php
		if (count($this->results)) {
		?>
			<div class="s5_ls_top_bar" style="border-bottom:solid 1px #<?php echo $_SESSION['bar_border_color'] ?>; padding-bottom:<?php echo $_SESSION['bar_padding_tb'] ?>px; padding-top:<?php echo $_SESSION['bar_padding_tb'] ?>px; padding-right:<?php echo $_SESSION['bar_padding_lr'] ?>px; padding-left:<?php echo $_SESSION['bar_padding_lr'] ?>px; background:#<?php echo $_SESSION['bar_bg_color'] ?>">
				<a class="s5_ls_bar_a" href="<?php echo JRoute::_('index.php?option=com_search&view=search&searchphrase='.$searchphrase.'&ordering='.$ordering.'&limit=0&searchword='.$searchword); ?>">
					<span onmouseout="this.style.textDecoration='none'" onmouseover="this.style.textDecoration='underline'" class="s5_ls_bar_span" style="color:#<?php echo $_SESSION['bar_font_color'] ?>; font-size:<?php echo $_SESSION['bar_font_size'] ?>px">
						<?php echo $this->pagination->total.' '.$resultsText; ?>
					</span>
				</a>
				<div style="height:18px; width:18px" onclick="javascript:closeResultDiv();" id="s5_ls_close"></div>
			</div>

		<?php
			$i = 0 ;
			$tabClasses = array('s5_ls_result1', 's5_ls_result2');
			$search_word = $_SESSION['searchword_color'];
			foreach( $this->results as $result ) {
				$result->text = str_replace('<span class="highlight">', '<span style="padding-left:3px; padding-right:3px; background:#'.$search_word.'" class="s5_ls_search_word">', $result->text) ;
				$tab = $tabClasses[$i];
			?>


			<?php if ($tab == "s5_ls_result1") { ?>
				<div onmouseout="this.style.backgroundColor='#<?php echo $_SESSION['result1_bg_color'] ?>'" onmouseover="this.style.backgroundColor='#<?php echo $_SESSION['result1_bg_hover_color'] ?>'" class="s5_ls_result1" style="border-bottom:solid 1px #<?php echo $_SESSION['result1_border_color'] ?>; padding-bottom:<?php echo $_SESSION['result_padding_tb'] ?>px; padding-top:<?php echo $_SESSION['result_padding_tb'] ?>px; padding-right:<?php echo $_SESSION['result_padding_lr'] ?>px; padding-left:<?php echo $_SESSION['result_padding_lr'] ?>px; background:#<?php echo $_SESSION['result1_bg_color'] ?>">
					<h2 style="margin-bottom:<?php echo $_SESSION['result_padding_tb'] ?>px">
						<a onmouseout="this.style.textDecoration='none'" onmouseover="this.style.textDecoration='underline'" style="font-size:<?php echo $_SESSION['result_font_size'] ?>px; color:#<?php echo $_SESSION['result1_link_font_color'] ?>" class="s5_ls_result_link" href="<?php echo $result->href?>"><?php echo $result->title ; ?></a>
					</h2>
					<span style="font-size:<?php echo $_SESSION['result_font_size'] ?>px; color:#<?php echo $_SESSION['result1_font_color'] ?>" class="s5_ls_result1_text" >
						<?php echo $result->text ; ?>&nbsp;<a onmouseout="this.style.textDecoration='none'" onmouseover="this.style.textDecoration='underline'" class="s5_ls_readmore" style="font-size:<?php echo $_SESSION['result_font_size'] ?>px; color:#<?php echo $_SESSION['result1_readmore_font_color'] ?>" href="<?php echo $result->href?>"><?php echo $_SESSION['readmore_text'] ?></a>
					</span>
				</div>
			<?php } ?>


			<?php if ($tab == "s5_ls_result2") { ?>
				<div onmouseout="this.style.backgroundColor='#<?php echo $_SESSION['result2_bg_color'] ?>'" onmouseover="this.style.backgroundColor='#<?php echo $_SESSION['result2_bg_hover_color'] ?>'" class="s5_ls_result2" style="border-bottom:solid 1px #<?php echo $_SESSION['result2_border_color'] ?>; padding-bottom:<?php echo $_SESSION['result_padding_tb'] ?>px; padding-top:<?php echo $_SESSION['result_padding_tb'] ?>px; padding-right:<?php echo $_SESSION['result_padding_lr'] ?>px; padding-left:<?php echo $_SESSION['result_padding_lr'] ?>px; background:#<?php echo $_SESSION['result2_bg_color'] ?>">
					<h2 style="margin-bottom:<?php echo $_SESSION['result_padding_tb'] ?>px">
						<a onmouseout="this.style.textDecoration='none'" onmouseover="this.style.textDecoration='underline'" style="font-size:<?php echo $_SESSION['result_font_size'] ?>px; color:#<?php echo $_SESSION['result2_link_font_color'] ?>" class="s5_ls_result_link" href="<?php echo $result->href?>"><?php echo $result->title ; ?></a>
					</h2>
					<span style="font-size:<?php echo $_SESSION['result_font_size'] ?>px; color:#<?php echo $_SESSION['result2_font_color'] ?>" class="s5_ls_result2_text" >
						<?php echo $result->text ; ?>&nbsp;<a onmouseout="this.style.textDecoration='none'" onmouseover="this.style.textDecoration='underline'" class="s5_ls_readmore" style="font-size:<?php echo $_SESSION['result_font_size'] ?>px; color:#<?php echo $_SESSION['result2_readmore_font_color'] ?>" href="<?php echo $result->href?>"><?php echo $_SESSION['readmore_text'] ?></a>
					</span>
				</div>
			<?php } ?>


			<?php
				$i = 1- $i ;
			}
		?>
			<div class="s5_ls_bottom_bar" style="border-top:solid 1px #<?php echo $_SESSION['bar_border_color'] ?>; padding-bottom:<?php echo $_SESSION['bar_padding_tb'] ?>px; padding-top:<?php echo $_SESSION['bar_padding_tb'] ?>px; padding-right:<?php echo $_SESSION['bar_padding_lr'] ?>px; padding-left:<?php echo $_SESSION['bar_padding_lr'] ?>px; background:#<?php echo $_SESSION['bar_bg_color'] ?>">
				<a class="s5_ls_bar_a" href="<?php echo JRoute::_('index.php?option=com_search&view=search&searchphrase='.$searchphrase.'&ordering='.$ordering.'&limit=0&searchword='.$searchword); ?>">
					<span onmouseout="this.style.textDecoration='none'" onmouseover="this.style.textDecoration='underline'" class="s5_ls_bar_span" style="color:#<?php echo $_SESSION['bar_font_color'] ?>; font-size:<?php echo $_SESSION['bar_font_size'] ?>px">
						<?php echo $this->pagination->total.' '.$resultsText; ?>
					</span>
				</a>
			</div>
		<?php
		} else {
		?>
			<div class="s5_ls_top_bar" style="border-bottom:solid 1px #<?php echo $_SESSION['bar_border_color'] ?>; height:14px; padding-bottom:<?php echo $_SESSION['bar_padding_tb'] ?>px; padding-top:<?php echo $_SESSION['bar_padding_tb'] ?>px; padding-right:<?php echo $_SESSION['bar_padding_lr'] ?>px; padding-left:<?php echo $_SESSION['bar_padding_lr'] ?>px; background-color:#<?php echo $_SESSION['bar_bg_color'] ?>">
				<div style="height:18px; width:18px" onclick="javascript:closeResultDiv();" id="s5_ls_close"></div>
			</div>
			<div class="s5_ls_no_result" style="border-bottom:solid 1px #<?php echo $_SESSION['result1_border_color'] ?>; padding-bottom:<?php echo $_SESSION['result_padding_tb'] ?>px; padding-top:<?php echo $_SESSION['result_padding_tb'] ?>px; padding-right:<?php echo $_SESSION['result_padding_lr'] ?>px; padding-left:<?php echo $_SESSION['result_padding_lr'] ?>px; background:#<?php echo $_SESSION['result1_bg_color'] ?>">
				<a class="s5_ls_bar_a" style="font-size:<?php echo $_SESSION['result_font_size'] ?>px; color:#<?php echo $_SESSION['result1_font_color'] ?>">
					<?php echo $noResultsText;?>
				</a>
			</div>
			<div class="s5_ls_bottom_bar" style="border-top:solid 1px #<?php echo $_SESSION['bar_border_color'] ?>; height:14px; padding-bottom:<?php echo $_SESSION['bar_padding_tb'] ?>px; padding-top:<?php echo $_SESSION['bar_padding_tb'] ?>px; padding-right:<?php echo $_SESSION['bar_padding_lr'] ?>px; padding-left:<?php echo $_SESSION['bar_padding_lr'] ?>px; background:#<?php echo $_SESSION['bar_bg_color'] ?>">
			</div>
		<?php
		}
	?>
</div>
