<?php
/**
 * TimeWorked Clients controller
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

class TimeWorkedControllerClients extends JControllerAdmin
{
	/**
	 * {@inheritdoc}
	 */
	public function getModel($name = 'client', $prefix = 'TimeWorkedModel', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}

    public function publish() {
        parent::publish();
        
        $task = $this->getTask();
        
        if ($task === 'unpublish') 
        {
            $cids = JFactory::getApplication()->input->get('cid', array(), 'array');
            if (count($cids)) {
                $projectModel = $this->getModel('projects');
                foreach ($cids as $cid) {
                    $projectModel->unpublishProjectsByClient($cid);
                }
            }
        }
    }
}
