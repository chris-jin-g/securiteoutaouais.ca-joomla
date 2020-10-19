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

class TimeWorkedControllerCron extends JControllerLegacy
{
	public function display($cachable = false, $urlparams = array())
	{
		$config = JFactory::getConfig();

		if (JComponentHelper::getParams('com_timeworked')->get('missing_reports_automated_notifications') == '1'
            && crc32($config->get('secret')) == JFactory::getApplication()->input->get->getInt('salt'))
		{
			JLoader::register('Cron', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'cron.php');

			$cron = new Cron();
			$cron->run();
		}

		jexit();
	}
}
