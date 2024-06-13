<?php
$page_name = "Daily Work Details";
include "includes/header.php";
//Submit
if(isset($_POST['Submit']))
{
	//exit;
	$count 					= $_POST['i_value'];
	
	$dd_date 				= $_POST['dd_date'];
	
	$dd_emp_id				= $_POST['dd_emp_id'];
	$dd_vehicle 			= $_POST['dd_vehicle'];
	$dd_ward1				= $_POST['dd_ward1'];
	$dd_ward2				= $_POST['dd_ward2'];
	$dd_ward3				= $_POST['dd_ward3'];
	//$dd_ward4				= $_POST['dd_ward4'];
	//$dd_attn				= $_POST['dd_attn'];
	$dd_trips				= $_POST['dd_trips'];
	$dd_work_from			= $_POST['dd_work_from'];
	$dd_work_to				= $_POST['dd_work_to'];
	/*$dd_incident			= $_POST['dd_incident'];
	$dd_description			= $_POST['dd_description'];
	$dd_replaced_vehicle 	= $_POST['dd_replaced_vehicle'];
	$dd_refer_by			= $_POST['dd_refer_by'];
	$dd_garage				= $_POST['dd_garage'];
	$dd_request_by			= $_POST['dd_request_by'];
	$dd_request_duty		= $_POST['dd_request_duty'];*/
	
	
	$today = date('Y-m-d');	
	//exit;	
	$check = row_count("SELECT * FROM daily_details WHERE dd_date = '$dd_date'");
	if($check == 0){
		for($i=0;$i<$count;$i++){
		     
			 //$dd_wards = $dd_ward1[$i].",".$dd_ward2[$i].",".$dd_ward3[$i].",".$dd_ward4[$i];
			 $dd_wards = $dd_ward1[$i];
			 if($dd_ward2[$i] != "")
			   {
			     $dd_wards.=",".$dd_ward2[$i];
			   }
			  if($dd_ward3[$i] != "")
			    {
				  $dd_wards.=",".$dd_ward3[$i];
				} 
				
				//$dd_atten = $dd_attn[$i];
			
			//echo $dd_wards; exit;	
			 
		
			$sql = "INSERT INTO `daily_details`(`dd_emp_id`, `dd_vehicle`, `dd_ward`, `dd_trips`, `dd_work_from`, `dd_work_to`, `dd_date`, `dd_entry_date`, `dd_entry_by`) VALUES ('$dd_emp_id[$i]', '$dd_vehicle[$i]', '$dd_wards', '$dd_trips[$i]', '$dd_work_from[$i]', '$dd_work_to[$i]', '$dd_date', '$today', '$_SESSION[lid]')";
			//echo $sql; exit;
			$rec = q($sql);
			
			
			//list(w1,w2,w3,w4) = explode(",",$dd_ward);
		}
		if($count == $i)
			echo alert_location_replace('Daily Details inserted successfully.','daily_details.php');
		else
			echo error_alert_location_replace('daily_details.php');
	}
	else
		echo alert_location_replace('Daily Details already exist for this date '.dateu($dd_date).'.', 'daily_details.php');
}
?>


<section class="content-header">
      <h1>
        Daily Work Details
        <small>&nbsp;</small>      </h1>
		<ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Daily Work Details</strong></li>
		
</ol>
      
</section>
<br />
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
    <tbody>
      <tr align="center" class="head_font">
        <td height="40" colspan="8" align="center" class="fnt"><button type="button" class="btn-info" >Select Work Date : <input type="date" name="dd_date" value="<?php echo date('Y-m-d');?>" required="required"/></button></td>
      </tr>
      <tr align="center" class="head_font" background="images\1by25.jpg">
	 <td width="4%"><span style="font-weight: bold">Sl No. </span></td>
        <td width="13%"><span style="font-weight: bold">Employee Image </span></td>
	    <td width="12%"><span style="font-weight: bold">Employee Name </span></td>
        <td width="18%"><span style="font-weight: bold">Vehicle</span></td>
        <td width="16%"><span style="font-weight: bold">Ward No.</span></td>
        <!-- <td width="28%">Attendance</td>-->
        <td width="10%">No. of Trips </td>
        <td colspan="2">Time</td>
        <!--<td width="17%">Incident &amp; Replaced Vehicle </td>
        <td width="15%">Refer</td>
        <td width="18%" height="40">Request</td>-->
      </tr>
      
      <tr align="center" >
        <td height="25" colspan="7">&nbsp;</td>
      </tr>
      <?php
	  
		  $fsql = "select * from duty_allotment_master dam, vehicle_master vm, emp_master em where dam.dam_vehicle = vm.vm_id and dam.dam_emp_id = em.emp_id and dam.dam_status = '1' order by vm.vm_name asc";
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
	    <td height="55" align="center"><span style="font-weight: bold"><img src="emp_image/<?php echo $fres['emp_image'];?>" width="75" height="75" /></span></td>

        <td height="55" align="center"><span style="font-weight: bold"><?php echo emp_name($fres['dam_emp_id']);?></span>
