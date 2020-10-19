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

JLoader::import('views.worklog.general', JPATH_COMPONENT_SITE);

class TimeWorkedViewDashboard extends JViewLegacy
{

    public function __construct($config = array()) {
        parent::__construct($config);
        $this->loadHelper('ACLHelper');
        $this->loadHelper('TimeWorkedHelper');
        $this->worklogModel = JModelLegacy::getInstance('WorkLog', 'TimeWorkedModel');
		
    }
	/**
	 * Execute and display a template script.
	 *
	 * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 */
	public function display($tpl = null)
	{
        $graphMonths = 2;
        $fromDate = mktime(date('H'),date('i'),date('s'),date('m') - $graphMonths);
        $this->graphDays = round( (time() - $fromDate) / 86400 );
        
        $grandAccess = ACLHelper::canManageAllReports();
        $this->canSeeEmployeesTab = $grandAccess;
        $this->canSeeProjectsTab  = $grandAccess || ACLHelper::canManageAssignedReports();
        
        $userId = JFactory::getUser(null)->get('id');
        
        $this->mytimeStats        = $this->worklogModel->getStatByEmployee($userId);
        $this->mytimeProjectStats = $this->worklogModel->getStatByProject($userId);
        $this->mytimeChartsData   = $this->worklogModel->getGraphData($fromDate, $userId);
        
        $this->activeTab = $this->canSeeEmployeesTab ? 1 : ($this->canSeeProjectsTab ? 2 : 3);
                
        if ($this->canSeeEmployeesTab) {
            $this->employeesStats = $this->worklogModel->getStatByEmployee();
        }
        
        if ($this->canSeeProjectsTab) {
            if ($grandAccess) {
                $this->projectsStats = $this->worklogModel->getStatByProject(false, false);
                $this->projectsChartsData = $this->worklogModel->getGraphData($fromDate, false, false);
            } else {
                $this->projectsStats = $this->worklogModel->getStatByProject($userId, false);
                $this->projectsChartsData = $this->worklogModel->getGraphData($fromDate, $userId, false);
            }
        }
        
        $this->worklogMenuItemId = false;
        
        $menu = JMenu::getInstance('site')->getMenu();
        if ($menu && count($menu)) {
            foreach ($menu as $item) {
                if (strpos($item->link, 'view=worklog') !== false) {
                    $this->worklogMenuItemId = $item->id;
                    break;
                }
            }
        }
        
        TimeWorkedHelper::setDocument(JText::_('COM_TIMEWORKED_DASHBOARD'), $this->baseurl);
        
        parent::display($tpl);
	}
}
