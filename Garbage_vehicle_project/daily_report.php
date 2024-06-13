<?php
$page_name = "Daily Report";
include "includes/header.php";
//Submit
if(isset($_POST['Submit']))
{	
	$dd_date = $_POST['dd_date'];
	$sql = "select * from daily_details where dd_date = '$dd_date'";
}
?>


<section class="content-header">
      <h1>
        Daily Report
        <small>&nbsp;</small>      </h1>
      <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Report</strong></li>
		 <li class="active"><strong>Daily Work Report</strong></li>
</ol>
</section>
<br />

<table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
    <tbody>
      <tr align="center" class="head_font">
        <td height="40" colspan="8" align="center" class="fnt"><input type="button" value="Selected Report Date : <?php echo dateu($dd_date);?>"/></td>
      </tr>
      <tr align="center" class="head_font" background="images\1by25.jpg">
        <td width="4%">Sl. No. </td>
        <td width="21%">Alloted Details </td>
        <td width="6%">Attendance</td>
        <td width="9%">No. of Trips </td>
        <td width="10%">Time</td>
        <td width="18%">Incident &amp; Replaced Vehicle </td>
        <td width="14%">Refer</td>
        <td width="18%" height="40">Request</td>
      </tr>
      
      <tr align="center" >
        <td height="25" colspan="17">&nbsp;</td>
      </tr>
      <?php
	
		  $rec = q($sql);
		  $i = 1;
		  while($fres = f($rec))
		  {
			if($i % 2 == 0)
			$col = "bgcolor='#E5E5E5'";
			else
			$col = "bgcolor='#D5D5D5'";
			
	  ?>
      <tr align="center" <?php echo $col;?>>
        <td align="center"><?php echo $i;?></td>
        <td height="55" align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr>
              <td height="25" align="right"><span style="font-weight: bold">Employee Name </span></td>
              <td align="center"><span style="font-weight: bold">:</span></td>
              <td align="left"><?php echo emp_name($fres['dd_emp_id']);?></td>
            </tr>
            <tr>
              <td width="44%" height="32" align="right"><span style="font-weight: bold">Vehicle</span></td>
              <td width="5%" align="center"><span style="font-weight: bold">:</span></td>
              <td width="51%" align="left"><strong><?php echo vehicle_name($fres['dd_vehicle']);?></strong></td>
            </tr>

            <tr>
              <td align="right"><span style="font-weight: bold">Ward No. </span></td>
              <td align="center"><span style="font-weight: bold">:</span></td>
              <td align="left"><?php echo $fres['dd_ward'];?></td>
            </tr>
          </table></td>
        <td align="center"><?php echo attendance($fres['dd_attn']);?></td>
        <td align="center"><?php echo $fres['dd_trips'];?></td>
        <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td width="35%" align="right"><strong>From</strong></td>
            <td width="7%" align="center"><strong>:</strong></td>
            <td width="58%" align="left"><?php echo $fres['dd_work_from'];?></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
          <tr>
            <td align="right"><strong>To</strong></td>
            <td align="center"><strong>:</strong></td>
            <td align="left"><?php echo $fres['dd_work_to'];?></td>
          </tr>
        </table></td>
        <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td width="32%" height="28" align="right"><strong>Incident</strong></td>
            <td width="5%" align="center"><strong>:</strong></td>
            <td width="63%" align="left"><?php echo incident($fres['dd_incident']);?></td>
          </tr>
		 
          <tr>
            <td height="28" align="right"><strong>Description</strong></td>
            <td align="center"><strong>:</strong></td>
            <td align="left"><?php echo incident($fres['dd_description']);?></td>
          </tr>
          <tr>
            <td align="right"><span style="font-weight: bold">Vehicle</span></td>
            <td align="center"><span style="font-weight: bold">:</span></td>
            <td align="left"><?php echo vehicle_name($fres['dd_replaced_vehicle']);?></td>
          </tr>
        </table></td>
        <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">

          <tr>
            <td width="35%" height="29" align="right"><strong> By </strong></td>
            <td width="12%" align="center"><strong>:</strong></td>
            <td width="53%" align="left"><?php echo emp_name($fres['dd_refer_by']);?></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
          <tr>
            <td align="right"><strong>Garage</strong></td>
            <td align="center"><strong>:</strong></td>
            <td align="left"><?php echo garage_name($fres['dd_garage']);?></td>
          </tr>
        </table></td>
        <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td align="right"><strong>By</strong></td>
            <td align="center"><strong>:</strong></td>
            <td align="left"><?php echo emp_name($fres['dd_request_by']);?></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
          <tr>
            <td width="24%" align="right"><strong>Duty </strong></td>
            <td width="9%" align="center"><strong>:</strong></td>
            <td width="67%" align="left"><?php echo $fres['dd_request_duty'];?></td>
          </tr>

        </table></td>
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
	<tr align="center" bgcolor="#CCCCCC" class="fnt">
            <td height="25" colspan="13"><strong>No Record Found</strong></td>
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

<?php include "includes/footer.php";?>