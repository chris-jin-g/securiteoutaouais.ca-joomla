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

class TimeWorkedControllerUsers extends JControllerLegacy
{

	/**
	 * @var TimeWorkedModelUsers model
	 */
	private $model;

	public function __construct($config = array())
	{
		parent::__construct($config);
		$this->model = $this->getModel('Users', 'TimeWorkedModel');
	}

	public function getUsers()
	{
		$jInput = JFactory::getApplication()->input;
		echo json_encode($this->model->getUsers($jInput->getInt('filter_client'), $jInput->getInt('filter_project')));
		jexit();
	}
}
