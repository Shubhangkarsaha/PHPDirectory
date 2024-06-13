<?php 
$page_name = "Filter Register";
include "includes/header.php";

?>

<section class="content-header">
      <h1>
        Filter Section
        <small>&nbsp;</small>      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Filter Section</li>
      </ol>
      <table width="54%" height="23%" border="0" align="center" cellpadding="1" cellspacing="1">
        <tr>
          <td height="97" align="center"><table width="61%" border="0" align="center" cellpadding="0" cellspacing="0" class="main_bod">
              <tr>
                <td height="60" align="center"><img src="allicons/emp.png" width="75" height="48" border="0" /></td>
              </tr>
              <tr>
                <td height="30" align="center" background="images/1by25.jpg" value="1"><a href="" class="head_font">Search By Employee </a></td>
              </tr>
          </table></td>
          <td align="center"><table width="74%" border="0" align="center" cellpadding="0" cellspacing="0" class="main_bod">
              <tr>
                <td height="60" align="center"><a href="emp_list_con.php?O=1"><img src="allicons/66.png" width="75" height="48" border="0" /></a></td>
              </tr>
              <tr>
                <td height="30" align="center" background="images/1by25.jpg"><a href=".php" class="head_font">Search BY Vehicle </a></td>
              </tr>
          </table></td>
          <td align="center"><table width="68%" border="0" align="center" cellpadding="0" cellspacing="0" class="main_bod">
              <tr>
                <td height="60" align="center"><a href="emp_list_con.php?O=1"><img src="allicons/allot.png" width="75" height="48" border="0" /></a></td>
              </tr>
              <tr>
                <td height="30" align="center" background="images/1by25.jpg"><a href=".php" class="head_font">Search By Allotment </a></td>
              </tr>
          </table></td>
        </tr>
      </table>
</section>
<br>


<form action="filter_report.php" method="get" enctype="multipart/form-data" name="form1" id="form1">
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="main_bod head_font fnt">
  <tr>
    <td height="51" align="center" >Search :
      <select name="search" id="search" onchange="j_search(this.value)" required>
        <option value="">...Please Select...</option>
        <option value="1">Employee</option>
        <option value="2">Vehicle</option>
		<option value="3">Allotment</option>
    </select></td>
  </tr>
