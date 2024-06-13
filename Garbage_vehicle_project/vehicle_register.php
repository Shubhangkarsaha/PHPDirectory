<?php 
$page_name = "Vehicle Register";
include "includes/header.php";

if(isset($_POST['Submit']))
{
//Vehicle Details
	$manufacturer 			= $_POST['manufacturer'];
	$model					= $_POST['model'];
	$vehicle_type			= $_POST['vehicle_type'];
	$vehicle_name			= $_POST['vehicle_name'];
	$fuel_type				= $_POST['fuel_type'];
	$starting_date			= $_POST['starting_date'];
//Vehicle Number Details
	$tc_no					= $_POST['tc_no'];
	$vehicle_no				= $_POST['vehicle_no'];
	$chassis_no				= $_POST['chassis_no'];
	$engine_no				= $_POST['engine_no'];
//Other Details
	$gps_presence			= $_POST['gps_presence'];
	$gps_id					= $_POST['gps_id'];
	$gps_installation_date	= $_POST['gps_installation_date'];
	$owned_by				= $_POST['owned_by'];
	$today = date('Y-m-d');
	if($_POST['Submit'] == "Submit")
	{
		
		$sql = "INSERT INTO `vehicle_master`(`vm_manufacturer`, `vm_model`, `vm_vehicle_type`, `vm_name`, `vm_fuel_type`, `vm_start_date`, `vm_tc_no`, `vm_number`, `vm_chassis_no`, `vm_engine_no`, `vm_gps_presence`, `vm_gps_id`, `vm_gps_installation_date`, `vm_owned_by`, `vm_entry_date`, `vm_entry_by`) VALUES ('$manufacturer', '$model', '$vehicle_type', '$vehicle_name', '$fuel_type', '$starting_date', '$tc_no', '$vehicle_no', '$chassis_no', '$engine_no', '$gps_presence', '$gps_id', '$gps_installation_date', '$owned_by', '$today', '$_SESSION[lid]')";
		//echo $sql;exit;
		$rec = q($sql);
		if($rec>0)
			echo alert_location_replace('Vehicle Details inserted successfully.','vehicle_register.php');
		else
			echo error_alert_location_replace('vehicle_register.php');
	
	}
	 elseif($_POST['Submit'] == "Edit")
	 {
		$pk = $_POST['pk'];
		$sql = "UPDATE `vehicle_master`set vm_manufacturer='$manufacturer', vm_model='$model', vm_vehicle_type='$vehicle_type', vm_name='$vehicle_name', vm_fuel_type='$fuel_type', vm_start_date='$starting_date', vm_tc_no='$tc_no', vm_number='$vehicle_no', vm_chassis_no='$chassis_no', vm_engine_no='$engine_no', vm_gps_presence='$gps_presence', vm_gps_id='$gps_id', vm_gps_installation_date='$gps_installation_date', vm_owned_by='$owned_by', vm_update_date='$today', vm_update_by='$_SESSION[lid]' WHERE vm_id='$pk'";
		//echo $sql;exit;
		$rec = q($sql);
		if($rec>0)
				echo alert_location_replace('Vehicle Details updated successfully.','vehicle_list.php');
			else
				echo error_alert_location_replace('vehicel_list.php');
	 }
}
if (isset($_GET['Edit']))
{
	$E = $_GET['Edit'];
	$esql= "select * from vehicle_master where vm_id='$E' and vm_status > '0'";
	if(row_count($esql)>0)
		$eres = qf($esql);
	else
		echo alert_location_replace('Vehicle Details is not available!','vehicle_list.php');
}
?>
<section class="content-header">
      <h1>Vehicle  Register
	  		<small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New";}?>
  		    Vehicle Details</small>	  </h1>
			<ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Vehicle Register</strong></li>
		 <li class="active"><strong>Add New Vehicle</strong></li>
</ol>
</section>
<br>

