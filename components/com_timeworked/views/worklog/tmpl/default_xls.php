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

PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);

$startColumn  = 'A';
$columnsCount = 7;

if ($this->canManageReports)
{
	$columnsCount++;
}

if ($this->enabledTicketNumber)
{
	$columnsCount++;
}

// Header
$this->sheet->setCellValueByColumnAndRow($startColumn, 2, $this->buildTitle());
$this->sheet->getStyle($startColumn . '2')->applyFromArray(array('font' => array('bold' => true)));
$this->sheet->mergeCells($startColumn . '2:' . chr(64 + count($this->tableTitle)) . '2');

// Table head
$this->sheet->fromArray($this->tableTitle, null, 'A4');
$this->sheet->getStyle($startColumn . '4:' . chr(64 + count($this->tableTitle)) . '4')->applyFromArray(
	array(
		'fill'         => array(
			'type'       => PHPExcel_Style_Fill::FILL_SOLID,
			'startcolor' => array('rgb' => 'A9D5FD'),
		),
		'numberformat' => array(
			'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
		),
	)
);
$bodyStartRow = 6;
// Table body
foreach ($this->worklog as $i => $item)
{
	$rowNumber   = $bodyStartRow + $i;
	$displayItem = array(
		$item->company,
		$item->project_name,
	);

	if ($this->canManageReports)
	{
		$displayItem[] = $item->user_name;
	}

	$date = new DateTime();
	$date->setTimestamp($item->date);
	$displayItem = array_merge(
		$displayItem, array(
			// PHPExcel_Shared_Date::PHPToExcel($date),
			$item->task,
			(!$this->clearNewLine ? $item->performed_work : preg_replace('/\r?\n/', $this->newLineSeparator, $item->performed_work)),
		)
	);

	if ($this->enabledTicketNumber)
	{
		$displayItem[] = str_replace(',', ', ', $item->ticket_numbers);
	}

	$timeType    = ($item->time_worked_default ? '' : $item->time_worked_type);
	$displayItem = array_merge(
		$displayItem, array(
            $item->from,
            $item->to,
			$item->time,
			$timeType,
		)
	);

	$this->sheet->fromArray($displayItem, null, $startColumn . $rowNumber);

	if ($item->client_set_background_color)
	{
		$this->sheet->getStyleByColumnAndRow(ord($startColumn) - 65, $rowNumber)->applyFromArray($this->getCellStyleArray($item->client_color));
	}

	if ($item->project_set_background_color)
	{
		$this->sheet->getStyleByColumnAndRow(ord($startColumn) - 65, $rowNumber)->applyFromArray($this->getCellStyleArray($item->project_color));
	}

	if (!empty($timeType))
	{
		$this->sheet->getStyleByColumnAndRow(ord($startColumn) - 65 + $columnsCount - 1, $rowNumber)
			->applyFromArray($this->getCellStyleArray($item->time_worked_color));
		$this->sheet->getStyleByColumnAndRow(ord($startColumn) - 65 + $columnsCount - 2, $rowNumber)
			->applyFromArray($this->getCellStyleArray($item->time_worked_color));
	}
}

$this->sheet->getStyle($startColumn . '5:' . chr(64 + $columnsCount) . (count($this->worklog) + 6))
	->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

$dateColumn = chr(ord($startColumn) + ($this->canManageReports ? 3 : 2));
$this->sheet->getStyle($dateColumn . '5:' . $dateColumn . (count($this->worklog) + 6))->getNumberFormat()->setFormatCode('D MMM YYYY');

// Center tickets, time, time type columns
$this->sheet->getStyle(chr(64 + $columnsCount - ($this->enabledTicketNumber ? 2 : 1)) . '5:' . chr(64 + $columnsCount) . (count($this->worklog) + 6))
	->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Set columns width
$column = $startColumn;

$this->sheet->getColumnDimension($column)->setAutoSize(false)->setWidth(14);
$column = chr(ord($column) + 1);

$this->sheet->getColumnDimension($column)->setAutoSize(false)->setWidth(18);
$column = chr(ord($column) + 1);

if ($this->canManageReports)
{
	$this->sheet->getColumnDimension($column)->setAutoSize(false)->setWidth(22);
	$column = chr(ord($column) + 1);
}

$this->sheet->getColumnDimension($column)->setAutoSize(false)->setWidth(12);
$column = chr(ord($column) + 1);

$this->sheet->getColumnDimension($column)->setAutoSize(false)->setWidth(35);
$column = chr(ord($column) + 1);

$this->sheet->getColumnDimension($column)->setAutoSize(false)->setWidth(50);
$column = chr(ord($column) + 1);

if ($this->enabledTicketNumber)
{
	$this->sheet->getColumnDimension($column)->setAutoSize(false)->setWidth(12);
	$column = chr(ord($column) + 1);
}

$this->sheet->getColumnDimension($column)->setAutoSize(false)->setWidth(10);
$column = chr(ord($column) + 1);

$this->sheet->getColumnDimension($column)->setAutoSize(false)->setWidth(10);

