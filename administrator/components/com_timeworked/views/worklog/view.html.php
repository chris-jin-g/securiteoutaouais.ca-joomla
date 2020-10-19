<?php
/**
 * Work log view
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

class TimeWorkedViewWorkLog extends JViewLegacy
{
	protected $worklog;
	protected $pagination;
	protected $state;
	protected $user;

	/**
	 * {@inheritdoc}
	 */
	public function display($tpl = null)
	{
		$this->loadHelper('dateformatterhelper');
		$this->loadHelper('TimeWorkedHelper');

		$params = JComponentHelper::getParams('com_timeworked');

		$this->worklog        = $this->get('Items');
		$this->pagination     = $this->get('Pagination');
		$this->state          = $this->get('State');
		$this->listOrder      = $this->state->get('list.ordering');
		$this->listDirn       = $this->state->get('list.direction');
		$this->user           = JFactory::getUser();
		$this->projects       = $this->get('Projects');
		$this->staff          = $this->get('Staff');
		$this->enabledTickets = $params->get('enabled_ticket_number');

		TimeWorkedHelper::setDocument(JText::sprintf('COM_TIMEWORKED_WORK_LOG'));
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
		$canDo = TimeWorkedHelper::getActions('workentry');

		if ($canDo->get('core.create') || (count($this->user->getAuthorisedCategories('com_timeworked', 'core.create'))) > 0)
		{
			JToolBarHelper::addNew('workentry.add');
		}

		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
		{
			JToolBarHelper::editList('workentry.edit');
		}

		if ($canDo->get('core.delete'))
		{
			JToolBarHelper::divider();

			if ($canDo->get('core.delete'))
			{
				JToolBarHelper::deleteList('COM_TIMEWORKED_DELETE_QUERY_STRING', 'worklog.delete', 'JTOOLBAR_DELETE');
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
