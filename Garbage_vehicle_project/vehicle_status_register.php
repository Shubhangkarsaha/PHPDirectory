<?php 
$page_name = "Vehicle list";
include "includes/header.php";
if(isset($_GET['IN'])){
	$vid = $_GET['VID'];
	$sql = "select * from vehicle_master where vm_status = '2' and vm_id = '$vid'";
	$check = row_count($sql);
	if($check>0)
		echo alert_location_replace('Vehicle is already in garage.', 'vehicle_list.php');
}
if(isset($_GET['OUT'])){
	$vid = $_GET['VID'];
	$sql = "select * from vehicle_master where vm_status = '1' and vm_id = '$vid'";
	$check = row_count($sql);
	if($check>0)
		echo alert_location_replace('Vehicle is no longer in garage.', 'vehicle_list.php');
}
if(isset($_POST['Submit']))
{
	$today = date('Y-m-d');
	$vm_id = $_GET['VID'];
	
	if(isset($_GET['IN'])){
		$incident = $_POST['incident'];	
		$description = $_POST['description'];
		$refer_by = $_POST['refer_by'];
		$garage = $_POST['garage'];
		$in_driver = $_POST['in_driver'];
		$in_date = $_POST['in_date'];
		$in_remarks = $_POST['in_remarks'];	
		
		$sql = "insert into vehicle_status_master (`vsm_vm_id`, `vsm_incident`, `vsm_description`, `vsm_refered_by`, `vsm_garage`, `vsm_in_by`, `vsm_in_date`, `vsm_in_remarks`,`vsm_entry_by`,`vsm_entry_date`) values ('$vm_id','$incident','$description','$refer_by','$garage','$in_driver','$in_date','$in_remarks','$_SESSION[lid]','$today')";
		//echo $sql;exit;
		$rec = q($sql);
		$update_vehicle = q("update vehicle_master set vm_status='2' where vm_id = '$vm_id'");
		if($rec && $update_vehicle)
			echo alert_location_replace('Vehicle details submitted.','vehicle_list.php');
		else
			echo error_alert_location_replace('vehicle_list.php');
		
	}
	elseif(isset($_GET['OUT'])){
		$inform_by = $_POST['inform_by'];
		$out_driver = $_POST['out_driver'];
		$out_date = $_POST['out_date'];
		$out_remarks = $_POST['out_remarks'];
		
		$sql = "update vehicle_status_master set vsm_inform_by = '$inform_by', vsm_out_by = '$out_driver', vsm_out_date = '$out_date', vsm_out_remarks = '$out_remarks', vsm_update_by = '$_SESSION[lid]', vsm_update_date = '$today' where vsm_vm_id = '$vm_id' and vsm_out_date = ''";
		//echo $sql;exit;
		$rec = q($sql);
		$update_vehicle = q("update vehicle_master set vm_status='1' where vm_id = '$vm_id'");
		if($rec && $update_vehicle)
			echo alert_location_replace('Vehicle details submitted.','vehicle_list.php');
		else
			echo error_alert_location_replace('vehicle_list.php');
	}
} 
?>
<style type="text/css">
<!--
.style3 {font-size: 24px; font-weight: bold; }
.style4 {
	font-size: 16px;
	font-weight: bold;
}
-->
</style>


<section class="content-header">
      <h1>
        Garage Register
        <small>Vehicle name <strong><?php echo vehicle_name($_GET['VID']);?></strong></small>      </h1>
      
      </section>
<br />

