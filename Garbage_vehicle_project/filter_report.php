<?php
$page_name = "Filter Report"; 
include "includes/header.php";

if(isset($_GET['Submit']))
{
	$search 			= $_GET['search'];
	if($search == 1){
		//Employee Details	
			$emp_name 			= $_GET['emp_name'];
			$emp_fname 			= $_GET['emp_fname'];
			$emp_dob 			= $_GET['emp_dob'];
			$emp_desig 			= $_GET['emp_desig'];
			$emp_qualification 	= $_GET['emp_qualification'];
			$emp_doj			= $_GET['emp_doj'];
			$emp_aadhaar		= $_GET['emp_aadhaar'];
			$emp_licence		= $_GET['emp_licence'];
			$emp_pan			= $_GET['emp_pan'];
		//Contact Details
			$emp_mobile_1		= $_GET['emp_mobile_1'];
			$emp_mobile_2		= $_GET['emp_mobile_2'];
			$emp_ward			= $_GET['emp_ward'];
			$emp_pin			= $_GET['emp_pin'];
			$emp_address 		= $_GET['emp_address'];
			
			$sql = "select * from emp_master where emp_status > '0' ";
			if($emp_name != "")
				$sql.=" and emp_name like '$emp_name%'";
			if($emp_fname != "")
				$sql.=" and emp_fname like '$emp_fname%'";
			if($emp_dob != "")
				$sql.=" and emp_dob='$emp_dob'";
			if($emp_desig != "")
				$sql.=" and emp_desig='$emp_desig'";
			if($emp_qualification != "")
				$sql.=" and emp_qualification='$emp_qualification'";
			if($emp_doj != "")
				$sql.=" and emp_doj='$emp_doj'";
			if($emp_aadhaar != "")
				$sql.=" and emp_aadhaar='$emp_aadhaar'";
			if($emp_pan != "")
				$sql.=" and emp_pan='$emp_pan'";
			if($emp_licence != "")
				$sql.=" and emp_licence='$emp_licence'";
			if($emp_mobile_1 != "")
				$sql.=" and emp_mobile_1='$emp_mobile_1'";
			if($emp_mobile_2 != "")
				$sql.=" and emp_mobile_2='$emp_mobile_2'";
			if($emp_ward != "")
				$sql.=" and emp_ward='$emp_ward'";
			if($emp_pin != "")
				$sql.=" and emp_pan='$emp_pin'";
			if($emp_address != "")
				$sql.=" and emp_address like '%$emp_address%'";
	
			$sql.= " order by emp_name asc";
	}
	if($search == 2){
		//Vehicle Details
			$manufacturer 			= $_GET['manufacturer'];
			$model					= $_GET['model'];
			$vehicle_type			= $_GET['vehicle_type'];
			$vehicle_name			= $_GET['vehicle_name'];
			$fuel_type				= $_GET['fuel_type'];
			$starting_date			= $_GET['starting_date'];
		//Vehicle Number Details
			$tc_no					= $_GET['tc_no'];
			$vehicle_no				= $_GET['vehicle_no'];
			$chassis_no				= $_GET['chassis_no'];
			$engine_no				= $_GET['engine_no'];
		//Other Details
			$gps_presence			= $_GET['gps_presence'];
			$gps_id					= $_GET['gps_id'];
			$gps_installation_date	= $_GET['gps_installation_date'];
			$vehicle_status			= $_GET['vehicle_status'];
			$owned_by				= $_GET['owned_by'];
			
			$sql = "select * from vehicle_master where ";
			if($vehicle_status > '0')
				$sql.=" vm_status = '$vehicle_status' ";
			else
				$sql.="vm_status > '0' ";
			if($manufacturer != "")
				$sql.=" and vm_manufacturer = '$manufacturer' ";
			if($model != "")
				$sql.=" and vm_model = '$model' ";
			if($vehicle_type != "")
				$sql.=" and vm_vehicle_type='$vehicle_type' ";
			if($vehicle_name != "")
				$sql.=" and vm_name like '$vehicle_name%' ";
			if($fuel_type != "")
				$sql.=" and vm_fuel_type='$fuel_type' ";
			if($starting_date != "")
				$sql.=" and vm_start_date='$starting_date' ";
			if($tc_no != "")
				$sql.=" and vm_tc_no like '%$tc_no%' ";
			if($vehicle_no != "")
				$sql.=" and vm_number like '%$vehicle_no%' ";
			if($chassis_no != "")
				$sql.=" and vm_chassis_no='$chassis_no' ";
			if($engine_no != "")
				$sql.=" and vm_engine_no='$engine_no' ";
			if($gps_presence != "")
				$sql.=" and vm_gps_presence='$gps_presence' ";
			if($gps_id != "")
				$sql.=" and vm_gps_id='$gps_id' ";
			if($gps_installation_date != "")
				$sql.=" and vm_gps_installation_date='$gps_installation_date' ";
			if($owned_by != "")
				$sql.=" and vm_owned_by='$owned_by' ";
				
			$sql.=" order by vm_name asc";
	}
	if($search == 3){
		$dam_emp_id			= $_GET['dam_emp_id'];
		$dam_vehicle		= $_GET['dam_vehicle'];
		$dam_log_book		= $_GET['dam_log_book'];
		$dam_ward			= $_GET['dam_ward'];
		$dam_fuel_type		= $_GET['dam_fuel_type'];
		$dam_trips			= $_GET['dam_trips'];
		$dam_fuel_per_trip	= $_GET['dam_fuel_per_trip'];
		$dam_date			= $_GET['dam_date'];
		$dam_status			= $_GET['dam_status'];
		
		$sql = "select * from duty_allotment_master where ";
		if($dam_status == '0' || $dam_status == '1')
			$sql.=" dam_status = '$dam_status'";
		else
			$sql.=" dam_status != ''";
		if($dam_emp_id != '')
			$sql.=" and dam_emp_id = '$dam_emp_id'";
		if($dam_vehicle != '')
			$sql.=" and dam_vehicle = '$dam_vehicle'";
		if($dam_log_book != '')
			$sql.=" and dam_log_book = '$dam_log_book'";
		if($dam_ward != '')
			$sql.=" and dam_ward = '$dam_ward'";
		if($dam_fuel_type != '')
			$sql.=" and dam_fuel_type = '$dam_fuel_type'";
		if($dam_trips != '')
			$sql.=" and dam_trips = '$dam_trips'";
		if($dam_fuel_per_trip != '')
			$sql.=" and dam_fuel_per_trip = '$dam_fuel_per_trip'";
		if($dam_date != '')
			$sql.=" and dam_date = '$dam_date'";
		$sql.=" order by dam_date desc";
	}
}
//echo $sql;exit;
?>

