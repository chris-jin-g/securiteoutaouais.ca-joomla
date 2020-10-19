<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_vertexupdate
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.archive');

/**
 * VertexUpdate Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_vertexupdate
 * @since       0.0.9
 */
class VertexUpdateControllerVertexUpdate extends JControllerForm {
    function get_update() {
        if($this->pull_update()) {
            echo 'OK';
        } else {
            echo 'FAIL';
        }
        exit;
    }
    function update() {
        $jinput = JFactory::getApplication()->input;
        $updates = array_keys($jinput->get('update', [], 'ARRAY'));
		$directories = glob(JPATH_ROOT . '/templates/*' , GLOB_ONLYDIR);
		$directories = array_filter($directories, function($d){
			return file_exists($d . '/vertex.json');
        });
        if (!file_exists(JPATH_COMPONENT_ADMINISTRATOR . "/update.zip")) {
            $this->pull_update();
            return;
        }
        $zip = JArchive::getAdapter('zip'); //Compression type
        foreach($directories as $d) {
            $bname = basename($d);
            if (in_array($bname, $updates)) {
                $zip->extract(JPATH_COMPONENT_ADMINISTRATOR . "/update.zip", $d);
            }
        }
        $app = JFactory::getApplication();
        $url = JRoute::_('index.php?option=com_vertexupdate', false);
        $app->redirect($url);
    }
    private function pull_update() {
		ini_set('allow_url_fopen',1);
        $link = 'http://www.shape5.com/vertex/patch/Shape5_Vertex4_Patch.zip';
        if(@copy($link, JPATH_COMPONENT_ADMINISTRATOR . "/update.zip")) {
            return true;
        } else {
			$fp = fopen(JPATH_COMPONENT_ADMINISTRATOR . "/update.zip", 'w+');
			//Here is the file we are downloading, replace spaces with %20
			$ch = curl_init($link);
			curl_setopt($ch, CURLOPT_TIMEOUT, 50);
			// write curl response to file
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			// get curl response
			if(!curl_exec($ch)) {
				curl_close($ch);
				fclose($fp);
				return false;
			}
			curl_close($ch);
			fclose($fp);
            return true;
        }
    }
}
