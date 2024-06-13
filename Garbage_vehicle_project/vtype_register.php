<?php 
$page_name = "Vehicle Type Register";
include "includes/header.php";

if(isset($_POST['Submit']))
{
	$type = $_POST['type'];
	$today = date('Y-m-d');
	if($_POST['Submit'] == "Submit")
	{
		$check = row_count("SELECT * FROM vehicle_type_master where vtm_type like '$type%' and vtm_status > '0'");
		if($check>0)
			echo alert_location_replace('Vehicle Type already exist.','vtype_register.php');
		else{
			$sql = "insert into vehicle_type_master (vtm_type,vtm_entry_date,vtm_entry_by) values ('$type','$today','$_SESSION[lid]')";
			$rec = q($sql);
			if($rec>0)
				echo alert_location_replace('Vehicle Type inserted successfully.','vtype_register.php');
			else
				echo error_alert_location_replace('vtype_register.php');
		}
	}
	 elseif($_POST['Submit'] == "Edit")
	 {
		$pk = $_POST['pk'];
		$sql = "update vehicle_type_master set vtm_type ='$type', vtm_update_date = '$today', vtm_update_by = '$_SESSION[lid]' where vtm_id='$pk'";
		//echo $sql;exit;
		$rec = q($sql);
		if($rec>0)
				echo alert_location_replace('Vehicle Type updated successfully.','vtype_list.php');
			else
				echo error_alert_location_replace('vtype_list.php');
	 }
}
if (isset($_GET['Edit']))
{
	$E = $_GET['Edit'];
	$esql= "select * from vehicle_type_master where vtm_id='$E' and vtm_status > '0'";
	if(row_count($esql)>0)
		$eres = qf($esql);
	else
		echo alert_location_replace('Vehicle Type is not available!','vtype_list.php');
}
?>
<section class="content-header">
      <h1>Vehicle Type   Register
	  		<small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New";}?> Vehicle Type </small>
	  </h1>
	   <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Vehicle Details Register</strong></li>
		 <li class="active"><strong>Vehicle Type</strong></li>
		 <li class="active"><strong>Add New Vehicle Type</strong></li>
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
      <td width="47%" align="right">Vehicle Type</td>
      <td width="3%" align="center">:</td>
      <td width="50%" align="left"><input name="type" type="text" id="type" value="<?php echo @$eres['vtm_type'];?>" required/></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input type="submit" class="head_font" name="Submit" <?php if(isset($_GET['Edit'])){echo "value='Edit'";}else{?>value="Submit"<?php }?> />
      <input name="pk" type="hidden" id="pk" value="<?php echo $eres['vtm_id'];?>" /></td>
    </tr>
    <tr background="images\1by25.jpg">
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
</form>










	<?php include "includes/footer.php";?>
 