<section class="content-header">
      <h1>
        Filter Report
        	<small> Search For <strong><?php if($_GET['search'] == 1){echo "Employee";}if($_GET['search'] == 2){echo "Vehicle";}if($_GET['search'] == 3){echo "Allotment";}?></strong></small>
      </h1>
      
</section>
<br>

<div align="right" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif";><strong>Total <?php echo row_count($sql);?> Records Found &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></div>
<?php if($search == 1){?>
	<table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
	  <tbody>
		<tr align="center" class="head_font" background="images\1by25.jpg">
		  <td width="5%"><b>Sl. No.</b></td>
		  <td width="26%" height="40"><strong>Employee Details </strong></td>
		  <td width="33%"><strong>Contact  Details </strong></td>
		  <td width="22%"><strong>Other Details </strong></td>
		</tr>
		<tr align="center" >
		  <td height="25" colspan="13">&nbsp;</td>
		</tr>
		<?php
			  $frec = q($sql);
			  $i = 1;
			  while($fres = f($frec))
			  {
				if($i % 2 == 0)
				$col = "bgcolor='#E5E5E5'";
				else
				$col = "bgcolor='#D5D5D5'";
				
		  ?>
		<tr align="center" <?php echo $col;?>>
		  <td height="122"><?php echo $i;?></td>
		  <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tr align="center">
			  <td align="right"><strong>Employee ID </strong></td>
			  <td><strong>:</strong></td>
			  <td align="left"><?php 
					if($fres['emp_id']>0 && $fres['emp_id']<10)
						$emp_id = "000".$fres['emp_id'];
					elseif($fres['emp_id']>=10 && $fres['emp_id']<100)
						$emp_id = "00".$fres['emp_id'];
					elseif($fres['emp_id']>=100 && $fres['emp_id']<1000)
						$emp_id = "0".$fres['emp_id'];
					else
						$emp_id = $fres['emp_id'];
					echo $emp_id;
				?>          </td>
			</tr>
			<tr align="center">
			  <td width="45%" align="right"><strong>Employee Name </strong></td>
			  <td width="6%"><strong>:</strong></td>
			  <td width="49%" align="left"><?php echo $fres['emp_name'];?></td>
			</tr>
			<tr align="center">
			  <td align="right"><strong> Father's Name</strong></td>
			  <td><strong>:</strong></td>
			  <td align="left"><?php echo $fres['emp_fname'];?></td>
			</tr>
			<tr align="center">
			  <td align="right"><strong>Designation</strong></td>
			  <td><strong>:</strong></td>
			  <td align="left"><?php echo desig_name($fres['emp_desig']);?></td>
			</tr>
			<tr align="center">
			  <td align="right"><strong>DOJ</strong></td>
			  <td><strong>:</strong></td>
			  <td align="left"><?php echo dateu($fres['emp_doj']);?></td>
			</tr>
		  </table></td>
		  <td align="center"><table width="101%" border="0" cellspacing="1" cellpadding="1">
			<tr align="center">
			  <td align="right"><strong>Mobile 1 </strong></td>
			  <td><strong>:</strong></td>
			  <td align="left"><?php echo $fres['emp_mobile_1'];?></td>
			</tr>
			<tr align="center">
			  <td align="right"><strong>Mobile 2 </strong></td>
			  <td><strong>:</strong></td>
			  <td align="left"><?php echo $fres['emp_mobile_2'];?></td>
			</tr>
			<tr align="center">
			  <td width="33%" align="right"><strong>Address</strong></td>
			  <td width="6%"><strong>:</strong></td>
			  <td width="61%" align="left"><?php echo $fres['emp_address'];?></td>
			</tr>
			<tr align="center">
			  <td align="right"><strong>Ward No. </strong></td>
			  <td><strong>:</strong></td>
			  <td align="left"><?php echo $fres['emp_ward'];?></td>
			</tr>
			<tr align="center">
			  <td align="right"><strong>PIN</strong></td>
			  <td><strong>:</strong></td>
			  <td align="left"><?php echo $fres['emp_pin'];?></td>
			</tr>
		  </table></td>
		  <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tr align="center" >
			  <td align="right"><strong>Aadhaar No </strong></td>
			  <td><strong>:</strong></td>
			  <td align="left"><?php echo $fres['emp_aadhaar'];?></td>
			</tr>
			<tr align="center" >
			  <td align="right"><strong>PAN No. </strong></td>
			  <td><strong>:</strong></td>
			  <td align="left"><?php echo $fres['emp_pan'];?></td>
			</tr>
			<tr align="center" >
			  <td width="41%" align="right"><strong>Qualification </strong></td>
			  <td width="6%"><strong>:</strong></td>
			  <td width="53%" align="left"><?php echo qual_name($fres['emp_qualification']);?></td>
			</tr>
		  </table></td>
		</tr>
		<tr align="center" >
		  <td height="25" colspan="8">&nbsp;</td>
		</tr>
		<?php $i++; }
			if($i>1){
		?>
		<!--<tr align="center" class="fnt" >
			<td height="58" colspan="28" valign="top" class="fnt" style="font-size:11px;"><strong><span class="fnt" style="font-size:11px;"><strong><a href="export_bank_list.php?"><img src="images/excel.png" height="40" border="0" /></a></strong></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="export_work_list.php"><img src="images/print.png" height="38" /></a></strong></td>
		</tr>-->
		<?php }else{?>
		<tr align="center" class="fnt" bgcolor="#CCCCCC">
		  <td height="25" colspan="9"><span class="style3">No Record Found</span></td>
		</tr>
		<tr align="center" >
		  <td height="25" colspan="9">&nbsp;</td>
		</tr>
		<?php }?>
	  </tbody>
	  <tr align="center" background="images\1by25.jpg" >
		<td height="22" colspan="13">&nbsp;</td>
	  </tr>
	</table>
<?php }	if($search == 2){?>
	<table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
	  <tbody>
		<tr align="center" class="head_font" background="images\1by25.jpg">
		  <td width="3%" height="40">Sl. No. </td>
		  <td width="22%">Vehicle Details </td>
		  <td width="20%" height="40">Vehicle Number Details </td>
		  <td width="19%">GPS Details </td>
		  <td width="25%">Other Details </td>
		</tr>
		<tr align="center" >
		  <td height="25" colspan="9">&nbsp;</td>
		</tr>
		<?php
		  $frec = q($sql);
		  $i = 1;
		  while($fres = f($frec))
		  {
			if($i % 2 == 0)
			$col = "bgcolor='#E5E5E5'";
			else
			$col = "bgcolor='#D5D5D5'";
			
			switch($fres['vm_status']){
				case 1:
					$vehicle_status = 'Active';
					break;
				case 2:
					$vehicle_status = 'In Garage';
					break;
			}
			
		  ?>
		<tr align="center" <?php echo $col;?>>
		  <td height="35"><?php echo $i;?></td>
		  <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tr>
			  <td width="43%" align="right"><strong>Manufacturer</strong></td>
			  <td width="4%" align="center"><span style="font-weight: bold">:</span></td>
			  <td width="53%" align="left"><?php echo vehicle_manufacturer($fres['vm_manufacturer']);?></td>
			</tr>
			<tr>
			  <td align="right"><strong>Model</strong></td>
			  <td align="center"><span style="font-weight: bold">:</span></td>
			  <td align="left"><?php echo vehicle_model($fres['vm_model']);?></td>
			</tr>
			<tr>
			  <td align="right"><strong>Type</strong></td>
			  <td align="center"><span style="font-weight: bold">:</span></td>
			  <td align="left"><?php echo vehicle_type($fres['vm_vehicle_type']);?></td>
			</tr>
			<tr>
			  <td align="right"><strong>Name</strong></td>
			  <td align="center"><span style="font-weight: bold">:</span></td>
			  <td align="left"><?php echo $fres['vm_name'];?></td>
			</tr>
		  </table></td>
		  <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tr>
			  <td width="40%" align="right"><strong>TC No. </strong></td>
			  <td width="6%" align="center"><span style="font-weight: bold">:</span></td>
			  <td width="54%" align="left"><?php echo $fres['vm_tc_no'];?></td>
			</tr>
			<tr>
			  <td align="right"><strong>Vehicle No. </strong></td>
			  <td align="center"><span style="font-weight: bold">:</span></td>
			  <td align="left"><?php echo $fres['vm_number'];?></td>
			</tr>
			<tr>
			  <td align="right"><strong>Chassis No. </strong> </td>
			  <td align="center"><span style="font-weight: bold">:</span></td>
			  <td align="left"><?php echo $fres['vm_chassis_no'];?></td>
			</tr>
			<tr>
			  <td align="right"><strong>Engine No. </strong></td>
			  <td align="center"><span style="font-weight: bold">:</span></td>
			  <td align="left"><?php echo $fres['vm_engine_no'];?></td>
			</tr>
		  </table></td>
		  <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tr>
			  <td width="52%" align="right"><strong>GPS Presence </strong></td>
			  <td width="6%" align="center"><span style="font-weight: bold">:</span></td>
			  <td width="42%" align="left"><?php echo gps_presence($fres['vm_gps_presence']);?></td>
			</tr>
			<tr>
			  <td align="right"><strong>GPS ID </strong></td>
			  <td align="center"><span style="font-weight: bold">:</span></td>
			  <td align="left"><?php echo $fres['vm_gps_id'];?></td>
			</tr>
			<tr>
			  <td align="right"><span style="font-weight: bold">Installation Date </span></td>
			  <td align="center"><span style="font-weight: bold">:</span></td>
			  <td align="left"><?php echo dateu($fres['vm_gps_installation_date']);?></td>
			</tr>
		  </table></td>
		  <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tr>
			  <td width="34%" align="right"><strong>Owned By </strong></td>
			  <td width="5%" align="center"><span style="font-weight: bold">:</span></td>
			  <td width="61%" align="left"><?php echo org_name($fres['vm_owned_by']);?></td>
			</tr>
			<tr>
			  <td align="right"><strong>Fuel Type </strong></td>
			  <td align="center"><span style="font-weight: bold">:</span></td>
			  <td align="left"><?php echo fuel_type($fres['vm_fuel_type']);?></td>
			</tr>
			<tr>
			  <td align="right"><span style="font-weight: bold">Starting Date </span></td>
			  <td align="center"><span style="font-weight: bold">:</span></td>
			  <td align="left"><?php echo dateu($fres['vm_start_date']);?></td>
			</tr>
			<tr>
			  <td align="right"><strong>Status</strong></td>
			  <td align="center"><strong>:</strong></td>
			  <td align="left"><strong><?php echo $vehicle_status;?></strong></td>
			</tr>
		  </table></td>
		</tr>
		<tr align="center" >
		  <td height="25" colspan="9">&nbsp;</td>
		</tr>
		<?php $i++; }
			if($i>1){
		?>
		<?php }else{?>
		<tr align="center" class="fnt" bgcolor="#CCCCCC">
		  <td height="25" colspan="10"><span class="style3">No Record Found</span></td>
		</tr>
		<tr align="center" >
		  <td height="25" colspan="10">&nbsp;</td>
		</tr>
		<?php }?>
	  </tbody>
	  <tr align="center" background="images\1by25.jpg" >
		<td height="22" colspan="9">&nbsp;</td>
	  </tr>
	</table>
<?php }if($search == 3){?>
	<table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
	  <tbody>
		<tr align="center" class="head_font" background="images\1by25.jpg">
		  <td width="5%">Sl. No.</td>
		  <td width="19%">Vehicle Name </td>
		  <td width="18%" height="40">Employee Name </td>
		  <td width="12%">Log Book No. </td>
		  <td width="11%">Alloted Ward No. </td>
		  <td width="15%">Fuel </td>
		  <td width="9%">No. of Trips Per Day </td>
		  <td width="11%">Alloted Date </td>
	    </tr>
		<tr align="center" >
		  <td height="25" colspan="17">&nbsp;</td>
		</tr>
		<?php
			  $frec = q($sql);
			  $i = 1;
			  while($fres = f($frec))
			  {
				if($i % 2 == 0)
				$col = "bgcolor='#E5E5E5'";
				else
				$col = "bgcolor='#D5D5D5'";
				
		  ?>
		<tr align="center" <?php echo $col;?>>
		  <td height="55"><?php echo $i;?></td>
		  <td align="center"><strong><?php echo $fres['vm_name'];?></strong></td>
		  <td align="center"><?php echo emp_name($fres['dam_emp_id']);?></td>
		  <td align="center"><?php echo $fres['dam_log_book'];?></td>
		  <td align="center"><?php echo $fres['dam_ward'];?></td>
		  <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tr>
			  <td width="42%" align="right"><strong>Type</strong></td>
			  <td width="14%" align="center"><strong>:</strong></td>
			  <td width="44%" align="left"><?php echo fuel_type($fres['dam_fuel_type']);?></td>
			</tr>
			<tr>
			  <td align="right"><strong>Per Trip </strong></td>
			  <td align="center"><strong>:</strong></td>
			  <td align="left"><?php echo $fres['dam_fuel_per_trip'];?> Ltr. </td>
			</tr>
		  </table></td>
		  <td align="center"><?php echo $fres['dam_trips'];?></td>
		  <td align="center"><?php echo dateu($fres['dam_date']);?></td>
	    </tr>
		<tr align="center" >
		  <td height="25" colspan="12">&nbsp;</td>
		</tr>
		<?php $i++; }
			if($i>1){
		?>
		<!--<tr align="center" class="fnt" >
			<td height="58" colspan="28" valign="top" class="fnt" style="font-size:11px;"><strong><span class="fnt" style="font-size:11px;"><strong><a href="export_bank_list.php?"><img src="images/excel.png" height="40" border="0" /></a></strong></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="export_work_list.php"><img src="images/print.png" height="38" /></a></strong></td>
		</tr>-->
		<?php }else{?>
		<tr align="center" class="fnt" bgcolor="#CCCCCC">
		  <td height="25" colspan="13"><span class="style3">No Record Found</span></td>
		</tr>
		<tr align="center" >
		  <td height="25" colspan="13">&nbsp;</td>
		</tr>
		<?php }?>
	  </tbody>
	  <tr align="center" background="images\1by25.jpg" >
		<td height="22" colspan="17">&nbsp;</td>
	  </tr>
	</table>
<?php }?>
<br>
	<?php include "includes/footer.php";?>
 