<?php
/**
 * User validation rule
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
jimport('joomla.form.formrule');

class JFormRuleUser extends JFormRule
{
	/**
	 * {@inheritdoc}
	 */
	protected $regex = '^\d+$';

	/**
	 * {@inheritdoc}
	 */
	public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
	{
		if (parent::test($element, $value, $group, $input, $form))
		{
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select($db->quoteName('id'))->from($db->quoteName('#__users'))->where(array($db->quoteName('id') => $db->quote($value)));
			$db->setQuery($query);

			return is_null($db->loadResult()) ? false : true;
		}

		return false;
	}
}
