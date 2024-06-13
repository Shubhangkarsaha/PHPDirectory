<?php 
$page_name = "Employee Register";
include "includes/header.php";
if(isset($_POST['Submit']))
{
//Employee Details	
	$emp_name 			= $_POST['emp_name'];
	$emp_fname 			= $_POST['emp_fname'];
	$emp_dob 			= $_POST['emp_dob'];
	$emp_desig 			= $_POST['emp_desig'];
	$emp_qualification 	= $_POST['emp_qualification'];
	$emp_doj			= $_POST['emp_doj'];
	$emp_aadhaar		= $_POST['emp_aadhaar'];
	$emp_licence		= $_POST['emp_licence'];
	$emp_pan			= $_POST['emp_pan'];
//Contact Details
	$emp_mobile_1		= $_POST['emp_mobile_1'];
	$emp_mobile_2		= $_POST['emp_mobile_2'];
	$emp_ward			= $_POST['emp_ward'];
	$emp_pin			= $_POST['emp_pin'];
	$emp_address 		= $_POST['emp_address'];
//Document Details	
	$emp_image 			= $_FILES['emp_image']['name'];
	$emp_licence_image	= $_FILES['emp_licence_image']['name'];
	$emp_adhaar_image	= $_FILES['emp_adhaar_image']['name'];
	
	$today = date('Y-m-d'); 
	
		
	if($_POST['Submit']=="Submit")
	{  	
		$sql ="INSERT INTO `emp_master`(`emp_name`, `emp_fname`, `emp_dob`, `emp_desig`, `emp_qualification`, `emp_doj`, `emp_aadhaar`, `emp_licence`, `emp_pan`, `emp_mobile_1`, `emp_mobile_2`, `emp_ward`, `emp_pin`, `emp_address`, `emp_entry_date`, `emp_entry_by`) VALUES ('$emp_name', '$emp_fname', '$emp_dob', '$emp_desig', '$emp_qualification', '$emp_doj', '$emp_aadhaar', '$emp_licence', '$emp_pan', '$emp_mobile_1', '$emp_mobile_2', '$emp_ward', '$emp_pin', '$emp_address', '$today', '$_SESSION[lid]')";
		//echo $sql;exit;
		 //$rec = q($sql);
		 
		 $em  = qi($sql);
		 
		 list($n1,$e1) = explode(".",$emp_image);
		 list($n2,$e2) = explode(".",$emp_licence_image);
		 list($n3,$e3) = explode(".",$emp_adhaar_image);
		 
		 $new_image1 = $em."1.".$e1;
		 $new_image2 = $em."2.".$e2;
		 $new_image3 = $em."3.".$e3;
		 
		 if($em>0)
		   {
		     $title1 = move_uploaded_file($_FILES['emp_image']['tmp_name'],"emp_image/".$new_image1);
			 $title2 = move_uploaded_file($_FILES['emp_licence_image']['tmp_name'],"licence_image/".$new_image2);
			 $title3 = move_uploaded_file($_FILES['emp_adhaar_image']['tmp_name'],"adhaar_image/".$new_image3);
			 
			 $upsql = "update emp_master set emp_image = '$new_image1', emp_licence_image = '$new_image2', emp_adhaar_image = '$new_image3' where emp_id = '$em'";
			 $rec = q($upsql);
		   }
					
		if($rec>0)
			echo alert_location_replace('Employee Details inserted successfully.','emp_register.php');
		else
			echo error_alert_location_replace('emp_register.php');
	}
	if($_POST['Submit']=="Edit")
	{
		$id = $_POST['pk'];
		
		$sql = "UPDATE `emp_master` SET emp_name='$emp_name', emp_fname='$emp_fname', emp_dob='$emp_dob', emp_desig='$emp_desig', emp_qualification='$emp_qualification', emp_doj='$emp_doj', emp_aadhaar='$emp_aadhaar', emp_licence='$emp_licence', emp_pan='$emp_pan', emp_mobile_1='$emp_mobile_1', emp_mobile_2='$emp_mobile_2', emp_ward='$emp_ward', emp_pin='$emp_pin', emp_address='$emp_address', emp_update_date='$today', emp_update_by='$_SESSION[lid]' ";
		//echo $sql;exit;
					
		//$rec = q($sql);
		
		if($emp_image)
		  {
		    list($n1,$e1) = explode(".",$emp_image);
			$new_image1   = $id."1.".$e1;
			if(move_uploaded_file($_FILES['emp_image']['tmp_name'],"emp_image/".$new_image1))
			  {
			    $sql = $sql.", emp_image = '$new_image1'";
			  }
		  }
		if($emp_licence_image)
		  {
		    list($n2,$e2) = explode(".",$emp_licence_image);
			$new_image2   = $id."2.".$e2;
			if(move_uploaded_file($_FILES['emp_licence_image']['tmp_name'],"licence_image/".$new_image2))
			  {
			    $sql = $sql.", emp_licence_image = '$new_image2'";
			  }
		  }
		if($emp_adhaar_image)
		  {
		    list($n3,$e3) = explode(".",$emp_adhaar_image);
			$new_image3   = $id."3.".$e3;
			if(move_uploaded_file($_FILES['emp_adhaar_image']['tmp_name'],"adhaar_image/".$new_image3))
			  {
			    $sql = $sql.", emp_adhaar_image = '$new_image3'";
			  }
		  }
		  
		  $upsql = $sql."where emp_id = '$id'";
		  $rec   = q($upsql);
		  
					
		if($rec>0)
		   echo alert_location_replace('Employee Details updated successfully.','emp_list.php');
		else
		   echo error_alert_location_replace('emp_list.php');
    }	
}

