<?php
/**
 * TimeWorked Work entry controller
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

require __DIR__ . '../../lib/twilio-php-master/src/Twilio/autoload.php';
use Twilio\Rest\Client;

class TimeWorkedControllerWorkEntry extends JControllerForm
{
    
	/**
	 * {@inheritdoc}
	 */
	public function __construct($config = array())
	{
        $this->view_list = 'worklog';
        parent::__construct($config);
	}
    
    public function edit($key = null, $urlVar = null) {
        $report_id = $this->input->get->get('id', 'xxx', 'string');
        $session = JFactory::getSession();
        $session->set('edit_report_id', $report_id);
        parent::edit($key, $urlVar);        
    }

    public function add() 
    {
        $session = JFactory::getSession();
        $session->set('edit_report_id', '');
        parent::add();
    }
    
    public function save($key = null, $urlVar = null) 
    {
        $data  = $this->input->post->get('jform', array(), 'array');

        $session = JFactory::getSession();        
        $edit_report_id = $session->get('edit_report_id');       
        
        if (empty($data['task']) && !empty($data['taskid'])) {
            $taskModel = $this->getModel('Task', 'TimeWorkedModel');
            $task = $taskModel->getItem($data['taskid']);
            $data['task'] = $task->task;

            $this->input->post->set('jform', $data);
        }

        $report_date = explode(" ", $data['from'])[0].'%';

        if($edit_report_id === '') {
            $this->projectSameDate = $this->getModel()->getAddProjectSameDate($data['userid'], $report_date);
        } else {
            $this->projectSameDate = $this->getModel()->getEditProjectSameDate($data['userid'], $report_date, $edit_report_id);
        }

        $this->email = $this->getModel()->getUserName($data['userid'])[0]->email;

        $this->projectName = $this->getModel()->getProjectName($data['projectid'])[0]->text;
        $this->userName = $this->getModel()->getUserName($data['userid'])[0]->name;
        $this->smsOption = $this->getModel()->getSMSOption($data['userid'])[0]->smsOption;
        $this->userPhone = '+' . $this->getModel()->getUserName($data['userid'])[0]->phone;
        $this->projectManager = $this->getModel()->getProjectManager($data['projectid'])[0];
       
        if(sizeOf($this->projectSameDate) > 0) {
            JError::raiseError( 4711, 'This employee is already schedule at Job: '.$this->projectName. ' on ' .explode(" ", $data['from'])[0] );
            parent::edit($key, $urlVar);
        } else {
            $this->sendEmailNotification(
                $this->email, 
                $data, 
                $this->userName, 
                $this->projectName, 
                $this->projectManager
            );
    
            parent::save($key, $urlVar);
        }
        
    }

    

    public function sendEmailNotification($email, $data, $username, $projectName, $projectManager)
    {
        $app = JFactory::getApplication();
        $mailer = JFactory::getMailer();

        $mailfrom = $app->get('mailfrom');
		$fromname = $app->get('fromname');
        $sitename = $app->get('sitename');

        $mailer->setSender(array($mailfrom, $fromname));

        $mailer->addRecipient($email);

        $mailer->setSubject('Project assignment');

        $body = PHP_EOL .
            JText::_('COM_TIMEWORKED_SMS_HEADER') . PHP_EOL . 
            JText::_('COM_TIMEWORKED_SMS_USERNAME') . $username . PHP_EOL . 
            JText::_('COM_TIMEWORKED_SMS_PROJECTNAME') . $projectName . PHP_EOL .
            JText::_('COM_TIMEWORKED_SMS_TASKNAME') . $data['task'] . PHP_EOL .
            JText::_('COM_TIMEWORKED_SMS_WORKINGTIME') . $data['from'] . ' - ' . $data['to'] . PHP_EOL .
            JText::_('COM_TIMEWORKED_SMS_WORKINGHOURS') . $data['time'] . PHP_EOL .
            JText::_('COM_TIMEWORKED_SMS_PHONE') . PHP_EOL . $mailfrom;

        $mailer->setBody($body);

        $send = $mailer->Send();
        if ( $send !== true ) {
            echo 'Error sending email: ';
        } else {
            echo 'Mail sent';
        }

        return 'success';
    }    
}