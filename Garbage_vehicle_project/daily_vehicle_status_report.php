<?php
$page_name = "Daily Garage Report";
include "includes/header.php";
$date = date('Y-m-d', (strtotime(date('Y-m-d'))-86400));
if(isset($_POST['date'])){
	$date = $_POST['date'];
}
?>


<section class="content-header">
      <h1>
        Daily Garage Report
        <small>Date <strong><?php echo dateu($date);?></strong></small>      </h1>
      <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Report</strong></li>
		 <li class="active"><strong>Garage Report</strong></li>
		 <li class="active"><strong>Daily Report</strong></li>
</ol>
</section>
<br />



<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
    <tbody>
      <tr align="center" class="head_font">
        <td height="40" colspan="8" align="right" class="fnt">Select Entry Date : 
          <input type="date" name="date" required="required"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" class="head_font" /></td>
      </tr>
      <tr align="center" class="head_font" background="images\1by25.jpg">
        <td width="4%">Sl. No. </td>
        <td width="13%">Vehicle</td>
        <td width="28%"><span style="font-weight: bold">Incident</span></td>
        <td width="27%"><span style="font-weight: bold"> Garage In Details </span></td>
        <td width="28%">Remarks</td>
        <!-- <td width="28%">Attendance</td>
        <td width="11%">&nbsp;</td>
        <td colspan="2">&nbsp;</td>-->
        <!--<td width="17%">Incident &amp; Replaced Vehicle </td>
        <td width="15%">Refer</td>
        <td width="18%" height="40">Request</td>-->
      </tr>
      
      <tr align="center" >
        <td height="25" colspan="8">&nbsp;</td>
      </tr>
      <?php
	  
		  $fsql = "select * from vehicle_status_master where vsm_in_date like '$date%' order by vsm_id desc";
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
        <td align="center"><?php echo $i;?></td>
        <td align="center"><?php echo vehicle_name($fres['vsm_vm_id']);?></td>
        <td height="55" align="center"><table width="104%" height="49" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="42%" align="right"><strong>Incident</strong></td>
            <td width="6%" align="center">:</td>
            <td width="52%"><?php echo incident($fres['vsm_incident']);?></td>
          </tr>
          <tr>
            <td align="right" scope="row"><strong>Description</strong></td>
            <td align="center">:</td>
            <td><?php echo incident($fres['vsm_description']);?></td>
          </tr>
        </table>          </td>
		  <td height="55" align="center"><table width="104%" height="49" border="0" align="center" cellpadding="1" cellspacing="1">
            <tr>
              <td width="42%" align="right" scope="row"><strong>Refered Garage </strong></td>
              <td width="6%" align="center">:</td>
              <td width="52%"><?php echo garage_name($fres['vsm_garage']);?></td>
            </tr>
            <tr>
              <td align="right" scope="row"><strong>Refer By </strong></td>
              <td align="center">:</td>
              <td><?php echo emp_name($fres['vsm_refered_by']);?></td>
            </tr>
            <tr>
              <td align="right" scope="row"><strong>Enter By </strong></td>
              <td align="center">:</td>
              <td><?php echo emp_name($fres['vsm_in_by']);?></td>
            </tr>
          </table>	      </td>
		  <td height="55" align="center"><?php echo $fres['vsm_in_remarks'];?></td>
		  <!-- <td align="center">&nbsp;</td>
        <td width="10%" align="center">&nbsp;</td>
        <td width="14%" align="center">&nbsp;</td>-->
      </tr>
      <tr align="center" >
            <td height="25" colspan="8">&nbsp;</td>
    </tr>
	<?php $i++; }	
	if($i==1){
	?>
	<tr align="center" bgcolor="#CCCCCC" class="fnt">
            <td height="25" colspan="8"><strong>
			No Record Found			</strong></td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="8">&nbsp;</td>
    </tr>
	<?php }?>
    </tbody>
    <tr align="center" background="images\1by25.jpg" >
      <td height="22" colspan="8">&nbsp;</td>
    </tr>
</table>
  <p>&nbsp;</p>
</form>

<?php include "includes/footer.php";?>