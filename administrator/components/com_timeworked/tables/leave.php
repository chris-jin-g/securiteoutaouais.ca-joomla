<?php
/**
 * TimeWorked Leave table
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

class JTableLeave extends JTable
{
	/**
	 * {@inheritdoc}
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__tw_leaves', 'id', $db);
	}

	public function store($updateNulls = false)
	{
		$user = JFactory::getUser();
		$date = JFactory::getDate();

		if (empty($this->user_id))
		{
			$this->user_id = $user->get('id');
		}

		if (empty($this->id))
		{
			$this->created    = $date->toSql();
			$this->created_by = $user->get('id');
		}
		else
		{
			$this->modified    = $date->toSql();
			$this->modified_by = $user->get('id');
		}
        if (!empty($this->user_commentary)) {
            $this->user_commentary = htmlspecialchars($this->user_commentary);
        }

		return parent::store($updateNulls);
	}
}
