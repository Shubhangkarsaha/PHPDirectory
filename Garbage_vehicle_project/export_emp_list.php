<?php
session_start();
include "config.php";
include "connection/connection.php";
include "functions/functions.php";
//$SI = $_GET['scheme_id'];
//$salary_master_id = mysql_real_escape_string($_GET['scheme_id']);
// Have to catch cat_id to apply logic for hers category
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Kolkata');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");                 
      // Add some data
      $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'SL. NO.')
				  ->setCellValue('B1', 'Name')
				  ->setCellValue('C1', "Father's Name")
				  ->setCellValue('D1', 'DOB')
				  ->setCellValue('E1', 'DOJ')
				  ->setCellValue('F1', 'Mobile 1')
				  ->setCellValue('G1', 'Mobile 2')
				  ->setCellValue('H1', 'Address')
				  ->setCellValue('I1', 'Ward No.')
				  ->setCellValue('J1', 'PIN')
				  ->setCellValue('K1', 'Designation')
				  ->setCellValue('L1', 'Licence No.')
				  ->setCellValue('M1', 'Adhaar No.')
				  ->setCellValue('N1', 'PAN No.')
				  ->setCellValue('O1', 'Qualification');
				  /*->setCellValue('N1', 'Fuel Type')
				  ->setCellValue('O1', 'Starting Date');
				  ->setCellValue('P1', 'GROSS')
				  ->setCellValue('Q1', 'P.T')
				  ->setCellValue('R1', 'EPF')
				  ->setCellValue('S1', 'OTHERS( INCOME TAX )')
				  ->setCellValue('T1', 'TOTAL DEDUCTION')
				  ->setCellValue('U1', 'NETPAY');*/
                 
       $i=0;
	  
		$fsql = "select * from emp_master where emp_status = '1' order by emp_name asc" ;
		$frec = q($fsql);
		while($fres = f($frec)){
			
          $i++;
		  
          $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.($i+1), $i)
			->setCellValue('B'.($i+1), $fres['emp_name'])
  			->setCellValue('C'.($i+1), $fres['emp_fname'])
			->setCellValue('D'.($i+1), dateu($fres['emp_dob']))
			->setCellValue('E'.($i+1), dateu($fres['emp_doj']))
			->setCellValue('F'.($i+1), $fres['emp_mobile_1'])
			->setCellValue('G'.($i+1), $fres['emp_mobile_2'])
			->setCellValue('H'.($i+1), $fres['emp_address'])
			->setCellValue('I'.($i+1), $fres['emp_ward'])
			->setCellValue('J'.($i+1), $fres['emp_pin'])
			->setCellValue('K'.($i+1), desig_name($fres['emp_desig']))
			->setCellValue('L'.($i+1), " ".$fres['emp_licence'])
			->setCellValue('M'.($i+1), $fres['emp_aadhaar'])
			->setCellValue('N'.($i+1), " ".$fres['emp_pan'])
			->setCellValue('O'.($i+1), qual_name($fres['emp_qualification']));
			/*->setCellValue('N'.($i+1), fuel_type($fres['vm_fuel_type']))
			->setCellValue('O'.($i+1), dateu($fres['vm_start_date']));
			->setCellValue('P'.($i+1), $gross_amt = $fetch_emp['basic']+$fetch_emp['allow']+$fetch_emp['spallow']+$fetch_emp['oallow'])
			->setCellValue('Q'.($i+1), $fetch_emp['ptax'])
			->setCellValue('R'.($i+1), $epf_amt )
			->setCellValue('S'.($i+1), $fetch_emp['other_amt'])
			->setCellValue('T'.($i+1), $fetch_emp['other_amt'] + $epf_amt + $fetch_emp['ptax'])
			->setCellValue('U'.($i+1), $net_salary);*/
			}
		//die();
// Rename worksheet Title
$objPHPExcel->getActiveSheet()->setTitle('Master Roll');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//Can change file name
header('Content-Disposition: attachment;filename="Employee Details.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
