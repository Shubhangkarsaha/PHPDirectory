<?php 
$page_name = "Qualification Register";
include "includes/header.php";

if(isset($_POST['Submit']))
{
	$qual_name = $_POST['qual_name'];
	
	if($_POST['Submit'] == "Submit")
	{
		$check = row_count("SELECT * FROM qualification_master where qm_name like '$qual_name%' and qm_status = '1'");
		if($check>0)
			echo alert_location_replace('Qualification Details already exist.','qualification_register.php');
		else{
			$sql = "insert into qualification_master (qm_name) values ('$qual_name')";
			$rec = q($sql);
			if($rec>0)
				echo alert_location_replace('Qualification Details inserted successfully.','qualification_register.php');
			else
				echo error_alert_location_replace('quaification_register.php');
		}
	}
	 elseif($_POST['Submit'] == "Edit")
	 {
		$pk = $_POST['pk'];
		$sql = "update qualification_master set qm_name ='$qual_name' where qm_id='$pk'";
		$rec = q($sql);
		if($rec>0)
				echo alert_location_replace('Qualification Details updated successfully.','qualification_list.php');
			else
				echo error_alert_location_replace('qualification_list.php');
	 }
}
if (isset($_GET['Edit']))
{
	$E = $_GET['Edit'];
	$esql= "select * from qualification_master where qm_id='$E' and qm_status = '1'";
	if(row_count($esql)>0)
		$eres = qf($esql);
	else
		echo alert_location_replace('Qualifitation Details is not available!','qualification_list.php');
}
?>
<section class="content-header">
      <h1>Qualification Register
	  		<small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New";}?> Qualification </small>
	  </h1>
	  <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Qualifiaction Register</strong></li>
		 <li class="active"><strong>Add New Qualifiaction</strong></li>
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
      <td width="47%" align="right">Qualification </td>
      <td width="3%" align="center">:</td>
      <td width="50%" align="left"><input name="qual_name" type="text" id="qual_name" value="<?php echo @$eres['qm_name'];?>" required/></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input type="submit" class="head_font" name="Submit" <?php if(isset($_GET['Edit'])){echo "value='Edit'";}else{?>value="Submit"<?php }?> />
      <input name="pk" type="hidden" id="pk" value="<?php echo $eres['qm_id'];?>" /></td>
    </tr>
    <tr background="images\1by25.jpg">
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
</form>










	<?php include "includes/footer.php";?>
 