<form name="form1" method="post" action="vehicle_register.php" enctype="multipart/form-data">
  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="main_bod">
    <tr class="head_font" background="images\1by25.jpg">
      <td height="31" colspan="9" align="left">&nbsp;Vehicle Details</td>
    </tr>
    <tr>
      <td colspan="9" align="right">&nbsp;</td>
    </tr>
    <tr class="fnt">
      <td width="10%" align="right">Manufacturer   </td>
      <td width="2%" align="center">:</td>
      <td width="15%" align="left">
		  <select name="manufacturer" id="manufacturer" required="required" onchange="vehicle_model(this.value)">
			<option value="">-- Select Manufacturer --</option>
			<?php 
				$vmm_sql = "SELECT * FROM `vehicle_manufacturer_master` WHERE vmm_status = '1' order by vmm_name asc";
				$vmm_rec = q($vmm_sql);
				while($vmm_res = f($vmm_rec)){
			?>
			<option value="<?php echo $vmm_res['vmm_id'];?>"<?php if(isset($_GET['Edit'])){if($vmm_res['vmm_id'] == $eres['vm_manufacturer']){echo "selected";}}?>><?php echo $vmm_res['vmm_name'];?></option>
			<?php }?>
		  </select>	  </td>
      <td width="19%" align="right">Model</td>
      <td width="2%" align="center">:</td>
      <td width="19%" align="left">
	 	 <select name="model" id="model" required="required">
			<option value="">-- Select Model --</option>
			<?php 
				$vmodel_sql = "SELECT * FROM `vehicle_model_master` WHERE vmodel_status = '1' ";
				if(isset($_GET['Edit'])){
					$vmodel_sql.=" and vmodel_manufacturer = '$eres[vm_manufacturer]'";
				}
				$vmodel_sql.="order by vmodel_name asc";
				//echo $vmodel;exit;
				$vmodel_rec = q($vmodel_sql);
				while($vmodel_res = f($vmodel_rec)){
			?>
			<option value="<?php echo $vmodel_res['vmodel_id'];?>"<?php if(isset($_GET['Edit'])){if($vmodel_res['vmodel_id'] == $eres['vm_model']){echo "selected";}}?>><?php echo $vmodel_res['vmodel_name'];?></option>
			<?php }?>
	    </select>	  </td>
      <td width="12%" align="right">Vehicle Type</td>
      <td width="2%" align="center">:</td>
      <td width="19%" align="left">
		  <select name="vehicle_type" id="vehicle_type" required="required">
			<option value="">-- Select Vehicle Type --</option>
			<?php 
				$vtype_sql = "select * from vehicle_type_master where vtm_status = '1'";
				$vtype_rec = q($vtype_sql);
				while($vtype_res = f($vtype_rec)){
			?>
			<option value="<?php echo $vtype_res['vtm_id'];?>"<?php if(isset($_GET['Edit'])){if($vtype_res['vtm_id'] == $eres['vm_vehicle_type']){echo "selected";}}?>><?php echo $vtype_res['vtm_type'];?></option>
			<?php }?>
		  </select>      </td>
    </tr>
    <tr class="fnt">
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr class="fnt">
      <td align="right">Vehicle Name  </td>
      <td align="center">:</td>
      <td align="left"><input name="vehicle_name" type="text" id="vehicle_name" value="<?php echo @$eres['vm_name'];?>" required="required"/></td>
      <td align="right">Fuel Type </td>
      <td align="center">:</td>
      <td align="left">
	  	<select name="fuel_type" id="fuel_type" required="required">
			<option value="">-- Select Vehicle Type --</option>
			<?php 
				$ftype_sql = "select * from fuel_type_master order by ftm_type asc";
				$ftype_rec = q($ftype_sql);
				while($ftype_res = f($ftype_rec)){
			?>
			<option value="<?php echo $ftype_res['ftm_id'];?>"<?php if(isset($_GET['Edit'])){if($ftype_res['ftm_id'] == $eres['vm_fuel_type']){echo "selected";}}?>><?php echo $ftype_res['ftm_type'];?></option>
			<?php }?>
		  </select>	  </td>
      <td align="right">Starting Date </td>
      <td align="center">:</td>
      <td align="left"><input name="starting_date" type="date" id="starting_date" value="<?php echo @$eres['vm_start_date'];?>" style="width:155px;;"/></td>
    </tr>
    <tr class="fnt">
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr class="head_font" background="images/1by25.jpg">
      <td height="27" colspan="9" align="left" >&nbsp;Vehicle Number Details </td>
    </tr>
    <tr class="fnt">
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr class="fnt">
      <td align="right">TC No. </td>
      <td align="center">:</td>
      <td align="left"><input name="tc_no" type="text" id="tc_no" value="<?php echo @$eres['vm_tc_no'];?>"/></td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">Vehicle No. </td>
      <td align="center">:</td>
      <td align="left"><input name="vehicle_no" type="text" id="vehicle_no" value="<?php echo @$eres['vm_number'];?>" /></td>
    </tr>
    <tr class="fnt">
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr class="fnt">
      <td align="right">Chassis No. </td>
      <td align="center">:</td>
      <td align="left"><input name="chassis_no" type="text" id="chassis_no" value="<?php echo @$eres['vm_chassis_no'];?>" /></td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">Engine No. </td>
      <td align="center">:</td>
      <td align="left"><input name="engine_no" type="text" id="engine_no" value="<?php echo @$eres['vm_engine_no'];?>" /></td>
    </tr>
    <tr class="fnt">
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr class="head_font" background="images/1by25.jpg">
      <td height="28" colspan="9" align="left" >&nbsp;Other Details</td>
    </tr>
    <tr class="fnt">
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr class="fnt">
      <td align="right">GPS Presence </td>
      <td align="center">:</td>
      <td align="left">
	  <select name="gps_presence" id="gps_presence" onchange="gps(this.value)" required="required">
        <option value="">-- Select Presence--</option>
        <option value="1" <?php if(isset($_GET['Edit'])){if($eres['vm_gps_presence'] == 1){echo "selected";}}?>>Yes</option>
        <option value="0" <?php if(isset($_GET['Edit'])){if($eres['vm_gps_presence'] == 0){echo "selected";}}?>>No</option>
      </select>
      </td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">Owned By </td>
      <td align="center">:</td>
      <td align="left">
	  <select name="owned_by" required="required">
      	<option value="">-- Select Organization --</option>
		<?php
			$org_sql = "select * from organization_master where om_status = '1' order by om_name asc";
			$org_rec = q($org_sql);
			while($org_res = f($org_rec)){
		?>
		<option value="<?php echo $org_res['om_id'];?>"<?php if(isset($_GET['Edit'])){if($org_res['om_id'] == $eres['vm_owned_by']){echo "Selected";}}?>><?php echo $org_res['om_name'];?></option>
		<?php }?>
	  </select>
      </td>
    </tr>
    <tr class="fnt">
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr class="fnt gps_class" style="display:none;">
      <td align="right">GPS ID </td>
      <td align="center">:</td>
      <td align="left"><input name="gps_id" type="text" id="gps_id" value="<?php echo @$eres['vm_gps_id'];?>" /></td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">GPS Installation Date </td>
      <td align="center">:</td>
      <td align="left"><input name="gps_installation_date" type="date" id="gps_installation_date" value="<?php echo @$eres['vm_gps_installation_date'];?>"/></td>
    </tr>
    <tr>
      <td colspan="9">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="9" align="center"><input type="submit" class="head_font" name="Submit" <?php if(isset($_GET['Edit'])){echo "value='Edit'";}else{?>value="Submit"<?php }?> />
      <input name="pk" type="hidden" id="pk" value="<?php echo $eres['vm_id'];?>" /></td>
    </tr>
    <tr background="images\1by25.jpg">
      <td colspan="9">&nbsp;</td>
    </tr>
  </table>
