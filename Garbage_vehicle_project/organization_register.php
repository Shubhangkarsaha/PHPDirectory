<?php 
$page_name = "Organization Register";
include "includes/header.php";
if(isset($_POST['Submit']))
	{
		$om_name = $_POST['om_name'];
		$om_address = $_POST['om_address'];
		$om_mobile = $_POST['om_mobile'];
		$om_pin = $_POST['om_pin'];
		$om_ward_no = $_POST['om_ward_no'];
		

		 
		
		
		if($_POST['Submit']=="Submit")
		  {
		    $sql ="INSERT INTO `organization_master`(`om_name`, `om_address`, `om_mobile`, `om_pin`,`om_ward_no`) VALUES ('$om_name', '$om_address', '$om_mobile', '$om_pin','$om_ward_no')";
			
			//echo $sql;exit;

			   $uprec = q($sql);
			  
						
			if($uprec>0)
			{
				echo "<script>
					alert('Organization details inserted successfully.');
					location.replace('organization_register.php?');
				</script>";
			}
			else
			{
				echo "<script>
					alert('Error ! Please Enter the car details carefully.');
					location.replace('organization_register.php');
				</script>";
		     }
	
	       }
	if($_POST['Submit']=="Edit")
	  {
	   $id = $_POST['pk'];
	   $sql = "UPDATE `organization_master` SET `om_name`= '$om_name',`om_address`= '$om_address',`om_mobile`= '$om_mobile',`om_pin` = '$om_pin',`om_ward_no` = '$om_ward_no' where om_id = '$id'";
	   //echo $sql;exit;
					
			   $uprec = q($sql);
			  //exit;
	   if($uprec>0)
	     {
			 echo"<script>
           alert('Organization details updated successfully.');
		   location.replace('organization_list.php?');		    
		  </script>";
		 }
		else
		  {
		   echo"<script>
		    alert('Error ! Please contact your Developer as soon as possible');
			location.replace('organization_register.php?Edit=$id');
		   </script>";
		  } 
		
    }	
}	  
	/*if(isset($_POST['Edit']))
	{
	echo "Demo";
	}*/
	if(isset($_GET['Edit']))
	{
	 $id = $_GET['Edit'];
	 $sql = "select * from organization_master where om_id = '$id'";
	 $rec = q($sql);
	 $fres2 = f($rec);
	 
	}
	
	/*if (isset($_GET['Del']))
      {
	  $D = $_GET['Del'];
	  $dsql= "update company_master set com_status = '1' where com_id='$D'";
	  $drec = q($dsql);
	  echo "<script>
		alert('Category details removed successfully');
		location.replace('company_list.php?')
		</script>";
    }*/
	
?>
<section class="content-header">
	  <h1>
      	Organization Register  
        <small><?php if(isset($_GET['Edit'])){echo "Modify";}else{echo "Add New ";}?>Organization Details</small>
      </h1>
	  <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Organization Register</strong></li>
		 <li class="active"><strong>Add New Organization</strong></li>
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
              <td width="15%" height="38" align="right"><strong>Organization Name </strong></td>
              <td width="3%" height="38" align="center"><strong>:</strong></td>
              <td width="32%" height="38" align="left"><input name="om_name" type="text" id="om_name" value="<?php echo @$fres2['om_name'];?>"  required="required" /></td>
              <td width="22%" height="38" align="right"><strong> Mobile </strong></td>
              <td width="3%" height="38" align="center"><strong>:</strong></td>
              <td width="25%" height="38" align="left"><label>
                <input name="om_mobile" type="text" id="om_mobile" value="<?php echo @$fres2['om_mobile'];?>"  required="required" />
              </label></td>
            </tr>
            <tr class="fnt">
              <td height="39" align="right"><strong> Ward No . </strong></td>
              <td height="39" align="center"><strong>:</strong></td>
              <td height="39" align="left">
			  	<select name="om_ward_no" id="om_ward_no" required="required">
					<option value="">-- Select Ward --</option>
					<?php 
						$wsql = "select * from ward_master where status = '1' order by ward_no asc";
						$wrec = q($wsql);
						while($wres = f($wrec)){
					?>
					<option value="<?php echo $wres['ward_no'];?>"<?php if(isset($_GET['Edit'])){if($wres['ward_no'] == $fres2['om_ward_no']){echo "selected";}}?>><?php echo $wres['ward_no'];?></option>
					<?php }?>
				</select>			  </td>
              <td height="38" align="right"><strong> PIN </strong></td>
              <td height="38" align="center"><strong>:</strong></td>
              <td height="38" align="left"><input name="om_pin" type="text" id="om_pin" value="<?php echo @$fres2['om_pin'];?>"  required="required" /></td>
            </tr>
            <tr class="fnt">
              <td height="38" align="right"><strong>Address</strong></td>
              <td height="38" align="center"><strong>:</strong></td>
              <td height="39" colspan="4" align="left"><textarea name="om_address" cols="110" rows="3" required="required"><?php echo @$fres2['om_address'];?></textarea></td>
            </tr>
            <tr class="fnt">
              <td height="30" colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="9" align="center"><input class="head_font" type="submit" name="Submit" <?php if(isset($_GET['Edit'])) { echo "value=Edit" ;} else { echo "value=Submit" ;}?> />
              <input type="hidden" name="pk" value="<?php echo @$fres2['om_id'];?>"/></td>
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
	<script>
		function get_scheme(MAIN_SCHEME){
		$("#ben_sub_scheme_id").html("<option value=''>Please wait...</option>");
			var data = "main_scheme="+MAIN_SCHEME+"&get_sub_scheme";
			$.ajax({
				type:'GET',
				data:data,
				url:"ajax_master.php",
				success: function(result){
					$("#ben_sub_scheme_id").html(result);
				}				
			})
		}
		
		function get_bank(MAIN_BANK){
		$("#branch_id").html("<option value=''>Please wait...</option>");
			var data = "main_bank="+MAIN_BANK+"&get_branch";
			$.ajax({
				type:'GET',
				data:data,
				url:"ajax_master.php",
				success: function(result){
					$("#branch_id").html(result);
				}				
			})
		}
	</script>
 