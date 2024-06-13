<?php
$page_name = "Allotment List";
include "includes/header.php";
//DELETE
if(isset($_GET['Del']))
{
	$D = $_GET['Del'];
	$today = date('Y-m-d');
	$check = row_count("SELECT * FROM duty_allotment_master WHERE dam_id = '$D' and dam_status > '0'");
	if($check > 0){
		$gsql= "UPDATE duty_allotment_master SET dam_status = '0', dam_delete_date = '$today', dam_delete_by = '$_SESSION[lid]' WHERE dam_id='$D'";
		$grec= q($gsql);
		if($grec)
			echo alert_location_replace('Allotment Details removed from the list.','allotment_list.php');
		else
			echo error_alert_location_replace('allotment_list.php');
	}
	else
		echo alert_location_replace('Allotment Details already removed.', 'allotment_list.php');
}
?>


<section class="content-header">
      <h1>
        Allotment List
        <small>&nbsp;</small>      </h1>
		<ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Allotment Register</strong></li>
		 <li class="active"><strong>Allotment List</strong></li>
</ol>
      
</section>
<br />
  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
    <tbody>
      <tr align="center" class="head_font" background="images\1by25.jpg">
        <td width="4%">Sl. No.</td>
        <td width="17%">Vehicle Name </td>
        <td width="16%" height="40">Employee Name </td>
        <td width="11%">Log Book No. </td>
        <td width="10%">Alloted Ward No. </td>
        <td width="11%">Fuel  </td>
        <td width="10%">No. of Trips Per Day </td>
        <td width="10%">Alloted Date </td>
        <td width="11%" height="40">Options</td>
      </tr>
      <tr align="center" >
        <td height="25" colspan="18">&nbsp;</td>
      </tr>
      <?php
	
		  $fsql = "select * from duty_allotment_master dam, vehicle_master vm where dam.dam_vehicle = vm.vm_id and dam.dam_status = '1' order by vm.vm_name asc";
		  $frec = q($fsql);
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
            <td align="left"><?php echo $fres['dam_fuel_per_trip'];?></td>
          </tr>
        </table>
        </td>
        <td align="center"><?php echo $fres['dam_trips'];?></td>
        <td align="center"><?php echo dateu($fres['dam_date']);?></td>
        <td><table width="96%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="36%" height="43" align="center"><a href="allotment_list.php?Del=<?php echo $fres['dam_id'];?>">
                <input type="image" name="imageField" src="allicons/70.gif" title="Edit Record" height="30" width="35"/>
              </a>
			  
			  
            <!-- <td width="32%" align="center"><a href="" onclick="delet('emp_list.php?Del=<?php //echo $fres['emp_id'];?>')" >
                <input type="image" name="imageField22" src="allicons/70.gif" title="Delete Record" />
              </a></td>-->            </tr>
        </table></td>
      </tr>
      <tr align="center" >
            <td height="25" colspan="13">&nbsp;</td>
    </tr>
	<?php $i++; }
		if($i>1){
	?>
	<!--<tr align="center" class="fnt" >
        <td height="58" colspan="28" valign="top" class="fnt" style="font-size:11px;"><strong><span class="fnt" style="font-size:11px;"><strong><a href="export_bank_list.php?"><img src="images/excel.png" height="40" border="0" /></a></strong></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="export_work_list.php"><img src="images/print.png" height="38" /></a></strong></td>
    </tr>-->
	<?php }else{?>
	<tr align="center" class="fnt" bgcolor="#CCCCCC">
            <td height="25" colspan="14"><span class="style3">No Record Found</span></td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="14">&nbsp;</td>
    </tr>
	<?php }?>
    </tbody>
    <tr align="center" background="images\1by25.jpg" >
      <td height="22" colspan="18">&nbsp;</td>
    </tr>
</table>


<?php include "includes/footer.php";?>