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
                    <th><?php echo JText::_('COM_TIMEWORKED_LEAVE_TYPE'); ?></th>
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
                <?php foreach ($this->items as $i => $item): ?>
                    <tr>
                        <td class="center"><?php echo JHtml::_('grid.id', $i, $item->id); ?></td>
                        <td>
                            <a href="index.php?option=com_timeworked&view=leave_type&layout=edit&id=<?php echo $item->id; ?>">
                                <?php echo $item->name; ?>
                            </a>
                        </td>
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