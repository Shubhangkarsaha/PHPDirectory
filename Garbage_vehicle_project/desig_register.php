<?php 
$page_name = "Designation Register";
include "includes/header.php";

if(isset($_POST['Submit']))
{
	$desig_name = $_POST['desig_name'];
	
	if($_POST['Submit'] == "Submit")
	{
		$check = row_count("SELECT * FROM designation_master where desig_name like '$desig_name%' and desig_status = '1'");
		if($check>0)
			echo alert_location_replace('Designation already exist.','desig_register.php');
		else{
			$sql = "insert into designation_master (desig_name) values ('$desig_name')";
			$rec = q($sql);
			if($rec>0)
				echo alert_location_replace('Designation inserted successfully.','desig_register.php');
			else
				echo error_alert_location_replace('desig_register.php');
		}
	}
	 elseif($_POST['Submit'] == "Edit")
	 {
		$pk = $_POST['pk'];
		$sql = "update designation_master set desig_name ='$desig_name' where desig_id='$pk'";
		$rec = q($sql);
		if($rec>0)
				echo alert_location_replace('Designation updated successfully.','desig_list.php');
			else
				echo error_alert_location_replace('desig_list.php');
	 }
}
if (isset($_GET['Edit']))
{
	$E = $_GET['Edit'];
	$esql= "select * from designation_master where desig_id='$E' and desig_status = '1'";
	if(row_count($esql)>0)
		$eres = qf($esql);
	else
		echo alert_location_replace('Designation is not available!','desig_list.php');
}
?>
<section class="content-header">
      <h1>Designation Register
	  		<small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New";}?> Designation </small>
	  </h1>
	  <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Designation Register</strong></li>
		 <li class="active"><strong>Add New Designation</strong></li>
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
      <td width="47%" align="right">Designation </td>
      <td width="3%" align="center">:</td>
      <td width="50%" align="left"><input name="desig_name" type="text" id="desig_name" value="<?php echo @$eres['desig_name'];?>" required/></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input type="submit" class="head_font" name="Submit" <?php if(isset($_GET['Edit'])){echo "value='Edit'";}else{?>value="Submit"<?php }?> />
      <input name="pk" type="hidden" id="pk" value="<?php echo $eres['desig_id'];?>" /></td>
    </tr>
    <tr background="images\1by25.jpg">
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
</form>










	<?php include "includes/footer.php";?>
 