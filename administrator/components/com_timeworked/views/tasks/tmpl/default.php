<?php
/**
 * Tasks list template
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

$listOrder = $this->state->get('list.ordering');
$listDirn  = $this->state->get('list.direction');
$saveOrder = $listOrder == 'ordering';
?>
<?php if (!empty($this->sidebar)): ?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<?php endif; ?>
<div id="j-main-container" class="<?php if (!empty($this->sidebar)): ?>span10<?php endif; ?>">
    <form action="<?php echo JRoute::_('index.php?option=com_timeworked&view=tasks'); ?>" method="post" name="adminForm" id="adminForm">
        <fieldset id="filter-bar" class="btn-toolbar">
            <div class="filter-search btn-group pull-left input-append">
                <div class="filter-search btn-group pull-left">
                    <input type="text" name="filter_search" id="filter_search"
                        value="<?php echo $this->escape($this->state->get('filter.search')); ?>"
                        title="<?php echo JText::_('FILTER_SEARCH_DESC'); ?>" />
                    <button type="submit" class="btn hasTooltip"
                        title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_SUBMIT'); ?>">
                        <i class="icon-search"></i></button>
                    <button type="button" class="btn hasTooltip"
                        title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>"
                        onclick="document.id('filter_search').value='';this.form.submit();">
                        <i class="icon-remove"></i></button>
                </div>
            </div>
            <div class="filter-select btn-group pull-right">
                <?php echo $this->pagination->getLimitBox(); ?>
            </div>
        </fieldset>
        <?php if (empty($this->tasks)) : ?>
            <div class="alert alert-no-items">
                <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>
            <div class="clr"></div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th width="1%">
                        <?php echo JHtml::_('grid.checkall'); ?>
                    </th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_NAME', 'task', $listDirn, $listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'JENABLED', 'published', $listDirn, $listOrder); ?></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="9" class="list-footer">
                        <?php echo $this->pagination->getListFooter(); ?>
                    </td>
                </tr>
                </tfoot>
                <tbody>
                <?php
                if ($this->tasks && count($this->tasks)):
                    foreach ($this->tasks as $i => $task):
                        $task->max_ordering = 0;
                        $ordering              = ($listOrder == 'ordering');
                        $canEdit               = $this->user->authorise('core.edit', 'com_timeworked.task.' . $task->id);
                        $canEditOwn            = $this->user->authorise('core.edit.own', 'com_timeworked.task.' . $task->id);
                        ?>
                        <tr class="row<?php echo $i % 2; ?>">
                            <td class="center"><?php echo JHtml::_('grid.id', $i, $task->id); ?></td>
                            <td>
                                <?php if ($canEdit || $canEditOwn) : ?>
                                    <a href="<?php echo JRoute::_('index.php?option=com_timeworked&task=task.edit&id=' . $task->id); ?>">
                                        <?php echo $this->escape($task->task); ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo $this->escape($task->task); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="twt-unpublish">
                                    <?php echo JHtml::_('jgrid.published', $task->published, $i, 'tasks.'); ?>
                                </span>
                            </td>
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
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
        <?php echo JHtml::_('form.token'); ?>
	</form>
</div>
<div id="unpublish-warning" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?php echo JText::_('COM_TIMEWORKED_CONFIRM_ACTION'); ?></h3>
    </div>
    <div class="modal-body">
        <p><?php echo JText::_('COM_TIMEWORKED_ENABLE_CLIENT_WARNING'); ?></p>
    </div>
    <div class="modal-footer">
        <a href="#" id="hide-modal" class="btn"><?php echo JText::_('COM_TIMEWORKED_CANCEL'); ?></a>
        <a href="#" id="unpublish" class="btn btn-primary"><?php echo JText::_('COM_TIMEWORKED_PROCEED'); ?></a>
    </div>
</div>