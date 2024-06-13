<?php
$page_name = "Employee List";
include "includes/header.php";
//DELETE
if(isset($_GET['Del']))
{
	$D = $_GET['Del'];
	$today = date('Y-m-d');
	$check = row_count("SELECT * FROM emp_master WHERE emp_id = '$D' and emp_status > '0'");
	if($check > 0){
		$gsql= "UPDATE emp_master SET emp_status = '0', emp_delete_date = '$today', emp_delete_by = '$_SESSION[lid]' WHERE emp_id='$D'";
		$grec= q($gsql);
		if($grec)
			echo alert_location_replace('Employee Details removed from the list.','emp_list.php');
		else
			echo error_alert_location_replace('emp_list.php');
	}
	else
		echo alert_location_replace('Employee Details already removed.', 'emp_list.php');
}
?>


<section class="content-header">
      <h1>
        Employee List
        <small>&nbsp;</small>      </h1>
		<ol class="breadcrumb">
  <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Employee Register</li>
		 <li class="active"><strong>Employee List</strong></li>
</ol>
      
</section>
<br />
  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
    <tbody>
      <tr align="center" class="head_font" background="images\1by25.jpg">
        <td width="6%"><b>Sl. No.</b></td>
		 <td width="12%"><b>Employee Image </b></td>
        <td width="24%" height="40"><strong>Employee Details </strong></td>
        <td width="19%"><strong>Contact  Details </strong></td>
        <td width="25%"><strong>Other Details </strong></td>
        <td width="14%" height="40"><strong>Options</strong></td>
      </tr>
      <tr align="center" >
        <td height="25" colspan="14">&nbsp;</td>
      </tr>
      <?php
	
		  $fsql = "select * from emp_master where emp_status = '1' order by emp_name asc";
		  $frec = q($fsql);
		  $i = 1;
		  while($fres = f($frec))
		  {
			if($i % 2 == 0)
			$col = "bgcolor='#E5E5E5'";
			else
			$col = "bgcolor='#D5D5D5'";
			
	  ?>
      <tr align="center" <?php echo $col;?>>
        <td height="122"><?php echo $i;?></td>
		<td height="122"><img src="emp_image/<?php echo $fres['emp_image'];?>" width="75" height="75" /></td>
        <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr align="center">
            <td align="right"><strong>Employee ID </strong></td>
            <td><strong>:</strong></td>
            <td align="left">
			<?php 
				if($fres['emp_id']>0 && $fres['emp_id']<10)
					$emp_id = "000".$fres['emp_id'];
				elseif($fres['emp_id']>=10 && $fres['emp_id']<100)
					$emp_id = "00".$fres['emp_id'];
				elseif($fres['emp_id']>=100 && $fres['emp_id']<1000)
					$emp_id = "0".$fres['emp_id'];
				else
					$emp_id = $fres['emp_id'];
				echo $emp_id;
			?>			</td>
          </tr>
          <tr align="center">
            <td width="45%" align="right"><strong>Employee Name </strong></td>
            <td width="6%"><strong>:</strong></td>
            <td width="49%" align="left"><?php echo $fres['emp_name'];?></td>
          </tr>
          <tr align="center">
            <td align="right"><strong> Father's Name</strong></td>
            <td><strong>:</strong></td>
            <td align="left"><?php echo $fres['emp_fname'];?></td>
          </tr>
          <tr align="center" >
            <td align="right"><strong>DOB</strong></td>
            <td><strong>:</strong></td>
            <td align="left"><?php echo dateu($fres['emp_dob']);?></td>
          </tr>
          <tr align="center">
            <td align="right"><strong>DOJ</strong></td>
            <td><strong>:</strong></td>
            <td align="left"><?php echo dateu($fres['emp_doj']);?></td>
          </tr>
        </table></td>
        <td align="center"><table width="101%" border="0" cellspacing="1" cellpadding="1">
          <tr align="center">
            <td align="right"><strong>Mobile 1 </strong></td>
            <td><strong>:</strong></td>
            <td align="left"><?php echo $fres['emp_mobile_1'];?></td>
          </tr>
          <tr align="center">
            <td align="right"><strong>Mobile 2 </strong></td>
            <td><strong>:</strong></td>
            <td align="left"><?php echo $fres['emp_mobile_2'];?></td>
          </tr>
          <tr align="center">
            <td width="52%" align="right"><strong>Address</strong></td>
            <td width="7%"><strong>:</strong></td>
            <td width="41%" align="left"><?php echo $fres['emp_address'];?></td>
          </tr>
          <tr align="center">
            <td align="right"><strong>Ward No. </strong></td>
            <td><strong>:</strong></td>
            <td align="left"><?php echo $fres['emp_ward'];?></td>
          </tr>
          <tr align="center">
            <td align="right"><strong>PIN</strong></td>
            <td><strong>:</strong></td>
            <td align="left"><?php echo $fres['emp_pin'];?></td>
          </tr>
        </table></td>
        <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr align="center">
              <td align="right"><strong>Designation</strong></td>
              <td><strong>:</strong></td>
              <td align="left"><?php echo desig_name($fres['emp_desig']);?></td>
            </tr>
            <tr align="center" >
              <td align="right"><strong>Licence No </strong></td>
              <td><strong>:</strong></td>
              <td align="left"><?php echo $fres['emp_licence'];?></td>
            </tr>
            <tr align="center" >
              <td align="right"><strong>Aadhaar No </strong></td>
              <td><strong>:</strong></td>
              <td align="left"><?php echo $fres['emp_aadhaar'];?></td>
            </tr>
            <tr align="center" >
              <td align="right"><strong>PAN No. </strong></td>
              <td><strong>:</strong></td>
              <td align="left"><?php echo $fres['emp_pan'];?></td>
            </tr>
            <tr align="center" >
              <td width="41%" align="right"><strong>Qualification </strong></td>
              <td width="6%"><strong>:</strong></td>
              <td width="53%" align="left"><?php echo qual_name($fres['emp_qualification']);?></td>
            </tr>
        </table></td>
        <td><table width="96%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="43" align="center"><a href="emp_register.php?Edit=<?php echo $fres['emp_id'];?>">
              <input type="image" name="imageField" src="allicons/68.gif" title="Edit Record" height="30" width="35"/>
              </a>
                <!--<a href="whatsapp://send?text=<?php //echo "http://maps.google.com/?q=".$fres['site_latitude'].",".$fres['site_longitude'];?>" data-action="share/whatsapp/share" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp"></a></td>-->            </td>
            <td align="center"><a href="view_emp_details.php?View=<?php echo $fres['emp_id'];?>">
              <input type="image" name="imageField2" src="allicons/69.gif" title="View Record" style="cursor:pointer;"/>
            </a></td>
            <td align="center"><a href="" onclick="delet('emp_list.php?Del=<?php echo $fres['emp_id'];?>')" >
              <input type="image" name="imageField22" src="allicons/70.gif" title="Delete Record" />
            </a></td>
          </tr>
          <tr>
            <td width="36%" height="43" align="center"><a href="emp_register.php?Edit=<?php echo $fres['emp_id'];?>">
              <input type="image" name="imageField2" src="allicons/gmail.png" title="Email" height="30" width="35"/>
              </a>
                <!--<a href="whatsapp://send?text=<?php //echo "http://maps.google.com/?q=".$fres['site_latitude'].",".$fres['site_longitude'];?>" data-action="share/whatsapp/share" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp"></a></td>-->            </td>
            <td width="32%" align="center"><a href="#">
              <input type="image" name="imageField23" src="allicons/106.png" height="30pxl" width="40pxl" title="Download PDF" style="cursor:pointer;"/>
            </a></td>
            <td width="32%" align="center"><a href="" onclick="delet('emp_list.php?Del=<?php echo $fres['emp_id'];?>')" >
              <input type="image" name="imageField22" src="allicons/80.gif" title="Show Image" />
            </a></td>
          </tr>
        </table></td>
      </tr>
      <tr align="center" >
            <td height="25" colspan="9">&nbsp;</td>
    </tr>
	<?php $i++; }
		if($i>1){
	?>
	<tr align="center" class="fnt" >
        <td height="58" colspan="28" valign="top" class="fnt" style="font-size:11px;"><strong><span class="fnt" style="font-size:11px;"><strong><a href="export_emp_list.php?"><img src="images/excel.png" height="40" border="0" /></a></strong></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="print_emp_list.php"><img src="images/print.png" height="38" /></a></strong></td>
    </tr>
	<?php }else{?>
	<tr align="center" class="fnt" bgcolor="#CCCCCC">
            <td height="25" colspan="10"><span class="style3">No Record Found</span></td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="10">&nbsp;</td>
    </tr>
	<?php }?>
    </tbody>
    <tr align="center" background="images\1by25.jpg" >
      <td height="22" colspan="14">&nbsp;</td>
    </tr>
</table>
<br />

<?php include "includes/footer.php";?>