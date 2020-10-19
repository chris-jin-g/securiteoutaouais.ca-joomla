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
 * Work entry model class. Single entry of a work log.
 */
class TimeWorkedModelProject extends JModelList
{
	/**
	 * Model context string.
	 *
	 * @access    protected
	 * @var        string
	 */
	protected $_context = 'com_timeworked.project';

	/**
	 * Method to get an ojbect.
	 *
	 * @param integer The id of the object to get.
	 */
	public function getItem($id = null)
	{
		if (!isset($this->_item) || $this->_item === null)
		{
			$this->_item = false;

			if (empty($id))
			{
				$id = $this->getState('project.id');
			}

			$table = JTable::getInstance('Projects', 'TimeWorkedTable');

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
	 * Get projects by Client id
	 *
	 * @param   int $clientId client id
	 *
	 * @return array associative array with id and name
	 */
	public function getProjectsByClientId($clientId = 0)
	{
		JLoader::register('ACLHelper', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'aclhelper.php');

		$query = $this->getProjects(true);

		if ($clientId)
		{
			$query->leftJoin($this->_db->quoteName('#__tw_clients', 'clients') . ' ON '
				. $this->_db->quoteName('projects.clientid') . ' = ' . $this->_db->quoteName('clients.id'))
				->where($this->_db->quoteName('clients.id') . ' = ' . $this->_db->quote($clientId));
		}

		$this->_db->setQuery($query);

		return $this->_db->loadObjectList();
	}

	/**
	 * Method to get a list of projects, which have at least one work entry.
	 *
	 * @return  array|JDatabaseQuery   An object list of identifiers and names of projects or query
	 */
	public function getProjects($getQuery = false)
	{
		$query = $this->getListQuery();

		if ($getQuery)
		{
			return $query;
		}

		$this->_db->setQuery($query);

		return $this->_db->loadObjectList();
	}
    
    protected function getListQuery()
	{
		$query = $this->_db->getQuery(true)
			->select('DISTINCT(' . $this->_db->quoteName('projects.id') . ')')
			->select('UPPER(' . $this->_db->quoteName('projects.name') . ') AS ' . $this->_db->quoteName('project_upper_name'))
			->select($this->_db->quoteName('projects.name'))
			->from($this->_db->quoteName('#__tw_projects', 'projects'))
			->leftJoin($this->_db->quoteName('#__tw_users_have_projects', 'users_have_projects')
				. ' ON ' . $this->_db->quoteName('users_have_projects.projectid') . ' = ' . $this->_db->quoteName('projects.id'))
			->order($this->_db->quoteName('project_upper_name') . ' ASC');

		if (!ACLHelper::isAdmin() && !ACLHelper::canManageAllReports())
		{
			$query->where($this->_db->quoteName('users_have_projects.userid') . '=' . $this->_db->quote(JFactory::getUser()->id));
		}

		return $query;
	}
}
