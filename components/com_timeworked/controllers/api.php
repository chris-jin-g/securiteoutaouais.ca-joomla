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

/**
 * RESTful API end point controller.
 * 
 * Auth URL: <joomla host>/index.php?option=com_timeworked&view=api&task=auth <br>
 * End point URL: <joomla host>/index.php?option=com_timeworked&view=api&target=<target> <br>
 * Accepts the following targets: report, project, task, type (time worked tipe).
 * 
 * <b>Authentication:</b>
 * 
 * Two mandatory input params are required to be sent for logging in <i>{"username" : "admin", "password" : "111"}</i>.<br>
 * Both GET and POST should work for authentication. However it is strongly recommended to use POST.<br>
 * Send <i>{"logout" : "1"}</i> in order to terminate the session
 * 
 * 
 * <b>Actions:</b>
 * 
 * GET                          - retrieve list of items of specified target (works for every target)
 * <ul>
 *     <li>Returns reports the current user has access to;</li>
 *     <li>Returns projects the current user is linked to;</li>
 *     <li>Returns tasks linked to a specified project (<b>project_id</b> parameter is mandatory);</li>
 *     <li>Returns all time worked types existed.</li>
 * </ul>
 * GET + <b>id</b> parameter    - retrieve a particular item (works only for reports)
 * 
 * POST                         - create/edit an item (works only for reports). If "id" parameter is specified in the POST data, 
 * 
 * DELETE + <b>id</b> parameter - remove item (works only for reports)
 */
class TimeWorkedControllerApi extends JControllerLegacy
{
    const API_ERROR_UNAUTHENTICATED = 1;
    const API_ERROR_UNAUTHORIZED = 2;
    const API_ERROR_INCORRECT_TARGET = 3;
    const API_ERROR_ACTION_IS_NOT_PERMITTED = 4;
    const API_ERROR_OBJECT_ID_NOT_SPECIFIED = 5;
    const API_ERROR_PROJECT_ID_IS_MANDATORY = 6;
    const API_ERROR_LOGIN_FAILED = 7;
    const API_ERROR_LOGOUT_FAILED = 8;
    const API_ERROR_AUTH_CREDENTIALS_EMPTY = 9;
    const API_ERROR_API_DISABLED = 11;
    const API_ERROR_OTHER = 1000;

    protected $listPage = 1;
    
    protected $listPageSize = 20;
    
    protected $objectId = null;
    
    protected $postData = null;

    public function display($cachable = false, $urlparams = array())
	{
        JLoader::register('FormHelper', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'formhelper.php');
        JLoader::register('ACLHelper', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'aclhelper.php');
        
        $response = array();
        
        try {
            $response['result'] = $this->dispatch();
        } catch (Exception $ex) {
            $response['error'] = array('message' => $ex->getMessage(), 'code' => $ex->getCode());
        }
        echo json_encode($response);
        
        JFactory::getApplication()->close();
	}

    public function dispatch()
    {
        $app    = JFactory::getApplication();
        $method = $app->input->server->get('REQUEST_METHOD','','STRING');
        $target = $app->input->get->get('target', '', 'STRING');
        $source = $app->input->get->get('source', '', 'STRING');
        if($source === 'plugin'){
            $apiEnabled =  (bool) JComponentHelper::getParams('com_timeworked')->get('api_enabled',0);
            if(!$apiEnabled){
                throw new Exception(JText::_('TW_API_API_DISABLED'), self::API_ERROR_API_DISABLED);
            }
            $config = JFactory::getConfig();
            $config->set('requestSource','plugin');
        }
        $this->objectId = $app->input->get('id', null, 'INT');
        $result = null;
        $user = JFactory::getUser();
        
        if ($app->input->get('task') === 'auth') {
            return $this->authentication();
        }
        
        $allowedTargets = array(
            'report'  => array('model' => 'WorkLog'),
            'project' => array('model' => 'Project'),
            'task'    => array('model' => 'Task'),
            'type'    => array('model' => 'Timeworkedtype'),
        );
        
        if (!isset($allowedTargets[$target])) {
            throw new Exception(JText::_('TW_API_INCORRECT_TARGET'), self::API_ERROR_INCORRECT_TARGET);
        }
        
        if (!$user || $user->guest) {
            throw new Exception(JText::_('TW_API_UNAUTHENTICATED'), self::API_ERROR_UNAUTHENTICATED);
        }

        if ($app->input->get('task') === 'missed') {
            $isPluginRequest =  ($source === 'plugin') ? true : false;
            return $this->getMissedDates($isPluginRequest);
        }
        
        switch ($method) {
            case 'GET' : 
                if ($this->objectId) {
                    $action = 'view';
                } else {
                    $this->listPage     = $app->input->get('page', 1, 'INT');
                    $this->listPageSize = $app->input->get('size', 20, 'INT');
                    $action = 'list';
                }
                break;
                
            case 'POST' : 
            case 'PUT' :
                $action = 'edit';
                $this->postData = $app->input->post->getArray();
                break;
                
            case 'DELETE' : 
                if (!$this->objectId) {
                    throw new Exception(JText::_('TW_API_OBJECT_ID_NOT_SPECIFIED'), self::API_ERROR_OBJECT_ID_NOT_SPECIFIED);
                }
                $action = 'delete';
                break;
                
            default : return $result;
        }
        
        $methodName = $action . ucfirst($target);
        if (method_exists($this, $methodName)) {
            $result = $this->{$methodName}();
        } else {
            throw new Exception(JText::_('TW_API_ACTION_IS_NOT_PERMITTED'), self::API_ERROR_ACTION_IS_NOT_PERMITTED);
        }
        
        return $result;
    }
    
