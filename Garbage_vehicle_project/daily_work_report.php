<?php
$page_name = "Daily Work Report";
include "includes/header.php";
$date = date('Y-m-d', (strtotime(date('Y-m-d'))-86400));
if(isset($_POST['date'])){
	$date = $_POST['date'];
}
?>


<section class="content-header">
      <h1>
        Daily Work Report
        <small>For <strong><?php echo dateu($date);?></strong></small>      </h1>
      
</section>
<br />
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
    <tbody>
      <tr align="center" class="head_font">
        <td height="40" colspan="7" align="right" class="fnt">Select Working Date : <input type="date" name="date" required="required"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" class="head_font" /></td>
      </tr>
      <tr align="center" class="head_font" background="images\1by25.jpg">
        <td width="6%">Sl. No. </td>
        <td width="22%"><span style="font-weight: bold">Employee Name </span></td>
        <td width="17%"><span style="font-weight: bold">Vehicle</span></td>
        <td width="20%"><span style="font-weight: bold">Ward No.</span></td>
        <!-- <td width="28%">Attendance</td>-->
        <td width="11%">No. of Trips </td>
        <td colspan="2">Time</td>
        <!--<td width="17%">Incident &amp; Replaced Vehicle </td>
        <td width="15%">Refer</td>
        <td width="18%" height="40">Request</td>-->
      </tr>
      
      <tr align="center" >
        <td height="25" colspan="7">&nbsp;</td>
      </tr>
      <?php
	  
		  $fsql = "select * from daily_details where dd_date = '$date' order by dd_id asc";
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
        <td height="55" align="center"><span style="font-weight: bold"><?php echo emp_name($fres['dd_emp_id']);?></span></td>
		  <td height="55" align="center"><?php echo vehicle_name($fres['dd_vehicle']);?></td>
		  <td height="55" align="center"><?php echo $fres['dd_ward'];?></td>
          <td align="center"><?php echo $fres['dd_trips'];?></td>
        <td width="10%" align="center">From : <?php echo date('h:i a', strtotime($fres['dd_work_from']));?></td>
        <td width="14%" align="center">To : <?php echo date('h:i a', strtotime($fres['dd_work_to']));?></td>
      </tr>
      <tr align="center" >
            <td height="25" colspan="7">&nbsp;</td>
    </tr>
	<?php $i++; }	
	if($i==1){
	?>
	<tr align="center" bgcolor="#CCCCCC" class="fnt">
            <td height="25" colspan="7"><strong>
			No Record Found			</strong></td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="7">&nbsp;</td>
    </tr>
	<?php }?>
    </tbody>
    <tr align="center" background="images\1by25.jpg" >
      <td height="22" colspan="7">&nbsp;</td>
    </tr>
</table>
  <p>&nbsp;</p>
</form>

<?php include "includes/footer.php";?>