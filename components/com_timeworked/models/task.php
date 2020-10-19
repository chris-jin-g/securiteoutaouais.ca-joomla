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
jimport('joomla.application.component.modelitem');

/**
 * @property JDatabaseDriver $_db DB connector
 */
class TimeWorkedModelTask extends JModelList
{
	/**
	 * Model context string.
	 *
	 * @access    protected
	 * @var        string
	 */
	protected $_context = 'com_timeworked.task';

	/**
	 * Method to get an ojbect.
	 *
	 * @param integer The id of the object to get.
	 */
	public function getItem($id = null)
	{
		if ($this->_item === null)
		{
			$this->_item = false;

			if (empty($id))
			{
				$id = $this->getState('task.id');
			}

			$table = JTable::getInstance('Tasks', 'TimeWorkedTable');

			if ($table->load($id))
			{
				$properties  = $table->getProperties(1);
				$this->_item = JArrayHelper::toObject($properties, 'JObject');
			}
			elseif ($error = $table->getError())
			{
				$this->setError($error);
			}
		}

		return $this->_item;
	}

	/**
	 * Get Tasks by Project id
	 *
	 * @param   int $projectId project id
	 *
	 * @return array
	 */
	public function getTasksByProjectId($projectId = 0)
	{
		JLoader::register('ACLHelper', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'aclhelper.php');
        
		$query = $this->_db->getQuery(true)
                ->select('t.*')
                ->from($this->_db->qn('#__tw_tasks') . ' AS t')
                ->where('t.published = 1');
        
        if ($projectId) {
            $query->innerJoin($this->_db->qn('#__tw_projects_have_tasks') . ' AS pt ON (t.id = pt.taskid)')
                  ->where('pt.projectid = ' . $this->_db->q($projectId));
        }

		$this->_db->setQuery($query);

		return $this->_db->loadObjectList();
	}
}
