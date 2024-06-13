<?php 
$page_name = "Fuel Type Register";
include "includes/header.php";

if(isset($_POST['Submit']))
{
	$fuel_type = $_POST['fuel_type'];
	
	if($_POST['Submit'] == "Submit")
	{
		$sql = "insert into fuel_type_master (ftm_type) values ('$fuel_type')";
		$rec = q($sql);
		if($rec>0)
			echo alert_location_replace('Fuel Type inserted successfully.','fuel_type_register.php');
		else
			echo error_alert_location_replace('fuel_type_register.php');
		
	}
	 elseif($_POST['Submit'] == "Edit")
	 {
		$pk = $_POST['pk'];
		$sql = "update fuel_type_master set ftm_type ='$fuel_type' where ftm_id='$pk'";
		//echo $sql;exit;
		$rec = q($sql);
		if($rec>0)
				echo alert_location_replace('Fuel Type updated successfully.','fuel_type_list.php');
			else
				echo error_alert_location_replace('fuel_type_list.php');
	 }
}
if (isset($_GET['Edit']))
{
	$E = $_GET['Edit'];
	$esql= "select * from fuel_type_master where ftm_id='$E'";
	if(row_count($esql)>0)
		$eres = qf($esql);
	else
		echo alert_location_replace('Fuel Type is not available!','fuel_type_list.php');
}
?>
<section class="content-header">
      <h1>Fuel Type  Register
	  		<small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New";}?> Fuel Type </small>
	  </h1>
	   <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Fuel Type Register</strong></li>
		 <li class="active"><strong>Add New Fuel Type</strong></li>
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
      <td width="47%" align="right">Fuel Type  </td>
      <td width="3%" align="center">:</td>
      <td width="50%" align="left"><input name="fuel_type" type="text" id="fuel_type" value="<?php echo @$eres['ftm_type'];?>" required/></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input type="submit" class="head_font" name="Submit" <?php if(isset($_GET['Edit'])){echo "value='Edit'";}else{?>value="Submit"<?php }?> />
      <input name="pk" type="hidden" id="pk" value="<?php echo $eres['ftm_id'];?>" /></td>
    </tr>
    <tr background="images\1by25.jpg">
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
</form>










	<?php include "includes/footer.php";?>
 