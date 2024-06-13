<?php
$page_name = "Organization List";
include "includes/header.php";
?>


<section class="content-header">
      <h1>
        Organization List
        <small>&nbsp;</small>      </h1>
		<ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Organization Register</strong></li>
		 <li class="active"><strong>Organization List</strong></li>
</ol>
      
</section>
<br />
  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
    <tbody>
      <tr align="center" class="head_font" background="images\1by25.jpg">
        <td width="3%"><b>Sl. No.</b></td>
        <td width="15%" height="40"><strong>Organization </strong></td>
        <td width="15%"> Mobile </td>
        <td width="16%"> Address </td>
        <td width="14%"> PIN </td>
        <!--<td width="15%"> Ward No </td>-->
        <td width="15%" height="40"><strong>Options</strong></td>
      </tr>
      <tr align="center" >
        <td height="25" colspan="20">&nbsp;</td>
      </tr>
      <?php
	
		  $fsql = "select * from organization_master where om_status = '1' order by om_name asc";
		  $frec = q($fsql);
		  $i = 1;
		  while($fres = f($frec))
		  {
			if($i % 2 == 0)
			$col = "bgcolor='#E5E5E5'";
			else
			$col = "bgcolor='#D5D5D5'";
			
			if($fres['om_status'] == '1')
			{
				$status = "Active";
				$clr = "#00FF00";
			}
			else
			{
				$status = "Inactive";
				$clr = "#FF0000";
			}
	  ?>
      <tr align="center" <?php echo $col;?>>
        <td height="46"><?php echo $i;?></td>
        <td align="center" valign="middle"><?php echo $fres['om_name'];?></td>
        <td align="center" valign="middle"><?php echo $fres['om_mobile'];?></td>
        <td align="center" valign="middle"><?php echo $fres['om_address'];?></td>
        <td align="center" valign="middle"><?php echo $fres['om_pin'];?></td>
        <!--<td align="center" valign="middle"><?php //echo $fres['om_ward_no'];?></td>-->
        <td><table width="111%" height="42" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="36%" height="42" align="center"><a href="organization_register.php?Edit=<?php echo @$fres['om_id'];?>">
                <input type="image" name="imageField" src="allicons/68.gif" title="Edit Record" height="30" width="35"/>
              </a>
                
              <td width="32%" align="center"><a href="#" >
                <input type="image" name="imageField22" src="allicons/70.gif" title="Delete Record" />
              </a></td>
            </tr>
        </table></td>
      </tr>
	  <tr align="center" >
            <td height="25" colspan="10">&nbsp;</td>
      </tr>
      <?php $i++; }
		if($i>1){
	?>
	<!--<tr align="center" class="fnt" >
        <td height="58" colspan="28" valign="top" class="fnt" style="font-size:11px;"><strong><span class="fnt" style="font-size:11px;"><strong><a href="export_bank_list.php?"><img src="images/excel.png" height="40" border="0" /></a></strong></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="export_work_list.php"><img src="images/print.png" height="38" /></a></strong></td>
    </tr>-->
	<?php }else{?>
	<tr align="center" class="fnt" bgcolor="#CCCCCC">
            <td height="25" colspan="11"><span class="style3">No Record Found</span></td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="11">&nbsp;</td>
    </tr>
	<?php }?>
    </tbody>
    <tr align="center" background="images\1by25.jpg" >
      <td height="22" colspan="20">&nbsp;</td>
    </tr>
</table>


<?php include "includes/footer.php";?>