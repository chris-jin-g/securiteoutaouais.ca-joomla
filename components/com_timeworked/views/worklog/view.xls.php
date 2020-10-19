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
JLoader::import('views.worklog.general', JPATH_COMPONENT_SITE);

/**
 * View class for display a work log as Excel document.
 */
class TimeWorkedViewWorkLog extends TimeWorkedViewWorkLogGeneral
{
	public $clearNewLine;
	public $newLineSeparator;
	public $tableTitle;
	public $sheet;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 */
	public function display($tpl = 'xls')
	{
		TimeWorkedHelper::setDocument(JText::_('COM_TIMEWORKED_WORK_LOG'), $this->baseurl);

		JLoader::import('lib.PHPExcel.Classes.PHPExcel', JPATH_COMPONENT_SITE);

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()
			->setCreator("TimeWorked")
			->setLastModifiedBy("TimeWorked")
			->setTitle("TimeWorked Report")
			->setSubject("TimeWorked Report")
			->setDescription("TimeWorked")
			->setKeywords("office work report")
			->setCategory("TimeWorked");
		$this->sheet = $objPHPExcel->setActiveSheetIndex(0);

		$this->clearNewLine     = (bool) JComponentHelper::getParams('com_timeworked')->get('clear_new_line_excel');
		$this->newLineSeparator = JComponentHelper::getParams('com_timeworked')->get('excel_new_line_separator');
		$this->tableTitle       = $this->buildTableTitle();

		if ($this->clearNewLine)
		{
			switch ($this->newLineSeparator)
			{
				case '.':
				case ',':
				case ';':
					$this->newLineSeparator .= ' ';
					break;
				case '/':
				case '|':
					$this->newLineSeparator = ' ' . $this->newLineSeparator . ' ';
					break;
				case 'space':
					$this->newLineSeparator = ' ';
					break;
			}
		}

		parent::display($tpl);

		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment;filename=" . $this->buildTitle(true) . '.xlsx');
		header("Content-Transfer-Encoding: binary");

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');

		jexit();
	}

	protected function buildTableTitle()
	{
		$tableTitle = array(
			JText::_('COM_TIMEWORKED_CLIENT'),
			JText::_('COM_TIMEWORKED_PROJECT'),
		);

		if ($this->canManageReports)
		{
			$tableTitle[] = JText::_('COM_TIMEWORKED_USER');
		}

		$tableTitle = array_merge(
			$tableTitle, array(
				JText::_('COM_TIMEWORKED_NAME'),
				JText::_('COM_TIMEWORKED_PERFORMED'),
			)
		);

		if ($this->enabledTicketNumber)
		{
			$tableTitle[] = preg_replace('/&nbsp;/i', ' ', JText::_('COM_TIMEWORKED_TASKID'));
		}

		$tableTitle = array_merge(
			$tableTitle, array(
				JText::_('COM_TIMEWORKED_FROM'),
				JText::_('COM_TIMEWORKED_TO'),
				JText::_('COM_TIMEWORKED_HOURS'),
				JText::_('COM_TIMEWORKED_TIME_WORKED_TYPE'),
			)
		);

		return $tableTitle;
	}

	/**
	 * Get hours statistic with markup
	 *
	 * @param array $summaryHours hours array
	 *
	 * @return string formatted hours statistic
	 */
	public function summaryHoursDecorator($summaryHours)
	{
		$result = $summaryHours['_total'] . ' ' . JText::_('COM_TIMEWORKED_TOTAL_HOURS');

		foreach ($summaryHours as $name => $hours)
		{
			if ($name === '_default' || $name === '_total')
			{
				continue;
			}

			if ($name === '_rejected')
			{
				$name = strtolower(JText::_('COM_TIMEWORKED_REJECTED'));
			}

			$overtimeArr[] = $hours . ' ' . $name;
		}

		if (!empty($overtimeArr))
		{
			$result .= ' (' . implode(' / ', $overtimeArr) . ')';
		}

		return $result;
	}

	/**
	 * Get text color depending on background color
	 *
	 * @param string $backgroundColor background color in hex
	 *
	 * @return string text color in hex
	 */
	public function changeColor($backgroundColor)
	{
		$background    = $this->hexToDec($backgroundColor);
		$intBackground = round(($background['r'] * 299 + $background['g'] * 587 + $background['b'] * 114) / 1000);

		if ($intBackground > 125)
		{
			return '000000';
		}

		return 'ffffff';
	}

	/**
	 * Convert color in hex to rgb
	 *
	 * @param string $hex color in hex like #000 or #ffffff
	 *
	 * @return array red, green, blue
	 */
	public function hexToDec($hex)
	{
		$hex = str_replace("#", "", $hex);

		if (strlen($hex) == 3)
		{
			$r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
			$g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
			$b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
		}
		else
		{
			$r = hexdec(substr($hex, 0, 2));
			$g = hexdec(substr($hex, 2, 2));
			$b = hexdec(substr($hex, 4, 2));
		}

		return array('r' => $r, 'g' => $g, 'b' => $b);
	}

	public function getCellStyleArray($fontColor)
	{
		return array(
			'font' => array(
				'color' => array(
					'rgb' => $this->changeColor($fontColor),
				),
			),
			'fill' => array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
					'rgb' => str_replace('#', '', $fontColor),
				),
			),
		);
	}
}