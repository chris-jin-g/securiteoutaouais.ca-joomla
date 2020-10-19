<?php
/**
 * Users view
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

class TimeWorkedViewLeave_Types extends JViewLegacy
{
	/**
	 * Display the view
	 *
	 * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
        $this->loadHelper('TimeWorkedHelper');
        
		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state      = $this->get('State');

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

		JToolBarHelper::addNew('leave_type.add');
		JToolBarHelper::editList('leave_type.edit');
		JToolBarHelper::deleteList(JText::_('COM_TIMEWORKED_LEAVE_TYPE_DELETE_CONFIRM'), 'leave_types.delete');
        
        $canDo = TimeWorkedHelper::getActions('leave_type');
        if ($canDo->get('core.admin'))
        {
            JToolBarHelper::preferences('com_timeworked');
            JToolBarHelper::divider();
        }
	}
}