    protected function authentication() 
    {
        $app = JFactory::getApplication();
        $username    = $app->input->get('username');
        $password = $app->input->get('password',null,'trim');
        $logout   = $app->input->get('logout');
        $remember  = ($app->input->get('remember') === 'true');
        if ($logout) {
            $res = $app->logout();
            if ($res) {
                return JText::_('TW_API_LOGOUT_SUCCESS');
            } else {
                throw new Exception(JText::_('TW_API_LOGOUT_FAILED'), self::API_ERROR_LOGOUT_FAILED);
            }
        } else {
            if (empty($username) || empty($password)) {
                throw new Exception(JText::_('TW_API_AUTH_CREDENTIALS_EMPTY'), self::API_ERROR_AUTH_CREDENTIALS_EMPTY);
            }
            $res = $app->login(array(
                'username' => $username,
                'password' => $password,
            ),array(
              'remember' => $remember
            ));
            
            if ($res) {
                return array(
                    'message' => JText::_('TW_API_LOGIN_SUCCESS'),
                    'username' => JFactory::getUser()->name,
                    'useremail' => JFactory::getUser()->email,
                );
            } else {
                throw new Exception(JText::_('TW_API_LOGIN_FAILED'), self::API_ERROR_LOGIN_FAILED);
            }
        }
        
    }
    
    protected function viewReport() 
    {
        $canView = ACLHelper::userItem($this->objectId) 
                || ACLHelper::canManageAllReports() 
                || ACLHelper::canManageAssignedReports() 
                || ACLHelper::isAdmin();
        
        if (!$canView) {
            throw new Exception(JText::_('TW_API_UNAUTHORIZED'), self::API_ERROR_UNAUTHORIZED);
        }
        
        $model = $this->getModel('WorkLog');
        return $model->getItem($this->objectId);
    }

