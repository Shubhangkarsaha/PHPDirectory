<?php 
$page_name = "Employee Register";
include "includes/header.php";

if(isset($_GET['View']))
 {
  $V = $_GET['View'];
  $vsql = "select * from emp_master where emp_id = '$V'";
  $vrec = q($vsql);
  $vres = f($vrec);
 }
?>



<section class="content-header">
      <h1>
        <small>Employee Details</small></h1>
		
</section>
<br />


<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="fnt main_bod head_font" >
            <tr class="head_font">
				<?php 
					$emp_id = qf("SELECT MAX(emp_id) AS ID FROM emp_master");
					if(isset($_GET['View']))
						$EMP_ID = $_GET['View'];
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
              <td width="14%" height="39" align="left"><?php echo $vres['emp_name'];?></td>
              <td width="17%" height="38" align="right">Father's Name </td>
              <td width="2%" height="38" align="center">:</td>
              <td width="17%" height="38" align="left"><?php echo $vres['emp_fname'];?></td>
              <td width="17%" height="38" align="right">DOB</td>
              <td width="2%" height="38" align="center">:</td>
              <td width="21%" height="38" align="left"><?php echo $vres['emp_dob'];?></td>
            </tr>
            <tr class="fnt">
              <td height="39" align="right">Designation</td>
              <td height="39" align="center">:</td>
              <td height="39" align="left">
				  <?php echo desig_name($vres['emp_desig']);?></td>
              <td height="39" align="right">Qualification</td>
              <td height="39" align="center">:</td>
              <td height="39" align="left">
				  <?php echo qual_name($vres['emp_qualification']);?>	  </td>
              <td height="39" align="right">DOJ</td>
              <td height="39" align="center">:</td>
              <td height="39" align="left"><?php echo $vres['emp_doj'];?></td>
            </tr>
            <tr class="fnt">
              <td height="34" align="right">Aadhaar No. </td>
              <td height="34" align="center">:</td>
              <td height="34" align="left"><?php echo $vres['emp_aadhaar'];?></td>
              <td height="34" align="right">Licence No </td>
              <td height="34" align="center">:</td>
              <td height="34" align="left"><?php echo $vres['emp_licence'];?></td>
              <td height="34" align="right">PAN No. </td>
              <td height="34" align="center">:</td>
              <td height="34" align="left"><?php echo $vres['emp_pan'];?></td>
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
              <td height="39" align="left"><?php echo $vres['emp_mobile_1'];?></td>
              <td height="39" align="right">&nbsp;</td>
              <td height="39" align="center">&nbsp;</td>
              <td height="39" align="left">&nbsp;</td>
              <td height="39" align="right">Mobile No. 2 </td>
              <td height="39" align="center">:</td>
              <td height="39" align="left"><?php echo $vres['emp_mobile_2'];?></td>
            </tr>
            <tr class="fnt">
              <td height="38" align="right">Ward No. </td>
              <td height="38" align="center">:</td>
              <td height="38" align="left">
				  <?php echo $vres['emp_ward'];?>			  </td>
              <td height="38" align="right">&nbsp;</td>
              <td height="38" align="center">&nbsp;</td>
              <td height="38" align="left">&nbsp;</td>
              <td height="38" align="right">PIN Code </td>
              <td height="38" align="center">:</td>
              <td height="38" align="left"><?php echo $vres['emp_pin'];?></td>
            </tr>
            <tr class="fnt">
              <td height="46" align="right">Address</td>
              <td height="46" align="center">:</td>
              <td height="46" colspan="7" align="left"><?php echo $vres['emp_address'];?></textarea></td>
            </tr>
            <tr class="fnt">
              <td height="30" colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr class="head_font" background="images/1by25.jpg">
              <td height="30" colspan="9" align="left">Uploaded Documents </td>
            </tr>
            <tr class="fnt">
              <td height="30" colspan="3" align="right">&nbsp;</td>
              <td height="30" colspan="3" align="right">&nbsp;</td>
              <td height="30" colspan="3" align="right">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td height="99" align="right">Employee Image </td>
              <td height="99" align="center">:</td>
              <td height="99" align="left"><?php if(isset($_GET['View'])) {?>
                  <img src="emp_image/<?php echo @$vres['emp_image'];?>" width="75" height="75" />
                  <?php }?></td>
              <td height="99" align="right">&nbsp;</td>
              <td height="99" align="center" valign="middle">&nbsp;</td>
              <td height="99" align="left">&nbsp;</td>
              <td height="99" align="right">&nbsp;</td>
              <td height="99" align="center">&nbsp;</td>
              <td height="99" align="left">&nbsp;</td>
            </tr>
            <tr class="head_font" background="images/1by25.jpg">
              <td height="30" colspan="3" align="center">PAN Card </td>
              <td height="30" colspan="3" align="center">Licence</td>
              <td height="30" colspan="3" align="center">Adhaar</td>
            </tr>
            <tr class="fnt">
              <td height="30" align="right">&nbsp;</td>
              <td height="30" align="center">&nbsp;</td>
              <td height="30" align="left">&nbsp;</td>
              <td height="30" align="right">&nbsp;</td>
              <td height="30" align="center" valign="middle">&nbsp;</td>
              <td height="30" align="left">&nbsp;</td>
              <td height="30" align="right">&nbsp;</td>
              <td height="30" align="center">&nbsp;</td>
              <td height="30" align="left">&nbsp;</td>
            </tr>
            <tr class="fnt">
              <td height="99" align="right">Front Side </td>
              <td height="99" align="center">:</td>
              <td height="99" align="left"><?php if(isset($_GET['View'])) {?>
                  <img src="emp_image/<?php echo @$eres['emp_image'];?>" width="75" height="75" />
              <?php }?></td>
              <td height="99" align="right">Front Side </td>
              <td height="99" align="center" valign="middle">:</td>
              <td height="99" align="left"><?php if(isset($_GET['View'])) {?>
                  <img src="licence_image/<?php echo @$eres['emp_licence_image'];?>" width="75" height="75" />
                <?php }?>              </td>
              <td height="99" align="right">Front Side </td>
              <td height="99" align="center">:</td>
              <td height="99" align="left"><?php if(isset($_GET['View'])) {?>
                  <img src="adhaar_image/<?php echo @$eres['emp_licence_image'];?>" width="75" height="75" />
                <?php }?>              </td>
            </tr>
            <tr class="fnt">
              <td height="30" align="right">Back Side </td>
              <td height="30" align="center">:</td>
              <td height="30" align="left">
				<?php if(isset($_GET['View'])) {?>
				<img src="emp_image/<?php echo @$eres['emp_image'];?>" width="75" height="75" />				<?php }?></td>
              <td height="30" align="right">Back Side </td>
              <td height="30" align="center" valign="middle">:</td>
              <td height="30" align="left">
				<?php if(isset($_GET['View'])) {?>
				<img src="licence_image/<?php echo @$eres['emp_licence_image'];?>" width="75" height="75" /><?php }?>              </td>
              <td height="30" align="right">Back Side </td>
              <td height="30" align="center">:</td>
              <td height="30" align="left">
				<?php if(isset($_GET['View'])) {?>
				<img src="adhaar_image/<?php echo @$eres['emp_licence_image'];?>" width="75" height="75" /><?php }?>             </td>
            </tr>
            <tr class="fnt">
              <td height="30" colspan="9" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="9" align="center">&nbsp;</td>
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