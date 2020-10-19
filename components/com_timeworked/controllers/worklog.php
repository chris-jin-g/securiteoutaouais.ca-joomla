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

class TimeWorkedControllerWorklog extends JControllerLegacy
{
	public function __construct($config = array())
	{
		JLoader::register('DateFormatterHelper', JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'dateformatterhelper.php');
		parent::__construct($config);
	}

	public function display($cachable = false, $urlparams = array())
	{
		if (JFactory::getApplication()->input->getBool('ajax', false))
		{
			jexit();
		}
		JFactory::getApplication()->input->set('view', 'worklog');
		parent::display($cachable, $urlparams);
	}

	/**
	 * Get list of events is json format
	 */
	public function getEvents()
	{
		$model = JModelLegacy::getInstance('WorkLog', 'TimeWorkedModel');
		echo json_encode($model->getEvents());
		jexit();
	}

	public function getData()
	{
		/**
		 * @var $model TimeWorkedModelWorkLog
		 */
		$model = JModelLegacy::getInstance('WorkLog', 'TimeWorkedModel');
		$id    = JFactory::getApplication()->input->post->getInt('id');
		$data  = $model->getTableItems($id);

		JLoader::register('ACLHelper', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'aclhelper.php');
		$canDelete = ACLHelper::canDelete();
		$canManage = ACLHelper::canManageAllReports() || ACLHelper::canManageAssignedReports();

		foreach ($data as &$item)
		{
			if (!$canManage)
			{
				unset($item->user_name);
			}

			if (ACLHelper::canEditItem($item->userid))
			{
				$item->edit_url = JRoute::_('index.php?option=com_timeworked&view=workentry&task=edit&id=' . $item->id);
			}

			if ($canDelete)
			{
				$item->delete_url = JRoute::_('index.php?option=com_timeworked&view=workentry&task=delete&id=' . $item->id);
			}

			if ($canManage)
			{
				$item->reject_url   = JRoute::_('index.php?option=com_timeworked&view=workentry&task=markAsRejected&id=' . $item->id);
				$item->billable_url = JRoute::_(
					'index.php?option=com_timeworked&view=workentry&task=setNotBillable&id=' . $item->id .
					'&status=' . ($item->billable ? 'billable' : 'not-billable')
				);
			}

			unset($item->clientid);
			unset($item->userid);
			unset($item->timeworkedid);
			$item->performed_work = nl2br($item->performed_work);
			$item->date_mysql     = DateFormatterHelper::toMySQLFormat((int) $item->date);
			$item->date           = DateFormatterHelper::format((int) $item->date);
		}

		echo json_encode(array(
			'data'        => $data,
			'start'       => $model->getState('list.start'),
			'paginator'   => $model->getPagination()->getPages(),
			'time_total'  => $model->getSummaryHours(),
			'time_page'   => $model->getSummaryPageHours(),
			'display_all' => $model->isDisplayedAll()
		));
		jexit();
	}

	public function getProjects()
	{
		$clientId = JFactory::getApplication()->input->post->getInt('id');
		/**
		 * @var TimeWorkedModelProject $projectModel client model
		 */
		$projectModel = JModelLegacy::getInstance('Project', 'TimeWorkedModel');

		echo json_encode($projectModel->getProjectsByClientId($clientId));
		jexit();
	}

	public function getReportTasks()
	{
		$projectId = JFactory::getApplication()->input->post->getInt('projectid');
		/**
		 * @var TimeWorkedModelProject $projectModel client model
		 */
		$taskModel = JModelLegacy::getInstance('Task', 'TimeWorkedModel');

		echo json_encode($taskModel->getTasksByProjectId($projectId));
		jexit();
	}

	public function getDateRanges()
	{
		JLoader::register('DateRangeListHelper', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'daterangelisthelper.php');

		/**
		 * @var $model TimeWorkedModelWorkLog
		 */
		$model  = JModelLegacy::getInstance('WorkLog', 'TimeWorkedModel');
		$jinput = JFactory::getApplication()->input;

		echo json_encode(DateRangeListHelper::getMonthList($model->getDatePeriods($jinput->getInt('filter_client'), $jinput->getInt('filter_project'))));
		jexit();
	}

	public function isNotBillableHours()
	{
		JLoader::register('ACLHelper', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'aclhelper.php');

		if (ACLHelper::canManageAllReports())
		{
			/**
			 * @var $model TimeWorkedModelWorkLog
			 */
			$model = JModelLegacy::getInstance('WorkLog', 'TimeWorkedModel');

			echo json_encode($model->getIsNotBillableHours() && (JComponentHelper::getParams('com_timeworked')->get('not_billable_hours') == 1));
		}

		jexit();
	}

	public function setRejected()
	{
		$jInput = JFactory::getApplication()->input;
		JLoader::register('ACLHelper', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'aclhelper.php');

		/**
		 * @var $model TimeWorkedModelWorkLog
		 */
		$model = JModelLegacy::getInstance('WorkLog', 'TimeWorkedModel');

		if ($jInput->getBool('ajax'))
		{
			if (ACLHelper::canManageAllReports())
			{
				$user = JFactory::getUser($jInput->getUint('id', 0));

				if ($user)
				{
					$ids     = $jInput->get('ids', array(), 'array');
					$comment = $jInput->getString('comment', null);

					if ($model->setRejected($ids, $user->get('id'), $comment))
					{
						$send = $model->sendEmail($ids, $user, $comment);

						echo json_encode($send == true ? array('status' => 'ok') : array('error' => $send->__toString()));
					}
					else
					{
						echo json_encode(array('error' => JText::_('COM_TIMEWORKED_DATABASE_EXECUTE_ERROR')));
					}
				}
				else
				{
					echo json_encode(array('error' => JText::_('JERROR_USERS_PROFILE_NOT_FOUND')));
				}
			}
			else
			{
				echo json_encode(array('error' => JText::_('JGLOBAL_AUTH_ACCESS_DENIED')));
			}

			jexit();
		}
	}
}
