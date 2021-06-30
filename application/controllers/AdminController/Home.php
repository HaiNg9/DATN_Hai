<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php');
require(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');

class Home extends My_Controller
{
    /**
     * Home page admin controller.
     */
    public function index()
    {
        $data['title'] = 'Trang chủ - quản trị';
        $data['focusMenu'] = 'DASHBOARD';
        $data['contentName'] = 'admin/pages/home';
        $data = $this->setLayoutDatatable($data);
        $data['script'][] = 'https://cdnjs.com/libraries/Chart.js';
        $data['countDashboard'] = [
            'posts' => $this->db->get('posts')->num_rows(),
            'comments' => $this->db->get('comments')->num_rows(),
            'users' => $this->db->get('users')->num_rows()
        ];
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Download excel file
     */
    public function download()
    {
        $tableName = $this->uri->segment(4);
        $file = './public/admin/upload/excel/' . $tableName . '.xlsx';
        $excel = null;

        if ($tableName === 'all') {
            $tables = [
                'users',
                'posts',
                'positions',
                'employees',
                'comments'
            ];

            $excel = PHPExcel_IOFactory::load($file);
            foreach ($tables as $name) {
                $excel = $this->getDataForSheetExcel($file, $name, $excel);
            }
            
            $tableName = 'common';

        } else {
            $excel = PHPExcel_IOFactory::load($file);
            $excel = $this->getDataForSheetExcel($file, $tableName, $excel);
        }
        header('Content-Type: application/vnd.ms-excel'); // mime type
        header('Content-Disposition: attachment;filename="'.$tableName.'_'.time().'.xlsx"'); // tell browser what's the file name
        header('Cache-Control: max-age=0'); // no cache
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $objWriter->save('php://output');
    }

    /**
     * Get data for sheet excel from database
     */
    private function getDataForSheetExcel($file, $tableName, $excel){

        $sheetUsers = $excel->getSheetByName($tableName);

        $data = $this->db->get($tableName)->result_array();
        
        $colName = 'A';
        $rowIndex = 2;
        $hasHeader = true;

        foreach ($data as $item) {
            foreach ($item as $key => $value) {
                if ($hasHeader) {
                    $sheetUsers->setCellValue($colName . '1', $key);
                }
                $sheetUsers->setCellValue($colName . (string)$rowIndex, $value);
                $colName++;
            }
            $rowIndex++;
            $colName = 'A';
            $hasHeader = false;
        }
        return $excel;
    }
}