</table>
<br />
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="main_bod">
  <tr class="emp_class">
    <td align="center"><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" >
      <tr background="images\1by25.jpg" class="head_font">
        <td height="32" colspan="9" align="left">&nbsp;Employee Details</td>
      </tr>
      <tr class="fnt">
        <td height="25" colspan="9" align="right">&nbsp;</td>
      </tr>
      <tr class="fnt">
        <td width="9%" height="39" align="right">Employee Name </td>
        <td width="1%" height="39" align="center">:</td>
        <td width="14%" height="39" align="left"><input name="emp_name" type="text" id="emp_name"/></td>
        <td width="19%" height="38" align="right">Father's Name </td>
        <td width="2%" height="38" align="center">:</td>
        <td width="15%" height="38" align="left"><input name="emp_fname" type="text" id="emp_fname" /></td>
        <td width="11%" height="38" align="right">DOB</td>
        <td width="2%" height="38" align="center">:</td>
        <td width="27%" height="38" align="left"><input name="emp_dob" type="date" id="emp_dob" /></td>
      </tr>
      <tr class="fnt">
        <td height="39" align="right">Designation</td>
        <td height="39" align="center">:</td>
        <td height="39" align="left"><select name="emp_desig" id="emp_desig" >
            <option value="">-- Select Designation --</option>
            <?php 
						$dsql = "select * from designation_master where desig_status = '1'";
						$drec = q($dsql);
						while($dres = f($drec)){
					?>
            <option value="<?php echo $dres['desig_id'];?>"><?php echo $dres['desig_name'];?></option>
            <?php }?>
          </select>        </td>
        <td height="39" align="right">Qualification</td>
        <td height="39" align="center">:</td>
        <td height="39" align="left"><select name="emp_qualification" id="emp_qualification" >
            <option value="">-- Select Qualification --</option>
            <?php 
						$qsql = "select * from qualification_master where qm_status = '1'";
						$qrec = q($qsql);
						while($qres = f($qrec)){
					?>
            <option value="<?php echo $qres['qm_id'];?>"><?php echo $qres['qm_name'];?></option>
            <?php }?>
          </select>        </td>
        <td height="39" align="right">DOJ</td>
        <td height="39" align="center">:</td>
        <td height="39" align="left"><input name="emp_doj" type="date" id="emp_doj"/></td>
      </tr>
      <tr class="fnt">
        <td height="34" align="right">Aadhaar No. </td>
        <td height="34" align="center">:</td>
        <td height="34" align="left"><input name="emp_aadhaar" type="text" id="emp_aadhaar" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))" maxlength="12" /></td>
        <td height="34" align="right">Licence No </td>
        <td height="34" align="center">:</td>
        <td height="34" align="left"><input name="emp_licence" type="text" id="emp_licence" maxlength="10" /></td>
        <td height="34" align="right">PAN No. </td>
        <td height="34" align="center">:</td>
        <td height="34" align="left"><input name="emp_pan" type="text" id="emp_pan" maxlength="10" /></td>
      </tr>
      <tr class="fnt">
        <td height="24" colspan="9" align="right">&nbsp;</td>
      </tr>
      <tr align="left" class="head_font" background="images/1by25.jpg">
        <td height="24" colspan="9">&nbsp;Contact Details</td>
      </tr>
      <tr class="fnt">
        <td height="24" colspan="9" align="right">&nbsp;</td>
      </tr>
      <tr class="fnt">
        <td height="39" align="right">Mobile No. 1 </td>
        <td height="39" align="center">:</td>
        <td height="39" align="left"><input name="emp_mobile_1" type="text" id="emp_mobile_1" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))" maxlength="10" /></td>
        <td height="39" align="right">&nbsp;</td>
        <td height="39" align="center">&nbsp;</td>
        <td height="39" align="left">&nbsp;</td>
        <td height="39" align="right">Mobile No. 2 </td>
        <td height="39" align="center">:</td>
        <td height="39" align="left"><input name="emp_mobile_2" type="text" id="emp_mobile_2" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))" maxlength="10"/></td>
      </tr>
      <tr class="fnt">
        <td height="38" align="right">Ward No. </td>
        <td height="38" align="center">:</td>
        <td height="38" align="left"><select name="emp_ward" id="emp_ward" >
            <option value="">-- Select Ward No --</option>
            <?php
						$wsql = "select * from ward_master where status = '1' order by ward_no asc";
						$wrec = q($wsql);
						while($wres = f($wrec)){
					?>
            <option value="<?php echo $wres['ward_no']?>"><?php echo $wres['ward_no'];?></option>
            <?php }?>
          </select>        </td>
        <td height="38" align="right">&nbsp;</td>
        <td height="38" align="center">&nbsp;</td>
        <td height="38" align="left">&nbsp;</td>
        <td height="38" align="right">PIN Code </td>
        <td height="38" align="center">:</td>
        <td height="38" align="left"><input name="emp_pin" type="text" id="emp_pin" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))" maxlength="6" /></td>
      </tr>
      <tr class="fnt">
        <td height="46" align="right">Address</td>
        <td height="46" align="center">:</td>
        <td height="46" colspan="7" align="left"><textarea name="emp_address" cols="141" rows="3" ></textarea></td>
      </tr>
      <tr class="fnt">
        <td height="30" colspan="9" align="right">&nbsp;</td>
      </tr>

    </table></td>
  </tr>
  <?php // Vehicle Report?>
  <tr class="vehicle_class" style="display:none;">
    <td align="center">
		
		<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
		  <tr class="head_font" background="images\1by25.jpg">
			<td height="31" colspan="9" align="left">&nbsp;Vehicle Details</td>
		  </tr>
		  <tr>
			<td colspan="9" align="right">&nbsp;</td>
		  </tr>
		  <tr class="fnt">
			<td width="10%" align="right">Manufacturer </td>
			<td width="2%" align="center">:</td>
			<td width="15%" align="left"><select name="manufacturer" id="manufacturer"  onchange="vehicle_model(this.value)">
			  <option value="">-- Select Manufacturer --</option>
			  <?php 
						$vmm_sql = "SELECT * FROM `vehicle_manufacturer_master` WHERE vmm_status = '1' order by vmm_name asc";
						$vmm_rec = q($vmm_sql);
						while($vmm_res = f($vmm_rec)){
					?>
			  <option value="<?php echo $vmm_res['vmm_id'];?>"><?php echo $vmm_res['vmm_name'];?></option>
			  <?php }?>
			</select>    </td>
			<td width="19%" align="right">Model</td>
			<td width="2%" align="center">:</td>
			<td width="19%" align="left"><select name="model" id="model" >
			  <option value="">-- Select Model --</option>
			  <?php 
						$vmodel_sql = "SELECT * FROM `vehicle_model_master` WHERE vmodel_status = '1' ";
						if(isset($_GET['Edit'])){
							$vmodel_sql.=" and vmodel_manufacturer = '$eres[vm_manufacturer]'";
						}
						$vmodel_sql.="order by vmodel_name asc";
						//echo $vmodel;exit;
						$vmodel_rec = q($vmodel_sql);
						while($vmodel_res = f($vmodel_rec)){
					?>
			  <option value="<?php echo $vmodel_res['vmodel_id'];?>"><?php echo $vmodel_res['vmodel_name'];?></option>
			  <?php }?>
			</select>    </td>
			<td width="12%" align="right">Vehicle Type</td>
			<td width="2%" align="center">:</td>
			<td width="19%" align="left"><select name="vehicle_type" id="vehicle_type" >
			  <option value="">-- Select Vehicle Type --</option>
			  <?php 
						$vtype_sql = "select * from vehicle_type_master where vtm_status = '1'";
						$vtype_rec = q($vtype_sql);
						while($vtype_res = f($vtype_rec)){
					?>
			  <option value="<?php echo $vtype_res['vtm_id'];?>"><?php echo $vtype_res['vtm_type'];?></option>
			  <?php }?>
			</select>    </td>
		  </tr>
		  <tr class="fnt">
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr class="fnt">
			<td align="right">Vehicle Name </td>
			<td align="center">:</td>
			<td align="left"><input name="vehicle_name" type="text" id="vehicle_name"/></td>
			<td align="right">Fuel Type </td>
			<td align="center">:</td>
			<td align="left"><select name="fuel_type" id="fuel_type" >
			  <option value="">-- Select Vehicle Type --</option>
			  <?php 
						$ftype_sql = "select * from fuel_type_master order by ftm_type asc";
						$ftype_rec = q($ftype_sql);
						while($ftype_res = f($ftype_rec)){
					?>
			  <option value="<?php echo $ftype_res['ftm_id'];?>"><?php echo $ftype_res['ftm_type'];?></option>
			  <?php }?>
			</select>    </td>
			<td align="right">Starting Date </td>
			<td align="center">:</td>
			<td align="left"><input name="starting_date" type="date" id="starting_date" style="width:155px;;"/></td>
		  </tr>
		  <tr class="fnt">
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr class="head_font" background="images/1by25.jpg">
			<td height="27" colspan="9" align="left" >&nbsp;Vehicle Number Details </td>
		  </tr>
		  <tr class="fnt">
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr class="fnt">
			<td align="right">TC No. </td>
			<td align="center">:</td>
			<td align="left"><input name="tc_no" type="text" id="tc_no" /></td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">Vehicle No. </td>
			<td align="center">:</td>
			<td align="left"><input name="vehicle_no" type="text" id="vehicle_no" /></td>
		  </tr>
		  <tr class="fnt">
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr class="fnt">
			<td align="right">Chassis No. </td>
			<td align="center">:</td>
			<td align="left"><input name="chassis_no" type="text" id="chassis_no" /></td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">Engine No. </td>
			<td align="center">:</td>
			<td align="left"><input name="engine_no" type="text" id="engine_no"/></td>
		  </tr>
		  <tr class="fnt">
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr class="head_font" background="images/1by25.jpg">
			<td height="28" colspan="9" align="left" >&nbsp;Other Details</td>
		  </tr>
		  <tr class="fnt">
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr class="fnt" >
			<td align="right">GPS Presence </td>
			<td align="center">:</td>
			<td align="left"><select name="gps_presence" id="gps_presence" >
				<option value="">-- Select Presence--</option>
				<option value="1">Yes</option>
				<option value="0">No</option>
			  </select>    </td>
			<td align="right">GPS ID </td>
			<td align="center">:</td>
			<td align="left"><input name="gps_id" type="text" id="gps_id" /></td>
			<td align="right">GPS Installation Date </td>
			<td align="center">:</td>
			<td align="left"><input name="gps_installation_date" type="date" id="gps_installation_date"/></td>
		  </tr>
		  <tr class="fnt" >
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr class="fnt">
			<td align="right">Vehicle Status </td>
			<td align="center">:</td>
			<td align="left">
			<select name="vehicle_status" id="vehicle_status">
				<option value="">-- Select Status --</option>
				<option value="1">Active</option>
				<option value="2">In Garage</option>
				<option value="all"selected>All</option>
			</select>			</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">Owned By </td>
			<td align="center">:</td>
			<td align="left"><select name="owned_by" >
				<option value="">-- Select Organization --</option>
				<?php
					$org_sql = "select * from organization_master where om_status = '1' order by om_name asc";
					$org_rec = q($org_sql);
					while($org_res = f($org_rec)){
				?>
				<option value="<?php echo $org_res['om_id'];?>"><?php echo $org_res['om_name'];?></option>
				<?php }?>
			  </select>			</td>
		  </tr>
		  <tr class="fnt">
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="left">&nbsp;</td>
		  </tr>
		</table>	</td>
  </tr>
  <tr class="allotment_class" style="display:none;">
    <td align="center"><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" >
      <tr background="images\1by25.jpg" class="head_font">
        <td height="32" colspan="9" align="left">&nbsp;</td>
      </tr>
      <tr class="fnt">
        <td height="25" colspan="9" align="right">&nbsp;</td>
      </tr>
      <tr class="fnt">
        <td width="12%" height="39" align="right">Vehicle Name </td>
        <td width="2%" height="39" align="center">:</td>
        <td width="14%" height="39" align="left"><select name="dam_vehicle" id="dam_vehicle">
            <option value="">-- Select Vehicle --</option>
            <?php 
							$vsql = "select * from vehicle_master where vm_status > '0' order by vm_name asc";
							$vrec = q($vsql);
							while($vres = f($vrec)){
						?>
            <option value="<?php echo $vres['vm_id'];?>"><?php echo $vres['vm_name'];?></option>
            <?php }?>
        </select></td>
        <td width="18%" height="38" align="right">Employee Name </td>
        <td width="2%" height="38" align="center">:</td>
        <td width="16%" height="38" align="left"><select name="dam_emp_id" id="dam_emp_id" >
          <option value="">-- Select Employee --</option>
          <?php 
							$emp_sql = "select * from emp_master where emp_desig = '1' and emp_status > '0' order by emp_name asc";
							$emp_rec = q($emp_sql);
							while($emp_res = f($emp_rec)){
						?>
          <option value="<?php echo $emp_res['emp_id'];?>"><?php echo $emp_res['emp_name'];?></option>
          <?php }?>
        </select></td>
        <td width="14%" height="38" align="right">Sataus</td>
        <td width="2%" height="38" align="center">:</td>
        <td width="20%" height="38" align="left"><select name="dam_status" id="dam_status" >
          <option value="">-- Select Status --</option>
          <option value="1" selected="selected">present</option>
		  <option value="0">Previious</option>
		  <option value="all">All</option>
        </select></td>
      </tr>
      <tr class="fnt">
        <td height="39" align="right">Log Book No. </td>
        <td height="39" align="center">:</td>
        <td height="39" align="left"><input type="text" name="dam_log_book"/></td>
        <td height="39" align="right">Alloted Date </td>
        <td height="39" align="center">:</td>
        <td height="39" align="left"><input name="dam_date" type="date" id="dam_date" /></td>
        <td height="39" align="right">Alloted Ward No. </td>
        <td height="39" align="center">:</td>
        <td height="39" align="left"><select name="dam_ward" id="dam_ward">
            <option value="">-- Select Ward No. --</option>
            <?php 
								$wsql = "select * from ward_master where status > '0' order by ward_no asc";
								$wrec = q($wsql);
								while($wres = f($wrec)){
							?>
            <option value="<?php echo $wres['ward_no'];?>"><?php echo $wres['ward_no'];?></option>
            <?php }?>
          </select>        </td>
      </tr>
      <tr class="fnt">
        <td height="39" align="right">Fuel Type </td>
        <td height="39" align="center">:</td>
        <td height="39" align="left"><select name="dam_fuel_type" id="dam_fuel_type">
            <option value="">-- Select Fuel Type --</option>
            <?php 
						$fsql = "select * from fuel_type_master";
						$frec = q($fsql);
						while($fres = f($frec)){
					?>
            <option value="<?php echo $fres['ftm_id'];?>"><?php echo $fres['ftm_type'];?></option>
            <?php }?>
          </select>        </td>
        <td height="39" align="right">No. of Trips Per Day</td>
        <td height="39" align="center">:</td>
        <td height="39" align="left"><input name="dam_trips" type="text" id="dam_trips" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))" /></td>
        <td height="39" align="right">Fuel Per Trip </td>
        <td height="39" align="center">:</td>
        <td height="39" align="left"><input name="dam_fuel_per_trip" type="text" id="dam_fuel_per_trip" style="width:100px;" />
          &nbsp;&nbsp;Liter</td>
      </tr>
      <tr class="fnt">
        <td height="30" colspan="9" align="right">&nbsp;</td>
      </tr>

    </table></td>
  </tr>
  <tr>
    <td align="center"><input type="submit" class="head_font" name="Submit" /></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" background="images\1by25.jpg">&nbsp;</td>
  </tr>
</table>

</form>

	<?php include "includes/footer.php";?>
 
 
 
 
 
<script>
	//$(".vehicle_class").hide();
	function j_search(VALUE){
		if(VALUE == 1){
			$(".emp_class").show();
			$(".vehicle_class").hide();
			$(".allotment_class").hide();
			document.getElementById('vehicle_status').required = false;
			document.getElementById('dam_status').required = false;
		}
		if(VALUE == 2){
			$(".emp_class").hide();
			$(".vehicle_class").show();
			$(".allotment_class").hide();
			document.getElementById('vehicle_status').required = true;
			document.getElementById('dam_status').required = false;
		}
		if(VALUE == 3){
			$(".emp_class").hide();
			$(".vehicle_class").hide();
			$(".allotment_class").show();
			document.getElementById('dam_status').required = true;
			document.getElementById('vehicle_status').required = false;
		}
	}
	function vehicle_model(ID){
		$("#model").html("<option value=''>...Please Wait</option>");
		var data = 'MANUFACTURER='+ID+'&get_vehicle_model';
		$.ajax({
			type	:	'GET',
			data	:	data,
			url		:	'ajax_master.php',
			success	:	function(result){
				$("#model").html(result);
			}
		})
	}
</script>
	
 