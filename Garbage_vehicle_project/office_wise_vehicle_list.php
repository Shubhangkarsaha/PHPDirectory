<?php
$page_name = "Office Wise Vehicle List";
include "includes/header.php";

  if(isset($_GET['Office']))
	{
		$office = $_GET['Office'];
		$fsql = "select * from duty_allotment_master where dam_status > '0' and dam_borough_id = '$office' order by dam_id asc";
	}
  

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
			echo alert_location_replace('Vehicle Details removed from the list.','office_wise_vehicle_list.php');
		else
			echo error_alert_location_replace('allotment_list.php');
	}
	else
		echo alert_location_replace('Vehicle Details already removed.', 'office_wise_vehicle_list.php');
}

?>


<section class="content-header">
      <h1>
        Office Wise Vehicle List 
        <small>For</small> <strong><?php echo office_name($office);?></strong>     </h1>
		<ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong><?php echo office_name($office);?></strong></li>
		 <li class="active"><strong>Office Wise Vehicle List</strong></li>
</ol>
      
</section>
<br />
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td>
		<a href="<?php echo $_SERVER['HTTP_REFERER'];?>">
        	<input name="ImageField" type="image" src="allicons/67.gif" title="Click to back" height="30" width="35" />
      	</a>
	</td>
  </tr>
</table>

  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
    <tbody>
      <tr align="center" class="head_font" background="images\1by25.jpg">
        <td width="3%">Sl. No.</td>
        <td width="12%">Vehicle Name </td>
        <td width="13%" height="40">Employee Name </td>
        <td width="9%">Log Book No. </td>
        <td width="11%">Alloted Ward No. </td>
        <td width="13%">Fuel  </td>
        <td width="11%">No. of Trips Per Day </td>
        <td width="8%">Alloted Date </td>
        <td width="10%" height="40">Options</td>
      </tr>
      <tr align="center" >
        <td height="25" colspan="18">&nbsp;</td>
      </tr>
      <?php
	  
	  
		 
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
        <td align="center"><strong><?php echo vehicle_name($fres['dam_vehicle']);?></strong></td>
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
              <td width="36%" align="center"><a href="office_wise_update_allotment.php?DAMID=<?php echo $fres['dam_id']."&Office=".$fres['dam_borough_id'];?>">
                <input type="image" name="imageField2" src="allicons/allot3.png" title="Allotment" height="30" width="35"/>
              </a>              
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