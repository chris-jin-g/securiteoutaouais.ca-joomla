<?php
/**
 * Clients list template
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
    <form action="<?php echo JRoute::_('index.php?option=com_timeworked&view=clients'); ?>" method="post" name="adminForm" id="adminForm">
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
        <?php if (empty($this->clients)): ?>
            <div class="alert alert-no-items">
                <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else: ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th width="1%">
                        <?php echo JHtml::_('grid.checkall'); ?>
                    </th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_NAME', 'clients.company', $listDirn, $listOrder); ?></th>
                    <th><?php echo JText::_('COM_TIMEWORKED_PREVIEW'); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'JENABLED', 'enabled', $listDirn, $listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_CONTACT', 'clients.contact_person', $listDirn, $listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_NUMBER_OF_PROJECTS', 'number_of_projects', $listDirn, $listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_NUMBER_OF_PEOPLE', 'number_of_people', $listDirn, $listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_TOTAL_HOURS_REPORTED', 'total_hours', $listDirn, $listOrder); ?></th>
                    <th><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_LATEST_ACTIVITY', 'latest_activity', $listDirn, $listOrder); ?></th>
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
                if ($this->clients && count($this->clients)):
                    foreach ($this->clients as $i => $client):
                        $client->max_ordering = 0;
                        $ordering             = ($listOrder == 'ordering');
                        $canEdit              = $this->user->authorise('core.edit', 'com_timeworked.client.' . $client->id);
                        $canEditOwn           = $this->user->authorise('core.edit.own', 'com_timeworked.client.' . $client->id);
                        $canChange            = $this->user->authorise('core.edit.state', 'com_timeworked.client.' . $client->id);
                        ?>
                        <tr class="row<?php echo $i % 2; ?>">
                            <td class="center"><?php echo JHtml::_('grid.id', $i, $client->id); ?></td>
                            <td>
                                <?php if ($canEdit || $canEditOwn) : ?>
                                    <a href="<?php echo JRoute::_('index.php?option=com_timeworked&task=client.edit&id=' . $client->id); ?>"><?php echo $this->escape($client->company); ?></a>
                                <?php else: ?>
                                    <?php echo $this->escape($client->company); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="change-color block-icon-background"
                                    <?php if ($client->set_background_color): ?>style="background-color:<?php echo $client->color; ?>"<?php endif; ?>>
                                    <?php echo $this->escape(empty($client->short_name) ? $client->company : $client->short_name); ?>
                                </span>
                            </td>
                            <td>
                                <span class="twt-unpublish">
                                    <?php echo JHtml::_('jgrid.published', $client->published, $i, 'clients.'); ?>
                                </span>
                            </td>
                            <td>
                                <?php echo $this->escape($client->contact_person . ($client->phone ? ' (' . $client->phone . ')' : '')); ?>
                            </td>
                            <td class="twt-num-of-projects"><?php echo $client->number_of_projects; ?></td>
                            <td><?php echo $client->number_of_people; ?></td>
                            <td><?php echo(empty($client->total_hours) ? JText::_('COM_TIMEWORKED_N_A') : $client->total_hours); ?></td>
                            <td><?php echo($client->latest_activity == '0000-00-00 00:00:00' || empty($client->latest_activity) ? JText::_('COM_TIMEWORKED_N_A') : $client->latest_activity); ?></td>
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
        <p><?php echo JText::_('COM_TIMEWORKED_DISABLE_CLIENT_WARNING'); ?></p>
    </div>
    <div class="modal-footer">
        <a href="#" id="hide-modal" class="btn"><?php echo JText::_('COM_TIMEWORKED_CANCEL'); ?></a>
        <a href="#" id="unpublish" class="btn btn-primary"><?php echo JText::_('COM_TIMEWORKED_PROCEED'); ?></a>
    </div>
</div>
<script>
(function($){
    $(document).ready(function(){
        $('.twt-unpublish a').each(function(){
            var $a = $(this);
            $a.data('onclick', $a.attr('onclick')).removeAttr('onclick');
        });
        $('#toolbar-unpublish button').each(function(){
            var $btn = $(this);
            $btn.data('onclick', $btn.attr('onclick')).removeAttr('onclick');
        });
    });
    $(document).on('click', '.twt-unpublish a', function(){
        var $a = $(this),
            numProj = parseInt($a.closest('tr').find('.twt-num-of-projects').text()) || 0;
            
        if (numProj && $a.find('.icon-publish').size()) {
            $('#unpublish-warning').modal('show');
            $('#unpublish').attr('onclick', $a.data('onclick'));
        } else {
            $a.attr('onclick', $a.data('onclick'));
            $a.triggerHandler('click');
        }
        
    });
    $(document).on('click', '#toolbar-unpublish button', function(){
        var numProj = 0, $btn = $(this);
        $('.table tbody input[type=checkbox]:checked').each(function(){
            numProj += parseInt($(this).closest('tr').find('.twt-num-of-projects').text()) || 0;
        });
        if (numProj) {
            $('#unpublish-warning').modal('show');
            $('#unpublish').attr('onclick', $btn.data('onclick'));
        } else {
            $btn.attr('onclick', $btn.data('onclick'));
            $btn.triggerHandler('click');
        }
    });
    $(document).on('click', '#hide-modal', function(){
        $('#unpublish-warning').modal('hide');
    });
})(jQuery);
</script>