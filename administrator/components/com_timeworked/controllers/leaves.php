<?php
/**
 * TimeWorked Leaves controller
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

class TimeWorkedControllerLeaves extends JControllerAdmin
{
	/**
	 * {@inheritdoc}
	 */
	public function getModel($name = 'leaves', $prefix = 'TimeWorkedModel', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}
    
    public function approve()
    {
        $cids = JFactory::getApplication()->input->get('cid', array(), 'array');
        $comment = JFactory::getApplication()->input->get('admin_comment', '', 'string');
        if (count($cids)) {
            $model = $this->getModel();
            foreach ($cids as $cid) {
                $model->changeStatus($cid, $model::$STATUS_APPROVED, $comment);
            }
        }
        
        $extension = $this->input->get('extension');
		$extensionURL = ($extension) ? '&extension=' . $extension : '';
		$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $extensionURL, false));
    }
    public function reject()
    {
        $cids = JFactory::getApplication()->input->get('cid', array(), 'array');
        $comment = JFactory::getApplication()->input->get('admin_comment', '', 'string');
        if (count($cids)) {
            $model = $this->getModel();
            foreach ($cids as $cid) {
                $model->changeStatus($cid, $model::$STATUS_REJECTED, $comment);
            }
        }
        
        $extension = $this->input->get('extension');
		$extensionURL = ($extension) ? '&extension=' . $extension : '';
		$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $extensionURL, false));
    }
}
