<?php 
$page_name = "Vehicle Manufacturer Register";
include "includes/header.php";

if(isset($_POST['Submit']))
{
	$manufacturer = $_POST['manufacturer'];
	$today = date('Y-m-d');
	if($_POST['Submit'] == "Submit")
	{
		$check = row_count("SELECT * FROM vehicle_manufacturer_master where vmm_name like '$manufacturer%' and vmm_status > '0'");
		if($check>0)
			echo alert_location_replace('Vehicle Manufacturer already exist.','vmanufacturer_register.php');
		else{
			$sql = "insert into vehicle_manufacturer_master (vmm_name,vmm_entry_date,vmm_entry_by) values ('$manufacturer','$today','$_SESSION[lid]')";
			$rec = q($sql);
			if($rec>0)
				echo alert_location_replace('Vehicle Manufacturer inserted successfully.','vmanufacturer_register.php');
			else
				echo error_alert_location_replace('vmanufacturer_register.php');
		}
	}
	 elseif($_POST['Submit'] == "Edit")
	 {
		$pk = $_POST['pk'];
		$sql = "update vehicle_manufacturer_master set vmm_name ='$manufacturer', vmm_update_date = '$today', vmm_update_by = '$_SESSION[lid]' where vmm_id='$pk'";
		//echo $sql;exit;
		$rec = q($sql);
		if($rec>0)
				echo alert_location_replace('Vehicle Manufacturer updated successfully.','vmanufacturer_list.php');
			else
				echo error_alert_location_replace('vmanufacturer_list.php');
	 }
}
if (isset($_GET['Edit']))
{
	$E = $_GET['Edit'];
	$esql= "select * from vehicle_manufacturer_master where vmm_id='$E' and vmm_status > '0'";
	if(row_count($esql)>0)
		$eres = qf($esql);
	else
		echo alert_location_replace('Vehicle Manufacturer is not available!','vmanufacturer_list.php');
}
?>
<section class="content-header">
      <h1>Vehicle Manufacturer   Register
	  		<small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New";}?> Vehicle Manufacturer </small>
	  </h1>
	   <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Vehicle Details Register</strong></li>
		 <li class="active"><strong>Vehicle Manufacturer</strong></li>
		 <li class="active"><strong>Add New Manufacturer</strong></li>
</ol>
</section>
<br>








<form name="form1" method="post" action="">
  <table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" class="main_bod">
    <tr background="images\1by25.jpg">
      <td height="31" colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="right">&nbsp;</td>
    </tr>
    <tr class="fnt">
      <td width="47%" align="right">Manufacturer Name   </td>
      <td width="3%" align="center">:</td>
      <td width="50%" align="left"><input name="manufacturer" type="text" id="manufacturer" value="<?php echo @$eres['vmm_name'];?>" required/></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input type="submit" class="head_font" name="Submit" <?php if(isset($_GET['Edit'])){echo "value='Edit'";}else{?>value="Submit"<?php }?> />
      <input name="pk" type="hidden" id="pk" value="<?php echo $eres['vmm_id'];?>" /></td>
    </tr>
    <tr background="images\1by25.jpg">
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
</form>










	<?php include "includes/footer.php";?>
 