$rejectedHours = isset($this->summaryHours['_rejected']) ? $this->summaryHours['_rejected'] : 0;
$rowPointer = count($this->worklog) + $bodyStartRow;
if ($rejectedHours) {
    $rejectedCell = array($columnsCount - 3, ++$rowPointer);
    $this->sheet->setCellValueByColumnAndRow($rejectedCell[0], $rejectedCell[1], JText::_('COM_TIMEWORKED_REJECTED') . ':');
    $this->sheet->getStyleByColumnAndRow($rejectedCell[0], $rejectedCell[1])->applyFromArray(
        array(
            'font'      => array(
                'italic' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
                'wrapText'   => true,
            ),
        )
    );

    $rejectedCellValue = array($columnsCount - 2, (count($this->worklog) + $bodyStartRow + 1));
    $this->sheet->setCellValueByColumnAndRow($rejectedCellValue[0], $rejectedCellValue[1], $rejectedHours);
    $this->sheet->getStyleByColumnAndRow($rejectedCellValue[0], $rejectedCellValue[1])->applyFromArray(
        array(
            'font'      => array(
                'italic' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
                'wrapText'   => true,
            ),
        )
    );
}

$timeTypeRows = 0;
foreach ($this->summaryHours as $type => $hours) {
    if (!in_array($type, array('_default', '_total', '_rejected', '_not_billable', '_total_billable'))) {
        $cellCoords = array(
            'x' => $columnsCount - 3, 
            'y' => ++$rowPointer
        );
        $this->sheet->setCellValueByColumnAndRow($cellCoords['x'], $cellCoords['y'], $type . ':');
        $this->sheet->getStyleByColumnAndRow($cellCoords['x'], $cellCoords['y'])->applyFromArray(
            array(
                'font' => array(
                    'italic' => true,
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
                    'wrapText'   => true,
                ),
            )
        );

        $this->sheet->setCellValueByColumnAndRow($cellCoords['x'] + 1, $cellCoords['y'], $hours);
        $this->sheet->getStyleByColumnAndRow($cellCoords['x'] + 1, $cellCoords['y'])->applyFromArray(
            array(
                'font'      => array(
                    'italic' => true,
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
                    'wrapText'   => true,
                ),
            )
        );
        
        $timeTypeRows ++;
    }
}
$totalCell = array($columnsCount - 3, ++$rowPointer);
$this->sheet->setCellValueByColumnAndRow($totalCell[0], $totalCell[1], JText::_('COM_TIMEWORKED_TOTAL'));
$this->sheet->getStyleByColumnAndRow($totalCell[0], $totalCell[1])->applyFromArray(
	array(
		'font'      => array(
			'bold' => true,
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
			'wrapText'   => true,
		),
	)
);

$totalCellValue = array($columnsCount - 2, $rowPointer);
$this->sheet->setCellValueByColumnAndRow($totalCellValue[0], $totalCellValue[1], $this->summaryHours['_total']);
$this->sheet->getStyleByColumnAndRow($totalCellValue[0], $totalCellValue[1])->applyFromArray(
	array(
        'font'      => array(
			'bold' => true,
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
			'wrapText'   => true,
		),
	)
);
if ($this->summaryHours['_not_billable'] !== '00:00') {
    $notBillableCell = array($columnsCount - 3, ++$rowPointer);
    $this->sheet->setCellValueByColumnAndRow($notBillableCell[0], $notBillableCell[1], JText::_('COM_TIMEWORKED_NOT_BILLABLE'));
    $this->sheet->getStyleByColumnAndRow($notBillableCell[0], $notBillableCell[1])->applyFromArray(
        array(
            'font'      => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
                'wrapText'   => true,
            ),
        )
    );
    $notBillableCellValue = array($columnsCount - 2, $rowPointer);
    $this->sheet->setCellValueByColumnAndRow($notBillableCellValue[0], $notBillableCellValue[1], $this->summaryHours['_not_billable']);
    $this->sheet->getStyleByColumnAndRow($notBillableCellValue[0], $notBillableCellValue[1])->applyFromArray(
        array(
            'font'      => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
                'wrapText'   => true,
            ),
        )
    );
    
    $billableCell = array($columnsCount - 3, ++$rowPointer);
    $this->sheet->setCellValueByColumnAndRow($billableCell[0], $billableCell[1], JText::_('COM_TIMEWORKED_TOTAL_BILLABLE'));
    $this->sheet->getStyleByColumnAndRow($billableCell[0], $billableCell[1])->applyFromArray(
        array(
            'font'      => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
                'wrapText'   => true,
            ),
        )
    );
    $billableCellValue = array($columnsCount - 2, $rowPointer);
    $this->sheet->setCellValueByColumnAndRow($billableCellValue[0], $billableCellValue[1], $this->summaryHours['_total_billable']);
    $this->sheet->getStyleByColumnAndRow($billableCellValue[0], $billableCellValue[1])->applyFromArray(
        array(
            'font'      => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
                'wrapText'   => true,
            ),
        )
    );
    
}
//$this->sheet->mergeCells(chr(65 + $totalCellValue[0]) . $totalCellValue[1] . ':' . chr(66 + $totalCellValue[0]) . $totalCellValue[1]);

$this->sheet->getStyle($startColumn . '1:' . chr(64 + $columnsCount) . (count($this->worklog) + $bodyStartRow))->getAlignment()->setWrapText(true);
