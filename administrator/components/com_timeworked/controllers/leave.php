<?php
/**
 * TimeWorked Leave controller
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
jimport('joomla.application.component.controllerform');

class TimeWorkedControllerLeave extends JControllerForm
{
	public function approve()
	{
		if ($this->input->getMethod() === 'POST')
		{
			$model = $this->getModel();
			$cid   = $this->input->get->post->get('cid', null, 'array');
			$item  = $model->getItem($cid[0]);

			if ($item->status != '0')
			{
				$this->setRedirect(
					'index.php?option=com_timeworked&view=leaves',
					JText::_('COM_TIMEWORKED_ERROR_LEAVE_' . ($item->status == 1 ? 'APPROVED' : 'REJECTED')),
					'warning'
				);

				return;
			}

			$item->admin_commentary = $this->input->post->getString('admin_comment');
			$item->status           = 1;
			$model->save((array) $item);
		}

		$this->setRedirect('index.php?option=com_timeworked&view=leaves', JText::_('COM_TIMEWORKED_LEAVE_APPROVED'), 'message');
	}

	public function reject()
	{
		if ($this->input->getMethod() === 'POST')
		{
			$model = $this->getModel();
			$cid   = $this->input->get->post->get('cid', null, 'array');
			$item  = $model->getItem($cid[0]);

			if ($item->status != '0')
			{
				$this->setRedirect(
					'index.php?option=com_timeworked&view=leaves',
					JText::_('COM_TIMEWORKED_ERROR_LEAVE_' . ($item->status == 1 ? 'APPROVED' : 'REJECTED')),
					'warning'
				);

				return;
			}

			$item->admin_commentary = $this->input->post->getString('admin_comment');
			$item->status           = 2;
			$model->save((array) $item);
		}

		$this->setRedirect('index.php?option=com_timeworked&view=leaves', JText::_('COM_TIMEWORKED_LEAVE_REJECTED'), 'message');
	}
}
