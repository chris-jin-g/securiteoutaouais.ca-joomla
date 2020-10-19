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
JHtml::_('formbehavior.chosen', 'select');

$document = JFactory::getApplication()->getDocument();

$document->addStyleSheet(JUri::root() . '/media/com_timeworked/styles/timeworked_admin.css');
$document->addScript(JUri::root() . '/media/com_timeworked/scripts/leave_admin.js');

$listOrder = $this->state->get('list.ordering');
$listDirn  = $this->state->get('list.direction');
?>

<div id="approveModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="approveModalLabel"><?php echo JText::_('COM_TIMEWORKED_LEAVE_COMMENT'); ?></h3>
	</div>
	<div class="modal-body">
		<textarea name="approve-leaves" id="approveLeaves"></textarea>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('JCANCEL'); ?></button>
		<button class="btn btn-primary" id="confirmApproveModal"><?php echo JText::_('JSUBMIT'); ?></button>
	</div>
</div>

<?php if (!empty($this->sidebar)): ?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<?php endif; ?>
<div id="j-main-container" class="<?php if (!empty($this->sidebar)): ?>span10<?php endif; ?>">
    <form action="<?php echo JRoute::_('index.php?option=com_timeworked&view=leaves'); ?>" method="post" name="adminForm" id="adminForm">
        <?php if (empty($this->items)) : ?>
            <div class="alert alert-no-items">
                <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>
            <fieldset id="filter-bar" class="btn-toolbar">
                <div class="filter-select btn-group pull-right">
                    <?php echo $this->pagination->getLimitBox(); ?>
                </div>
            </fieldset>
            <div class="clr"></div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th width="1%"><?php echo JHtml::_('grid.checkall'); ?></th>
                    <th><?php echo JText::_('COM_TIMEWORKED_DATERANGE'); ?></th>
                    <th><?php echo JText::_('COM_TIMEWORKED_WORK_DAYS'); ?></th>
                    <th><?php echo JText::_('COM_TIMEWORKED_LEAVE_TYPE'); ?></th>
                    <th><?php echo JText::_('COM_TIMEWORKED_USER'); ?></th>
                    <th><?php echo JText::_('COM_TIMEWORKED_USER_COMMENTARY'); ?></th>
                    <th><?php echo JText::_('COM_TIMEWORKED_ADMIN_COMMENTARY'); ?></th>
                    <th><?php echo JText::_('COM_TIMEWORKED_STATUS'); ?></th>
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
                <?php $leadYear = 0; ?>
                <?php foreach ($this->get('Items') as $i => $item): ?>
                    <?php 
                        $canEdit    = JFactory::getUser()->authorise('core.edit', 'com_timeworked.leave.' . $item->id);
                        $canEditOwn = JFactory::getUser()->authorise('core.edit.own', 'com_timeworked.leave.' . $item->id);
                    ?>
                    <?php if ($leadYear != date('Y', strtotime($item->start_date))): ?>
                        <?php $leadYear = date('Y', strtotime($item->start_date)); ?>
                        <tr>
                            <td colspan="9" class="center"><strong><?php echo $leadYear; ?></strong></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td class="center"><?php echo JHtml::_('grid.id', $i, $item->id); ?></td>
                        <td style="white-space: nowrap;">
                            <?php if ($canEdit || $canEditOwn) : ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_timeworked&task=leave.edit&id=' . $item->id); ?>">
                                    <?php echo DateFormatterHelper::format($item->start_date); ?>
                                    &mdash;
                                    <?php echo DateFormatterHelper::format($item->end_date); ?>
                                </a>
                            <?php else: ?>
                                    <?php echo DateFormatterHelper::format($item->start_date); ?>
                                    &mdash;
                                    <?php echo DateFormatterHelper::format($item->end_date); ?>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $item->work_days; ?></td>
                        <td>
                            <a href="<?php echo JRoute::_('index.php?option=com_timeworked&view=leave_types&task=edit&id=' . $item->leave_id); ?>"><?php echo $item->leave_type; ?></a>
                        </td>
                        <td>
                            <a href="<?php echo JRoute::_('index.php?option=com_users&task=user.edit&id=' . $item->user_id); ?>"><?php echo $item->username; ?></a>
                        </td>
                        <td><?php echo $item->user_commentary; ?></td>
                        <td><?php echo $item->admin_commentary; ?></td>
                        <td><?php echo JText::_('COM_TIMEWORKED_LEAVE_STATUS_' . $item->status); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="admin_comment" id="admin_comment" value="" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
        <?php echo JHtml::_('form.token'); ?>
	</form>
</div>