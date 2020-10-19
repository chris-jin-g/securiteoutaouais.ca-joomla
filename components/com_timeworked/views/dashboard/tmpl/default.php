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

$joomlaLanguageTag = JFactory::getLanguage()->getTag();
$jsLanguageTag     = 'en_GB';

$document = JFactory::getDocument();

$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/jquery-cookie/jquery.cookie.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/jquery-i18n/jquery.i18n.min.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/HTML5-History-API/history.min.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/underscore/underscore-min.js');

$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/changeColor.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/wt_lib.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/joomla_lib.js');

$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/flot/jquery.flot.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/flot/jquery.flot.resize.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/flot/jquery.flot.selection.js');

$document->addScriptDeclaration("
	jQuery(document).ready(function () {
		jQuery('.change-color').changeColor();
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

$document->addScriptDeclaration('jQuery.i18n.load(' . $jsLanguageTag . ');');

$document->addStyleSheet(JUri::base(true) . '/media/jui/css/chosen.css');
$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/styles/font-awesome/css/font-awesome.min.css');
$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/styles/bootstrap-2.css');
$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/styles/timeworked.css');
?>
<?php $columns = array('today', 'yesterday', 'thisWeek', 'prevWeek', 'thisMonth', 'prevMonth'); ?>

<script>
    jQuery(document).ready(function(){
        <?php if ($this->mytimeStats && count($this->mytimeStats['data'])) : ?>
        var __mytimeCharts = [
            <?php echo json_encode($this->mytimeChartsData); ?>,
            <?php echo $this->graphDays; ?>,
            "#mytime-tab-charts"
        ];
        jQuery.TimeWorked.dashboard.drawGraphic.apply(null, __mytimeCharts);
        jQuery('a[href="#mytime"]').one('shown.bs.tab', function(){
            jQuery.TimeWorked.dashboard.drawGraphic.apply(null, __mytimeCharts);
        });
        <?php endif; ?>
        <?php if ($this->canSeeProjectsTab) : ?>
        var __projectsCharts = [
            <?php echo json_encode($this->projectsChartsData); ?>,
            <?php echo $this->graphDays; ?>,
            "#projects-tab-charts"
        ];
        jQuery.TimeWorked.dashboard.drawGraphic.apply(null, __projectsCharts);
        jQuery('a[href="#projects"]').one('shown.bs.tab', function(){
            jQuery.TimeWorked.dashboard.drawGraphic.apply(null, __projectsCharts);
        });
        <?php endif; ?>
    });
</script>
<div id="tw-content-wrapper">
<h1><?php echo JText::_('COM_TIMEWORKED_DASHBOARD'); ?></h1>
<?php if (JFactory::getUser()->get('id') != 0): ?>
	<?php TimeWorkedHelper::keepalive(); ?>
	
    <ul class="nav nav-tabs">
        <?php if ($this->canSeeEmployeesTab) : ?>
        <li <?php if ($this->activeTab == 1): ?>class="active"<?php endif; ?>><a href="#employees" data-toggle="tab"><?php echo JText::_('COM_TIMEWORKED_EMPLOYEES'); ?></a></li>
        <?php endif; ?>
        <?php if ($this->canSeeProjectsTab) : ?>
        <li <?php if ($this->activeTab == 2): ?>class="active"<?php endif; ?>><a href="#projects" data-toggle="tab"><?php echo JText::_('COM_TIMEWORKED_PROJECTS'); ?></a></li>
        <?php endif; ?>
        <li <?php if ($this->activeTab == 3): ?>class="active"<?php endif; ?>><a href="#mytime" data-toggle="tab"><?php echo JText::_('COM_TIMEWORKED_MY_TIME'); ?></a></li>
    </ul>
    <div id="dashboard-data" class="tab-content">
        <div class="tab-pane <?php if ($this->activeTab == 3): ?>active<?php endif; ?>" id="mytime">
            <div class="">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                <?php echo JText::_('COM_TIMEWORKED_TODAY'); ?>
                            </th>
                            <th>
                                <?php echo JText::_('COM_TIMEWORKED_YESTERDAY'); ?>
                            </th>
                            <th>
                                <?php echo JText::_('COM_TIMEWORKED_THIS_WEEK'); ?>
                            </th>
                            <th>
                                <?php echo JText::_('COM_TIMEWORKED_PREV_WEEK'); ?>
                            </th>
                            <th>
                                <?php echo JText::_('COM_TIMEWORKED_THIS_MONTH'); ?>
                            </th>
                            <th>
                                <?php echo JText::_('COM_TIMEWORKED_PREV_MONTH'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($this->mytimeStats && count($this->mytimeStats['data'])) : ?>
                        <?php foreach ($this->mytimeStats['data'] as $empId => $row) : ?>
                        <tr>
                            <td></td>
                            <?php foreach ($columns as $col) : ?>
                            
                            <td>
                                <strong <?php if (!$row[$col]['sum']) :?>class="zero-values"<?php endif; ?>><?php echo TimeWorkedHelper::secToTime($row[$col]['sum']); ?></strong>
                                <?php if ($row[$col]['rejected']) : ?>
                                <br />
                                <span class="force-reject">
                                    <?php echo TimeWorkedHelper::secToTime($row[$col]['rejected']); ?>
                                </span>
                                <span class="fa fa-exclamation-triangle force-reject hasTooltip"
                                      data-original-title="<?php echo JTEXT::_('COM_TIMEWORKED_REJECTED'); ?>" ></span>
                                <?php endif; ?>
                                <?php if ($row[$col]['not_billable']) : ?>
                                <br />
                                <span class="force-reject">
                                    <?php echo TimeWorkedHelper::secToTime($row[$col]['not_billable']); ?>
                                </span>
                                <span class="fa fa-ban force-reject hasTooltip"
                                      data-original-title="<?php echo JTEXT::_('COM_TIMEWORKED_NOT_BILLABLE'); ?>" ></span>
                                <?php endif; ?>
                                <?php if (!empty($row[$col]['types'])) : ?>
                                <?php foreach ($row[$col]['types'] as $k => $v) : ?>
                                <?php if ($v) : ?>
                                <br />
                                <?php echo TimeWorkedHelper::secToTime($v); ?>
                                <span class="change-color block-icon-background hasTooltip" 
                                      data-original-title="<?php echo $this->mytimeStats['ttypes'][$k]['name']; ?>" 
                                      style="background: <?php echo $this->mytimeStats['ttypes'][$k]['color']; ?>">
                                          <?php echo $k; ?>
                                </span>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                            
                            <?php endforeach; ?>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td></td><td>00:00</td><td>00:00</td><td>00:00</td><td>00:00</td><td>00:00</td><td>00:00</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if ($this->mytimeStats && count($this->mytimeStats['data'])) : ?>
            <div class="">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <?php echo JText::_('COM_TIMEWORKED_PROJECT'); ?>
                            </th>
                            <th>
                                <?php echo JText::_('COM_TIMEWORKED_TODAY'); ?>
                            </th>
                            <th>
                                <?php echo JText::_('COM_TIMEWORKED_YESTERDAY'); ?>
                            </th>
                            <th>
                                <?php echo JText::_('COM_TIMEWORKED_THIS_WEEK'); ?>
                            </th>
                            <th>
                                <?php echo JText::_('COM_TIMEWORKED_PREV_WEEK'); ?>
                            </th>
                            <th>
                                <?php echo JText::_('COM_TIMEWORKED_THIS_MONTH'); ?>
                            </th>
                            <th>
                                <?php echo JText::_('COM_TIMEWORKED_PREV_MONTH'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($this->mytimeProjectStats && count($this->mytimeProjectStats['data'])) : ?>
                        <?php foreach ($this->mytimeProjectStats['data'] as $projId => $row) : ?>
                        <tr>
                            <td>
                                <a href="<?php echo JRoute::_('index.php?option=com_timeworked&view=worklog&filter_project=' . $projId . ($this->worklogMenuItemId ? '&Itemid=' . $this->worklogMenuItemId : '')); ?>"><?php echo $row['name']; ?></a>
                            </td>
                            <?php foreach ($columns as $col) : ?>
                            
                            <td>
                                <strong <?php if (!$row[$col]['sum']) :?>class="zero-values"<?php endif; ?>><?php echo TimeWorkedHelper::secToTime($row[$col]['sum']); ?></strong>
                                <?php if ($row[$col]['rejected']) : ?>
                                <br />
                                <span class="force-reject">
                                    <?php echo TimeWorkedHelper::secToTime($row[$col]['rejected']); ?>
                                </span>
                                <span class="fa fa-exclamation-triangle force-reject hasTooltip"
                                      data-original-title="<?php echo JTEXT::_('COM_TIMEWORKED_REJECTED'); ?>" ></span>
                                <?php endif; ?>
                                <?php if ($row[$col]['not_billable']) : ?>
                                <br />
                                <span class="force-reject">
                                    <?php echo TimeWorkedHelper::secToTime($row[$col]['not_billable']); ?>
                                </span>
                                <span class="fa fa-ban force-reject hasTooltip"
                                      data-original-title="<?php echo JTEXT::_('COM_TIMEWORKED_NOT_BILLABLE'); ?>" ></span>
                                <?php endif; ?>
                                <?php if (!empty($row[$col]['types'])) : ?>
                                <?php foreach ($row[$col]['types'] as $k => $v) : ?>
                                <?php if ($v) : ?>
                                <br />
                                <?php echo TimeWorkedHelper::secToTime($v); ?>
                                <span class="change-color block-icon-background hasTooltip" 
                                      data-original-title="<?php echo $this->mytimeProjectStats['ttypes'][$k]['name']; ?>" 
                                      style="background: <?php echo $this->mytimeProjectStats['ttypes'][$k]['color']; ?>">
                                          <?php echo $k; ?>
                                </span>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                            
                            <?php endforeach; ?>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="proj-graph-cont">
                    <div id="mytime-tab-charts" style="height:300px;width:100%;"></div>
                    <?php if (count($this->mytimeChartsData) > 3) : ?>
                    <div class="proj-graph-legend-controls">
                        <button class="btn btn-default btn-mini proj-select-all"><?php echo JText::_('COM_TIMEWORKED_SELECT_ALL'); ?></button>
                        <button class="btn btn-default btn-mini proj-select-all unsel"><?php echo JText::_('COM_TIMEWORKED_UNSELECT_ALL'); ?></button>
                    </div>
                    <?php endif; ?>
                    <div class="proj-graph-legend"></div>
                    <button class="tw-graph-show-all"><?php echo JText::_('COM_TIMEWORKED_SHOW_ALL'); ?></button>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <?php if ($this->canSeeEmployeesTab) : ?>
        <div class="tab-pane  <?php if ($this->activeTab == 1): ?>active<?php endif; ?>" id="employees">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <?php echo JText::_('COM_TIMEWORKED_EMPLOYEE'); ?>
                        </th>
                        <th>
                            <?php echo JText::_('COM_TIMEWORKED_TODAY'); ?>
                        </th>
                        <th>
                            <?php echo JText::_('COM_TIMEWORKED_YESTERDAY'); ?>
                        </th>
                        <th>
                            <?php echo JText::_('COM_TIMEWORKED_THIS_WEEK'); ?>
                        </th>
                        <th>
                            <?php echo JText::_('COM_TIMEWORKED_PREV_WEEK'); ?>
                        </th>
                        <th>
                            <?php echo JText::_('COM_TIMEWORKED_THIS_MONTH'); ?>
                        </th>
                        <th>
                            <?php echo JText::_('COM_TIMEWORKED_PREV_MONTH'); ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($this->employeesStats && count($this->employeesStats['data'])) : ?>
                    <?php foreach ($this->employeesStats['data'] as $empId => $row) : ?>
                    <tr>
                        <td>
                            <a href="<?php echo JRoute::_('index.php?option=com_timeworked&view=worklog&filter_staff=' . $empId . ($this->worklogMenuItemId ? '&Itemid=' . $this->worklogMenuItemId : '')); ?>"><?php echo $row['name']; ?></a>
                        </td>
                        <?php foreach ($columns as $col) : ?>

                        <td>
                            <strong <?php if (!$row[$col]['sum']) :?>class="zero-values"<?php endif; ?>><?php echo TimeWorkedHelper::secToTime($row[$col]['sum']); ?></strong>
                            <?php if ($row[$col]['rejected']) : ?>
                            <br />
                            <span class="force-reject">
                                <?php echo TimeWorkedHelper::secToTime($row[$col]['rejected']); ?>
                            </span>
                            <span class="fa fa-exclamation-triangle force-reject hasTooltip"
                                  data-original-title="<?php echo JTEXT::_('COM_TIMEWORKED_REJECTED'); ?>" ></span>
                            <?php endif; ?>
                            <?php if ($row[$col]['not_billable']) : ?>
                            <br />
                            <span class="force-reject">
                                <?php echo TimeWorkedHelper::secToTime($row[$col]['not_billable']); ?>
                            </span>
                            <span class="fa fa-ban force-reject hasTooltip"
                                  data-original-title="<?php echo JTEXT::_('COM_TIMEWORKED_NOT_BILLABLE'); ?>" ></span>
                            <?php endif; ?>
                            <?php if (!empty($row[$col]['types'])) : ?>
                            <?php foreach ($row[$col]['types'] as $k => $v) : ?>
                            <?php if ($v) : ?>
                            <br />
                            <?php echo TimeWorkedHelper::secToTime($v); ?>
                            <span class="change-color block-icon-background hasTooltip" 
                                  data-original-title="<?php echo $this->employeesStats['ttypes'][$k]['name']; ?>" 
                                  style="background: <?php echo $this->employeesStats['ttypes'][$k]['color']; ?>">
                                      <?php echo $k; ?>
                            </span>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </td>

                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
        <?php if ($this->canSeeProjectsTab) : ?>
        <div class="tab-pane  <?php if ($this->activeTab == 2): ?>active<?php endif; ?>" id="projects">
            <div class="proj-graph-cont">
                <div id="projects-tab-charts" style="height:300px;width:100%;"></div>
                <?php if (count($this->projectsChartsData) > 3) : ?>
                <div class="proj-graph-legend-controls">
                    <button class="btn btn-default btn-mini proj-select-all"><?php echo JText::_('COM_TIMEWORKED_SELECT_ALL'); ?></button>
                    <button class="btn btn-default btn-mini proj-select-all unsel"><?php echo JText::_('COM_TIMEWORKED_UNSELECT_ALL'); ?></button>
                </div>
                <?php endif; ?>
                <div class="proj-graph-legend"></div>
                <button class="tw-graph-show-all"><?php echo JText::_('COM_TIMEWORKED_SHOW_ALL'); ?></button>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <?php echo JText::_('COM_TIMEWORKED_PROJECT'); ?>
                        </th>
                        <th>
                            <?php echo JText::_('COM_TIMEWORKED_TODAY'); ?>
                        </th>
                        <th>
                            <?php echo JText::_('COM_TIMEWORKED_YESTERDAY'); ?>
                        </th>
                        <th>
                            <?php echo JText::_('COM_TIMEWORKED_THIS_WEEK'); ?>
                        </th>
                        <th>
                            <?php echo JText::_('COM_TIMEWORKED_PREV_WEEK'); ?>
                        </th>
                        <th>
                            <?php echo JText::_('COM_TIMEWORKED_THIS_MONTH'); ?>
                        </th>
                        <th>
                            <?php echo JText::_('COM_TIMEWORKED_PREV_MONTH'); ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($this->projectsStats && count($this->projectsStats['data'])) : ?>
                    <?php foreach ($this->projectsStats['data'] as $projId => $row) : ?>
                    <tr>
                        <td>
                            <a href="<?php echo JRoute::_('index.php?option=com_timeworked&view=worklog&filter_project=' . $projId . ($this->worklogMenuItemId ? '&Itemid=' . $this->worklogMenuItemId : '')); ?>"><?php echo $row['name']; ?></a>
                        </td>
                        <?php foreach ($columns as $col) : ?>

                        <td>
                            <strong <?php if (!$row[$col]['sum']) :?>class="zero-values"<?php endif; ?>><?php echo TimeWorkedHelper::secToTime($row[$col]['sum']); ?></strong>
                            <?php if ($row[$col]['rejected']) : ?>
                            <br />
                            <span class="force-reject">
                                <?php echo TimeWorkedHelper::secToTime($row[$col]['rejected']); ?>
                            </span>
                            <span class="fa fa-exclamation-triangle force-reject hasTooltip"
                                  data-original-title="<?php echo JTEXT::_('COM_TIMEWORKED_REJECTED'); ?>" ></span>
                            <?php endif; ?>
                            <?php if ($row[$col]['not_billable']) : ?>
                            <br />
                            <span class="force-reject">
                                <?php echo TimeWorkedHelper::secToTime($row[$col]['not_billable']); ?>
                            </span>
                            <span class="fa fa-ban force-reject hasTooltip"
                                  data-original-title="<?php echo JTEXT::_('COM_TIMEWORKED_NOT_BILLABLE'); ?>" ></span>
                            <?php endif; ?>
                            <?php if (!empty($row[$col]['types'])) : ?>
                            <?php foreach ($row[$col]['types'] as $k => $v) : ?>
                            <?php if ($v) : ?>
                            <br />
                            <?php echo TimeWorkedHelper::secToTime($v); ?>
                            <span class="change-color block-icon-background hasTooltip" 
                                  data-original-title="<?php echo $this->projectsStats['ttypes'][$k]['name']; ?>" 
                                  style="background: <?php echo $this->projectsStats['ttypes'][$k]['color']; ?>">
                                      <?php echo $k; ?>
                            </span>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </td>

                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
<div class="tw-gr-tooltip"></div>
<?php else: ?>
	<p><?php echo JText::_('COM_TIMEWORKED_UNAUTHORIZED_ACCESS'); ?></p>
<?php endif; ?>
</div>