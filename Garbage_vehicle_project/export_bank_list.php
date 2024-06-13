<?php
session_start();
include "connection/connection.php";
include "config.php";
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
				  ->setCellValue('B1', 'Bank Name');
				/*  ->setCellValue('C1', 'Branch Name')
				  ->setCellValue('D1', 'IFSC Code');
				  ->setCellValue('E1', 'IFSC Code')
				  ->setCellValue('F1', 'B/Sl. No.')
				  ->setCellValue('G1', 'Name of Sanctioned Beneficiary')
				  ->setCellValue('H1', 'Name of deceased Husband')
				  ->setCellValue('I1', 'Type')
				  ->setCellValue('J1', 'Period')
				  ->setCellValue('K1', 'Bank Account No.')
				  ->setCellValue('L1', 'IFSC Code')
				  ->setCellValue('M1', 'Bank Name')
				  ->setCellValue('N1', 'Branch Name')
				  ->setCellValue('O1', 'Date of MIC meeting');
				  ->setCellValue('P1', 'GROSS')
				  ->setCellValue('Q1', 'P.T')
				  ->setCellValue('R1', 'EPF')
				  ->setCellValue('S1', 'OTHERS( INCOME TAX )')
				  ->setCellValue('T1', 'TOTAL DEDUCTION')
				  ->setCellValue('U1', 'NETPAY');*/
                 
       $i=0;
	   //	AND emp_master.present_posted='1' is deleted from the query 	
	 // echo "SELECT * FROM benificiary_master bm, bank_master bkm, branch_master brm, type_master tm , borough_master bom where bm.ben_type = tm.type_id and bm.ben_bank_id = bkm.bank_id and bm.ben_branch_id = brm.branch_id and bm.ben_scheme_id = '$SI' and bm.ben_status = '0' AND bm.ben_ward_no in bom.under_ward";
	 // exit;
	   $sel_emp = q("select * from bank_master where bank_status = '0'");// INNER JOIN emp_master ON emp_master.emp_id=salary_master_items.emp_id INNER JOIN borough_master ON borough_master.boro_id = emp_master.present_posted INNER JOIN category_master ON category_master.cat_id = emp_master.category INNER JOIN dept_master ON emp_master.department=dept_master.dept_id INNER JOIN desig_master ON emp_master.desig=desig_master.desig_id INNER JOIN fund_master ON fund_master.fund_id=emp_master.fund_id WHERE salary_master_items.salary_mas_id='$salary_master_id' and emp_master.emp_deleted ='0' ORDER by emp_master.emp_name ASC");
        while($fetch_emp = f($sel_emp)){
			// for sub department
			
			// echo "select boro_short_form  from borough_master where '$fetch_emp[ben_ward_no]' in under_ward";exit;
				//$boro_fres = qf("select * from borough_master");
				//$ward = "SELECT boro_short_form from borough_master ";
				/*$ward_rec = q($ward_sql);
				$ward_fres = f($ward_rec);*/
				//$boro_short_form = 0;//$ward_fres['boro_short_form'];
			 
          $i++;
		  
		//  $net_salary = round($fetch_emp['net_salary']);
		 // $epf_amt = round($fetch_emp['epf_amt']);
		  //$total_deduc = 
		  
          $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.($i+1), $i)
			->setCellValue('B'.($i+1), $fetch_emp['bank_name']);
  			/*->setCellValue('C'.($i+1), $fetch_emp['branch_name'])
			->setCellValue('D'.($i+1), " ".$fetch_emp['ifsc']);
			->setCellValue('E'.($i+1), $boro_short_form)
			->setCellValue('F'.($i+1), $fetch_emp['ben_boro_sl'])
			->setCellValue('G'.($i+1), $fetch_emp['ben_name'])
			->setCellValue('H'.($i+1), $fetch_emp['ben_fname'])
			->setCellValue('I'.($i+1), $fetch_emp['type_name'])
			->setCellValue('J'.($i+1), $i)
			->setCellValue('K'.($i+1), " ".$fetch_emp['ben_acc_no'])
			->setCellValue('L'.($i+1), $fetch_emp['ifsc']) // error occures due to same name in the data base. have to use single single attribute selection method 
			->setCellValue('M'.($i+1), $fetch_emp['bank_name'])
			->setCellValue('N'.($i+1), $fetch_emp['branch_name'])
			->setCellValue('O'.($i+1), $fetch_emp['ben_mic_meeting']);*/
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
header('Content-Disposition: attachment;filename="Bank Details.xlsx"');
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
