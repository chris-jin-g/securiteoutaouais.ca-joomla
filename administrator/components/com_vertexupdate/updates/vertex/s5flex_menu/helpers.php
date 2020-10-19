<?php // no direct access

defined('_JEXEC') or die('Restricted access');

jimport('joomla.base.tree');

jimport('joomla.utilities.simplexml');

jimport('joomla.application.module.helper');

/**

* mod_mainmenu Helper class

*

* @static

* @package      Joomla

* @subpackage   Menus

* @since        1.5

*/

$flexmv = false;

class S5modMainMenuHelper
{

	/**

	* Get a list of the menu items.

	*

	* @param    JRegistry   $params The module options.

	*

	* @return   array

	* @since    1.5

	*/

	static function getList(&$params, $menu_type = false)
	{

		global $flexmv;

		// Initialise variables.

		$list = array();

		$db = JFactory::getDbo();

		$user = JFactory::getUser();

		$app = JFactory::getApplication();

		//$menu     = $app->getMenu();

		//Load the router object

		$client = 'Site';

		$info = JApplicationHelper::getClientInfo($client, true);

		$classname = 'JMenu' . ucfirst($client);

		$options = array();

		$instance = new $classname($options);

		//$menu = $app->getMenu();
		$menu = $classname::getInstance($client, $options);

		// If no active menu, use default

		$active = ($menu->getActive()) ? $menu->getActive() : $menu->getDefault();

		$path = $active->tree;

		$start = (int) $params['startLevel'];

		$end = (int) $params['endLevel'];

		$showAll = $params['showAllChildren'];

		$maxdepth = (int) $params['s5_maxdepth']; //$params->get('maxdepth');

		if ($menu_type) {

			$menu_type = $menu_type;

		} else {

			$menu_type = $params['s5_menu_type'];

		}

		$items = $menu->getItems('menutype', $menu_type); //$params->get('menutype')

		$lastitem = 0;

		if ($items) {

			foreach ($items as $i => $item) {

				if (($start && $start > $item->level) || ($end && $item->level > $end) || (!$showAll && $item->level > 1 && !in_array($item->parent_id, $path)) || ($maxdepth && $item->level > $maxdepth) || ($start > 1 && !in_array($item->tree[0], $path)) || ($item->access == 3 && (isset($user->groups['Registered']) || isset($user->groups['Public'])))) {

					unset($items[$i]);

					continue;

				}

				if (!$item->params->get('menu_show', 1) && strpos($item->params->get('menu-anchor_css', ''), 's5_logo_spacer') === false) {
					unset($items[$i]);
					continue;
				}

				$item->deeper = false;

				$item->shallower = false;

				$item->level_diff = 0;

				if (isset($items[$lastitem])) {

					$items[$lastitem]->deeper = ($item->level > $items[$lastitem]->level);

					$items[$lastitem]->shallower = ($item->level < $items[$lastitem]->level);

					$items[$lastitem]->level_diff = ($items[$lastitem]->level - $item->level);

				}

				$lastitem = $i;

				$item->active = false;

				$item->flink = $item->link;

				switch ($item->type) {

					case 'separator':

						// No further action needed.

						break;

					case 'url':

						if ((strpos($item->link, 'index.php?') === 0) && (strpos($item->link, 'Itemid=') === false)) {

							// If this is an internal Joomla link, ensure the Itemid is set.

							$item->flink = $item->link . '&Itemid=' . $item->id;

						}

						break;

					case 'alias':

						// If this is an alias use the item id stored in the parameters to make the link.

						$item->flink = 'index.php?Itemid=' . $item->params->get('aliasoptions');

						break;

					default:

						$router = JFactory::getApplication()->getRouter();

						if ($router->getMode() == JROUTER_MODE_SEF) {

							$item->flink = 'index.php?Itemid=' . $item->id;

						} else {

							$item->flink .= '&Itemid=' . $item->id;

						}

						break;

				}

				if (strcasecmp(substr($item->flink, 0, 4), 'http') && (strpos($item->flink, 'index.php?') !== false)) {

					$item->flink = JRoute::_($item->flink, true, $item->params->get('secure'));

				} else {

					$item->flink = JRoute::_($item->flink);

				}

				$item->title = htmlspecialchars($item->title);

				$item->anchor_css = htmlspecialchars($item->params->get('menu-anchor_css', ''));

				$item->anchor_title = htmlspecialchars($item->params->get('menu-anchor_title', ''));

				$item->menu_image = $item->params->get('menu_image', '') ? htmlspecialchars($item->params->get('menu_image', '')) : '';

			}

			if (isset($items[$lastitem])) {

				$items[$lastitem]->deeper = (($start ? $start : 1) > $items[$lastitem]->level);

				$items[$lastitem]->shallower = (($start ? $start : 1) < $items[$lastitem]->level);

				$items[$lastitem]->level_diff = ($items[$lastitem]->level - ($start ? $start : 1));

			}

		}

		return $items;

	}

