<?php
$page_name = "Monthly Garage Report";
include "includes/header.php";
$date = date('Y-m-d', (strtotime(date('Y-m-d'))-86400));
//echo $date; exit;
/*if(isset($_POST['date'])){
	$date = $_POST['date'];
}*/
$month_and_year = date('Y')."-".(date('m')-1);
if(isset($_GET['MY'])){
    $month_year   = $_GET['MY'];
	$vehicle_id = $_GET['VID'];
}
$today = date('y-m-d');
 //Month = month_name(date('m',strtotime($month_and_year)));
 
?>


<section class="content-header">
      <h1>
         Garage Report
        <small>For Month <strong><?php echo date('M,Y', (strtotime($month_year)));?></strong> & Vehicle <strong><?php echo vehicle_name($vehicle_id);?></strong></small></h1>
      
</section>
<br />
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td>
		<a href="<?php echo $_SERVER['HTTP_REFERER'];?>">
        	<input name="ImageField" type="image" src="allicons/67.gif" title="View Record" height="30" width="35" />
      	</a>
	</td>
  </tr>
</table>

<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
    <tbody>
      <tr align="center" class="head_font" background="images/1by25.jpg">
        <td width="4%" height="41">Sl. No. </td>
        <!-- <td width="17%">&nbsp;</td>-->
        <td width="17%"><span style="font-weight: bold">Incident Details </span></td>
        <td width="28%"><strong>Garage In Details </strong></td>
        <td width="29%"><strong>Garage Out Details </strong></td>
        <td width="22%"><strong>Total Days In Garage</strong> </td>
        <!--<td colspan="2"><strong>Total Times Enter In a Month </strong></td>-->
        <!--<td width="17%">Incident &amp; Replaced Vehicle </td>
        <td width="15%">Refer</td>
        <td width="18%" height="40">Request</td>-->
      </tr>
      <tr align="center" >
        <td height="25" colspan="7">&nbsp;</td>
      </tr>
      <?php
	   
		  $fsql = "select * from vehicle_status_master where vsm_vm_id = '$vehicle_id' and vsm_in_date like '$month_year%' order by vsm_id desc";
		  $frec = q($fsql);
		  $i = 1;
		  while($fres = f($frec))
		  {
			if($i % 2 == 0)
			$col = "bgcolor='#E5E5E5'";
			else
			$col = "bgcolor='#D5D5D5'";
			if($fres['vsm_out_date'] != "" && $fres['vsm_in_date'] != "")
			  {
		        $vsm_tot_days_in = (strtotime($fres['vsm_out_date'])/86400-strtotime($fres['vsm_in_date'])/86400)+1;
			  }
			 else
			  {
			    @$vsm_in_date = dateu($fres[vsm_in_date]);
			    $vsm_tot_days_in = "Vehicle In Garage From $vsm_in_date Till Now";
			  } 
	  ?>
      <tr align="center" <?php echo $col;?>>
        <td align="center"><?php echo $i;?></td>
        <!-- <td height="55" align="center">&nbsp;</td>-->
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
        </table></td>
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
            <tr>
              <td align="right" scope="row"><strong>Enter Date</strong></td>
              <td align="center">:</td>
              <td><?php echo dateu($fres['vsm_in_date']);?></td>
            </tr>
            <tr>
              <td align="right" scope="row"><strong>In Description</strong></td>
              <td align="center">:</td>
              <td><?php echo $fres['vsm_in_remarks'];?></td>
            </tr>
        </table></td>
        <td align="center"><table width="104%" height="49" border="0" align="center" cellpadding="1" cellspacing="1">
            <tr>
              <td width="42%" align="right" scope="row"><strong>Inform By </strong></td>
              <td width="6%" align="center">:</td>
              <td width="52%"><?php echo $fres['vsm_inform_by'];?></td>
            </tr>
            <tr>
              <td align="right" scope="row"><strong>Out By </strong></td>
              <td align="center">:</td>
              <td><?php echo emp_name($fres['vsm_out_by']);?></td>
            </tr>
            <tr>
              <td align="right" scope="row"><strong>Out Date</strong></td>
              <td align="center">:</td>
              <td><?php echo dateu($fres['vsm_out_date']);?></td>
            </tr>
            <tr>
              <td align="right"><strong>Out Description </strong></td>
              <td align="center">:</td>
              <td><?php echo $fres['vsm_out_remarks'];?></td>
            </tr>
        </table></td>
        <td width="22%" align="center"><?php echo $vsm_tot_days_in;?></td>
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
  <p>&nbsp;</p>
</form>

<?php include "includes/footer.php";?>