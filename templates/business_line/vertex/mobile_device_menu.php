<?php

// PLEASE NOTE THAT THIS IS A LEGACY FILE THAT IS ONLY USED FOR TEMPLATES BUILT OFF OF VERTEX 1

class s5_mobile_menu_helper
{
	  static function get_s5_mobile_menu($s5_mobile_device_menu_title,$s5_menu_type,$s5_mobile_device_menu_subs)
	   {
			$user = JFactory::getUser();

		    $s5_menu_type =  $s5_menu_type;
			$startline =  @$s5_mobile_device_menu_title;
	 		$app		= JFactory::getApplication();
			$menu		= $app->getMenu();
			$items 		= $menu->getItems('menutype',$s5_menu_type);


		    $mymenu_content ="<form name='Lnk'><select id='s5_mobile_menu' name='s5_mobile_menu' class='inputbox'
				onchange='javascript:location.href=document.Lnk.s5_mobile_menu.options[document.Lnk.s5_mobile_menu.selectedIndex].value;' >
		        <option id='s5_md_menu_active'>-- ".$startline."  --</option>";

		    if (count($items)) {


		    	$parents = array();
				$tmparray = array();
				foreach($items as $item) {


				 if((in_array($item->parent_id,$parents) && $item->level >1) || $item->level==1 ){
				 	$tmparray[$item->title.$item->id] = new stdClass;
					$tmparray[$item->title.$item->id]->title = $item->title;
					$tmparray[$item->title.$item->id]->id = $item->id;
					$tmparray[$item->title.$item->id]->level = $item->level;

					$tmparray[$item->title.$item->id]->type = $item->type;//echo $item->parent_id.'--';

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
					$tmparray[$item->title.$item->id]->flink = $item->flink;

				 } else {

				 	continue;
				 }
				 $parents[] = $item->id;


				}
				ksort($tmparray);

				foreach($tmparray as   $item) {
					if (@$s5_mobile_device_menu_subs == "first") {

						if($item->level >1 ) continue;

					}



					if ($item->type != "separator" ) {

							$mymenu_content .= " <option value=\"".$item->flink."\" >$item->title</option>\r";

					}
			    }

			 	   $mymenu_content .= "</select></form>";
			        return $mymenu_content ;
			    }

		}
}

?>
