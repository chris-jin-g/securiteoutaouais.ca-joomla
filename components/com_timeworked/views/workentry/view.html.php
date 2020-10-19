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

class TimeWorkedViewWorkentry extends JViewLegacy
{

	/**
	 * Execute and display a template script.
	 *
	 * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 */
	public function display($tpl = null)
	{
		$this->addHelperPath(JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers');
		$this->loadHelper('formhelper');

		$model = $this->getModel('WorkEntry', 'TimeWorkedModel');
		$form  = FormHelper::getWorkentryForm();

		$item = $model->getItem(JFactory::getApplication()->input->getInt('id'));

		if ($item === false)
		{
			JFactory::getApplication()->redirect(JRoute::_('index.php?option=com_timeworked&view=worklog'), JText::_('COM_TIMEWORKED_ERROR_ITEM_NOT_EXIST'), 'error');
		}

		$this->control = $model->getFormGroupId();
		if (JFactory::getApplication()->input->getMethod() === 'POST')
		{
			$this->postFormData = JFactory::getApplication()->input->post->getArray(array($this->control => $model->getFormFields()));
		}
		else
		{
			$form->bind($item);
			$this->postFormData = null;
		}

		$form->setFieldAttribute('date', 'readonly', 'false');
		$form->setFieldAttribute('date', 'type', 'calendar');

		$this->form = $form;

		$this->id = JFactory::getApplication()->input->getInt('id');

		$this->loadHelper('TimeWorkedHelper');
		TimeWorkedHelper::setDocument(JText::_('COM_TIMEWORKED_WORK_LOG'), $this->baseurl);

		parent::display($tpl);
	}
}
