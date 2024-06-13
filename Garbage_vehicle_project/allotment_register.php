<?php 
$page_name = "Allotment Register";
include "includes/header.php";

$today = date('Y-m-d');
 
if(isset($_GET['DAMID']))
  {
    $dam_id = $_GET['DAMID'];
	
	$asql = "Select * from duty_allotment_master where dam_id ='$dam_id' and dam_status > '0'";
	
	$arec = q($asql);
	$ares = f($arec);
  }
if(isset($_POST['Submit']))
{
	$dam_emp_id			= $_POST['dam_emp_id'];
	$dam_vehicle		= $_POST['dam_vehicle'];
	$dam_log_book		= $_POST['dam_log_book'];
	$dam_ward			= $_POST['dam_ward'];
	$dam_borough		= $_POST['dam_borough_id'];
	$dam_fuel_type		= $_POST['dam_fuel_type'];
	$dam_trips			= $_POST['dam_trips'];
	$dam_fuel_per_trip	= $_POST['dam_fuel_per_trip'];
	$dam_date			= $_POST['dam_date'];
	
	$today = date('Y-m-d'); 
		
	if($_POST['Submit']=="Submit")
	{  	
		$sql ="INSERT INTO `duty_allotment_master` (`dam_emp_id`, `dam_vehicle`, `dam_log_book`, `dam_ward`, `dam_borough_id`, `dam_fuel_type`, `dam_trips`, `dam_fuel_per_trip`, `dam_date`, `dam_entry_date`, `dam_entry_by`) VALUES ('$dam_emp_id', '$dam_vehicle', '$dam_log_book', '$dam_ward', '$dam_borough', '$dam_fuel_type', '$dam_trips', '$dam_fuel_per_trip', '$dam_date', '$today', '$_SESSION[lid]')";
		//echo $sql;exit;
		 $rec = q($sql);
					
		if($rec>0)
			echo alert_location_replace('Allotment Details inserted successfully.','allotment_register.php');
		else
			echo error_alert_location_replace('allotment_register.php');
	}
  if($_POST['Submit']=="Allot")
	{
		$id = $_POST['pk'];
		
		$sql = "UPDATE `duty_allotment_master` SET dam_emp_id ='$dam_emp_id', dam_vehicle ='$dam_vehicle', dam_log_book ='$dam_log_book', dam_ward ='$dam_ward', dam_borough_id ='$dam_borough', dam_fuel_type ='$dam_fuel_type', dam_trips ='$dam_trips', dam_fuel_per_trip ='$dam_fuel_per_trip', dam_update_date ='$today', dam_update_by ='$_SESSION[lid]' where dam_id = '$allot'";
		//echo $sql;exit;
					
		$rec = q($sql);
					
		if($rec>0)
		   echo alert_location_replace('Allotment Details updated successfully.','office_wise_vehicle_list.php?Office=$allot');
		else
		   echo error_alert_location_replace('office_wise_vehicle_list.php');
    }	
}

