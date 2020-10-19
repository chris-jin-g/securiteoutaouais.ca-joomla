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

$document = JFactory::getDocument();

$document->addStyleSheet(JUri::base(true) . '/media/jui/css/bootstrap.min.css');
$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/styles/timeworked_print.css');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php echo $document->getCharset(); ?>"/>
	<?php foreach($document->_styleSheets as $link=>$params): ?>
		<link href="<?php echo $link; ?>" media="all" rel="stylesheet" type="<?php echo $params['mime']; ?>" />
	<?php endforeach; ?>
</head>
<body>
<h1><?php echo $this->buildTitle(); ?></h1>
<?php if (JFactory::getUser()->get('id') != 0): ?>
	<table>
		<thead>
		<tr>
			<th><?php echo JText::_('COM_TIMEWORKED_CLIENT'); ?></th>
			<th><?php echo JText::_('COM_TIMEWORKED_PROJECT'); ?></th>
			<?php if ($this->isAdmin) : ?>
				<th><?php echo JText::_('COM_TIMEWORKED_USER'); ?></th>
			<?php endif; ?>
			<!-- <th><?php echo JText::_('JDATE'); ?></th> -->
			<th><?php echo JText::_('COM_TIMEWORKED_NAME'); ?></th>
			<th><?php echo JText::_('COM_TIMEWORKED_PERFORMED'); ?></th>
			<?php if (JComponentHelper::getParams('com_timeworked')->get('enabled_ticket_number')): ?>
				<th><?php echo JText::_('COM_TIMEWORKED_TASKID'); ?></th>
			<?php endif; ?>
			<th><?php echo JText::_('COM_TIMEWORKED_FROM'); ?></th>
			<th><?php echo JText::_('COM_TIMEWORKED_TO'); ?></th>
			<th><?php echo JText::_('COM_TIMEWORKED_HOURS'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php if (count($this->worklog)) : ?>
			<?php foreach ($this->worklog as $item): ?>
				<tr class="row-date-<?php echo date('Y-m-d', $item->date); ?> row-<?php echo $item->id; ?>">
					<td class="row-client">
						<?php echo empty($item->client_short_name) ? $item->company : $item->client_short_name; ?>
					</td>
					<td class="row-project">
						<?php echo empty($item->project_short_name) ? $item->project_name : $item->project_short_name; ?>
					</td>
					<?php if ($this->isAdmin) : ?>
						<td class="row-user"><?php echo $item->user_name; ?></td>
					<?php endif; ?>
					<!-- <td class="row-date" nowrap><?php echo DateFormatterHelper::format((int) $item->date); ?></td> -->
					<td class="row-task"><?php echo $item->task; ?></td>
					<td class="row-performed"><?php echo nl2br($item->performed_work); ?></td>
					<?php if (JComponentHelper::getParams('com_timeworked')->get('enabled_ticket_number')): ?>
						<td class="row-ticket_numbers"><?php echo str_replace(',', ', ', $item->ticket_numbers); ?></td>
					<?php endif; ?>

					<td class="row-hours" nowrap>
						<?php echo $item->from; ?>
						<?php if (!$item->time_worked_default): ?>
							[<?php echo empty($item->time_worked_short_name) ? $item->time_worked_type : $item->time_worked_short_name; ?>]
						<?php endif; ?>
					</td>
					<td class="row-hours" nowrap>
						<?php echo $item->to; ?>
						<?php if (!$item->time_worked_default): ?>
							[<?php echo empty($item->time_worked_short_name) ? $item->time_worked_type : $item->time_worked_short_name; ?>]
						<?php endif; ?>
					</td>

					<td class="row-hours" nowrap>
						<?php echo $item->time; ?>
						<?php if (!$item->time_worked_default): ?>
							[<?php echo empty($item->time_worked_short_name) ? $item->time_worked_type : $item->time_worked_short_name; ?>]
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
			<?php
			$colspanBig = $this->isAdmin ? 7 : 6;
			?>
			<tr>
				<td colspan="<?php echo $colspanBig-1; ?>" class="tw-total tw-total-name" style="text-align:right;border-right:none">
					<?php echo JText::_('COM_TIMEWORKED_TOTAL'); ?>
				</td>
				<td colspan="2" class="tw-total tw-total-value" style="text-align:left;border-left:none">
					<span class="summary_hours"><?php echo $this->summaryHoursDecorator($this->summaryHours); ?></span>
				</td>
			</tr>
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
<?php else: ?>
	<p><?php echo JText::_('COM_TIMEWORKED_UNAUTHORIZED_ACCESS'); ?></p>
<?php endif; ?>

<script>window.print()</script>
</body>
</html>