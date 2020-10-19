<?php
/**
 * TimeWorked Client model
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

class TimeWorkedModelClient extends JModelAdmin
{
	/**
	 * {@inheritdoc}
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Load form from XML file
		$form = $this->loadForm('com_timeworked.client', 'client', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTable($type = 'clients', $prefix = 'TimeWorkedTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_timeworked.edit.client.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

	public function save($data)
	{
		if (!isset($data['set_background_color']))
		{
			$data['set_background_color'] = 0;
		}
        if (!isset($data['published'])) 
        {
            $data['published'] = 0;
        }

		return parent::save($data);
	}
}
