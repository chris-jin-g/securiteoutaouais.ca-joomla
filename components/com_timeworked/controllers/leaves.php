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

class TimeWorkedControllerLeaves extends JControllerLegacy
{
	/**
	 * @var TimeWorkedModelLeaves $model
	 */
	private $model = null;

	/**
	 * @var bool is ajax request
	 */
	private $isAjax = false;

	/**
	 * Constructor.
	 *
	 * @param   array $config An optional associative array of configuration settings.
	 *                        Recognized key values include 'name', 'default_task', 'model_path', and
	 *                        'view_path' (this list is not meant to be comprehensive).
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->model  = $this->getModel('Leaves');
		$this->isAjax = $this->input->getBool('ajax', false);

		JLoader::register('ACLHelper', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'aclhelper.php');
	}

	/**
	 * Typical view method for MVC based architecture
	 *
	 * This function is provide as a default implementation, in most cases
	 * you will need to override it in your own controllers.
	 *
	 * @param   boolean $cachable  If true, the view output will be cached
	 * @param   array   $urlparams An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JControllerLegacy  A JControllerLegacy object to support chaining
	 */
	public function display($cachable = false, $urlparams = array())
	{
		if ($this->isAjax)
		{
			$items = $this->model->getItems();

			foreach ($items as &$item)
			{
				if (!($item->owner && ACLHelper::canEditOwn()) && !ACLHelper::canEdit())
				{
					unset($item->edit_url);
				}

				if (!ACLHelper::canDelete())
				{
					unset($item->remove_url);
				}

				if (!ACLHelper::canManageLeaves())
				{
					unset($item->approve_url);
					unset($item->decline_url);
                    unset($item->username);
				}

				unset($item->owner);
			}

			$data             = new stdClass();
			$data->items      = $items;
			$data->pagination = $this->model->getPagination()->getPages();

			if (!$this->model->getState('filter.dates'))
			{
				$data->monthList = $this->model->getMonths();
			}

			echo new JResponseJson($data);
			jexit();
		}

		return parent::display($cachable, $urlparams);
	}

	/**
	 * Store object
	 */
	public function save()
	{
		try
		{
			if ($this->input->getMethod() !== 'POST')
			{
				throw new Exception(JText::_('JERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND'));
			}

			/**
			 * @var JForm $form
			 */
			$form         = $this->model->getForm();
			$formData     = $this->input->post->get('leaves', array(), 'array');
			$brokenFields = null;

			if (!$form->validate($formData))
			{
				$fields = array();

				foreach ($form->getErrors() as $error)
				{
					$trace = $error->getTrace();
					$xml   = $trace[0]['args'][0];

					if (strpos($error->getMessage(), JText::sprintf('JLIB_FORM_VALIDATE_FIELD_REQUIRED', '')) === false)
					{
						JFactory::getApplication()->enqueueMessage($error->getMessage());
					}

					if ($xml instanceof SimpleXMLElement)
					{
						$fields[] = (string) $xml['name'];
					}
				}

				$brokenFields = $fields;

				throw new Exception();
			}

			$dateDifference = strtotime($formData['end_date']) - strtotime($formData['start_date']);

			if ($dateDifference < 0)
			{
				$brokenFields = array('daterange');
				throw new Exception(JText::_('COM_TIMEWORKED_WRONG_DATE_RANGE'));
			}

			$days                  = ceil(($dateDifference) / (60 * 60 * 24)) + 1;
			$formData['work_days'] = floatval($formData['work_days']);

			if ($days < $formData['work_days'])
			{
				$brokenFields = array('work_days');
				throw new Exception(JText::_('COM_TIMEWORKED_WRONG_NUMBER_OF_WORKING_DAYS'));
			}

			if ($formData['id'] != 0)
			{
				$formData['status']           = 0;
				$formData['admin_commentary'] = null;
			}

			$form->bind($formData);
			$status = $this->model->store($form);

			if ($status)
			{
				if ($formData['id'])
				{
					echo new JResponseJson(null, JText::_('COM_TIMEWORKED_EDITED_SAVED'));
				}
				else
				{
					echo new JResponseJson(null, JText::_('COM_TIMEWORKED_NEW_SAVED'));
				}
                $this->model->notifyManagerByEmail($form->getData());
			}

			jexit();
		} catch (Exception $e)
		{
			echo new JResponseJson(array('fields' => $brokenFields), $e->getMessage(), true);
			jexit();
		}
	}

