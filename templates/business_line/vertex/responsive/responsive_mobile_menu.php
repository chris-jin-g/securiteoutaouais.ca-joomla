<?php



// no direct access

defined('_JEXEC') or die;



class s5_responsive_menu

{



	static function getList($s5_responsive_menu,$s5_responsive_menu_end_level)

	{

		$app = JFactory::getApplication();

		$menu = $app->getMenu();







		// If no active menu, use default

		$active = ($menu->getActive()) ? $menu->getActive() : $menu->getDefault();



		$user = JFactory::getUser();

		$levels = $user->getAuthorisedViewLevels();

		asort($levels);

		$key = 'menu_items.'.$active->id;

		$cache = JFactory::getCache('mod_menu', '');

		if (!($items = $cache->get($key)))

		{

			// Initialise variables.

			$list		= array();

			$db			= JFactory::getDbo();



			$path		= $active->tree;

			//$start		= (int) $params->get('startLevel');

			$start		= 0;

			//$end		= (int) $params->get('endLevel');

			$end		= $s5_responsive_menu_end_level;

			//$showAll	= $params->get('showAllChildren');

			$showAll	= 'Yes';



			//$menutype   =  $params->get('menutype');

			$menutype   =  $s5_responsive_menu;



			$items 		= $menu->getItems('menutype',$menutype);



			$lastitem	= 0;



			if ($items) {

				foreach($items as $i => $item)

				{

					if (($start && $start > $item->level)

						|| ($end && $item->level > $end)

						|| (!$showAll && $item->level > 1 && !in_array($item->parent_id, $path))

						|| ($start > 1 && !in_array($item->tree[$start-2], $path))

					) {

						unset($items[$i]);

						continue;

					}
					
					if(!$item->params->get('menu_show',1)){
						unset($items[$i]);
						continue;
					}



					$item->deeper = false;

					$item->shallower = false;

					$item->level_diff = 0;



					if (isset($items[$lastitem])) {

						$items[$lastitem]->deeper		= ($item->level > $items[$lastitem]->level);

						$items[$lastitem]->shallower	= ($item->level < $items[$lastitem]->level);

						$items[$lastitem]->level_diff	= ($items[$lastitem]->level - $item->level);

					}



					$item->parent = (boolean) $menu->getItems('parent_id', (int) $item->id, true);



					$lastitem			= $i;

					$item->active		= false;

					$item->flink = $item->link;



					switch ($item->type)

					{

						case 'separator':

							// No further action needed.
							
							continue;



						case 'url':

							if ((strpos($item->link, 'index.php?') === 0) && (strpos($item->link, 'Itemid=') === false)) {

								// If this is an internal Joomla link, ensure the Itemid is set.

								$item->flink = $item->link.'&Itemid='.$item->id;

							}

							break;



						case 'alias':

							// If this is an alias use the item id stored in the parameters to make the link.

							$item->flink = 'index.php?Itemid='.$item->params->get('aliasoptions');

							break;



						default:

							$router = JFactory::getApplication()->getRouter();

							if ($router->getMode() == JROUTER_MODE_SEF) {

								$item->flink = 'index.php?Itemid='.$item->id;

							}

							else {

								$item->flink .= '&Itemid='.$item->id;

							}

							break;

					}



					if (strcasecmp(substr($item->flink, 0, 4), 'http') && (strpos($item->flink, 'index.php?') !== false)) {

						$item->flink = JRoute::_($item->flink, true, $item->params->get('secure'));

					}

					else {

						$item->flink = JRoute::_($item->flink);

					}



					$item->title = htmlspecialchars($item->title);

					$item->anchor_css = htmlspecialchars($item->params->get('menu-anchor_css', ''));

					$item->anchor_title = htmlspecialchars($item->params->get('menu-anchor_title', ''));

					$item->menu_image = $item->params->get('menu_image', '') ? htmlspecialchars($item->params->get('menu_image', '')) : '';

				}



				if (isset($items[$lastitem])) {

					$items[$lastitem]->deeper		= (($start?$start:1) > $items[$lastitem]->level);

					$items[$lastitem]->shallower	= (($start?$start:1) < $items[$lastitem]->level);

					$items[$lastitem]->level_diff	= ($items[$lastitem]->level - ($start?$start:1));

				}

			}



			$cache->store($items, $key);

		}

		

		return array_values($items);

	}

}







$params = array();

$responsivemenu = new s5_responsive_menu();





if($s5_responsive_menu_language_switch == 'enabled'){

	$db = JFactory::getDBO();

	$lang = JFactory::getLanguage();

	$query = " SELECT menutype  FROM  #__menu WHERE language = '".$lang->getTag()."' AND home = 1";

	$db->setQuery($query);

	if($lang_menu = $db->loadResult()){

		$s5_responsive_menu = $lang_menu;

	}

}



$list	= $responsivemenu->getList($s5_responsive_menu,$s5_responsive_menu_end_level);

$app	= JFactory::getApplication();

$menu	= $app->getMenu();

$active	= $menu->getActive();

$active_id = isset($active) ? $active->id : $menu->getDefault()->id;

$path	= isset($active) ? $active->tree : array();

$showAll	= 'Yes';

$class_sfx_param = '';

$class_sfx	= htmlspecialchars($class_sfx_param);

if(count($list)) {

	$layout = 'default';

	if($s5_responsive_mobile_layout == 'sidebar')

		$layout = 'sidebar';

	if ( !defined( 'DS')) define('DS', DIRECTORY_SEPARATOR);

	$templateDir = JPATH_BASE .DS. 'templates' .DS. $app->getTemplate();

	require $templateDir.DS.'vertex/responsive/'.DS.'responsive_mobile_menu'.DS.$layout.'.php';

}





