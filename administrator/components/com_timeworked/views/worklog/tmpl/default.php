<?php
/**
 * Work log list template
 *
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html License code: 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
defined('_JEXEC') or die;

JHtml::_('formbehavior.chosen', 'select');
?>
<?php if (!empty($this->sidebar)): ?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<?php endif; ?>
<div id="j-main-container" class="<?php if (!empty($this->sidebar)): ?>span10<?php endif; ?>">
    <form action="<?php echo JRoute::_('index.php?option=com_timeworked&view=worklog'); ?>" method="post" name="adminForm" id="adminForm">
        <fieldset id="filter-bar" class="btn-toolbar">
            <div class="filter-search btn-group pull-left input-append">
                <div class="filter-search btn-group pull-left">
                    <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('FILTER_SEARCH_DESC'); ?>" />
                    <button type="submit" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_SUBMIT'); ?>">
                        <i class="icon-search"></i></button>
                    <button type="button" class="btn hasTooltip" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>" onclick="document.id('filter_search').value='';this.form.submit();">
                        <i class="icon-remove"></i></button>
                </div>
            </div>
            <div class="filter-select btn-group pull-right">
                <?php echo $this->pagination->getLimitBox(); ?>
            </div>
            <div class="filter-select btn-group pull-right">
                <select name="filter_staff" class="inputbox input-medium" onchange="this.form.submit()" data-placeholder="<?php echo JText::_('COM_TIMEWORKED_SELECT_USER'); ?>">
                    <option value=""></option>
                    <?php echo JHtml::_('select.options', $this->staff, 'id', 'name', $this->state->get('filter.staff')); ?>
                </select>
            </div>
            <div class="filter-select btn-group pull-right">
                <select name="filter_project" class="input-medium" onchange="this.form.submit()" data-placeholder="<?php echo JText::_('COM_TIMEWORKED_SELECT_PROJECT'); ?>">
                    <option value=""></option>
                    <?php echo JHtml::_('select.options', $this->projects, 'id', 'name', $this->state->get('filter.project')); ?>
                </select>
            </div>
        </fieldset>
        <div class="clr"></div>
        <?php if (empty($this->worklog)) : ?>
            <div class="alert alert-no-items">
                <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th width="1%">
                        <?php echo JHtml::_('grid.checkall'); ?>
                    </th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_TASK', 'task', $this->listDirn, $this->listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_PROJECT', 'project_name', $this->listDirn, $this->listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_USER', 'user_name', $this->listDirn, $this->listOrder); ?></th>
                    <?php if ($this->enabledTickets): ?>
                        <th width="10%"><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_TASKID', 'ticket_numbers', $this->listDirn, $this->listOrder); ?></th>
                    <?php endif; ?>

                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_FROM', 'time', $this->listDirn, $this->listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_TO', 'time', $this->listDirn, $this->listOrder); ?></th>

                    <th width="10%"><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_HOURS', 'time', $this->listDirn, $this->listOrder); ?></th>
                    <th width="1%" class="nowrap"><?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'id', $this->listDirn, $this->listOrder); ?></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="8" class="list-footer">
                        <?php echo $this->pagination->getListFooter(); ?>
                    </td>
                </tr>
                </tfoot>
                <tbody>
                <?php
                if ($this->worklog && count($this->worklog)):
                    foreach ($this->worklog as $i => $workentry) :
                        $workentry->max_ordering = 0;
                        $canEdit                 = $this->user->authorise('core.edit', 'com_timeworked.workentry.' . $workentry->id);
                        $canEditOwn              = $this->user->authorise('core.edit.own', 'com_timeworked.workentry.' . $workentry->id);
                        $canEditProject          = $this->user->authorise('core.edit', 'com_timeworked.project.' . $workentry->project_id);
                        $canEditOwnProject       = $this->user->authorise('core.edit.own', 'com_timeworked.project.' . $workentry->project_id);
                        $canEditUser             = $this->user->authorise('core.edit', 'com_usesr');
                        $canEditOwnUser          = $this->user->authorise('core.edit.own', 'com_users');
                        ?>
                        <tr class="row<?php echo $i % 2; ?>">
                            <td class="center"><?php echo JHtml::_('grid.id', $i, $workentry->id); ?></td>
                            <td>
                                <?php if ($canEdit || $canEditOwn) : ?>
                                    <a href="<?php echo JRoute::_('index.php?option=com_timeworked&task=workentry.edit&id=' . $workentry->id); ?>"><?php echo $this->escape($workentry->task); ?></a>
                                <?php else: ?>
                                    <?php echo $this->escape($workentry->task); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($canEditProject || $canEditOwnProject) : ?>
                                    <a href="<?php echo JRoute::_('index.php?option=com_timeworked&task=project.edit&id=' . $workentry->project_id); ?>">
                                        <?php echo $this->escape($workentry->project_name); ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo $this->escape($workentry->project_name); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($canEditUser || $canEditOwnUser) : ?>
                                    <a href="<?php echo JRoute::_('index.php?option=com_users&task=user.edit&id=' . $workentry->user_id); ?>">
                                        <?php echo $this->escape($workentry->user_name); ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo $this->escape($workentry->user_name); ?>
                                <?php endif; ?>
                            </td>
                            <?php if ($this->enabledTickets): ?>
                                <td>
                                    <?php
                                    $taskIdArray = explode(',', $workentry->ticket_numbers);
                                    $taskIdCount = count($taskIdArray);
                                    ?>
                                    <?php if ($workentry->bugtracker_url): ?>
                                        <?php foreach ($taskIdArray as $i => $taskid): ?>
                                            <a target="_blank" href="<?php echo $workentry->bugtracker_url . $taskid; ?>"><?php echo $taskid; ?></a><?php echo($taskIdCount > $i + 1 ? ', ' : ''); ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <?php foreach ($taskIdArray as $i => $taskid): ?>
                                            <?php echo $taskid; ?><?php echo($taskIdCount > $i + 1 ? ', ' : ''); ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>

                            <td><?php echo $this->escape($workentry->from);?></td>
                            <td><?php echo $this->escape($workentry->to);?></td>

                            <td><?php echo $this->escape($workentry->time); ?></td>
                            <td><?php echo $workentry->id; ?></td>
                        </tr>
                    <?php
                    endforeach;
                endif;
                ?>
                </tbody>
            </table>
        <?php endif; ?>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $this->listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $this->listDirn; ?>" />
        <?php echo JHtml::_('form.token'); ?>
	</form>
</div>