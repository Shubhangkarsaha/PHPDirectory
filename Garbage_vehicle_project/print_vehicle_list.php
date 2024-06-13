<?php 
session_start();
include "config.php";
include "connection/connection.php";
include "functions/functions.php";
?><title>Print Vehicle List</title>
<section class="content-header">
      <h1>
         Vehicle List
        <small>&nbsp;</small>
      </h1>
      
</section>
<br>

<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" >
  
  <tbody>
    <tr align="center">
      <td width="3%" height="40"><strong>Sl. No. </strong></td>
      <td width="22%"><strong>Vehicle Details </strong></td>
      <td width="20%" height="40"><strong>Vehicle Number Details </strong></td>
      <td width="19%"><strong>GPS Details </strong></td>
      <td width="25%"><strong>Other Details </strong></td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="9">&nbsp;</td>
    </tr>
	<?php
	  $fsql = "select * from vehicle_master where vm_status > '0' order by vm_name asc" ;
	  $frec = q($fsql);
	  $i = 1;
	  while($fres = f($frec))
	  {
		
	  ?>
    <tr align="center" >
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
      </table></td>
    </tr>
	<?php $i++; }
		if($i>1){
	?>
	<?php }else{?>
	<tr align="center" class="fnt">
            <td height="25" colspan="10"><span class="style3">No Record Found</span></td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="10">&nbsp;</td>
    </tr>
	<?php }?>
  </tbody>
</table>  
  <script>
  	window.print();
  </script>

