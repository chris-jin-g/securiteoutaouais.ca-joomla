<?php
/**
 * Number formatter helper
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

class NumberFormatterHelper
{
	/**
	 * Get formatted numbers
	 *
	 * @param float $number
	 *
	 * @return float
	 */
	public static function getFormattedNumber($number)
	{
		if (!self::getShowZeros())
		{
			$number = preg_replace('/\.?0+$/', '', $number);
		}

		return $number;
	}

	public static function getShowZeros()
	{
		return (bool) JComponentHelper::getParams('com_timeworked')->get('show_zeros');
	}

	public static function getDigitsAfterDecimalPoint($calculated = true)
	{
		$digitsAfterDecimalPoint = intval(JComponentHelper::getParams('com_timeworked')->get('decimal_point'));

		if ($calculated)
		{
			return self::getShowZeros() ? 2 : $digitsAfterDecimalPoint;
		}

		return $digitsAfterDecimalPoint;
	}
}
