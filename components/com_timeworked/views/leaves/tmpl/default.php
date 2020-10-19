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

$columnsCount = ACLHelper::canManageLeaves() ? 10 : 8;

$joomlaLanguageTag = JFactory::getLanguage()->getTag();
$jsLanguageTag     = 'en_GB';

$document = JFactory::getDocument();

$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/jquery-cookie/jquery.cookie.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/jquery-i18n/jquery.i18n.min.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/moment/min/moment-with-locales.min.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/bootstrap-daterangepicker/daterangepicker.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/HTML5-History-API/history.min.js');

$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/wt_lib.js');

$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/leave_form.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/leave_list.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/leave_filters.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/slider.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/hideColumns.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/changeColor.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/leaves.js');

$languageFile = JPATH_ROOT . DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR . 'com_timeworked'
	. DIRECTORY_SEPARATOR . 'scripts' . DIRECTORY_SEPARATOR . 'i18n' . DIRECTORY_SEPARATOR
	. JFactory::getLanguage()->getTag() . '.js';

if (file_exists($languageFile))
{
	$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/i18n/' . $joomlaLanguageTag . '.js');
	$jsLanguageTag = str_replace('-', '_', $joomlaLanguageTag);
}
else
{
	$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/i18n/en-GB.js');
}

$document->addScriptDeclaration(
	"jQuery.TimeWorked.momentLang = '" . $joomlaLanguageTag . "';
	jQuery.i18n.load(" . $jsLanguageTag . ");");

$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/scripts/bootstrap-daterangepicker/daterangepicker-bs2.css');
$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/styles/bootstrap-2.css');
$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/styles/timeworked.css');
$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/styles/font-awesome/css/font-awesome.min.css');
?>
<div id="tw-content-wrapper" class="tw-leave-page">
    <h1><?php echo JText::_('COM_TIMEWORKED_LEAVES'); ?></h1>
<?php if (JFactory::getUser()->get('id') != 0): ?>
	<?php TimeWorkedHelper::keepalive(); ?>
	<div id="approveModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="approveModalLabel"></h3>
		</div>
		<div class="modal-body">
			<textarea name="approve-leaves" id="approveLeaves"></textarea>
		</div>
		<div class="modal-footer">
			<button class="tw-btn" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('JCANCEL'); ?></button>
			<button class="tw-btn tw-btn-primary" id="confirmApproveModal"><?php echo JText::_('JSUBMIT'); ?></button>
		</div>
	</div>

	<div id="resetModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="resetModalLabel"><?php echo JText::_('COM_TIMEWORKED_CONFIRM_TITLE'); ?></h3>
		</div>
		<div class="modal-body">
			<p><?php echo JText::_('COM_TIMEWORKED_CONFIRM_RESET_MESSAGE'); ?></p>
		</div>
		<div class="modal-footer">
			<button class="tw-btn" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('JCANCEL'); ?></button>
			<button class="tw-btn tw-btn-primary" id="confirmResetModal"><?php echo JText::_('COM_TIMEWORKED_RESET'); ?></button>
		</div>
	</div>

	<div id="confirmModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="confirmModalLabel"></h3>
		</div>
		<div class="modal-body" id="confirmModalBody">
			<p></p>
		</div>
		<div class="modal-footer">
			<button class="tw-btn" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('JCANCEL'); ?></button>
			<button class="tw-btn tw-btn-primary" id="confirmModal"><?php echo JText::_('JYES'); ?></button>
		</div>
	</div>

	<div class="tw-form-container">
		<div id="leaveFormSwitcher" class="tw-slide-switcher">
			<i class="fa fa-arrow-circle-up"></i>
			<span class="not-link"><?php echo JText::_('COM_TIMEWORKED_LEAVE_FORM'); ?></span>
		</div>
		<div class="tw-form-wrapper tw-slide-up-down">
			<div class="tw-edit-message tw-hide"></div>
			<form action="<?php echo JRoute::_('index.php'); ?>" method="post" novalidate="novalidate" class="tw-form tw-leave-form">
				<?php foreach ($this->getForm()->getFieldset() as $field): ?>
					<div class="tw-field-<?php echo $field->getAttribute('name'); ?>">
						<?php echo $this->form->getControlGroup($field->getAttribute('name')); ?>
					</div>
				<?php endforeach; ?>

				<div class="control-group">
					<div class="controls">
						<input type="submit" value="<?php echo JText::_('JSUBMIT'); ?>" class="tw-btn tw-btn-primary tw-pull-left" />
						<input type="reset" value="<?php echo JText::_('COM_TIMEWORKED_RESET'); ?>"
							class="tw-btn tw-pull-left reset" id="tw-form-reset-button" />
					</div>
				</div>

				<input type="hidden" name="option" value="com_timeworked" />
				<input type="hidden" name="view" value="leaves" />
				<input type="hidden" name="task" value="save" />

				<div class="tw-clearfix"></div>
			</form>
		</div>
	</div>
	<div class="tw-clearfix"></div>

	<form class="list" action="<?php echo JRoute::_('index.php'); ?>" method="get">

		<div class="tw-filters tw-form-container" id="tw-filter-bar">
			<div id="filterPanelSwitcher" class="tw-slide-switcher tw-pull-left">
				<i class="fa fa-arrow-circle-up"></i>
				<span class="not-link"><?php echo JText::_('COM_TIMEWORKED_MANAGE_FILTERS'); ?></span>
			</div>
            <div id="tw-filters-reset" class="tw-pull-right tw-hide-on-slide-up">
                <i class="fa fa-times-circle"></i>&nbsp;<span><?php echo JText::_('COM_TIMEWORKED_RESET'); ?></span>
            </div>
            <div class="tw-clearfix"></div>

			<div class="tw-slide-up-down">
                <div style="padding-bottom: 10px;"></div>
				<div class="row-fluid">
					<?php if (ACLHelper::canManageLeaves()) : ?>
						<div class="tw-pull-left span6">
							<label for="filter_user"><?php echo JText::_('COM_TIMEWORKED_STAFF'); ?></label>
							<select name="filter_user" id="filter_user" class="inputbox span12"
								data-placeholder="<?php echo JText::_('COM_TIMEWORKED_SELECT_USER'); ?>">
								<option value=""></option>
								<?php echo JHtml::_('select.options', $this->usersList, 'id', 'name', $this->state->get('filter.user')); ?>
							</select>
						</div>
					<?php endif; ?>
					<div class="tw-pull-left span6">
						<label for="filter_dates"><?php echo JText::_('JDATE'); ?></label>
						<select name="filter_dates" id="filter_dates" class="inputbox span12"
							data-placeholder="<?php echo JText::_('COM_TIMEWORKED_SELECT_DATE_INTERVAL'); ?>">
							<option value=""></option>
							<?php echo JHtml::_('select.options', $this->monthList, 'id', 'name', $this->state->get('filter.dates')); ?>
						</select>
						<span id="tw-precise-dates-button"><?php echo JText::_('COM_TIMEWORKED_PRECISE_DATES'); ?></span>
					</div>
				</div>
                <div class="tw-form-separator"></div>
				<div class="">
					<div class="tw-pull-left odd">
						<label for="filter_hide_past_leaves_stub">
							<input type="checkbox" id="filter_hide_past_leaves_stub"
								<?php echo ($this->state->get('filter.hide_past_leaves') ? 'checked="checked"' : ''); ?> />
							<?php echo JText::_('COM_TIMEWORKED_HIDE_PAST_LEAVES'); ?>
						</label>

						<input type="hidden" name="filter_hide_past_leaves" id="filter_hide_past_leaves"
							value="<?php echo $this->state->get('filter.hide_past_leaves') ? '1' : '0'; ?>" />
					</div>
				</div>
				<div class="tw-clearfix"></div>
			</div>
		</div>
		<div class="tw-clearfix"></div>

		<div class="tw-column-toggle tw-form-container">
			<div id="columnToggleSwitcher" class="tw-slide-switcher">
				<i class="fa fa-arrow-circle-up"></i>
				<span class="not-link"><?php echo JText::_('COM_TIMEWORKED_MANAGE_TABLE'); ?></span>
			</div>
		</div>
		<div class="tw-clearfix"></div>

		<div class="tw-responsive-table-container">
			<table class="table table-striped table-bordered table-hover tw-list" id="leaves-data">
				<thead>
				<tr>
					<th id="tw-head-start-date"><?php echo JText::_('COM_TIMEWORKED_START_DATE'); ?></th>
					<th id="tw-head-end-date"><?php echo JText::_('COM_TIMEWORKED_END_DATE'); ?></th>
					<th id="tw-head-work-days"><?php echo JText::_('COM_TIMEWORKED_WORK_DAYS'); ?></th>
					<th id="tw-head-leave-type"><?php echo JText::_('COM_TIMEWORKED_LEAVE_TYPE'); ?></th>
					<?php if (ACLHelper::canManageLeaves()): ?>
						<th id="tw-head-username"><?php echo JText::_('COM_TIMEWORKED_USER'); ?></th>
					<?php endif; ?>
					<th id="tw-head-user-commentary"><?php echo JText::_('COM_TIMEWORKED_USER_COMMENTARY'); ?></th>
					<th id="tw-head-status"><?php echo JText::_('COM_TIMEWORKED_STATUS'); ?></th>
					<?php if (ACLHelper::canManageLeaves()): ?>
						<th id="tw-head-approving"><?php echo JText::_('COM_TIMEWORKED_APPROVING'); ?></th>
					<?php endif; ?>
					<th id="tw-head-service"><?php echo JText::_('COM_TIMEWORKED_EDITS'); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php $leadYear = 0; ?>
				<?php foreach ($this->get('Items') as $item): ?>
					<?php if ($leadYear != date('Y', strtotime($item->start_date))): ?>
						<?php $leadYear = date('Y', strtotime($item->start_date)); ?>
						<tr class="year">
							<td colspan="<?php echo $columnsCount; ?>"><?php echo $leadYear; ?></td>
						</tr>
					<?php endif; ?>
					<tr class="row-<?php echo $item->id; ?>">
						<td class="row-start-date" nowrap="nowrap">
							<?php echo DateFormatterHelper::format($item->start_date); ?>
						</td>
						<td class="row-end-date" nowrap="nowrap">
							<?php echo DateFormatterHelper::format($item->end_date); ?>
						</td>
						<td class="row-work-days">
							<?php echo $item->work_days; ?>
						</td>
						<td class="row-leave-type">
							<?php echo $item->leave_type; ?>
						</td>
						<?php if (ACLHelper::canManageLeaves()): ?>
							<td class="row-username">
								<?php echo $item->username; ?>
							</td>
						<?php endif; ?>
						<td class="row-user-commentary">
							<?php echo $item->user_commentary; ?>
						</td>
						<td class="row-status leave-status-<?php echo $item->status; ?>">
							<?php $status = JText::_('COM_TIMEWORKED_LEAVE_STATUS_' . $item->status); ?>
							<span class="change-color block-icon-background hasTooltip status"
								data-original-title="<?php echo $status; ?>">
								<?php echo $status[0]; ?></span>
							<?php if ($item->admin_commentary): ?>
								<span class="hasTooltip fa fa-comment justification"
									data-original-title="<strong><?php echo($item->status == 1 ? JText::_('COM_TIMEWORKED_USER_COMMENTARY') : JText::_('COM_TIMEWORKED_ADMIN_COMMENTARY')); ?></strong><br/><?php echo $item->admin_commentary; ?>">
								</span>
							<?php endif; ?>
						</td>
						<?php if (ACLHelper::canManageLeaves()): ?>
							<td class="row-approving" nowrap="nowrap">
								<?php if ($item->approve_url): ?>
									<a class="fa fa-check-circle approve" href="<?php echo JRoute::_($item->approve_url); ?>"></a>
								<?php elseif ($item->status == 1): ?>
									<i class="fa fa-check-circle approve"></i>
								<?php endif; ?>
								<?php if ($item->decline_url): ?>
									<a class="fa fa-ban reject" href="<?php echo JRoute::_($item->decline_url); ?>"></a>
								<?php elseif ($item->status == 2): ?>
									<i class="fa fa-ban reject"></i>
								<?php endif; ?>
							</td>
						<?php endif; ?>
						<td nowrap="nowrap" class="row-service" data-row-service-status="<?php echo $item->status; ?>">
							<?php if ($item->edit_url &&(($item->owner && ACLHelper::canEditOwn()) || ACLHelper::canEdit())): ?>
								<a class="fa fa-pencil-square-o edit" href="<?php echo JRoute::_($item->edit_url); ?>"></a>
							<?php endif; ?>
							<?php if ($item->remove_url && ACLHelper::canDelete()): ?>
								<a class="fa fa-times-circle remove" href="<?php echo JRoute::_($item->remove_url); ?>"></a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="list-footer">
			<table class="table table-bordered">
				<tr class="tw-paginator">
					<td colspan="2">
						<?php echo $this->get('Pagination')->getListFooter(); ?>
					</td>
				</tr>
			</table>
		</div>
		<input type="hidden" name="option" value="com_timeworked" />
		<input type="hidden" name="view" value="leaves" />
	</form>

<?php else: ?>
	<p><?php echo JText::_('COM_TIMEWORKED_UNAUTHORIZED_ACCESS'); ?></p>
<?php endif; ?>
</div>