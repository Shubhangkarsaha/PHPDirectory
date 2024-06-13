<?php 
$page_name = "Reminder Register";
include "includes/header.php";
if(isset($_POST['Submit']))
{
	$rm_title 		= $_POST['rm_title'];
	list($rm_date,$rm_time) = explode("T",$_POST['rm_date_time']);
	$rm_description	= $_POST['rm_description'];
	//echo $rm_date_time;exit;
	$today			= date('Y-m-d');
	
	if($_POST['Submit']=="Submit")
	{
		$sql ="INSERT INTO `reminder_master`(`rm_title`, `rm_date`, `rm_time`, `rm_description`, `rm_for`, `rm_entry_date`, `rm_entry_by`) VALUES ('$rm_title', '$rm_date', '$rm_time', '$rm_description', '$_SESSION[lid]', '$today', '$_SESSION[lid]')";
		
		//echo $sql;exit;
		$rec = q($sql);
		 			
		if($rec>0)
			echo alert_location_replace('Reminder inserted successfully.', 'reminder_register.php');
		else
			error_alert_location_replace('reminder_register.php');
		
	}
	if($_POST['Submit']=="Edit")
	{
		$id = $_POST['pk'];
		
		$sql = "UPDATE `reminder_master` SET rm_title='$rm_title', rm_date='$rm_date', rm_time='$rm_time', rm_description='$rm_description', rm_for='$_SESSION[lid]', rm_entry_date='$today', rm_entry_by='$_SESSION[lid]' where rm_id = '$id'";
		//echo $sql;exit;
				
		 $rec = q($sql);
		 
		 if($rec>0)
			echo alert_location_replace('Reminder updated successfully.', 'reminder_list.php');
		else
			error_alert_location_replace('reminder_list.php');
	}	
}	  
	
if (isset($_GET['Edit']))
{
	$E = $_GET['Edit'];
	$esql= "select * from reminder_master where rm_id='$E' and rm_status = '1'";
	if(row_count($esql)>0)
		$eres = qf($esql);
	else
		echo alert_location_replace('Reminder is not available!','reminder_list.php');
}
?>
<section class="content-header">
	  <h1>
      	Remainder Register  
        <small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New ";}?>Remainder Details</small>
      </h1>
      <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Remainder Register</strong></li>
		 <li class="active"><strong>Add New Remainder</strong></li>
</ol>
</section>
<br>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <table width="80%" border="0" align="center" cellpadding="1" cellspacing="1" class="main_bod" >
            <tr background="images\1by25.jpg">
              <td height="40" colspan="9" align="center">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td height="25" colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td width="15%" height="38" align="right"><strong>Title </strong></td>
              <td width="3%" height="38" align="center"><strong>:</strong></td>
              <td width="32%" height="38" align="left"><input name="rm_title" type="text" id="rm_title" value="<?php echo @$eres['rm_title'];?>"  required="required" /></td>
              <td width="22%" height="38" align="right"><strong> Date &amp; Time </strong></td>
              <td width="3%" height="38" align="center"><strong>:</strong></td>
              <td width="25%" height="38" align="left"><label>
                <input name="rm_date_time" type="datetime-local" id="rm_date_time" value="<?php echo $eres['rm_date']."T".$eres['rm_time'];?>"  required="required" />
              </label></td>
            </tr>
            <tr class="fnt">
              <td height="38" align="right"><strong>Description</strong></td>
              <td height="38" align="center"><strong>:</strong></td>
              <td height="39" colspan="4" align="left"><textarea name="rm_description" cols="110" rows="3" id="rm_description" required="required"><?php echo @$eres['rm_description'];?></textarea></td>
            </tr>
            <tr class="fnt">
              <td height="30" colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="9" align="center"><input class="head_font" type="submit" name="Submit" <?php if(isset($_GET['Edit'])) { echo "value=Edit" ;} else { echo "value=Submit" ;}?> />
                      <input type="hidden" name="pk" value="<?php echo @$eres['rm_id'];?>"/></td>
            </tr>
            <tr class="fnt">
              <td colspan="9" align="center">&nbsp;</td>
            </tr>
            <tr background="images\1by25.jpg">
              <td colspan="9" align="center" height="21">&nbsp;</td>
            </tr>
          </table>
</form>
<?php include "includes/footer.php";?>	