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
				  ->setCellValue('B1', 'Manufacturer')
				  ->setCellValue('C1', 'Model')
				  ->setCellValue('D1', 'Type')
				  ->setCellValue('E1', 'Name')
				  ->setCellValue('F1', 'TC No.')
				  ->setCellValue('G1', 'Vehicle No.')
				  ->setCellValue('H1', 'Chassis No.')
				  ->setCellValue('I1', 'Engine No.')
				  ->setCellValue('J1', 'GPS Presence')
				  ->setCellValue('K1', 'GPS ID')
				  ->setCellValue('L1', 'GPS Installation Date')
				  ->setCellValue('M1', 'Owned By')
				  ->setCellValue('N1', 'Fuel Type')
				  ->setCellValue('O1', 'Starting Date');
				  /*->setCellValue('P1', 'GROSS')
				  ->setCellValue('Q1', 'P.T')
				  ->setCellValue('R1', 'EPF')
				  ->setCellValue('S1', 'OTHERS( INCOME TAX )')
				  ->setCellValue('T1', 'TOTAL DEDUCTION')
				  ->setCellValue('U1', 'NETPAY');*/
                 
       $i=0;
	  
		$fsql = "select * from vehicle_master where vm_status > '0' order by vm_name asc" ;
		$frec = q($fsql);
		while($fres = f($frec)){
			
          $i++;
		  
          $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.($i+1), $i)
			->setCellValue('B'.($i+1), vehicle_manufacturer($fres['vm_manufacturer']))
  			->setCellValue('C'.($i+1), vehicle_model($fres['vm_model']))
			->setCellValue('D'.($i+1), vehicle_type($fres['vm_vehicle_type']))
			->setCellValue('E'.($i+1), $fres['vm_name'])
			->setCellValue('F'.($i+1), " ".$fres['vm_tc_no'])
			->setCellValue('G'.($i+1), " ".$fres['vm_number'])
			->setCellValue('H'.($i+1), " ".$fres['vm_chassis_no'])
			->setCellValue('I'.($i+1), " ".$fres['vm_engine_no'])
			->setCellValue('J'.($i+1), gps_presence($fres['vm_gps_presence']))
			->setCellValue('K'.($i+1), $fres['vm_gps_id'])
			->setCellValue('L'.($i+1), dateu($fres['vm_gps_installation_date']))
			->setCellValue('M'.($i+1), org_name($fres['vm_owned_by']))
			->setCellValue('N'.($i+1), fuel_type($fres['vm_fuel_type']))
			->setCellValue('O'.($i+1), dateu($fres['vm_start_date']));
			/*->setCellValue('P'.($i+1), $gross_amt = $fetch_emp['basic']+$fetch_emp['allow']+$fetch_emp['spallow']+$fetch_emp['oallow'])
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
header('Content-Disposition: attachment;filename="Vehicle Details.xlsx"');
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