    protected function listReport()
    {
        $model = $this->getModel('WorkLog');
        // this line looks useless. However it triggers JModelList::populateState()
        // in order to prevent overriding of state parameters further
        $model->getState('list.limit');
        $model->setState('list.limit', $this->listPageSize);
        $model->setState('list.start', ($this->listPage - 1) * $this->listPageSize);
        // available filters
        $allowedFilters = array('date_month', 'project', 'client', 'task');
        $user = JFactory::getUser();
        $config = JFactory::getConfig();
        $isPluginRequest = ($config->get('requestSource') == 'plugin');

        foreach ($allowedFilters as $filterName) {
            $inp = JFactory::getApplication()->input->get($filterName, null);
            if (!empty($inp)) {
                $model->setState('filter.' . $filterName, $inp);
            }
        }
        if($isPluginRequest){
            if(ACLHelper::canManageAllReports($user->id)){
                $model->setState('filter.staff', $user->id);
            }
        }

        // ordering
        $allowedOrderings = array('project_name', 'date', 'company', 'task');
        $order = JFactory::getApplication()->input->get('order', null);
        $dir   = strtolower(JFactory::getApplication()->input->get('dir', 'asc'));
        if ($dir !== 'asc' && $dir !== 'desc') {
            $dir = 'asc';
        }
        if (!empty($order) && in_array($order, $allowedOrderings)) {
            $model->setState('list.ordering', $order);
            $model->setState('list.direction', $dir);
        }


        return array(
          'items'       => $model->getItems(),
          'pages_total' => ceil($model->getTotal() / $this->listPageSize),
          'time_total'  => $model->getSummaryHours(),
        );
    }
    protected function editReport()
    {
        $reportId = isset($this->postData['id']) ? $this->postData['id'] : null;
        if ($reportId) {
            $canEdit = (ACLHelper::userItem($reportId) && ACLHelper::canEditOwn()) || ACLHelper::canEdit();
        } else {
            $canEdit = ACLHelper::canCreate();
        }

        if (!$canEdit) {
            throw new Exception(JText::_('TW_API_UNAUTHORIZED'), self::API_ERROR_UNAUTHORIZED);
        }
        
        $form = FormHelper::getWorkentryForm();
        $model = $this->getModel('WorkEntry', 'TimeWorkedModel');
        
        $acceptibleFields = array('id', 'projectid', 'performed_work', 'timeworkedid', 'taskid', 'task', 'date', 'from', 'to', 'time', 'ticket_numbers');
        $data = $this->postData;
        foreach ($data as $field => $val) {
            if (!in_array($field, $acceptibleFields)) {
                unset($data[$field]);
            }
        }
        
        $data['userid'] = JFactory::getUser()->id;
        
        if (!empty($data['id'])) {
            $item = $model->getItem($data['id']);
            if ($item) {
                $data['userid'] = $item->userid;
            } 
        }
        
        if (!$form->validate($data)) {
            $errors = $form->getErrors();
            $errArr = array();
            foreach ($errors as $re) {
                $errArr[] = $re->getMessage();
            }
            throw new Exception(implode(",\n", $errArr), self::API_ERROR_OTHER);
        }

        $form->bind($data);

        if (!$model->store($form)) {
            throw new Exception($model->getStoreErrors(), self::API_ERROR_OTHER);
        }
        return true;
    }
    
    protected function deleteReport()
    {
        $canDelete = (ACLHelper::userItem($this->objectId) && ACLHelper::canDelete()) || ACLHelper::isAdmin();
        
        if (!$canDelete) {
            throw new Exception(JText::_('TW_API_UNAUTHORIZED'), self::API_ERROR_UNAUTHORIZED);
        }
        
        $model = $this->getModel('WorkLog');
        return $model->getTable('', 'TimeWorkedTable')->delete($this->objectId);
    }
    
    protected function listProject()
    {
        $model = $this->getModel('Project');
        // this line looks useless. However it triggers JModelList::populateState() 
        // in order to prevent overriding of state parameters further
        $model->getState('list.limit');
        $model->setState('list.limit', $this->listPageSize);
        $model->setState('list.start', ($this->listPage - 1) * $this->listPageSize);
        
        return array(
            'items' => $model->getProjects(),
            'pages_total' => ceil($model->getTotal() / $this->listPageSize),
        );
    }
    
    protected function listTask()
    {
        $model = $this->getModel('Task');
        $model->getState('list.limit');
        $model->setState('list.start', ($this->listPage - 1) * $this->listPageSize);
        $model->setState('list.limit', $this->listPageSize);
        
        $projectId = JFactory::getApplication()->input->get('project_id');
        if (!$projectId) {
            throw new Exception(JText::_('TW_API_PROJECT_ID_IS_MANDATORY'), self::API_ERROR_PROJECT_ID_IS_MANDATORY);
        }
        $items = $model->getTasksByProjectId($projectId);
        return array(
            'items' => $items,
            'page_totals' => ceil(count($items) / $this->listPageSize),
        );
    }
    
    protected function listType()
    {
        $model = $this->getModel('Timeworkedtype');
        // this line looks useless. However it triggers JModelList::populateState() 
        // in order to prevent overriding of state parameters further
        $model->getState('list.limit');
        $model->setState('list.limit', $this->listPageSize);
        $model->setState('list.start', ($this->listPage - 1) * $this->listPageSize);
        
        return array(
            'items' => $model->getItems(),
            'page_totals' => ceil($model->getTotal() / $this->listPageSize),
        );
    }

     protected function getMissedDates($isPluginRequest){
        $config = JFactory::getConfig();
        if (JComponentHelper::getParams('com_timeworked')->get('missing_reports_automated_notifications') == '1')
        {

            JLoader::register('Missed', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'missed.php');

            $Missed = new Missed($isPluginRequest);
            $dates =  $Missed->run();
            return array(
              'items'       => array_keys($dates)
            );
        }

        jexit();


    }
}
