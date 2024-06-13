<?php
$page_name = "Daily Attendance Register";
include "includes/header.php";
//Submit
if(isset($_POST['Submit']))
{
	//exit;
	$count 					= $_POST['i_value'];
	
	$attn_date 				= $_POST['attn_date'];
	
	$attn_emp_id			= $_POST['attn_emp_id'];
	$attn_fname				= $_POST['attn_fname'];
	
	$attn_attn	        	= $_POST['attn_attn'];
	$attn_remarks			= $_POST['attn_remarks'];
	
	
	
	$today = date('Y-m-d');	
	
	//exit;	
	
	$check = row_count("SELECT * FROM attn_details WHERE attn_date = '$attn_date'");
	if($check == 0){
		for($i=0;$i<$count;$i++){
		     
			 //$dd_wards = $dd_ward1[$i].",".$dd_ward2[$i].",".$dd_ward3[$i].",".$dd_ward4[$i];
			/* $dd_wards = $dd_ward1[$i];
			 if($dd_ward2[$i] != "")
			   {
			     $dd_wards.=",".$dd_ward2[$i];
			   }
			  if($dd_ward3[$i] != "")
			    {
				  $dd_wards.=",".$dd_ward3[$i];
				} */
				
				//$dd_atten = $dd_attn[$i];
			
			//echo $dd_wards; exit;	
			 
		
			$sql = "INSERT INTO `attn_details`(`attn_emp_id`, `attn_attn`, `attn_remarks`, `attn_date`, `attn_entry_date`, `attn_entry_by`) VALUES ('$attn_emp_id[$i]', '$attn_attn[$i]', '$attn_remarks[$i]', '$attn_date', '$today', '$_SESSION[lid]')";
			//echo $sql; exit;
			$rec = q($sql);
			
			
			//list(w1,w2,w3,w4) = explode(",",$dd_ward);
		}
		if($count == $i)
			echo alert_location_replace('Attendance inserted successfully.','daily_attn_register.php');
		else
			echo error_alert_location_replace('daily_attn_register.php');
	}
	else
		echo alert_location_replace('Attendance already exist for this date '.dateu($attn_date).'.', 'daily_attn_register.php');
}
?>


<section class="content-header">
      <h1>
        Daily Attendance Register
        <small>&nbsp;</small>      </h1>
		<ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Daily Attendance Register</strong></li>
		
</ol>
      
</section>
<br />
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
    <tbody>
      <tr align="center" class="head_font">
        <td height="40" colspan="9" align="center" class="fnt"><button type="button" class="btn-info " >Select Work Date : <input type="date" name="attn_date" value="<?php echo date('Y-m-d');?>" required="required"/></button></td>
      </tr>
      <tr align="center" class="head_font" background="images\1by25.jpg">
        <td width="3%">Sl. No. </td>
		<td width="19%">Employee Image </td>
        <td width="19%">Employee Name </td>
		<td width="15%">Father Name </td>
        <td width="14%">Designation</td>
        <td width="23%">Attendance</td>
        <td width="26%">Remarks</td>
      </tr>
      
      <tr align="center" >
        <td height="25" colspan="18">&nbsp;</td>
      </tr>
      <?php
	  
		  $fsql = "select * from emp_master order by emp_name asc";
		  $frec = q($fsql);
		  $i = 0;
		  while($fres = f($frec))
		  {
			if($i % 2 == 0)
			$col = "bgcolor='#E5E5E5'";
			else
			$col = "bgcolor='#D5D5D5'";
			
	  ?>
      <tr align="center" <?php echo $col;?>>
        <td align="center"><?php echo $i+1;?></td>
		
		 <td height="55" align="center"><span style="font-weight: bold"><img src="emp_image/<?php echo $fres['emp_image'];?>" width="75" height="75" /></span>
          </td>
		  
        <td height="55" align="center"><span style="font-weight: bold"><?php echo emp_name($fres['emp_id']);?></span>
          <input type="hidden" name="attn_emp_id[]" value="<?php echo $fres['emp_id'];?>" /></td>
        <td height="55" align="center"><span style="font-weight: bold"><?php echo emp_fname($fres['emp_id']);?></span>
          <input type="hidden" name="attn_fname[]" value="<?php echo $fres['emp_id'];?>" /></td>
        <td align="center"><?php echo desig_name($fres['emp_desig']);?></td>
        <td align="center"><input type="radio" name="attn_attn[<?php echo $i;?>]" value="0"  required="required"/>
			  <span style="font-weight: bold">Absent</span>
			  <input type="radio" name="attn_attn[<?php echo $i;?>]" value="1" checked="checked" required="required"/>
			  <span style="font-weight: bold">Present 
			  <input type="radio" name="attn_attn[<?php echo $i;?>]" value="2" required="required"/>
Leave </span></td>
        <td align="center">
          <textarea name="attn_remarks[]" cols="50" rows="3" id="attn_remarks"><?php echo @$fres['attn_remarks'];?></textarea>        </td>
      </tr>
      <tr align="center" >
            <td height="25" colspan="13">&nbsp;</td>
    </tr>
	<?php $i++; }	
	if($i>0){
	?>
	<!--<tr align="center" class="fnt" >
        <td height="58" colspan="28" valign="top" class="fnt" style="font-size:11px;"><strong><span class="fnt" style="font-size:11px;"><strong><a href="export_bank_list.php?"><img src="images/excel.png" height="40" border="0" /></a></strong></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="export_work_list.php"><img src="images/print.png" height="38" /></a></strong></td>
    </tr>-->
	
	<tr align="center" class="fnt">
            <td height="25" colspan="14"><input type="submit" name="Submit" class="head_font" />
            <input type="hidden" name="i_value" value="<?php echo $i?>" />		</td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="14">&nbsp;</td>
    </tr>
	<?php }else{?>
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