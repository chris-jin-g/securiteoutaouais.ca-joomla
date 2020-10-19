<?php 
defined('_JEXEC') or die('Restricted access');
jimport('legacy.html.menu');
jimport('joomla.html.html.menu');
jimport('cms.html.menu');

//Used in J Framework only

class JFormFieldmenuitems extends JFormField {
  protected $type = 'menuitems';
  function createMenuList() {
    $options = JHTML::_('menu.linkoptions');
    $result = JHTML::_('select.genericlist', $options, 'xml_s5_hide_component_items', 'class="inputbox" size="15" multiple="multiple"', 'value', 'text', $this->value);
    return $result;
  }
  function getInput() {
    $db = JFactory::getDBO();
    $version = new JVersion();
    $odering = ", m.ordering";
    if ($version->RELEASE >= '3.0') {
      $odering = "";
    }
    $query = 'SELECT m.id, m.parent_id, m.title, m.menutype' . ' FROM #__menu AS m' . ' WHERE m.published = 1' . ' ORDER BY m.menutype, m.parent_id ' . $odering;
    $db->setQuery($query);
    $mitems = $db->loadObjectList();
    $mitems_temp = $mitems;
    $children = array();
    
    foreach ($mitems as $v) {
      $id = $v->id;
      $pt = $v->parent_id;
      $list = @$children[$pt] ? $children[$pt] : array();
      array_push($list, $v);
      $children[$pt] = $list;
    }
    if(class_exists("JHTMLMenu")) {
      $list = JHTMLMenu::TreeRecurse(intval($mitems[0]->parent_id), '', array(), $children, 9999, 0, 0);
    } else {
      $list = array();
    }
    //$mitems_spacer = $mitems_temp[0]->menutype;
    $mitems = array();
    /*if (@$all | @$unassigned) {
      $mitems[] = JHTML::_('select.option', '<OPTGROUP>', JText::_('Menus'));
      if ($all) {
        $mitems[] = JHTML::_('select.option', 0, JText::_('All'));
      }
      if ($unassigned) {
        $mitems[] = JHTML::_('select.option', -1, JText::_('Unassigned'));
      }
      $mitems[] = JHTML::_('select.option', '</OPTGROUP>');
    }*/
    $lastMenuType = null;
    $tmpMenuType = null;
    foreach ($list as $list_a) {
      if ($list_a->menutype != $lastMenuType) {
        if ($tmpMenuType) {
          $mitems[] = JHTML::_('select.option', '</OPTGROUP>');
        }
        $mitems[] = JHTML::_('select.option', '<OPTGROUP>', ucwords(str_replace('-', ' ', $list_a->menutype)));
        $lastMenuType = $list_a->menutype;
        $tmpMenuType = $list_a->menutype;
      }
      $mitems[] = JHTML::_('select.option', $list_a->id, $list_a->treename);
    }
    if ($lastMenuType !== null) {
      $mitems[] = JHTML::_('select.option', '</OPTGROUP>');
    }
    array_shift($mitems);
    $result = JHTML::_('select.genericlist', $mitems, $this->name . '[]', 'class="inputbox" size="15" multiple="multiple"', 'value', 'text', $this->value);
    return $result;
  }
}
