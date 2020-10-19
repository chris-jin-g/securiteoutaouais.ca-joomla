<?php
/*
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html License code: 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
defined('_JEXEC') or die;

$document = JFactory::getDocument();
$document->addScript(JUri::root() . '/media/com_timeworked/scripts/selectbox.js');
$document->addScriptDeclaration("
	function selectAll(selectBox, selectAll) {
		if (typeof selectBox == 'string') {
			selectBox = document.getElementById(selectBox);
		}
		if (selectBox.type == 'select-multiple') {
			for (var i = 0; i < selectBox.options.length; i++) {
				selectBox.options[i].selected = selectAll;
			}
		}
	}
");
$document->addStyleSheet(JUri::root() . '/media/com_timeworked/styles/timeworked_admin.css');
?>
<?php if (!empty($this->sidebar)): ?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<?php endif; ?>
<div id="j-main-container" class="<?php if (!empty($this->sidebar)): ?>span10<?php endif; ?>">
    <form action="index.php?option=com_timeworked&view=user&id=<?php echo $this->userId; ?>" method="post"
        class="form" id="adminForm" name="adminForm">
        <fieldset class="admin-form">
            <legend><?php echo $this->username ?></legend>
            <p><?php echo $this->email; ?></p>
            <div class="control-group">
                <a href="<?php echo JRoute::_('index.php?option=com_users&task=user.edit&id=' . $this->userId); ?>">
                    <?php echo JText::_('COM_TIMEWORKED_EDIT_USER_INFORMATION'); ?>
                </a>
            </div>
            <legend><?php echo JText::_('COM_TIMEWORKED_PROJECTS'); ?></legend>
            <div class="row-fluid">
                <?php foreach ($this->projects as $project): ?>
                    <div class="span4" style="margin-left:15px">
                        <label for="project_<?php echo $project->id; ?>">
                            <input type="checkbox" value="<?php echo $project->id; ?>" name="projects[]" id="project_<?php echo $project->id; ?>"
                                <?php if ($project->user_project): echo 'checked="checked"'; endif; ?> style="margin-top: 0" />
                            <?php echo $project->name; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        </fieldset>
        <input type="hidden" name="id" value="<?php echo $this->userId; ?>" />
        <input type="hidden" name="task" value="user.save" />
        <input type="hidden" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>