<?php 
$page_name = "Vehicle Model Register";
include "includes/header.php";

if(isset($_POST['Submit']))
{
	$manufacturer = $_POST['manufacturer'];
	$model = $_POST['model'];
	$today = date('Y-m-d');
	if($_POST['Submit'] == "Submit")
	{
		$check = row_count("SELECT * FROM vehicle_model_master where vmodel_manufacturer = '$manufacturer' and vmodel_name like '$model%' and vmodel_status > '0'");
		if($check>0)
			echo alert_location_replace('Vehicle Model already exist.','vmodel_register.php');
		else{
			$sql = "insert into vehicle_model_master (vmodel_manufacturer,vmodel_name,vmodel_entry_date,vmodel_entry_by) values ('$manufacturer', '$model', '$today', '$_SESSION[lid]')";
			$rec = q($sql);
			if($rec>0)
				echo alert_location_replace('Vehicle Model inserted successfully.','vmodel_register.php');
			else
				echo error_alert_location_replace('vmodel_register.php');
		}
	}
	 elseif($_POST['Submit'] == "Edit")
	 {
		$pk = $_POST['pk'];
		$sql = "update vehicle_model_master set vmodel_manufacturer = '$manufacturer', vmodel_name = '$model', vmodel_update_date = '$today', vmodel_update_by = '$_SESSION[lid]' where vmodel_id='$pk'";
		//echo $sql;exit;
		$rec = q($sql);
		if($rec>0)
				echo alert_location_replace('Vehicle Model updated successfully.','vmodel_list.php');
			else
				echo error_alert_location_replace('vmodel_list.php');
	 }
}
if (isset($_GET['Edit']))
{
	$E = $_GET['Edit'];
	$esql= "select * from vehicle_model_master where vmodel_id='$E' and vmodel_status > '0'";
	if(row_count($esql)>0)
		$eres = qf($esql);
	else
		echo alert_location_replace('Vehicle Model is not available!','vmanufacturer_list.php');
}
?>
<section class="content-header">
      <h1>Vehicle Model   Register
	  		<small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New";}?> Vehicle Model </small>
	  </h1>
	    <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Vehicle Details Register</strong></li>
		 <li class="active"><strong>Vehicle Model</strong></li>
		 <li class="active"><strong>Add New Model</strong></li>
</ol>
</section>
<br>








<form name="form1" method="post" action="">
  <table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" class="main_bod">
    <tr background="images\1by25.jpg">
      <td height="31" colspan="6" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6" align="right">&nbsp;</td>
    </tr>
    <tr class="fnt">
      <td width="23%" align="right">Manufacturer   </td>
      <td width="2%" align="center">:</td>
      <td width="24%" align="left"><select name="manufacturer" required>
        <option value="">-- Select Manufacturer --</option>
        <?php 
			$vmm_sql = "SELECT * FROM `vehicle_manufacturer_master` WHERE vmm_status > '0' order by vmm_name asc";
			$vmm_rec = q($vmm_sql);
			while($vmm_res = f($vmm_rec)){
		?>
        <option value="<?php echo $vmm_res['vmm_id'];?>"<?php if(isset($_GET['Edit'])){if($vmm_res['vmm_id'] == $eres['vmodel_manufacturer']){echo "selected";}}?>><?php echo $vmm_res['vmm_name'];?></option>
        <?php }?>
      </select></td>
      <td width="23%" align="right">Model </td>
      <td width="3%" align="center">:</td>
      <td width="25%" align="left"><input name="model" type="text" id="model" value="<?php echo @$eres['vmodel_name'];?>" required="required"/></td>
    </tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6" align="center"><input type="submit" class="head_font" name="Submit" <?php if(isset($_GET['Edit'])){echo "value='Edit'";}else{?>value="Submit"<?php }?> />
      <input name="pk" type="hidden" id="pk" value="<?php echo $eres['vmodel_id'];?>" /></td>
    </tr>
    <tr background="images\1by25.jpg">
      <td colspan="6">&nbsp;</td>
    </tr>
  </table>
</form>










	<?php include "includes/footer.php";?>
 