<?php
/**
 * TimeWorked User controller
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

class TimeWorkedControllerUser extends JControllerForm
{
	/**
	 * Store user projects
	 *
	 * @param   string $key    The name of the primary key of the URL variable.
	 * @param   string $urlVar The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	 *
	 * @return void
	 */
	public function save($key = null, $urlVar = null)
	{
		JSession::checkToken() or die('Invalid Token');

		$input  = JFactory::getApplication()->input;
		$userId = $input->post->getUint('id');

		/**
		 * @var TimeWorkedModelUser $model model
		 */
		$model = $this->getModel();
		$model->store($userId, $input->post->get('projects', array(), 'array'));
		
		switch ($input->post->getCmd('task'))
		{
			case 'user.apply':
				$this->setRedirect('index.php?option=com_timeworked&view=user&id=' . $userId, JText::_('COM_TIMEWORKED_USER_PROJECTS_UPDATED'));
				break;
			default:
				$this->setRedirect('index.php?option=com_timeworked&view=users', JText::_('COM_TIMEWORKED_USER_PROJECTS_UPDATED'));
				break;
		}
	}

	/**
	 * Cancel action
	 *
	 * @param string $key The name of the primary key of the URL variable.
	 *
	 * @return void
	 */
	public function cancel($key = null)
	{
		$this->setRedirect('index.php?option=com_timeworked&view=users');
	}

	/**
	 * Edit action
	 *
	 * @param   string $key    The name of the primary key of the URL variable.
	 * @param   string $urlVar The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	 *
	 * @return void
	 */
	public function edit($key = null, $urlVar = null)
	{
		$cid      = JFactory::getApplication()->input->post->get('cid', array(), 'array');
		$recordId = (int) (count($cid) ? $cid[0] : $this->input->getInt($urlVar));

		$this->setRedirect('index.php?option=com_timeworked&view=user&id=' . $recordId);
	}

	/**
	 * Add new user
	 *
	 * @return void
	 */
	public function add()
	{
		$this->setRedirect('index.php?option=com_users&task=user.add');
	}
}