if (isset($_GET['Edit']))
{
	$E = $_GET['Edit'];
	$esql= "select * from emp_master where emp_id='$E' and emp_status = '1'";
	if(row_count($esql)>0)
		$eres = qf($esql);
	else
		echo alert_location_replace('Employee Details is not available!','emp_list.php');
}
?>



<section class="content-header">
      <h1>
        Employee Register
        <small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New ";}?>Employee Details</small>      </h1>
		
		<ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Employee Register</strong></li>
		 <li class="active"><strong>Add New Employee</strong></li>
</ol>
      
</section>
<br />


<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="fnt main_bod head_font" >
            <tr class="head_font">
				<?php 
					$emp_id = qf("SELECT MAX(emp_id) AS ID FROM emp_master");
					if(isset($_GET['Edit']))
						$EMP_ID = $_GET['Edit'];
					else
						$EMP_ID = $emp_id['ID']+1;
				
				?>
              <td height="40" colspan="9" align="center"><input type="button" value="<?php echo "Employee ID - ".$EMP_ID;?>" /></td>
            </tr>
            <tr background="images\1by25.jpg" class="head_font">
              <td height="32" colspan="9" align="left">&nbsp;Employee Details</td>
            </tr>
            <tr class="fnt">
              <td height="25" colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td width="9%" height="39" align="right">Employee Name </td>
              <td width="1%" height="39" align="center">:</td>
              <td width="14%" height="39" align="left"><input name="emp_name" type="text" id="emp_name" value="<?php echo @$eres['emp_name'];?>" required="required"/></td>
              <td width="19%" height="38" align="right">Father's Name </td>
              <td width="2%" height="38" align="center">:</td>
              <td width="15%" height="38" align="left"><input name="emp_fname" type="text" id="emp_fname" value="<?php echo @$eres['emp_fname'];?>" required="required"/></td>
              <td width="11%" height="38" align="right">DOB</td>
              <td width="2%" height="38" align="center">:</td>
              <td width="27%" height="38" align="left"><input name="emp_dob" type="date" id="emp_dob" value="<?php echo @$eres['emp_dob'];?>" required="required"/></td>
            </tr>
            <tr class="fnt">
              <td height="39" align="right">Designation</td>
              <td height="39" align="center">:</td>
              <td height="39" align="left">
				  <select name="emp_desig" id="emp_desig" required="required">
					<option value="">-- Select Designation --</option>
					<?php 
						$dsql = "select * from designation_master where desig_status = '1'";
						$drec = q($dsql);
						while($dres = f($drec)){
					?>
					<option value="<?php echo $dres['desig_id'];?>"<?php if(isset($_GET['Edit'])){if($dres['desig_id'] == $eres['emp_desig']){echo "selected";}}?>><?php echo $dres['desig_name'];?></option>
					<?php }?>
              </select>              </td>
              <td height="39" align="right">Qualification</td>
              <td height="39" align="center">:</td>
              <td height="39" align="left">
				  <select name="emp_qualification" id="emp_qualification" required="required">
					<option value="">-- Select Qualification --</option>
					<?php 
						$qsql = "select * from qualification_master where qm_status = '1'";
						$qrec = q($qsql);
						while($qres = f($qrec)){
					?>
					<option value="<?php echo $qres['qm_id'];?>"<?php if(isset($_GET['Edit'])){if($qres['qm_id'] == $eres['emp_qualification']){echo "selected";}}?>><?php echo $qres['qm_name'];?></option>
					<?php }?>
				  </select>			  </td>
              <td height="39" align="right">DOJ</td>
              <td height="39" align="center">:</td>
              <td height="39" align="left"><input name="emp_doj" type="date" id="emp_doj" value="<?php echo @$eres['emp_doj'];?>" required=""/></td>
            </tr>
            <tr class="fnt">
              <td height="34" align="right">Aadhaar No. </td>
              <td height="34" align="center">:</td>
              <td height="34" align="left"><input name="emp_aadhaar" type="text" id="emp_aadhaar" value="<?php echo @$eres['emp_aadhaar'];?>" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))" maxlength="12" required="required"/></td>
              <td height="34" align="right">Licence No </td>
              <td height="34" align="center">:</td>
              <td height="34" align="left"><input name="emp_licence" type="text" id="emp_licence" value="<?php echo @$eres['emp_licence'];?>" maxlength="10" required="required"/></td>
              <td height="34" align="right">PAN No. </td>
              <td height="34" align="center">:</td>
              <td height="34" align="left"><input name="emp_pan" type="text" id="emp_pan" value="<?php echo @$eres['emp_pan'];?>" maxlength="10" /></td>
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
              <td height="39" align="left"><input name="emp_mobile_1" type="text" id="emp_mobile_1" value="<?php echo @$eres['emp_mobile_1'];?>" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))" maxlength="10" required="required"/></td>
              <td height="39" align="right">&nbsp;</td>
              <td height="39" align="center">&nbsp;</td>
              <td height="39" align="left">&nbsp;</td>
              <td height="39" align="right">Mobile No. 2 </td>
              <td height="39" align="center">:</td>
              <td height="39" align="left"><input name="emp_mobile_2" type="text" id="emp_mobile_2" value="<?php echo @$eres['emp_mobile_2'];?>" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))" maxlength="10"/></td>
            </tr>
            <tr class="fnt">
              <td height="38" align="right">Ward No. </td>
              <td height="38" align="center">:</td>
              <td height="38" align="left">
				  <select name="emp_ward" id="emp_ward" required="required">
					<option value="">-- Select Ward No --</option>
					<?php
						$wsql = "select * from ward_master where status = '1' order by ward_no asc";
						$wrec = q($wsql);
						while($wres = f($wrec)){
					?>
					<option value="<?php echo $wres['ward_no']?>"<?php if(isset($_GET['Edit'])){if($wres['ward_no'] == $eres['emp_ward']){echo "selected";}}?>><?php echo $wres['ward_no'];?></option>
					<?php }?>
			    </select>			  </td>
              <td height="38" align="right">&nbsp;</td>
              <td height="38" align="center">&nbsp;</td>
              <td height="38" align="left">&nbsp;</td>
              <td height="38" align="right">PIN Code </td>
              <td height="38" align="center">:</td>
              <td height="38" align="left"><input name="emp_pin" type="text" id="emp_pin" value="<?php echo @$eres['emp_pin'];?>" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57))" maxlength="6" required="required"/></td>
            </tr>
            <tr class="fnt">
              <td height="46" align="right">Address</td>
              <td height="46" align="center">:</td>
              <td height="46" colspan="7" align="left"><textarea name="emp_address" cols="141" rows="3" required="required"><?php echo @$eres['emp_address'];?></textarea></td>
            </tr>
            <tr class="fnt">
              <td height="30" colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr class="head_font" background="images/1by25.jpg">
              <td height="30" colspan="9" align="left">Upload Documents </td>
            </tr>
            <tr class="fnt">
              <td height="30" colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td height="30" align="right">Employee Image </td>
              <td height="30" align="center">:</td>
              <td height="30" align="left">
                <input name="emp_image" type="file" id="emp_image"  value="<?php echo @$eres['emp_image'];?>" />
				<?php if(isset($_GET['Edit'])) {?>
                <img src="emp_image/<?php echo @$eres['emp_image'];?>" width="75" height="75" /> <?php }?></td>
              <td height="30" align="right">Licence</td>
              <td height="30" align="center" valign="middle">:</td>
              <td height="30" align="left">
                <input name="emp_licence_image" type="file" id="emp_licence_image" value="<?php echo @$eres['emp_licence_image'];?>" />
				<?php if(isset($_GET['Edit'])) {?>
				<img src="licence_image/<?php echo @$eres['emp_licence_image'];?>" width="75" height="75" /><?php }?>              </td>
              <td height="30" align="right">Adhaar</td>
              <td height="30" align="center">:</td>
              <td height="30" align="left">
                <input name="emp_adhaar_image" type="file" id="emp_adhaar_image" value="<?php echo @$eres['emp_adhaar_image'];?>" />
				<?php if(isset($_GET['Edit'])) {?>
				<img src="adhaar_image/<?php echo @$eres['emp_licence_image'];?>" width="75" height="75" /><?php }?>             </td>
            </tr>
            <tr class="fnt">
              <td height="30" colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="9" align="center"><input class="head_font" type="submit" name="Submit" <?php if(isset($_GET['Edit'])) { echo "value=Edit" ;} else { echo "value=Submit" ;}?> />
                      <input type="hidden" name="pk" value="<?php echo @$eres['emp_id'];?>"/>			  </td>
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