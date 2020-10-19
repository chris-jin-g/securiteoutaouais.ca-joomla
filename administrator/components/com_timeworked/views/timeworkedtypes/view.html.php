<?php
/**
 * Time worked types view
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
jimport('joomla.application.component.view');

/**
 * View class for the list of time worked types
 */
class TimeWorkedViewTimeWorkedTypes extends JViewLegacy
{
	/**
	 * {@inheritdoc}
	 */
	public function display($tpl = null)
	{
		$this->timeworkedtypes = $this->get('Items');
		$this->pagination      = $this->get('Pagination');
		$this->state           = $this->get('State');
		$this->user            = JFactory::getUser();
		$this->loadHelper('TimeWorkedHelper');
		TimeWorkedHelper::setDocument();
		$this->_setToolBar();
		parent::display($tpl);
	}

	/**
	 * Method to add page title and toolbar
	 *
	 * @return  void
	 */
	protected function _setToolBar()
	{
		$this->sidebar = JHtmlSidebar::render();

		JToolBarHelper::title(JText::_('COM_TIMEWORKED'));
		$canDo = TimeWorkedHelper::getActions('timeworkedtype');

		if ($canDo->get('core.create') || (count($this->user->getAuthorisedCategories('com_timeworked', 'core.create'))) > 0)
		{
			JToolBarHelper::addNew('timeworkedtype.add');
		}

		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
		{
			JToolBarHelper::editList('timeworkedtype.edit');
		}

		if ($canDo->get('core.delete'))
		{
			JToolBarHelper::divider();

			if ($canDo->get('core.delete'))
			{
				JToolBarHelper::deleteList('COM_TIMEWORKED_DELETE_QUERY_STRING', 'timeworkedtypes.delete', 'JTOOLBAR_DELETE');
				JToolBarHelper::divider();
			}

			if ($canDo->get('core.admin'))
			{
				JToolBarHelper::preferences('com_timeworked');
				JToolBarHelper::divider();
			}
		}
	}
}
