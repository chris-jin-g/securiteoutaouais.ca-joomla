<?php
/**
 * Time worked types list template
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
		
    <form action="<?php echo JRoute::_('index.php?option=com_timeworked&view=timeworkedtypes'); ?>" method="post" name="adminForm" id="adminForm">
        <?php if (empty($this->timeworkedtypes)) : ?>
            <div class="alert alert-no-items">
                <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>
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
            </fieldset>
            <div class="clr"></div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th width="1%"><?php echo JHtml::_('grid.checkall'); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_NAME', 'name', $listDirn, $listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_DEFAULT', 'default', $listDirn, $listOrder); ?></th>
                    <th><?php echo JText::_('COM_TIMEWORKED_PREVIEW'); ?></th>
                    <th class="nowrap"><?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'id', $listDirn, $listOrder); ?></th>
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
                if ($this->timeworkedtypes && count($this->timeworkedtypes)):
                    foreach ($this->timeworkedtypes as $i => $timeWorkedType):
                        $timeWorkedType->max_ordering = 0;
                        $ordering                     = ($listOrder == 'ordering');
                        $canEdit                      = $this->user->authorise('core.edit', 'com_timeworked.timeworkedtype.' . $timeWorkedType->id);
                        $canEditOwn                   = $this->user->authorise('core.edit.own', 'com_timeworked.timeworkedtype.' . $timeWorkedType->id);
                        $canChange                    = $this->user->authorise('core.edit.state', 'com_timeworked.timeworkedtype.' . $timeWorkedType->id);
                        ?>
                        <tr class="row<?php echo $i % 2; ?>">
                            <td width="1%" class="center"><?php echo JHtml::_('grid.id', $i, $timeWorkedType->id); ?></td>
                            <td>
                                <?php if ($canEdit || $canEditOwn) : ?>
                                    <a href="<?php echo JRoute::_('index.php?option=com_timeworked&task=timeworkedtype.edit&id=' . $timeWorkedType->id); ?>">
                                        <?php echo $this->escape($timeWorkedType->name); ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo $this->escape($timeWorkedType->name); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo JHtml::_('jgrid.isdefault', $timeWorkedType->default != '0', $i, 'timeworkedtypes.', $canChange && $timeWorkedType->default != '1'); ?>
                            </td>
                            <td>
                                <?php if (!$timeWorkedType->default): ?>
                                    <span class="change-color block-icon-background" style="background-color:<?php echo $timeWorkedType->color; ?>">
                                        <?php echo $this->escape(empty($timeWorkedType->short_name) ? $timeWorkedType->name : $timeWorkedType->short_name); ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <!--td>
                    <?php echo $this->escape($timeWorkedType->color); ?>
                </td-->
                            <td><?php echo $timeWorkedType->id; ?></td>
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