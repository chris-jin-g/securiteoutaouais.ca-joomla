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

class TimeWorkedModelClient extends JModelItem
{
	/**
	 * Model context string.
	 *
	 * @access    protected
	 * @var        string
	 */
	protected $_context = 'com_timeworked.client';

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 */
	protected function populateState()
	{
		$app    = JFactory::getApplication();
		$params = $app->getParams();

		$id = JRequest::getInt('id');
		$this->setState('client.id', $id);
		$this->setState('params', $params);
	}

	/**
	 * Method to get an ojbect.
	 *
	 * @param integer The id of the object to get.
	 */
	public function &getItem($id = null)
	{
		if ($this->_item === null)
		{
			$this->_item = false;

			if (empty($id))
			{
				$id = $this->getState('client.id');
			}

			$table = JTable::getInstance('Clients', 'TimeWorkedTable');

			if ($table->load($id))
			{
				if ($published = $this->getState('filter.published'))
				{
					if ($table->state != $published)
					{
						return $this->_item;
					}
				}

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
	 * Get client id and name by project id
	 *
	 * @param int $projectId project id
	 *
	 * @return array associtive array with id and name
	 */
	public function getClientByProject($projectId)
	{
		$query = $this->_db->getQuery(true)
			->select($this->_db->quoteName(array('clients.id', 'clients.company'), array('id', 'name')))
			->from($this->_db->quoteName('#__tw_clients', 'clients'))
			->leftJoin($this->_db->quoteName('#__tw_projects', 'projects') . ' ON '
				. $this->_db->quoteName('projects.clientid') . ' = ' . $this->_db->quoteName('clients.id'))
			->group($this->_db->quoteName('id'));

		if ($projectId)
		{
			$query->where($this->_db->quoteName('projects.id') . ' = ' . $this->_db->quote($projectId));
		}

		$this->_db->setQuery($query);

		return $this->_db->loadAssocList();
	}
}
