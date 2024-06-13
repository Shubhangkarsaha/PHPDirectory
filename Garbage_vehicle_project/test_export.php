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
				  ->setCellValue('B1', 'Beneficiary Name')
				  ->setCellValue('C1', 'Address')
				  ->setCellValue('D1', 'Scheme Name')
				  ->setCellValue('E1', 'Purpose')
				  ->setCellValue('F1', 'Ward No.')
				  ->setCellValue('G1', 'Bank Name')
				  ->setCellValue('H1', 'Branch Name')
				  ->setCellValue('I1', 'Account No.')
				  ->setCellValue('J1', 'Amount')
				  ->setCellValue('K1', 'Application Date')
				  ->setCellValue('L1', 'File Status');
				 /* ->setCellValue('M1', 'Bank Name')
				  ->setCellValue('N1', 'Branch Name')
				  ->setCellValue('O1', 'Date of MIC meeting');
				 /* ->setCellValue('P1', 'GROSS')
				  ->setCellValue('Q1', 'P.T')
				  ->setCellValue('R1', 'EPF')
				  ->setCellValue('S1', 'OTHERS( INCOME TAX )')
				  ->setCellValue('T1', 'TOTAL DEDUCTION')
				  ->setCellValue('U1', 'NETPAY');*/
                 
       $i=0;
	   //	AND emp_master.present_posted='1' is deleted from the query 	
	 // echo "SELECT * FROM benificiary_master bm, bank_master bkm, branch_master brm, type_master tm , borough_master bom where bm.ben_type = tm.type_id and bm.ben_bank_id = bkm.bank_id and bm.ben_branch_id = brm.branch_id and bm.ben_scheme_id = '$SI' and bm.ben_status = '0' AND bm.ben_ward_no in bom.under_ward";
	 // exit;
	   $sel_emp = "select * from benificiary_master bm, purpose_master pm, scheme_master sm, bank_master bkm, branch_master bcm ,ward_master wm where bm.bank_id = bkm.bank_id and bm.branch_id = bcm.branch_id and wm.ward_id = bm.ben_ward and bm.ben_scheme_id=sm.scheme_id and bm.ben_purpose_id=pm.prps_id and bm.status = '0' "  ;// INNER JOIN emp_master ON emp_master.emp_id=salary_master_items.emp_id INNER JOIN borough_master ON borough_master.boro_id = emp_master.present_posted INNER JOIN category_master ON category_master.cat_id = emp_master.category INNER JOIN dept_master ON emp_master.department=dept_master.dept_id INNER JOIN desig_master ON emp_master.desig=desig_master.desig_id INNER JOIN fund_master ON fund_master.fund_id=emp_master.fund_id WHERE salary_master_items.salary_mas_id='$salary_master_id' and emp_master.emp_deleted ='0' ORDER by emp_master.emp_name ASC");
         if(isset($_GET['FS']))
	  {
		  $fs = $_GET['FS'];
		  $sel_emp = $sel_emp."and bm.file_status='$fs' ";
	  }
	  $sel_emp = $sel_emp."order by bm.ben_id desc";
	  $sel_emp_rec = q($sel_emp);
		while($fetch_emp = f($sel_emp_rec)){
			// for sub department
			
			$ben_file_fres = qf("SELECT file_status FROM benificiary_master where ben_id = '$fetch_emp[ben_id]'");//for file status
			$ben_file = $ben_file_fres['file_status'];
			//echo $ben_file;exit;
			
				if($ben_file == '2')
				{
					$ben_file_status = 'Inprocess';
				}
			elseif($ben_file == '4')
				{
					$ben_file_status = 'Passed';
				}
			elseif($ben_file == '0')
				{
					$ben_file_status = 'Received';
				}
				//echo $ben_file_status;exit;
				
			/*while($boro_row > 1)
			{
				$boro_ward = borough_ward($boro_row);
				//echo $boro_ward;exit;
				$boro_fres = qf("select boro_short_form from borough_master where '$fetch_emp[ben_ward_no]' IN ($boro_ward) and boro_id = '$boro_row'");
				$boro_office = $boro_fres['boro_short_form'];
				if(($boro_office == 'I') || ($boro_office == 'II') || ($boro_office == 'III') || ($boro_office == 'IV') || ($boro_office == 'V'))
				{
					break;
				}
				else
					$boro_row--;
			}*/
			//echo $boro_row;exit;
		
			
			// echo "select boro_short_form  from borough_master where '$fetch_emp[ben_ward_no]' in under_ward";exit;
				//$boro_fres = qf("select * from borough_master");
				//$ward = "SELECT boro_short_form from borough_master ";
				/*$ward_rec = q($ward_sql);
				$ward_fres = f($ward_rec);*/
				//$boro_short_form = 0;//$ward_fres['boro_short_form'];
			 
          $i++;
		  $date = date_reverse($fetch_emp['ben_app_date']);

		//  $net_salary = round($fetch_emp['net_salary']);
		 // $epf_amt = round($fetch_emp['epf_amt']);
		  //$total_deduc = 
		  
          $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.($i+1), $i)
			->setCellValue('B'.($i+1), $fetch_emp['ben_name'])
  			->setCellValue('C'.($i+1), $fetch_emp['ben_address'])
			->setCellValue('D'.($i+1), $fetch_emp['scheme_name'])
			->setCellValue('E'.($i+1), $fetch_emp['prps_name'])
			->setCellValue('F'.($i+1), $fetch_emp['ben_ward'])
			->setCellValue('G'.($i+1), $fetch_emp['bank_name'])
			->setCellValue('H'.($i+1), $fetch_emp['branch_name'])
			->setCellValue('I'.($i+1), " ".$fetch_emp['ben_acc_no'])
			->setCellValue('J'.($i+1), $fetch_emp['ben_ammount'])
			->setCellValue('K'.($i+1), $date)
			->setCellValue('L'.($i+1), $ben_file_status); // error occures due to same name in the data base. have to use single single attribute selection method 
			/*->setCellValue('M'.($i+1), $fetch_emp['bank_name'])
			->setCellValue('N'.($i+1), $fetch_emp['branch_name'])
			->setCellValue('O'.($i+1), $fetch_emp['ben_mic_meeting']);
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
header('Content-Disposition: attachment;filename="Benificiary Details.xlsx"');
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
