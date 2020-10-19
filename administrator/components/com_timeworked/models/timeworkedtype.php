<?php
/**
 * TimeTime Worked worked type model
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
jimport('joomla.application.component.modeladmin');

class TimeWorkedModelTimeWorkedType extends JModelAdmin
{
	/**
	 * {@inheritdoc}
	 */
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_timeworked.timeworkedtype', 'timeworkedtype', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTable($type = 'timeworkedtypes', $prefix = 'TimeWorkedTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_timeworked.edit.timeworkedtype.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}
}
