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

JHtml::_('jquery.framework');
JHtml::_('behavior.tooltip');

$colspanBig   = $this->isAdmin ? 7 : 6;
$colspanSmall = $this->canManageReports ? 4 : 2;

$joomlaLanguageTag = JFactory::getLanguage()->getTag();
$jsLanguageTag     = 'en_GB';

$document = JFactory::getDocument();

$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/jquery-cookie/jquery.cookie.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/jquery-i18n/jquery.i18n.min.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/HTML5-History-API/history.min.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/underscore/underscore-min.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/json-js/json2.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/moment/min/moment-with-locales.min.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/bootstrap-daterangepicker/daterangepicker.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/clndr/clndr.min.js');

$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/wt_lib.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/joomla_lib.js');

$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/exportBillable.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/markBillable.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/changeColor.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/filters.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/formSubmit.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/hideColumns.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/paginator.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/reject.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/slider.js');

$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/timeworked.js');

$document->addScriptDeclaration("
	jQuery(document).ready(function() {
		jQuery('.tw-excel, .tw-print').exportBillable({
			needConfirm: " . ($this->billableNeedConfirm && $this->billableOnList ? 'true' : 'false') . "
		});
	});
");

$document->addScript(JUri::base(true) . '/media/jui/js/chosen.jquery.min.js');
$document->addScriptDeclaration("
	jQuery(document).ready(function () {
		jQuery('select').chosen({
			\"disable_search_threshold\" : 10,
			\"allow_single_deselect\"    : true,
			\"placeholder_text_multiple\": \"Select some options\",
			\"placeholder_text_single\"  : \"Select an option\",
			\"no_results_text\"          : \"No results match\",
			\"width\"                    : \"100%\"
		});
	});
");
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

$document->addScriptDeclaration("
	var clndrEvents = " . json_encode($this->events) . "
	jQuery.TimeWorked.momentLang = '" . $joomlaLanguageTag . "';
");
$document->addScriptDeclaration('jQuery.i18n.load(' . $jsLanguageTag . ');');

$document->addStyleSheet(JUri::base(true) . '/media/jui/css/chosen.css');
$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/scripts/bootstrap-daterangepicker/daterangepicker-bs2.css');
$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/scripts/bootstrap-tagsinput/dist/bootstrap-tagsinput.css');
$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/styles/font-awesome/css/font-awesome.min.css');
$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/styles/bootstrap-2.css');
$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/styles/clndr.css');
$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/styles/timeworked.css');
?>
<div id="tw-content-wrapper">
<h1><?php echo JText::_('COM_TIMEWORKED_HOURS_REPORT'); ?></h1>
<?php if (JFactory::getUser()->get('id') != 0): ?>
	<?php TimeWorkedHelper::keepalive(); ?>
	
		<div class="tw-form-container">
			<div id="formToggleSwitcher" class="tw-slide-switcher">
				<i class="fa fa-arrow-circle-up"></i>
				<span class="not-link"><?php echo JText::_('COM_TIMEWORKED_REPORT_FORM'); ?></span>
			</div>

			<div class="tw-form-wrapper tw-slide-up-down">
				<div class="tw-edit-message tw-hide">
				</div>
				<div class="tw-clearfix"></div>
				<div class="tw-inner-form-wrapper">
					<div id="tw-calendar"></div>
					<form action="<?php echo JRoute::_('index.php'); ?>" class="tw-form add-action <?php if (!$this->canCreate) : ?>wt-disabled<?php endif; ?>" id="tw-add-form" method="post" novalidate>
						<?php
						foreach ($this->form->getFieldset() as $field)
						{
							$name = $field->getAttribute('name');
							switch ($name)
							{
								case 'userid':
									$value = JFactory::getUser()->get('id');
									break;
								case 'date':
									$value = DateFormatterHelper::format(time());
									break;
								case 'timeworkedid':
									$value = $this->defaultTimeWorkedType;
									break;
								default:
									$value = null;
							}
							if (!is_null($value))
							{
								$this->form->setValue($name, null, $value);
							}
							if (isset($this->postFormData[$this->control][$name]))
							{
								$this->form->setValue($name, null, $this->postFormData[$this->control][$name]);
							}
							echo '<div class="tw-field-' . $name . '">';
							echo $this->form->getControlGroup($name);
							echo '</div>';
						}
						?>
						<div class="control-group clearfix">
							<label class="checkbox leave-checkbox hasTooltip" id="tw-log-leave-project" title="<?php echo JText::_('COM_TIMEWORKED_LEAVE_PROJECT_DESC'); ?>" data-placement="left">
								<input type="checkbox" name="leaveData[]" value="project" /><?php echo JText::_('COM_TIMEWORKED_LEAVE_PROJECT'); ?>
							</label>
							<label class="checkbox leave-checkbox hasTooltip" title="<?php echo JText::_('COM_TIMEWORKED_LEAVE_TASK_NAME_DESC'); ?>" data-placement="left">
								<input type="checkbox" name="leaveData[]" value="taskName" /><?php echo JText::_('COM_TIMEWORKED_LEAVE_TASK_NAME'); ?>
							</label>
						</div>
						<div class="control-group">
							<input type="submit" value="<?php echo JText::_('JSUBMIT'); ?>" class="tw-btn tw-btn-primary tw-pull-left" />
							<input type="reset" value="<?php echo JText::_('COM_TIMEWORKED_RESET'); ?>" class="tw-btn tw-pull-left reset" id="tw-form-reset-button" />
						</div>
						<?php echo JHtml::_('form.token'); ?>
						<input type="hidden" name="option" value="com_timeworked" />
						<input type="hidden" name="view" value="workentry" />
						<input type="hidden" name="task" value="save" />

						<div class="tw-clearfix"></div>
					</form>
				</div>
				<div class="tw-clearfix"></div>
			</div>

		</div>
		<div class="tw-clearfix"></div>
	<div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel"><?php echo JText::_('COM_TIMEWORKED_CONFIRM_TITLE'); ?></h3>
		</div>
		<div class="modal-body">
			<p><?php echo JText::_('COM_TIMEWORKED_CONFIRM_DELETE_MESSAGE'); ?></p>
		</div>
		<div class="modal-footer">
			<button class="tw-btn" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('JCANCEL'); ?></button>
			<button class="tw-btn tw-btn-danger" id="confirmDeleteModal"><?php echo JText::_('JACTION_DELETE'); ?></button>
		</div>
	</div>
	<?php if ($this->billableNeedConfirm): ?>
		<div id="billableModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel"><?php echo JText::_('COM_TIMEWORKED_EXPORT_BILLABLE_TITLE'); ?></h3>
			</div>
			<div class="modal-body">
				<p><?php echo JText::_('COM_TIMEWORKED_EXPORT_BILLABLE_MESSAGE'); ?></p>
			</div>
			<div class="modal-footer">
				<button class="tw-btn" data-dismiss="modal" aria-hidden="true" id="cancelBillableModal"><?php echo JText::_('JNO'); ?></button>
				<button class="tw-btn tw-btn-primary" id="confirmBillableModal"><?php echo JText::_('COM_TIMEWORKED_EXPORT_CONFIRM'); ?></button>
			</div>
		</div>
	<?php endif; ?>
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
	<div class="timeworked">
	<form class="list" action="<?php echo JRoute::_('index.php?option=com_timeworked&view=worklog'); ?>" method="get">
	<div class="tw-filters tw-form-container" id="tw-filter-bar">
		<div id="filterPanelSwitcher" class="tw-slide-switcher tw-pull-left">
			<i class="fa fa-arrow-circle-up"></i><span class="not-link"><?php echo JText::_('COM_TIMEWORKED_MANAGE_FILTERS'); ?></span>
		</div>
        <div id="tw-filters-reset" class="tw-pull-right tw-hide-on-slide-up"><i class="fa fa-times-circle"></i>&nbsp;<span><?php echo JText::_('COM_TIMEWORKED_RESET'); ?></span></div>
        <div class="tw-clearfix"></div>

		<div class="tw-slide-up-down">
            <div style="padding-bottom: 10px;"></div>
			<div class="row-fluid">
				<div class="tw-pull-left span6">
					<label for="filter_client"><?php echo JText::_('COM_TIMEWORKED_CLIENT'); ?></label>
					<select name="filter_client" id="filter_client" class="inputbox span12" data-placeholder="<?php echo JText::_('COM_TIMEWORKED_SELECT_COMPANY'); ?>">
						<option value=""></option>
						<?php echo JHtml::_('select.options', $this->clients, 'id', 'name', $this->filterClient); ?>
					</select>
				</div>
				<div class="tw-pull-left span6">
					<label for="filter_project"><?php echo JText::_('COM_TIMEWORKED_PROJECT'); ?></label>
					<select name="filter_project" id="filter_project" class="inputbox span12" data-placeholder="<?php echo JText::_('COM_TIMEWORKED_SELECT_PROJECT'); ?>">
						<option value=""></option>
						<?php echo JHtml::_('select.options', $this->projects, 'id', 'name', $this->filterProject); ?>
					</select>
				</div>

				<?php if ($this->canManageReports) : ?>
					<div class="tw-pull-left span6">
						<label for="filter_staff"><?php echo JText::_('COM_TIMEWORKED_STAFF'); ?></label>
						<select name="filter_staff" id="filter_staff" class="inputbox span12" data-placeholder="<?php echo JText::_('COM_TIMEWORKED_SELECT_USER'); ?>">
							<option value=""></option>
							<?php echo JHtml::_('select.options', $this->staff, 'id', 'name', $this->filterStaff); ?>
						</select>
					</div>
				<?php endif; ?>
				<div class="tw-pull-left span6 <?php echo(!$this->canManageReports ? 'odd' : ''); ?>">
					<label for="filter_date_month"><?php echo JText::_('JDATE'); ?></label>
					<select name="filter_date_month" id="filter_date_month" class="inputbox span12" data-placeholder="<?php echo JText::_('COM_TIMEWORKED_SELECT_DATE_INTERVAL'); ?>">
						<option value=""></option>
						<?php echo JHtml::_('select.options', $this->months, 'id', 'name', $this->filterDate); ?>
					</select>
					<span id="tw-precise-dates-button"><?php echo JText::_('COM_TIMEWORKED_PRECISE_DATES'); ?></span>
				</div>
				<div class="tw-pull-left span6">
					<div class="control-label">
						<label for="filter_keyword"><?php echo JText::_('COM_TIMEWORKED_FILTER_BY_KEYWORD'); ?></label>
					</div>
					<div class="controls">
						<input name="filter_keyword" id="filter_keyword" class="span12" type="text" value="<?php echo JFactory::getApplication()->input->getString('filter_keyword', ''); ?>" />
					</div>
				</div>
				<div class="tw-pull-left span6">
					<div class="control-label">
						<label for="filter_ticket"><?php echo JText::_('COM_TIMEWORKED_FILTER_BY_TICKET'); ?></label>
					</div>
					<div class="controls">
						<input name="filter_ticket" id="filter_ticket" class="span12" type="text" value="<?php echo JFactory::getApplication()->input->getString('filter_ticket', ''); ?>" />
					</div>
				</div>
                <?php if (JComponentHelper::getParams('com_timeworked')->get('enabled_tasks_list')) : ?>
				<div class="tw-pull-left span6">
					<label for="filter_task"><?php echo JText::_('COM_TIMEWORKED_FILTER_BY_TASK'); ?></label>
						<select name="filter_task" id="filter_task" class="inputbox span12" data-placeholder="<?php echo JText::_('COM_TIMEWORKED_SELECT_TASK'); ?>">
							<option value=""></option>
							<?php echo JHtml::_('select.options', $this->tasks, 'id', 'task', $this->filterTask); ?>
						</select>
				</div>
                <?php endif; ?>
			</div>
			<div class="tw-clearfix"></div>
		</div>
	</div>
	<div class="tw-clearfix"></div>
	<?php if ($this->canManageReports): ?>
		<div class="rejected-wrapper"></div>
	<?php endif; ?>

	<div class="tw-column-toggle tw-form-container">
		<div id="columnToggleSwitcher" class="tw-slide-switcher">
			<i class="fa fa-arrow-circle-up"></i><span class="not-link"><?php echo JText::_('COM_TIMEWORKED_MANAGE_TABLE'); ?></span>
		</div>
	</div>
	<div class="tw-responsive-table-container">
		<table class="table table-striped table-bordered table-hover tw-list" id="worklog-data">
			<thead>
			<tr>
				<th id="tw-head-company"><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_CLIENT', 'company', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?></th>
				<th id="tw-head-project_name"><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_PROJECT', 'project_name', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?></th>
				<?php if ($this->canManageReports) : ?>
					<th id="tw-head-user_name"><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_USER', 'user_name', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?></th>
				<?php endif; ?>
				<th id="tw-head-task"><?php echo JHtml::_('grid.sort', 'COM_TIMEWORKED_NAME', 'task', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?></th>
				<th id="tw-head-performed"><?php echo JText::_('COM_TIMEWORKED_PERFORMED'); ?></th>
				<?php if (JComponentHelper::getParams('com_timeworked')->get('enabled_ticket_number')): ?>
					<th id="tw-head-ticket_numbers"><?php echo JText::_('COM_TIMEWORKED_TASKID'); ?></th>
				<?php endif; ?>
				<th id="tw-head-hours"><?php echo JText::_('COM_TIMEWORKED_FROM'); ?></th>
				<th id="tw-head-hours"><?php echo JText::_('COM_TIMEWORKED_TO'); ?></th>
				<th id="tw-head-hours"><?php echo JText::_('COM_TIMEWORKED_HOURS'); ?></th>
				<?php if ($this->canManageReports): ?>
					<th id="tw-head-rejected"><?php echo JText::_('COM_TIMEWORKED_REJECTED'); ?></th>
					<th id="tw-head-billable"><?php echo JText::_('COM_TIMEWORKED_NOT_BILLABLE'); ?></th>
				<?php endif; ?>
				<?php if (($this->canEditOwn || $this->canEdit || $this->isAdmin || $this->canDelete)): ?>
					<?php
					$controlWidth = 0;
					if ($this->isAdmin || (($this->canEditOwn || $this->canEdit) && $this->canDelete))
					{
						$controlWidth = 31;
					}
					elseif (($this->canEditOwn || $this->canEdit) || $this->canDelete)
					{
						$controlWidth = 15;
					}
					?>
					<th id="tw-head-service" style="width:<?php echo $controlWidth; ?>px"><?php echo JText::_('COM_TIMEWORKED_EDITS'); ?></th>
				<?php endif; ?>
			</tr>
			</thead>
			<tbody>
			<?php if (count($this->worklog)) : ?>
				<?php foreach ($this->worklog as $item): ?>
					<tr class="row-date-<?php echo date('Y-m-d', $item->date); ?> row-<?php echo $item->id; ?><?php echo($item->rejected ? ' reject-highlight' : ''); ?>">
						<td class="row-company">
                            <span class="change-color block-icon-background" <?php if ($item->client_set_background_color): ?>style="background-color:<?php echo $item->client_color; ?>"<?php endif; ?>>
                                <?php echo JHtml::tooltip('', $item->company, '', (empty($item->client_short_name) ? $item->company : $item->client_short_name), '', false); ?>
                            </span>
						</td>
						<td class="row-project_name" data-project-id="<?php echo $item->projectid; ?>">
                            <span class="change-color block-icon-background" <?php if ($item->project_set_background_color): ?>style="background-color:<?php echo $item->project_color; ?>"<?php endif; ?>>
                                <?php echo JHtml::tooltip($item->project_description, $item->project_name, '', (empty($item->project_short_name) ? $item->project_name : $item->project_short_name), '', false); ?>
                            </span>
						</td>
						<?php if ($this->canManageReports) : ?>
							<td class="row-user_name"><?php echo $item->user_name; ?></td>
						<?php endif; ?>
						<td class="row-task" data-taskid="<?php echo $item->taskid; ?>"><?php echo $item->task; ?></td>
						<td class="row-performed"><?php echo nl2br($item->performed_work); ?></td>
						<?php if (JComponentHelper::getParams('com_timeworked')->get('enabled_ticket_number')): ?>
							<td class="row-ticket_numbers">
								<?php
								$taskIdArray = explode(',', $item->ticket_numbers);
								$taskIdCount = count($taskIdArray);
								?>
								<?php if ($item->bugtracker_url): ?>
									<?php foreach ($taskIdArray as $i => $taskid): ?>
										<a target="_blank" href="<?php echo $item->bugtracker_url . $taskid; ?>"><?php echo $taskid; ?></a><?php echo($taskIdCount > $i + 1 ? ', ' : ''); ?>
									<?php endforeach; ?>
								<?php else: ?>
									<?php foreach ($taskIdArray as $i => $taskid): ?>
										<?php echo $taskid; ?><?php echo($taskIdCount > $i + 1 ? ', ' : ''); ?>
									<?php endforeach; ?>
								<?php endif; ?>
							</td>
						<?php endif; ?>
						


						<td class="row-hours" nowrap>
							<?php echo $item->from; ?><?php if (!$item->time_worked_default): ?>
								<span
								class="change-color block-icon-background"
								style="background-color:<?php echo $item->time_worked_color; ?>"><?php
								echo empty($item->time_worked_short_name) ? $item->time_worked_type : JHtml::tooltip('', $item->time_worked_type, '', $item->time_worked_short_name, '', false);
								?></span><?php endif; ?>
                                <?php if (!$this->canManageReports && $item->rejected) : ?>
                                <span class="fa fa-exclamation-triangle reject"></span>
                                    <?php if ($item->rejected_comment) : ?>
                                <span class="fa fa-comment tw-in-red hasTooltip" data-original-title="<?php echo htmlentities($item->rejected_comment); ?>"></span>
                                    <?php endif; ?>
                                <?php endif; ?>
						</td>
						<td class="row-hours" nowrap>
							<?php echo $item->to; ?><?php if (!$item->time_worked_default): ?>
								<span
								class="change-color block-icon-background"
								style="background-color:<?php echo $item->time_worked_color; ?>"><?php
								echo empty($item->time_worked_short_name) ? $item->time_worked_type : JHtml::tooltip('', $item->time_worked_type, '', $item->time_worked_short_name, '', false);
								?></span><?php endif; ?>
                                <?php if (!$this->canManageReports && $item->rejected) : ?>
                                <span class="fa fa-exclamation-triangle reject"></span>
                                    <?php if ($item->rejected_comment) : ?>
                                <span class="fa fa-comment tw-in-red hasTooltip" data-original-title="<?php echo htmlentities($item->rejected_comment); ?>"></span>
                                    <?php endif; ?>
                                <?php endif; ?>
						</td>



						<td class="row-hours" nowrap>
							<?php echo $item->time; ?><?php if (!$item->time_worked_default): ?>
								<span
								class="change-color block-icon-background"
								style="background-color:<?php echo $item->time_worked_color; ?>"><?php
								echo empty($item->time_worked_short_name) ? $item->time_worked_type : JHtml::tooltip('', $item->time_worked_type, '', $item->time_worked_short_name, '', false);
								?></span><?php endif; ?>
                                <?php if (!$this->canManageReports && $item->rejected) : ?>
                                <span class="fa fa-exclamation-triangle reject"></span>
                                    <?php if ($item->rejected_comment) : ?>
                                <span class="fa fa-comment tw-in-red hasTooltip" data-original-title="<?php echo htmlentities($item->rejected_comment); ?>"></span>
                                    <?php endif; ?>
                                <?php endif; ?>
						</td>
						<?php if ($this->canManageReports): ?>
							<td class="row-rejected">
								<a class="fa fa-exclamation-triangle reject" href="<?php echo JRoute::_('index.php?option=com_timeworked&view=workentry&task=markAsRejected&id=' . $item->id); ?>"></a>
                                <?php if ($item->rejected && $item->rejected_comment) : ?>
                                <span class="fa fa-comment tw-in-red hasTooltip" data-original-title="<?php echo htmlentities($item->rejected_comment); ?>"></span>
                                <?php endif; ?>
							</td>
							<td class="row-billable">
								<?php $status = $item->billable ? 'billable' : 'not-billable'; ?>
								<a class="fa fa-ban billable-toggler <?php echo $status; ?>" href="<?php echo JRoute::_('index.php?option=com_timeworked&view=workentry&task=setNotBillable&id=' . $item->id . '&status=' . $status); ?>"></a>
							</td>
						<?php endif; ?>
						<?php if (($this->canEditOwn || $this->canEdit || $this->isAdmin || $this->canDelete || $this->canCreate)): ?>
							<td nowrap="nowrap" class="row-service">
								<?php if (ACLHelper::canEditItem($item->userid)): ?>
									<a class="fa fa-pencil-square-o edit" href="<?php echo JRoute::_('index.php?option=com_timeworked&view=workentry&task=edit&id=' . $item->id); ?>"></a>
								<?php endif; ?>
									<a class="fa fa-pencil-square-o fa-copy" href="#"></a>
								<?php if ($this->isAdmin || $this->canDelete): ?>
									<a class="fa fa-times-circle delete" href="<?php echo JRoute::_('index.php?option=com_timeworked&view=workentry&task=delete&id=' . $item->id); ?>"></a>
								<?php endif; ?>
							</td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="11">
						<p style="text-align: center">
							<strong><?php echo JText::_('JGLOBAL_SELECT_NO_RESULTS_MATCH'); ?></strong></p>
					</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
	<div class="list-footer">
		<table class="table table-bordered">
			<tr class="tw-total-page tw-page-total-gray"<?php if ($this->display_all): ?> style="display:none"<?php endif; ?>>
				<td style="text-align:right;border-right:none">
					<?php echo JText::_('COM_TIMEWORKED_CURRENT_PAGE_TOTAL'); ?>
				</td>
				<td class="tw-total-value tw-page-total-gray" style="text-align:left;border-left:none">
					<?php echo $this->summaryHoursDecorator($this->summaryPageHours); ?>
				</td>
			</tr>
			<tr class="tw-total-page-billable tw-page-total-gray"
                <?php if ($this->display_all || $this->summaryPageHours['_not_billable'] === '00:00'): ?> style="display:none"<?php endif; ?>>
				<td style="text-align:right;border-right:none">
					<?php echo JText::_('COM_TIMEWORKED_CURRENT_PAGE_TOTAL_BILLABLE'); ?>
				</td>
				<td class="tw-total-value tw-page-total-gray" style="text-align:left;border-left:none">
					<?php echo $this->summaryPageHours['_total_billable']; ?> <?php echo JText::_('COM_TIMEWORKED_TOTAL_HOURS'); ?>
				</td>
			</tr>
			<tr class="tw-total-summary"<?php if (!count($this->worklog)): ?> style="display:none"<?php endif; ?>>
				<td class="tw-total-name" style="text-align:right;border-right:none">
					<?php echo JText::_('COM_TIMEWORKED_TOTAL'); ?>
				</td>
				<td class="tw-total-value">
					<?php echo $this->summaryHoursDecorator($this->summaryHours); ?>
				</td>
			</tr>
			<tr class="tw-total-summary-billable"
                <?php if (!count($this->worklog) || $this->summaryHours['_not_billable'] === '00:00'): ?> style="display:none"<?php endif; ?>>
                <td class="tw-total-name" style="text-align:right;border-right:none">
					<?php echo JText::_('COM_TIMEWORKED_TOTAL_BILLABLE'); ?>
				</td>
				<td class="tw-total-value">
					<?php echo $this->summaryHours['_total_billable']; ?> <?php echo JText::_('COM_TIMEWORKED_TOTAL_HOURS'); ?>
				</td>
			</tr>
			<tr class="tw-paginator">
				<td colspan="2">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</table>
	</div>
	<div class="tw-footer tw-clearfix">
		<hr />
		<div class="tw-pull-right">
			<a class="tw-btn tw-excel" data-export-billable-type="xls" href="<?php echo JRoute::_('index.php?option=com_timeworked&view=worklog&format=xls'); ?>">Export to Excel</a>
			<?php
			$href = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1000,height=600,directories=no,location=no';
			$href = "window.open(this.href,'win2','" . $href . "'); return false;";
			?>
			<a class="tw-btn tw-print" data-export-billable-type="print" href="<?php echo JRoute::_('index.php?option=com_timeworked&view=worklog&format=print'); ?>" onclick="<?php echo $href; ?>">Print</a>
		</div>
	</div>
	</form>
	</div>
<?php else: ?>
	<p><?php echo JText::_('COM_TIMEWORKED_UNAUTHORIZED_ACCESS'); ?></p>
<?php endif; ?>
</div>

<script type="text/template" id="clndr-template">
	<!--@formatter:off-->
	<div class='clndr-controls'>
		<div class='clndr-control-button'>
			<span class="clndr-previous-year-button fa fa-arrow-circle-left"></span>
			<span class='clndr-previous-button fa fa-arrow-circle-left'></span>
		</div>
		<div class='title-date'><span class="month"><%= month %></span> <span class="year"><%= year %></span></div>
		<div class='clndr-control-button rightalign'>
			<span class="clndr-next-year-button fa fa-arrow-circle-right"></span>
			<span class='clndr-next-button fa fa-arrow-circle-right'></span>
		</div>
	</div>
	<table class='clndr-table' border='0' cellspacing='0' cellpadding='0'>
		<thead>
			<tr class='header-days'>
				<% for (var i = 0; i < daysOfTheWeek.length; i++) { %>
					<td class="header-day"><%= daysOfTheWeek[i] %></td>
				<% } %>
			</tr>
		</thead>
		<tbody>
			<tr class="clear">
				<td colspan="7"></td>
			</tr>
			<% for (var i = 0; i < numberOfRows; i++){ %>
				<tr>
					<% for (var j = 0; j < 7; j++){ %>
						<% var d = j + i * 7; %>
						<td class='<%= days[d].classes %>'>
							<div>
								<div class='day-contents'><%= days[d].day %></div>
								<div class='day-events-count <% if (days[d].events.length && days[d].events[0].has_rejected) { %>wt-has-rejected<% } %>'>
									<% if (days[d].events.length > 0) { %>
										<%= days[d].events[0].title %>
									<% } %>
								</div>
							</div>
						</td>
					<% } %>
				</tr>
			<% } %>
		</tbody>
	</table>
	<div class="clndr-today-button">
		<i class="fa fa-arrow-circle-right"></i>
		<span class="not-link">
			<?php echo JText::_('COM_TIMEWORKED_TODAY'); ?>, <span id="tw-today-date"></span>
		</span>
	</div>
	<!--@formatter:on-->
</script>
