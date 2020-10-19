<?php
/**
 * Client field type
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
JFormHelper::loadFieldClass('list');

class JFormFieldClient extends JFormFieldList
{
	/**
	 * {@inheritdoc}
	 */
	protected $type = 'client';

	/**
	 * {@inheritdoc}
	 */
	protected function getOptions()
	{
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true)
			->select($db->quoteName(array('id', 'company'), array('value', 'text')))
			->select('UPPER(' . $db->quoteName('company') . ') AS ' . $db->quoteName('sort'))
			->from($db->quoteName('#__tw_clients'))
			->where(array(
                $db->qn('published') . '=' . $db->q('1'),
                $db->qn('id') . '=' . $db->q($this->value)
            ), 'OR')
			->order($db->quoteName('sort') . ' ASC');
		$db->setQuery($query);
		$options = $db->loadObjectList();
        
        // prepend empty option
        $defaultOption = new stdClass();
        $defaultOption->value = '';
        $defaultOption->text = '';
        $defaultOption->sort = '';
        array_splice($options, 0, 0, array($defaultOption));

		return $options;
	}
}