<form action="vehicle_status_register.php?<?php echo $_SERVER['QUERY_STRING'];?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" class="main_bod" >
            <tr background="images\1by25.jpg" class="head_font">
              <td height="32" colspan="9" align="left">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td height="25" colspan="9" align="right">&nbsp;</td>
            </tr>
		<?php if(isset($_GET['IN'])){?>
            <tr class="fnt">
              <td width="15%" height="39" align="right">Incident</td>
              <td width="2%" height="39" align="center">:</td>
              <td width="17%" height="39" align="left"><select name="incident" id="incident" onchange="desc(this.value)" required>
              <option value="">-- Incident --</option>
              <?php
						$isql = "select * from incident_master where im_parent = '0' and im_status > '0' order by im_type asc";
						$irec = q($isql);
						while($ires = f($irec)){
					?>
              <option value="<?php echo $ires['im_id'];?>"><?php echo $ires['im_type'];?></option>
              <?php
						}
					?>
            </select></td>
			<td width="14%" height="38" align="right">&nbsp;</td>
              <td width="2%" height="38" align="center">&nbsp;</td>
              <td width="17%" height="38" align="left">&nbsp;</td>
              <td width="13%" height="38" align="right">Discription</td>
              <td width="2%" height="38" align="center">:</td>
              <td width="18%" height="38" align="left"><select name="description" id="description" required>
                <option value="">-- Description --</option>
                <?php
						$isql = "select * from incident_master where im_parent != '0' and im_status > '0' order by im_type asc";
						$irec = q($isql);
						while($ires = f($irec)){
					?>
                <option value="<?php echo $ires['im_id'];?>"<?php if(isset($_GET['Edit'])){if($ires['im_id'] == $eres['im_parent']){echo "selected";}}?>><?php echo $ires['im_type'];?></option>
                <?php
						}
					?>
            </select></td>
            </tr>
            <tr class="fnt">
              <td height="39" align="right">Refered By </td>
              <td height="39" align="center">:</td>
              <td height="39" align="left"><select name="refer_by" id="refer_by" required>
                <option value="">-- Select Employee --</option>
                <?php 
							$emp_sql = "select * from emp_master where emp_desig = '2' and emp_status > '0' order by emp_name asc";
							$emp_rec = q($emp_sql);
							while($emp_res = f($emp_rec)){
						?>
                <option value="<?php echo $emp_res['emp_id'];?>"><?php echo $emp_res['emp_name'];?></option>
                <?php }?>
              </select></td>
              <td height="38" align="right">&nbsp;</td>
              <td height="38" align="center">&nbsp;</td>
              <td height="38" align="left">&nbsp;</td>
              <td height="38" align="right">Refered Garage </td>
              <td height="38" align="center">:</td>
              <td height="38" align="left"><select name="garage" id="garage" required>
				  <option value="">-- Select Garage --</option>
				  <?php 
								$gsql = "select * from garage_master where gm_status > '0'";
								$grec = q($gsql);
								while($gres = f($grec)){
							?>
				  <option value="<?php echo $gres['gm_id'];?>"><?php echo $gres['gm_name'];?></option>
				  <?php }?>
				</select>	</td>
            </tr>
            <tr class="fnt">
              <td height="39" align="right">Driver</td>
              <td height="39" align="center">:</td>
              <td height="39" align="left"><select name="in_driver" id="in_driver" required>
                <option value="">-- Select Driver --</option>
                <?php 
							$emp_sql = "select * from emp_master where emp_desig = '1' and emp_status > '0' order by emp_name asc";
							$emp_rec = q($emp_sql);
							while($emp_res = f($emp_rec)){
						?>
                <option value="<?php echo $emp_res['emp_id'];?>"><?php echo $emp_res['emp_name'];?></option>
                <?php }?>
              </select></td>
              <td height="38" align="right">&nbsp;</td>
              <td height="38" align="center">&nbsp;</td>
              <td height="38" align="left">&nbsp;</td>
              <td height="38" align="right">Date</td>
              <td height="38" align="center">:</td>
              <td height="38" align="left"><input name="in_date" type="date" required="required"/></td>
            </tr>
		<?php }if(isset($_GET['OUT'])){?>
            <tr class="fnt">
              <td height="39" align="right">Inform By </td>
              <td height="39" align="center">:</td>
              <td height="39" align="left"><input name="inform_by" type="text" /></td>
              <td height="38" align="right">Driver</td>
              <td height="38" align="center">:</td>
              <td height="39" align="left"><select name="out_driver" id="out_driver" required="required">
                  <option value="">-- Select Driver --</option>
                  <?php 
							$emp_sql = "select * from emp_master where emp_desig = '1' and emp_status > '0' order by emp_name asc";
							$emp_rec = q($emp_sql);
							while($emp_res = f($emp_rec)){
						?>
                  <option value="<?php echo $emp_res['emp_id'];?>"><?php echo $emp_res['emp_name'];?></option>
                  <?php }?>
              </select></td>
              <td height="38" align="right">Date</td>
              <td height="38" align="center">:</td>
              <td height="38" align="left"><input name="out_date" type="date" id="out_date" required="required"/></td>
            </tr>
		<?php }?>
            <tr class="fnt">
              <td height="39" align="right">Remarks</td>
              <td height="39" align="center">:</td>
              <td height="39" colspan="7" align="left"><textarea <?php if(isset($_GET['IN'])){echo 'name="in_remarks"';}else{echo 'name="out_remarks"';}?> rows="3" style="width:90%;"></textarea></td>
            </tr>
            <tr class="fnt">
              <td height="30" colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="9" align="center"><input class="head_font" type="submit" name="Submit" value="Submit"/>              </td>
            </tr>
            <tr class="fnt">
              <td colspan="9" align="center">&nbsp;</td>
            </tr>
            <tr background="images\1by25.jpg">
              <td colspan="9" align="center" height="21">&nbsp;</td>
            </tr>
  </table>
</form>
 <br /><br /><br />
   
  
  


<?php include "includes/footer.php";?>
<script>
	function desc(ID){
		$("#description").html("<option value=''>Please Wait...</option>");
		var data = "DESCRIPTION="+ID+"&get_description";
		//alert('ID='+ID+' Data='+data);
		$.ajax({
			type	: 'GET',
			data	: data,
			url 	: 'ajax_master.php',
			success	: function(result){
				$("#description").html(result);
			}
		})
	}
</script>