	public static function S5buildXML($params, $menu_type = false, $version = false)
	{

		global $Itemid, $flexmv;

		$flexmv = $version;

		//$menu         = new S5JMenuTree($params);

		//$Itemid = JRequest::getInt('Itemid'); //intval( $Itemid );

		$Itemid = (!$Itemid) ? JRequest::getInt('Itemid') : intval($Itemid);

		$active_class_id = 0;

		//directly call the menu function to not rewrite the mainmenu content

		/*

		if(file_exists($path))

		{

		require_once $path;



		// Create a JPathway object

		$client = "site";

		$classname = 'JMenu'.ucfirst($client);

		$options = array();

		$instance = new $classname($options);

		}

		$items = $instance;

		*/ //$items = &JSite::getMenu();

		// Get Menu Items

		$rows = S5modMainMenuHelper::getList($params, $menu_type); //$items->getItems('menutype', $params->get('s5_menu_type'));

		$maxdepth = $params['s5_maxdepth'];

		// Build Menu Tree root down (orphan proof - child might have lower id than parent)

		$user = JFactory::getUser();

		$ids = array();

		$ids[0] = true;

		$last = null;

		$unresolved = array();

		// pop the first item until the array is empty if there is any item

		if (is_array($rows)) {

			$parent_items = array();

			$child_items = array();

			foreach ($rows as $row) {

				//check parent first

				if ($row->level == 1) {

					$parent_items[$row->id] = $row;

					//generate the active parent id

					if ($Itemid == $row->id) {

						$active_class_id = $row->id;

					}

				} elseif ($row->level > 1) {

					$child_depth = count($row->tree);

					if ($child_depth > 1) {

						$child_items[$child_depth][$row->tree[$child_depth - 2]][$row->id] = $row;

					} else {

						$child_items[$child_depth][$row->tree[$child_depth - 1]][$row->id] = $row;

					}

					//generate the active parent id

					if ($Itemid == $row->id) {

						$active_class_id = $row->tree[0];

					}

				}

			}

			//create the layout

			if (!empty($parent_items)) {

				$display = "<ul id='s5_nav' class='menu'>";

				foreach ($parent_items as $prow => $pitem) {

					$parent_subtext_flex = "";

					//$S5_menu_items_params     = new JParameter( $pitem->params );

					$S5_menu_items_params = new JRegistry();

					if ($flexmv <= 2.5)
						$S5_menu_items_params->loadJSON($pitem->params);

					else
						$S5_menu_items_params->loadObject($pitem->params);

					//print_r($S5_menu_items_params);

					$S5_subtext = $S5_menu_items_params->get(($flexmv <= 2.5 ? 's5_subtext' : 'data.s5_subtext'));

					//var_dump($S5_subtext);

					$S5_child_columns = $S5_menu_items_params->get(($flexmv <= 2.5 ? 's5_columns' : 'data.s5_columns'), 1); //s5_child_columns

					//generate the item link

					//$router   = JSite::getRouter();

					//$pitem->url = $router->getMode() == JROUTER_MODE_SEF ? 'index.php?Itemid='.$pitem->id : $pitem->link.'&Itemid='.$pitem->id;

					$pitem->url = $pitem->flink;



					//($flexmv <= 2.5 ? '' : 'data.')



					$iParams = new JRegistry();

					if ($flexmv <= 2.5)
						$iParams->loadJSON($pitem->params);

					else
						$iParams->loadObject($pitem->params);



					if ($iParams->get(($flexmv <= 2.5 ? 'menu_image' : 'data.menu_image')) && $iParams->get(($flexmv <= 2.5 ? 'menu_image' : 'data.menu_image')) != -1) {

						switch ($iParams->get(($flexmv <= 2.5 ? 'menu_images_align' : 'data.menu_images_align'), 0)) {

							case 0:

								$imgalign = 'float:left;';

								break;

							case 1:

								$imgalign = 'float:right;';

								break;

							default:

								$imgalign = 'float:left;';

								break;

						}







						switch ($pitem->browserNav) {

							default:

							case 0:

								// _top

								$image = '<span class="s5_img_span"><img style="' . $imgalign . 'cursor:pointer" src="' . $iParams->get(($flexmv <= 2.5 ? 'menu_image' : 'data.menu_image')) . '" onclick="window.document.location.href=\'' . $pitem->url . '\'" alt="' . $pitem->alias . '" /></span>';



								break;

							case 1:

								// _blank

								$image = '<span class="s5_img_span"><img style="' . $imgalign . 'cursor:pointer" src="' . $iParams->get(($flexmv <= 2.5 ? 'menu_image' : 'data.menu_image')) . '" onclick="window.open(\'' . $pitem->url . '\')" alt="' . $pitem->alias . '" /></span>';



								break;

							case 2:

								// window.open

								$image = '<span class="s5_img_span"><img style="' . $imgalign . 'cursor:pointer" src="' . $iParams->get(($flexmv <= 2.5 ? 'menu_image' : 'data.menu_image')) . '" onclick="window.open(\'' . $pitem->url . '\')" alt="' . $pitem->alias . '" /></span>';

								break;

						}



						/*if($tmp->ionly){

						$tmp->name = null;

						}*/

					} else {

						$image = null;

					}

					if ($pitem->type == "separator") {

						$pitem->url = $pitem->link . 'javascript:;'; //$router->getMode() == JROUTER_MODE_SEF ? 'index.php?Itemid='.$pitem->id : $pitem->link.'javascript:;';

					}

					//generate the active class

					if (isset($active_class_id) && $active_class_id == $pitem->id) {

						$class_active = "active";

					} else {

						$class_active = "";

					}

					/*                  if($S5_subtext != ""){

					$parent_subtext_flex = "<span class='S5_subtext'>".$S5_subtext."</span>";

					}else{

					$parent_subtext_flex = "";

					}*/

					/* silviu add new funcitonality to 1.7 version

					*  remove the menu title if param is set to 0 and menu image exists

					*/

					if ($iParams->get(($flexmv <= 2.5 ? 'menu_image' : 'data.menu_image')) && $iParams->get(($flexmv <= 2.5 ? 'menu_image' : 'data.menu_image')) != -1 && $iParams->get(($flexmv <= 2.5 ? 'menu_text' : 'data.menu_text')) == 0) {

						$pitem->title = "";

					}

					//  if ($pitem->title != "") {

					switch ($pitem->browserNav) {

						default:

						case 0:
						$link_format = '';

							// _top

							if (strstr($pitem->url, "#s5")) {

								if ($pitem->title != "") {

									if (strrpos($pitem->url, "/") > 1) {

										$link_format = "<a href=\"$pitem->url\"' onclick=\"s5_page_scroll('" . $pitem->url . "')\"><span onclick=\"s5_page_scroll('" . $pitem->url . "')\" >" . $pitem->title . "</span></a>";

									}

									else {

										$link_format = "<a href=\"" . $pitem->url . "\" onclick=\"s5_page_scroll('" . $pitem->url . "')\"><span onclick=\"s5_page_scroll('" . $pitem->url . "')\" >" . $pitem->title . "</span></a>";

									}

									if ($S5_subtext != "") {

										$parent_subtext_flex = "<span class='S5_parent_subtext' onclick=\"s5_page_scroll('" . $pitem->url . "')\" >" . $S5_subtext . "</span>";

									} else {

										$parent_subtext_flex = "";

									}

								}

							} else {

								if ($pitem->title != "") {

									$link_format = "<a href=\"$pitem->url\"><span onclick='window.document.location.href=\"$pitem->url\"'>" . $pitem->title . "</span></a>";

									if ($S5_subtext != "") {

										$parent_subtext_flex = "<span class='S5_parent_subtext' onclick='window.document.location.href=\"$pitem->url\"'>" . $S5_subtext . "</span>";

									} else {

										$parent_subtext_flex = "";

									}

								}

							}

							break;

						case 1:

							// _blank

							$link_format = "<a   href=\"$pitem->url\" onclick='this.removeAttribute(\"href\")' target='_blank'><span onclick='window.open(\"$pitem->url\")'>" . $pitem->title . "</span></a>";

							if ($S5_subtext != "") {

								if ($pitem->browserNav == "0") {

									$parent_subtext_flex = "<span class='S5_parent_subtext' onclick='window.document.location.href=\"$pitem->url\"'>" . $S5_subtext . "</span>";

								} else if ($pitem->browserNav == "1") {

									$parent_subtext_flex = "<span class='S5_parent_subtext' onclick='window.open(\"$pitem->url\")'>" . $S5_subtext . "</span>";

								}

							} else {

								$parent_subtext_flex = "";

							}

							break;

						case 2:

							// window.open

							$attribs = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes'; //.$this->_params->get('window_open');



							$link = $pitem->url; //str_replace('index.php', 'index2.php', $pitem->url);



							if ($S5_subtext != "") {

								$parent_subtext_flex = '<span class="S5_parent_subtext" onclick="window.open(\'' . $link . '\',\'targetWindow\',\'' . $attribs . '\');return false;">' . $S5_subtext . '</span>';

							} else {

								$parent_subtext_flex = "";

							}



							$link_format = '<a    href="' . $link . '" onclick="this.removeAttribute(\'href\')"><span onclick="window.open("' . $link . '",\'targetWindow\',\'' . $attribs . '\');return false;">' . $pitem->title . '</span></a>';

							break;

					}

					//          }

					$display .= "<li   class='" . $class_active . " " . $pitem->anchor_css . "' ><span class='s5_level1_span1'><span class='s5_level1_span2'>$image" . $link_format . $parent_subtext_flex . "</span></span>";

					//display the child limit the maxdepth

					$display .= S5modMainMenuHelper::getChildItems($prow, $child_items, $maxdepth, 2, $S5_child_columns, $pitem->params);

					$display .= "</li>";

				}

				$display .= "</ul>";

			}

			//silviu extra code - end

			echo $display;

		} else {

			echo "";

		}

	}


