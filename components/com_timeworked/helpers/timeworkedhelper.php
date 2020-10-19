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

class TimeWorkedHelper
{
	public static function setDocument($title = '', $basepath, $metadesc = '', $metakey = '')
	{
		$doc = JFactory::getDocument();
		$app = JFactory::getApplication();
		if (empty($title))
		{
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1)
		{
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2)
		{
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}
		$doc->setTitle($title);
		if (trim($metadesc))
		{
			$doc->setDescription($metadesc);
		}
		if (trim($metakey))
		{
			$doc->setMetaData('keywords', $metakey);
		}
        $doc->addScriptDeclaration("var TW_BASE_PATH = '$basepath';");
	}

	public static function keepalive()
	{
		$config      = JFactory::getConfig();
		$lifetime    = ($config->get('lifetime') * 60000);
		$refreshTime = ($lifetime <= 60000) ? 30000 : $lifetime - 60000;

		if ($refreshTime > 3600000 || $refreshTime <= 0)
		{
			$refreshTime = 3600000;
		}

		$document = JFactory::getDocument();
        
        $script = "(function($){ $.TimeWorked.keepalive({$refreshTime}, '" . JText::_('COM_TIMEWORKED_LOGED_OUT') . "') })(jQuery)";

		$document->addScriptDeclaration($script);
	}
    
    public static function timeFormat($time)
    {
        if (is_null($time)) {
            return '0:00';
        }
        $p = explode(':', $time);
        $h = (int)$p[0];
        return $h . ':' . $p[1];
    }
    
    public static function secToTime($sec)
    {
        $h = floor($sec / 3600);
        $m = $sec % 3600 / 60;
        return ( $h > 9 ? $h : '0' . $h) . ':' . ($m > 9 ? $m : '0' . $m);
    }
}
