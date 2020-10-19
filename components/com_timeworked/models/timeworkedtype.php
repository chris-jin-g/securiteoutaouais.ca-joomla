<?php
/**
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html License code: 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
defined('_JEXEC') or die;
jimport('joomla.application.component.modelitem');

class TimeWorkedModelTimeWorkedType extends JModelList
{
	protected $_context = 'com_timeworked.timeworkedtype';
	private $_timeWorkedTypes = array();

	/**
	 * Method to get a list of time worked types.
	 * Works also with cached value.
	 *
	 * @return  array   An object list - assoc array (id as key).
	 */
	public function getTimeWorkedTypes()
	{
		if (empty($this->_timeWorkedTypes))
		{
			$query = $this->_db->getQuery(true)
				->select('*')
				->from($this->_db->quoteName('#__tw_time_worked_type'))
				->order($this->_db->quoteName('id'));
			$this->_db->setQuery($query);
			$types      = $this->_db->loadObjectList();
			$assocTypes = array();
			foreach ($types as $type)
			{
				$assocTypes[$type->id] = $type;
			}
			$this->_timeWorkedTypes = $assocTypes;
		}

		return $this->_timeWorkedTypes;
	}

	/**
	 * Get id of default time worked type
	 *
	 * @return int id of default time worked type
	 */
	public function getDefaultTimeType()
	{
		$query = $this->_db->getQuery(true)
			->select($this->_db->quoteName('id'))
			->from($this->_db->quoteName('#__tw_time_worked_type'))
			->where($this->_db->quoteName('default') . '=' . $this->_db->quote('1'));
		$this->_db->setQuery($query);

		return intval($this->_db->loadResult());
	}
    
    protected function getListQuery()
	{
		$query = $this->_db->getQuery(true)
			->select('*')
			->from($this->_db->quoteName('#__tw_time_worked_type'));

		return $query;
	}
}