</form>
<br /><br /><br /><br /><br /><br /><br /><br /><br />
<script>
<?php if(isset($_GET['Edit'])){?>
	if($("#gps_presence").val() == 1){
		$(".gps_class").show();
		document.getElementById("gps_id").required = true;
		document.getElementById("gps_installation_date").required = true;
	}
	else{
		$(".gps_class").hide();
		document.getElementById("gps_id").required = false;
		document.getElementById("gps_installation_date").required = false;
	}
<?php }?>
	
	function vehicle_model(ID){
		$("#model").html("<option value=''>...Please Wait</option>");
		var data = 'MANUFACTURER='+ID+'&get_vehicle_model';
		$.ajax({
			type	:	'GET',
			data	:	data,
			url		:	'ajax_master.php',
			success	:	function(result){
				$("#model").html(result);
			}
		})
	}
	
	function gps(ID){	
		if(ID == 1){
			$(".gps_class").show();
			document.getElementById("gps_id").required = true;
			document.getElementById("gps_installation_date").required = true;
		}
		else{
			$(".gps_class").hide();
			document.getElementById("gps_id").required = false;
			document.getElementById("gps_id").value = "";
			document.getElementById("gps_installation_date").required = false;
			document.getElementById("gps_installation_date").value= "";
		}
	}
</script>
<?php include "includes/footer.php";?>
 