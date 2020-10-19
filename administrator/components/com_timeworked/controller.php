<?php
/**
 * Controller
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

class TimeWorkedController extends JControllerLegacy
{
	/**
	 * {@inheritdoc}
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$this->default_view = 'worklog';
		$this->addSubmenu(JFactory::getApplication()->input->getCmd('view', ''));
		parent::display($cachable, $urlparams);
	}

	/**
	 * Method to add submenu on the page
	 *
	 * @param   String $vName Name of selected view
	 */
	public function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(JText::_('COM_TIMEWORKED_SUBMENU_WORK_LOG'), 'index.php?option=com_timeworked&view=worklog', $vName == 'worklog');
		JHtmlSidebar::addEntry(JText::_('COM_TIMEWORKED_SUBMENU_USERS'), 'index.php?option=com_timeworked&view=users', $vName == 'users');
		JHtmlSidebar::addEntry(JText::_('COM_TIMEWORKED_SUBMENU_PROJECTS'), 'index.php?option=com_timeworked&view=projects', $vName == 'projects');
		JHtmlSidebar::addEntry(JText::_('COM_TIMEWORKED_SUBMENU_CLIENTS'), 'index.php?option=com_timeworked&view=clients', $vName == 'clients');
		if (JComponentHelper::getParams('com_timeworked')->get('enabled_tasks_list')) {
            JHtmlSidebar::addEntry(JText::_('COM_TIMEWORKED_SUBMENU_TASKS'), 'index.php?option=com_timeworked&view=tasks', $vName == 'tasks');
        }
		JHtmlSidebar::addEntry(JText::_('COM_TIMEWORKED_SUBMENU_LEAVES'), 'index.php?option=com_timeworked&view=leaves', $vName == 'leaves');
		JHtmlSidebar::addEntry(JText::_('COM_TIMEWORKED_SUBMENU_TIME_WORKED_TYPES'), 'index.php?option=com_timeworked&view=timeworkedtypes', $vName == 'timeworkedtypes');
		JHtmlSidebar::addEntry(JText::_('COM_TIMEWORKED_SUBMENU_LEAVE_TYPES'), 'index.php?option=com_timeworked&view=leave_types', $vName == 'leave_types');
		JHtmlSidebar::addEntry(JText::_('JTOOLBAR_OPTIONS'), 'index.php?option=com_config&amp;view=component&amp;component=com_timeworked');
	}
    
    public function getTasksList()
    {
        $jinput = JFactory::getApplication()->input;

		if ($jinput->getMethod() === 'POST')
		{
            $projectId = $jinput->getInt('projectid');
            $model = $this->getModel('workentry', 'TimeWorkedModel');
            echo json_encode($model->getTasksList($projectId));
        }
        jexit();
    }
}
