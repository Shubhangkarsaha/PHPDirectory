<?php
$page_name = "Monthly Garage Report";
include "includes/header.php";
$month_and_year = date('Y-m');
if(isset($_POST['month_and_year'])){
	$month_and_year = $_POST['month_and_year'];
}


?>


<section class="content-header">
      <h1>
        Monthly Garage Report
             <small>For <strong><?php echo date('M, Y', strtotime($month_and_year));?></strong></small></h1>
      <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Report</strong></li>
		 <li class="active"><strong>Garage Report</strong></li>
		 <li class="active"><strong>Monthly Report</strong></li>
</ol>
</section>
<br />

<table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
  <tbody>
    <tr align="right" class="head_font">
	<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
      <td height="37" colspan="6" class="fnt">Select Month : <input type="month" name="month_and_year" required="" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" class="head_font" /></td>
	  </form>
    </tr>
    <tr align="center" class="head_font" background="images/1by25.jpg">
      <td width="6%" height="37"><strong>Sl. No.</strong> </td>
      <td width="27%"><strong>Vehicle Name </strong></td>
      <td width="22%"><span style="font-weight: bold">Vehicle No / TC No </span></td>
      <!-- <td width="20%">&nbsp;</td>-->
      <!-- <td width="28%">Attendance</td>-->
      <td width="20%"><strong>Total Times</strong> <strong>Enter In garage</strong> </td>
      <td width="25%" colspan="2">Option</td>
      <!--<td width="17%">Incident &amp; Replaced Vehicle </td>
        <td width="15%">Refer</td>
        <td width="18%" height="40">Request</td>-->
    </tr>
    <tr align="center" >
      <td height="25" colspan="7">&nbsp;</td>
    </tr>
    <?php
	  
	  
		  $vsql = "select * from vehicle_master where vm_status>0 order by vm_name desc";
		  $vrec = q($vsql);
		  $i = 1;
		  while($vres = f($vrec))
		  {
			if($i % 2 == 0)
			$col = "bgcolor='#E5E5E5'";
			else
			$col = "bgcolor='#D5D5D5'";
			
			$total_days_in = row_count("select * from vehicle_status_master where vsm_vm_id = '$vres[vm_id]' and vsm_in_date like '$month_and_year%'");
			
		  // exit;
	  ?>
    <tr align="center" <?php echo $col;?>>
      <td align="center"><?php echo $i;?></td>
      <td height="55" align="center"><span style="font-weight: bold"><?php echo vehicle_name($vres['vm_id']);?></span></td>
      <td height="55" align="center"><?php echo vehicle_number($vres['vm_id']);?></td>
      <!--  <td height="55" align="center">&nbsp;</td>-->
      <td align="center"><?php echo $total_days_in;?></td>
      <td align="center"><a href="view_monthly_vehicle_status_report.php?VID=<?php echo $vres['vm_id']."&MY=".$month_and_year;?>">
        <input name="ImageField" type="image" src="allicons/101.gif" title="View Record" height="30" width="35" />
      </a></td>
      <!--<td width="10%" align="center">From : <?php //echo date('h:i a', strtotime($fres['dd_work_from']));?></td>
        <td width="14%" align="center">To : <?php //echo date('h:i a', strtotime($fres['dd_work_to']));?></td>-->
    </tr>
    <tr align="center" >
      <td height="25" colspan="7">&nbsp;</td>
    </tr>
    <?php $i++; }	
	if($i==1){
	?>
    <tr align="center" bgcolor="#CCCCCC" class="fnt">
      <td height="25" colspan="7"><strong> No Record Found </strong></td>
    </tr>
    <tr align="center" >
      <td height="25" colspan="7">&nbsp;</td>
    </tr>
    <?php }?>
  </tbody>
  <tr align="center" background="images/1by25.jpg" >
    <td height="22" colspan="7">&nbsp;</td>
  </tr>
</table>
<?php include "includes/footer.php";?>