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
    <form action="<?php echo JRoute::_('index.php?option=com_timeworked&view=users'); ?>" method="post" name="adminForm" id="adminForm">
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
                    <th><?php echo JHtml::_('grid.sort', 'JGLOBAL_USERNAME', 'users.name', $listDirn, $listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'JGLOBAL_EMAIL', 'users.email', $listDirn, $listOrder); ?></th>
                    <th><?php echo JText::_('COM_TIMEWORKED_USER_GROUPS'); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_NUMBER_OF_PROJECTS', 'number_of_projects', $listDirn, $listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_TOTAL_HOURS_REPORTED', 'total_hours', $listDirn, $listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_LATEST_ACTIVITY', 'latest_activity', $listDirn, $listOrder); ?></th>
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
                <?php if ($this->items && count($this->items)): ?>
                    <?php foreach ($this->items as $i => $item): ?>
                        <tr class="row<?php echo $i % 2; ?>">
                            <td class="center"><?php echo JHtml::_('grid.id', $i, $item->id); ?></td>
                            <td>
                                <a href="<?php echo JRoute::_('index.php?option=com_timeworked&view=user&id=' . $item->id); ?>"><?php echo $this->escape($item->name); ?></a>
                            </td>
                            <td><?php echo $this->escape($item->email); ?></td>
                            <td><?php echo $this->escape($item->groups); ?></td>
                            <td><?php echo $this->escape($item->number_of_projects); ?></td>
                            <td><?php echo(empty($item->total_hours) ? JText::_('COM_TIMEWORKED_N_A') : $item->total_hours); ?></td>
                            <td><?php echo($item->latest_activity == '0000-00-00 00:00:00' || empty($item->latest_activity) ? JText::_('COM_TIMEWORKED_N_A') : $item->latest_activity); ?></td>
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