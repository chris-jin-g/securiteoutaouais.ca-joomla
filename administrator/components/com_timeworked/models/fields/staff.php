<?php
/**
 * Staff field type
 *
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html License code: 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
defined('_JEXEC') or die;
JFormHelper::loadFieldClass('checkboxes');

class JFormFieldStaff extends JFormFieldCheckboxes
{
	/**
	 * {@inheritdoc}
	 */
	protected $type = 'staff';

	/**
	 * {@inheritdoc}
	 */
	protected function getInput()
	{
		$html = array();

		$class = $this->element['class'] ? ' class="checkboxes ' . (string) $this->element['class'] . '"' : ' class="checkboxes"';

		$html[] = '<fieldset id="' . $this->id . '"' . $class . '>';

		$options = $this->getOptions();

		$html[] = '<ul>';

		foreach ($options as $i => $option)
		{
			$checked  = (in_array((string) $option->value, (array) $this->value) ? ' checked="checked"' : '');
			$class    = !empty($option->class) ? ' class="' . $option->class . '"' : '';
			$disabled = !empty($option->disable) ? ' disabled="disabled"' : '';

			$onclick = !empty($option->onclick) ? ' onclick="' . $option->onclick . '"' : '';

			$html[] = '<li>';
			$html[] = '<input type="checkbox" id="' . $this->id . (int) $option->value . '" name="' . $this->name . '"' . ' value="'
				. htmlspecialchars($option->value, ENT_COMPAT, 'UTF-8') . '"' . $checked . $class . $onclick . $disabled . '/>';

			$html[] = '<label for="' . $this->id . $i . '"' . $class . '>' . JText::_($option->text) . ' <span class="tw-user-group">(' . implode(', ', $option->groups) . ')</span>' . '</label>';
			$html[] = '</li>';
		}

		$html[] = '</ul>';
		$html[] = '</fieldset>';

		return implode($html);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getOptions()
	{
		$options   = array();
		$users_arr = array();

		foreach ($this->value as $key => $value)
		{
			$users_arr[$key] = (int) $value;
		}

		if (count($users_arr))
		{
			$users = implode(',', $users_arr);
			$db    = JFactory::getDBO();
			$query = $db->getQuery(true)
				->select($db->quoteName(array('u.id', 'u.name'), array('value', 'text')))
                ->select($db->qn('ug.title', 'group'))
				->from($db->quoteName('#__users', 'u'))
                ->innerJoin('#__user_usergroup_map AS ugm ON (ugm.user_id = u.id)')
                ->innerJoin('#__usergroups AS ug ON (ug.id = ugm.group_id)')
				->where($db->quoteName('u.id') . ' IN (' . $users . ')')
				->order($db->quoteName('text'));
			$db->setQuery($query);
			$options = (array) $db->loadObjectList();
			reset($options);
		}
        
        $output = array();
        foreach ($options as $opt) {
            if (!isset($output[$opt->value])) {
                $obj = new stdClass();
                $obj->value  = $opt->value;
                $obj->text   = $opt->text;
                $obj->groups = array();
                $output[$opt->value] = $obj;
            }
            $output[$opt->value]->groups[] = $opt->group;
        }

		return $output;
	}
}
