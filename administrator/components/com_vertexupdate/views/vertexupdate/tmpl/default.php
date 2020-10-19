<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_vertexupdate
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.archive');

// No direct access
defined('_JEXEC') or die;

$latest_verstion = '0.0.0';
$directories = array();
$numupdates = 0;
$update_exists = false;

if (file_exists(JPATH_COMPONENT_ADMINISTRATOR . "/update.zip")) {
    $update_exists = true;

    // extract zip first to check xml update file
    $zip_adapter = JArchive::getAdapter('zip'); //Compression type
    $zip_adapter->extract(JPATH_COMPONENT_ADMINISTRATOR . "/update.zip", JPATH_COMPONENT_ADMINISTRATOR."/updates");

    $vertexxml = 
        @simplexml_load_file(JPATH_COMPONENT_ADMINISTRATOR."/updates/xml/Vertex.xml");
        // simplexml_load_file("zip://" . JPATH_COMPONENT_ADMINISTRATOR . "/update.zip#xml/Vertex.xml");
        // file_get_contents("zip://" . JPATH_COMPONENT_ADMINISTRATOR . "/update.zip#xml/Vertex.xml");
    if ($vertexxml) {
        $latest_verstion = (string)$vertexxml->details->frameworkVersion[0];
    }
    $directories = glob(JPATH_ROOT . '/templates/*' , GLOB_ONLYDIR);
    $directories = array_filter($directories, function($d) {
        return file_exists($d . '/xml/Vertex.xml');
    });
    $directories = array_map(function($d) use ($latest_verstion, &$numupdates) {
        $xml = @simplexml_load_file($d . '/xml/Vertex.xml', 'SimpleXMLElement', LIBXML_NOCDATA);
        if (!$xml->xpath('details/frameworkVersion')) {
            return false;
        }
        $version = (string)$xml->details->frameworkVersion[0];
        $disabled = version_compare($version, $latest_verstion) > -1;
        if (!$disabled) $numupdates++;
        //var_dump($version, $latest_verstion, version_compare($version, $latest_verstion), version_compare('4.1.0', '4.1.0'));
        return array('name' => basename($d), 'version' => (string)$xml->details->frameworkVersion[0], 'disabled' => $disabled);
    }, $directories);
    //$directories = array_filter($directories, function($d) use ($latest_verstion) {
        //return version_compare($d['version'], $latest_verstion) < 0;
    //});
}

?>
<form action="<?php echo JRoute::_('index.php?option=com_vertexupdate'); ?>" method="post" name="adminForm" id="adminForm">
	<div class="form-horizontal">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_VERTEXUPDATE'); ?> (<span id="vver"><?php echo JText::_('COM_VERTEXUPDATE_VIEW_LATEST_VERSION'); ?> <?php echo $latest_verstion; ?></span>)</legend>
			<div class="row-fluid">
				
				<p>Welcome to the Shape5 Vertex framework updater. Anytime your template admin shows a Vertex framework update is available on the Overview tab you can use this tool to update the framework to the latest version.
				</p>
				
				<table class="table table-striped" style="margin-bottom:0px;">
					<tbody>
					<tr>
						<td>
							<?php echo JText::_('COM_VERTEXUPDATE_VIEW_TEMPLATES_FOUND'); ?>:
						</td>
					</tr>
					</tbody>
				</table>	
				
				
				<table class="table">
					<tbody>
					
							
					
			
						
				<?php if (!$update_exists) { echo JText::_('COM_VERTEXUPDATE_VIEW_PLEASE_WAIT'); } if(!count($directories) && $update_exists) { echo JText::_('COM_VERTEXUPDATE_VIEW_NO_UPDATES'); } foreach($directories as $template): if(!is_array($template)) continue; ?>
				<tr>
						<td>
				<label><input type="checkbox" style="margin-top:-1px;" name="update[<?php echo $template['name']; ?>]" <?php echo $template['disabled'] ? ' disabled' : ''; ?> /> <?php echo $template['name']; ?> [Vertex: <?php echo $template['version']; ?> installed]</label>
					</td>
					</tr>
				<?php endforeach; ?>
				
						</tbody>
				</table>	
				
			</div>
			<div class="row-fluid">
				<div class="">
				
					<?php echo $numupdates == 0 ? '<div class="alert alert-info">Great, it looks like everything is up to date!</div>' : ''; ?>
				
					<?php if($numupdates > 0) { ?>	
					<button class="btn btn-primary" <?php echo $latest_verstion == '0.0.0' ? ' disabled' : ''; ?>>
					<?php echo JText::_('COM_VERTEXUPDATE_VIEW_CLICK_UPDATE'); ?>
					</button>
					<?php } ?>
					
					
				</div>
			</div>
		</fieldset>
	</div>
	<input type="hidden" name="task" value="vertexupdate.update" />
	<?php echo JHtml::_('form.token'); ?>
</form>
<script>
function check_update(){var ver='<?php echo $latest_verstion;?>';if(ver=='0.0.0'){document.getElementById('vver').textContent = '<?php echo JText::_('COM_VERTEXUPDATE_VIEW_PLEASE_WAIT'); ?>';ver='3.0.0'}jQuery.ajax('//www.shape5.com/vertex/current_version/vertexVersion.php?version=3.0.0').then(function(res){if(res&&res.version&&res.version!=ver){get_update()}})}
function get_update(){jQuery.ajax('index.php?option=com_vertexupdate&task=vertexupdate.get_update').then(function(res){if(res=='OK'){window.location.reload()}else{alert('<?php echo JText::_('COM_VERTEXUPDATE_VIEW_ERROR_GETTING_UPDATE'); ?>')}})}
setTimeout(check_update, 200);
</script>