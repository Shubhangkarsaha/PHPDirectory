<?php 
$page_name = "Sub Incident Register";
include "includes/header.php";
if(isset($_POST['Submit']))
{
	$im_type 	= $_POST['im_type'];
	$im_parent 	= $_POST['im_parent'];
	$today		= date('Y-m-d');
//SUBMIT
	if($_POST['Submit']=="Submit")
	{
	
		$sql = "INSERT INTO incident_master (im_type, im_parent, im_entry_date, im_entry_by) VALUES ('$im_type', '$im_parent', '$today', '$_SESSION[lid]')";
		//echo $sql;exit;
		
		$rec = q($sql);
		
		if($rec>0)
				echo alert_location_replace('Sub Incident Details inserted successfully.','sub_incident_register.php');
			else
				echo error_alert_location_replace('sub_incident_register.php');
	}
//UPDATE
	if($_POST['Submit']=="Edit")
	{
		$id = $_POST['pk'];
		
		$sql = "UPDATE `incident_master` SET im_type = '$im_type', im_parent = '$im_parent', im_update_date = '$today', im_update_by = '$_SESSION[lid]' where im_id = '$id'";
		//echo $sql;exit;
					
		$rec = q($sql);
		
		if($rec>0)
				echo alert_location_replace('Sub Incident Details updated successfully.','sub_incident_list.php');
			else
				echo error_alert_location_replace('sub_incident_list.php');
	}	
}
//Edit fetch
if (isset($_GET['Edit']))
{
	$E = $_GET['Edit'];
	$esql= "select * from incident_master where im_id='$E' and im_status = '1'";
	if(row_count($esql)>0)
		$eres = qf($esql);
	else
		echo alert_location_replace('Sub Incident Details is not available!','sub_incident_list.php');
}
?>
<style type="text/css">
<!--
.style3 {font-size: 24px; font-weight: bold; }
-->
</style>


<section class="content-header">
      <h1>
        Sub Incident Register
    <small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New ";}?>Sub Incident Details</small>   </h1>
      <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Incident Register</strong></li>
		 <li class="active"><strong>Sub Incident</strong></li>
		 <li class="active"><strong>Add New Sub Incident</strong></li>
</ol>
      </section>
<br />

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" class="main_bod" >
            <tr background="images\1by25.jpg">
              <td height="40" colspan="6" align="center">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td height="25" colspan="6" align="right">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td width="21%" height="51" align="right"><strong>Incident </strong></td>
              <td width="2%" height="51" align="center"><strong>:</strong></td>
              <td width="26%" height="54" align="left">
			  	<select name="im_parent" required="required">
					<option value="">-- Select Incident --</option>
					<?php
						$isql = "select * from incident_master where im_parent = '0' and im_status > '0' order by im_type asc";
						$irec = q($isql);
						while($ires = f($irec)){
					?>
					<option value="<?php echo $ires['im_id'];?>"<?php if(isset($_GET['Edit'])){if($ires['im_id'] == $eres['im_parent']){echo "selected";}}?>><?php echo $ires['im_type'];?></option>
					<?php
						}
					?>
				</select>
			  </td>
              <td width="19%" align="right"><strong>Description</strong></td>
              <td width="2%" align="center"><strong>:</strong></td>
              <td width="30%" align="left"><textarea name="im_type" cols="30" rows="3" required="required"><?php echo @$eres['im_type'];?></textarea></td>
            </tr>
            <tr class="fnt">
              <td height="30" colspan="6" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="6" align="center"><input class="head_font" type="submit" name="Submit" <?php if(isset($_GET['Edit'])) { echo "value=Edit" ;} else { echo "value=Submit" ;}?> />
                  <input type="hidden" name="pk" value="<?php echo @$fres2['im_id'];?>"/>              </td>
            </tr>
            <tr class="fnt">
              <td colspan="6" align="center">&nbsp;</td>
            </tr>
            <tr background="images\1by25.jpg">
              <td colspan="6" align="center" height="21">&nbsp;</td>
            </tr>
  </table>
</form>
   
  
  


<?php include "includes/footer.php";?>
