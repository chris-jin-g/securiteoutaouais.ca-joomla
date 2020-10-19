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

class ACLHelper
{
	/**
	 * Check if user Super Admin
	 *
	 * @param int|null $id user id. null - current user
	 *
	 * @return bool true if user is Super Admin
	 */
	public static function isAdmin($id = null)
	{
		return (bool) JFactory::getUser($id)->get('isRoot');
	}

	/**
	 * Check if user can create new items
	 *
	 * @param int|null $id user id. null - current user
	 *
	 * @return bool true if user can create new items
	 */
	public static function canCreate($id = null)
	{
		return (bool) JFactory::getUser($id)->authorise('core.create', self::getComponentName());
	}

	/**
	 * Check if user can edit all items
	 *
	 * @param int|null $id user id. null - current user
	 *
	 * @return bool true if can edit all items
	 */
	public static function canEdit($id = null)
	{
		return (bool) JFactory::getUser($id)->authorise('core.edit', self::getComponentName());
	}

	/**
	 * Check if user can edit own items
	 *
	 * @param int|null $id user id. null - current user
	 *
	 * @return bool true if can edit own items
	 */
	public static function canEditOwn($id = null)
	{
		return (bool) JFactory::getUser($id)->authorise('core.edit.own', self::getComponentName());
	}

	/**
	 * Check can user edit item or not
	 *
	 * @param string   $itemAuthorId item user id
	 * @param int|null $userId       user id
	 *
	 * @return bool true if can edit
	 */
	public static function canEditItem($itemAuthorId, $userId = null)
	{
		if (is_null($userId))
		{
			$userId = JFactory::getUser($userId)->get('id');
		}

		if (!self::canEditOwn($userId) && $itemAuthorId == $userId)
		{
			return false;
		}

		return self::canEdit($userId) || (self::canEditOwn($userId) && $itemAuthorId == $userId);
	}

	/**
	 * Check if user can delete items
	 *
	 * @param int|null $id user id. null - current user
	 *
	 * @return bool true if can delete items
	 */
	public static function canDelete($id = null)
	{
		return (bool) JFactory::getUser($id)->authorise('core.delete', self::getComponentName());
	}

	/**
	 * Check if user can manage reports, which assigned to the user
	 *
	 * @param int|null $id user id. null - current user
	 *
	 * @return bool true if can manage assigned reports
	 */
	public static function canManageAssignedReports($id = null)
	{
		return (bool) JFactory::getUser($id)->authorise('core.reports.assigned', self::getComponentName());
	}

	/**
	 * Check if user can manage all reports
	 *
	 * @param int|null $id user id. null - current user
	 *
	 * @return bool true if can manage all reports
	 */
	public static function canManageAllReports($id = null)
	{
		return (bool) JFactory::getUser($id)->authorise('core.reports.all', self::getComponentName());
	}
	/**
	 * Check if user can manage leaves
	 *
	 * @param int|null $id user id. null - current user
	 *
	 * @return bool true if can manage leaves
	 */
	public static function canManageLeaves($id = null)
	{
		return (bool) JFactory::getUser($id)->authorise('core.leaves', self::getComponentName());
	}

	/**
	 * Check if item belong to user
	 *
	 * @param int      $itemId item id
	 * @param int|null $userId user id. null - current user
	 *
	 * @return bool true if item belong to user
	 */
	public static function userItem($itemId, $userId = null)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select($db->quoteName('userid'))
			->from($db->quoteName('#__tw_work_log'))
			->where($db->quoteName('id') . '=' . $db->quote($itemId));
		$db->setQuery($query);

		return JFactory::getUser($userId)->get('id') == $db->loadResult();
	}

	/**
	 * Get Joomla component name
	 *
	 * @return string Joomla component name
	 */
	private static function getComponentName()
	{
		return 'com_timeworked';
	}
}