	public static function getChildItems($parent_id, $child_items, $maxdepth, $current_depth, $parent_item_columns, $parent_params)
	{
		//echo $parent_id."<br>";
		global $flexmv;
		//echo $parent_item_columns;
		if ($current_depth <= $maxdepth) {
			$display_c = '';
			if (isset($child_items[$current_depth][$parent_id]) && !empty($child_items[$current_depth][$parent_id])) {
				//retrieve the parent params
				//$S5_parent_items_params = new JParameter( $parent_params );
				$S5_parent_items_params = new JRegistry();
				if ($flexmv <= 2.5)
					$S5_parent_items_params->loadJSON($parent_params);
				else
					$S5_parent_items_params->loadObject($parent_params);
				$s5_group_child        = $S5_parent_items_params->get(($flexmv <= 2.5 ? 's5_group_child' : 'data.s5_group_child'), 0);
				//split the child items content regarding the parent param
				//count all the child items
				$all_child_items       = count($child_items[$current_depth][$parent_id]);
				//generate the number of ul and the wifth of the ul and the child records per row
				$ul_number             = $parent_item_columns;
				$ul_width              = 100 / intval($ul_number);
				$child_records_per_row = $all_child_items > 0 ? ceil($all_child_items / $parent_item_columns) : 0;
				$last_column_count     = $all_child_items - (($parent_item_columns - 1) * $child_records_per_row);

				//calculate each columns #items
				$ul_lis = array();
				if ($all_child_items >= $parent_item_columns) {
					for ($i = 1; $i <= $parent_item_columns; $i++) {
						$ul_lis[$i] = $child_records_per_row;
					}
					$total = $child_records_per_row * $parent_item_columns;
					if ($total > $all_child_items) {
						$diff  = $total - $all_child_items;
						$index = $parent_item_columns;
						if ($diff > 0 && $diff > $child_records_per_row) {
							while ($diff > 0) {
								$diff = ($diff - $ul_lis[$index]) + 1;
								if ($diff > 0) {
									$ul_lis[$index] = 1;
									$index--;
								} else {
									$ul_lis[$index] = 1 + abs($diff);
									$index--;
								}
							}
						} else if ($diff > 0 && $diff < $child_records_per_row) {
							$ul_lis[$index] = $ul_lis[$index] - $diff;
						} else if ($diff > 0 && $diff == $child_records_per_row) {
							$ul_lis[$index] = 1;
							$ul_lis[$index - 1]--;
						}
					}
				} else {
					for ($i = 1; $i <= $all_child_items; $i++) {
						$ul_lis[$i] = $child_records_per_row;
					}
				}



				if ($s5_group_child == 0) {
					//not grouped means <ul><li>content</li></ul>
					$display_c = "<ul style='float:left;'>"; //  style='width:".$ul_width."%;
				} else {
					//grouped means <div><span>content</span></div>
					$display_c = "<div class='S5_grouped_child_item'>";
				}

				if ($child_records_per_row > 0) {
					//display the child items grouped or not
					if ($s5_group_child == 0) {
						//not grouped means <ul><li>content</li></ul>
						$display_c = "<ul style='float:left;'>"; //  style='width:".$ul_width."%;
					} else {
						//grouped means <div><span>content</span></div>
						$display_c = "<div class='S5_grouped_child_item'>";
					}

					$current_col = 1;
					$col_items   = $ul_lis[$current_col];
					$item_index  = 1;
					$current_i   = 0;
					foreach ($child_items[$current_depth][$parent_id] as $crow => $citem) {
						//$S5_menu_items_params     = new JParameter( $citem->params );
						$S5_menu_items_params = new JRegistry();
						if ($flexmv <= 2.5)
							$S5_menu_items_params->loadJSON($citem->params);
						else
							$S5_menu_items_params->loadObject($citem->params);
						$S5_child_columns = $S5_menu_items_params->get(($flexmv <= 2.5 ? 's5_columns' : 'data.s5_columns'), 1); //s5_child_columns
						$S5_load_mod      = $S5_menu_items_params->get(($flexmv <= 2.5 ? 's5_load_mod' : 'data.s5_load_mod'));
						//display the child content grouped or not
						if ($s5_group_child == 0) {
							//not grouped means <ul><li>content</li></ul>
							$display_c .= "<li class='" . $citem->anchor_css . "'>" . S5modMainMenuHelper::getMenuContent($citem);
						} else {
							//grouped means <div><span>content</span></div>
							//if we have child items for this span grouped item, add a new class to know that child exists and display it in JS file
							if (isset($child_items[$current_depth + 1][$crow])) {
								$display_c .= "<span class='grouped_sub_parent_item'>" . S5modMainMenuHelper::getMenuContent($citem);
							} else {
								$display_c .= "<span>" . S5modMainMenuHelper::getMenuContent($citem);
							}
						}
						//dipaly the child items only if the content is not a module position
						if ($S5_load_mod == 0) {
							if (isset($child_items[$current_depth + 1][$crow])) {
								$display_c .= S5modMainMenuHelper::getChildItems($crow, $child_items, $maxdepth, $current_depth + 1, $S5_child_columns, $citem->params);
							}
						}
						//display the child content grouped or not
						if ($s5_group_child == 0) {
							//not grouped means <ul><li>content</li></ul>
							$display_c .= "</li>";
						} else {
							//grouped means <div><span>content</span></div>
							$display_c .= "</span>";
						}

						//set a new ul if we reach the child per column limit
						if ($col_items == $item_index && $current_i < $all_child_items - 1) {
							if ($s5_group_child == 0) {
								//not grouped means <ul><li>content</li></ul>
								$display_c .= "</ul>";
								$display_c .= "<ul style='float:left;'>"; // style='width:".$ul_width."%;'
							} else {
								//grouped means <div><span>content</span></div>
								$display_c .= "</div>";
								$display_c .= "<div class='S5_grouped_child_item'>"; // style='width:".$ul_width."%;'
							}
							$current_col++;
							$col_items  = $ul_lis[$current_col];
							$item_index = 1;
						} else {
							$item_index++;
						}
						$current_i++;
					}
					//display the child content grouped or not
					if ($s5_group_child == 0) {
						//not grouped means <ul><li>content</li></ul>
						$display_c .= "</ul>";
					} else {
						//grouped means <div><span>content</span></div>
						$display_c .= "</div>";
					}
				} else {
					$display_c = "";
				}
			}
			return $display_c;
		} else {
			return "";
		}
	}

