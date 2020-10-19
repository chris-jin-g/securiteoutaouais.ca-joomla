<?php
/**
 * Date formatter helper
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

class DateFormatterHelper
{
	/**
	 * Format date to current locale format
	 *
	 * @param   int|string $date date string or date in unix timestamp format
	 *
	 * @return string formatted date
	 */
	public static function format($date)
	{
		if (is_string($date))
		{
			$date = strtotime($date);
		}
		$dateString = date('j', $date) . ' ';

		switch (date('m', $date))
		{
			case '01':
				$dateString .= JText::_('JANUARY_SHORT');
				break;
			case '02':
				$dateString .= JText::_('FEBRUARY_SHORT');
				break;
			case '03':
				$dateString .= JText::_('MARCH_SHORT');
				break;
			case '04':
				$dateString .= JText::_('APRIL_SHORT');
				break;
			case '05':
				$dateString .= JText::_('MAY_SHORT');
				break;
			case '06':
				$dateString .= JText::_('JUNE_SHORT');
				break;
			case '07':
				$dateString .= JText::_('JULY_SHORT');
				break;
			case '08':
				$dateString .= JText::_('AUGUST_SHORT');
				break;
			case '09':
				$dateString .= JText::_('SEPTEMBER_SHORT');
				break;
			case '10':
				$dateString .= JText::_('OCTOBER_SHORT');
				break;
			case '11':
				$dateString .= JText::_('NOVEMBER_SHORT');
				break;
			case '12':
				$dateString .= JText::_('DECEMBER_SHORT');
				break;
		}

		$dateString .= ' ' . date('Y', $date);

		return str_replace('.', '', $dateString);
	}

	/**
	 * Convert date to MySQL format
	 *
	 * @param   int $date date string or date in unix timestamp format
	 *
	 * @return string|bool MySQL format date
	 */
	public static function toMySQLFormat($date)
	{
		return date("Y-m-d", $date);
	}
}
