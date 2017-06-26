<?php

namespace common\components\excel;

use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;

$vendor = Yii::getAlias('@vendor');
require_once($vendor.'/PHPExcel/Classes/PHPExcel.php');

class BaseExcel
{
    private $instance = null;
    public $subject='please-set-subject';
    public $sheetWidth = 15;
    public $fileName = 'temp-filename';
    public $sheetHeader = [];
    public $sheetCellList = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N',
        'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB',
        'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN',
        'AO', 'AP', 'AQ', 'AR', 'AS',
    ];

    public function sheetList()
    {
        return [
            1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E',
            6 => 'F', 7 => 'G', 8 => 'H', 9 => 'I', 10 => 'J',
            11 => 'K', 12 => 'L', 13 => 'M', 14 => 'N', 15 => 'O',
            16 => 'P', 17 => 'Q', 18 => 'R', 19 => 'S', 20 => 'T',
            21 => 'U', 22 => 'V', 23 => 'W', 24 => 'X', 25 => 'Y',
            26 => 'Z', 27 => 'AA', 28 => 'AB', 29 => 'AC', 30 => 'AD',
            31 => 'AE', 32 => 'AF', 33 => 'AG', 34 => 'AH', 35 => 'AI',
            36 => 'AJ', 37 => 'AK', 38 => 'AL', 39 => 'AM', 40 => 'AN',
            41 => 'AO', 42 => 'AP', 43 => 'AQ', 44 => 'AR', 45 => 'AS',
        ];
    }

    public function __construct()
    {
        $this->instance = new \PHPExcel();
    }

    public function getExcelObject()
    {
        if (!$this->instance) {
            throw new Exception('Not Found Instance');
        }
        return $this->instance;
    }

    private function getSheetHeader($item)
    {
        if (!$this->sheetHeader) {
            if (is_object($item)) {
                $headers = array_keys($item->attributes);
            } elseif (is_array($item)) {
                $headers = array_keys($item);
            } else {
                throw new Exception('无效的数据模型');
            }

            if (!$headers) {
                throw new Exception('无效的数据模型');
            }
            $this->sheetHeader = $headers;
        }
        return $this->sheetHeader;
    }

    private function getSheetValues($item)
    {
        if (is_object($item)) {
            $values = array_values($item->attributes);
        } elseif (is_array($item)) {
            $values = array_values($item);
        } else {
            throw new Exception('无效的数据模型');
        }

        if (!$values) {
            throw new Exception('无效的数据模型');
        }
        return $values;
    }

    /**
     * 通用的excel表格导出
     * @param object|array $dataModel
     */
    public function run($dataModel)
    {
        $phpExcel = $this->instance;
        $n = 0;

        foreach ( $dataModel as $product )
        {
            //表格头
            $header = $this->getSheetHeader($product);
            // 总列数
            $columnNum = count($header);
            // 最后一列数对应的标示
            $columnEnd = array_search($columnNum + 1 ,array_flip($this->sheetList()));

            //报表头的输出
            $phpExcel->getActiveSheet()->mergeCells('A1:' . $columnEnd . '1');
            $phpExcel->getActiveSheet()->setCellValue('A1',$this->subject);

            $phpExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(24);
            $phpExcel->setActiveSheetIndex(0)->getStyle('A1')
                ->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $phpExcel->setActiveSheetIndex(0)->setCellValue('A2','日期：'.date("Y年m月j日"));
            $phpExcel->setActiveSheetIndex(0)->getStyle($columnEnd .'2')
                ->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT)->getActiveSheet()->mergeCells('A2:' . $columnEnd . '2');

            //表格头的输出
            $header = $this->getSheetHeader($product);
            $phpExcel->setActiveSheetIndex(0)->setCellValue($this->sheetCellList[0].'3' ,'#');
            $phpExcel->getActiveSheet()->getColumnDimension($this->sheetCellList[0])->setWidth($this->sheetWidth);
            foreach ($header as $key => $h) {
                $key = $key + 1;
                $phpExcel->setActiveSheetIndex(0)->setCellValue($this->sheetCellList[$key].'3' ,$h);
                $phpExcel->getActiveSheet()->getColumnDimension($this->sheetCellList[$key])->setWidth($this->sheetWidth);
            }

            //明细的输出
            $attributeValues = $this->getSheetValues($product);
            $phpExcel->getActiveSheet()->setCellValue($this->sheetCellList[0].($n+4), $n+1);
            foreach ($attributeValues as $key => $v) {
                $key = $key + 1;
                $phpExcel->getActiveSheet()->setCellValue($this->sheetCellList[$key].($n+4) ,$v);
            }
            $n = $n +1;
        }
        $phpExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        $phpExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

        ob_end_clean();
        ob_start();
        header('Content-Type : application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="'.$this->fileName.'.xls"');
        $objWriter= \PHPExcel_IOFactory::createWriter($phpExcel,'Excel5');
        $objWriter->save('php://output');
    }

    /**
     * 特定模版的excel表格导出
     * @param string $templateClassName @模版类名
     * @param object|array $dataModel
     */
    public function templateRun($templateClassName, $dataModel)
    {
        var_dump($templateClassName);
    }
}