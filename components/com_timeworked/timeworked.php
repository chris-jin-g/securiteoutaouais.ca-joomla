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

JForm::addFormPath(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms');
JLoader::register('Pagination', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'pagination.php');
JLoader::register('LeavesPagination', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'leavespagination.php');

$view = JFactory::getApplication()->input->getString('view', 'worklog');
require_once JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . $view . '.php';

$controllerClass = 'TimeWorkedController' . ucfirst($view);
$controller      = new $controllerClass();
$controller->execute(JFactory::getApplication()->input->getCmd('task', 'display'));
$controller->redirect();