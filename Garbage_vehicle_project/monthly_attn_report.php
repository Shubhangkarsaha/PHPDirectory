<?php
$page_name = "Monthly Attendance Report";
include "includes/header.php";
$month_and_year = date('Y-m');
if(isset($_POST['month_and_year'])){
	$month_and_year = $_POST['month_and_year'];
}
?>


<section class="content-header">
      <h1>
        Monthly Attendance Register
        <small>For <strong><?php echo date('M, Y', strtotime($month_and_year));?></strong></small>      </h1>
      <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Report</strong></li>
		 <li class="active"><strong>Attendance Report</strong></li>
		 <li class="active"><strong>Monthly Report</strong></li>
</ol>
</section>
<br />
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
    <tbody>
      <tr align="center" class="head_font">
        <td height="40" colspan="10" align="right" class="fnt">Select Attendance Month : <input type="month" name="month_and_year" required="required"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" class="head_font" /></td>
      </tr>
      <tr align="center" class="head_font" background="images\1by25.jpg">
        <td width="4%">Sl. No. </td>
        <td width="27%">Employee Name </td>
        <td width="21%">Designation</td>
        <td width="15%">Present Days </td>
        <td width="15%">Absent Days </td>
        <td width="18%">Leave Days </td>
      </tr>
      
      <tr align="center" >
        <td height="25" colspan="19">&nbsp;</td>
      </tr>
      <?php
	  
		  $fsql = "select * from emp_master where emp_status > '0' order by emp_name asc";
		  $frec = q($fsql);
		  $i = 1;
		  while($fres = f($frec))
		  {
			if($i % 2 == 0)
			$col = "bgcolor='#E5E5E5'";
			else
			$col = "bgcolor='#D5D5D5'";
			
			$absent = row_count("select * from attn_details where attn_date like '$month_and_year%' and attn_emp_id = '$fres[emp_id]' and attn_attn = '0'");
			$present = row_count("select * from attn_details where attn_date like '$month_and_year%' and attn_emp_id = '$fres[emp_id]' and attn_attn = '1'");
			$leave = row_count("select * from attn_details where attn_date like '$month_and_year%' and attn_emp_id = '$fres[emp_id]' and attn_attn = '2'")
			
	  ?>
      <tr align="center" <?php echo $col;?>>
        <td align="center"><?php echo $i;?></td>
        <td height="55" align="center"><span style="font-weight: bold"><?php echo $fres['emp_name'];?></span></td>
        <td align="center"><?php echo desig_name($fres['emp_desig']);?></td>
        <td align="center"><?php echo $present;?></td>
        <td align="center"><?php echo $absent;?></td></td>        
        <td align="center"><?php echo $leave;?></td>
      <tr align="center" >
            <td height="25" colspan="14">&nbsp;</td>
    </tr>
	<?php $i++; }	
	if($i==1){
	?>
	<tr align="center" bgcolor="#CCCCCC" class="fnt">
            <td height="25" colspan="15"><strong>
			No Record Found			</strong></td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="15">&nbsp;</td>
    </tr>
	<?php }?>
    </tbody>
    <tr align="center" background="images\1by25.jpg" >
      <td height="22" colspan="19">&nbsp;</td>
    </tr>
</table>
</form>

<?php include "includes/footer.php";?>