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

class JFormFieldTask extends JFormFieldList
{
	/**
	 * {@inheritdoc}
	 */
	protected $type = 'task';

	/**
	 * {@inheritdoc}
	 */
	protected function getOptions()
	{
        $projectId = $this->getAttribute('projectid');
        
        if ($projectId) {
            $db = JFactory::getDbo();

            $query = $db->getQuery(true)
                    ->select($db->quoteName(array('t.id', 't.task'), array('value', 'text')))
                    ->from($db->qn('#__tw_tasks') . ' AS t')
                    ->innerJoin($db->qn('#__tw_projects_have_tasks') . ' AS pt ON (t.id = pt.taskid)')
                    ->where('pt.projectid = ' . $db->q($projectId));

            $db->setQuery($query);

            $options = $db->loadObjectList();
        } else {
            $options = array();
        }

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
		$attr .= ' data-placeholder="' . JText::_('COM_TIMEWORKED_SELECT_TASK') . '"';

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
