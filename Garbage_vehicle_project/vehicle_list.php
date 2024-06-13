<?php 
$page_name = "Vehicle List";
include "includes/header.php";
//DELETE
if(isset($_GET['Del']))
{
	$D = $_GET['Del'];
	$today = date('Y-m-d');
	$check = row_count("SELECT * FROM vehicle_master WHERE vm_id = '$D' and vm_status > '0'");
	if($check > 0){
		$gsql= "UPDATE vehicle_master SET vm_status = '0', vm_delete_date = '$today', vm_delete_by = '$_SESSION[lid]' WHERE vm_id='$D'";
		$grec= q($gsql);
		if($grec)
			echo alert_location_replace('Vehicle Details removed from the list.','vehicle_list.php');
		else
			echo error_alert_location_replace('vehicle_list.php');
	}
	else
		echo alert_location_replace('Vehicle Details already removed.', 'vehicle_list.php');
}
?>
<section class="content-header">
      <h1>
         Vehicle List
        <small>&nbsp;</small>
      </h1>
	  <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Vehicle Register</strong></li>
		 <li class="active"><strong>Vehicle List</strong></li>
</ol>
      
</section>
<p>&nbsp;</p>
<table width="80%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td height="59" align="center" valign="middle"><table width="43%" border="0" align="center" cellpadding="0" cellspacing="0" class="main_bod">
      <tr>
        <td height="60" align="center"><a href="emp_list_con.php?O=1"><img src="allicons/50.gif" width="75" height="48" border="0" /></a></td>
      </tr>
      <tr>
        <td height="30" align="center" background="images/1by25.jpg"><a href="emp_list_con.php" class="head_font">Auto</a></td>
      </tr>
    </table></td>
    <td align="center" valign="middle"><table width="44%" border="0" align="center" cellpadding="0" cellspacing="0" class="main_bod">
      <tr>
        <td height="60" align="center"><a href="emp_list_con.php?O=1"><img src="allicons/50.gif" width="75" height="48" border="0" /></a></td>
      </tr>
      <tr>
        <td height="30" align="center" background="images/1by25.jpg"><a href="emp_list_con.php" class="head_font">Truck</a></td>
      </tr>
    </table></td>
    <td align="center" valign="middle"><table width="46%" border="0" align="center" cellpadding="0" cellspacing="0" class="main_bod">
      <tr>
        <td height="60" align="center"><a href="emp_list_con.php?O=1"><img src="allicons/50.gif" width="75" height="48" border="0" /></a></td>
      </tr>
      <tr>
        <td height="30" align="center" background="images/1by25.jpg"><a href="emp_list_con.php" class="head_font">Tripper</a></td>
      </tr>
    </table></td>
    <td align="center" valign="middle"><table width="43%" border="0" align="center" cellpadding="0" cellspacing="0" class="main_bod">
      <tr>
        <td height="60" align="center"><a href="emp_list_con.php?O=1"><img src="allicons/50.gif" width="75" height="48" border="0" /></a></td>
      </tr>
      <tr>
        <td height="30" align="center" background="images/1by25.jpg"><a href="emp_list_con.php" class="head_font">Heavy Vehicle </a></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
  
  <tbody>
    <tr align="center" class="head_font" background="images\1by25.jpg">
      <td width="3%" height="40">Sl. No. </td>
      <td width="22%">Vehicle Details </td>
      <td width="20%" height="40">Vehicle Number Details </td>
      <td width="19%">GPS Details </td>
      <td width="25%">Other Details </td>
      <td width="11%" height="40">Options</td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="10">&nbsp;</td>
    </tr>
	<?php
	  $fsql = "select * from vehicle_master where vm_status > '0' order by vm_name asc" ;
	  $frec = q($fsql);
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
      <td><table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center">
		  	<a href="vehicle_register.php?Edit=<?php echo @$fres['vm_id'];?>">
            	<input type="image" name="imageField" src="allicons/68.gif" title="Edit Record" height="30" width="35" />
			</a>          </td>
          <!--<td align="center"><a href="#">
            <input type="image" name="imageField2" src="allicons/69.gif" title="View Record"/>
          </a></td>-->
          <td align="center">
            <a href="#" ><!--onclick="delet('vehicle_list.php?Del=<?php //echo @$fres['vm_id'];?>')"-->
				<input type="image" name="imageField22" src="allicons/70.gif" title="Delete Record" />          	
			</a>		  </td>
        </tr>
		<tr>
          <td align="center">
		  	<a href="vehicle_status_register.php?VID=<?php echo @$fres['vm_id'];?>&IN">
            	<input type="image" name="imageField" src="allicons/65.png" title="In Garage" height="30" width="35" />
			</a>          </td>
          <!--<td align="center"><a href="#">
            <input type="image" name="imageField2" src="allicons/69.gif" title="View Record"/>
          </a></td>-->
          <td align="center">
            <a href="vehicle_status_register.php?VID=<?php echo @$fres['vm_id'];?>&OUT" ><!--onclick="delet('vehicle_list.php?Del=<?php //echo @$fres['vm_id'];?>')"-->
				<input type="image" name="imageField22" src="allicons/66.png" title="Out Garage"  height="30" width="35" />          	
			</a>		  </td>
        </tr>
		
      </table></td>
    </tr>
    <tr align="center" >
            <td height="25" colspan="10">&nbsp;</td>
    </tr>
	<?php $i++; }
		if($i>1){
	?>
	<tr align="center" class="fnt" >
        <td height="58" colspan="28" valign="top" class="fnt" style="font-size:11px;"><table width="100%" border="0" cellspacing="1" cellpadding="1">
          	<tr>
            	<td align="center"><a href="export_vehicle_list.php"><img src="images/excel.png" height="40" border="0" /></a></td>
            	<td align="center"><a href="print_vehicle_list.php" target="_blank"><img src="images/print.png" height="38" /></a></td>
          	</tr>
        	</table>
		</td>
    </tr>
	<?php }else{?>
	<tr align="center" class="fnt" bgcolor="#CCCCCC">
            <td height="25" colspan="11"><span class="style3">No Record Found</span></td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="11">&nbsp;</td>
    </tr>
	<?php }?>
  </tbody>
  <tr align="center" background="images\1by25.jpg" >
            <td height="22" colspan="10">&nbsp;</td>
  </tr>
</table>  
  <br />
  
  
  
  
  <?php include "includes/footer.php";?>