<input type="hidden" name="dd_emp_id[]" value="<?php echo $fres['dam_emp_id'];?>" /></td>
		  <td height="55" align="center"><select name="dd_vehicle[]" id="dd_vehicle" required="required" style="width:200">
            <option value="">-- Vehicle --</option>
            <?php 
							$vsql = "select * from vehicle_master where vm_status > '0'";
							$vrec = q($vsql);
							while($vres = f($vrec)){
						?>
            <option value="<?php echo $vres['vm_id'];?>"<?php if($vres['vm_id'] == $fres['dam_vehicle']){echo "selected";}?>><?php echo $vres['vm_name'];?></option>
            <?php }?>
          </select></td>
		  <td height="55" align="center"><select name="dd_ward1[]" id="select" required="required" style="width:50px" >
            <option value="">--</option>
            <?php 
								$wsql = "select * from ward_master where status > '0'";
								$wrec = q($wsql);
								while($wres = f($wrec)){
							?>
            <option value="<?php echo $wres['ward_no'];?>"<?php if($wres['ward_no'] == $fres['dam_ward'] && $fres['dam_trips'] != 0){echo "selected";}?>><?php echo $wres['ward_no'];?></option>
            <?php }?>
          </select>
		     <select name="dd_ward2[]" id="select2" style="width:50px" >
              <option value="">--</option>
              <?php 
								$wsql = "select * from ward_master where status > '0'";
								$wrec = q($wsql);
								while($wres = f($wrec)){
							?>
              <option value="<?php echo $wres['ward_no'];?>"<?php if($wres['ward_no'] == $fres['dam_ward'] && $fres['dam_trips'] >= 2){echo "selected";}?>><?php echo $wres['ward_no'];?></option>
              <?php }?>
            </select>
		    <select name="dd_ward3[]" id="dd_ward" style="width:50px" >
              <option value="">--</option>
              <?php 
								$wsql = "select * from ward_master where status > '0'";
								$wrec = q($wsql);
								while($wres = f($wrec)){
							?>
              <option value="<?php echo $wres['ward_no'];?>"<?php if($wres['ward_no'] == $fres['dam_ward'] && $fres['dam_trips'] == 3){echo "selected";}?>><?php echo $wres['ward_no'];?></option>
              <?php }?>
            </select></td>
		  <?php $dsql = "select * from daily_details";
		        $dres = qf($dsql);
		   ?>
        <!--<td align="center">
			  <input type="radio" name="dd_attn[<?php //echo $i;?>]" value="1"  required="required"/>
			  <span style="font-weight: bold">Absent</span><br /><br />
			  <input type="radio" name="dd_attn[<?php //echo $i;?>]" value="2" checked="checked" required="required"/>
			  <span style="font-weight: bold">Present</span></td>-->
        <td align="center"><?php echo $fres['dam_trips'];?>
        <input type="hidden" name="dd_trips[]" value="<?php echo $fres['dam_trips'];?>" /></td>
        <td width="14%" align="center">From :       
        <input type="time" name="dd_work_from[]"  value="07:00" style="width:90px;"/></td>
        <td width="13%" align="center">To : 
        <input name="dd_work_to[]" type="time" id="dd_work_to" value="14:00" style="width:90px;"/></td>
        <!-- <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">

          <tr>
		  	 <script>
				function desc<?php //echo $i;?>(ID){
					$("#dd_description<?php //echo $i;?>").html("<option value=''>Please Wait...</option>");
					var data = "DESCRIPTION="+ID+"&get_description";
					//alert('ID='+ID+' Data='+data);
					$.ajax({
						type	: 'GET',
						data	: data,
						url 	: 'ajax_master.php',
						success	: function(result){
							$("#dd_description<?php //echo $i;?>").html(result);
						}
					})
				}
			</script>
            <td width="32%" height="28" align="right"><strong>Incident</strong></td>
            <td width="5%" align="center"><strong>:</strong></td>
            <td width="63%" align="left"><select name="dd_incident[]" id="dd_incident<?php //echo $i;?>" onchange="desc<?php //echo $i;?>(this.value)">
              <option value="">-- Incident --</option>
              <?php
						/*$isql = "select * from incident_master where im_parent = '0' and im_status > '0' order by im_type asc";
						$irec = q($isql);
						while($ires = f($irec)){*/
					?>
              <option value="<?php //echo $ires['im_id'];?>"><?php //echo $ires['im_type'];?></option>
              <?php
						//}
					?>
            </select></td>
          </tr>
		 
          <tr>
            <td height="28" align="right"><strong>Description</strong></td>
            <td align="center"><strong>:</strong></td>
            <td align="left"><select name="dd_description[]" id="dd_description<?php //echo $i;?>">
                <option value="">-- Description --</option>
                <?php
					/*	$isql = "select * from incident_master where im_parent != '0' and im_status > '0' order by im_type asc";
						$irec = q($isql);
						while($ires = f($irec)){*/
					?>
                <option value="<?php //echo $ires['im_id'];?>"<?php //if(isset($_GET['Edit'])){if($ires['im_id'] == $eres['im_parent']){echo "selected";}}?>><?php //echo $ires['im_type'];?></option>
                <?php
					//	}
					?>
            </select></td>
          </tr>
          <tr>
            <td align="right"><span style="font-weight: bold">Vehicle</span></td>
            <td align="center"><span style="font-weight: bold">:</span></td>
            <td align="left"><select name="dd_replaced_vehicle[]" id="dd_replaced_vehicle">
              <option value="">-- Vehicle --</option>
              <?php 
							/*$vsql = "select * from vehicle_master where vm_status > '0'";
							$vrec = q($vsql);
							while($vres = f($vrec)){*/
						?>
              <option value="<?php //echo $vres['vm_id'];?>"<?php //if(isset($_GET['Edit'])){if($vres['vm_id'] == $eres['dam_vehicle']){echo "selected";}}?>><?php //echo $vres['vm_name'];?></option>
              <?php //}?>
            </select></td>
          </tr>
        </table></td>
        <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">

          <tr>
            <td width="66%" height="29" align="right"><strong> By </strong></td>
            <td width="21%" align="center"><strong>:</strong></td>
            <td width="13%" align="left"><select name="dd_refer_by[]" id="dd_refer_by">
              <option value="">-- Officer --</option>
              <?php 
							/*$emp_sql = "select * from emp_master where emp_desig = '2' and emp_status > '0'";
							$emp_rec = q($emp_sql);
							while($emp_res = f($emp_rec)){*/
						?>
              <option value="<?php //echo $emp_res['emp_id'];?>"<?php //if(isset($_GET['Edit'])){if($emp_res['emp_id'] == $eres['dam_emp_id']){echo "selected";}}?>><?php //echo $emp_res['emp_name'];?></option>
              <?php //}?>
            </select></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
          <tr>
            <td align="right"><strong>Garage</strong></td>
            <td align="center"><strong>:</strong></td>
            <td align="left">
				<select name="dd_garage[]" id="dd_garage">
				  <option value="">-- Garage --</option>
				  <?php 
								/*$gsql = "select * from garage_master where gm_status > '0'";
								$grec = q($gsql);
								while($gres = f($grec)){*/
							?>
				  <option value="<?php //echo $gres['gm_id'];?>"><?php //echo $gres['gm_name'];?></option>
				  <?php //}?>
				</select>				</td>
          </tr>
        </table></td>
        <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td align="right"><strong>By</strong></td>
            <td align="center"><strong>:</strong></td>
            <td align="left"><select name="dd_request_by[]" id="dd_request_by">
                <option value="">-- Officer --</option>
                <?php /*
							$emp_sql = "select * from emp_master where emp_desig = '2' and emp_status > '0'";
							$emp_rec = q($emp_sql);
							while($emp_res = f($emp_rec)){*/
						?>
                <option value="<?php // echo $emp_res['emp_id'];?>"><?php //echo $emp_res['emp_name'];?></option>
                <?php // }?>
            </select></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
          <tr>
            <td width="42%" align="right"><strong>Duty </strong></td>
            <td width="9%" align="center"><strong>:</strong></td>
            <td width="49%" align="left"><textarea name="dd_request_duty[]"></textarea></td>
          </tr>

        </table></td>-->
      </tr>
      <tr align="center" >
            <td height="25" colspan="8">&nbsp;</td>
    </tr>
	<?php $i++; }	
	if($i>0){
	?>
	<!--<tr align="center" class="fnt" >
        <td height="58" colspan="28" valign="top" class="fnt" style="font-size:11px;"><strong><span class="fnt" style="font-size:11px;"><strong><a href="export_bank_list.php?"><img src="images/excel.png" height="40" border="0" /></a></strong></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="export_work_list.php"><img src="images/print.png" height="38" /></a></strong></td>
    </tr>-->
	
	<tr align="center" class="fnt">
            <td height="25" colspan="8"><input type="submit" name="Submit" class="head_font" />
            <input type="hidden" name="i_value" value="<?php echo $i?>" />		</td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="8">&nbsp;</td>
    </tr>
	<?php }else{?>
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