	/**
	 * Get edit object data
	 */
	public function edit()
	{
		try
		{
			if (!ACLHelper::canDelete())
			{
				throw new Exception(JText::_('JGLOBAL_AUTH_ACCESS_DENIED'));
			}

			if ($this->isAjax)
			{
				$item = $this->model->getItem();

				if (!$item)
				{
					throw new Exception(JText::_('COM_TIMEWORKED_ERROR_ITEM_NOT_EXIST'));
				}

				unset($item->created);
				unset($item->created_by);
				unset($item->modified);
				unset($item->modified_by);
				unset($item->user_id);
				unset($item->admin_commentary);
				unset($item->status);
                $item->user_commentary = html_entity_decode($item->user_commentary);
                
				echo new JResponseJson($item);
				jexit();
			}
		} catch (Exception $e)
		{
			echo new JResponseJson($e);
			jexit();
		}
	}

	public function remove()
	{
		try
		{
			if ($this->input->getMethod() !== 'POST')
			{
				throw new Exception(JText::_('JERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND'));
			}

			if (!ACLHelper::canDelete())
			{
				throw new Exception(JText::_('JGLOBAL_AUTH_ACCESS_DENIED'));
			}

			if ($this->isAjax)
			{
				$item = $this->model->getItem();

				if (!$item)
				{
					throw new Exception(JText::_('COM_TIMEWORKED_ERROR_ITEM_NOT_EXIST'));
				}

				if ($this->model->remove($item))
				{
					echo new JResponseJson(null, JText::_('COM_TIMEWORKED_DELETED'));
				}
				else
				{
					echo new JResponseJson(null, JText::_('COM_TIMEWORKED_DATABASE_EXECUTE_ERROR'), true);
				}

				jexit();
			}
		} catch (Exception $e)
		{
			echo new JResponseJson($e);
			jexit();
		}
	}

	public function approve()
	{
		try
		{
			if ($this->input->getMethod() !== 'POST')
			{
				throw new Exception(JText::_('JERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND'));
			}

			if (!ACLHelper::canManageLeaves())
			{
				throw new Exception(JText::_('JGLOBAL_AUTH_ACCESS_DENIED'));
			}

			if ($this->isAjax)
			{
				$item = $this->model->getItem();

				if (!$item)
				{
					throw new Exception(JText::_('COM_TIMEWORKED_ERROR_ITEM_NOT_EXIST'));
				}

				if ($this->model->setApproved($item, $this->input->post->getString('admin_commentary')))
				{
					echo new JResponseJson(null, JText::_('COM_TIMEWORKED_APPROVED'));
                    $this->model->notifyEmployeeByEmail($item);
				}

				jexit();
			}
		} catch (Exception $e)
		{
			echo new JResponseJson($e);
			jexit();
		}
	}

	public function decline()
	{
		try
		{
			if ($this->input->getMethod() !== 'POST')
			{
				throw new Exception(JText::_('JERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND'));
			}

			if (!ACLHelper::canManageLeaves())
			{
				throw new Exception(JText::_('JGLOBAL_AUTH_ACCESS_DENIED'));
			}

			if ($this->isAjax)
			{
				$item = $this->model->getItem();

				if (!$item)
				{
					throw new Exception(JText::_('COM_TIMEWORKED_ERROR_ITEM_NOT_EXIST'));
				}

				if ($this->model->setDeclined($item, $this->input->post->getString('admin_commentary')))
				{
					echo new JResponseJson(null, JText::_('COM_TIMEWORKED_DECLINED'));
                    $this->model->notifyEmployeeByEmail($item, false);
				}

				jexit();
			}
		} catch (Exception $e)
		{
			echo new JResponseJson($e);
			jexit();
		}
	}
}
