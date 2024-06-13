<?php 
$page_name = "Ward Register";
include "includes/header.php";
if(isset($_POST['Submit']))
{
	$ward_no 			= $_POST['ward_no'];
	$ward_councilor 	= $_POST['ward_councilor'];
	$councilor_no 		= $_POST['councilor_no'];
	$ward_master_name	= $_POST['ward_master_name'];
	$master_no			= $_POST['master_no'];
	$councilor_email 	= $_POST['councilor_email'];	
	if($_POST['Submit'] == "Submit")
	{
		$sql = "INSERT INTO `ward_master` (`ward_no`, `ward_master_name`, `master_no`, `ward_councilor`, `councilor_no`, `councilor_email`) values ('$ward_no', '$ward_master_name', '$master_no', '$ward_councilor', '$councilor_no', '$councilor_email')";
		$rec = q($sql);
		if($rec>0)
			echo alert_location_replace('Ward Details inserted successfully.','ward_register.php');
		else
			echo error_alert_location_replace('ward_register.php');
	}
	elseif($_POST['Submit'] == "Edit")
	{
		$pk = $_POST['pk'];
		$sql = "update ward_master set ward_no='$ward_no', ward_master_name='$ward_master_name', master_no='$master_no', ward_councilor='$ward_councilor', councilor_no='$councilor_no', councilor_email='$councilor_email' where ward_id='$pk'";
		$rec = q($sql);
		if($rec>0)
			echo alert_location_replace('Ward Details updated successfully.','ward_list.php');
		else
			echo error_alert_location_replace('ward_list.php');
	}
 }
if (isset($_GET['Edit']))
{
	$E = $_GET['Edit'];
	$esql= "select * from ward_master where ward_id='$E' and status = '1'";
	if(row_count($esql)>0)
		$eres = qf($esql);
	else
		echo alert_location_replace('Ward Details is not available!','ward_list.php');
}
?>
<section class="content-header">
      <h1>
         Ward Register
        <small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New ";}?>Ward Details</small>      </h1>
      </h1>
       <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Ward Register</strong></li>
		 <li class="active"><strong>Add New Ward</strong></li>
</ol>
    </section>
<br>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" class="main_bod" >
            <tr background="images\1by25.jpg">
              <td height="40" colspan="6" align="right">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td height="25" colspan="6" align="right">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td align="right">Ward No </td>
              <td align="center">:</td>
              <td height="30"><input name="ward_no" type="text" id="ward_no"  value="<?php echo @$eres['ward_no'];?>" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="3" required="required"/></td>
              <td align="right">Email ID </td>
              <td align="center">:</td>
              <td><input name="councilor_email" type="email" id="councilor_email" value="<?php echo @$eres['councilor_email'];?>" /></td>
            </tr>
            <tr class="fnt">
              <td align="right">Councilor Name</td>
              <td align="center">:</td>
              <td height="30"><input name="ward_councilor" type="text" id="ward_councilor"  value="<?php echo @$eres['ward_councilor'];?>" /></td>
              <td align="right">Contact No. </td>
              <td align="center">:</td>
              <td><input name="councilor_no" type="text" id="councilor_no" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))"  value="<?php echo @$eres['councilor_no'];?>" maxlength="10"/></td>
            </tr>
            <tr class="fnt">
              <td align="right">Ward Master Name </td>
              <td align="center">:</td>
              <td height="30"><input name="ward_master_name" type="text" id="ward_master_name" value="<?php echo @$eres['ward_master_name'];?>"  /></td>
              <td align="right">Contact No. </td>
              <td align="center">:</td>
              <td><input name="master_no" type="text" id="master_no" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))"  value="<?php echo @$eres['master_no'];?>" maxlength="10"/></td>
            </tr>
            <tr class="fnt">
              <td width="22%" align="right">&nbsp;</td>
              <td width="2%" align="center">&nbsp;</td>
              <td width="26%" height="30">&nbsp;</td>
              <td width="20%" align="right">&nbsp;</td>
              <td width="2%" align="center">&nbsp;</td>
              <td width="28%">&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="6" align="center"><input type="submit" name="Submit" <?php if(isset($_GET['Edit'])){echo "value='Edit'";}else{?>value="Submit"<?php }?> />
                      <input name="pk" type="hidden" id="pk" value="<?php echo @$eres['ward_id'];?>" /></td>
            </tr>
            <tr class="fnt">
              <td colspan="6" align="right">&nbsp;</td>
            </tr>
            <tr background="images\1by25.jpg">
              <td colspan="6" align="right" height="22">&nbsp;</td>
            </tr>
  </table>
</form>


















	<?php include "includes/footer.php";?>
 