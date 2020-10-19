<?php
/**
 * TimeWorked Clients table
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

class TimeWorkedTableClients extends JTable
{
	/**
	 * {@inheritdoc}
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__tw_clients', 'id', $db);
	}

	public function store($updateNulls = false)
	{
		$this->issue_tracker = trim($this->issue_tracker);

		return parent::store($updateNulls);
	}
}
