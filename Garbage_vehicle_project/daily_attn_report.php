<?php
$page_name = "Daily Attendance Report";
include "includes/header.php";
$date = date('Y-m-d', (strtotime(date('Y-m-d'))-86400));
if(isset($_POST['date'])){
	$date = $_POST['date'];
}
?>


<section class="content-header">
      <h1>
        Daily Attendance Register
        <small>For <strong><?php echo dateu($date);?></strong></small>      </h1>
      <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Report</strong></li>
		 <li class="active"><strong>Attendance Report</strong></li>
		 <li class="active"><strong>Daily Report</strong></li>
</ol>
</section>
<br />
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
    <tbody>
      <tr align="center" class="head_font">
        <td height="40" colspan="9" align="right" class="fnt">Select Attendance Date : <input type="date" name="date" required="required"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" class="head_font" /></td>
      </tr>
      <tr align="center" class="head_font" background="images\1by25.jpg">
        <td width="7%">Sl. No. </td>
        <td width="18%">Employee Name </td>
        <td width="12%">Designation</td>
        <td width="16%">Attendance</td>
        <td width="47%">Remarks</td>
      </tr>
      
      <tr align="center" >
        <td height="25" colspan="18">&nbsp;</td>
      </tr>
      <?php
	  
		  $fsql = "select * from attn_details ad, emp_master em where ad.attn_emp_id = em.emp_id and ad.attn_date = '$date' order by attn_id asc";
		  $frec = q($fsql);
		  $i = 1;
		  while($fres = f($frec))
		  {
			if($i % 2 == 0)
			$col = "bgcolor='#E5E5E5'";
			else
			$col = "bgcolor='#D5D5D5'";
			
			switch($fres['attn_attn']){
				case 0:
					$attn = 'Absent';
					break;
				case 1:
					$attn = 'Present';
					break;
				case 2:
					$attn = 'Leave';
					break;
			}
			
	  ?>
      <tr align="center" <?php echo $col;?>>
        <td align="center"><?php echo $i;?></td>
        <td height="55" align="center"><span style="font-weight: bold"><?php echo $fres['emp_name'];?></span></td>
        <td align="center"><?php echo desig_name($fres['emp_desig']);?></td>
        <td align="center"><?php echo $attn;?></td>
        <td align="center"><?php echo $fres['attn_remarks'];?></tr>
      <tr align="center" >
            <td height="25" colspan="13">&nbsp;</td>
    </tr>
	<?php $i++; }	
	if($i==1){
	?>
	<tr align="center" bgcolor="#CCCCCC" class="fnt">
            <td height="25" colspan="14"><strong>
			No Record Found			</strong></td>
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
</form>

<?php include "includes/footer.php";?>