/*if (isset($_GET['Edit']))
{
	$E = $_GET['Edit'];
	$esql= "select * from duty_allotment_master where dam_id='$E' and dam_status = '1'";
	if(row_count($esql)>0)
		$eres = qf($esql);
	else
		echo alert_location_replace('Allotment Details is not available!','allotment_list.php');
}
*/
$allt_sql = "select * from duty_allotment_master where dam_status > '0'";
$allt_rec = q($allt_sql);
$employees = "0";
$vehicles = "0";
while($allt_res = f($allt_rec)){
	$employees.= ",".$allt_res['dam_emp_id'];
	$vehicles.= ",".$allt_res['dam_vehicle'];
}
?><section class="content-header">
      <h1>
        Allotment Register
        <small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New ";}?>Allotment Details</small>      </h1>
		<ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Allotment Register</strong></li>
		 <li class="active"><strong>Add New Allotment</strong></li>
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
              <td width="12%" height="39" align="right">Vehicle Name </td>
              <td width="2%" height="39" align="center">:</td>
              <td width="14%" height="39" align="left"><select name="dam_vehicle" id="dam_vehicle" required="required">
                <option value="">-- Select Vehicle --</option>
                <?php 
							$vsql = "select * from vehicle_master where vm_status > '0' and vm_id not in ($vehicles) order by vm_name asc";
							$vrec = q($vsql);
							while($vres = f($vrec)){
						?>
                <option value="<?php echo $vres['vm_id'];?>"<?php if(isset($_GET['DAMID'])){if($vres['vm_id'] == $ares['dam_vehicle']){echo "selected ";}else{echo "selected";}}?>><?php echo $vres['vm_name'];?></option>
                <?php }?>
              </select></td>
              <td width="17%" height="39" align="right">Alloted Date </td>
              <td width="2%" height="39" align="center">:</td>
              <td width="17%" height="39" align="left"><input name="dam_date" type="date" id="dam_date" value="<?php echo @$ares['dam_date'];?>" required="required" /></td>
              <td width="14%" height="38" align="right">Employee Name </td>
              <td width="2%" height="38" align="center">:</td>
              <td width="20%" height="38" align="left"><select name="dam_emp_id" id="dam_emp_id" required="required">
                <option value="">-- Select Employee --</option>
                <?php 
							$emp_sql = "select * from emp_master where emp_desig = '1' and emp_status > '0' and emp_id not in ($employees) order by emp_name asc";
							$emp_rec = q($emp_sql);
							while($emp_res = f($emp_rec)){
						?>
                <option value="<?php echo $emp_res['emp_id'];?>"<?php if(isset($_GET['DAMID'])){if($emp_res['emp_id'] == $ares['dam_emp_id']){echo "selected";}else{echo "selected";}}?>><?php echo $emp_res['emp_name'];?></option>
                <?php }?>
              </select></td>
            </tr>
            <tr class="fnt">
              <td height="39" align="right">Log Book No. </td>
              <td height="39" align="center">:</td>
              <td height="39" align="left"><input type="text" name="dam_log_book" value="<?php echo @$ares['dam_log_book'];?>" required="required" /></td>
              <td height="39" align="right">Alloted Borough </td>
              <td height="39" align="center"><strong>:</strong></td>
              <td height="39" align="left"><select name="dam_borough_id" id="dam_borough_id" required="required" onchange="j_get_ward(this.value)">
                <option value="">-- Select Office --</option>
                <?php 
								$bsql = "select * from borough_master where boro_status > '0' order by boro_id asc";
								$brec = q($bsql);
								while($bres = f($brec)){
							?>
                <option value="<?php echo $bres['boro_id'];?>"<?php if(isset($_GET['DAMID'])){if($bres['boro_id'] == $ares['dam_borough_id']){echo "selected";}}?>><?php echo $bres['boro_name'];?></option>
                <?php }?>
              </select></td>
              <td height="39" align="right">Alloted Ward No. </td>
              <td height="39" align="center">:</td>
              <td height="39" align="left"><select name="dam_ward" id="dam_ward" required="required">
                <option value="">-- Select Ward No. --</option>
                <?php 
								$wsql = "select * from ward_master where status > '0' order by ward_no asc";
								$wrec = q($wsql);
								while($wres = f($wrec)){
							?>
                <option value="<?php echo $wres['ward_no'];?>"<?php if(isset($_GET['DAMID'])){if($wres['ward_no'] == $ares['dam_ward']){echo "selected";}}?>><?php echo $wres['ward_no'];?></option>
                <?php }?>
              </select></td>
            </tr>
            <tr class="fnt">
              <td height="39" align="right">Fuel Type </td>
              <td height="39" align="center">:</td>
              <td height="39" align="left"><select name="dam_fuel_type" id="dam_fuel_type" required="required">
                <option value="">-- Select Fuel Type --</option>
                <?php 
						$fsql = "select * from fuel_type_master";
						$frec = q($fsql);
						while($fres = f($frec)){
					?>
                <option value="<?php echo $fres['ftm_id'];?>"<?php if(isset($_GET['DAMID'])){if($fres['ftm_id'] == $ares['dam_fuel_type']){echo "selected";}}?>><?php echo $fres['ftm_type'];?></option>
                <?php }?>
              </select></td>
              <td height="39" align="right">No. of Trips Per Day </td>
              <td height="39" align="center">:</td>
              <td height="39" align="left"><input name="dam_trips" type="text" id="dam_trips" value="<?php echo @$ares['dam_trips'];?>" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))" required=""/></td>
              <td height="39" align="right">Fuel Per Trip </td>
              <td height="39" align="center">:</td>
              <td height="39" align="left"><input name="dam_fuel_per_trip" type="text" id="dam_fuel_per_trip" value="<?php echo @$ares['dam_fuel_per_trip'];?>" style="width:100px;" required=""/>                &nbsp;&nbsp;Liter</td>
            </tr>
            <tr class="fnt">
              <td height="30" colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="9" align="center"><input class="head_font" type="submit" name="Submit" <?php if(isset($_GET['Allot'])) { echo "value=Allot" ;} else { echo "value=Submit" ;}?> />
                <input type="hidden" name="pk" value="<?php echo @$ares['dam_id'];?>"/>			  </td>
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

<script>
      function j_get_ward(ID){
	        var data = "GET_WARD&ID="+ID;
			$("#dam_ward").html("<option value=''>Please Select...</option>");
			$.ajax({
					type	: 'GET',
					data	: data,
					url		: 'ajax_master.php',
					success : function(result){
							$("#dam_ward").html(result);
							}
			})
		}	
		function j_get_branch(ID){
		var data = "GET_BRANCH&ID="+ID;
		$("#emp_branch_id").html("<option value=''>Please Select....</option>");
		$.ajax({
			type	: 'GET',
			data	: data,
			url		: 'ajax_master.php',
			success	: function(result){
				$("#emp_branch_id").html(result);
			}	
		})
	}
</script>
  