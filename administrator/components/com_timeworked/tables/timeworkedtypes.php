<?php
/**
 * TimeTime Worked worked types table
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
jimport('joomla.database.table');

class TimeWorkedTableTimeWorkedTypes extends JTable
{
	/**
	 * {@inheritdoc}
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__tw_time_worked_type', 'id', $db);
	}

	/**
	 * Set default time worked type if no default time worked types in DB
	 * {@inheritdoc}
	 */
	public function store($updateNulls = false)
	{
		$query = $this->_db->getQuery(true)
			->select('COUNT(' . $this->_db->quoteName('id') . ')')
			->from($this->_db->quoteName($this->_tbl));
		$this->_db->setQuery($query);

		if (!$this->_db->loadResult())
		{
			$this->default = 1;
		}

		return parent::store($updateNulls);
	}
}