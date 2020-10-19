<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
?>

<!--<ul class="menu<?php echo $class_sfx;?>"<?php
	$tag = '';
	//$tag_id = $params->get('tag_id');
	$tag_id = '';
	if ($tag_id!=NULL) {
		$tag = $tag_id.'';
		echo ' id="'.$tag.'"';
	}
?>>-->
<?php
foreach ($list as $i => &$item) :
	$class = '';
	if ($item->flink == "") {
	$item->flink = "javascript:;";
	}
	if (in_array($item->id, $path)) {
		$class .= ' s5_mobile_sidebar_active';
	}

	if (!empty($class) && count($path)==1) {
		$class = ' class="'.trim($class) .'"';
	}

	if ($item->level==1) {
		if ($item->deeper) {
		echo "<h3 class='".$item->params->get('menu-anchor_css')."' onclick='s5_responsive_mobile_sidebar_h3_click(this.id)'><span class='s5_sidebar_deeper'><a ".$class." href='".$item->flink."' >".$item->title."</a></span></h3>";

		echo "<div class='s5_responsive_mobile_sidebar_sub'>";
		//continue;
		}
		else {
		echo "<h3 class='".$item->params->get('menu-anchor_css')."'><span><a ".$class."  href='".$item->flink."' >".$item->title."</a></span></h3>";
		continue;
		echo "<div class='s5_responsive_mobile_sidebar_sub'>";

		}
	} else {
		echo '<li>';
	}
	//echo dirname(__FILE__);exit;
	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
			if (!$item->deeper || $item->level > 1)
			require dirname(__FILE__).DS.'sidebar_'.$item->type.'.php';
			//require JModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);

			break;

		default:
			if (!$item->deeper || $item->level > 1)
			require dirname(__FILE__).DS.'sidebar_url.php';
			//require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			//
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper) {
		echo '<ul>';
	}
	// The next item is shallower.
	elseif ($item->shallower) {
		echo '</li>';
		echo str_repeat('</ul>', $item->level_diff);
	}
	// The next item is on the same level.
	else {
		echo '</li>';
	}
	if (@$list[$i+1]->level==1 || !@$list[$i+1]->level) {
	echo '</div>';

	}
endforeach;
?><!--</ul>-->
