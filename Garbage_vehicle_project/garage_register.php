<?php 
$page_name = "Garage Register";
include "includes/header.php";
if(isset($_POST['Submit']))
{
	$gm_name 			= $_POST['gm_name'];
	$gm_owner 			= $_POST['gm_owner'];
	
	$gm_mobile_1		= $_POST['gm_mobile_1'];
	$gm_mobile_2		= $_POST['gm_mobile_2'];
	$gm_ward			= $_POST['gm_ward'];
	$gm_pin				= $_POST['gm_pin'];
	$gm_address 		= $_POST['gm_address'];
	
	$today = date('Y-m-d'); 
		
	if($_POST['Submit']=="Submit")
	{  	
		$sql ="INSERT INTO `garage_master`(`gm_name`, `gm_owner`, `gm_address`, `gm_ward`, `gm_pin`, `gm_mobile_1`, `gm_mobile_2`, `gm_entry_date`, `gm_entry_by`) VALUES ('$gm_name', '$gm_owner', '$gm_address', '$gm_ward', '$gm_pin', '$gm_mobile_1', '$gm_mobile_2', '$today', '$_SESSION[lid]')";
		//echo $sql;exit;
		 $rec = q($sql);
					
		if($rec>0)
			echo alert_location_replace('Garage Details inserted successfully.','garage_register.php');
		else
			echo error_alert_location_replace('garage_register.php');
	}
	if($_POST['Submit']=="Edit")
	{
		$id = $_POST['pk'];
		
		$sql = "UPDATE `garage_master` SET gm_name='$gm_name', gm_owner='$gm_owner', gm_address='$gm_address', gm_ward='$gm_ward', gm_pin='$gm_pin', gm_mobile_1='$gm_mobile_1', gm_mobile_2='$gm_mobile_2', gm_update_date='$today', gm_update_by='$_SESSION[lid]' where gm_id = '$id'";
		//echo $sql;exit;
					
		$rec = q($sql);
					
		if($rec>0)
		   echo alert_location_replace('Garage Details updated successfully.','garage_list.php');
		else
		   echo error_alert_location_replace('garage_list.php');
    }	
}

if (isset($_GET['Edit']))
{
	$E = $_GET['Edit'];
	$esql= "select * from garage_master where gm_id='$E' and gm_status = '1'";
	if(row_count($esql)>0)
		$eres = qf($esql);
	else
		echo alert_location_replace('Garage Details is not available!','gm_list.php');
}
?>
<style type="text/css">
<!--
.style3 {font-size: 24px; font-weight: bold; }
.style4 {
	font-size: 16px;
	font-weight: bold;
}
-->
</style>


<section class="content-header">
      <h1>
        Garage Register
        <small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New ";}?>Garage Details</small>      </h1>
       <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Garage Register</strong></li>
		 <li class="active"><strong>Add New Garage</strong></li>
</ol>
      </section>
<br />

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="main_bod" >
            <tr background="images\1by25.jpg" class="head_font">
              <td height="32" colspan="9" align="left">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td height="25" colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td width="12%" height="39" align="right">Garage Name </td>
              <td width="2%" height="39" align="center">:</td>
              <td width="13%" height="39" align="left"><input name="gm_name" type="text" id="gm_name" value="<?php echo @$eres['gm_name'];?>" required="required"/></td>
              <td width="22%" height="38" align="right">&nbsp;</td>
              <td width="2%" height="38" align="center">&nbsp;</td>
              <td width="13%" height="38" align="left">&nbsp;</td>
              <td width="14%" height="38" align="right">Owner Name </td>
              <td width="2%" height="38" align="center">:</td>
              <td width="20%" height="38" align="left"><input name="gm_owner" type="text" id="gm_owner" value="<?php echo @$eres['gm_owner'];?>" required="required"/></td>
            </tr>
            <tr class="fnt">
              <td height="39" align="right">Mobile No. 1 </td>
              <td height="39" align="center">:</td>
              <td height="39" align="left"><input name="gm_mobile_1" type="text" id="gm_mobile_1" value="<?php echo @$eres['gm_mobile_1'];?>" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))" maxlength="10" required="required"/></td>
              <td height="39" align="right">&nbsp;</td>
              <td height="39" align="center">&nbsp;</td>
              <td height="39" align="left">&nbsp;</td>
              <td height="39" align="right">Mobile No. 2 </td>
              <td height="39" align="center">:</td>
              <td height="39" align="left"><input name="gm_mobile_2" type="text" id="gm_mobile_2" value="<?php echo @$eres['gm_mobile_2'];?>" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))" maxlength="10"/></td>
            </tr>
            <tr class="fnt">
              <td height="38" align="right">Ward No. </td>
              <td height="38" align="center">:</td>
              <td height="38" align="left">
				  <select name="gm_ward" id="gm_ward" required="required">
					<option value="">-- Select Ward No --</option>
					<?php
						$wsql = "select * from ward_master where status = '1' order by ward_no asc";
						$wrec = q($wsql);
						while($wres = f($wrec)){
					?>
					<option value="<?php echo $wres['ward_no']?>"<?php if(isset($_GET['Edit'])){if($wres['ward_no'] == $eres['gm_ward']){echo "selected";}}?>><?php echo $wres['ward_no'];?></option>
					<?php }?>
			    </select>			  </td>
              <td height="38" align="right">&nbsp;</td>
              <td height="38" align="center">&nbsp;</td>
              <td height="38" align="left">&nbsp;</td>
              <td height="38" align="right">PIN Code </td>
              <td height="38" align="center">:</td>
              <td height="38" align="left"><input name="gm_pin" type="text" id="gm_pin" value="<?php echo @$eres['gm_pin'];?>" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))" maxlength="6" required="required"/></td>
            </tr>
            <tr class="fnt">
              <td height="46" align="right">Address</td>
              <td height="46" align="center">:</td>
              <td height="46" colspan="7" align="left"><textarea name="gm_address" cols="156" rows="3" id="gm_address" required="required"><?php echo @$eres['gm_address'];?></textarea></td>
            </tr>
            <tr class="fnt">
              <td height="30" colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="9" align="center"><input class="head_font" type="submit" name="Submit" <?php if(isset($_GET['Edit'])) { echo "value=Edit" ;} else { echo "value=Submit" ;}?> />
                      <input type="hidden" name="pk" value="<?php echo @$eres['gm_id'];?>"/>			  </td>
            </tr>
            <tr class="fnt">
              <td colspan="9" align="center">&nbsp;</td>
            </tr>
            <tr background="images\1by25.jpg">
              <td colspan="9" align="center" height="21">&nbsp;</td>
            </tr>
  </table>
</form>
 <br /><br /><br />
   
  
  


<?php include "includes/footer.php";?>