<?php 
$page_name = "Incident Register";
include "includes/header.php";
if(isset($_POST['Submit']))
{
	$im_type 	= $_POST['im_type'];
	$today		= date('Y-m-d');
//SUBMIT
	if($_POST['Submit']=="Submit")
	{
	
		$sql = "INSERT INTO incident_master (im_type, im_entry_date, im_entry_by) VALUES ('$im_type', '$today', '$_SESSION[lid]')";
		//echo $sql;exit;
		
		$rec = q($sql);
		
		if($rec>0)
				echo alert_location_replace('Incident Details inserted successfully.','incident_register.php');
			else
				echo error_alert_location_replace('incident_register.php');
	}
//UPDATE
	if($_POST['Submit']=="Edit")
	{
		$id = $_POST['pk'];
		
		$sql = "UPDATE `incident_master` SET im_type = '$im_type', im_update_date = '$today', im_update_by = '$_SESSION[lid]' where im_id = '$id'";
		//echo $sql;exit;
					
		$rec = q($sql);
		
		if($rec>0)
				echo alert_location_replace('Incident Details updated successfully.','incident_list.php');
			else
				echo error_alert_location_replace('incident_list.php');
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
		echo alert_location_replace('Incident Details is not available!','gm_list.php');
}
?>
<section class="content-header">
  <h1>
    Incident Register
    <small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New ";}?>Incident Details</small>     </h1>
	<ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Incident Register</strong></li>
		 <li class="active"><strong>Incident</strong></li>
		 <li class="active"><strong>Add New Incident</strong></li>
</ol>
</section>
<br />

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" class="main_bod" >
            <tr background="images\1by25.jpg">
              <td height="31" colspan="3" align="center">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td height="25" colspan="3" align="right">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td width="47%" height="38" align="right"><strong>Incident Type </strong></td>
              <td width="3%" height="38" align="center"><strong>:</strong></td>
              <td width="50%" height="38" align="left"><input name="im_type" type="text" id="im_type" value="<?php echo @$eres['im_type'];?>" required="required"/></td>
            </tr>
            <tr class="fnt">
              <td height="30" colspan="3" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="3" align="center"><input class="head_font" type="submit" name="Submit" <?php if(isset($_GET['Edit'])) { echo "value=Edit" ;} else { echo "value=Submit" ;}?> />
                  <input type="hidden" name="pk" value="<?php echo @$eres['im_id'];?>"/>              </td>
            </tr>
            <tr class="fnt">
              <td colspan="3" align="center">&nbsp;</td>
            </tr>
            <tr background="images\1by25.jpg">
              <td colspan="3" align="center" height="21">&nbsp;</td>
            </tr>
  </table>
</form>
   
  
  


<?php include "includes/footer.php";?>