<?php
/**
 * Project field type
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
JFormHelper::loadFieldClass('list');

class JFormFieldProject extends JFormFieldList
{
	/**
	 * {@inheritdoc}
	 */
	protected $type = 'project';

	/**
	 * {@inheritdoc}
	 */
	protected function getOptions()
	{
		$user = JFactory::getUser();

		$db    = JFactory::getDBO();
		$query = $db->getQuery(true)
			->select($db->quoteName(array('projects.id', 'projects.name'), array('value', 'text')))
			->select('UPPER(' . $db->quoteName('projects.name') . ') AS ' . $db->quoteName('sort'))
			->from($db->quoteName('#__tw_projects', 'projects'))
			->where($db->qn('projects.published') . '=' . $db->q('1'))
			->order($db->quoteName('sort') . ' ASC');

		if (!$user->get('isRoot'))
		{
			$query
				->leftJoin(
					$db->quoteName('#__tw_users_have_projects', 'user_projects') . ' ON '
					. $db->quoteName('user_projects.projectid') . ' = ' . $db->quoteName('projects.id')
				)
				->where($db->quoteName('user_projects.userid') . ' = ' . $db->quote($user->get('id')));
		}

		$db->setQuery($query);
		$options = $db->loadObjectList();

		if (count($options) != 1)
		{
			array_unshift($options, array('value' => '', 'text' => ''));
		}

		return $options;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getInput()
	{
		$html = array();
		$attr = '';

		$attr .= !empty($this->class) ? ' class="' . $this->class . '"' : '';
		$attr .= !empty($this->size) ? ' size="' . $this->size . '"' : '';
		$attr .= $this->multiple ? ' multiple' : '';
		$attr .= $this->required ? ' required aria-required="true"' : '';
		$attr .= $this->autofocus ? ' autofocus' : '';
		$attr .= ' data-placeholder="' . JText::_('COM_TIMEWORKED_SELECT_PROJECT') . '"';

		if ((string) $this->readonly == '1' || (string) $this->readonly == 'true' || (string) $this->disabled == '1' || (string) $this->disabled == 'true')
		{
			$attr .= ' disabled="disabled"';
		}

		$attr .= $this->onchange ? ' onchange="' . $this->onchange . '"' : '';

		$options = (array) $this->getOptions();

		if ((string) $this->readonly == '1' || (string) $this->readonly == 'true')
		{
			$html[] = JHtml::_('select.genericlist', $options, '', trim($attr), 'value', 'text', $this->value, $this->id);
			$html[] = '<input type="hidden" name="' . $this->name . '" value="' . htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '"/>';
		}
		else
		{
			$html[] = JHtml::_('select.genericlist', $options, $this->name, trim($attr), 'value', 'text', $this->value, $this->id);
		}

		return implode($html);
	}
}