	/*  function getChildItems($parent_id, $child_items, $maxdepth, $current_depth, $parent_item_columns){

	if($current_depth <= $maxdepth){

	if(isset($child_items[$current_depth][$parent_id]) && !empty($child_items[$current_depth][$parent_id])){

	$display_c = "<ul>";

	foreach($child_items[$current_depth][$parent_id] as $crow => $citem){



	$S5_menu_items_params   = new JParameter( $citem->params );

	$s5_child_columns       = $S5_menu_items_params->get('s5_child_columns');



	$display_c .= "<li>".S5modMainMenuHelper::getMenuContent($citem);

	//$display_c .= "<li><a href='#'>".$citem->name."</a>";



	if(isset($child_items[$current_depth+1][$crow])){

	$display_c .= S5modMainMenuHelper::getChildItems($crow, $child_items, $maxdepth, $current_depth+1, $s5_child_columns);

	}



	$display_c .= "</li>";

	}

	$display_c .= "</ul>";

	}

	return $display_c;

	}else{

	return "";

	}

	}*/

	public static function getMenuContent($S5row)
	{

		global $flexmv;

		$app = JFactory::getApplication();

		$active = $app->getMenu()->getActive();

		$isActiveMenu = ($active && in_array( $S5row->id, $active->tree) ) ? true : false;

		//return "<li><a href='#'>".$row->name."</a></li>";

		//silviu module code - start

		//$S5_menu_items_params = new JParameter( $S5row->params );

		$S5_menu_items_params = new JRegistry();

		if ($flexmv <= 2.5)
			$S5_menu_items_params->loadJSON($S5row->params);

		else
			$S5_menu_items_params->loadObject($S5row->params);

		$S5_load_mod = $S5_menu_items_params->get(($flexmv <= 2.5 ? 's5_load_mod' : 'data.s5_load_mod'));

		$S5_subtext = $S5_menu_items_params->get(($flexmv <= 2.5 ? 's5_subtext' : 'data.s5_subtext'));

		//retrieve the parent params

		//$S5_parent_items_params = new JParameter( $parent_params );

		$s5_group_child = $S5_menu_items_params->get(($flexmv <= 2.5 ? 's5_group_child' : 'data.s5_group_child'), 0);

		$S5_mod_array_orig = $S5_menu_items_params->get(($flexmv <= 2.5 ? 's5_position' : 'data.s5_position'));

		if (!is_array($S5_mod_array_orig)) {

			$S5_mod_array = array(
				$S5_mod_array_orig
			);

		} else {

			$S5_mod_array = $S5_mod_array_orig;

		}

		//recreate the menu content with link on it

		//after that remove the link so the module content won't have link on it

		//$router   = JSite::getRouter();

		//$S5row->url = $router->getMode() == JROUTER_MODE_SEF ? 'index.php?Itemid='.$S5row->id : $S5row->link.'&Itemid='.$S5row->id;

		$S5row->url = $S5row->flink;

		if ($S5row->type == "separator") {

			$S5row->url = $S5row->link . 'javascript:;'; //$router->getMode() == JROUTER_MODE_SEF ? 'index.php?Itemid='.$pitem->id : $pitem->link.'javascript:;';

		}

		$tmp = $S5row;

		//$iParams = new JParameter($tmp->params);

		$iParams = new JRegistry();

		if ($flexmv <= 2.5)
			$iParams->loadJSON($tmp->params);

		else
			$iParams->loadObject($tmp->params);

		if ($iParams->get(($flexmv <= 2.5 ? 'menu_image' : 'data.menu_image')) && $iParams->get(($flexmv <= 2.5 ? 'menu_image' : 'data.menu_image')) != -1) {

			switch ($iParams->get(($flexmv <= 2.5 ? 'menu_images_align' : 'data.menu_images_align'), 0)) {

				case 0:

					$imgalign = 'float:left;';

					break;

				case 1:

					$imgalign = 'float:right;';

					break;

				default:

					$imgalign = 'float:left;';

					break;

			}



			switch ($tmp->browserNav) {

				default:

				case 0:

					// _top

					$image = '<span class="s5_img_span"><img style="' . $imgalign . 'cursor:pointer" src="' . $iParams->get(($flexmv <= 2.5 ? 'menu_image' : 'data.menu_image')) . '" onclick="window.document.location.href=\'' . $S5row->url . '\'" alt="' . $S5row->alias . '" /></span>';



					break;

				case 1:

					// _blank

					$image = '<span class="s5_img_span"><img style="' . $imgalign . 'cursor:pointer" src="' . $iParams->get(($flexmv <= 2.5 ? 'menu_image' : 'data.menu_image')) . '" onclick="window.open(\'' . $S5row->url . '\')" alt="' . $S5row->alias . '" /></span>';



					break;

				case 2:

					// window.open



					$image = '<span class="s5_img_span"><img style="' . $imgalign . 'cursor:pointer" src="' . $iParams->get(($flexmv <= 2.5 ? 'menu_image' : 'data.menu_image')) . '" onclick="window.open(\'' . $S5row->url . '\')" alt="' . $S5row->alias . '" /></span>';

					break;

			}







			/*if($tmp->ionly){

			$tmp->name = null;

			}*/

		} else {

			$image = null;

		}

		/* silviu add new funcitonality to 1.7 version

		*  remove the menu title if param is set to 0 and menu image exists

		*/

		if ($iParams->get(($flexmv <= 2.5 ? 'menu_image' : 'data.menu_image')) && $iParams->get(($flexmv <= 2.5 ? 'menu_image' : 'data.menu_image')) != -1 && $iParams->get(($flexmv <= 2.5 ? 'menu_text' : 'data.menu_text')) == 0) {

			$S5row->title = "";

		}

		switch ($tmp->browserNav) {

			default:

			case 0:

				// _top



				if (strstr($S5row->url, "#s5")) {

					if ($S5row->title != "") {

						if (strrpos($S5row->url, "/") > 1) {

							$link_format = "<a href=\"$S5row->url\" onclick=\"s5_page_scroll('" . $S5row->url . "')\"><span class='s5_sub_a_span'  onclick=\"s5_page_scroll('" . $S5row->url . "')\" >" . $S5row->title . "</span></a>";

						} else {

							$link_format = "<a href=\"" . $S5row->url . "\" onclick=\"s5_page_scroll('" . $S5row->url . "')\"><span class='s5_sub_a_span'  onclick=\"s5_page_scroll('" . $S5row->url . "')\" >" . $S5row->title . "</span></a>";

						}

						if ($S5_subtext != "") {

							$parent_subtext_flex = "<span class='S5_subtext' onclick=\"s5_page_scroll('" . $S5row->url . "')\" >" . $S5_subtext . "</span>";

						} else {

							$parent_subtext_flex = "";

						}

					}

				} else {



					$link_format = "<a href=\"$S5row->url\"><span class='s5_sub_a_span' onclick='window.document.location.href=\"$S5row->url\"'>" . $S5row->title . "</span></a>";

					if ($S5_subtext != "") {

						$parent_subtext_flex = "<span class='S5_subtext' onclick='window.document.location.href=\"$S5row->url\"'>" . $S5_subtext . "</span>";

					} else {

						$parent_subtext_flex = "";

					}

				}

				break;

			case 1:

				// _blank

				$link_format = "<a href=\"$S5row->url\" target='_blank' onclick='this.removeAttribute(\"href\")'><span class='s5_sub_a_span' onclick='window.open(\"$S5row->url\")'>" . $S5row->title . "</span></a>";

				if ($S5_subtext != "") {

					$parent_subtext_flex = "<span class='S5_subtext' onclick='window.open(\"$S5row->url\")'>" . $S5_subtext . "</span>";

				} else {

					$parent_subtext_flex = "";

				}

				break;

			case 2:

				// window.open

				$attribs = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes'; //.$this->_params->get('window_open');



				$link = $S5row->url; //str_replace('index.php', 'index2.php', $pitem->url);



				if ($S5_subtext != "") {

					$parent_subtext_flex = '<span class="S5_subtext" onclick="window.open(\'' . $link . '\',\'targetWindow\',\'' . $attribs . '\');return false;">' . $S5_subtext . '</span>';

				} else {

					$parent_subtext_flex = "";

				}



				$link_format = '<a href="' . $link . '" onclick="this.removeAttribute(\'href\')"><span class="s5_sub_a_span" onclick="window.open(\'' . $link . '\',\'targetWindow\',\'' . $attribs . '\');return false;">' . $S5row->title . '</span></a>';

				break;

		}

		if (is_array($S5_mod_array) && !empty($S5_mod_array) && $S5_load_mod == '1') {

			if (is_array($S5_mod_array)) {

				//if($group == 1){

				$s5_loaded_modules = array();

				//get the module content first

				foreach ($S5_mod_array as $S5_position_value) {

					//get all the modules for this position

					$all_position_modules = S5JModuleHelper::getModules($S5_position_value);

					if (is_array($all_position_modules) && !empty($all_position_modules)) {

						foreach ($all_position_modules as $s5_position_module) {

							$s5_module_content = "";

							//$module = S5JModuleHelper::getModule( 'mod_login', 'Login Form' );

							if ($s5_position_module->module == 'mod_custom') {

								$s5_module_content = S5JModuleHelper::getModule('custom', $s5_position_module->title);

							} else {

								$s5_module_content = S5JModuleHelper::getModule(strtolower(substr($s5_position_module->module, 4, strlen($s5_position_module->module))), $s5_position_module->title);

							}

							$attribs['style'] = 'xhtml';

							//$yj_load_mod ='LOAD MODULE OR MODULES HERE';

							$s5_loaded_modules[] = S5JModuleHelper::renderModule($s5_module_content, $attribs);

						}

					}

				}

				//recreate the menu content with link on it

				//after that remove the link so the module content won't have link on it

				$S5row->title = "<span class='S5_submenu_item" . ($isActiveMenu ? ' active' : '') ."'>" . $image . $link_format;

				//display the subtext

				if ($S5_subtext != "") {

					$S5row->title .= $parent_subtext_flex; //"<div class='S5_subtext'>".$S5_subtext."</div>";//<br />

				}

				$S5row->title .= "</span>"; //<br />

				if (is_array($s5_loaded_modules) && !empty($s5_loaded_modules)) {

					//display the Joomla menu content

					$columns_group = $S5_menu_items_params->get(($flexmv <= 2.5 ? 's5_columns' : 'data.s5_columns'));

					//display the child items grouped or not

					if ($s5_group_child == 0) {

						//not grouped means <ul><li>content</li></ul>

						$S5row->title .= "<ul style='float:left;'><li>"; //  style='width:".$ul_width."%;

					} else {

						$S5row->title .= "<div class='S5_menu_module_parent_group'>";

						//  $S5row->name .= "<div class='S5_menu_module_parent'>";

						$S5row->title .= "<div class='S5_menu_module_group'>";

					}

					$k = 0;

					$all_loaded_modules = count($s5_loaded_modules);

					$rows_group = $columns_group > 0 ? ceil($all_loaded_modules / $columns_group) : 0;

					for ($i = 0; $i < $rows_group; $i++) {

						//check to see if we still have modules content to display

						if (!empty($s5_loaded_modules)) {

							$S5row->title .= "<div style='width:100%;'>";

							for ($j = 0; $j < $columns_group; $j++) {

								if (isset($s5_loaded_modules[$k])) {

									if ($all_loaded_modules > $columns_group) {

										$content_cell_width = 100 / intval($columns_group);

									} else {

										$content_cell_width = 100 / intval($all_loaded_modules);

									}

									$S5row->title .= "<div style='float:left; width:" . $content_cell_width . "%;'>" . $s5_loaded_modules[$k] . "</div>";

									//remove the displayed module content form the array

									unset($s5_loaded_modules[$k]);

									$k++;

								} //end if

							} //end for

							$S5row->title .= "</div><div style='clear:both;'></div>";

						} //end if

					} //end for

					//display the child items grouped or not

					if ($s5_group_child == 0) {

						//not grouped means <ul><li>content</li></ul>

						$S5row->title .= "</li></ul>"; //  style='width:".$ul_width."%;

					} else {

						$S5row->title .= "</div>";

						$S5row->title .= "</div>";

					}

					//}else{

					//  $S5row->title = "";

				} //end if

				//}

				//new row to remove the link on the content if the content have module in it

				$S5row->module_content = 1;

				//$S5row->name = "<div class='S5_submenu_item'>".$S5row->name."</div>";

			} else {

				//display the Joomla menu content

				$columns_group = $S5_menu_items_params->get(($flexmv <= 2.5 ? 's5_columns' : 'data.s5_columns'));

				//recreate the menu content with link on it

				//after that remove the link so the module content won't have link on it

				$S5row->title = $image . $link_format;

				//display the subtext

				if ($S5_subtext != "") {

					$S5row->title .= $parent_subtext_flex; //"<div class='S5_subtext'>".$S5_subtext."</div>";//<br />

				}

				$S5row->title .= "<div class='S5_menu_module_parent_group'>";

				//  $S5row->name .= "<div class='S5_menu_module_parent'>";

				$S5_module_to_load = $S5_mod_array;

				$S5_module_to_load2 = S5modMainMenuHelper::getModule($S5_module_to_load);

				$module_menu_content = trim(S5JModuleHelper::renderModule($S5_module_to_load2, array(
					'style' => "xhtml"
				)));

				if (isset($S5_mod_with[0]) && $S5_mod_with[0] > 0) {

					$S5row->title .= "<div class='S5_menu_module' style='width:" . $S5_mod_with[0] . "px;'>" . $module_menu_content . "</div>";

				} else {

					$S5row->title .= "<div class='S5_menu_module'>" . $module_menu_content . "</div>";

				}

				$S5row->title .= "</div>";

				//$S5row->name = str_replace(array('<ul>', '</ul>'), '', $S5row->name);

				//$S5row->name = str_replace(array('<li>', '</li>'), '', $S5row->name);

				//$S5row->name = str_replace(array('<p>', '</p>'), '', $S5row->name);

				//$S5row->name = preg_replace("/<ul(.*)>/", "", $S5row->name);

				//$S5row->name = preg_replace("/<li(.*)>/", "", $S5row->name);

				//$S5row->name = preg_replace("/<p(.*)>/", "<br />", $S5row->name);

				//new row to remove the link on the content if the content have module in it

				$S5row->module_content = 1;

				$S5row->title = "<span class='S5_submenu_item" . ($isActiveMenu ? ' active' : '') ."'>" . $S5row->title . "</span>";

			}

		} else {

			$temp = "";

			//$row->name = $links[$links_id];

			if ($S5_subtext != "") {

				//display the subtext

				$temp = $image . $link_format . $parent_subtext_flex; //<br />

			} else {

				//$temp =  "<div>".$image.$row->name."</div>";

				$temp = $image . $link_format;

			}

			$S5row->title = $temp;

			//$row->name."\n"."<div class=\"subtext\">".$text."</div>";

			//new row to remove the link on the content if the content have module in it

			$S5row->module_content = 0;

			$S5row->title = "<span class='S5_submenu_item" . ($isActiveMenu ? ' active' : '') ."'>" . $S5row->title . "</span>";

		}

		//silviu module code - end

		return $S5row->title;

	}

}