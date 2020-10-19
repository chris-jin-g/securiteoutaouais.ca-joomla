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

class FormHelper
{
	public static function getWorkentryForm()
	{
		$workentryModel = JModelLegacy::getInstance('WorkEntry', 'TimeWorkedModel');
		$form           = JForm::getInstance('workentry', 'workentry', array('control' => $workentryModel->getFormGroupId()));

		if (!JComponentHelper::getParams('com_timeworked')->get('required_ticket_numbers'))
		{
			$form->setFieldAttribute('ticket_numbers', 'required', 'false');
		}
		if (!JComponentHelper::getParams('com_timeworked')->get('required_performed_work'))
		{
			$form->setFieldAttribute('performed_work', 'required', 'false');
		}
        if (!JComponentHelper::getParams('com_timeworked')->get('enabled_tasks_list')){
            $form->removeField('taskid');
        } else {
            $form->setFieldAttribute('task', 'required', 'false');
            $form->setFieldAttribute('task', 'type', 'hidden');
            if ($form->getValue('projectid')) {
                $form->setFieldAttribute('taskid', 'projectid', $form->getValue('projectid'));
            }
        }

		if (!JComponentHelper::getParams('com_timeworked')->get('enabled_ticket_number'))
		{
			$form->removeField('ticket_numbers');
		}

		return $form;
	}
}
