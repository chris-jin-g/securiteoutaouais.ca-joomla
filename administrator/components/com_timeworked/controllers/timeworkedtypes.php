<?php
/**
 * TimeTime Worked worked types controller
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
jimport('joomla.application.component.controlleradmin');

class TimeWorkedControllerTimeWorkedTypes extends JControllerAdmin
{
	/**
	 * {@inheritdoc}
	 */
	public function getModel($name = 'timeworkedtypes', $prefix = 'TimeWorkedModel', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}

	/**
	 * Set default time worked type
	 */
	public function setDefault()
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$pks = $this->input->post->get('cid', array(), 'array');

		try
		{
			if (empty($pks))
			{
				throw new Exception(JText::_('COM_TIMEWORKED_NO_TIME_WORKED_TYPE_SELECTED'));
			}

			JArrayHelper::toInteger($pks);

			$id    = array_shift($pks);
			$model = $this->getModel();
			$model->setDefault($id);
			$this->setMessage(JText::_('COM_TIMEWORKED_SUCCESS_DEFAULT_TIME_WORKED_TYPE_SET'));
		} catch (Exception $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}

		$this->setRedirect('index.php?option=com_timeworked&view=timeworkedtypes');
	}

	/**
	 * Delete time worked type
	 */
	public function delete()
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$pks = $this->input->post->get('cid', array(), 'array');

		try
		{
			if (empty($pks))
			{
				throw new Exception(JText::_('COM_TIMEWORKED_NO_TIME_WORKED_TYPE_SELECTED'));
			}

			JArrayHelper::toInteger($pks);
            
            $timeTypeModel = $this->getModel('timeworkedtype');
            
            foreach ($pks as $pk) {
                $type = $timeTypeModel->getItem($pk);
                if ($type->default == '1') {
                    throw new Exception(JText::_('COM_TIMEWORKED_CANNOT_REMOVE_DEFAULT_TYPE'));
                }
            }
            
            $model = $this->getModel();

            foreach ($pks as $pk) {
                $model->delete($pk);
            }
            
			$this->setMessage(JText::_('COM_TIMEWORKED_SUCCESS_TIME_WORKED_TYPE_DELETED'));
		} catch (Exception $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}

		$this->setRedirect('index.php?option=com_timeworked&view=timeworkedtypes');
	}
}
