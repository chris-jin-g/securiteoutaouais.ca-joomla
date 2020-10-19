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

class DateRangeListHelper
{
	static public function getMonthList($tableDates)
	{
		$dates       = array();
		$filterDates = json_decode(JFactory::getApplication()->input->cookie->getString('filterDate'));

		if ($filterDates)
		{
			foreach ($filterDates as $item)
			{
				$startDateText = DateFormatterHelper::format(strtotime($item->start));
				$endDateText   = DateFormatterHelper::format(strtotime($item->end));
				$dates[]       = array(
					'id'   => DateFormatterHelper::toMySQLFormat(strtotime($item->start)) . '--' . DateFormatterHelper::toMySQLFormat(strtotime($item->end)),
					'name' => $startDateText . ' — ' . $endDateText);
			}
		}

		$dates = array_merge($dates, $tableDates);

		return $dates;
	}
}
